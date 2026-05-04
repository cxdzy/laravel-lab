@extends('layout.template')

@section('title', 'Create Student')

@section('page_title', 'Create Student')

@push('styles')
    <style>
        .mm-input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
        }
    </style>
@endpush

@section('content')
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
        <form action="{{ route('students.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="name" class="form-label text-uppercase small text-body-secondary fw-semibold">Full Name</label>
                        <input type="text" name="name" id="name" class="form-control rounded-3 mm-input" required autofocus value="{{ old('name') }}" placeholder="e.g., Jane Doe">
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label text-uppercase small text-body-secondary fw-semibold">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control rounded-3 mm-input" required value="{{ old('email') }}" placeholder="name@example.com">
                    </div>

                    <div class="col-md-6">
                        <label for="phone_number" class="form-label text-uppercase small text-body-secondary fw-semibold">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control rounded-3 mm-input" value="{{ old('phone_number') }}" placeholder="Optional">
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label text-uppercase small text-body-secondary fw-semibold">Address</label>
                        <input type="text" name="address" id="address" class="form-control rounded-3 mm-input" value="{{ old('address') }}" placeholder="Optional">
                    </div>

                    <div class="col-md-6">
                        <label for="password" class="form-label text-uppercase small text-body-secondary fw-semibold">Password</label>
                        <input type="password" name="password" id="password" class="form-control rounded-3 mm-input" required>
                    </div>

                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label text-uppercase small text-body-secondary fw-semibold">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control rounded-3 mm-input" required>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 d-flex justify-content-end gap-2">
                <a href="{{ route('students.index') }}" class="btn btn-outline-secondary rounded-3">Cancel</a>
                <button type="submit" class="btn btn-primary rounded-3">
                    <i class="bi bi-check2 me-1"></i> Save
                </button>
            </div>
        </form>
    </div>
@endsection