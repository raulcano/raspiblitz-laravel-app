<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainMenuController extends Controller
{
    public function index(){
        return view('main');
    }

    public function home(){
        return view('home');
    }
}
