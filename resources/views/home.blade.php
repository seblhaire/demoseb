@extends('layout')

@section('title', 'Home')
@section('content')
<div class="jumbotron">
  <h1 class="display-4">Seb's Laravel Package Demo Site</h1>
  <p class="lead">My name is <a href="https://sebastien.lhaire.org">Sébastien L'haire</a>. I work as web developper.
  I developp <a target="_blank" href="https://laravel.com">Laravel packages</a>
  for the personal sites I build.</p>
  <p>These packages are freely available for the web community on <a target="_blank" href="https://packagist.org/packages/seblhaire/">Packagist</a>.
  Source files are available on <a target="_blank" href="https://github.com/seblhaire/">GitHub</a>. You can fork the projects to adapt them to your needs,
  notify bugs or propose merge requests. Translation files in your own language are very welcome.</p>
</div>
<div class="row">
      <div class="col-md-7">
        <h2>Bootstrap Paginator</h2>
        <h3>Generate paginators.</h3>

        <p class="lead">Two different pagnators:
		a classical paginator with page numbers and previous and next button. paginator image and an alphabetical paginator with letters </p>
		<p><a class="btn btn-secondary" href="{{ route('paginator') }}" role="button">View details &raquo;</a></p>
      </div>
      <div class="col-md-5">
        <img src="/img/paginator.png" /><br/><br/>
        <img style="max-width:100%" src="/img/paginatoralpha.png" />
      </div>
</div>
<hr />
@endsection
