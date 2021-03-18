@extends('layout')

@section('title', 'Home')
@section('content')
<div class="jumbotron">
  <h1 class="display-4">Sébastien L'HAIRE</h1>
  <p class="lead">I'm a web developper and I work for a web hosting company. I have developped some packages for my personal websites.</p>
    <p>These packages are freely available for the web community on <a target="_blank" href="https://packagist.org/packages/seblhaire/">Packagist</a>.
      This site's sources are <a target=":blank" href="https://github.com/seblhaire/demoseb">here</a>.
  Source files are available on <a target="_blank" href="https://github.com/seblhaire/">GitHub</a>. You can fork the projects to adapt them to your needs,
  notify bugs or propose merge requests. Translation files in your own language are very welcome.</p>
</div>
<div class="row">
      <div class="col-md-7">
        <h2>Bootstrap Paginator</h2>
        <h3>Generate paginators.</h3>
        <p class="lead">Two different pagnators:
		a classical paginator with page numbers and previous and next button. paginator image and an alphabetical paginator with letters.</p>
		<p><a class="btn btn-secondary" href="{{ route('paginator') }}" role="button">View details &raquo;</a></p>
      </div>
      <div class="col-md-5">
        <img src="/img/paginator.png" /><br/><br/>
        <img style="max-width:100%" src="/img/paginatoralpha.png" />
      </div>
</div>
<hr />
<div class="row">
    <div class="col-md-5">
      <img src="/img/double-open.png" />
    </div>
    <div class="col-md-7">
      <h2>DateRangePickerHelper</h2>
      <h3>Builds a calendar to set a date or a date range</h3>
      <p class="lead"><a target="_blank" href="https://www.daterangepicker.com/"><em>DateRangePicker</em></a> is a great Javascript library to build
        a calendar and select a date or date range. This package provides helpers to facilitate calendar settings and date retrieval.</p>
      <p><a class="btn btn-secondary" href="{{ route('daterangepicker') }}" role="button">View details &raquo;</a></p>
    </div>
</div>
<hr />
<div class="row">
      <div class="col-md-7">
        <h2>TableBuilder</h2>
        <h3>Retrieves data from database and displays it in a table with a Javascript library.</h3>
        <p class="lead">A Laravel library to build tables easily, which interacts with a lightweight js builder and builds data from Eloquent Object-Relational Mapping
          with database tables. Table can also load static data.</p>
		<p><a class="btn btn-secondary" href="{{ route('tablebuilder') }}" role="button">View details &raquo;</a></p>
      </div>
      <div class="col-md-5">
        <img style="max-width:100%" src="/img/tablebuilder.png" />
      </div>
</div>
<hr />
<h3 class="scto">Contact:</h3>
<p><a href="mailto:sebastien@lhaire.org">sebastien@lhaire.org</a></p>
@endsection
