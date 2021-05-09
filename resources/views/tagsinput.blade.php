@extends('layout')

@section('title', $title)
@section('content')
<h1>Tags input</h1>
<form>
  <h2>Test</h2>
  <div class="form-group row" id="tagzone"></div>
  <script type="text/javascript">
      jQuery(document).ready(function() {
        jQuery('#tagzone').tagsinput('Test seb', '', {
          divfirstclass : 'col-sm-2',
          divsecondclass : 'col-sm-3',
          divthirdclass : 'col-sm-7',
          labelclass : 'col-form-label',
          inputcontainerclass : 'input-group',
          inputclass : 'form-control',
          addbuttoncontainerclass : 'input-group-append',
          addbuttonclass : 'btn btn-primary',
          buttonlabelclass : 'fas fa-plus-circle',
          taglistclass : 'taglist',
          tagclass : 'badge-primary',
          tagremovebtnclass : 'fas fa-trash-alt',
          helptextclass : 'taginputhelper',
          helptext : 'toto',
          showaddbutton : true,
          tagaddcallback: addtag,
          tagremovecallback: removetag,
        });
        jQuery('#tagzone').data('tagsinput').addtolist([{value:'FR', label:'France'}, {value:'US', label:'United States'}, {value:'CH', label:'Switzerland'}]);
      });
      var removetag = function(tag){
        console.log('remove ' + jQuery(tag).attr('tagval'));
      }
      var addtag = function(tag){
        console.log('add ' + jQuery(tag).attr('tagval'));
      }
  </script>
  <h2>Test 2</h2>
  <div class="form-group row">
    <div class="col-sm-2">
      <label for="input_auto" class="col-form-label">Country</label>
    </div>
    <div class="col-sm-3">
      <div class="input-group">
        <input type="text" id="input_auto" class="form-control" />
        <div class="input-group-append">
           <button class="btn btn-primary" type="button"><i class="fas fa-plus-circle"></i></button>
        </div>
      </div>
    </div>
    <div class="col-sm-7">
        <ul class="taglist">
          <li><span class="badge badge-primary">Primary <a href=""><i class="fas fa-trash-alt"></i></a></span></li>
          <li><span class="badge badge-secondary">Secondary <a href=""><i class="fas fa-trash-alt"></i></a></span></span></li>
        </ul>
    </div>
    <p class="taginputhelper">We'll never share your email with anyone else.</p>
  </div>
</form>
@endsection
