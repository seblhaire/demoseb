<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Seblhaire\DateRangePickerHelper\DateRangePickerHelper;
use Seblhaire\Tagsinput\TagsinputHelper;
use Seblhaire\Uploader\UploaderHelper;
use Seblhaire\MenuAndTabUtils\MenuUtils;

class FormsbootstrapController extends Controller
{
  public function index($type = 'form'){
    $today = new Carbon;
    $calId = 'date';
    //$initsingle = $today->format(config('daterangepickerhelper.default.carboninputdate')); // init date for input where result is displayed
    $cal = DateRangePickerHelper::init($calId, $today, $today, null, null, [ // see DaterangepickerController for details
      'singleDatePicker' => true,
      'drops' => 'down', // calendat opens below
      'formlabel' => 'Date:',
      'formdivclass' =>
        config('daterangepickerhelper.default.formdivclass') . ' ' .
        config('formsbootstrap.classes.requiredspecialclass') . ' ' .
        config('formsbootstrap.classes.resetspecialclass')
    ]);
    $start = new Carbon('30 days ago');
    $max = $today;
    $min = null;
    //$->format(config('daterangepickerhelper.default.carboninputdate'));
    $cal2 = DateRangePickerHelper::init('daterange', $start, $today, $min, $max, [
      'drops' => 'down', // calendat opens below
      'formlabel' => 'Publication range:',
      'formdivclass' =>
        config('daterangepickerhelper.default.formdivclass') . ' ' .
        config('formsbootstrap.classes.requiredspecialclass') . ' ' .
        config('formsbootstrap.classes.resetspecialclass')
    ]);
    $countries = TagsinputHelper::init( // see TagsinputController for details
      "countries",
      'Countries',
      route('autocompletesearch'),
      [
        'id_included' => false, // id field is not added in autocompleter list result
        'csrfrefreshroute' => route('refreshcsrf'), // route called if csrf token must be reloaded
      ],
      [
        'maindivclass' =>
          config('tagsinput.maindivclass') . ' ' .
          config('formsbootstrap.classes.requiredspecialclass') . ' ' .
          config('formsbootstrap.classes.resetspecialclass'),
        'showaddbutton' => false, // add button not shown
        'tagclass' => 'bg-success', // change badge style
      ]
    );
    $uploader = UploaderHelper::init( //see UploaderController for details
      'itempicture',
      'Item picture',
      route('fileupload'),
      [
        'filecontainer' => 'UploadedFileContainerExt',
        'acceptable_mimes' => 'png,jpg,jpeg,gif',
        'multiple' => true,
        'maxfilesizek' => 1024, // max file size
        'path' => '/uploads', // folder in storage where files must be uploaded
        'storagename' => 'public',
        'delurl' => route('filedelete'),
        'maindiv' =>
            config('uploader.maindiv') . ' ' .
            config('formsbootstrap.classes.requiredspecialclass') . ' ' .
            config('formsbootstrap.classes.resetspecialclass'),
    ], [ // additional parameters transmitted to second script
      'article_title' => "blablabla",
      'article_id' => 409
    ]);
    $sidemenu = MenuUtils::init('formsbs-menu', [ //see MenuUtilsController for details
      'ulclass' => 'nav flex-column sidemenu',
      'menu' => [
        'form-menu' => [
          'title' => 'Form and buttons',
          'target' => route('formsbootstrap')
        ],
        'hidden-menu' => [
          'title' => 'Hidden input',
          'target' => route('formsbootstrap', ['type' => 'hidden'])
        ],
        'text-menu' => [
          'title' => 'Text and number input',
          'target' => route('formsbootstrap', ['type' => 'text'])
        ],
        'email-menu' => [
          'title' => 'Email input',
          'target' => route('formsbootstrap', ['type' => 'email'])
        ],
        'password-menu' => [
          'title' => 'Password input',
          'target' => route('formsbootstrap', ['type' => 'password'])
        ],
        'textarea-menu' => [
          'title' => 'Textarea input',
          'target' => route('formsbootstrap', ['type' => 'textarea'])
        ],
        'select-menu' => [
          'title' => 'Select',
          'target' => route('formsbootstrap', ['type' => 'select'])
        ],
        'checkbox-menu' => [
          'title' => 'Checkboxes and radio buttons',
          'target' => route('formsbootstrap', ['type' => 'checkbox'])
        ],
        'colorpicker-menu' => [
          'title' => 'Colorpicker',
          'target' => route('formsbootstrap', ['type' => 'colorpicker'])
        ],
        'rangeinput-menu' => [
          'title' => 'Range',
          'target' => route('formsbootstrap', ['type' => 'range'])
        ],
        'editor-menu' => [
          'title' => 'Editor',
          'target' => route('formsbootstrap', ['type' => 'editor'])
        ],
        'complete-menu' => [
          'title' => 'Complete example',
          'target' => route('formsbootstrap', ['type' => 'complete'])
        ],
      ]
    ]);
    return view('formsbootstrap', [
        'type' => $type,
        'mainmenu' => $this->mainmenu->setCurrent('packages-topmenu'),
        'rightmenu' => $this->rightmenu,
        'title' => 'FormsBootstrap',
        'cal' => $cal,
        'cal2' => $cal2,
        'countries' => $countries,
        'uploader' => $uploader,
        'content' => $type == 'editor' ? $this->loremipsum() : '',
        'sidemenu' => $sidemenu->setCurrent($type . '-menu')
    ]);
  }

/*
* Method to fill form with "random" data. Of course data are usually retrieved from database
*/
  public function filldata(){
    $date = Carbon::today()->subDays(rand(10, 3650));
    $date2 = Carbon::today()->subDays(rand(10, 3650));
    $date3 = $date2->copy()->addDays(rand(30,100));
    $files = [
      ['filename' => "seb.jpg", 'ext' => "jpg", 'url' => asset('img/seb.jpg'), 'file_id' => random_int(1, 10000)],
      ['filename' => "autocompleter1.png", 'ext' => "jpg", 'url' => asset('img/autocompleter1.png'), 'file_id' => random_int(1, 10000)],
      ['filename' => "formsbs.png", 'ext' => "png", 'url' => asset('img/formsbs.png'), 'file_id' => random_int(1, 10000)],
      ['filename' => "paginator.png", 'ext' => "png", 'url' => asset('img/paginator.png'), 'file_id' => random_int(1, 10000)],
      ['filename' => "paginatoralpha.png", 'ext' => "png", 'url' => asset('img/paginatoralpha.png'), 'file_id' => random_int(1, 10000)],
      ['filename' => "tablebuilder.png", 'ext' => "png", 'url' => asset('img/tablebuilder.png'), 'file_id' => random_int(1, 10000)],
      ['filename' => "tagsinput.png", 'ext' => "png", 'url' => asset('img/tagsinput.png'), 'file_id' => random_int(1, 10000)],
      ['filename' => "uploader.png", 'ext' => "png", 'url' => asset('img/uploader.png'), 'file_id' => random_int(1, 10000)],
    ];
    return response()->json([
      'ok' => true,
      'data' => [
        'main_id' => rand(1, 1000),
        'title' => 'Un super titre',
        'article' => $this->loremipsum(),
        'countries' => [
          ['id' => 'GB', 'taglabel' => 'GB: United Kingdom of Great Britain and Northern Ireland'],
          ['id' => 'UA', 'taglabel' => 'UA: Ukraine'],
          ['id' => 'ZA', 'taglabel' => 'ZA: South Africa']
        ],
        'date' => $date->format(config('daterangepickerhelper.default.carboninputdate')),
        'daterange' => [
          $date2->format(config('daterangepickerhelper.default.carboninputdate')),
          $date3->format(config('daterangepickerhelper.default.carboninputdate'))
        ],
        'priority' => collect(['lowest', 'low' ,'medium', 'high' ,'highest'])->random(),
        'publish' => collect(['yes', 'no'])->random(),
        'os' => collect(['mac', 'windows', 'linux', 'vms', 'unix'])->random(rand(1,5)),
        'languages' => collect(['en', 'fr', 'de', 'it', 'es', 'pt'])->random(rand(1,6)),
        'weight' => rand(0,10),
        'range' => rand(0,10),
        'itempicture' => collect($files)->random(rand(1,4)),
        'notes' => 'voici une supernote',
        'color' => '#' . dechex(rand(0, 16777215)),
        'email' => 'example@data.com',
      ]
    ]);
  }

