global.jQuery = require('jquery');
var $ = global.jQuery;
var jQuery = global.JQuery;
window.$ = $;
window.jQuery = jQuery;
require('bootstrap');
global.Clipboard = require('clipboard');

global.moment = require('moment');
require('daterangepicker');
require('../../vendor/seblhaire/daterangepickerhelper/resources/js/sebdaterangepicker.js');
require('../../vendor/seblhaire/tablebuilder/resources/js/tablebuilder.js');
require('../../vendor/seblhaire/uploader/resources/js/upload.js');
require('../../vendor/seblhaire/autocompleter/resources/js/autocompleter.js');
require('../../vendor/seblhaire/tagsinput/resources/js/tagsinput.js');
require('../../vendor/seblhaire/formsbootstrap/resources/js/seb.formsbootstrap.js');
require('../../vendor/seblhaire/formsbootstrap/resources/js/jquery.richtext.js');
require('./custom.js');
require('../../vendor/seblhaire/uploader/resources/js/UploadedFileContainerExt.js');
