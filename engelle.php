<?php
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