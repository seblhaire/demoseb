<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TagsinputController extends Controller
{
  public function index()
  {
    return view('tagsinput', [
      'title' => 'Tags input',
      'menu' => 'tagsinput',
    ]);
  }
}
