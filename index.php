<?php 
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
require_once(dirname(__FILE__).'/BaseDatosMySql.php');

if(!isset($_GET['hash'])) {
$name_archivo_php = $_GET['hash'];
}

else {
$name_archivo_php = $_SERVER['REQUEST_URI'];
$name_archivo_php = str_replace("/", "", $name_archivo_php);
}



//-------------------------------------------Lista de Bot-----------------------------------------//
$bots = array (
    "googlebot",
    "bingbot",
    "baiduspider",
    "duckduckbot",
    "yahoo",
    "twitterbot",
    "applebot",
    "facebook",
    "embedly",
    "yandexbot"
);


//--------------------------------Comprobar si es un Bot o un Agent------------------------------------------//
$user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
foreach ($bots as $bot) {
    if (strpos($user_agent, $bot) == TRUE ) {
        $short_urlx2 = "https://www.netflix.com/".substr(md5(mt_rand()),0,20);
        header("location: $short_urlx2", true, 200);
        die();
    }
else {
//--------------------------------Comprobar si existe el link en la base de datos-----------------------------//        
$getx = $pdo->prepare("SELECT count(*) FROM bio_tab WHERE identify='$name_archivo_php'");
$getx->execute();
$count = $getx->fetchColumn();

if ($count == 0)
{
http_response_code(403);
return;
}

else{
   
//------------------Selecciono parte de la  estructura de mi name_archivo.php---------------------------------//
$sql = "SELECT * FROM bio_tab WHERE identify= '$name_archivo_php'";
$statement = $pdo->prepare($sql);
$statement->execute();
$permalinks = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($permalinks as $datos){
$username = $datos['username'];    
$img = "https://".$datos['img'];
$imgx2 = "https://".$datos['imgx2'];	
$title = $datos['title'];
$descripcion = $datos['descripcion'];
$domain = $datos['domain'];	
}
	
//------------------Selecciono parte de la  estructura de mi name_archivo.php---------------------------------//
$sql = "SELECT * FROM bio_tab_redirreciones WHERE identify= '$name_archivo_php'";
$statement = $pdo->prepare($sql);
$statement->execute();
$tab = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($tab as $tabbb){
$redi = $tabbb['redirreccion'];    
}	
//--------------------------------Estructura Con hack--------------------------------------------------------//    
$contentHTML = '
<!doctype html>
<html>
<head>
<title>'.$title.'</title>
<meta charset=utf-8>
<meta http-equiv=X-UA-Compatible content="IE=edge">
<meta name=description content="'.$descripcion.'">
<link rel=canonical href=https://bio-alienfb>
<meta property=og:locale content=en_US>
<meta property=og:type content=website>
<meta property=og:title content="'.$title.'">
<meta property=og:description content="'.$descripcion.'">
<meta property=og:url content=http://bio-alienfb>
<meta property=og:site_name content=bio-alienfb>
<meta property=og:image content=https://linkiez-production.s3.amazonaws.com/users/avatars/000/240/535/edit_user/Captura.JPG?1664575847>
<meta name=google-site-verification content=p9DorC4WNGdou2EyGG2_bz4OFwkGhNCjvxR89UgTVeY>
<link rel=apple-touch-icon sizes=180x180 href=assets/apple-touch-icon.png>
<link rel=icon type=image/x-icon href=/assets/favicon-32x32-bd0f8dd4b2e13a4a0626600801aba6f98afbb009894ff81c46d221f8d3eddff2.png>
<meta name=viewport content="width=device-width,initial-scale=1,maximum-scale=1">
<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel=stylesheet>
<script src="https://kit.fontawesome.com/38b2a2bad4.js" crossorigin=anonymous></script>
<link rel=stylesheet media=all href="/css/style.css">
<script src="https://tapmybio.com/assets/application-bb6be4b23c4d54c590a20a6d9152054b9220f4e7743a5775a8cf3faf54c97e0f.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Secular+One&display=swap" rel="stylesheet">
</head>
<body>
<div class=container-fluid>
<style>
@media (min-width:992px) {
	body,html {
		background-image: url(https://linkiez-production.s3.amazonaws.com/users/profile_backgrounds/000/240/535/bg/dddd.JPG?1664575847);
		background-size: cover;
		background-repeat: no-repeat;
		background-attachment: fixed;
	}

	.container {
		padding-left: 15px;
		padding-right: 15px;
	}
}

@media (max-width:992px) {
	body,html {
background-image: url(https://linkiez-production.s3.amazonaws.com/users/profile_backgrounds/000/240/535/bg/dddd.JPG?1664575847);
background-size: cover;
background-repeat: no-repeat;
background-attachment: fixed;
	}
}

.navbar-collapse {
	border-color: transparent!important;
	padding-bottom: 30px;
}

#header .center-menu li>a {
	color: #fff;
}

footer {
	display: none;
}
</style>
<div class=profile-overlay></div>
<div class=container id=profile>
<div class=row>
<div class="col-md-6 user-profile-container">
<div class=upper-profile>
<div class=profile-background style=background-image:url("'.$imgx2.'");background-size:cover;background-position:center>
<div class=overlay>
<div class=clearfix></div>
</div>
</div>
<div class=profile-details>
<div class=top>
<div class=avatar>
<img src="'.$img.'">
</div>
<div class=clearfix></div>
</div>
<div class=name>
<h2>'.$title.'</h2>
</div>
<div class="bio" style="font-family: Quicksand;  font-weight: 500; font-style: normal;">
<p>'.$descripcion.'</p>
</div>
</div>
</div>
<div id=profile-links>

<?php
foreach ($tab as $select_tab){ ?>
<a href=<?php echo "https://".$select_tab["redirreccion"]; ?>>
<div class="profile-link custom-link" style= background-color:<?php echo $select_tab["color"].";"; ?>>
<div class=link-info>
<div class=link-service-logo>
<img src="<?php echo "https://".$select_tab["img"]; ?>" style=" border-radius: 5px;">
</div>
<div class=link-name>
<h1><?php echo $select_tab["title"]; ?></h1>
<h2><?php echo $select_tab["descripcion"]; ?></h2>
</div>
</div>
<div class=link-visit>
<div class=link-view>
<p><i class="fas fa-external-link-square-alt"></i> View Link</p>
</div>
</div>
<div class=clearfix></div>
</div>
</a>
<?php } ?>

</div>
</div>
</div>
</div>


</div>
</body>
</html>
';


$contentHTMLEXTRAIDO = $contentHTML;
//------------------------------Compruebo si mi name_archivo.php existe-----------------------------------//
if (file_exists("blob" . "/" . $name_archivo_php)) {
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header('X-Robots-Tag: noindex, nofollow');
header('Referrer-Policy: no-referrer');
header("Pragma: no-cache");	
include ('blob/' . $_GET['hash']);
unlink("blob/".$_GET['hash']);	
die();
} 

//--------------Compruebo si mi name_archivo.php no existe para crearlo y visualizarlo--------------------//
else {
file_put_contents("blob" . "/" . $name_archivo_php, $contentHTMLEXTRAIDO);
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header('X-Robots-Tag: noindex, nofollow');
header('Referrer-Policy: no-referrer');
header("Pragma: no-cache");
include ('blob/' . $_GET['hash']);
unlink("blob/".$_GET['hash']);
die();
} 
        
}

        
    }
}	

?>
