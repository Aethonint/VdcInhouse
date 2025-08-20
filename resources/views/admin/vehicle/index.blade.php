@extends('admin.app')
@section('content')
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb  d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Vehicle</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
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
                                   
                                 
                                  <td class="text-center">
    @if(auth()->user()->role === 'admin') {{-- Optional role check --}}
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
@endsection
