<?php
session_name(md5("WWW_DUTARESTO_WEB_SESID"));
session_cache_limiter('private');
session_start();
header("Cache-control: private"); 

//error_reporting(0);

$server_addr = $_SERVER["SERVER_NAME"]; 
$server_port = $_SERVER["SERVER_PORT"] == "80" ? "" : ":".$_SERVER["SERVER_PORT"] ; 
$server_uri = $server_addr.$server_port;

$config["page_header"] = "";
$config["http_url"] = "http://".$server_uri."/dutaresto";
$config["http"] = "http://".$server_uri;
$config["db_host"] = "localhost";
$config["db_user"] = "root";
$config["db_pass"] = "root";
$config["db_port"] = "3307";
$config["db_name"] = "k1257545_duta_resto";
$config["db_mst"] = "k1257545_duta_mst";
$config["appname"] = $config["page_header"];
$config["db_fetchpage"] = 20;
$config["dir_class"] = "classes/";
$config["dir_tpl"] = "template/";
$PNG_WEB_DIR = "temp/";
$UPLOAD_WEB_DIR = "/uploads/files/";
$PNG_TEMP_DIR = 'D:/xampp/htdocs/dutaresto/temp/';

$arr_bulan = array("Januari","Februari","Maret","April","Mei","Juni",
				   "Juli","Agustus","September","Oktober","November","Desember");

$arr_month = array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June',
				   '07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');
?>