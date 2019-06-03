<?php
include ("yetki_kontrol.php");
include("../baglanti.php");
session_start();
session_destroy();
session_unset();
echo (" Başarılı ");
header ("Location:./index.php"); 
?>
