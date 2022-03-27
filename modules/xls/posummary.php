<?php
//error_reporting(E_ALL);

class TExcelRptPOSummary extends TExcel {

  function doExportXls(){
  global $conn, $config, $LABEL;  
	
	$xlsfile = isset($_REQUEST["id"]) && ($_REQUEST["id"]!="") ? $_REQUEST["id"] : "";
	if(isset($_REQUEST["blnawal"]) && $_REQUEST["blnawal"] != ""){
	  $bulanawal = $_REQUEST["blnawal"];
	}else{
	  $bulanawal = date('m');
	}
	if(isset($_REQUEST["blnakhir"]) && $_REQUEST["blnakhir"] != ""){
	  $bulanakhir = $_REQUEST["blnakhir"];
	}else{
	  $bulanakhir = date('m');
	}
	if(isset($_REQUEST["tahun"]) && $_REQUEST["tahun"] != ""){
	  $tahun = $_REQUEST["tahun"];
	}else{
	  $tahun = date('Y');
	}

	$sql  = "SELECT hd.cKdSupplier, supp.vNmSupplier, SUM(hd.nGrandTotal) AS nGrandTotal, ";
	$sql .= "SUM(COALESCE(ret.nTotalRetur,0)) AS nTotalRetur, SUM(COALESCE(hd.nTotalPay,0)) AS nTotalPay, "; 
	$sql .= "SUM(hd.nGrandTotal)-SUM(COALESCE(ret.nTotalRetur,0))-SUM(COALESCE(hd.nTotalPay,0)) AS nSaldo, count(*) as jml ";
	$sql .= "FROM tr_appohd hd "; 
	$sql .= "LEFT JOIN ( ";
	$sql .= "  SELECT ret.cIdPO, SUM(ret.nQtyRetur*po.nHarga) AS nTotalRetur "; 
	$sql .= "  FROM tr_apreturdt ret, tr_appodt po ";
	$sql .= "  WHERE ret.cIdPODt = po.cIdPODt "; 
	$sql .= "  GROUP BY ret.cIdPO "; 
	$sql .= ") ret ON ret.cIdPO = hd.cIdPO ";
	$sql .= "LEFT JOIN ".$config["db_mst"].".ms_supplier supp ON supp.cKdSupplier = hd.cKdSupplier "; 
	$sql .= "WHERE MONTH(hd.dTglPO) BETWEEN '$bulanawal' AND '$bulanakhir' AND YEAR(hd.dTglPO) = '$tahun' ";
	$sql .= "GROUP BY hd.cKdSupplier, supp.vNmSupplier ";
	$sql .= "HAVING SUM(hd.nGrandTotal)-SUM(COALESCE(ret.nTotalRetur,0))-SUM(COALESCE(hd.nTotalPay,0)) <> 0 ";
	$sql .= "ORDER BY supp.vNmSupplier "; 
	$rs = $conn->Execute($sql);

	//print_r($rs);

	if($rs->RecordCount()>0){
	  $xlstpl = new TExcelTemplate("xls_template/".$xlsfile.".xls");
	  $objWorksheet = $xlstpl->objPHPExcel->getActiveSheet();
	  $dt = $rs->fields;
	  $fld=0;
	  foreach($dt as $k=>$v){
		$cell = $xlstpl->getCellByValue("#ONCE#".$k);
		if($cell<>""){ 
		  $field = $rs->FetchField($fld);
		  $mapp_once[$cell][$field->type] = $k;
		}
		$cell = $xlstpl->getCellByValue("#RW#".$k);
		if($cell<>""){ 
		  $field = $rs->FetchField($fld);
		  $mapp_row[$cell][$field->type] = $k;
		}
		$fld++;
	  }

	  $tmp = array_keys($mapp_row);
	  $start_row = preg_replace("/[^0-9]/", '', $tmp[0]);
	  $tplrow = $start_row;
	  $start_row = $start_row+1; // karena fungsi insert add row before maka di loncat 1 row (disisipin).
	  // remapp untuk fungsi getColumnId ga masuk di loop setCellValue -> ex/. [A]([datetime][dtglproses])
	  foreach($mapp_row as $k=>$v){
		foreach($v as $sk=>$sv){
		  $mapp_col[$this->getColumnId($k)][$sk] = $sv;
		}
	  }
	  // insert data to excel
	  $bykdata = $rs->RecordCount(); 
	  $objWorksheet->insertNewRowBefore($start_row,$bykdata);
	  $row=0;
	  while(!$rs->EOF){
		foreach($mapp_col as $k=>$v){
		  foreach($v as $sk=>$sv){
			$idx = $start_row+$row;
			$cell_pos = $k.$idx;
			if($sk=="datetime"){
			  try{
				//1899-12-30 00:00:00 -> tidak valid
				$year=substr(trim($rs->fields[$sv]),0,4);
				if(($year!="") && ($year!="1899")){
					PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() );
					$objWorksheet->setCellValue($cell_pos,$rs->fields[$sv]);
					$objWorksheet->getStyle($cell_pos)
								 ->getNumberFormat()
								 ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX15);
			    }
			  }catch (Exception $e){
                echo $e->getMessage();
			  }
			}else{
			  $objWorksheet->setCellValue($cell_pos,$rs->fields[$sv]);
			}
		  }
		}
		$row++;
		$rs->MoveNext();
	  } 

