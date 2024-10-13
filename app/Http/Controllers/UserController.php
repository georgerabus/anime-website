<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController
{
    public function editUser(){
        return view('pages.profile');
    }
}
