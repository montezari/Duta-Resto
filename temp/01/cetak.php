<?php 
error_reporting(E_ALL);
ini_set('display_errors',1);


/*
$condensed = Chr(27) . Chr(33) . Chr(4); 
$bold1 = Chr(27) . Chr(69); 
$bold0 = Chr(27) . Chr(70); 
$initialized = chr(27).chr(64); 
$condensed1 = chr(15); 
$condensed0 = chr(18); 
$Data = $initialized; 
$Data .= $condensed1; 
$Data .= "==========================\n"; 
$Data .= "| ".$bold1."COBA CETAK".$bold0." |\n"; 
$Data .= "==========================\n"; 
*/

/*
$Data  = "==========================\n"; 
$Data .= "| COBA CETAK |\n"; 
$Data .= "==========================\n"; 
$Data .= "INI AKAN DI CETAK\n"; 
$Data .= "INI AKAN DI CETAK\n"; 
$Data .= "INI AKAN DI CETAK\n"; 
$Data .= "INI AKAN DI CETAK\n"; 
$Data .= "INI AKAN DI CETAK\n"; 
$Data .= "--------------------------\n"; 
$lipsum =$Data;
*/


//$lipsum = "Selamat data witoooo..";
//$printer = printer_open("Canon MP490 series");
//$printer = printer_open("'\\\\192.168.24.110\\Canon MP490 series Printer");  
//$printer = printer_open("Canon MP490 series Printer on 192.168.24.110");
/*
$printer = printer_open("Canon MX390 series Printer");
$font = printer_create_font("Arial", 5, 4, PRINTER_FW_NORMAL, false, false, false, 0);
printer_select_font($printer, $font);
printer_write($printer, $lipsum);   
printer_close($printer); 
*/


/*
$printer = printer_open("'\\\\192.168.1.100\\pos58"); 
//$printer = printer_open("Canon MX390 series Printer");
printer_start_doc($printer, "dutaresto");
printer_start_page($printer);

$font = printer_create_font("Arial", 12, 48, PRINTER_FW_NORMAL, false, false, false, 0);
printer_select_font($printer, $font);
//printer_draw_text($printer, $lipsum, 10, 10);
printer_draw_text("==========================", 10, 10); 
printer_draw_text("| COBA CETAK |", 20, 10); 
printer_draw_text("==========================", 30, 10);  
printer_draw_text("INI AKAN DI CETAK", 40, 10);  
printer_draw_text("INI AKAN DI CETAK", 50, 10); 
printer_draw_text("INI AKAN DI CETAK", 60, 10);  
printer_draw_text("INI AKAN DI CETAK", 70, 10); 
printer_draw_text("INI AKAN DI CETAK", 80, 10); 
printer_draw_text("--------------------------", 90, 10); 
printer_delete_font($font);

printer_end_page($printer);
printer_end_doc($printer);
printer_close($printer);
*/

$file = 'D:\xampp\htdocs\dutaresto\temp\test.txt';
$handle = fopen("D:/xampp/htdocs/dutaresto/temp/test.txt", 'w');
$Data  = "==========================\n";
$Data .= "Test data print\n";
$Data .= "Coba data aja\n";
$Data .= "Coba data aja\n";
$Data .= "Coba data aja\n";
$Data .= "Coba data aja\n";
$Data .= "Coba data aja\n";
$Data .= "--------------------------\n";
fwrite($handle, $Data);
fclose($handle);
copy($file, "//192.168.1.100/pos58");  # Lakukan cetak
//unlink($file);

?>