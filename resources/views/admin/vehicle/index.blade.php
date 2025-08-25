@extends('admin.app')
@section('content')
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Vehicles</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}"><i class="bi bi-car-front"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Vehicles Table</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a class="btn btn-primary" href="{{ route('vehicle.create') }}">
                    <i class="bi bi-plus-lg"></i> Add Vehicle
                </a>
            </div>
        </div>
        <!--end breadcrumb-->

        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered text-center" style="width:100%">
                        <thead>
                            <tr>
                                <th>Record #</th>
                                <th>VIN/SN</th>
                                <th>Vehicle Name</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Ownership</th>
                                <th>Pictures</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicles as $vehicle)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $vehicle->vin_sn }}</td>
                                    <td>{{ $vehicle->vehicle_name }}</td>
                                    <td>{{ $vehicle->type }}</td>

                                    <!-- ✅ Status with Same Size Badges -->
                                   <td>
    @php
        $statusClass = '';
        switch ($vehicle->status) {
            case 'Active':
                $statusClass = 'status-badge bg-success'; // Green
                break;
            case 'Inactive':
                $statusClass = 'status-badge bg-danger'; // Red
                break;
            case 'In Shop':
                $statusClass = 'status-badge bg-warning text-dark'; // Orange
                break;
            case 'Out of Service':
                $statusClass = 'status-badge bg-secondary'; // Gray
                break;
            case 'Sold':
                $statusClass = 'status-badge bg-primary'; // Blue
                break;
            default:
                $statusClass = 'status-badge bg-light text-dark'; // Default light
        }
    @endphp
    <span class="{{ $statusClass }}">{{ $vehicle->status }}</span>
</td>


                                    <td>{{ $vehicle->ownership }}</td>

                                    <!-- ✅ Pictures -->
                                    <td>
                                        @if(!empty($vehicle->pictures))
                                            @php
                                                $pictures = is_array($vehicle->pictures) 
                                                    ? $vehicle->pictures 
                                                    : json_decode($vehicle->pictures, true);
                                            @endphp
                                            @foreach ($pictures as $pic)
                                                <img src="{{ asset('storage/vehicles/' . $pic) }}" alt="Vehicle Image" width="50">
                                            @endforeach
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    <!-- ✅ Action Dropdown -->
                                    <td>
                                        @if(auth()->user()->role === 'admin')
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="actionMenu{{ $vehicle->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                ⋮
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="actionMenu{{ $vehicle->id }}">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('vehicle.show', $vehicle->id) }}">
                                                        <i class="bi bi-eye"></i> View
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('vehicle.edit', $vehicle->id) }}">
                                                        <i class="bi bi-pencil"></i> Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('vehicle.destroy', $vehicle->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this vehicle?')" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item text-danger" type="submit">
                                                            <i class="bi bi-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- ✅ Custom CSS for Uniform Badges -->
    <style>
        .status-badge {
            display: inline-block;
            min-width: 100px; /* Fixed width */
            text-align: center;
            padding: 6px 10px;
            font-size: 14px;
            font-weight: 600;
            color: #fff;
            border-radius: 6px;
        }
        .bg-warning.text-dark {
            color: #212529 !important;
        }
    </style>
@endsection
