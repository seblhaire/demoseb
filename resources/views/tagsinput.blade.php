@extends('layout')

@section('title', $title)
@section('content')
<div class="row">
  <div class="col-sm-4">
			{!! $sidemenu !!}
		</div>
		<div class="col-sm-8">
<h3>Tags input</h3>
<p class="lead">
A Laravel library with jQuery add-on to add tags (Boostrap badges) selected by an
 auto-completer. Current version: {{ config('versions.tagsinput')}}.
 <a rel="noopener noreferrer" target="_blank" href="https://github.com/seblhaire/tagsinput">Project on GitHub</a>.
<a rel="noopener noreferrer" target="_blank" href="https://packagist.org/packages/seblhaire/tagsinput">Project on Packagist</a>.
This demosite sources available <a rel="noopener noreferrer" target="_blank" href="https://github.com/seblhaire/demoseb">here</a>.</p>
@if ($type == 'ex1')
  @include('tags.ex1')
@elseif ($type == 'ex2')
  @include('tags.ex2')
@endif
  <script type="text/javascript">
    var writeinarea = function(str){
      jQuery('#result').val(
        (jQuery('#result').val().length > 0 ? jQuery('#result').val()   + "\n"  : '' )
        + str
      );
    }
    var output = function(label, varia){
      var out = '';
      if (Array.isArray(varia)){
        var content = '';
        for (var i = 0; i < varia.length; i++){
          var el = varia[i];
          if (content.length > 0){
            content += ',';
          }
          if (typeof el == 'string'){
            content += '"' + el + '"';
          }else{
            content += el;
          }
        }
        out += '[' + content +  ']';
      }else{
        out += varia;
      }
      writeinarea(label + ': ' + out);
    }

    var showlist = function(tag, data, object){
      writeinarea(jQuery('#result').val().length > 0 ? "\n\n"  : '');
      output('tag', data.taglabel);
      output(object.taglistid + ' count', object.count());
      output(object.taglistid + ' getArrayValues', object.getArrayValues());
      output(object.taglistid + ' getCommaSepValues', object.getCommaSepValues());
      output(object.taglistid + ' serialize', object.serialize('servals'));
    }
  </script>
  </div>
</div>
@endsection
