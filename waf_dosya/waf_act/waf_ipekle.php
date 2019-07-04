<?php
include ("../yetki_kontrol.php");

	function ip_adresi_alma()  
	{  
		if (!empty($_SERVER['HTTP_CLIENT_IP']))  
		{  
			$ip = $_SERVER['HTTP_CLIENT_IP'];  
		}  
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){  
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
		}  
		else{  
			$ip = $_SERVER['REMOTE_ADDR'];
		}  
		return $ip;  
	}  

?>

            <div class="main-content">
                <div class="section__content section__content--p30">
 
                   <div class="container-fluid">
                   <form action='waf_ipkayit.php' method="post" enctype="multipart/form-data" class="form-horizontal">
                           <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>IP Ekle</strong>
                                    </div>
                                    <div class="card-body card-block">


<strong>IP Adresi :</strong>
                                            <div class="row form-group">
                          <div class="col-12 col-md-9">
      <input name="ipadres" class="form-control" placeholder="IP Adresi:" value='<?php echo ip_adresi_alma(); ?>'>
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