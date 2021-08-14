<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Seblhaire\Tagsinput\TagsinputHelper;
use App\Models\Tablecontent;
use \Seblhaire\Autocompleter\Utils;

class TagsinputController extends Controller
{
  public function index()
  {
    $tagszone = TagsinputHelper::init(
      "tagzone",
      'Employee',
      route('tagsinputsearch'),
      [
        'resdivstyle' => [ //position autocompleter result list
          'width' => '430px',
          'top' => '-18px'
        ],
        'csrfrefreshroute' => route('refreshcsrf') // route called if csrf token must be reloaded
      ],
      [
        'tagaddcallback' => 'showlist', // callback functions called after tag is addded
        'tagremovecallback' => 'showlist'
      ]
    );
    $tagszone2 = TagsinputHelper::init(
      "tagzone2",
      'Country',
      route('autocompletesearch'),
      [
        'resdivstyle' => [ //position autocompleter result list
          'width' => '430px',
          'top' => '-18px'
        ],
        'id_included' => false, // id field is not added in autocompleter list result
        'csrfrefreshroute' => route('refreshcsrf') // route called if csrf token must be reloaded
      ],
      [
        'field' => 'code', //change id field
        'tagaddcallback' => 'showlist', // callback functions called after tag is addded
        'tagremovecallback' => 'showlist',
        'showaddbutton' => false, // add button not shown
        'tagclass' => 'bg-success', // change badge style
      ]
    );
    return view('tagsinput', [
      'title' => 'Tags input',
      'menu' => 'tagsinput',
      'tagszone' => $tagszone,
      'tagszone2' => $tagszone2,
    ]);
  }

  /**
  * search employee
  */
  public function search(Request $request){
    $validated = $request->validate([
      'search' => 'required|string',
      'maxresults' => 'required|numeric|min:3'
    ]);
    $search = $request->get('search');
    $employees = Tablecontent::where('lastname', 'like', '%' . $search . '%')
        ->orwhere('firstname', 'like', '%' . $search . '%')
        ->take($request->get('maxresults'))
        ->get();
    $res = [];
    if (count($employees) > 0){
      //var_dump($lowersrch);
      foreach  ($employees as $employee){
        $label = $employee->lastname . ' ' . $employee->firstname;
        $res[] = [
          config('autocompleter.id_field') => $employee->id, // unique value of autocompleter choice
          'firstname' => $employee->firstname, // other value available
          'lastname' => $employee->lastname, // other value available
          // value displayed in choice list, with html tags
          config('autocompleter.list_field') => Utils::highlite($label, $request->input('search'), config('autocompleter.highliteclasses')),
          // value to be used for tag label (see controller TagsinputController and js package seblhaire/tagsinput)
          config('tagsinput.taglabelelement') => $employee->id . ' : ' . $label
        ];
      }
    }
    return response()->json(['res' => $res]);
  }

  /**
  * add new employee name (does not save in database)
  */
  public function addEmployee(Request $request){
    $validated = $request->validate([
      'firstname' => 'required|string',
      'lastname' => 'required|string'
    ]);
    // here you should add new items to database
    $label = $request->input('lastname') . ' ' . $request->input('firstname');
    $id = random_int(100, 1000000); // generate fake id
    return response()->json(['res' => [
      config('autocompleter.id_field') => $id, // unique value of autocompleter choice
      'firstname' => $request->input('firstname'),
      'lastname' => $request->input('lastname'),
      config('tagsinput.taglabelelement') => $id . ' : ' . $label
    ]]);
  }
}
