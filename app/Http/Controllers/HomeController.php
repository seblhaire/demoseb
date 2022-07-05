<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
      return view('home', [
          'mainmenu' => $this->mainmenu->setCurrent('home-topmenu'),
          'rightmenu' => $this->rightmenu,
      ]);
    }

    public function cv(){
      return view('cv', [
          'mainmenu' => $this->mainmenu->setCurrent('cv-topmenu'),
          'rightmenu' => $this->rightmenu,
      ]);
    }

    public function publis(){
      return view('publis', [
          'mainmenu' => $this->mainmenu->setCurrent('publis-topmenu'),
          'rightmenu' => $this->rightmenu,
      ]);
    }
}
