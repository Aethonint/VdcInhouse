@extends('admin.app')

@section('content')
<main class="page-content">
    <div class="justify-content-center">
        <div class="col-12">
            <div class="card shadow rounded-card">
                <div class="card-body bg-white p-4 rounded-card">
                    <h2 class="card-title mb-3">Edit Assignment</h2>

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Update Form --}}
                    <form method="POST" action="{{ route('assign_vehicle.update', $assignment->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            {{-- Assigned Vehicle --}}
                            <div class="mb-3 col-md-6">
                                <label for="assigned_vehicle" class="form-label">Assigned Vehicle *</label>
                                <select name="assigned_vehicle" id="assigned_vehicle" class="form-control select2-searchable" required>
                                    <option value="">Select a vehicle...</option>
                                    @foreach($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}" 
                                            {{ $assignment->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                                            {{ $vehicle->vin_sn }} [{{ $vehicle->vehicle_name }} {{ $vehicle->type }} ]
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Operator --}}
                            <div class="mb-3 col-md-6">
                                <label for="operator" class="form-label">Operator *</label>
                                <select name="operator" id="operator" class="form-control select2-searchable" required>
                                    <option value="">Select an operator...</option>
                                    @foreach($drivers as $driver)
                                        <option value="{{ $driver->id }}" 
                                            {{ $assignment->operator_id == $driver->id ? 'selected' : '' }}>
                                            {{ $driver->first_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Start Date/Time --}}
                            <div class="mb-3 col-md-6">
                                <label for="start_datetime" class="form-label">Start Date/Time</label>
                                <div class="row">
                                    <div class="col-8">
                                        <input type="date" name="start_date" id="start_date" class="form-control" 
                                               value="{{ \Carbon\Carbon::parse($assignment->start_datetime)->format('Y-m-d') }}">
                                    </div>
                                    <div class="col-4">
                                        <input type="time" name="start_time" id="start_time" class="form-control" 
                                               value="{{ \Carbon\Carbon::parse($assignment->start_datetime)->format('H:i') }}">
                                    </div>
                                </div>
                            </div>

                            {{-- Starting Odometer --}}
                            <div class="mb-3 col-md-6">
                                <label for="starting_odometer" class="form-label">Starting Odometer</label>
                                <input type="number" name="starting_odometer" id="starting_odometer" class="form-control" 
                                       value="{{ $assignment->starting_odometer }}">
                            </div>
                        </div>

                        <div class="row">
                            {{-- End Date/Time --}}
                            <div class="mb-3 col-md-6">
                                <label for="end_datetime" class="form-label">End Date/Time</label>
                                <div class="row">
                                    <div class="col-8">
                                        <input type="date" name="end_date" id="end_date" class="form-control" 
                                           value="{{ old('end_date', $assignment->end_datetime ? \Carbon\Carbon::parse($assignment->end_datetime)->format('Y-m-d') : '') }}"
"
>
                                    </div>
                                    <div class="col-4">
                                        <input type="time" name="end_time" id="end_time" class="form-control" 
                                               value="{{ old('end_time', $assignment->end_datetime ? \Carbon\Carbon::parse($assignment->end_datetime)->format('H:i') : '') }}">
                                    </div>
                                </div>
                            </div>

                            {{-- Ending Odometer --}}
                            <div class="mb-3 col-md-6">
                                <label for="ending_odometer" class="form-label">Ending Odometer</label>
                                <input type="number" name="ending_odometer" id="ending_odometer" class="form-control" 
                                       value="{{ $assignment->ending_odometer }}">
                            </div>
                        </div>

                        {{-- Optional Comment --}}
                        <div class="mb-3">
                            <label for="optional_comment" class="form-label">Add an optional comment</label>
                            <textarea name="optional_comment" id="optional_comment" class="form-control" rows="3">{{ $assignment->comment }}</textarea>
                        </div>

                        <div class="d-flex justify-content-start align-items-center gap-5">
                            <button type="submit" class="btn btn-primary mt-3">Update</button>
                            <a href="{{ route('assign_vehicle.index') }}" class="btn btn-outline-danger mt-3">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
