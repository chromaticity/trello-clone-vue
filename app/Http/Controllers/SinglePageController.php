<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SinglePageController extends Controller
{
    //
    public function index()
    {
    	// our entire app will be essentially contained in this view.
        return view("index");
    }
}
