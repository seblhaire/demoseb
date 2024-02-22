@extends('layout')

@section('title', 'Home')
@section('description', "Personal website of Sébastien L'haire. Curriculum Vitae. Publications list. Description of Laravel packages useful to web development")
@section('content')
<div class="h-100 p-5 bg-light border rounded-3">
      <h1 class="display-5 fw-bold">Sébastien L'HAIRE</h1>
  <p class="lead">I'm a web developper and I work for a web hosting company. I have developped some packages for my personal websites.</p>
    <p>These packages are freely available for the web community on <a rel="noopener noreferrer" target="_blank" href="https://packagist.org/packages/seblhaire/">Packagist</a>.
      This site's sources are <a rel="noopener noreferrer" target=":blank" href="https://github.com/seblhaire/demoseb">here</a>.
  Source files are available on <a rel="noopener noreferrer" target="_blank" href="https://github.com/seblhaire/">GitHub</a>. You can fork the projects to adapt them to your needs,
  notify bugs or propose merge requests. Translation files in your own language are very welcome.</p>
  <h3 class="scto">Contact:</h3>
  <p><a href="mailto:sebastien@lhaire.org">sebastien@lhaire.org</a></p>
</div>
<br/><br/>
<div class="row projectdescr">
      <div class="col-md-7">
        <h2>Bootstrap Paginator</h2>
        <h3>Generate paginators.</h3>
        <p class="lead">Two different pagnators:
		a classical paginator with page numbers and previous and next button. paginator image and an alphabetical paginator with letters.</p>
		<p><a class="btn btn-secondary" href="{{ route('paginator') }}" role="button">View details &raquo;</a></p>
      </div>
      <div class="col-md-5">
        <img src="/img/paginator.png" /><br/><br/>
        <img src="/img/paginatoralpha.png" />
      </div>
</div>
<div class="row projectdescr">
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
<div class="row projectdescr">
      <div class="col-md-7">
        <h2>TableBuilder</h2>
        <h3>Retrieves data from database and displays it in a table with a Javascript library.</h3>
        <p class="lead">A Laravel library to build tables easily, which interacts with a lightweight js builder and builds data from Eloquent Object-Relational Mapping
          with database tables. Table can also load static data.</p>
		<p><a class="btn btn-secondary" href="{{ route('tablebuilder') }}" role="button">View details &raquo;</a></p>
      </div>
      <div class="col-md-5">
        <img src="/img/tablebuilder.png" />
      </div>
</div>
<div class="row projectdescr">
    <div class="col-md-5">
      <img src="/img/uploader.png" />
    </div>
    <div class="col-md-7">
      <h2>Uploader</h2>
      <h3>File upload package</h3>
      <p class="lead">A Laravel library to provide file upload utilities. A Javascript library builds a
        complete file upload widget with upload button, drag-and-drop zone, progress bar
        and result builder. A controller is available to manage uploaded files.</p>
      <p><a class="btn btn-secondary" href="{{ route('uploader') }}" role="button">View details &raquo;</a></p>
    </div>
</div>
<div class="row projectdescr">
      <div class="col-md-7">
        <h2>Autocompleter</h2>
        <h3>Add auto-completion to your input</h3>
        <p class="lead">A Laravel library with Javascript JQuery script to add input with auto-completer.</p>
		<p><a class="btn btn-secondary" href="{{ route('autocompleter') }}" role="button">View details &raquo;</a></p>
      </div>
      <div class="col-md-5">
        <img src="/img/autocompleter1.png" />
      </div>
</div>
<div class="row projectdescr">
    <div class="col-md-5">
      <img src="/img/tagsinput.png" />
    </div>
    <div class="col-md-7">
      <h2>TagsInput</h2>
      <h3>Select items from a list and put them in a tag list</h3>
<p>A Laravel library with jQuery add-on to add tags (Boostrap badges) selected by an auto-completer.</p>
      <p><a class="btn btn-secondary" href="{{ route('tagsinput') }}" role="button">View details &raquo;</a></p>
    </div>
</div>
<div class="row projectdescr">
      <div class="col-md-7">
        <h2>FormsBoostrap</h2>
        <h3>Easily insert a form into your pages with Boostrap style</h3>
        <p class="lead">A Laravel library to generate forms based on
    			Laravel Collective Forms
    			& HTML, Boostrap 5 CSS Framework, RichText editor, and Icons provided by FontAwesome. Includes form management and validation.</p>
		<p><a class="btn btn-secondary" href="{{ route('formsbootstrap') }}" role="button">View details &raquo;</a></p>
      </div>
      <div class="col-md-5">
        <img src="/img/formsbs.png" />
      </div>
</div>
<div class="row projectdescr">
  <div class="col-md-5">
    <img src="/img/menutabutils.png" />
  </div>
  <div class="col-md-7">
    <h2>Menu and Tabs Utils</h2>
    <h3></h3>
    <p class="lead">A Laravel library to to build menus and tabs navigation utilities, based on Boostrap 5 CSS Framework.</p>
<p><a class="btn btn-secondary" href="{{ route('menuutils') }}" role="button">View details &raquo;</a></p>
  </div>
</div>
<div class="row projectdescr">
  <div class="col-md-7">
    <h2>Specialauth</h2>
    <h3>Alternative authentication library</h3>
<p class="lead">Library based on Laravel authentication libraries (login, logout, password reset procedure) provided in
  <a rel="noopener noreferrer" target="_blank" href="https://laravel.com/docs/master/starter-kits#laravel-breeze">Laravel Breeze</a>
  but does not contain registration process.</p>
  <p><a class="btn btn-secondary" href="{{ route('specialauth') }}" role="button">View details &raquo;</a></p>
  </div>
  <div class="col-md-5">
    <img src="/img/specialauth_login.png" />
  </div>
</div>
@endsection
