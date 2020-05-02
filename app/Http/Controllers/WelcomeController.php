<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){

        return view('welcome');

    }


    public function drivers($country=null){

        return view('drivers');
    }
}
