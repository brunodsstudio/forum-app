<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public $__thisViewAssign;

    public function index() {

        $this->_thisViewAssign = array();
        $this->_thisViewAssign['css'] = array("posts.css");
        $this->_thisViewAssign['js'] = array("posts.js");

        return view('pages.post', $this->_thisViewAssign);
    }

    
}
