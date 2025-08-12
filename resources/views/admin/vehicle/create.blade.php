@extends('admin.app')

@section('content')
    <main class="page-content">
        <div class="justify-content-center">
            <div class="col-12">
                <div class="card shadow rounded-card">
                    <div class="card-body bg-white p-4 rounded-card">
                        <h2 class="card-title mb-3">Add Vehicle</h2>

                        {{-- Success Message --}}
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        {{-- Validation Errors --}}
                

                        {{-- Vehicle Create Form --}}
                        <form method="POST" action="{{ route('vehicle.store') }}"     enctype="multipart/form-data"> 
                            @csrf

                            <div class="row">
                                {{-- VIN/SN --}}
                                <div class="mb-3 col-md-6">
                                    <label for="vin_sn">VIN/SN</label>
                                    <input type="text" name="vin_sn" id="vin_sn" class="form-control"
                                        placeholder="Enter VIN or Serial Number" value="{{ old('vin_sn') }}">
                                    @error('vin_sn')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Vehicle Name --}}
                                <div class="mb-3 col-md-6">
                                    <label for="vehicle_name">Vehicle Name</label>
                                    <input type="text" name="vehicle_name" id="vehicle_name" class="form-control"
                                        placeholder="Enter vehicle name" value="{{ old('vehicle_name') }}">
                                    @error('vehicle_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Type --}}
                                <div class="mb-3 col-md-6">
                                    <label for="type">Type</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="">-- Select Type --</option>
                                        <option value="ATV" {{ old('type') == 'ATV' ? 'selected' : '' }}>ATV</option>
                                        <option value="Backhoe Loader"
                                            {{ old('type') == 'Backhoe Loader' ? 'selected' : '' }}>Backhoe Loader</option>
                                        <option value="Boat" {{ old('type') == 'Boat' ? 'selected' : '' }}>Boat</option>
                                        <option value="Bus" {{ old('type') == 'Bus' ? 'selected' : '' }}>Bus</option>
                                        <option value="Car" {{ old('type') == 'Car' ? 'selected' : '' }}>Car</option>
                                        <option value="Dozer" {{ old('type') == 'Dozer' ? 'selected' : '' }}>Dozer
                                        </option>
                                        <option value="Excavator" {{ old('type') == 'Excavator' ? 'selected' : '' }}>
                                            Excavator</option>
                                        <option value="Forklift" {{ old('type') == 'Forklift' ? 'selected' : '' }}>Forklift
                                        </option>
                                        <option value="Generator" {{ old('type') == 'Generator' ? 'selected' : '' }}>
                                            Generator</option>
                                        <option value="Loader" {{ old('type') == 'Loader' ? 'selected' : '' }}>Loader
                                        </option>
                                        <option value="Motorcycle" {{ old('type') == 'Motorcycle' ? 'selected' : '' }}>
                                            Motorcycle</option>
                                        <option value="Motor Grader" {{ old('type') == 'Motor Grader' ? 'selected' : '' }}>
                                            Motor Grader</option>
                                        <option value="Mower" {{ old('type') == 'Mower' ? 'selected' : '' }}>Mower
                                        </option>
                                        <option value="Off-highway Truck"
                                            {{ old('type') == 'Off-highway Truck' ? 'selected' : '' }}>Off-highway Truck
                                        </option>
                                        <option value="Other" {{ old('type') == 'Other' ? 'selected' : '' }}>Other
                                        </option>
                                        <option value="Pickup Truck" {{ old('type') == 'Pickup Truck' ? 'selected' : '' }}>
                                            Pickup Truck</option>
                                        <option value="Semi Truck" {{ old('type') == 'Semi Truck' ? 'selected' : '' }}>Semi
                                            Truck</option>
                                        <option value="Skid-Steer" {{ old('type') == 'Skid-Steer' ? 'selected' : '' }}>
                                            Skid-Steer</option>
                                        <option value="SUV" {{ old('type') == 'SUV' ? 'selected' : '' }}>SUV</option>
                                        <option value="Telehandler" {{ old('type') == 'Telehandler' ? 'selected' : '' }}>
                                            Telehandler</option>
                                        <option value="Track Loader" {{ old('type') == 'Track Loader' ? 'selected' : '' }}>
                                            Track Loader</option>
                                        <option value="Trailer" {{ old('type') == 'Trailer' ? 'selected' : '' }}>Trailer
                                        </option>
                                        <option value="Van" {{ old('type') == 'Van' ? 'selected' : '' }}>Van</option>
                                        <option value="Wheel Loader" {{ old('type') == 'Wheel Loader' ? 'selected' : '' }}>
                                            Wheel Loader</option>
                                        <option value="Wheel Tractor Scraper"
                                            {{ old('type') == 'Wheel Tractor Scraper' ? 'selected' : '' }}>Wheel Tractor
                                            Scraper</option>
                                    </select>
                                    @error('type')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                {{-- Status --}}
                                <div class="mb-3 col-md-6">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">-- Select Status --</option>
                                        <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                        <option value="In Shop" {{ old('status') == 'In Shop' ? 'selected' : '' }}>In Shop
                                        </option>
                                        <option value="Out of Service"
                                            {{ old('status') == 'Out of Service' ? 'selected' : '' }}>Out of Service
                                        </option>
                                        <option value="Sold" {{ old('status') == 'Sold' ? 'selected' : '' }}>Sold
                                        </option>
                                    </select>
                                    @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                {{-- Ownership --}}
                                <div class="mb-3 col-md-6">
                                    <label for="ownership">Ownership</label>
                                    <select name="ownership" id="ownership" class="form-control">
                                        <option value="">-- Select Ownership --</option>
                                        <option value="Company Owned"
                                            {{ old('ownership') == 'Company Owned' ? 'selected' : '' }}>Company Owned
                                        </option>
                                        <option value="Leased" {{ old('ownership') == 'Leased' ? 'selected' : '' }}>Leased
                                        </option>
                                        <option value="Rented" {{ old('ownership') == 'Rented' ? 'selected' : '' }}>Rented
                                        </option>
                                        <option value="Custom" {{ old('ownership') == 'Custom' ? 'selected' : '' }}>Custom
                                        </option>
                                        <option value="Finance" {{ old('ownership') == 'Finance' ? 'selected' : '' }}>
                                            Finance</option>
                                        <option value="Rent to Own"
                                            {{ old('ownership') == 'Rent to Own' ? 'selected' : '' }}>Rent to Own</option>
                                        <option value="Other" {{ old('ownership') == 'Other' ? 'selected' : '' }}>Other
                                        </option>
                                    </select>
                                    @error('ownership')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                 {{-- Car Pictures --}}
<div class="mb-3 col-md-6">
    <label for="pictures">Select Car Pictures</label>
    <input 
        type="file" 
        name="pictures[]" 
        id="pictures" 
        class="form-control" 
        accept="image/*" 
        multiple
    >
@error('pictures')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
    <div id="picture-preview" class="mt-3 d-flex flex-wrap gap-2"></div>
</div>

                                {{-- Note --}}
                                <div class="mb-3 col-md-12">
                                    <label for="note">Note</label>
                                    <textarea name="note" id="note" class="form-control" placeholder="Enter any notes">{{ old('note') }}</textarea>
                                    @error('note')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            

                            <div class="d-flex justify-content-start align-items-center gap-5">
                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                <a href="{{ route('vehicle.index') }}" class="btn btn-outline-danger mt-3">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection