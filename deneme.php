<?php 
include 'engelle.php'; 
if(!isset($_GET['git'])) {
$sayfa = 'giris';	// eğer boşsa anasayfa varsayalım.
} else {
   $sayfa = $_GET['git'];
}
switch($sayfa) {
case 'giris':
echo 'Hi';
break;
}
?>
