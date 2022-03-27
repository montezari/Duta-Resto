<?php
require_once "../includes/global.inc.php";
//error_reporting(E_ALL);
//ini_set('display_errors',1);

$act = $_GET["act"];

function setrp($angka){
  //$str = "Rp ".number_format($angka,2,',','.');
  $str = number_format($angka,0,',','.');
  return $str;
}

function write_num($printer,$input,$xpos,$ypos){
    $s=strlen($input);
    $y=$xpos;
    for ($i=1;$i<$s+1;$i++){
        $u=$i*-1;
        printer_draw_text($printer,substr($input,$u,1),$y,$ypos);
        $y=$y-12;
    }
}

/* Basic test */
//$printer = "\\\\172.16.0.224\\CanonMP2"; 
//$printer = "\\\\172.16.0.73\\EpsonLX-"; 
//$printer = "Canon MP280 series Printer"; 
$printer = "POS58"; 

function doprintbill(){
global $printer, $conn, $config;

  $tanggal = date("d-m-Y");
  $jam = date("H:i:s");
  $margin_left = 25;
  $max_px = 300;
  $handle = printer_open($printer);
  if($handle){
    printer_start_doc($handle, "My Document");
    printer_start_page($handle); 
    printer_set_option($handle, PRINTER_MODE, "RAW");
  
    $font = printer_create_font("Merchant Copy", 19, 16, PRINTER_FW_NORMAL, false, false, false, 0);
    printer_select_font($handle, $font);
    printer_draw_text($handle, "DutaRESTO",130,0);
    printer_delete_font($font);

    $font = printer_create_font("Merchant Copy", 15, 12, PRINTER_FW_NORMAL, false, false, false, 0);
    printer_select_font($handle, $font);
    printer_draw_text($handle, "Android Resto System",100,20);

    printer_draw_text($handle, "WTR", $margin_left, 55);
    printer_draw_text($handle, ":",$margin_left+35, 55);
    printer_draw_text($handle, 'Ridwan',$margin_left+50, 55);
    printer_draw_text($handle, date("d/m/y H:i"),$margin_left+205, 55);

    // Header Bon
    $pen = printer_create_pen(PRINTER_PEN_SOLID, 3, "000000");
    printer_select_pen($handle, $pen);
    printer_draw_line($handle, $margin_left, 80, 380, 80);
  

    $param["idtamu"] = $_GET["idtamu"];
    $where = $param["idtamu"] != "" ? " AND dt.cIdTamu = '$param[idtamu]' " : "";	
    if($param["idtamu"]!=""){
      $sql  = "SELECT @row_number:=@row_number+1 AS cIdx, '' as cKdPesananDt, '' as cKdPesanan, ";
	  $sql .= "dt.cIdTamu,dt.cKdBarang,dt.vNamaBarang,dt.vQty,dt.cAlias, dt.cSatuan,dt.vHarga,dt.cDiscPers,dt.vDiscount,dt.vTotalHarga,dt.cKeterangan ";
	  $sql .= "FROM (SELECT dt.cIdTamu,dt.cKdBarang,brg.vNamaBarang,SUM(dt.vQty) as vQty,sat.cAlias, dt.cSatuan, ";
      $sql .= "dt.vHarga, dt.cDiscPers, dt.vDiscount, SUM(dt.vTotalHarga) as vTotalHarga, '' as cKeterangan ";
      $sql .= "FROM tr_pesanandt dt ";
      $sql .= "LEFT JOIN ( ";
	  $sql .= "SELECT cKdBarang, vNamaBarang, cSatuan FROM  ".$config["db_mst"].".ms_barang ";
	  $sql .= "UNION ALL "; 
	  $sql .= "SELECT cKdPaket, vNmPaket, '' AS cSatuan FROM  ".$config["db_mst"].".ms_pakethd ";	
	  $sql .= " ) brg ON brg.cKdBarang = dt.cKdBarang ";
      $sql .= "LEFT JOIN ".$config["db_mst"].".ms_satuan sat ON sat.cSatuan = dt.cSatuan ";
      $sql .= "WHERE dt.cIdTamu IS NOT NULL $where ";
      $sql .= "GROUP BY dt.cIdTamu,dt.cKdBarang,brg.vNamaBarang,sat.cAlias, dt.cSatuan, dt.vHarga, dt.cDiscPers, dt.vDiscount ";
	  $sql .= ") as dt, (SELECT @row_number:=0) AS t ";
	  $sql .= "ORDER BY dt.cKdBarang ";
    }
    $rs = $conn->Execute($sql);
    $row=95;
	$total=0;
    if($rs->RecordCount()>0){
	  while(!$rs->EOF){
	    printer_draw_text($handle, $rs->fields["vNamaBarang"], $margin_left, $row);
	    $row=$row+15;	
	    printer_draw_text($handle, $rs->fields["vQty"], $margin_left, $row);
		printer_draw_text($handle, "X", $margin_left+30, $row);
	    $harga = setrp(round($rs->fields["vHarga"]));
	    write_num($handle,$harga,150,$row);
	    $jumlah = setrp(round($rs->fields["vTotalHarga"]));
	    $total = $total+round($rs->fields["vTotalHarga"]);
		write_num($handle,$jumlah,375,$row);
	    $row=$row+25;	
	    $rs->MoveNext();
	  }
	  $rs->Close();
    }

    $row=$row+15;
    $pen = printer_create_pen(PRINTER_PEN_SOLID, 3, "000000");
    printer_select_pen($handle, $pen);
    printer_draw_line($handle, $margin_left+175, $row, 380, $row);
    $row=$row+10;
    printer_draw_text($handle, "SUBTOTAL", $margin_left+175, $row);
	$print_total = setrp($total);
 	write_num($handle,$print_total,375,$row);
    
	$row=$row+25;
	$diskon = 0;
	$print_diskon = setrp($diskon);
    printer_draw_text($handle, "DISKON", $margin_left+175, $row);
 	write_num($handle,$print_diskon,375,$row);
    
	$row=$row+25;
    $ppn=($total*0.1); 
	$print_ppn = setrp($ppn); 
	printer_draw_text($handle, "PPN", $margin_left+175, $row);
 	write_num($handle,$print_ppn,375,$row);
 
    $row=$row+25;
    $pen = printer_create_pen(PRINTER_PEN_SOLID, 3, "000000");
    printer_select_pen($handle, $pen);
    printer_draw_line($handle, $margin_left+175, $row, 380, $row);
    $row=$row+15;
	$grandtotal = $total-$diskon+$ppn;
    $print_grandtotal=setrp($grandtotal); 
	printer_draw_text($handle, "TOTAL", $margin_left+175, $row);
 	write_num($handle,$print_grandtotal,375,$row);

    $row=$row+25;
    $pen = printer_create_pen(PRINTER_PEN_SOLID, 3, "000000");
    printer_select_pen($handle, $pen);
    printer_draw_line($handle, $margin_left, $row, 400, $row);
    $row=$row+15;
    printer_draw_text($handle, "TERIMA KASIH", 140, $row);
    $row=$row+25;
    printer_draw_text($handle, "Atas Kunjungan Anda", 100, $row);

    printer_delete_font($font);
    printer_end_page($handle);
    printer_end_doc($handle);
    printer_close($handle);
  }
}

switch($act){
  case "bayar":
   $msg = doprintbill(); 
  break;
}

echo "Sukses print";

?>
