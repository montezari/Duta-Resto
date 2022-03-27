<?php

$moduleid = "report.salesdetail";

if(isset($_POST["tglawal"]) && $_POST["tglawal"] != ""){
  $tgl = explode("/",$_POST["tglawal"]);
  $tglawal = $tgl[2]."-".$tgl[1]."-".$tgl[0];
}else{
  $tglawal = date('Y-m-01');
}
if(isset($_POST["tglakhir"]) && $_POST["tglakhir"] != ""){
  $tgl = explode("/",$_POST["tglakhir"]);
  $tglakhir = $tgl[2]."-".$tgl[1]."-".$tgl[0];
}else{
  $tglakhir = date('Y-m-d');
}

$reportTpl = new TTemplate($moduleid);
$reportTpl->moduleid  = $moduleid;
$gTpl = new TBlock("form.general_box");
$gTpl->name		= "gTpl";
$gTpl->title    = "Sales Detail Report";
$gTpl->display  = $reportTpl->Show(false);
$content = $gTpl->Show(false);

?>