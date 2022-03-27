<?php
require_once "../includes/global.inc.php";
  
  	if($_POST){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$param["data"] = $_POST["data"];

        $pass = encrypt_decrypt('encrypt',$password);
		//$sql = "select * from tsm_pemakai where UPPER(cUserName) = UPPER('$username') and cPassword = '".$pass."'";
		$sql = "select * from ".$config["db_mst"].".ms_entity where UPPER(cEmail) = UPPER('$username') and cPassword = '".$pass."'";
		$rs = $conn->Execute($sql);
		$message = array();
		if($rs->RecordCount()>0){
			$message["message"] = "Succsess login";
			$message["success"] = true;	
			$message["code"] = 200;
		    //$message["userid"] = $rs->fields["cUserId"];
			$message["kdentity"] = $rs->fields["cKdEntity"];		
		}else{
			$message["message"] = "Not Match\nUsername and Password";
			$message["success"] = false;
			$message["code"] = 202;
			//$message["userid"] = "";
			$message["kdentity"] = "";
		}
		echo json_encode($message);
	}

?>