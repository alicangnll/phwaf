<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #4CAF50;
  color: white;
}
.input-text{
border:none;
outline:none;
box-shadow:none;
border-radius:0px;
border-bottom:1px solid;
border-color:#6f42c1;
color:#222;
font-weight:300;
font-size:18px;
height:32px;
background:transparent;
}
.input-textarea{
border:none;
outline:none;
box-shadow:none;
border-radius:0px;
border-bottom:1px solid;
border-left:1px solid;
border-color:#6f42c1;
color:#222;
font-weight:300;
font-size:18px;
height:32px;
background:transparent;
position: relative !important;
    margin-bottom: 20px !important;
    margin-left: 0px !important;
}
.input-h5{
color:#222;
border:none;
outline:none;
box-shadow:none;
border-radius:0px;
font-weight:300;
font-size:18px;
height:32px;
background:transparent;
font-family:arial;
}

</style>
</head>
<?php
function reel_ip()  
{  
    if (!empty($_SERVER['HTTP_CLIENT_IP']))  
    {  
        $ip=$_SERVER['HTTP_CLIENT_IP'];  
    }  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) //Proxy den bağlanıyorsa gerçek IP yi alır.
     
    {  
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    }
   elseif (!empty($_SERVER['HTTP_X_FORWARDED'])) //Proxy den bağlanıyorsa gerçek IP yi alır.
     
    {  
        $ip = $_SERVER['HTTP_X_FORWARDED'];  
    }
	
   elseif (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) //Proxy den bağlanıyorsa gerçek IP yi alır.
     
    {  
        $ip = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];  
    } 
	   elseif (!empty($_SERVER['HTTP_FORWARDED'])) //Proxy den bağlanıyorsa gerçek IP yi alır.
     
    {  
        $ip = $_SERVER['HTTP_FORWARDED'];  
    } 
    else  
    {  
        $ip=$_SERVER['REMOTE_ADDR'];  
    }  
    return $ip;  
}
$user_agent = $_SERVER["HTTP_USER_AGENT"];

function user_agent()  
{
if (empty($user_agent)) {
$user_agent = "Mozilla/5.0 (compatible; nrird.xyz/proxy)";
}
}

require_once("baglanti.php");
try {
$ip = reel_ip();
$stmt = $db->query("SELECT * FROM ip_ban WHERE ip_adresi = '$ip'");
if($stmt->rowCount()) {
while($row = $stmt->fetch()){
		echo '<div style="padding-left:16px">
		<p align="center">IP Ban Listesindesiniz</p><br>
		<p align="center"> IP Adresin <b>'.$ip.'</b></div>';
	die();	
   }
		} else
	{
	}
    } catch(PDOException $e) {
}
try {
	$stmt = $db->query('SELECT * FROM guard_watch ORDER BY kural_id');
	while($row = $stmt->fetch()){
		$parametreler = strtolower($_SERVER['QUERY_STRING']); 
		$yasaklar=($row['kural_icerik']);
		$yasakla=explode('¿¿',$yasaklar);
$sayiver=substr_count($yasaklar,'¿¿');
$i=0;
while ($i<=$sayiver) {
if (strstr($parametreler,$yasakla[$i])) {
    echo '<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>AliGuard - Yasaklı Komut Algılandı</title>
	</head>
	<center><body>AliGuard - Yasaklı Komut Algılandı.</body></center>
	<hr></hr>
	<center><body><p>Komut Tipi : <h3>'.$row['kural_adi'].'</h3></p></body>
	<a href="javascript:history.back()">
Return to previous page ( Geri Dön )
</a></center>';
exit;
}
 
$i++;	
}
if (strlen($parametreler)>=90) {
exit;	
}
	}
	    } catch(PDOException $e) {
        echo $e->getMessage();
    } 
?>