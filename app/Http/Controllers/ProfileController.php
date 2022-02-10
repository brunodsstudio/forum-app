<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\IndexClass;
use App\Classes\UserProfileClass;
use App\Models\Users;


class ProfileController extends Controller
{
    public $__thisViewAssign;

    public function index() {

        $userProfile  = new UserProfileClass;

        $this->_thisViewAssign['profile'] = $userProfile->selectCurrUserProfile();
        $this->_thisViewAssign['css'] = array("profile.css");
        $this->_thisViewAssign['js'] = array("profile.js");
        return view('pages.profile', $this->_thisViewAssign);
    }

    public function updateProfile(Request $request){



    }

    public function createProfile(){

    }
}
