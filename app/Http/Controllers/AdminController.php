<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController
{
    function show(){
        return view('pages.admin-page');
    }
}
