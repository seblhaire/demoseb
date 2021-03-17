@extends('layout')

@section('title', $title)
@section('content')
<h3>{{ $title }}</h3>
<p>A Laravel library to build tables easily, which interacts with a lightweight js builder and builds data from Eloquent Object-Relational Mapping
  with database tables. Table can also load static data.
  <a target="_blank" href="https://github.com/seblhaire/tablebuilder">Project on GitHub</a>.
  <a target="_blank" href="https://packagist.org/packages/seblhaire/tablebuilder">Project on Packagist</a>.
  This demosite sources available <a target="_blank" href="https://sebastien.lhaire.org/paginator">here</a>.
</p>
<h4>Complete dynamic example</h4>
  {!! $oTable->output() !!}
  <br/><br/><br/><br/>
  <h4>Table inited with static data</h4>
  <br/><br/>
  {!! $oTable2->output() !!}
  <br/><br/><br/><br/>
  <h4>Table inited with static data, no pagination, no search</h4>
  <br/><br/>
  {!! $oTable3->output() !!}
  <script>
      var multiselect = function(data){
          console.log(data);
      }
      var checkboxclick = function(event){
          console.log(event.data.elt.prop('checked'));
          console.log(event.data.content);
          console.log(event.data.index);

      }
      var edit = function(id, lastname, firstname){
        alert('edit #' + id + ' ' + lastname + ' ' + firstname);
      }
      var eltspagechanged = function(iNbPages){
        alert(iNbPages + ' selected')
      }
      var aftertableload = function(tableobject, data){
        console.log(tableobject);
        console.log(data);
      }
  </script>
@endsection
