<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Seblhaire\TableBuilder\TableBuilderHelper;
use App\Models\Tablecontent;

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
          'buttons' => [
              [
                  'id' => 'toto',
                  'em' => 'fas fa-search',
                  'action' => "multiselect",
                  'text' => 'Test multselect'
              ]
          ],
          'itemsperpage' => 20,
          'eltsPerPageChngCallback' => 'eltspagechanged',
          'aftertableload' => 'aftertableload',
          'csrfrefreshroute' => route('refreshcsrf'),
      ));
      $oTable->addColumn(TableBuilderHelper::initColumn('numeric', 'id', array(
          'title' => 'Id',
          'completetitle' => 'Employee id',
          'sortable' => true
      )));
      $oTable->addColumn(TableBuilderHelper::initColumn('data', 'lastname', array(
          'title' => 'Last name',
          'sortable' => true,
          'defaultOrder' => 'asc',
          'customAsc' => 'lastname:asc;firstname:asc',
          'customDesc' => 'lastname:desc;firstname:desc'
      )));
      $oTable->addColumn(TableBuilderHelper::initColumn('data', 'firstname', array(
          'title' => 'First name'
      )));
      $oTable->addColumn(TableBuilderHelper::initColumn('date', 'birthday', array(
          'title' => 'Birth date',
          'format' => "yyyy-MM-DD",
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
          'currencyposafter' => false,
          'decimalsep' => '.'
      )));
      $oTable->addColumn(TableBuilderHelper::initColumn('status', 'hasparking', array(
          'title' => 'Parking?',
          'completetitle' => 'Rents a parking space',
          'aIcons' => array(
              "0" => array(
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
          'action' => 'checkboxclick'
      )));
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
          'csrfrefreshroute' => route('refreshcsrf'),
      )));
      $oTable2->addColumn(TableBuilderHelper::initColumn('data', 'code', array(
          'title' => 'Code',
          'sortable' => true
      )));
      // Second table. Gets all static data without search criteria nor paginations
      $oTable3 = TableBuilderHelper::initTable('tabtest3', route("tableload2"), array(
          'itemsperpage' => 0,
          'searchable' => false,
          'csrfrefreshroute' => route('refreshcsrf'),
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
      foreach ($this->getCountryList() as $item) {
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

  /**
   * gets data to be inserted staticaly in example table
   *
   * @return [type] [description]
   */
  private function getCountryList()
  {
      $data = [
          'AD' => 'Andorra',
          'AE' => 'United Arab Emirates',
          'AF' => 'Afghanistan',
          'AG' => 'Antigua and Barbuda',
          'AI' => 'Anguilla',
          'AL' => 'Albania',
          'AM' => 'Armenia',
          'AO' => 'Angola',
          'AQ' => 'Antarctica',
          'AR' => 'Argentina',
          'AS' => 'American Samoa',
          'AT' => 'Austria',
          'AU' => 'Australia',
          'AW' => 'Aruba',
          'AX' => 'Åland Islands',
          'AZ' => 'Azerbaijan',
          'BA' => 'Bosnia and Herzegovina',
          'BB' => 'Barbados',
          'BD' => 'Bangladesh',
          'BE' => 'Belgium',
          'BF' => 'Burkina Faso',
          'BG' => 'Bulgaria',
          'BH' => 'Bahrain',
          'BI' => 'Burundi',
          'BJ' => 'Benin',
          'BL' => 'Saint Barthélemy',
          'BM' => 'Bermuda',
          'BO' => 'Bolivia',
          'BQ' => 'Bonaire, Sint Eustatius and Saba',
          'BR' => 'Brazil',
          'BS' => 'Bahamas',
          'BT' => 'Bhutan',
          'BV' => 'Bouvet Island',
          'BW' => 'Botswana',
          'BY' => 'Belarus',
          'BZ' => 'Belize',
          'CA' => 'Canada',
          'CC' => 'Cocos (Keeling) Islands',
          'CD' => 'Congo, Democratic Republic of the',
          'CF' => 'Central African Republic',
          'CG' => 'Congo',
          'CH' => 'Switzerland',
          'CI' => "Ivory Coast",
          'CK' => 'Cook Islands',
          'CL' => 'Chile',
          'CM' => 'Cameroon',
          'CN' => 'China',
          'CO' => 'Colombia',
          'CR' => 'Costa Rica',
          'CU' => 'Cuba',
          'CV' => 'Cabo Verde',
          'CW' => 'Curaçao',
          'CX' => 'Christmas Island',
          'CY' => 'Cyprus',
          'CZ' => 'Czechia',
          'DE' => 'Germany',
          'DJ' => 'Djibouti',
          'DK' => 'Denmark',
          'DM' => 'Dominica',
          'DO' => 'Dominican Republic',
          'DZ' => 'Algeria',
          'EC' => 'Ecuador',
          'EE' => 'Estonia',
          'EG' => 'Egypt',
          'EH' => 'Western Sahara',
          'ER' => 'Eritrea',
          'ES' => 'Spain',
          'ET' => 'Ethiopia',
          'FI' => 'Finland',
          'FJ' => 'Fiji',
          'FK' => 'Falkland Islands (Malvinas)',
          'FM' => 'Micronesia',
          'FO' => 'Faroe Islands',
          'FR' => 'France',
          'GA' => 'Gabon',
          'GB' => 'United Kingdom of Great Britain and Northern Ireland',
          'GD' => 'Grenada',
          'GE' => 'Georgia',
          'GF' => 'French Guiana',
          'GG' => 'Guernsey',
          'GH' => 'Ghana',
          'GI' => 'Gibraltar',
          'GL' => 'Greenland',
          'GM' => 'Gambia',
          'GN' => 'Guinea',
          'GP' => 'Guadeloupe',
          'GQ' => 'Equatorial Guinea',
          'GR' => 'Greece',
          'GS' => 'South Georgia and the South Sandwich Islands',
          'GT' => 'Guatemala',
          'GU' => 'Guam',
          'GW' => 'Guinea-Bissau',
          'GY' => 'Guyana',
          'HK' => 'Hong Kong',
          'HM' => 'Heard Island and McDonald Islands',
          'HN' => 'Honduras',
          'HR' => 'Croatia',
          'HT' => 'Haiti',
          'HU' => 'Hungary',
          'ID' => 'Indonesia',
          'IE' => 'Ireland',
          'IL' => 'Israel',
          'IM' => 'Isle of Man',
          'IN' => 'India',
          'IO' => 'British Indian Ocean Territory',
          'IQ' => 'Iraq',
          'IR' => 'Iran',
          'IS' => 'Iceland',
          'IT' => 'Italy',
          'JE' => 'Jersey',
          'JM' => 'Jamaica',
          'JO' => 'Jordan',
          'JP' => 'Japan',
          'KE' => 'Kenya',
          'KG' => 'Kyrgyzstan',
          'KH' => 'Cambodia',
          'KI' => 'Kiribati',
          'KM' => 'Comoros',
          'KN' => 'Saint Kitts and Nevis',
          'KP' => 'North Korea',
          'KR' => 'South Korea',
          'KW' => 'Kuwait',
          'KY' => 'Cayman Islands',
          'KZ' => 'Kazakhstan',
          'LA' => 'Laos',
          'LB' => 'Lebanon',
          'LC' => 'Saint Lucia',
          'LI' => 'Liechtenstein',
          'LK' => 'Sri Lanka',
          'LR' => 'Liberia',
          'LS' => 'Lesotho',
          'LT' => 'Lithuania',
          'LU' => 'Luxembourg',
          'LV' => 'Latvia',
          'LY' => 'Libya',
          'MA' => 'Morocco',
          'MC' => 'Monaco',
          'MD' => 'Moldova',
          'ME' => 'Montenegro',
          'MF' => 'Saint Martin',
          'MG' => 'Madagascar',
          'MH' => 'Marshall Islands',
          'MK' => 'North Macedonia',
          'ML' => 'Mali',
          'MM' => 'Myanmar',
          'MN' => 'Mongolia',
          'MO' => 'Macao',
          'MP' => 'Northern Mariana Islands',
          'MQ' => 'Martinique',
          'MR' => 'Mauritania',
          'MS' => 'Montserrat',
          'MT' => 'Malta',
          'MU' => 'Mauritius',
          'MV' => 'Maldives',
          'MW' => 'Malawi',
          'MX' => 'Mexico',
          'MY' => 'Malaysia',
          'MZ' => 'Mozambique',
          'NA' => 'Namibia',
          'NC' => 'New Caledonia',
          'NE' => 'Niger',
          'NF' => 'Norfolk Island',
          'NG' => 'Nigeria',
          'NI' => 'Nicaragua',
          'NL' => 'Netherlands',
          'NO' => 'Norway',
          'NP' => 'Nepal',
          'NR' => 'Nauru',
          'NU' => 'Niue',
          'NZ' => 'New Zealand',
          'OM' => 'Oman',
          'PA' => 'Panama',
          'PE' => 'Peru',
          'PF' => 'French Polynesia',
          'PG' => 'Papua New Guinea',
          'PH' => 'Philippines',
          'PK' => 'Pakistan',
          'PL' => 'Poland',
          'PM' => 'Saint Pierre and Miquelon',
          'PN' => 'Pitcairn',
          'PR' => 'Puerto Rico',
          'PS' => 'Palestine',
          'PT' => 'Portugal',
          'PW' => 'Palau',
          'PY' => 'Paraguay',
          'QA' => 'Qatar',
          'RE' => 'Réunion',
          'RO' => 'Romania',
          'RS' => 'Serbia',
          'RU' => 'Russia',
          'RW' => 'Rwanda',
          'SA' => 'Saudi Arabia',
          'SB' => 'Solomon Islands',
          'SC' => 'Seychelles',
          'SD' => 'Sudan',
          'SE' => 'Sweden',
          'SG' => 'Singapore',
          'SH' => 'Saint Helena, Ascension and Tristan da Cunha',
          'SI' => 'Slovenia',
          'SJ' => 'Svalbard and Jan Mayen',
          'SK' => 'Slovakia',
          'SL' => 'Sierra Leone',
          'SM' => 'San Marino',
          'SN' => 'Senegal',
          'SO' => 'Somalia',
          'SR' => 'Suriname',
          'SS' => 'South Sudan',
          'ST' => 'Sao Tome and Principe',
          'SV' => 'El Salvador',
          'SX' => 'Sint Maarten',
          'SY' => 'Syria',
          'SZ' => 'Eswatini',
          'TC' => 'Turks and Caicos Islands',
          'TD' => 'Chad',
          'TF' => 'French Southern Territories',
          'TG' => 'Togo',
          'TH' => 'Thailand',
          'TJ' => 'Tajikistan',
          'TK' => 'Tokelau',
          'TL' => 'Timor-Leste',
          'TM' => 'Turkmenistan',
          'TN' => 'Tunisia',
          'TO' => 'Tonga',
          'TR' => 'Turkey',
          'TT' => 'Trinidad and Tobago',
          'TV' => 'Tuvalu',
          'TW' => 'Taiwan',
          'TZ' => 'Tanzania',
          'UA' => 'Ukraine',
          'UG' => 'Uganda',
          'UM' => 'United States Minor Outlying Islands',
          'US' => 'United States of America',
          'UY' => 'Uruguay',
          'UZ' => 'Uzbekistan',
          'VA' => 'Holy See',
          'VC' => 'Saint Vincent and the Grenadines',
          'VE' => 'Venezuela',
          'VG' => 'Virgin Islands (British)',
          'VI' => 'Virgin Islands (U.S.)',
          'VN' => 'Viet Nam',
          'VU' => 'Vanuatu',
          'WF' => 'Wallis and Futuna',
          'WS' => 'Samoa',
          'YE' => 'Yemen',
          'YT' => 'Mayotte',
          'ZA' => 'South Africa',
          'ZM' => 'Zambia',
          'ZW' => 'Zimbabwe'
      ];
      $result = [];
      foreach ($data as $code => $country) {
          $result[] = [
              'code' => $code,
              'country' => $country
          ];
      }
      shuffle($result);
      return $result;
  }
}