  protected function loremipsum(){
    return <<<'EOT'
    <h2>Lorem ipsum</h2>
    <p>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam placerat ac massa quis condimentum. Praesent vestibulum rutrum varius. Sed in tempor elit. Morbi velit metus, varius nec aliquam id, congue malesuada tellus. Nunc efficitur ligula sed auctor bibendum. Curabitur at est erat. Quisque nibh lacus, accumsan quis urna eleifend, vehicula dictum dolor. In vitae diam at nibh commodo tempus in et justo. Ut molestie ipsum vel pretium pulvinar. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ut sem sapien. Praesent semper nisl sem, ut mollis mi varius a. Suspendisse tincidunt quam nisl, nec vulputate turpis pretium nec. Sed aliquam ullamcorper nisi, ut volutpat nunc tempus a. Ut malesuada fringilla rhoncus. Proin metus magna, egestas eu purus eu, vulputate venenatis neque.
    </p>
    <p><img src="/img/cat.jpg" /></p>
    <table>
    <tr><th>Country</th><th>Code</th><th>Phone code</th></tr>
    <tr><td>United States</td><td>US</td><td>1</td></tr>
    <tr><td>France</td><td>FR</td><td>33</td></tr>
    <tr><td>Switzerland</td><td>CH</td><td>41</td></tr>
    <tr><td>Germany</td><td>DE</td><td>49</td></tr>
    <tr><td>United Kingdom</td><td>UK</td><td>44</td></tr>
    </table>
    <p>Nullam leo sem, molestie sed sapien non, suscipit lobortis ligula. Donec ultricies ante diam, sed rhoncus elit imperdiet in. Nullam pulvinar viverra ipsum nec dapibus. Mauris ultrices sit amet velit id sollicitudin. Nam ac efficitur felis. Vivamus ut imperdiet ipsum. Sed lacinia justo id rutrum porttitor. Nam id magna at ex placerat consequat nec non diam. Curabitur nunc arcu, vestibulum id consectetur eget, pellentesque sit amet massa. Donec tristique lorem ac orci mattis, vel suscipit nunc egestas.
    </p>
    <p>
    Suspendisse aliquet odio at scelerisque aliquam. Aliquam sed odio eget nulla bibendum lacinia ac ut diam. Ut eu dui vulputate, cursus massa eu, vestibulum felis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Suspendisse pulvinar vestibulum justo, et aliquet risus fermentum ut. Integer libero sapien, interdum id consequat eget, tempus ac velit. Etiam sodales scelerisque nisi vel volutpat. Vivamus vitae orci congue, ultricies turpis vitae, consectetur purus. Morbi placerat odio ut mauris accumsan, non blandit quam finibus. Donec ultrices nisl sed lacinia condimentum. Suspendisse fringilla mi nisi, quis venenatis purus commodo eget. Sed luctus mi quis augue molestie, non dapibus sem feugiat. Quisque hendrerit dolor aliquam purus tincidunt, at sodales nulla auctor.
    </p>
    <p>
    Duis efficitur scelerisque sapien, in volutpat velit ultrices eu. Sed hendrerit dui eget augue ullamcorper pharetra. Donec finibus efficitur neque, vel ultrices erat faucibus quis. Fusce urna ante, rutrum et turpis ac, auctor iaculis libero. Duis sed porttitor ex, in efficitur tellus. Suspendisse eget odio ultricies, luctus nisi vel, molestie erat. Donec eleifend porta libero vel consequat. Nunc gravida urna quis pretium pharetra. Fusce lobortis libero ut molestie blandit. Nulla blandit, dolor egestas pretium efficitur, sapien tellus vulputate mauris, nec hendrerit nisl urna eget velit. Vivamus ut turpis auctor, facilisis elit in, porttitor ante. Nulla hendrerit nibh et orci scelerisque, scelerisque ultricies nulla facilisis. Nam nec nibh rutrum, gravida orci vel, tempus purus. Vivamus ut diam ipsum. Cras ullamcorper libero in congue euismod. Suspendisse sagittis arcu id erat viverra malesuada.
    </p>
    EOT;
  }

