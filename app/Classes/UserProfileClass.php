<?php

namespace App\Classes;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class UserProfileClass{

    public function selectCurrUserProfile() {
        
        $user = Auth::user();

        $Cl = DB::select(
                        DB::raw("SELECT * FROM users_profile AS up
                        left JOIN users AS u
                        ON up.user_id = u.id 
                        where u.id = ". $user->id 
        ));
        return $Cl;
    }
}