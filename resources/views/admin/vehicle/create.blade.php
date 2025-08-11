@extends('admin.app')

@section('content')
    <main class="page-content">
        <div class=" justify-content-center">
            <div class="col-12  ">
                <div class="card  shadow  rounded-card">
                    <div class="card-body bg-white p-4 rounded-card  ">
                        <h2 class="card-title mb-3">Vehicles</h2>

                        {{-- <p class="text-muted mb-4">Update your account's profile information and email address.</p> --}}

                        {{-- Email Verification Form --}}


                        {{-- Profile Update Form --}}
                        <form method="POST" action="">
                            @csrf


                            <div class="row">
                                <div class="mb-3 col-md-6 ">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control"
                                        placeholder="Enter Your First Name" value="" required>
                                    @error('first_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3  col-md-6">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control"
                                        placeholder="Enter Your Last Name" value="" required>
                                    @error('last_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>


                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control" value=""
                                        required placeholder="+44 ____ ___ ___">
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
