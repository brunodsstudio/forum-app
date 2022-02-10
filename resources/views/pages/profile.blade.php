@extends('layouts.index')
@section('contentSection1')
<div class="container">
    <div class="row">
    <div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
   
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-fluid img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
                    <div class="form-group">
                      
                        <input id="sortpicture" class="form-control-file" type="file" name="sortpic" />
                        <button class="btn btn-primary" type="button" id="upload">Upload</button>
                    </div>
                   
                </div>
            </div>
        </div>

     
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    <form>
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Username (how your name will appear to other users on the site)</label>
                            <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username" value="{{$profile[0]->name}}">
                        </div>
                   
                        
                        <!-- Form Row        -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (organization name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputOrgName">Quote</label>
                                <input class="form-control" id="inputOrgName" type="text" placeholder="Enter your organization name" value="{{$profile[0]->description}}">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputSite">Site</label>
                                <input class="form-control" id="inputSite" type="text" name="Site" placeholder="Enter your Site" value="{{$profile[0]->site}}">
                            </div>
                           
                        </div>
                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email address</label>
                            <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="{{$profile[0]->email}}">
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone number</label>
                                <input class="form-control" id="inputPhone" type="tel" placeholder="Enter your phone number" value="{{$profile[0]->phone}}">
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Age</label>
                                <input class="form-control" id="inputBirthday" type="text" name="age" placeholder="Enter your age" value="{{$profile[0]->age}}">
                            </div>
                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="button">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</div>
@endsection