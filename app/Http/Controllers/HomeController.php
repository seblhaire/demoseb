<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
      return view('home', [
          'menu' => 'home'
      ]);
    }

    public function cv(){
      return view('cv', [
          'menu' => 'cv'
      ]);
    }

    public function publis(){
      return view('publis', [
          'menu' => 'publis'
      ]);
    }
}
