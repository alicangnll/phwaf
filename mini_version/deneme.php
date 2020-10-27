<?php 
include 'engelle.php'; 
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
if(!isset($_GET['git'])) {
$sayfa = 'giris';	// eğer boşsa anasayfa varsayalım.
} else {
   $sayfa = $_GET['git'];
}
switch($sayfa) {
case 'giris':
echo '<center><a href="deneme.php?git=post">POST Filter</a></center>
<hr></hr>';
phpinfo();
break;

case 'post':
echo '<center><form action="deneme.php?git=ppost" method="post">
<label for="fname">İsim:</label>
<input type="text" id="d" name="d"><br><br>
<input type="submit" value="Submit">
</form></center>';
break;

case 'ppost':
$post = strip_tags($_POST["d"]);
echo $post;
break;
}
?>
