@extends('layout.template')

@section('title', 'Lecturer')

@section('page_title', 'My Classes')

@section('content')
	<div class="row mb-3">
		<div class="col-12">
			<div class="card border-0 shadow-sm rounded-3">
				<div class="card-body">
					<div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
						<div>
							<h3 class="mb-1">Welcome, {{ auth()->user()->name }}</h3>
							<p class="text-muted mb-0">Here are the classes you are scheduled to teach.</p>
						</div>
						<a href="{{ route('lecturer.settings.edit') }}" class="btn btn-outline-secondary rounded-3">
							<i class="bi bi-gear me-1"></i> Settings
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="card border-0 shadow-sm rounded-3">
		<div class="card-body">
			@if ($classes->isEmpty())
				<div class="alert alert-info border-0 rounded-3 mb-0">
					No classes found yet. Make sure your name matches the subject's lecturer name.
				</div>
			@else
				<div class="table-responsive">
					<table class="table align-middle mb-0">
						<thead>
						<tr>
							<th>Day</th>
							<th>Time</th>
							<th>Subject</th>
							<th>Class</th>
							<th>Hall</th>
						</tr>
						</thead>
						<tbody>
						@foreach ($classes as $row)
							<tr>
								<td>{{ $row->day?->day_name ?? '-' }}</td>
								<td>{{ $row->time_from }} - {{ $row->time_to }}</td>
								<td>
									@if($row->subject)
										<div class="fw-semibold">{{ $row->subject->subject_code }}</div>
										<div class="text-body-secondary small">{{ $row->subject->subject_name }}</div>
									@else
										-
									@endif
								</td>
								<td>
									@if($row->lecturerGroup)
										<div class="fw-semibold">{{ $row->lecturerGroup->name }}</div>
										<div class="text-body-secondary small">{{ $row->lecturerGroup->part }}</div>
									@else
										-
									@endif
								</td>
								<td>
									@if($row->hall)
										<div class="fw-semibold">{{ $row->hall->lecture_hall_name }}</div>
										<div class="text-body-secondary small">{{ $row->hall->lecture_hall_place }}</div>
									@else
										-
									@endif
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			@endif
		</div>
	</div>
@endsection