	  //$cell = $xlstpl->getCellByValue("#ONCE#PROYEK");
	  //$objWorksheet->setCellValue($cell,$_SESSION["vKdProyek"]);
	  $cell = $xlstpl->getCellByValue("#ONCE#TGLCETAK");
	  $objWorksheet->setCellValue($cell,date("d-m-Y"));
	  //$cell = $xlstpl->getCellByValue("#ONCE#TGLAWAL");
	  //$objWorksheet->setCellValue($cell,$tglawal);
	  //$cell = $xlstpl->getCellByValue("#ONCE#TGLAKHIR");
	  //$objWorksheet->setCellValue($cell,$tglakhir);

	  $start_row = $tplrow+1;
	  $final_row = $tplrow+$row;

	  // copy formula dari cell template
	  $col = $objWorksheet->getHighestColumn(); 
	  $colmax = PHPExcel_Cell::columnIndexFromString($col);  
	  for($i=0;$i<$colmax;$i++){
		$column = PHPExcel_Cell::stringFromColumnIndex($i);
		$val = $objWorksheet->getCellByColumnAndRow($i,$tplrow)->getValue();
		$pos = strpos($val,"#RW#");
		if(($pos === false) && (trim($val) != "")){
		  $val = str_replace($tplrow,"#",$val);
		  for($idx=$start_row;$idx<=$final_row;$idx++){
			$cell_pos = $column.$idx;
			$val_new = str_replace("#",$idx,$val);
			$objWorksheet->setCellValue($cell_pos,$val_new);
		  }  
		}
	  }

	  // duplikasi style
	  foreach($mapp_col as $k=>$v){
		$baseStyle = $objWorksheet->getCell($k.$start_row)->getXfIndex();
		for($idx=$start_row;$idx<=$final_row;$idx++){
		  $objWorksheet->getCell($k.$idx)->setXfIndex($baseStyle);	
		} 
	  }

	  // hapus format mapp di excel
	  $objWorksheet->removeRow($tplrow,1);
	  
	  foreach($mapp_col as $k=>$v){
		
		$objWorksheet->getColumnDimension($k)->setAutoSize(true);
	  }
	  
	  $dtfile = date("YmdHis");
	  //$proyfile = str_replace(" ","_",$_SESSION["vKdProyek"]);
	  //header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	  header('Content-Type: application/vnd.ms-excel');
	  header('Content-Disposition: attachment;filename="po_summary_'.$dtfile.'.xls"');
	  header('Cache-Control: max-age=0');

	  PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT); 
	  $objWriter = PHPExcel_IOFactory::createWriter($xlstpl->objPHPExcel, 'Excel5');
	  $objWriter->save('php://output');
    }else{
	  echo "<script>alert('Data not found.');</script>";
	  echo "<script>history.back(-1);</script>";
	}

  }

}

?>