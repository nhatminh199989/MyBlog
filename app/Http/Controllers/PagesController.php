<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $var = "Trying to pass data to view";
        return view('pages.index',compact('var'));
    }

    public function about(){
        return view('pages.about');
    }

}
