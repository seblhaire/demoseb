<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Seblhaire\MenuAndTabUtils\MenuUtils;
use Seblhaire\MenuAndTabUtils\TabUtils;

class MenuUtilsController extends Controller
{
  public function index($type = 'simplenav')
  {
    if ($type == 'simplenav'){
      $element = MenuUtils::init('simple-nav', // main nav id
      [
        'current' => 'link1', // sets current ative element
          // 'ulclass' => 'nav', // this line is commented, since the value is the default one. Add other classes but make sure to keep the class "nav"
        'menu' => [ // defines the menu content
          'link1' => [ // array key is the menu element's id. Be sure to define an id not used elsewhere in doc
            'title' => 'Link 1', // label of menu element
            'target' => route('menuutils'), // route called in link
          ],
          'link2' => [
            'title' => 'Link 2',
            'target' => route('menuutils'),
          ],
          'link3' => [
            'icon' => '<i class="fa-solid fa-screwdriver-wrench"></i>', // icon displayed instead of text
            'title' => 'Tools', // since an icon is set, "title" is displayed on mouse hover
            'target' => route('menuutils'),
          ],
          'link4' => [
            'title' => 'Link 4',
            'dropdown' => [ // dropdown menu replaces default target
              'link4-1' => [ // drowpdown items are defined same way as level one items
                'title' =>'Link 4.1',
                'target' => route('menuutils'),
              ],
              'link4-2' => [
                'title' =>'Link 4.2',
                'target' => route('menuutils'),
              ],
              'sep' => null, // a separator is drawn if array value is null
              'link4-3' => [
                'title' =>'Link 4.3',
                'target' => route('menuutils'),
              ],
              'link4-4' => [
                'title' =>'Link 4.4',
                'target' => route('menuutils'),
              ],
            ]
          ],
        ]
      ]);
    }
    elseif ($type == 'verticalnav'){
      $element = MenuUtils::init('vertical-nav', //main nav id
      [
        'ulclass' => 'nav flex-column', // main class
        'current' => 'link6', // sets current ative element
        'menu' => [ // defines the menu content
          'link5' => [  // array key is the menu element's id. Be sure to define an id not used elsewhere in doc
            'title' => 'Link 1', // label of menu element
            'target' => route('menuutils'), // route called in link
          ],
          'link6' => [
            'title' => 'Link 2',
            'target' => route('menuutils'),
          ],
          'link7' => [
            'title' => 'Link 3',
            'target' => route('menuutils'),
          ],
          'link8' => [
            'title' => 'Dropdown menu',
            'dropdown' => [ // dropdown menu replaces default target
              'link8-1' => [ // drowpdown items are defined same way as level one items
                'title' =>'Link 4.1',
                'target' => route('menuutils'),
              ],
              'link8-2' => [
                'title' =>'Link 4.2',
                'target' => route('menuutils'),
              ],
              'link8-3' => [
                'title' =>'Link 4.3',
                'target' => route('menuutils'),
              ],
              'link8-4' => [
                'title' =>'Link 4.4',
                'target' => route('menuutils'),
              ],
            ]
          ],
        ]
      ]);
    }
    elseif ($type == 'htmltab'){
      $element = TabUtils::init('tabs-1', // main tab id
      [
        'current' => 'tab1', // sets current ative element
        'tabs' => [ // sets tabs elements
          'tab1' => [ // array key is the tab element's id. Be sure to define an id not used elsewhere in doc
            'title' => 'Tabs 1', // label of tab element
            'content' => // tab content in HTML code
              '<h4>Tab 1 content</h4><p>Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>'
          ],
          'tab2' => [
            'title' => 'Tab 2',
            'content' => '<h4>Tab 2 content</h4><p>Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>'
          ],
          'tab3' => [
            'title' => 'Tab 3',
            'content' => '<h4>Tab 3 content</h4><p>Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>'
          ],
          'tab4' => [
            'icon' => '<i class="fa-solid fa-screwdriver-wrench"></i>',
            'title' => 'Tab 4',
            'content' => '<h4>Tab 4 content</h4><p>Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>'
          ],
        ]
      ]);
    }
    elseif ($type == 'viewtab'){
      $element = TabUtils::init('tabs-2',  // main tab id
      [
        'current' => 'tab5', // sets current ative element
        'tabs' => [ // sets tabs elements
          'tab5' => [ // array key is the tab element's id. Be sure to define an id not used elsewhere in doc
            'title' => 'Tabs 1', // label of tab element
            'view' => 'tabs.tabcontent', // path of blade template
            'viewparams' => [ // parameters to be passed to view
              'title' => 'Tabs 1 content',
            ],
          ],
          'tab6' => [
            'title' => 'Tab 2',
            'view' => 'tabs.tabcontent',
            'viewparams' => [
              'title' => 'Tabs 2 content',
            ],
          ],
          'tab7' => [
            'title' => 'Tab 3',
            'view' => 'tabs.tabcontent',
            'viewparams' => [
              'title' => 'Tabs 3 content',
            ],
          ],
          'tab8' => [
            'title' => 'Tab 4',
            'view' => 'tabs.tabcontent',
            'viewparams' => [
              'title' => 'Tabs 4 content',
            ],
          ],
        ]
      ]);
    }
    elseif ($type == 'editortab'){
      $element = TabUtils::init('editors',  // main tab id
      [
        'current' => 'english', // sets current ative element
        'tabs' => [ // sets tabs elements
          'english' => [ // array key is the tab element's id. Be sure to define an id not used elsewhere in doc
            'title' => 'English', // label of tab element
            'view' => 'tabs.editors', // path of blade template
            'viewparams' => [ // parameters to be passed to view
              'titleid' => 'title-english', // title field id
              'titlefield' => 'title[english]', // title field name
              'titleval' => 'English Title', // title field content
              'editorid' => 'text-english', // editor id
              'editorfield' => 'text[english]', // editor textarea name
              'editorval' => '<p>My text in English</p>', // content inited in editor
            ],
          ],
          'french' => [
            'title' => 'French',
            'view' => 'tabs.editors',
            'viewparams' => [
              'titleid' => 'title-french',
              'titlefield' => 'title[french]',
              'titleval' => 'Titre français',
              'editorid' => 'text-french',
              'editorfield' => 'text[french]',
              'editorval' => '<p>Mon texte en français</p>',
            ],
          ],
          'german' => [
            'title' => 'German',
            'view' => 'tabs.editors',
            'viewparams' => [
              'titleid' => 'title-german',
              'titlefield' => 'title[german]',
              'titleval' => 'Deutsches Titel',
              'editorid' => 'text-german',
              'editorfield' => 'text[german]',
              'editorval' => '<p>Mein Text auf Deutsch</p>',
            ],
          ],
        ]
      ]);
    }
    $sidemenu = MenuUtils::init('menuutils-menu', [
      'ulclass' => 'nav flex-column sidemenu',
      'menu' => [
        'simplenav-menu' => [
          'title' => 'Simple navigation',
          'target' => route('menuutils', ['type' => 'simplenav'])
        ],
        'verticalnav-menu' => [
          'title' => 'Vertical navigation',
          'target' => route('menuutils', ['type' => 'verticalnav'])
        ],
        'htmltab-menu' => [
          'title' => 'Tabs with HTML content',
          'target' => route('menuutils', ['type' => 'htmltab'])
        ],
        'viewtab-menu' => [
          'title' => 'Tabs with view content',
          'target' => route('menuutils', ['type' => 'viewtab'])
        ],
        'editortab-menu' => [
          'title' => 'Tabs with editor',
          'target' => route('menuutils', ['type' => 'editortab'])
        ],
      ]
    ]);
    return view('menuutils', [
        'title' => 'Menu and Tab Utils',
        'type' => $type,
        'mainmenu' => $this->mainmenu->setCurrent('packages-topmenu'),
        'rightmenu' => $this->rightmenu,
        'sidemenu' => $sidemenu->setCurrent($type . '-menu'),
        'element' => $element,
      ]);
  }
}
