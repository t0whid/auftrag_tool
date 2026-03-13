<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function index(): View
    {
        $employees = User::where('role', 'employee')
            ->latest()
            ->get();

        return view('admin.employees.index', compact('employees'));
    }

    public function create(): View
    {
        return view('admin.employees.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['nullable', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'] ?? null,
            'password' => $validated['password'],
            'role' => 'employee',
        ]);

        return redirect()
            ->route('admin.employees.index')
            ->with('success', __('admin.employee_created'));
    }

    public function edit(User $employee): View
    {
        abort_if($employee->role !== 'employee', 404);

        return view('admin.employees.edit', compact('employee'));
    }

    public function update(Request $request, User $employee): RedirectResponse
    {
        abort_if($employee->role !== 'employee', 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($employee->id),
            ],
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($employee->id),
            ],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'status' => ['required', 'boolean'],
        ]);

        $employee->name = $validated['name'];
        $employee->username = $validated['username'];
        $employee->email = $validated['email'] ?? null;
        $employee->status = (bool) $validated['status'];

        if (! empty($validated['password'])) {
            $employee->password = $validated['password'];
        }

        $employee->save();

        return redirect()
            ->route('admin.employees.index')
            ->with('success', __('admin.employee_updated'));
    }

    public function destroy(User $employee): RedirectResponse
    {
        abort_if($employee->role !== 'employee', 404);

        $employee->delete();

        return redirect()
            ->route('admin.employees.index')
            ->with('success', __('admin.employee_deleted'));
    }
}