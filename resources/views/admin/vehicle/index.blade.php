@extends('admin.app')
@section('content')
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb  d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Vehicles</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Vehicle Table</li>
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
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>VIN/SN</th>
                                <th>Vehicle Name</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Ownership</th>
                                <th>Pictures</th>
                                <th>Note</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicles as $vehicle)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $vehicle->vin_sn }}</td>
                                    <td>{{ $vehicle->vehicle_name }}</td>
                                    <td>{{ $vehicle->type }}</td>
                                    <td>{{ $vehicle->status }}</td>
                                    <td>{{ $vehicle->ownership }}</td>
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
                                    <td>{{ $vehicle->note }}</td>
                                    <td>{{ $vehicle->created_at }}</td>
                                    <td>{{ $vehicle->updated_at }}</td>
                                    <td class="text-center">
                                        {{-- <a href="{{ route('vehicle.show', $vehicle->id) }}" class="btn btn-info btn-sm">View</a> --}}
                                        <a href="{{ route('vehicle.edit', $vehicle->id) }}" class="btn custom-btn-success btn-sm">Edit</a>
                                        <form action="{{ route('vehicle.destroy', $vehicle->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this vehicle?')">
                                                Delete
                                            </button>
                                        </form>
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
@endsection
