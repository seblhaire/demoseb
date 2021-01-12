<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Seblhaire\DateRangePickerHelper\DateRangePickerHelper;

class DaterangepickerController extends Controller
{
  public function index($type = 'simple', $lang = 'en'){
    \App::setLocale($lang);
    $title = "DateRangePickerHelper";
    $cal = null;
    $cal2 = null;
    $initsingle = null;
    $initstart = null;
    $initend = null;
    $applysimple = "\$('#datesingle').val(picker.startDate.format('" . config('daterangepickerhelper.default.momentinputdate') . "'));";
    $applysimpletime = "\$('#datesingle').val(picker.startDate.format('" . config('daterangepickerhelper.default.momentinputdatetime') . "'));";
    $applydouble = "\$('#datestart').val(picker.startDate.format('" . config('daterangepickerhelper.default.momentinputdate')
      . "'));\n\$('#dateend').val(picker.endDate.format('" . config('daterangepickerhelper.default.momentinputdate') . "'));";
    $applydoubletime = "\$('#datestart').val(picker.startDate.format('" . config('daterangepickerhelper.default.momentinputdatetime')
        . "'));\n\$('#dateend').val(picker.endDate.format('" . config('daterangepickerhelper.default.momentinputdatetime') . "'));";
    switch($type){
      case 'simple' :
          $today = new Carbon;
          $calId = 'numCal';
          $initsingle = $today->format(config('daterangepickerhelper.default.carboninputdate'));
          $cal = DateRangePickerHelper::init($calId, $today, $today, null, null, [
            'singleDatePicker' => true,
            'drops' => 'down',
            'formlabel' => 'Date:',
            'usehiddeninputs' => false,
            'apply.daterangepicker' => $applysimple
          ]);
          break;
      case 'simpletime' :
          $today = new Carbon;
          $calId = 'numCal2';
          $formatsimple = config('daterangepickerhelper.default.momentinputdatetime');
          $initsingle = $today->format(config('daterangepickerhelper.default.carboninputdatetime'));
          $cal = DateRangePickerHelper::init($calId, $today, $today, null, null, [
            'singleDatePicker' => true,
            'drops' => 'down',
            'formlabel' => 'Date:',
            'timePicker' => true,
            'usehiddeninputs' => false,
            'apply.daterangepicker' => $applysimpletime
          ]);
          break;
      case 'double' :
          $start = new Carbon('6 days ago');
          $end = new Carbon;
          $max = $end;
          $min = null;
          $calId = 'logCal';
          $initstart = $start->format(config('daterangepickerhelper.default.carboninputdate'));;
          $initend = $end->format(config('daterangepickerhelper.default.carboninputdate'));;
          $cal2 = DateRangePickerHelper::init($calId, $start, $end, $min, $max, [
            'formlabel' => 'Dates:',
            'drops' => 'down',
            'usehiddeninputs' => false,
            'apply.daterangepicker' => $applydouble
          ]);
          break;
      case 'doubletime' :
          $start = new Carbon('6 days ago');
          $end = new Carbon;
          $max = $end;
          $min = null;
          $calId = 'logCal2';
          $initstart = $start->format(config('daterangepickerhelper.default.carboninputdatetime'));;
          $initend = $end->format(config('daterangepickerhelper.default.carboninputdatetime'));;
          $cal2 = DateRangePickerHelper::init($calId, $start, $end, $min, $max, [
            'formlabel' => 'Dates:',
            'drops' => 'down',
            'timePicker' => true,
            'usehiddeninputs' => false,
            'apply.daterangepicker' => $applydoubletime
          ]);
          break;
      case 'twocals' :
          $start = new Carbon('6 days ago');
          $end = new Carbon;
          $max = $end;
          $min = null;
          $calId = 'logCal';
          $cal = DateRangePickerHelper::init($calId, $end, $end, $min, $max, [
            'singleDatePicker' => true,
            'drops' => 'down',
            'formlabel' => 'Date:',
            'usehiddeninputs' => false,
            'apply.daterangepicker' => $applysimple
          ]);
          $calId = 'numCal2';
          $cal2 = DateRangePickerHelper::init($calId, $start, $end, null, null, [
            'drops' => 'down',
            'formlabel' => 'Dates:',
            'timePicker' => true,
            'usehiddeninputs' => false,
            'apply.daterangepicker' => $applydoubletime
          ]);
          $initsingle = $end->format(config('daterangepickerhelper.default.carboninputdate'));
          $initstart = $start->format(config('daterangepickerhelper.default.carboninputdatetime'));;
          $initend = $end->format(config('daterangepickerhelper.default.carboninputdatetime'));;
          break;
    }
    return view('daterangepicker', [
        'title' => $title,
        'languages' => [
            'en' => 'English',
            'fr' => 'Français',
        ],
        'currentlang' => $lang,
        'currenttype' => $type,
        'menu' => 'daterangepicker',
        'cal' => $cal,
        'cal2' => $cal2,
        'initsingle' => $initsingle,
        'initstart' => $initstart,
        'initend' => $initend,
    ]);
  }
}
