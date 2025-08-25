@extends('admin.app')
@section('content')
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Incidents</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}"><i class="bi bi-exclamation-triangle"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Incident Table</li>
                </ol>
            </nav>
        </div>
        {{-- <div class="ms-auto">
            <a class="btn btn-primary" href="{{ route('incident.create') }}">
                <i class="bi bi-plus-lg"></i> Add Incident
            </a>
        </div> --}}
    </div>
    <!--end breadcrumb-->

    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Vehicle Number</th>
                            <th>Driver ID</th>
                            {{-- <th>Assignment ID</th> --}}
                            <th>Date</th>
                            {{-- <th>Status</th> --}}
                           
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($incidents as $incident)
                        <tr>
                            <td  class="text-center">{{ $loop->iteration }}</td>
                          <td>{{ $incident->assignment->vehicle->vin_sn ?? 'N/A' }}</td>
                          <td>{{ $incident->user->first_name ?? 'N/A' }}</td>
                            {{-- <td>{{ $incident->assignment_id }}</td> --}}
                            <td>{{ \Carbon\Carbon::parse($incident->incident_date)->format('d M Y') }}</td>
                            {{-- <td>{{ ucfirst($incident->status ?? 'pending') }}</td> --}}
                          
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="actionMenu{{ $incident->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        ⋮
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="actionMenu{{ $incident->id }}">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('incident.show', $incident->id) }}">
                                                <i class="bi bi-eye"></i> View
                                            </a>
                                        </li>
                                          <li>
                                            <a class="dropdown-item" href="{{ route('incident.edit', $incident->id) }}">
                                                <i class="bi bi-eye"></i> Edit
                                            </a>
                                        </li>
                                      
                                        <li>
                                            <form action="{{ route('incident.destroy', $incident->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this incident?')" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item text-danger" type="submit">
                                                    <i class="bi bi-trash"></i> Delete
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                   
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
