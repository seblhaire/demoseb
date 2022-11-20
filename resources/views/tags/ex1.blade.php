<h3>Example 1: tags list with add button</h3>
<p>In this example, you can search in employee list, or add a new employee by clicking button. If you select an employee that you already have selected before, it will be
ignored. You can reorder tags by drag and drop. In the above list, we write the different outputs that can be used in your scripts, for intance to add entries to a table.
 But by default, we insert comma-separated result in a hidden input named <code>tagzone-result</code>.</p>
<p>In your controller create an instance of TagsinputHelper and pass the variable to the view.</p>
<pre>
<code>
$tagszone = TagsinputHelper::init(
  "tagzone", //id
  'Employees', // label
  route('tagsinputsearch'), //autocompleter script
  [ //Autocompleter parameters
    'csrfrefreshroute' => route('refreshcsrf') // route called if csrf token must be reloaded
  ],
  [ //tagsinput parameters
    'tagaddcallback' => 'showlist', // callback functions called after tag is addded
    'tagremovecallback' => 'showlist'
  ]
);
return view('template', ['tagszone' => $tagszone]);
</code></pre>
<p>Then just insert the variable in the appropriate section in your view: <code>@{!! $tagszone !!}</code>.
  Callback functions have the following signature: <code>function(tag, data, object)</code>.</p>
<form id="fakeform">
{!! $tagszone !!}
<h3>Results</h3>
<div class="form-group">
<label>List outputs</label>
<textarea class="form-control" id="result" name="result" style="height:500px"></textarea>
</div>
</form>
<script type="text/javascript">
jQuery('#fakeform').on('submit', function(e){ e.preventDefault();});
jQuery('#tagzone_addbtn').on('click', function(){
  jQuery('#firstname').val('');
  jQuery('#lastname').val('');
  jQuery('#addEmployeeModal').modal('show');
});
</script>
<div class="modal fade" id="addEmployeeModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addEmployeeLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"  id="addEmployeeLabel">Add employee</h5>
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
