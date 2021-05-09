<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AutocompleterController extends Controller
{
    public function index(){
      return view('autocompleter', [
          'title' => 'Autocompleter',
          'menu' => 'autocompleter'
        ]);
    }
}
