<?php include("baslik.php"); ?>

            <div class="main-content">
                <div class="section__content section__content--p30">
 
                   <div class="container-fluid">
                   <form action='kuralkayit.php' method="post" enctype="multipart/form-data" class="form-horizontal">
                           <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Konu Ekle</strong>
                                    </div>
                                    <div class="card-body card-block">

					<strong>Kural Adı:</strong>
                                            <div class="row form-group">
                                                 <div class="col-12 col-md-9">
				<input type="text" name="kuraladi" class="form-control" placeholder="Kural Adı:" maxlength="15"> 
                                                </div></div>


<strong>Kural Hakkında :</strong>
                                            <div class="row form-group">
                          <div class="col-12 col-md-9">
      <textarea name="kuralhakkinda" class="form-control" placeholder="Kural Hakkında:"></textarea>
                                                </div>
                                            </div>
											
											<strong>Kural İçeriği : (Değer girerken arada ¿¿ kullanın Örnek: *¿¿-¿¿)</strong>
                                            <div class="row form-group">
                          <div class="col-12 col-md-9">
			<textarea name="kuralicerik" id="editor" class="form-control" placeholder="Kural İçeriği:" maxlength="50"></textarea>
                                                </div>
                                            </div>
											

                                            <strong>Verilerinizi kontrol edin teknik aksaklıkları mail adreslerimize bildirin :)</strong>
                                        </form>
                                    </div>
                                    <div class="card-footer">
									</div>
                                        <button type="submit" class="btn btn-primary btn-md">
                                            Kaydet
                                        </button>
                                       
                                    </div>
                                </div>
                                
</form>






<?php include("alt.php") ?>
