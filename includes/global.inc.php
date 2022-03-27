<?php

require_once "lang.inc.php";
require_once "config.inc.php";
require_once "connect.inc.php";
require_once "function.inc.php";
require_once "tbs/tbsdb_jladodb.php";
require_once "tbs/tbs_class.php";
require_once "tbs/tbs_plugin_html.php";
require_once "core/db.core.php";
require_once "core/tpl.core.php";
require_once "core/menu.core.php";
require_once 'PHPMailer/PHPMailerAutoload.php';
//require_once "core/GoogleCloudPrint.php";
if(isset($_REQUEST["export"])){
  require_once 'html2pdf/html2pdf.class.php';
  require_once 'phpexcel/PHPExcel.php';
  require_once 'phpexcel/PHPExcel/IOFactory.php';
  require_once 'phpexcel/PHPExcel/Cell/AdvancedValueBinder.php';
  require_once "core/excel.core.php";
}

?>