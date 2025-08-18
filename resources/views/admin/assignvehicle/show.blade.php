@extends('admin.app')

@section('content')
<main class="page-content">
    <div class="justify-content-center">
        <div class="col-12">
            <div class="card shadow rounded-card">
                <div class="card-body bg-white p-4 rounded-card">

                    <!-- Page Title -->
                    <h2 class="card-title mb-3">Assignment Details</h2>

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <!-- Assignment Details Box -->
                    <div class="p-3 rounded drivers-details">
                        
                        <!-- Section Heading -->
                        <h5 class="driver-information fw-bold mb-3">Assignment Information</h5>
                        <p class="p-border"></p>

                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Vehicle:</strong> 
                                {{ $assignment->vehicle->vehicle_name ?? 'N/A' }} 
                                (VIN: {{ $assignment->vehicle->vin_sn ?? 'N/A' }})
                            </div>
                            <div class="col-md-6">
                                <strong>Driver:</strong> 
                                {{ $assignment->operator->first_name ?? 'N/A' }} {{ $assignment->operator->last_name ?? '' }}
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Start Date & Time:</strong> {{ $assignment->start_datetime ?? 'N/A' }}
                            </div>
                            <div class="col-md-6">
                                <strong>End Date & Time:</strong> {{ $assignment->end_datetime ?? 'Still Active' }}
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Starting Odometer:</strong> {{ $assignment->starting_odometer ?? 'N/A' }}
                            </div>
                            <div class="col-md-6">
                                <strong>Ending Odometer:</strong> {{ $assignment->ending_odometer ?? 'N/A' }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <strong>Comment:</strong> {{ $assignment->comment ?? 'No comment provided' }}
                            </div>
                        </div>

                    </div><!-- End Box -->

                    <div class="mt-3">
                        <a href="{{ route('assign_vehicle.index') }}" class="btn btn-primary">Back to Assignments</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
@endsection
