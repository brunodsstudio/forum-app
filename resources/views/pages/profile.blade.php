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
                    <div id="response">
                        <img class="img-fluid img-account-profile rounded-circle mb-2" style='max-height:400px' src="{{$profile[0]->profile_image}}" alt="">
                    </div>
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
                    <div class="form-group">

                        <form method="POST" enctype="multipart/form-data" id="fileUploadForm">
                            <input type="file" class="form-control-file" name="files"/><br/><br/>
                            <input type="submit" class="btn btn-primary" value="Send Pic" id="btnSubmit"/>
                        </form>
                    </div>
                   
                </div>
            </div>
        </div>

     
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" id="profileForm">
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Username (how your name will appear to other users on the site)</label>
                            <input class="form-control" id="inputUsername" readonly type="text" name="name" placeholder="Enter your username" value="{{$profile[0]->name}}">
                        </div>
                   
                        <!-- Form Row        -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (organization name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputOrgName">Quote</label>
                                <input class="form-control" id="inputOrgName" type="text" name="description" placeholder="Enter your quote" value="{{$profile[0]->description}}">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputSite">Site</label>
                                <input class="form-control" id="inputSite" type="text" name="site" placeholder="Enter your Site" value="{{$profile[0]->site}}">
                            </div>
                           
                        </div>
                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email address</label>
                            <input class="form-control" id="inputEmailAddress" readonly  name="email" type="text" placeholder="Enter your email address" value="{{$profile[0]->email}}">
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone number</label>
                                <input class="form-control" id="inputPhone" type="text" name="phone" placeholder="Enter your phone number" value="{{$profile[0]->phone}}">
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Age</label>
                                <input class="form-control" id="inputBirthday" type="text" name="age" placeholder="Enter your age" value="{{$profile[0]->age}}">
                            </div>
                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="submit" id="btnSubmitProfile">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</div>

<div id="response2"></div>

<!-- <form name="FRWFSDE" action="/uploadPicProfile" method="post" enctype='multipart/form-data'>
@csrf
<input  type="file" name="fileUpload" class="form-control-file" accept="image/*"  />
<INPUT type="SUBMIT">
</form> -->
@endsection