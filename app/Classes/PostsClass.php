<?php

namespace App\Classes;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PostsClass{

    public function selectAllPosts(){
        $user = Auth::user();

        $Cl = DB::select(
                        DB::raw("SELECT * FROM(
                            SELECT post.*, users_profile.profile_image, users.name FROM post 
                            LEFT JOIN users_profile ON post.user_id = users_profile.user_id 
                            LEFT JOIN users ON post.user_id = users.id 
                            WHERE post.user_id = $user->id AND post_type = 'Master' AND status = 1
                            
                            UNION (SELECT post.*, users_profile.profile_image, users.name FROM post 
                            LEFT JOIN users_profile ON post.user_id = users_profile.user_id 
                            LEFT JOIN users ON post.user_id = users.id 
                            WHERE post.user_id = $user->id AND  post_type = 'Edit'  AND STATUS = 1 ORDER BY post.created_at desc LIMIT 1)
                            
                            UNION (SELECT post.*, users_profile.profile_image, users.name FROM post 
                            LEFT JOIN users_profile ON post.user_id = users_profile.user_id 
                            LEFT JOIN users ON post.user_id = users.id 
                            WHERE post.user_id IN(SELECT friend_id FROM users_friends  WHERE user_id = $user->id) AND post_type = 'Master' AND status = 1)
                            
                            UNION (SELECT post.*, users_profile.profile_image, users.name FROM post 
                            LEFT JOIN users_profile ON post.user_id = users_profile.user_id 
                            LEFT JOIN users ON post.user_id = users.id 
                            WHERE post.user_id IN(SELECT friend_id FROM users_friends  WHERE user_id = $user->id) AND  post_type = 'Edit' AND status = 1 ORDER BY post.created_at desc LIMIT 1)
                            
                            ) AS todas ORDER BY todas.created_at desc" 
        ));
        return $Cl;
    }

    public function selectAllPostsCommnents($idPost){
        $user = Auth::user();

        $Cl = DB::select(
                        DB::raw("select cm.*, users_profile.profile_image, users.name FROM comment AS cm 
                        LEFT JOIN users_profile ON cm.user_id = users_profile.user_id 
                        LEFT JOIN users ON cm.user_id = users.id 
                        where post_id = $idPost"));
        return $Cl;

    }

    public function selectSinglePost($id){
            $Cl = false;
            
                $Cl = DB::select(
                    DB::raw("select * from  post WHERE id =" . $id));

                return $Cl;

    }

    public function selectAllPostsViewLikes($idPost){

        $Cl = DB::select(
            DB::raw("SELECT SUM(likes) AS l, SUM(deslikes) AS d, SUM(views) AS v From likeviews WHERE post_id = $idPost"));

        return $Cl;
    }

    public function toggleLikes($idPost, $like = true){
        $user = Auth::user();

        if($like){
            $l = " likes = 1";
            $d = " deslikes = 0";
        }else {
            $l = " likes = 0";
            $d = " deslikes = 1";

        }

        $Cl = DB::select(
            DB::raw("select * likeviews WHERE post_id = $idPost and user_id = $user->id"));

            if(count($Cl) == 0){
                $Cl = DB::insert(
                    DB::raw("insert into likeviews (views, likes, deslikes, port_id, user_id) values
                    (1, 1,0, $idPost, $user->id)"
            ));
                    
            } else {
                $Cl = DB::update(
                    DB::raw("update likeviews set 
                    likes =  $l,
                    deslikes = $d
                    WHERE post_id = $idPost and user_id = $user->id"));
            }
 
    }

    public function showAllPostsTable(){

            $Cl = DB::select(
            DB::raw("SELECT * FROM(
                SELECT post.*, users_profile.profile_image, users.name FROM post 
                LEFT JOIN users_profile ON post.user_id = users_profile.user_id 
                LEFT JOIN users ON post.user_id = users.id 
                WHERE  post_type = 'Master' AND status = 1
                
                UNION (SELECT post.*, users_profile.profile_image, users.name FROM post 
                LEFT JOIN users_profile ON post.user_id = users_profile.user_id 
                LEFT JOIN users ON post.user_id = users.id 
                WHERE post_type = 'Edit'  AND STATUS = 1 ORDER BY post.created_at desc LIMIT 1)
                    ) AS todas ORDER BY todas.created_at desc"));

        return $Cl;

    }

    public function showEdits($post_id){

        $Cl = DB::select(
            DB::raw("SELECT * FROM (
            SELECT * FROM post WHERE master_id = $post_id AND post_type = 'Edit' and status = 1
            UNION (SELECT * FROM post WHERE id = $post_id and status = 1))AS a
            ORDER BY created_at desc
            "));

        return $Cl;
    }

    public function deletePost($id, $type = "Master"){
        $Cl = false;
        if($type == "Edit"){
    
           $Cl = DB::update(
            DB::raw("update post set 
            status =  0
            WHERE master_id =" . $id . " and post_type = 'Edit'"));

          $Cl = DB::update(
            DB::raw("update post set 
            status =  0
            WHERE id =" . $id));
            
        } else {
            $Cl = DB::update(
                DB::raw("update post set 
                status =  0
                WHERE id =" . $id . " and post_type = 'Master'"));
        }
         
            return $Cl;
    }

    public function deleteComment($id){

        $Cl = DB::update(
            DB::raw("update comment set 
            deleted =  1
            WHERE id =" . $id));

            return $Cl;
    }

    public function addComment($description, $post_id, $user_id ){
        $Cl = false;
        $Cl = DB::insert(
            DB::raw("INSERT INTO `comment`
            (description, deleted, created_at, updated_at, user_id, post_id)
            VALUES ('$description', 0, NOW(), NOW(), $user_id, $post_id)"));

            if($Cl){
                $id = DB::select('SELECT LAST_INSERT_ID()');
                return $id;
            } return false;
    }

    public function addPost($description, $title, $img ,  $user_id ){

    
        $Cl = false;
        $Cl = DB::insert(
            DB::raw("INSERT INTO post
            (title, description, `status`, post_image, post_type, master_id, created_at, updated_at, user_id)
            VALUES ('$title', '$description', 1 ,'$img','Master', 0,  NOW() ,  NOW() , $user_id)"));

            if($Cl){
                $id = DB::select('SELECT LAST_INSERT_ID()');
                return $id;
            } return false;
    }

    public function updatePost($array){

        //var_dump($array); die();

        $Cl1 = false;

        if($array['master_id'] == 0){

            $master_id = $array['id'];
            $Cl1 = DB::update(
                DB::raw("update post set post_type = '' where id = '$master_id' "));
        } else {
            $master_id = $array['master_id'];
        }
        
        $Cl2 = false;
        $Cl2 = DB::insert(
            DB::raw("INSERT INTO post
            (title, description, `status`, post_image, post_type, master_id, created_at, updated_at, user_id)
            VALUES ('{$array['title']}', '{$array['description']}', 1 ,'{$array['post_image']}','Edit', $master_id,  NOW() ,  NOW() , {$array['user_id']})"));

            if($Cl1 && $Cl2){
                return true;
            }return false;


    }





    



}