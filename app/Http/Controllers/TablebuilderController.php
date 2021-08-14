<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Seblhaire\TableBuilder\TableBuilderHelper;
use App\Models\Tablecontent;
use App\Utils\Countries;

class TablebuilderController extends Controller
{
  /**
   * Controller to display example tables in a page
   *
   * @return View
   */
  public function index()
  {
      // Fist table: contains every column type. Retrieves data from a database contained in memory
      $oTable = TableBuilderHelper::initTable('tabtest', route("tableload"), array(
          'buttons' => [ //buttons below table
              [
                  'id' => 'toto',
                  'em' => 'fas fa-search',
                  'action' => "multiselect", //js action triggered
                  'text' => 'Test multselect'
              ]
          ],
          'itemsperpage' => 20,
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
          'completetitle' => 'Rents a parking space',
          'aIcons' => array(
              "0" => array( // column value corresponding to icon
                  'class' => 'fas fa-square',
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
                  'em' => 'far fa-edit',
                  'text' => 'Edit',
                  'js' => "edit(#{id}, #{lastname},#{firstname})"
              ]
          )
      )));
      // Second table. Gets static data that can be sorted, paginated and filtered by search criteria
      $oTable2 = TableBuilderHelper::initTable('tabtest2', route("tableload2"));
      $oTable2->addColumn(TableBuilderHelper::initColumn('data', 'country', array(
          'title' => 'Country',
          'sortable' => true,
          'defaultOrder' => 'asc',
          'csrfrefreshroute' => route('refreshcsrf'), // route called if csrf token must be reloaded
      )));
      $oTable2->addColumn(TableBuilderHelper::initColumn('data', 'code', array(
          'title' => 'Code',
          'sortable' => true
      )));
      // Second table. Gets all static data without search criteria nor paginations
      $oTable3 = TableBuilderHelper::initTable('tabtest3', route("tableload2"), array(
          'itemsperpage' => 0,
          'searchable' => false,
          'csrfrefreshroute' => route('refreshcsrf'), // route called if csrf token must be reloaded
      ));
      $oTable3->addColumn(TableBuilderHelper::initColumn('data', 'country', array(
          'title' => 'Country'
      )));
      $oTable3->addColumn(TableBuilderHelper::initColumn('data', 'code', array(
          'title' => 'Code'
      )));
      return view('tablebuilder', array(
          'title' => 'Table builder',
          'menu' => 'tablebuilder',
          'oTable' => $oTable,
          'oTable2' => $oTable2,
          'oTable3' => $oTable3
      ));
  }

  /**
   * builds table data for dynamic tables
   *
   * @param Request $request
   *            request object sent to controller
   * @return Json object
   */
  public function loadTable(Request $request)
  {
      $test = new Tablecontent(); // inits data
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
      // adds a field to data to set certain data line in red
      $oTable->addMethodToDisplay(config('tablebuilder.table.rowcontextualtrigger'), function ($user) {
          // set a special color for row where user has a big wage
          if ($user->wage > 10000) {
              return 'table-danger';
          }
          return '';
      });
      // Adds a footer after table data, for example global figures, totals etc
      $oTable->setFooter('Footer to be displayed');
      // return data for table
      return $oTable->output();
  }

  /**
   * builds table data for static tables
   *
   * @param Request $request
   *            request object sent to controller
   * @return Json object
   */
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
          return (mb_stripos($data['code'], $this->searchTerm) !== false) || (mb_stripos($data['country'], $this->searchTerm) !== false);
      };
      // attach search function to databuilder
      $oTable->setSearchFunction($wherefn);
      // return data for table
      return $oTable->output();
  }
}
