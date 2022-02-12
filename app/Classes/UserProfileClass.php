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


    public function updateCurrUserPicProfile($base64) {
        $user = Auth::user();
       
        $finalResult = DB::update (
                            DB::raw("UPDATE users_profile SET `profile_image` = '$base64'
                                    where `user_id` =  $user->id")
                                    );               
        if($finalResult){
            return true;
        } else {
            return false;
        }
    }

    public function updateCurrUserProfile($arrayPrf) {
        $user = Auth::user();
        $finalResult = DB::update (
                            DB::raw("UPDATE users_profile 
                            SET `site` = '{$arrayPrf['site']}',
                            `phone`= '{$arrayPrf['phone']}',
                            `age` = '{$arrayPrf['age']}',
                            `description` = '{$arrayPrf['description']}'
                                    where `user_id` =  $user->id")
                                    );               
        if($finalResult){
            return true;
        } else {
            return false;
        }
    }

    public function createProfile(){
        $user = Auth::user();

        $Cl = DB::select(
                    DB::raw("Select `user_id` from users_profile where  `user_id` =  $user->id"));

        if(count($Cl) <= 0){
            $finalResult = DB::insert (
                DB::raw("INSERT INTO users_profile(`description`,`user_id`) 
                          VALUES ('Complete seu perfil', $user->id)"
                          ));               
                if($finalResult){
                return true;
                } else {
                return false;
                }
        }           
                                    
    }

    
}