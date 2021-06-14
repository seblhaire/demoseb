<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Seblhaire\Autocompleter\AutocompleterHelper;
use App\Models\Tablecontent;
use \Seblhaire\Autocompleter\Utils;


// https://www.tutorialspoint.com/how-to-create-an-autocomplete-with-javascript
// https://www.w3schools.com/howto/howto_js_autocomplete.asp

class AutocompleterController extends Controller
{
    public function index(){
      $ac = AutocompleterHelper::init(
        'autocompleter1',
        route('autocompletesearch'),
        [
          'csrfrefreshroute' => route('refreshcsrf'),
          'callback' => 'output',
          'label' => 'Employee'
        ]
      );
      return view('autocompleter', [
          'title' => 'Autocompleter',
          'menu' => 'autocompleter',
          'ac' => $ac,
        ]);
    }

    public function search(Request $request){
      $validated = $request->validate([
        'search' => 'required|string',
        'maxresults' => 'required|numeric|min:3'
      ]);
      $users = Tablecontent::where('lastname', 'like', '%' . $request->input('search') . '%')
          ->orwhere('firstname', 'like', '%' . $request->input('search') . '%')
          ->take($request->input('maxresults'))
          ->select('id', 'firstname', 'lastname')
          ->get();
      $res = [];
      if (count($users) > 0){
        //var_dump($lowersrch);
        foreach  ($users as $user){
          $res[] = [
            'id' => $user->id,
            'lastname' => $user->lastname,
            'firstname' => $user->firstname,
            'display' => Utils::highlite($user->lastname . ' '. $user->firstname, $request->input('search'), config('autocompleter.highliteclasses'))
          ];
        }
      }
      return response()->json(['res' => $res]);
    }
}
