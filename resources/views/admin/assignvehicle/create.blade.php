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

                    <form method="POST" action="{{route('assign_vehicle.store')}}" >
                        @csrf

                        <div class="row">
                            {{-- Assigned Vehicle (Searchable Select2) --}}
                            <div class="mb-3 col-md-6">
                                <label for="assigned_vehicle" class="form-label">Assigned Vehicle *</label>
                                <select name="assigned_vehicle" id="assigned_vehicle" class="form-control select2-searchable" required>
                                    <option value="">Search for a vehicle...</option>
                                    @foreach($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}">
                                            {{ $vehicle->vin_sn }} [{{ $vehicle->vehicle_name }} {{ $vehicle->type }} ]
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Operator (Searchable Select2) --}}
                            <div class="mb-3 col-md-6">
                                <label for="operator" class="form-label">Operator *</label>
                                <select name="operator" id="operator" class="form-control select2-searchable" required>
                                    <option value="">Search for an operator...</option>
                                    @foreach($drivers as $driver)
                                        <option value="{{ $driver->id }}">{{ $driver->first_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Rest of your form fields remain the same --}}
                        <div class="row">
                            {{-- Start Date/Time --}}
                            <div class="mb-3 col-md-6">
                                <label for="start_datetime" class="form-label">Start Date/Time</label>
                                <div class="row">
                                    <div class="col-8">
                                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ date('Y-m-d') }}">
                                    </div>
                                    <div class="col-4">
                                        <input type="time" name="start_time" id="start_time" class="form-control" value="{{ date('H:i') }}">
                                    </div>
                                </div>
                                <small class="text-muted">When assignment starts. Leave blank if assignment has always existed.</small>
                            </div>

                            {{-- Starting Odometer --}}
                            <div class="mb-3 col-md-6">
                                <label for="starting_odometer" class="form-label">Starting Odometer</label>
                                <input type="number" name="starting_odometer" id="starting_odometer" class="form-control" placeholder="Odometer reading when assignment started.">
                            </div>
                        </div>

                        <div class="row">
                            {{-- End Date/Time --}}
                            <div class="mb-3 col-md-6">
                                <label for="end_datetime" class="form-label">End Date/Time</label>
                                <div class="row">
                                    <div class="col-8">
                                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ date('Y-m-d') }}">
                                    </div>
                                    <div class="col-4">
                                        <input type="time" name="end_time" id="end_time" class="form-control" value="{{ date('H:i') }}">
                                    </div>
                                </div>
                                <small class="text-muted">When does this assignment end? Can be past or future.</small>
                            </div>

                            {{-- Ending Odometer --}}
                            <div class="mb-3 col-md-6">
                                <label for="ending_odometer" class="form-label">Ending Odometer</label>
                                <input type="number" name="ending_odometer" id="ending_odometer" class="form-control" placeholder="Odometer reading when assignment ended.">
                            </div>
                        </div>

                        {{-- Optional Comment --}}
                        <div class="mb-3">
                            <label for="optional_comment" class="form-label">Add an optional comment</label>
                            <textarea name="optional_comment" id="optional_comment" class="form-control" rows="3"></textarea>
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



