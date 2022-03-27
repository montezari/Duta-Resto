<?php
require_once "../includes/global.inc.php";

error_reporting(E_ALL);
ini_set('display_errors',1);

$sql = "SELECT * FROM tr_tamu limit 0,10";
$printTpl = new TSQLTemplate("print.pos","../template/");
$printTpl->SQL = $sql;
$txt = $printTpl->Show(false);

/* Basic test */
//$printer = "\\\\172.16.0.224\\CanonMP2"; 
//$printer = "\\\\172.16.0.73\\EpsonLX-"; 
//$printer = "Canon MP280 series Printer"; 
$printer = "POS58"; 

/* okee
$handle = printer_open($printer);
printer_start_doc($handle, "My Document");
printer_start_page($handle);
$font = printer_create_font("Arial", 148, 76, PRINTER_FW_MEDIUM, false, false, false, -50);
printer_select_font($handle, $font);
printer_draw_text($handle, "Test Printer", 40, 40);
printer_delete_font($font);	

printer_end_page($handle);
printer_end_doc($handle);
printer_close($handle);
*/

/* oke bgt
$handle = printer_open($printer);
if($handle){
  printer_start_doc($handle, "My Document");
  printer_start_page($handle); 
  $font = printer_create_font("Arial", 10, 8, PRINTER_FW_MEDIUM, false, false, false, 0);
  printer_select_font($handle, $font);
  printer_set_option($handle, PRINTER_MODE, "RAW");
  printer_draw_text($handle, "Test Printer",0,0);
  printer_delete_font($font);
  printer_end_page($handle);
  printer_end_doc($handle);
  printer_close($handle);
}
echo "123";
*/

$tanggal = date("d-m-Y");
$jam = date("H:i:s");
$var_magin_left = 5;
$handle = printer_open($printer);
if($handle){
  printer_start_doc($handle, "My Document");
  printer_start_page($handle); 
  $font = printer_create_font("Monaco", 14, 13, PRINTER_FW_NORMAL, false, false, false, 0);
  //$font = printer_create_font("Arial", 10, 8, PRINTER_FW_MEDIUM, false, false, false, 0);
  printer_select_font($handle, $font);
  printer_set_option($handle, PRINTER_MODE, "RAW");

	printer_draw_text($handle, "DutaRESTO",65,0);
	printer_draw_text($handle, date("Y/m/d H:i:s"),125, 40);

	printer_draw_text($handle, "Waiter :", $var_magin_left, 40);
	printer_draw_text($handle, ":",35, 40);
	printer_draw_text($handle, 'Ridwan',40, 40);

	// Header Bon
	$pen = printer_create_pen(PRINTER_PEN_SOLID, 1, "000000");
	printer_select_pen($handle, $pen);
	printer_draw_line($handle, $var_magin_left, 65, 400, 65);
	printer_draw_text($handle, "Nama", $var_magin_left, 70);
	printer_draw_text($handle, "Qty", 145, 70);
	printer_draw_text($handle, "Harga", 175, 70);
	printer_draw_line($handle, $var_magin_left, 85, 400, 85);

	$row +=150;
	printer_draw_text($handle, "Terima kasih atas kunjungan anda", 40, $row);

  printer_delete_font($font);
  printer_end_page($handle);
  printer_end_doc($handle);
  printer_close($handle);
}

echo "Sukses print";


?>
