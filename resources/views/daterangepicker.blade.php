@extends('layout')

@section('title', $title)
@section('content')
<div class="row">
    <div class="col-sm-4">
<ul>
    <li><a href="{{ route('daterangepicker') }}">Single date</a></li>
    <li><a href="{{ route('daterangepicker', ['type' => 'simpletime']) }}">Single date + time</a></li>
    <li><a href="{{ route('daterangepicker', ['type' => 'double']) }}">Date range</a></li>
    <li><a href="{{ route('daterangepicker', ['type' => 'doubletime']) }}">Date range + time</a></li>
    <li><a href="{{ route('daterangepicker', ['type' => 'twocals']) }}">Two calendars on same page</a></li>
    <li><a href="{{ route('daterangepicker', ['type' => 'hidden']) }}">Hidden inputs</a></li>
</ul>
    </div>
    <div class="col-sm-8">
    <h3>{{ $title }}</h3>
    <p class="lead"><a rel="noopener noreferrer" target="_blank" href="https://www.daterangepicker.com/"><em>DateRangePicker</em></a> is a great Javascript library to build
      a calendar and select a date or date range. This package provides helpers to facilitate calendar settings and date retrieval.
      <a rel="noopener noreferrer" target="_blank" href="https://github.com/seblhaire/daterangepickerhelper">Project on GitHub</a>.
      <a rel="noopener noreferrer" target="_blank" href="https://packagist.org/packages/seblhaire/daterangepickerhelper">Project on Packagist</a>.
      This demosite sources available <a rel="noopener noreferrer" target="_blank" href="https://github.com/seblhaire/demoseb">here</a>.
    </p>
    <form id="daterangepicker" action="return false;">
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
      {!! $cal->output() !!}
      <div class="mb-3">
        <label class="control-label" for="datesingle">Selected date:</label>
        <input class="form-control" id="datesingle" name="datesingle" value="{{ $initsingle }}">
      </div>
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
        @endif
      @endif
    </form>
    <script>
    @if ($type == 'hidden')
      function displayhiddeninputs(){ //function to display hidden inputs
        alert('input startdate ' + {!! $cal2->getStartDate() !!} + '. input enddate  ' +  {!! $cal2->getEndDate() !!});
      }
    @endif
      $(document).ready(function(){
          $('#curlang').on('change', function(e){
              window.location.href = '{{route($menu, ["type" => $currenttype])}}/' + $(this).val();
          });
      });
    </script>
	</div>
</div>
@endsection