  public function processform(Request $request){
    /*you should also validate other fields*/
    $validator = Validator::make($request->all(), [
      'password' => ['string', 'regex:' . config('formsbootstrap.defaults.password_common.password_regex_php')],
      'email' => ['string', 'regex:' . config('formsbootstrap.defaults.email.regex')], // you can also use 'email' => 'required|string|email:rfc'
    ]);
    if ($validator->fails()){
      return response()->json([
        'ok' => false,
        'message' => $validator->errors()->all()
      ]);
    }
    $res = '';
    foreach ($request->input() as $key => $value){
      if (is_array($value)){
        $res .= $key . ' :' . PHP_EOL;
        foreach ($value as $elt => $val){
          $res .= '   [' . $elt . ']: ' . $val . PHP_EOL;
        }
      }else{
        $res .= $key . ' : ' . $value . PHP_EOL;
      }
    }
    return response()->json([
      'ok' => true,
      'formcontent' => $res,
      'message' => 'Form processed ' . date(DATE_RFC2822)
    ]);
  }

  public function checkoldpass(Request $request){
    /*you should also validate other fields*/
    $validator = Validator::make($request->all(), [
      config('formsbootstrap.defaults.password-with-confirm.oldpass.name') => 'required:string'
    ]);
    if ($validator->fails()){
      return response()->json(['ok' => false, 'message' => $validator->errors()->all()]);
    }
    return response()->json([
      'ok' => true,
      'password_ok' => collect([true, false])->random()
    ]);
  }

}
