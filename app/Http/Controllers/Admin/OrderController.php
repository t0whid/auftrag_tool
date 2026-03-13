<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::latest()->get();

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

        if ((bool) $validated['is_active']) {
            $this->clearActiveOrders();
        }

        Order::create([
            ...$validated,
            'is_active' => (bool) $validated['is_active'],
            'created_by' => Auth::id(),
        ]);

        return redirect()
            ->route('admin.orders.index')
            ->with('success', __('order.order_created'));
    }

    public function show(Order $order): View
    {
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order): View
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $validated = $this->validateOrder($request);
        $validated['travel_cost_unit'] = $validated['travel_cost_unit'] ?: 'km';

        if ((bool) $validated['is_active']) {
            $this->clearActiveOrders($order->id);
        }

        $order->update([
            ...$validated,
            'is_active' => (bool) $validated['is_active'],
        ]);

        return redirect()
            ->route('admin.orders.index')
            ->with('success', __('order.order_updated'));
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();

        return redirect()
            ->route('admin.orders.index')
            ->with('success', __('order.order_deleted'));
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
        ]);
    }

    protected function clearActiveOrders(?int $exceptId = null): void
    {
        Order::query()
            ->when($exceptId, fn ($query) => $query->where('id', '!=', $exceptId))
            ->where('is_active', true)
            ->update(['is_active' => false]);
    }
}