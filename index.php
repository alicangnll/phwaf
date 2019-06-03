<?php require_once("baslik.php"); ?>
<body class="login" data-gr-c-s-loaded="true">
        <!-- BEGIN : LOGIN PAGE 5-1 -->
        <div class="user-login-5">
            <div class="row bs-reset">


                <!-- BEGIN LOGIN FORM BLOCK -->
                <div class="col-md-6 col-sm-12 login-container bs-reset">
                    <div class="login-content">

                        <h1>
                            <a class="theme-font" href="./">
                                <?php echo $_SERVER['SERVER_NAME']; ?><br>PHP Waf Guard | AliDev</a>
                        </h1>
                        <!-- CONTENT STARTS -->
						
						
						<form method="post" action="kontrol.php" class="login-form">
						<div class="row">
						<div class="col-md-8 col-sm-8 col-xs-12">
						<input class="form-control login-username" type="text" name="kadi" placeholder="Kullanıcı Adı">
					</div>

	        <div class="col-md-4 col-sm-4 col-xs-12">
            <input type="password" name="ksifre" value="" class="form-control login-password" placeholder="Şifre">      
			</div>
		</div>
			
					<div class="row">
					        <div class="col-md-6 col-xs-12">

        </div>
					<div class="col-md-6 col-xs-12 text-right">
					<button class="btn blue" type="submit">Giriş</button>
					</div></div>
					
				</form><br><br><br>
                    </div>

                  
 <?php require_once("alt.php"); ?>
    

</body></html>