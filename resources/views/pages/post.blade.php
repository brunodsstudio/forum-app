@extends('layouts.index')
@section('contentSection1')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
    
  <div class="row">
    <div class="col-md-2 col-xs-12">
        <img class="img-fluid img-account-profile rounded-circle mb-2" style='max-height:400px' src="{{$profile[0]->profile_image}}" alt="">
        <center><H2>{{$profile[0]->name}}</H2></center>
    </div>

    <div class="col-md-8 col-xs-12" >
        <div class="well well-sm well-social-post">
          
            <ul class="list-inline" id='list_PostActions'>
                <li class='active'><a href='#'>Update status</a></li>
                <li><a href='#'>Add photos</a></li>

            </ul>
            <form id="fileUploadPostForm" method="POST" enctype="multipart/form-data" name="fileUploadPostForm">
                <input type="text" class="form-control" placeholder="Title" id="" name="title" style="min-height:20px"/>
                <hr>
                <textarea class="form-control" placeholder="What's in your mind?" name="description" style="height:40px"></textarea>
                <input type="file" class="form-control-file" name="files"/>
            </form>
            <ul class='list-inline post-actions'>
                <!-- <li><a href="#"><span class="glyphicon glyphicon-camera"></span></a></li>
                <li><a href="#" class='glyphicon glyphicon-user'></a></li>
                <li><a href="#" class='glyphicon glyphicon-map-marker'></a></li>-->
                <li class='pull-right'><a href="#" class='btn btn-primary btn-lg' id="btnSubmitFormProfile">Let's Post </a></li>
            </ul> 
         
        </div>
      
      @foreach($posts as $p)
        <div class="post-content" id="post{{$p->id}}">
              <img src="{{$p->post_image}}" alt="post-image" class="img-responsive post-image">
              <div class="post-container">
                <img src="{{$p->profile_image}}" alt="user" class="profile-photo-md pull-left">
                
                <div class="post-detail">
                <h1>{{$p->title}} | <i onclick="myFunction(this)" class="fa fa-thumbs-up" postId ="post_{{$p->id}}"></i></h1>
                
                
                  <div class="user-info">
                    <h5><a href="timeline.html" class="profile-link">{{$p->name}}</a> <span class="following">following</span></h5>
                    <p class="text-muted">{{$p->created_at}}</p>
                  </div>
                  <div class="reaction" id="react{{$p->id}}">
                    <a class="btn text-green"><i class="fa fa-eye"></i> 
                    @if($p->ldv[0]->v == "")
                    0
                    @else
                    {{$p->ldv[0]->v}}
                    @endif
                    </a>
                    <a class="btn text-green"><i class="fa fa-thumbs-up"></i> 
                    @if($p->ldv[0]->l == "")
                    0
                    @else
                    {{$p->ldv[0]->l}}
                    @endif</a>
                    <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 
                    @if($p->ldv[0]->d == "")
                    0
                    @else
                    {{$p->ldv[0]->d}}
                    @endif</a>
                  </div>
           
                  <div class="line-divider"></div>
                  <div class="post-text">
                    <p>{{$p->description}}<i class="em em-anguished"></i> <i class="em em-anguished"></i> <i class="em em-anguished"></i></p>
                  </div>
                  <div class="line-divider"></div>

                <div id="comentarios{{$p->id}}">
                  @foreach($p->comments as $cm)

                  @php
                    if($cm->deleted == 1){
                      $contentCom = "Comment Deleted!";
                      $buttonstyle = "style='display:none; height:30px'";
                    } else{
                      $contentCom = $cm->description;
                      $buttonstyle = "";
                    }
                  @endphp


                  <div class="post-comment">
                    <img src="{{$cm->profile_image}}" alt="" class="profile-photo-sm">
                    <p><a href="javascript:void(0)" class="profile-link"> {{$cm->name}} </a>
                        <i class="em em-laughing"></i> 
                       <div id="cm{{$cm->id}}"> {{$contentCom}} </div>
                    </p> &nbsp;&nbsp;

                    @if($profile[0]->id == $p->user_id OR $profile[0]->id == $cm->user_id)
                      <button class="btn btn-primary" type="button" id="delete"  {!!$buttonstyle!!} onclick="deleteComment({{$cm->id}})" >
                      <i class="fa fa-trash"></i>
                      </button>
                    @endif
                  </div>
                  @endforeach
                </div>
                  
                  <div class="post-comment">
   
                    <img src="{{$profile[0]->profile_image}}" alt="" class="profile-photo-sm">                    
                    <textarea class="form-control" style="height:40px" placeholder="Post a comment" id="textarea{{$p->id}}"></textarea>
                    <button type="submit" class="btn btn-primary mb-2" style="height:40px; margin-top:8px" onclick="addComment('textarea{{$p->id}}', {{$profile[0]->id}}, {{$p->id}})">Send</button>
                    
               
                  </div>


                </div>

                @php
                  if($p->post_type == "Master"){
                    $id = $p->id;
                  }else {
                    $id = $p->master_id;
                  }
                @endphp
                
                @if($profile[0]->id == $p->user_id)
                <button class="btn btn-danger" type="button" id="delete" style="height:30px; margin-right:10px" onclick="deletePost({{$id}},'{{$p->post_type}}', 'post{{$p->id}}')" ><i class="fa fa-trash"></i> Delete This Post</button>
                <button class="btn btn-success" type="button"  style="height:30px; margin-right:10px" data-toggle="modal" data-target="#EdicaoPost" data-postid="{{$p->id}}"  data-posttype="{{$p->post_type}}" data-id="{{$p->id}}"><i class="fa fa-file"></i> Update This Post</button>
                @endif
                <button type="button" class="btn btn-primary" onclick="showEditins({{$p->master_id}})">
                  Editing History
                </button>
                
              </div>
             
              <br>
            </div>
      @endforeach
      <div id="resultInserts" ></div>
    </div>

    <div class="col-md-2 col-xs-12">
    </div>
</div>
 <!--  ////////////////////////////////////////////////////////////////////////////////// -->

 <!-- Modal -->
<div class="modal fade" id="historicoEdicao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div id="modalContent"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="EdicaoPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Postagem</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div id="modalContentPost"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="updatePost('editPostForm')">Save changes</button>
      </div>
    </div>
  </div>
</div>


@endsection