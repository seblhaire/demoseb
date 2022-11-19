<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Seblhaire\Autocompleter\AutocompleterHelper;
use App\Models\Tablecontent;
use \Seblhaire\Autocompleter\Utils;
use App\Utils\Countries;
use Seblhaire\Autocompleter\AutocompleterRequest;


// https://www.tutorialspoint.com/how-to-create-an-autocomplete-with-javascript
// https://www.w3schools.com/howto/howto_js_autocomplete.asp

class AutocompleterController extends Controller
{
    public $options;

    public function __construct(){
      parent::__construct();
      $this->options = array_replace(config('autocompleter'), [
        'csrfrefreshroute' => route('refreshcsrf'), // route called if csrf token must be reloaded
        'callback' => 'output', // js callback called after selecting element
        'id_included' => false, // id column not added in item list
      ]);
    }

    public function index(){
      $ac = AutocompleterHelper::init(
        'autocompleter1', //id
        'Countries', //label
        route('autocompletesearch'), // route called when typing in input
        $this->options
      );
      return view('autocompleter', [
          'title' => 'Autocompleter',
          'mainmenu' => $this->mainmenu->setCurrent('packages-topmenu'),
          'rightmenu' => $this->rightmenu,
          'ac' => $ac,
          'options' => $this->options
        ]);
    }

    /**
    * builds autocompleter results list
    */
    public function search(AutocompleterRequest $request){
      $search = $request->input('search');
      $countries = collect(Countries::getList())->filter(function($data) use ($search){ //search in country list
        return (mb_stripos($data['code'], $search) !== false) || (mb_stripos($data['country'], $search) !== false);
      })->take($request->input('maxresults'));
      $res = [];
      if (count($countries) > 0){
        //var_dump($lowersrch);
        foreach  ($countries as $country){
          $res[] = [
            $this->options['id_field'] => $country['code'], // unique value of autocompleter choice
            'country' => $country['country'], // other value available
            // value displayed in choice list, with html tags
            $this->options['list_field'] => Utils::highlite($country['code'] . ' : ' .$country['country'], $request->input('search'), config('autocompleter.highliteclasses')),
            // value to be used for tag label (see controller TagsinputController and js package seblhaire/tagsinput)
            config('tagsinput.taglabelelement') => $country['code'] . ' : ' . $country['country']
          ];
        }
      }
      return response()->json(['res' => $res]);
    }
}
