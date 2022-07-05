<h4>Dynamic table</h4>
<p>In the code, some values are printed with Javascript command <code>console.log(data)</code>. Open developper console with <kbd>F12</kbd>, then click tab "Console"</p>
<p>In your controller create an instance of TableBuilderHelper and pass the variable to the view.</p>
<pre>
<code>
// init table object
$oTable = TableBuilderHelper::initTable(
    'tabtest', //table id
    route("tableload"), // route of table loader
    array( //options
    'buttons' => [ //buttons below table
        [
            'id' => 'toto', //button id
            'em' => 'fas fa-search', //button icon
            'action' => "multiselect", //js action triggered
            'text' => 'Test multselect' // button test
        ]
    ],
    'itemsperpage' => 20, //default elements per page
    'eltsPerPageChngCallback' => 'eltspagechanged', // js function triggered when elements per page changed
    'aftertableload' => 'aftertableload', // js function: callback after table load
    'csrfrefreshroute' => route('refreshcsrf'), // route called if csrf token must be reloaded
));
// add columns
$oTable->addColumn(TableBuilderHelper::initColumn('numeric', 'id', array(
    'title' => 'Id',
    'completetitle' => 'Employee id',
    'sortable' => true
)));
$oTable->addColumn(TableBuilderHelper::initColumn('data', 'lastname', array(
    'title' => 'Last name',
    'sortable' => true,
    'defaultOrder' => 'asc',
    'customAsc' => 'lastname:asc;firstname:asc', // sort columns
    'customDesc' => 'lastname:desc;firstname:desc'
)));
$oTable->addColumn(TableBuilderHelper::initColumn('data', 'firstname', array(
    'title' => 'First name'
)));
$oTable->addColumn(TableBuilderHelper::initColumn('date', 'birthday', array(
    'title' => 'Birth date',
    'format' => "yyyy-MM-DD", // date format in moment.js format
    'sortable' => true
)));
$oTable->addColumn(TableBuilderHelper::initColumn('image', 'avatar', array(
    'title' => 'Avatar',
    'tag' => 'img'
)));
$oTable->addColumn(TableBuilderHelper::initColumn('mail', 'email', array(
    'title' => 'Email',
    'sortable' => true
)));
$oTable->addColumn(TableBuilderHelper::initColumn('link', 'homepage', array(
    'title' => 'Homepage',
    'sortable' => true
)));
$oTable->addColumn(TableBuilderHelper::initColumn('numeric', 'wage', array(
    'title' => 'Wages',
    'decimals' => 2,
    'thousandsep' => "'",
    'currency' => '$',
    'currencyposafter' => false, //currency symbol before amount
    'decimalsep' => '.'
)));
$oTable->addColumn(TableBuilderHelper::initColumn('status', 'hasparking', array(
    'title' => 'Parking?',
    'completetitle' => 'Rents a parking space', // on hover
    'aIcons' => array(
        "0" => array( // column value corresponding to icon
            'class' => 'fas fa-square', //icon displayed
            'title' => 'no',
            'style' => 'color:red'
        ),
        "1" => array(
            'class' => 'fas fa-square',
            'title' => 'yes',
            'style' => 'color:green'
        )
    )
)));
$oTable->addColumn(TableBuilderHelper::initColumn('checkbox', 'selected', array(
    'title' => 'HO',
    'completetitle' => 'Home office ?',
    'action' => 'checkboxclick' // js action triggered when cicking checkbox
)));
// actions
$oTable->addColumn(TableBuilderHelper::initColumn('action', 'actions', array(
    'title' => 'Actions',
    'actions' => array(
        [
            'em' => 'far fa-edit', // action icon
            'text' => 'Edit',
            'js' => "edit" // function called when clicked
        ]
    )
)));
return view('template', ['oTable' => $oTable]);
</code>
</pre>
<p>Insert following in blade template: <code>@{!! $oTable->output() !!}</code></p>
<p>Controller method for data:</p>
<pre>
<code>
public function loadTable(Request $request)
{
  $test = new Tablecontent(); // inits database
  $oTable = TableBuilderHelper::initDataBuilder($request); // init table data builder object
  $oTable->setQuery($test); // passes Eloquent table object to data Builder
                            // builds a search function for search field
  $wherefn = function ($query) {
      $query->where('lastname', 'like', '%' . $this->searchTerm . '%')
          ->orwhere('firstname', 'like', '%' . $this->searchTerm . '%')
          ->orwhere('email', 'like', '%' . $this->searchTerm . '%');
  };
  // attach search function to databuilder
  $oTable->setSearchFunction($wherefn);
  // adds a field to data (dummy example)
  $oTable->addMethodToDisplay('selected', function ($test) {
      $collection = collect([
          0,
          1
      ]); // dummy example function to issue true or false
      return $collection->random();
  });
  /* DISABLED
  adds a field to data to set certain data line in red
  $oTable->addMethodToDisplay(config('tablebuilder.table.rowcontextualtrigger'), function ($user) {
      // set a special color for row where user has a big wage
      if ($user->wage > 10000) {
          return 'table-danger';
      }
      return '';
  });*/
  // Adds a footer after table data, for example global figures, totals etc
  $oTable->setFooter('Total lines: ' . $test->count());
  // return data for table
  return $oTable->output();
}
</code>
</pre>
<h4>Demo</h4>
{!! $oTable->output() !!}
<script>
    var multiselect = function(data){
        console.log(data);
    }
    var checkboxclick = function(event){
        console.log(event.data.elt.prop('checked'));
        console.log(event.data.content);
        console.log(event.data.index);

    }
    var edit = function(data){
      console.log('edit #' + data.id + ' ' + data.lastname + ' ' + data.firstname);
    }
    var eltspagechanged = function(iNbPages){
      alert(iNbPages + ' selected')
    }
    var aftertableload = function(tableobject, data){
      console.log(tableobject);
      console.log(data);
    }
</script>
