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
            {{-- <div class="ms-auto">
                <a class="btn btn-primary " href="{{ route('driver.create') }}">
                    <i class="bi bi-plus-lg"></i> Add Driver
                </a>
            </div> --}}

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
                                <th>Driver Name</th>
                                <th>Vehicle Id</th>
                                <th>Assingment Id</th>
                                 <th>Status</th>
                                <th>Created_at</th>
                         <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($defects as $defect)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                     <td>{{ $defect->user->first_name }}</td>
                                        <td>{{ $defect->assignment->vehicle->vin_sn ?? 'N/A' }}</td>
                                    <td>{{ $defect->assignment->id ?? 'N/A' }}</td>
<td>
    @if(auth()->user()->role === 'admin')
        <form action="{{ route('defects.updateStatus', $defect->id) }}" method="POST" class="status-form">
            @csrf
            @method('PATCH')
            <select name="status" class="form-select form-select-sm status-select" data-current="{{ $defect->status }}">
                @php
                    $statuses = ['Created', 'In Progress', 'Clear'];
                @endphp
                @foreach($statuses as $status)
                    <option value="{{ $status }}" {{ $defect->status === $status ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
        </form>

        <script>
            document.querySelectorAll('.status-select').forEach(select => {
                select.addEventListener('change', function(e) {
                    const newStatus = this.value;
                    if (confirm(`Are you sure you want to change status to "${newStatus}"?`)) {
                        this.form.submit(); // submit only if confirmed
                    } else {
                        // Reset to previous value if cancelled
                        this.value = this.getAttribute('data-current');
                    }
                });
            });
        </script>
    @else
        {{ $defect->status }}
    @endif
</td>



                                         <td>{{ $defect->created_at ?? 'N/A' }}</td>
                                   
                                    <td class="text-center  ">
                                        <!-- Example actions -->
                                        <a href="{{ route('defects.show', $defect->id) }}"
                                            class="btn btn-info btn-sm">View</a>
                                        
                                        <form action="{{ route('defects.destroy', $defect->id) }}" method="POST"
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
