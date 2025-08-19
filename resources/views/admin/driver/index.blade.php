@extends('admin.app')
@section('content')
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb  d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Drivers</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Drivers Table</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a class="btn btn-primary " href="{{ route('driver.create') }}">
                    <i class="bi bi-plus-lg"></i> Add Driver
                </a>
            </div>

        </div>
        <!--end breadcrumb-->
        {{-- <h6 class="mb-0 text-uppercase">DataTable Example</h6> --}}
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive ">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th >ID</th>
                                <th>Employee No</th>
                                <th>First Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Job Title</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($drivers as $driveruser)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $driveruser->driver->employee_no ?? 'N/A' }}</td>
                                    <td>{{ $driveruser->first_name }}</td>
                                    <td>{{ $driveruser->phone }}</td>
                                    <td>{{ $driveruser->email }}</td>
                                    <td>{{ $driveruser->driver->job_title ?? 'N/A' }}</td>
                                   <td class="text-center">
    @if(auth()->user()->role === 'admin') {{-- optional role check --}}
    <div class="dropdown">
        <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="actionMenu{{ $driveruser->id }}" data-bs-toggle="dropdown" aria-expanded="false">
            ⋮
        </button>
        <ul class="dropdown-menu" aria-labelledby="actionMenu{{ $driveruser->id }}">
            <li>
                <a class="dropdown-item" href="{{ route('driver.show', $driveruser->id) }}">
                    <i class="bi bi-eye"></i> View
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('driver.edit', $driveruser->id) }}">
                    <i class="bi bi-pencil"></i> Edit
                </a>
            </li>
            <li>
                <form action="{{ route('driver.destroy', $driveruser->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this driver?')">
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
                     
                    </table>
                </div>
            </div>
        </div>

        </table>
        </div>
        </div>
        </div>
    </main>
@endsection
