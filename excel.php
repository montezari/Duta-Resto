<?php

require_once "includes/global.inc.php";
require_once "modules/xls/repo.inc.php";

ini_set('max_execution_time',1200);

if(isset($_SESSION["Logged"])){

  $today = date("Ymd_His");
  if($_REQUEST["id"]=="report.salessummary"){
	$xlsrpt = new TExcelRptSalesSummary();
    $xlsrpt->doExportXls();
  }else if($_REQUEST["id"]=="report.salesdetail"){
	$xlsrpt = new TExcelRptSalesDetail();
    $xlsrpt->doExportXls();
  }else if($_REQUEST["id"]=="report.posummary"){
	$xlsrpt = new TExcelRptPOSummary();
    $xlsrpt->doExportXls();
  }else if($_REQUEST["id"]=="report.stockcard"){
	$xlsrpt = new TExcelRptStockCard();
    $xlsrpt->doExportXls();
  }



}

?>