@extends('layouts.index')
@section('contentSection1')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">

<div class="row">

        <div class="col-md-offset-3 col-md-8 col-xs-12">
            <div class="well well-sm well-social-post">
        <form>
            <ul class="list-inline" id='list_PostActions'>
                <li class='active'><a href='#'>Update status</a></li>
                <li><a href='#'>Add photos</a></li>
      
            </ul>
            <textarea class="form-control" placeholder="What's in your mind?"></textarea>
            <ul class='list-inline post-actions'>
                <li><a href="#"><span class="glyphicon glyphicon-camera"></span></a></li>
                <li><a href="#" class='glyphicon glyphicon-user'></a></li>
                <li><a href="#" class='glyphicon glyphicon-map-marker'></a></li>
                <li class='pull-right'><a href="#" class='btn btn-primary btn-xs'>Post</a></li>
            </ul>
        </form>
            
    </div>
</div>   
</div>
    <div class="row">
        <div class="col-md-8">
            <div class="post-content">
              <img src="https://via.placeholder.com/400x150/FFB6C1/000000" alt="post-image" class="img-responsive post-image">
              <div class="post-container">
                <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="user" class="profile-photo-md pull-left">
                <div class="post-detail">
                  <div class="user-info">
                    <h5><a href="timeline.html" class="profile-link">Alexis Clark</a> <span class="following">following</span></h5>
                    <p class="text-muted">Published a photo about 3 mins ago</p>
                  </div>
                  <div class="reaction">
                    <a class="btn text-green"><i class="fa fa-thumbs-up"></i> 13</a>
                    <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 0</a>
                  </div>
                  <div class="line-divider"></div>
                  <div class="post-text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <i class="em em-anguished"></i> <i class="em em-anguished"></i> <i class="em em-anguished"></i></p>
                  </div>
                  <div class="line-divider"></div>
                  <div class="post-comment">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="" class="profile-photo-sm">
                    <p><a href="timeline.html" class="profile-link">Diana </a><i class="em em-laughing"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud </p>
                  </div>
                  <div class="post-comment">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="profile-photo-sm">
                    <p><a href="timeline.html" class="profile-link">John</a> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud </p>
                  </div>
                  <div class="post-comment">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="profile-photo-sm">
                 
                    <textarea class="form-control" id="textAreaExample1" style="height:40px" placeholder="Post a comment"></textarea>
                    <button type="submit" class="btn btn-primary mb-2" style="height:40px; margin-top:8px">Send</button>
                     
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection