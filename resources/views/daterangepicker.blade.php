@extends('layout')

@section('title', $title)
@section('description', "Demo site of Laravel package DateRangePickerHelper, developped by Sébastien L'haire")
@section('content')
<div class="row">
    <div class="col-sm-3">
      {!! $sidemenu !!}
    </div>
    <div class="col-sm-9">
    <h3>{{ $title }}</h3>
    <p class="lead">
      <a rel="noopener noreferrer" target="_blank" href="https://www.daterangepicker.com/">
        <em>DateRangePicker</em></a> (current version: {{ config('versions.daterangepicker')}}) is a great Javascript library to build
      a calendar and select a date or date range.
      Package DateRangePickerHelper (current version: {{ config('versions.daterangepickerhelper')}}) provides helpers to
      facilitate calendar settings and date retrieval.
      <a rel="noopener noreferrer" target="_blank" href="https://github.com/seblhaire/daterangepickerhelper">Project on GitHub</a>.
      <a rel="noopener noreferrer" target="_blank" href="https://packagist.org/packages/seblhaire/daterangepickerhelper">Project on Packagist</a>.
      This demosite sources available <a rel="noopener noreferrer" target="_blank" href="https://github.com/seblhaire/demoseb">here</a>.
    </p>
    <p>In your controller create an instance of DateRangePickerHelper and pass the variable to the view.</p>
<pre>
<code>
@switch($type)
@case('simpletime')
$today = new Carbon;
$cal = DateRangePickerHelper::init(
  'singlecalendar', //object id
  $today, // init date start
  $today, // init date end
  null, // inferior date limit (min. date)
  null, // superior date limit (max. date)
  [
    'singleDatePicker' => true, // calendar is not double
    'drops' => 'down', // calendat opens below
    'formlabel' => 'Date:', // calendar label in form
    'usehiddeninputs' => false, // dates shall be copied in form fields manually
    'timePicker' => true, // hour + minutes
    'apply.daterangepicker' => //copy selected date after "apply" button is clicked.
      // here element 'datesingle' is field where selected date is copied.
      // picker is js calendar object. Format is Moment.js formatting code
      "\$('#datesingle').val(picker.startDate.format('YYYY-MM-DD HH:mm:ss'));";
  ]);
  @break;
@case('double')
$start = new Carbon('6 days ago');
$end = new Carbon;
$cal2 = DateRangePickerHelper::init(
  'logCal', //object id
  $start, // init date start
  $end, // init date end
  null, // inferior date limit (min. date)
  $end, // superior date limit (max. date)
  [
    'formlabel' => 'Dates:', // calendar label in form
    'drops' => 'down', // calendat opens below
    'usehiddeninputs' => false, // dates shall be copied in form fields manually
    'apply.daterangepicker' => //copy selected dates after "apply" button is clicked.
      // here element 'datesingle' is field where selected date is copied.
      // picker is js calendar object. Format is Moment.js formatting code
      "\$('#datestart').val(picker.startDate.format('YYYY-MM-DD'));"
       . "$('#dateend').val(picker.endDate.format('YYYY-MM-DD'));";
]);
  @break;
@case('doubletime')
$start = new Carbon('6 days ago');
$end = new Carbon;
$cal2 = DateRangePickerHelper::init(
  'logCal2', //object id
  $start, // init date start
  $end, // init date end
  null, // inferior date limit (min. date)
  $end, // superior date limit (max. date)
  [
    'formlabel' => 'Dates:', // calendar label in form
    'timePicker' => true, // hour + minutes
    'drops' => 'down', // calendat opens below
    'usehiddeninputs' => false, // dates shall be copied in form fields manually
    'apply.daterangepicker' => //copy selected dates after "apply" button is clicked.
      // here element 'datesingle' is field where selected date is copied.
      // picker is js calendar object. Format is Moment.js formatting code
      "\$('#datestart').val(picker.startDate.format('YYYY-MM-DD HH:mm:ss'));"
       . "$('#dateend').val(picker.endDate.format('YYYY-MM-DD HH:mm:ss'));";
]);
  @break;
