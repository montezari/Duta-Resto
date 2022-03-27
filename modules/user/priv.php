<?php

$mode = $_REQUEST["mode"] == "form" ? 1 : 0;

if(strtoupper($_POST["FormAction"])=="SIMPAN"){
  if($_POST["fkey"] != ""){
    $sql  = "delete from tsm_priv where cKdGroupUser = '$_POST[fkey]' ";
	$conn->Execute($sql); 
	foreach($_POST["cview"] as $k=>$v){
      $val_aktif = $_POST["cview"][$k] == "" ? "0" : "1"; 
	  $sql  = "insert into tsm_priv (cKdGroupUser,cKdModuleId, cView) ";
      $sql .= "values('$_POST[fkey]','".$_POST["cview"][$k]."','".$val_aktif."') ";
	  $conn->Execute($sql);
	}
	$sql  = "INSERT INTO tsm_priv (cKdGroupUser,cKdModuleId, cView) ";
	$sql .= "SELECT '$_POST[fkey]' AS cKdGroupUser, tbl.fparent, '1' ";  
	$sql .= "FROM ( ";
	$sql .= "  SELECT DISTINCT mnu.fparent ";
	$sql .= "  FROM tsm_menu mnu ";
	$sql .= "  LEFT JOIN tsm_priv priv ON priv.cKdModuleId = mnu.fmenu AND priv.cKdGroupUser = '$_POST[fkey]' ";
	$sql .= "  WHERE mnu.fnoedit = '0' AND COALESCE(priv.cView,0) = '1' AND mnu.fparent IS NOT NULL ";
	$sql .= ") tbl ";
	$conn->Execute($sql);

  }
  header("Location: $config[http]$_SERVER[REQUEST_URI]");
  exit;
}

$admGrdTpl = new TGridTemplate("user.priv");
$sql  = "select * from tsm_groupuser "; 
if($_GET["key"] != "" || $_GET["mode"] == "form"){
  $sql .= " WHERE cKdGroupUser = '$_GET[key]' ";
}
$sql .= "ORDER BY cKdGroupUser ";
$admGrdTpl->moduleid  = "user.priv";
$admGrdTpl->delform   = "m=user.priv&page=$_GET[page]";
$admGrdTpl->custSQL = $sql;
if($mode=="1"){
  $sql  = "SELECT mnu.fmenu,mnu.fparent, CASE WHEN mnu.fparent IS NULL THEN '1' ELSE '0' END cpar, mnu.fcaption, COALESCE(priv.cView,0) AS cView ";
  $sql .= "FROM tsm_menu mnu ";
  $sql .= "LEFT JOIN tsm_priv priv ON priv.cKdModuleId = mnu.fmenu AND priv.cKdGroupUser = '$_GET[key]' ";
  $sql .= "WHERE mnu.fnoedit = '0' ";
  $sql .= "ORDER BY mnu.fmenu ";
  $admGrdTpl->template->MergeBlock("blk_dtl","adodb",$sql);
}
$gTpl = new TBlock("form.general_box");
$gTpl->name		= "gTpl";
$gTpl->title    = "Group Privileges";
$gTpl->display  = $admGrdTpl->Show(false);
$content = $gTpl->Show(false);

?>