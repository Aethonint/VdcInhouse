@extends('admin.app')
@section('content')
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb  d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Tables</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Data Table</li>
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
                <div class="table-responsive">
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
                                    <td class="text-center  ">
                                        <!-- Example actions -->
                                        <a href="{{ route('driver.show', $driveruser->id) }}"
                                            class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('driver.edit', $driveruser->id) }}"
                                            class="btn custom-btn-success btn-sm">Edit</a>
                                        <form action="{{ route('driver.destroy', $driveruser->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this driver?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Employee No</th>
                                <th>First Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Job Title</th>
                                <th>Action</th>
                            </tr>


                        </tfoot>
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
