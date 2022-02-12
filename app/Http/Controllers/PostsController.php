<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\UserProfileClass;
use App\Classes\PostsClass;
use App\Classes\IndexClass;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PostsController extends Controller
{
    public $__thisViewAssign;

    public function index() {

        $idx = new IndexClass();
        $user = Auth::user();


        $userProfile  = new UserProfileClass;
        $createNew = $userProfile->createProfile();

        $posts = new PostsClass();
        $allPosts = $posts->selectAllPosts();
        

        for($x = 0; $x <= count($allPosts) -1; $x++){ 
            $comm = $posts->selectAllPostsCommnents($allPosts[$x]->id);
            $allPosts[$x]->comments = array();
            if(count($comm)> 0){
                foreach($comm as $cn){
                    $allPosts[$x]->comments[] = $cn;
                }
            }

            $likeseslikesviews = $posts->selectAllPostsViewLikes($allPosts[$x]->id);
            $allPosts[$x]->ldv = $likeseslikesviews;

            if($user->id == $allPosts[$x]->user_id){
                $allPosts[$x]->deletePost = true;
            } else {
                $allPosts[$x]->deletePost = false;
            }
       

        }
        //$idx->preit($allPosts, true);


        $this->_thisViewAssign = array();
        $this->_thisViewAssign['css'] = array("posts.css");
        $this->_thisViewAssign['js'] = array("posts.js");
        $this->_thisViewAssign['profile'] = $userProfile->selectCurrUserProfile();
        $this->_thisViewAssign['posts'] = $allPosts;

        return view('pages.post', $this->_thisViewAssign);
    }

    public function addComment(Request $request){
        $idx = new IndexClass();
        $user = Auth::user();

        $userProfile  = new UserProfileClass;
        $posts = new PostsClass();
        $res = $posts->addComment($request->description, $request->post_id, $request->user_id);

        Mail::raw('Você recebeu um comentário em sua postagem de '. $user->name, function($msg) {
            $msg->from('example@example.com', 'Novo Comentário');
            $msg->to('imprensa@aeranerd.com.br')->subject('Você recebeu um comentário em sua postagem'); 
            
            });
        
        if($res){
            echo "<script>document.location.reload(true);</script>";
        }
    }

    public function deleteComment(Request $request){
        $idx = new IndexClass();
        $user = Auth::user();

        $userProfile  = new UserProfileClass;
        $posts = new PostsClass();
        $res = $posts->deleteComment($request->id);
        
        if($res){
            echo "Comment deleted sucessfully!";
        }

    }

    public function addPost(Request $request){

       // var_dump($request->all()); die();
       $user = Auth::user();
       $posts = new PostsClass();


        if($request->hasFile('files')){
            $image = $request->file('files');
            $image_name = $image->getClientOriginalName();
            $image->move(public_path('/images/PostImages'),$image_name);
        
            $image_path = "/images/PostImages/" . $image_name;
            
            $lastIsert = $posts->addPost($request->description, $request->title, $image_path , $user->id);

            if($lastIsert){
                echo "<script>document.location.reload(true);</script>";
            }

          // $userProfile  = new UserProfileClass;
          //$insert = $userProfile->updateCurrUserPicProfile($image_path);
          //echo "<img class='img-fluid img-account-profile rounded-circle mb-2' style='max-height:400px' src='".$image_path."'>";
        } else {
            echo "não tem";
        }



    }

    public function deletePost(Request $request){
        $idx = new IndexClass();
        $user = Auth::user();

        $userProfile  = new UserProfileClass;
        $posts = new PostsClass();
        $res = $posts->deletePost($request->post_id, $request->type);
        
        if($res){
            echo "Post deleted sucessfully!";
        }

    }

    public function editPost(Request $request){

        $idx = new IndexClass();
        $user = Auth::user();
        $posts = new PostsClass();
        $info = $posts->selectSinglePost($request->id);

        $forms = '<form id="editPostForm" method="POST" enctype="multipart/form-data" name="editPostForm">
                    <input type="hidden" id="id" value="'. $info[0]->id . '" name="id">
                    <input type="hidden" id="master_id" value="'. $info[0]->master_id . '" name="master_id">
                    <input type="hidden" id="posttype" value="'. $info[0]->post_type . '" name="posttype">
                    <input type="hidden" id="post_image" value="'. $info[0]->post_image . '" name="post_image">
                    <input type="hidden" id="user_id" value="'. $info[0]->user_id . '" name="user_id">
                    <input type="text" class="form-control" placeholder="Title" id="" value="'. $info[0]->title . '" name="title" style="min-height:20px"/>
                    
                    <textarea class="form-control" placeholder="Whats in your mind?" name="description" style="height:200px">'. $info[0]->description .'</textarea>
                 </form>';

        echo $forms;

    }

    public function updatePost(Request $request){

        $idx = new IndexClass();
        $user = Auth::user();
        $posts = new PostsClass();
    
        $res = $posts->updatePost($request->all());

        if($res){
            echo "<script>document.location.reload(true);</script>";
        }
        //var_dump( $request->all());
        

    }



    public function likePost(Request $request){

        $pd = explode("_", $request->POSTID);
    

        $posts = new PostsClass();
        $posts->toggleLikes($pd[1], true);


        $likeseslikesviews = $posts->selectAllPostsViewLikes($allPosts[$x]->id);

        $ret = '<a class="btn text-green"><i class="fa fa-eye"></i>';

                    if($p->ldv[0]->v == ""){
                    $ret .= "0";
                    } else { 
                    //$p->ldv[0]->v
                    }

                    $ret = ' </a> <a class="btn text-green"><i class="fa fa-thumbs-up"></i>';
                    if($p->ldv[0]->l == ""){ 
                       $ret .= "0";
                    }else{
                   // $p->ldv[0]->l
                    }


                    $ret = '</a><a class="btn text-red"><i class="fa fa-thumbs-down"></i>';
                    if($p->ldv[0]->d == ""){
                     $ret .= "0"; 
                    } else {
                   //$p->ldv[0]->d
                    }
                    $ret .= '</a>';
    }

    public function showPostHistory(Request $request){

        $idx = new IndexClass();
        $user = Auth::user();

        $userProfile  = new UserProfileClass;
        $posts = new PostsClass();
        $allPosts = $posts->showEdits($request->post_id);

        if(count($allPosts) > 0){
            $edit = array();
            $tb = "<table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Created_at</th>
                        </tr>
                    <thead>";

            foreach($allPosts as $aP){
                $tb .= "<tbody><tr>";           
                $tb .= "<td>" . $aP->title . "</td>";
                $tb .= "<td>" . $aP->description . "</td>";
                $tb .= "<td>" . $aP->created_at . "</td>";
                $tb .=  "</tr></tbody>";
            }
            $tb .=  "</table>";
            echo $tb;
        } else {
            echo "no editings";
        }
         

    }

    public function allPostsTable(){
        $idx = new IndexClass();
        $user = Auth::user();


        $userProfile  = new UserProfileClass;
        $posts = new PostsClass();
        $allPosts = $posts->showAllPostsTable();

        for($x = 0; $x <= count($allPosts) -1; $x++){ 
            $comm = $posts->selectAllPostsCommnents($allPosts[$x]->id);
            $allPosts[$x]->comments = count($comm);

            $likeseslikesviews = $posts->selectAllPostsViewLikes($allPosts[$x]->id);
            $allPosts[$x]->ldv = $likeseslikesviews;

            if($user->id == $allPosts[$x]->user_id){
                $allPosts[$x]->deletePost = true;
            } else {
                $allPosts[$x]->deletePost = false;
            }
        }

      //  $idx->preit($allPosts, true);


        $this->_thisViewAssign = array();
        $this->_thisViewAssign['css'] = array("posts.css");
        $this->_thisViewAssign['js'] = array("posts.js");
        $this->_thisViewAssign['profile'] = $userProfile->selectCurrUserProfile();
        $this->_thisViewAssign['posts'] = $allPosts;

        return view('pages.allPostTable', $this->_thisViewAssign);



    }





    
}
