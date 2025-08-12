@extends('admin.app')

@section('content')
<main class="page-content">
    <div class="justify-content-center">
        <div class="col-12">
            <div class="card shadow rounded-card">
                <div class="card-body bg-white p-4 rounded-card">
                    <h2 class="card-title mb-3">Edit Vehicle</h2>

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Vehicle Edit Form --}}
                    <form method="POST" action="{{ route('vehicle.update', $vehicle->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            {{-- VIN/SN --}}
                            <div class="mb-3 col-md-6">
                                <label for="vin_sn">VIN/SN</label>
                                <input type="text" name="vin_sn" id="vin_sn" class="form-control"
                                    value="{{ old('vin_sn', $vehicle->vin_sn) }}">
                            </div>

                            {{-- Vehicle Name --}}
                            <div class="mb-3 col-md-6">
                                <label for="vehicle_name">Vehicle Name</label>
                                <input type="text" name="vehicle_name" id="vehicle_name" class="form-control"
                                    value="{{ old('vehicle_name', $vehicle->vehicle_name) }}">
                            </div>

                            {{-- Type --}}
                            <div class="mb-3 col-md-6">
                                <label for="type">Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="">-- Select Type --</option>
                                    @foreach(['ATV','Backhoe Loader','Boat','Bus','Car','Dozer','Excavator','Forklift','Generator','Loader','Motorcycle','Motor Grader','Mower','Off-highway Truck','Other','Pickup Truck','Semi Truck','Skid-Steer','SUV','Telehandler','Track Loader','Trailer','Van','Wheel Loader','Wheel Tractor Scraper'] as $type)
                                        <option value="{{ $type }}" {{ old('type', $vehicle->type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Status --}}
                            <div class="mb-3 col-md-6">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">-- Select Status --</option>
                                    @foreach(['Active','Inactive','In Shop','Out of Service','Sold'] as $status)
                                        <option value="{{ $status }}" {{ old('status', $vehicle->status) == $status ? 'selected' : '' }}>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Ownership --}}
                            <div class="mb-3 col-md-6">
                                <label for="ownership">Ownership</label>
                                <select name="ownership" id="ownership" class="form-control">
                                    <option value="">-- Select Ownership --</option>
                                    @foreach(['Company Owned','Leased','Rented','Custom','Finance','Rent to Own','Other'] as $own)
                                        <option value="{{ $own }}" {{ old('ownership', $vehicle->ownership) == $own ? 'selected' : '' }}>{{ $own }}</option>
                                    @endforeach
                                </select>
                            </div>
                             <div class="mb-3 col-md-6">
                                <label for="note">Note</label>
                                <input name="note" id="note" class="form-control" value="{{ old('note', $vehicle->note) }}">
                            </div>

                            {{-- Pictures --}}
                            <div class="mb-3 col-md-6">
                                <label for="pictures">Update Pictures (optional)</label>
                                <input type="file" name="pictures[]" id="pictures" class="form-control" accept="image/*" multiple>

                                {{-- Existing Pictures Preview --}}
                               @php
    $pictures = is_array($vehicle->pictures) ? $vehicle->pictures : json_decode($vehicle->pictures, true) ?? [];
@endphp

<div class="mt-3 d-flex flex-wrap gap-3  col-md-6">
    @foreach ($pictures as $index => $pic)
        <div style="position:relative; display:inline-block; text-align:center;">
            <img src="{{ asset('storage/vehicles/' . $pic) }}" 
                 alt="Vehicle Image" 
                 width="60" height="60" 
                 style="object-fit:cover; border-radius:4px; border:1px solid #ccc;">
            <div>
                <label>
                    <input type="checkbox" name="remove_pictures[]" value="{{ $pic }}"> Remove
                </label>
            </div>
        </div>
    @endforeach
</div>


                            {{-- Note --}}
                           
                        </div>

                        <div class="d-flex justify-content-start align-items-center gap-5">
                            <button type="submit" class="btn btn-primary mt-3">Update</button>
                            <a href="{{ route('vehicle.index') }}" class="btn btn-outline-danger mt-3">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
