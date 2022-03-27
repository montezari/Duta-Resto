<?php

$moduleid = "report.salessummary";

if(isset($_POST["blnawal"]) && $_POST["blnawal"] != ""){
  $bulanawal = $_POST["tahun"];
}else{
  $bulanawal = date('m');
}
if(isset($_POST["blnakhir"]) && $_POST["blnakhir"] != ""){
  $bulanakhir = $_POST["blnakhir"];
}else{
  $bulanakhir = date('m');
}
if(isset($_POST["tahun"]) && $_POST["tahun"] != ""){
  $tahun = $_POST["tahun"];
}else{
  $tahun = date('Y');
}

$reportTpl = new TTemplate($moduleid);
$reportTpl->moduleid  = $moduleid;
$reportTpl->template->MergeBlock("bln_awal",$arr_month);
$reportTpl->template->MergeBlock("bln_akhir",$arr_month);
$gTpl = new TBlock("form.general_box");
$gTpl->name		= "gTpl";
$gTpl->title    = "Sales Summary Report";
$gTpl->display  = $reportTpl->Show(false);
$content = $gTpl->Show(false);

?>