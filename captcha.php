<?php
include("class.aliwaf.php");
date_default_timezone_set('Europe/Istanbul');
$captcha = new AliWAF_Panel();
$captcha->LoginCheck_Captcha();
?>