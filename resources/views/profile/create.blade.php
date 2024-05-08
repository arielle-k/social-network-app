@extends('layouts.app')
@section('content')
<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders " >
        <a class="nav-link active ms-0" href="#" >Profile</a>
    </nav>
    <hr class="mt-0 mb-4">
    <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
    <div class="row">
        <div class="col-xl-4">


            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2" src="" alt="" class="img-fluid img-thumbnail" width="70px">
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
                    <input type="file" name="avatar">
                </div>
            </div>
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Biographie</div>

                    <textarea class="form-control" name="biography" id="" cols="30" rows="10"></textarea>
            </div>

        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">


                        <!-- Form Row        -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (organization name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputOrgName">Gender</label>
                               <select name="gender" id="" class="form-control">
                                <option value="female">Female</option>
                                <option value="male">Male</option>
                               </select>
                            </div>
                            <!-- Form Group (location)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLocation">Location</label>
                                <input class="form-control" id="inputLocation" type="text" placeholder="Enter your location"  name="address">
                            </div>
                        </div>
                        <!-- Form Group (email address)-->

                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone number</label>
                                <input class="form-control" id="inputPhone" type="tel" placeholder="Enter your phone number"  name="phone">
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Birthday</label>
                                <input class="form-control" id="inputBirthday" type="text" name="dob" placeholder="Enter your birthday" >
                            </div>
                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-info" type="submit">Create </button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
