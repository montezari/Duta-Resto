<?php

$moduleid = "report.pooverdue";

if(isset($_POST["supp"]) && $_POST["supp"] != ""){
  $supp = $_POST["supp"];
}else{
  $supp = 'ALL';
}

$reportTpl = new TTemplate($moduleid);
$reportTpl->moduleid  = $moduleid;
$reportTpl->template->MergeBlock("blk_supp","adodb","SELECT cKdSupplier, vNmSupplier FROM ".$config["db_mst"].".ms_supplier ORDER BY vNmSupplier");
$gTpl = new TBlock("form.general_box");
$gTpl->name		= "gTpl";
$gTpl->title    = "Purchase Order Over Due Report";
$gTpl->display  = $reportTpl->Show(false);
$content = $gTpl->Show(false);

?>