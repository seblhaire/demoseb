<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tablecontent;
use Seblhaire\Tagsinput\TagsinputHelper;
use \Seblhaire\Autocompleter\Utils;
use Seblhaire\MenuAndTabUtils\MenuUtils;
use Seblhaire\Autocompleter\AutocompleterRequest;

class TagsinputController extends Controller
{
  public function index($type = 'ex1')
  {
    if ($type == 'ex1'){
      $tagszone = TagsinputHelper::init(
        "tagzone", //id
        'Employees', // label
        route('tagsinputsearch'), //autocompleter script
        [],
        [ //tagsinput parameters
          'tagaddcallback' => 'showlist', // callback functions called after tag is addded
          'tagremovecallback' => 'showlist'
        ]
      );
    }else if ($type == 'ex2'){
      $tagszone = TagsinputHelper::init(
        "tagzone2",
        'Countries',
        route('autocompletesearch'),
        [
          'id_included' => false, // id field is not added in autocompleter list result
        ],
        [
          'tagaddcallback' => 'showlist', // callback functions called after tag is addded
          'tagremovecallback' => 'showlist',
          'showaddbutton' => false, // add button not shown
          'tagclass' => 'bg-success', // change badge style
        ]
      );
    }
    $sidemenu = $sidemenu = MenuUtils::init('tagsinput-menu', [
      'ulclass' => 'nav flex-column sidemenu',
      'menu' => [
        'ex1-menu' => [
          'title' => 'Tags input & add button',
          'target' => route('tagsinput', ['type' => 'ex1'])
        ],
        'ex2-menu' => [
          'title' => 'Tags input with default values',
          'target' => route('tagsinput', ['type' => 'ex2'])
        ],
      ]
    ]);
    return view('tagsinput', [
      'title' => 'Tags input',
      'type' => $type,
      'mainmenu' => $this->mainmenu->setCurrent('packages-topmenu'),
      'rightmenu' => $this->rightmenu,
      'tagszone' => $tagszone,
      'sidemenu' => $sidemenu->setCurrent($type . '-menu'),
    ]);
  }

  /**
  * search employee
  */
  public function search(AutocompleterRequest $request){
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
