<?php
//error_reporting(E_ALL);

  function doPrintSales(){
  global $conn, $config, $LABEL;  

	if(isset($_REQUEST["tglawal"]) && $_REQUEST["tglawal"] != ""){
	  $tgl = explode("/",$_REQUEST["tglawal"]);
	  $tglawal = $tgl[2]."-".$tgl[1]."-".$tgl[0];
	}else{
	  $tglawal = date('Y-m-01');
	}
	if(isset($_REQUEST["tglakhir"]) && $_REQUEST["tglakhir"] != ""){
	  $tgl = explode("/",$_REQUEST["tglakhir"]);
	  $tglakhir = $tgl[2]."-".$tgl[1]."-".$tgl[0];
	}else{
	  $tglakhir = date('Y-m-t');
	}

	$moduleid = "pdf.sales";	
	$reportTpl = new TTemplate($moduleid);
    $sql  = "SELECT cNoInv, dTglInv, nInvNetto, vTotalTunai,vTotalDKCard FROM tr_fakturhd ";
    $sql .= "WHERE STR_TO_DATE(dTglInv,'%Y-%m-%d') BETWEEN '$tglawal' AND '$tglakhir' ";  
    $rs = $conn->Execute($sql);
    if($rs->RecordCount()>0){
	  $i=0;
      $datarpt = array();
      $vsumtotal=0;$vsumcash=0;$vsumcc=0;
      while(!$rs->EOF){
	    $datarpt[$i]["cNoInv"] = $rs->fields["cNoInv"];
	    $datarpt[$i]["dTglInv"] = $rs->fields["dTglInv"];
	    $datarpt[$i]["nInvNetto"] = $rs->fields["nInvNetto"];
	    $datarpt[$i]["vTotalTunai"] = $rs->fields["vTotalTunai"];
	    $datarpt[$i]["vTotalDKCard"] = $rs->fields["vTotalDKCard"];
	    $vsumtotal += $rs->fields["nInvNetto"];
	    $vsumcash +=$rs->fields["vTotalTunai"];
	    $vsumcc +=$rs->fields["vTotalDKCard"];
	    $i++;
	    $rs->MoveNext();
      }
      $rs->Close();
      $reportTpl->template->MergeBlock('grid_blk',$datarpt);
	  $reportTpl->moduleid  = $moduleid;
	  $gTpl = new TBlock("index.pdf");
	  $gTpl->name = "gTpl";
	  $gTpl->title = "Sales Report";
	  $gTpl->info = "Date : $tglawal - $tglakhir";
	  $gTpl->display  = $reportTpl->Show(false);
	  $html = $gTpl->Show(false);
	  try{
		//echo $html; 
		$html2pdf = new HTML2PDF('P', 'A4', 'en');
		$html2pdf->writeHTML($html,false);
		$html2pdf->Output('sales.pdf');
	  }catch(HTML2PDF_exception $e){
		echo $e;
		exit;
	  }
	}else{
	  echo "<script>alert('Data not found.');</script>";
	  echo "<script>history.back(-1);</script>";
	}

  }

?>