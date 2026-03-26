<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderAttachment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::with('creator')
            ->withCount('attachments')
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function create(): View
    {
        return view('admin.orders.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateOrder($request);
        $validated['travel_cost_unit'] = $validated['travel_cost_unit'] ?: 'km';

        DB::transaction(function () use ($validated, $request) {
            $order = Order::create([
                ...$validated,
                'is_active' => (bool) $validated['is_active'],
                'created_by' => Auth::id(),
            ]);

            $this->storeAttachments($request, $order);
        });

        return redirect()
            ->route('admin.orders.index')
            ->with('success', __('order.order_created'));
    }

    public function show(Order $order): View
    {
        $order->load(['creator', 'attachments']);

        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order): View
    {
        $order->load('attachments');

        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $validated = $this->validateOrder($request);
        $validated['travel_cost_unit'] = $validated['travel_cost_unit'] ?: 'km';

        DB::transaction(function () use ($validated, $request, $order) {
            $order->update([
                ...$validated,
                'is_active' => (bool) $validated['is_active'],
            ]);

            $this->storeAttachments($request, $order);
        });

        return redirect()
            ->route('admin.orders.index')
            ->with('success', __('order.order_updated'));
    }

    public function destroy(Order $order): RedirectResponse
    {
        DB::transaction(function () use ($order) {
            $order->load('attachments');

            foreach ($order->attachments as $attachment) {
                $absolutePath = $this->absoluteAttachmentPath($attachment->file_path);

                if (is_file($absolutePath)) {
                    @unlink($absolutePath);
                }
            }

            $order->delete();
        });

        return redirect()
            ->route('admin.orders.index')
            ->with('success', __('order.order_deleted'));
    }

    public function toggleStatus(Order $order): RedirectResponse
    {
        $order->update([
            'is_active' => ! $order->is_active,
        ]);

        return redirect()
            ->route('admin.orders.index')
            ->with(
                'success',
                $order->is_active
                    ? __('order.order_activated')
                    : __('order.order_deactivated')
            );
    }

    public function destroyAttachment(Order $order, OrderAttachment $attachment): RedirectResponse
    {
        if ((int) $attachment->order_id !== (int) $order->id) {
            abort(404);
        }

        $absolutePath = $this->absoluteAttachmentPath($attachment->file_path);

        if (is_file($absolutePath)) {
            @unlink($absolutePath);
        }

        $attachment->delete();

        return redirect()
            ->back()
            ->with('success', 'Attachment removed successfully.');
    }

    public function viewAttachment(Order $order, OrderAttachment $attachment)
    {
        if ((int) $attachment->order_id !== (int) $order->id) {
            abort(404);
        }

        $absolutePath = $this->absoluteAttachmentPath($attachment->file_path);

        if (! is_file($absolutePath)) {
            abort(404);
        }

        $mimeType = $attachment->file_type ?: File::mimeType($absolutePath) ?: 'application/octet-stream';

        return Response::file($absolutePath, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $attachment->file_name . '"',
        ]);
    }

    protected function validateOrder(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'team_info' => ['nullable', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],

            'hourly_rate' => ['nullable', 'numeric', 'min:0'],
            'travel_cost' => ['nullable', 'numeric', 'min:0'],
            'travel_cost_unit' => ['nullable', 'string', 'max:50'],
            'meal_allowance' => ['nullable', 'numeric', 'min:0'],

            'custom_field_1_label' => ['nullable', 'string', 'max:255'],
            'custom_field_1_value' => ['nullable', 'string', 'max:255'],
            'custom_field_2_label' => ['nullable', 'string', 'max:255'],
            'custom_field_2_value' => ['nullable', 'string', 'max:255'],

            'is_active' => ['required', 'boolean'],

            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:10240'],
        ]);
    }

    protected function storeAttachments(Request $request, Order $order): void
    {
        if (! $request->hasFile('attachments')) {
            return;
        }

        $relativeFolder = $this->getOrderUploadFolderRelative($order->id, $order->title);
        $absoluteFolder = $this->absoluteAttachmentPath($relativeFolder);

        if (! is_dir($absoluteFolder)) {
            throw new \RuntimeException('Upload folder does not exist: ' . $relativeFolder);
        }

        foreach ($request->file('attachments') as $file) {
            if (! $file || ! $file->isValid()) {
                continue;
            }

            $originalName = $file->getClientOriginalName();
            $extension = strtolower($file->getClientOriginalExtension());
            $originalBaseName = pathinfo($originalName, PATHINFO_FILENAME);

            $sanitizedBaseName = $this->sanitizeOriginalFileName($originalBaseName);

            if ($sanitizedBaseName === '') {
                $sanitizedBaseName = 'file';
            }

            $generatedFileName = $order->id . '_' . $sanitizedBaseName . '.' . $extension;
            $finalFileName = $this->ensureUniqueFileName($absoluteFolder, $generatedFileName);

            $mimeType = $file->getMimeType();
            $fileSize = $file->getSize();

            $file->move($absoluteFolder, $finalFileName);

            OrderAttachment::create([
                'order_id' => $order->id,
                'file_name' => $finalFileName,
                'file_path' => $relativeFolder . '/' . $finalFileName,
                'file_type' => $mimeType,
                'file_size' => $fileSize,
            ]);
        }
    }

    protected function getOrderUploadFolderRelative(int $orderId, string $title): string
    {
        return 'uploads/orders';
    }

    protected function absoluteAttachmentPath(string $relativePath): string
    {
        return base_path($relativePath);
    }

    protected function sanitizeOriginalFileName(string $name): string
    {
        $name = trim($name);
        $name = preg_replace('/\s+/', '_', $name);
        $name = preg_replace('/[^A-Za-z0-9_\-]/', '_', $name);
        $name = preg_replace('/_+/', '_', $name);
        $name = trim($name, '._-');

        return (string) $name;
    }

    protected function ensureUniqueFileName(string $folder, string $fileName): string
    {
        $fullPath = $folder . DIRECTORY_SEPARATOR . $fileName;

        if (! file_exists($fullPath)) {
            return $fileName;
        }

        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $baseName = pathinfo($fileName, PATHINFO_FILENAME);

        return $baseName . '_' . now()->format('YmdHis') . '.' . $extension;
    }
}