<?php require("ozel_fonksiyon.php"); ?>
<style>
body{
    background-color:#5286F3;
    font-size:14px;
    color:#fff;
}
.simple-login-container{
    width:300px;
    max-width:100%;
    margin:50px auto;
}
.simple-login-container h2{
    text-align:center;
    font-size:20px;
}

.simple-login-container .btn-login{
    background-color:#FF5964;
    color:#fff;
}
a{
    color:#fff;
}
</style>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="simple-login-container">
<h2>pH Analyzer | <?php echo $_SERVER['SERVER_NAME']; ?></h2><br>
<form action="islem.php?y=kontrol" method="post">
<div class="row">
<div class="col-md-12 form-group">
 <p>Kullanıcı Adı: <input class="form-control"  type="text" name="kadi" placeholder="Kullanıcı Adı"></p></div></div>
 <div class="row">
 <div class="col-md-12 form-group">
 <p>Şifre: <input class="form-control"  type="password" name="sifre" placeholder="Şifre"></p></div></div>
 <p><div class="row">
 <div class="col-md-12 form-group">
 <button class="btn btn-block btn-login">Giriş</button></p></div></div>
</form></div></div>