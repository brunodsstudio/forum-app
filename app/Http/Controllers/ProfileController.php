<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\IndexClass;
use App\Classes\UserProfileClass;
use App\Models\Users;
use App\Models\Comment;
use App\Models\users_profile;


class ProfileController extends Controller
{
    public $__thisViewAssign;

    public function index() {

        $userProfile  = new UserProfileClass;
        $createNew = $userProfile->createProfile();

        //var_dump(users_profile::find(1));

        $this->_thisViewAssign['profile'] = $userProfile->selectCurrUserProfile();
        $this->_thisViewAssign['css'] = array("profile.css");
       $this->_thisViewAssign['js'] = array("profile.js");
        return view('pages.profile', $this->_thisViewAssign);
    }

    public function updateProfile(Request $request){

        $data = $request->all();
            //var_dump( $data);
            $userProfile  = new UserProfileClass;
            $result = $userProfile->updateCurrUserProfile($data);

            if($result) echo "foiu";
            die();
    }

    public function createProfile(){

    }

    public function uploadPicProfile(Request $request){
    
            //var_dump($_FILES['file']['name']); die();

            if($request->hasFile('files')){
                $image = $request->file('files');
                $image_name = $image->getClientOriginalName();
                $image->move(public_path('/images/profilePics'),$image_name);
            
                $image_path = "/images/profilePics/" . $image_name;

               $userProfile  = new UserProfileClass;
              $insert = $userProfile->updateCurrUserPicProfile($image_path);
              echo "<img class='img-fluid img-account-profile rounded-circle mb-2' style='max-height:400px' src='".$image_path."'>";
            } else {
                echo "não tem";
            }

            die();
    
            }
}
