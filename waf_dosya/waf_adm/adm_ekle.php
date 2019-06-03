<?php include ("../yetki_kontrol.php"); ?>

<center><div class="main-content">
<div class="section__content section__content--p30">

<div class="container-fluid">

<form action='adm_kayit.php' method="post" enctype="multipart/form-data" class="form-horizontal">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<strong>Üye Ekle</strong>
</div>
<div class="card-body card-block">

<strong>Kullanıcı Adı :</strong>
<div class="row form-group">
<div class="col-12 col-md-9">
<input type="text" class="form-control" name="kadi" minlength="8" required>
</div>
</div>

<strong>Şifresi :</strong>
<div class="row form-group">
<div class="col-12 col-md-9">
<input type="password" class="form-control" name="ksifre" minlength="8" required>
</div></div>



<strong>Verilerinizi kontrol edin teknik aksaklıkları mail adreslerimize bildirin :)</strong>
</form>
</div>
<div class="card-footer">
<button type="submit" class="btn btn-primary btn-md">
Kaydet
</button>

</div>
</div>

</form>
</div>
</div>
</div>
</div></center>
