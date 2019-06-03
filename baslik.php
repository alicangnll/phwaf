<?php require_once("baglanti.php"); 
ini_set('session.gc_maxlifetime', 1800); 
session_set_cookie_params(1800);
header("X-XSS-Protection: 1; mode=block");
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1);
echo '<meta name="robots" content="noarchive, noindex" />';?>
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Ali Can Gonullu" name="author">
        
<meta name="google-site-verification" content="">
<meta name="Description" content="<?php echo $_SERVER['SERVER_NAME']; ?> | WAF Guard">
<meta name="Keywords" content="<?php echo $_SERVER['SERVER_NAME']; ?> | WAF Guard">
<title><?php echo $_SERVER['SERVER_NAME']; ?> | WAF Guard</title>

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="./dosya/css" rel="stylesheet" type="text/css">
        <link href="./dosya/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="./dosya/simple-line-icons.min.css" rel="stylesheet" type="text/css">
        <link href="./dosya/bootstrap.min.css" rel="stylesheet" type="text/css">
        <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="./dosya/select2.min.css" rel="stylesheet" type="text/css">
        <link href="./dosya/select2-bootstrap.min.css" rel="stylesheet" type="text/css">
        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="./dosya/components.min.css" rel="stylesheet" id="style_components" type="text/css">
        <link href="./dosya/plugins.min.css" rel="stylesheet" type="text/css">
        <!-- END THEME GLOBAL STYLES -->

        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="./dosya/login-5.min.css" rel="stylesheet" type="text/css">
                <!-- END PAGE LEVEL STYLES -->

        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="./dosya/blue-steel.min.css" rel="stylesheet" type="text/css" id="style_color">

        <!-- END THEME LAYOUT STYLES -->

        <!-- BEGIN THEME CUSTOMIZED STYLES -->
        <link href="./dosya/override-theme-styles-login-5.css" rel="stylesheet" type="text/css">
        <!-- END THEME CUSTOMIZED STYLES -->

        <!-- BEGIN Manually Loaded Styles -->
                <!-- END Manually Loaded Styles -->






        <!--[if lt IE 9]>
            <script src="/themes/rtm475/assets/global/plugins/respond.min.js"></script>
            <script src="/themes/rtm475/assets/global/plugins/excanvas.min.js"></script>
        <![endif]-->

        <!-- BEGIN CORE PLUGINS -->
        <script src="./dosya/jquery.min.js.indir" type="text/javascript"></script>
        <script src="./dosya/bootstrap.min.js.indir" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="./dosya/jquery.validate.min.js.indir" type="text/javascript"></script>
        <script src="./dosya/jquery.backstretch.min.js.indir" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="./dosya/app.min.js.indir" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->

        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <!--<script src="/assets/pages/scripts/login-5.min.js" type="text/javascript"></script>-->
                <!-- END PAGE LEVEL SCRIPTS -->

        <!-- BEGIN THEME LAYOUT SCRIPTS -->

        <!-- END THEME LAYOUT SCRIPTS -->

        <!-- BEGIN INITIALISATION SCRIPTS -->
        <script src="./dosya/app.js.indir" type="text/javascript"></script>
        <!-- END INITIALISATION SCRIPTS -->

        <link rel="shortcut icon" href="http://www.iconarchive.com/download/i18106/iconscity/flags/turkey.ico">
            </head>

    
    <!-- END HEAD -->