<!--
Mail : alicangonullu1907@gmail.com
Writed By ALI CAN GONULLU
Respect Us !
-->
<?php
ini_set('session.gc_maxlifetime', 1800); 
session_set_cookie_params(1800);
header("X-XSS-Protection: 1; mode=block");
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1);
require_once("../baglanti.php");
echo '<meta name="robots" content="noarchive, noindex" />';
		try {

			$stmt = $db->query('SELECT site_id, site_meta, site_meta2, admin_baslik FROM god3err_site ORDER BY site_id DESC');
			while($row = $stmt->fetch()){
				
				echo '<meta name="keywords" content="'.$row['site_meta'].'">';
				echo '<meta name="description" content="'.$row['site_meta2'].'">';
				echo '<title>'.$row['admin_baslik'].'</title>';
				echo '</tr>';
			}
		} catch(PDOException $e) {
		    echo $e->getMessage();
		}
	?>
	
<!DOCTYPE html>
<html lang="tr">

<head>

    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Fontfaces CSS-->
    <link href="../tema/css/font-face.css" rel="stylesheet" media="all">
    <link href="../tema/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="../tema/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="../tema/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="../tema/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="../tema/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="../tema/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="../tema/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="../tema/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="../tema/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="../tema/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../tema/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../tema/css/theme.css" rel="stylesheet" media="all">

</head>
<?php echo '
<body class="animsition">
    <div class="page-wrapper">
        <!-- Header Mobil-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="/">';

		try {

			$stmt = $db->query('SELECT site_id, site_adi, site_logo FROM god3err_site ORDER BY site_id DESC');
			while($row = $stmt->fetch()){
				
				echo '<img src="'.$row['site_logo'].'" alt="God3errAdmin" />';
				echo '</tr>';
			}
		} catch(PDOException $e) {
		    echo $e->getMessage();
		}
echo '
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>



            <!-- Mobil Sidebar-->
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">';
		try {

			$stmt = $db->query('SELECT adm_id, adm_link, adm_adi FROM god3err_kategori_admin ORDER BY adm_id ');
			while($row = $stmt->fetch()){
				
				echo '  <li>
                            <a href="'.$row['adm_link'].'">
                                '.$row['adm_adi'].'</a>
								</li>';

			}
		} catch(PDOException $e) {
		    echo $e->getMessage();
		}
echo '
                    </ul>
                </div>
            </nav>
        </header>
        

        <!-- Pc Sidebar-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="/">';
		try {

			$stmt = $db->query('SELECT site_id, site_adi, site_logo FROM god3err_site');
			while($row = $stmt->fetch()){
				
				echo '<img src="'.$row['site_logo'].'" alt="God3errAdmin" />'; 
				echo '</tr>';
			}
		} catch(PDOException $e) {
		    echo $e->getMessage();
		}

      echo '</a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">';

		try {

			$stmt = $db->query('SELECT * FROM god3err_kategori_admin ');
			while($row = $stmt->fetch()){
				
				echo '  <li>
                            <a href="'.$row['adm_link'].'">
                                '.$row['adm_adi'].'</a>
								</li>'; 
			}
		} catch(PDOException $e) {
		    echo $e->getMessage();
		}
echo '
                    </ul>
                </nav>
            </div>
        </aside>
               

            <div class="page-container">
            <!-- HEADER PC-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">

                            <form class="form-header" action="ara.php" method="POST">
                                <input class="au-input au-input--xl" type="text" name="ara" placeholder="Ne arıyorsun?" />
                                <button class="au-btn--submit" type="submit" value="Ara" />
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>

                            <div class="header-button">                           
                            </div>
                        </div>
                    </div>
                </div>
            </header>'; ?>


