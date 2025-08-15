@extends('admin.app')

@section('content')
<main class="page-content">
    <div class="justify-content-center">
        <div class="col-12">
            <div class="card shadow rounded-card">
                <div class="card-body bg-white p-4 rounded-card">
                    <h2 class="card-title mb-3">Add Assignment</h2>

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                   
                    <form method="POST" action="{{ route('assign_vehicle.store') }}">
                        @csrf

                        <div class="row">
                            {{-- Assigned Vehicle --}}
                            <div class="mb-3 col-md-6">
                                <label for="assigned_vehicle" class="form-label">Assigned Vehicle *</label>
                                <select name="assigned_vehicle" id="assigned_vehicle" class="form-control select2-searchable">
                                    <option value="">Search for a vehicle...</option>
                                    @foreach($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}" {{ old('assigned_vehicle') == $vehicle->id ? 'selected' : '' }}>
                                            {{ $vehicle->vin_sn }} [{{ $vehicle->vehicle_name }} {{ $vehicle->type }} ]
                                        </option>
                                    @endforeach
                                </select>
                                @error('assigned_vehicle')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Operator --}}
                            <div class="mb-3 col-md-6">
                                <label for="operator" class="form-label">Operator *</label>
                                <select name="operator" id="operator" class="form-control select2-searchable">
                                    <option value="">Search for an operator...</option>
                                    @foreach($drivers as $driver)
                                        <option value="{{ $driver->id }}" {{ old('operator') == $driver->id ? 'selected' : '' }}>
                                            {{ $driver->first_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('operator')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            {{-- Start Date/Time --}}
                            <div class="mb-3 col-md-6">
                                <label for="start_datetime" class="form-label">Start Date/Time</label>
                                <div class="row">
                                    <div class="col-8">
                                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}">
                                        @error('start_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-4">
                                        <input type="time" name="start_time" id="start_time" class="form-control" value="{{ old('start_time') }}">
                                        @error('start_time')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <small class="text-muted">When assignment starts. Leave blank if assignment has always existed.</small>
                            </div>

                            {{-- Starting Odometer --}}
                            <div class="mb-3 col-md-6">
                                <label for="starting_odometer" class="form-label">Starting Odometer</label>
                                <input type="number" name="starting_odometer" id="starting_odometer" class="form-control" placeholder="Odometer reading when assignment started." value="{{ old('starting_odometer') }}">
                                @error('starting_odometer')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            {{-- End Date/Time --}}
                            <div class="mb-3 col-md-6">
                                <label for="end_datetime" class="form-label">End Date/Time</label>
                                <div class="row">
                                    <div class="col-8">
                                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}">
                                        @error('end_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-4">
                                        <input type="time" name="end_time" id="end_time" class="form-control" value="{{ old('end_time') }}">
                                        @error('end_time')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <small class="text-muted">When does this assignment end? Can be past or future.</small>
                            </div>

                            {{-- Ending Odometer --}}
                            <div class="mb-3 col-md-6">
                                <label for="ending_odometer" class="form-label">Ending Odometer</label>
                                <input type="number" name="ending_odometer" id="ending_odometer" class="form-control" placeholder="Odometer reading when assignment ended." value="{{ old('ending_odometer') }}">
                                @error('ending_odometer')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- Optional Comment --}}
                        <div class="mb-3">
                            <label for="optional_comment" class="form-label">Add an optional comment</label>
                            <textarea name="optional_comment" id="optional_comment" class="form-control" rows="3">{{ old('optional_comment') }}</textarea>
                            @error('optional_comment')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-start align-items-center gap-5">
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                            <a href="{{ route('driver.index') }}" class="btn btn-outline-danger mt-3">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
