@extends('layout.template')

@section('title', 'Settings')

@section('page_title', 'Settings')

@section('content')
	@if (session('success'))
		<div class="alert alert-success border-0 rounded-3 shadow-sm">
			{{ session('success') }}
		</div>
	@endif

	@if ($errors->any())
		<div class="alert alert-danger border-0 rounded-3 shadow-sm">
			<ul class="mb-0">
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<div class="card border-0 shadow-sm rounded-3">
		<form method="POST" action="{{ route('student.settings.update') }}">
			@csrf
			@method('PUT')

			<div class="card-body">
				<div class="row g-3">
					<div class="col-12">
						<label for="name" class="form-label text-uppercase small text-body-secondary fw-semibold">Name</label>
						<input type="text" name="name" id="name" class="form-control rounded-3 @error('name') is-invalid @enderror"
							   value="{{ old('name', auth()->user()->name) }}" required>
						@error('name')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					<div class="col-md-6">
						<label for="email" class="form-label text-uppercase small text-body-secondary fw-semibold">Email</label>
						<input type="email" name="email" id="email" class="form-control rounded-3 @error('email') is-invalid @enderror"
							   value="{{ old('email', auth()->user()->email) }}" required>
						@error('email')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					<div class="col-md-6">
						<label for="phone_number" class="form-label text-uppercase small text-body-secondary fw-semibold">Phone Number</label>
						<input type="text" name="phone_number" id="phone_number" class="form-control rounded-3 @error('phone_number') is-invalid @enderror"
							   value="{{ old('phone_number', auth()->user()->phone_number) }}" placeholder="Optional">
						@error('phone_number')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					<div class="col-12">
						<label for="address" class="form-label text-uppercase small text-body-secondary fw-semibold">Address</label>
						<input type="text" name="address" id="address" class="form-control rounded-3 @error('address') is-invalid @enderror"
							   value="{{ old('address', auth()->user()->address) }}" placeholder="Optional">
						@error('address')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					<div class="col-12">
						<hr class="my-2">
						<div class="text-body-secondary small">Leave password blank if you don't want to change it.</div>
					</div>

					<div class="col-md-6">
						<label for="password" class="form-label text-uppercase small text-body-secondary fw-semibold">New Password</label>
						<input type="password" name="password" id="password" class="form-control rounded-3 @error('password') is-invalid @enderror"
							   placeholder="Optional">
						<div class="form-text">Minimum 8 characters, with at least one number and one symbol.</div>
						@error('password')
							<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>

					<div class="col-md-6">
						<label for="password_confirmation" class="form-label text-uppercase small text-body-secondary fw-semibold">Confirm Password</label>
						<input type="password" name="password_confirmation" id="password_confirmation" class="form-control rounded-3"
							   placeholder="Optional">
					</div>
				</div>
			</div>

			<div class="card-footer bg-transparent border-0 d-flex justify-content-end gap-2">
				<a href="{{ route('student.dashboard') }}" class="btn btn-outline-secondary rounded-3">Back</a>
				<button type="submit" class="btn btn-primary rounded-3">
					<i class="bi bi-check2 me-1"></i> Save Changes
				</button>
			</div>
		</form>
	</div>
@endsection

