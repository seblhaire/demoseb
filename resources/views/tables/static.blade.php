<h4>Table inited with static data</h4>
<p>Controller method for view</p>
<p>In your controller create an instance of TableBuilderHelper and pass the variable to the view.</p>
<pre>
<code>
$oTable = TableBuilderHelper::initTable('tabtest2', route("tableload2"));
$oTable->addColumn(TableBuilderHelper::initColumn('data', 'country', array(
    'title' => 'Country',
    'sortable' => true,
    'defaultOrder' => 'asc'
)));
$oTable->addColumn(TableBuilderHelper::initColumn('data', 'code', array(
    'title' => 'Code',
    'sortable' => true
)));
return view('template', ['oTable' => $oTable]);
</code>
</pre>
<p>Insert following in blade template: <code>@{!! $oTable->output() !!}</code></p>
<p>Controller method for data:</p>
<pre>
<code>
public function loadTable2(Request $request)
{
    $oTable = TableBuilderHelper::initDataBuilder($request);
    // gets static data and builds datas
    $countries = Countries::getList();
    shuffle($countries);
    foreach ($countries as $item) {
        $oTable->addLine($item);
    }
    // builds a search function for search field
    $wherefn = function ($data) {
        return (mb_stripos($data['code'], $this->searchTerm) !== false) ||
        (mb_stripos($data['country'], $this->searchTerm) !== false);
    };
    // attach search function to databuilder
    $oTable->setSearchFunction($wherefn);
    // return data for table
    return $oTable->output();
}
</code>
</pre>
<h4>Demo</h4>
{!! $oTable->output() !!}
