@extends('admin.app')

@section('content')
<style>
    .vehicle-image {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #ddd;
        margin-right: 10px;
    }
    .image-gallery {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }
</style>

<main class="page-content">
    <div class="justify-content-center">
        <div class="col-12">
            <div class="card shadow rounded-card">
                <div class="card-body bg-white p-4 rounded-card">

                    <!-- Page Title -->
                    <h2 class="card-title mb-3">Vehicle Detail</h2>

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <!-- Vehicle Details -->
                    <div class="p-3 rounded vehicle-details">
                        <h5 class="fw-bold mb-3">Vehicle Information</h5>
                        <p class="p-border"></p>

                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>VIN / SN:</strong> {{ $vehicle->vin_sn }}
                            </div>
                            <div class="col-md-6">
                                <strong>Name:</strong> {{ $vehicle->vehicle_name }}
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Type:</strong> {{ ucfirst($vehicle->type) }}
                            </div>
                            <div class="col-md-6">
                                <strong>Status:</strong> {{ ucfirst($vehicle->status) }}
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Ownership:</strong> {{ ucfirst($vehicle->ownership) }}
                            </div>
                            <div class="col-md-6">
                                <strong>Note:</strong> {{ $vehicle->note ?? 'N/A' }}
                            </div>
                        </div>

                        <!-- Images Section -->
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <strong>Pictures:</strong>
                                <div class="image-gallery">
                                    @php
                                        $images = is_array($vehicle->pictures) ? $vehicle->pictures : json_decode($vehicle->pictures, true);
                                    @endphp
                                    @if(!empty($images))
                                        @foreach($images as $img)
                                            <img src="{{ asset('storage/vehicles/' . $img) }}" class="vehicle-image" alt="Vehicle Image">
                                        @endforeach
                                    @else
                                        <p>No images available.</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Back Button -->
                    <div class="mt-3">
                        <a href="{{ route('vehicle.index') }}" class="btn btn-primary">Back to Vehicles</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
@endsection
