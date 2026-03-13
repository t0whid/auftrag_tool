<div class="mb-3">
    <label class="form-label fw-semibold">Name</label>
    <input type="text" name="name" value="{{ old('name', $employee->name ?? '') }}"
           class="form-control @error('name') is-invalid @enderror" required>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label fw-semibold">Username</label>
    <input type="text" name="username" value="{{ old('username', $employee->username ?? '') }}"
           class="form-control @error('username') is-invalid @enderror" required>
    @error('username')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label fw-semibold">Email</label>
    <input type="email" name="email" value="{{ old('email', $employee->email ?? '') }}"
           class="form-control @error('email') is-invalid @enderror">
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label fw-semibold">
        Password
        @isset($employee)
            <span class="text-secondary small">(Leave blank to keep current password)</span>
        @endisset
    </label>
    <input type="password" name="password"
           class="form-control @error('password') is-invalid @enderror"
           @empty($employee) required @endempty>
    @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label fw-semibold">Confirm Password</label>
    <input type="password" name="password_confirmation" class="form-control" @empty($employee) required @endempty>
</div>

<div class="mb-4">
    <label class="form-label fw-semibold">Status</label>
    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
        <option value="1" {{ old('status', isset($employee) ? (int) $employee->status : 1) == 1 ? 'selected' : '' }}>
            Active
        </option>
        <option value="0" {{ old('status', isset($employee) ? (int) $employee->status : 1) == 0 ? 'selected' : '' }}>
            Inactive
        </option>
    </select>
    @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>