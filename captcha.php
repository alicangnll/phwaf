<?php
include("class.aliwaf.php");
$aliwafac = new AliWAF_Panel();
if(extension_loaded("gd")) {
	header('Content-type: image/png');
	  session_start();
      $kod = substr(md5(uniqid(rand(0, 6))), 0, 6);
      $_SESSION['kod'] = $kod;
      $kod_uzunluk = strlen($kod);
      $genislik = imagefontwidth(5) * $kod_uzunluk;
      $yukseklik = imagefontheight(5);
      $resim = imagecreate($genislik, $yukseklik);
      $arka_renk = imagecolorallocate($resim, 0, 0, 0);
      $yazi_renk = imagecolorallocate($resim, 255, 255, 255);
      imagefill($resim, 0, 0, $arka_renk);
      imagestring($resim, 5, 0, 0, $kod, $yazi_renk);
      imagepng($resim);
} else {
	die("404");
}
?>