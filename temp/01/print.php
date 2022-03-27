<?php
require_once "includes/global.inc.php";

$gcp = new GoogleCloudPrint();
if($gcp->loginToGoogle("dutaciptasolusindo@gmail.com", "dcs123456")) {
	$printers = $gcp->getPrinters();
	echo "<pre>";
	print_r($printers);
	echo "</pre>";
	$printerid = "";
	if(count($printers)==0) {
	  echo "Printer tidak di ketemukan.";
	  exit;
	}else {
	  $printerid = $printers[0]['id']; 
	}
	//$resarray = $gcp->sendPrintToPrinter($printerid, "DutaResto", "./test.txt", "text/html");
	$resarray = $gcp->sendPrintToPrinter($printerid, "DutaResto", "./test.pdf", "application/pdf");
	if($resarray['status']==true) {
	  echo "Sukses print";
	}else {
	  echo "Error Printing. Error code:".$resarray['errorcode']." Message:".$resarray['errormessage'];
	}
}else {
  echo "Gagal login";
  exit;
}

?>