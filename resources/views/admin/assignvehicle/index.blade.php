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
                <a class="btn btn-primary" href="{{ route('assign_vehicle.create') }}">
                    <i class="bi bi-plus-lg"></i> Assign Vehicle
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
        <th>Assigned Vehicle</th>
        <th>Operator</th>
        <th>Start Date/Time</th>
        <th>End Date/Time</th>
        <th>Starting Odometer</th>
        <th>Ending Odometer</th>
        <th>Comment</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th class="text-center">Action</th>
    </tr>
                        </thead>
                      <tbody>
    @foreach($assignments as $assignment)
        <tr>
            <td class="text-center">{{ $assignment->id }}</td>
            <td>{{ $assignment->vehicle->vin_sn ?? 'N/A' }} [{{ $assignment->vehicle->vehicle_name ?? '' }}]</td>
   <td>{{ $assignment->operator->first_name ?? 'N/A' }}</td>

           <td>
              {{$assignment->start_datetime ?? '-' }}
            </td>
           
              <td>
              {{$assignment->end_datetime ?? '-' }}
            </td>
            <td>{{ $assignment->starting_odometer ?? '-' }}</td>
            <td>{{ $assignment->ending_odometer ?? '-' }}</td>
            <td>{{ $assignment->comment ?? '-' }}</td>
            <td>{{ $assignment->created_at->format('Y-m-d') }}</td>
            <td>{{ $assignment->updated_at->format('Y-m-d') }}</td>
            <td class="text-center">
                <a href="{{ route('assign_vehicle.edit', $assignment->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('assign_vehicle.destroy', $assignment->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
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
