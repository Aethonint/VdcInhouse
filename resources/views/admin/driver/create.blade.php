@extends('admin.app')

@section('content')
    <main class="page-content">
        <div class=" justify-content-center">
            <div class="col-12  ">
                <div class="card  shadow  rounded-card">
                    <div class="card-body bg-white p-4 rounded-card  ">
                        <h2 class="card-title mb-3">Drivers</h2>

                        {{-- <p class="text-muted mb-4">Update your account's profile information and email address.</p> --}}

                        {{-- Email Verification Form --}}


                        {{-- Profile Update Form --}}
                        <form method="POST" action="{{route('driver.store')}}">
                            @csrf


                           <div class="row">
    <div class="mb-3 col-md-6">
        <label>First Name</label>
        <input type="text" name="first_name" class="form-control" required>
    </div>
    <div class="mb-3 col-md-6">
        <label>Last Name (Optional)</label>
        <input type="text" name="last_name" class="form-control">
    </div>
    <div class="mb-3 col-md-6">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
        <div class="mb-3 col-md-6">
        <label>Phone</label>
        <input type="phone" name="phone" class="form-control" required>
    </div>
    
</div>

<h5>Classifications</h5>
<div class="mb-3">
    <label><input type="radio" name="classification" value="operator" required> Operator</label>
    <label><input type="radio" name="classification" value="employee"> Employee</label>
    <label><input type="radio" name="classification" value="technician"> Technician</label>
</div>


<h5>Personal Details</h5>
<div class="row">
    <div class="mb-3 col-md-6">
        <label>Job Title</label>
        <input type="text" name="job_title" class="form-control" required>
    </div>
    <div class="mb-3 col-md-6">
        <label>Date of Birth</label>
        <input type="date" name="dob" class="form-control" required>
    </div>
   
    <div class="mb-3 col-md-6">
        <label>Start Date</label>
        <input type="date" name="start_date" class="form-control" required>
    </div>
    <div class="mb-3 col-md-6">
        <label>End Date</label>
        <input type="date" name="end_date" class="form-control">
    </div>
    <div class="mb-3 col-md-6">
        <label>License Number (Optional)</label>
        <input type="text" name="license_number" class="form-control">
    </div>
     <div class="mb-3 col-md-6">
        <label>Employee No</label>
        <input type="text" name="employee_no" class="form-control" required>
    </div>
    
    <div class="mb-3 col-md-6">
        <label>Hourly Rate</label>
        <input type="number" step="0.01" name="hourly_rate" class="form-control" required>
    </div>
    <div class="mb-3 col-md-6">
    <label>Password</label>
    <input type="text" name="password" id="password" class="form-control" readonly required>
</div>

     <div class="mb-3 ">
        <label>Address</label>
        <textarea type="text" name="address" class="form-control" required ></textarea>
    </div>
</div>




                            <div class="d-flex justify-content-start align-items-center gap-5 ">
                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                <a type="submit" class="btn btn-outline-danger mt-3">Cancel</a>


                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>


        @push('scripts')
        @endpush
    @endsection
