@extends('layout')

@section('title', $title)
@section('content')
<h1>Tags input</h1>
<p class="lead">
A Laravel library with jQuery add on to add tags input field with auto-completer. <a rel="noopener noreferrer" target="_blank" href="https://github.com/seblhaire/tagsinput">Project on GitHub</a>.
<a rel="noopener noreferrer" target="_blank" href="https://packagist.org/packages/seblhaire/tagsinput">Project on Packagist</a>.
This demosite sources available <a rel="noopener noreferrer" target="_blank" href="https://github.com/seblhaire/demoseb">here</a>.</p>
<form>
  <h2>Example 1: tags list with add button</h2>
  <p>In this example, you can search in employee list, or add a new employee by clicking button. If you select an employee that you already have selected before, it will be
  ignored. You can reorder tags by drag and drop. In the above list, we write the different outputs that can be used in your scripts, for intance to add entries to a table.</p>
  {!! $tagszone !!}
  <h2>Example 2: tags list with pre-existing tags</h2>
  <p>In this example, we pre-add elements in tag list. This will be useful to update existing entries in tables. We change default tag style by inserting a class name in a special field 'tagclass'.</p>
  {!! $tagszone2 !!}
  <h3>Results</h3>
<div class="form-group">
  <label>List outputs</label>
  <textarea class="form-control" id="result" name="result" style="height:500px"></textarea>
</div>
  <script type="text/javascript">
    jQuery(document).ready(function() {
      {!! $tagszone2->printAddToList("[{code:'CH', taglabel:'CH: Switzerland'},{code:'FR', taglabel:'FR: France'},{code:'GD', taglabel:'GD: Groland', tagclass:'bg-danger'}]")!!};
    });

    jQuery('#tagzone_addbtn').bind('click', function(){
      jQuery('#firstname').val('');
      jQuery('#lastname').val('');
      jQuery('#addEmployeeModal').modal('show');
    });

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
      jQuery('#result').val(
        (jQuery('#result').val().length > 0 ? jQuery('#result').val()   + "\n"  : '' )
        + label + ': ' + out
      );
    }

    var showlist = function(tag, object){
      output('tag', tag.data('tagdata').taglabel);
      output(object.taglistid + ' count', object.count());
      output(object.taglistid + ' getArrayValues', object.getArrayValues());
      output(object.taglistid + ' getCommaSepValues', object.getCommaSepValues());
      output(object.taglistid + ' serialize', object.serialize('servals'));
    }
  </script>
</form>
<div class="modal fade" id="addEmployeeModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addEmployeeLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"  id="exampleModalLabel">Add employee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addEmployee">
          <div class="form-group">
            <label for="lastname">Last name</label>
            <input class="form-control" id="lastname" name="lastname"/>
          </div>
          <div class="form-group">
            <label for="firstname">First name</label>
            <input class="form-control" id="firstname" name="firstname"/>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" id="addEmployeeBtn" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  <script type="text/javascript">
    jQuery('#addEmployeeBtn').bind('click', function(e){
        e.preventDefault();
        jQuery.ajax({
          url: '{!! route("tagsinputaddemployee") !!}',
          encoding: 'utf8',
          data: {
            firstname: jQuery('#firstname').val(),
            lastname: jQuery('#lastname').val()
          },
          type: 'post',
          dataType: 'json',
          cache: false,
          headers: {
            'X-CSRF-Token': '{!! csrf_token() !!}'
          }
        }).done(function( data ) {
          jQuery('#addEmployeeModal').modal('hide');
          var content = data.res;
          {!! $tagszone->printAddToList('content')!!}
        }).fail(function(jqXHR, textStatus, errorThrown) {
          if (jqXHR.status == 419){
            self.refreshToken();
            jQuery('#addEmployeeBtn').trigger( "click" );
          }
        });
    });
  </script>
</div>
@endsection