@case('twocals')
// refer to other examples to get code
  @break;
@case('hidden')
$start = new Carbon('6 days ago');
$end = new Carbon;
$cal2 = DateRangePickerHelper::init(
  'numCal2', //object id
  $start, // init date start
  $end, // init date end
  null, // inferior date limit (min. date)
  null, // superior date limit (max. date)
  [
    'formlabel' => 'Dates:', // calendar label in form
    'timePicker' => true, // hour + minutes
    "timePickerSeconds" => true, // add secondds
    'drops' => 'down', // calendat opens below
    'usehiddeninputs' => true, // hidden fiels are created automatically to return
            // values automatically to form
    'apply.daterangepicker' => // callback after "apply" button is clicked.
      "displayhiddeninputs()"; // displays data in alert
]);
  @break;
@default
$today = new Carbon;
$cal = DateRangePickerHelper::init(
  'singlecalendar', //object id
  $today, // init date start
  $today, // init date end
  null, // inferior date limit (min. date)
  null, // superior date limit (max. date)
  [
    'singleDatePicker' => true, // calendar is not double
    'drops' => 'down', // calendat opens below
    'formlabel' => 'Date:', // calendar label in form
    'usehiddeninputs' => false, // dates shall be copied in form fields manually
    'apply.daterangepicker' => // copy selected dates after "apply" button is clicked.
    // here element 'datesingle' is field where selected date is copied.
    // picker is js calendar object. Format is Moment.js formatting code
      "\$('#datesingle').val(picker.startDate.format('YYYY-MM-DD'));";
]);
return view('mytemplate', ['cal' => $cal])
@endswitch
</code>
</pre>
    <p>Then print your paginator by inserting <code>@{!! cal !!}</code> in your template.</p>
    <h4>Demo</h4>
    <form id="daterangepicker" action="return false;">
      <!-- language selection -->
      <div class="mb-3">
        <label class="control-label" for="curlang">Change language:</label>
        <select class="form-control" id="curlang" name="curlang">
        @foreach ($languages as $lang => $language)
            @if ($lang == $currentlang)
              <option value="{!! $lang !!}" selected="selected">
            @else
              <option value="{!! $lang !!}">
            @endif
            {{ $language }}</option>
        @endforeach
        </select>
      </div>
      @if (!is_null($cal))
        {!! $cal !!}
        @if ($type != 'hidden')
          <div class="mb-3">
            <label class="control-label" for="datesingle">Selected date:</label>
            <input class="form-control" id="datesingle" name="datesingle" value="{{ $initsingle }}">
          </div>
          <p>Here dates are copied into visible fields defined in `apply.daterangepicker` function.</p>
        @endif
      @endif
      @if (!is_null($cal2))
        {!! $cal2->output() !!}
        @if ($type != 'hidden')
          <div class="mb-3">
            <label class="control-label" for="datestart">Selected start date:</label>
            <input class="form-control" id="datestart" name="datestart" value="{{ $initstart }}">
          </div>
          <div class="mb-3">
            <label class="control-label" for="dateend">Selected end date:</label>
            <input class="form-control" id="dateend" name="dateend" value="{{ $initend }}">
          </div>
          <p>Here dates are copied into visible fields defined in `apply.daterangepicker` function.</p>
        @else
        <p>Here dates are copied into hidden inputs that are automatically inserted after DateRangePicker widget.</p>
        @endif
      @endif
    </form>
    <script>
    @if ($type == 'hidden')
      function displayhiddeninputs(){ //function to display hidden inputs
        alert('single calendar: ' + {!! $cal->getStartDate() !!} + '. double calendar: input startdate ' + {!! $cal2->getStartDate() !!} + '. input enddate  ' +  {!! $cal2->getEndDate() !!});
      }
    @endif
      jQuery(document).ready(function(){
        //change language following select change
          jQuery('#curlang').on('change', function(e){
              window.location.href = '{{route("daterangepicker", ["type" => $currenttype])}}/' + $(this).val();
          });
      });
    </script>
	</div>
</div>
@endsection
