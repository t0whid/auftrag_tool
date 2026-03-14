<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    public function index(): View
    {
        $admins = User::query()
            ->whereIn('role', ['super_admin', 'admin'])
            ->latest()
            ->get();

        return view('admin.admin-users.index', compact('admins'));
    }

    public function create(): View
    {
        return view('admin.admin-users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'status' => ['required', 'boolean'],
            'role' => ['required', Rule::in(['admin'])],
        ]);

        User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'status' => (bool) $validated['status'],
        ]);

        return redirect()
            ->route('admin.admin-users.index')
            ->with('success', __('admin.admin_created'));
    }

    public function edit(User $admin_user): View
    {
        abort_unless(in_array($admin_user->role, ['super_admin', 'admin']), 404);

        return view('admin.admin-users.edit', [
            'admin' => $admin_user,
        ]);
    }

    public function update(Request $request, User $admin_user): RedirectResponse
    {
        abort_unless(in_array($admin_user->role, ['super_admin', 'admin']), 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($admin_user->id),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($admin_user->id),
            ],
            'status' => ['required', 'boolean'],
        ]);

        $admin_user->update([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'status' => (bool) $validated['status'],
        ]);

        return redirect()
            ->route('admin.admin-users.index')
            ->with('success', __('admin.admin_updated'));
    }

    public function passwordForm(User $admin_user): View
    {
        abort_unless(in_array($admin_user->role, ['super_admin', 'admin']), 404);

        return view('admin.admin-users.password', [
            'admin' => $admin_user,
        ]);
    }

    public function updatePassword(Request $request, User $admin_user): RedirectResponse
    {
        abort_unless(in_array($admin_user->role, ['super_admin', 'admin']), 404);

        $validated = $request->validate([
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $admin_user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('admin.admin-users.index')
            ->with('success', __('admin.admin_password_updated'));
    }

    public function myPasswordForm(): View
    {
        return view('admin.admin-users.my-password');
    }

    public function updateMyPassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = auth()->user();

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', __('admin.my_password_updated'));
    }
}