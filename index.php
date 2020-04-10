<?php
 
error_reporting(E_ERROR);

$get_url  = "http://".$_SERVER['HTTP_HOST']."/api/wyapi.php";

$get_json = file_get_contents($get_url);

$get_json = stripslashes(html_entity_decode($get_json)); //编译转码

$arrdata = json_decode($get_json,true);

if ( $arrdata['song_id'] == ""){ 
    echo "<script language=JavaScript> location.replace(location.href);</script>";
	} 
if ( $arrdata['comment_content'] == "" ){
	 $arrdata['comment_content'] = "歌曲没有热评";
}

?>


<!DOCTYPE HTML>
<html>
	<head>
		<title>网易云热评</title>
		    <meta name="description" content="网易云热评"/>
    <meta name="keywords" content="网易云热评"/>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="shortcut icon" href="//s1.music.126.net/style/favicon.ico?v20180823" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<style>
		/* BG */

	#bg {
		-moz-transform: scale(1.0);
		-webkit-transform: scale(1.0);
		-ms-transform: scale(1.0);
		transform: scale(1.0);
		-webkit-backface-visibility: hidden;
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100vh;
		z-index: 1;
	}
		#bg:before, #bg:after {
			content: '';
			display: block;
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
		}

		#bg:before {
			-moz-transition: background-color 2.5s ease-in-out;
			-webkit-transition: background-color 2.5s ease-in-out;
			-ms-transition: background-color 2.5s ease-in-out;
			transition: background-color 2.5s ease-in-out;
			-moz-transition-delay: 0.75s;
			-webkit-transition-delay: 0.75s;
			-ms-transition-delay: 0.75s;
			transition-delay: 0.75s;
			background-image: linear-gradient(to top, rgba(19, 21, 25, 0.5), rgba(19, 21, 25, 0.5)), url("../../images/overlay.png");
			background-size: auto, 256px 256px;
			background-position: center, center;
			background-repeat: no-repeat, repeat;
			z-index: 2;
		}

		#bg:after {
			-moz-transform: scale(1.125);
			-webkit-transform: scale(1.125);
			-ms-transform: scale(1.125);
			transform: scale(1.125);
			-moz-transition: -moz-transform 0.325s ease-in-out, -moz-filter 0.325s ease-in-out;
			-webkit-transition: -webkit-transform 0.325s ease-in-out, -webkit-filter 0.325s ease-in-out;
			-ms-transition: -ms-transform 0.325s ease-in-out, -ms-filter 0.325s ease-in-out ;
			transition: transform 0.325s ease-in-out, filter 0.325s ease-in-out ;
			background-image: url("<?php echo $arrdata['images']; ?>");
			background-position: center;
			background-size: cover;
			background-repeat: no-repeat;
			-moz-filter: blur(15px);
			-webkit-filter: blur(15px);
			-ms-filter: blur(15px);
			filter: blur(15px);
		}




		body.is-article-visible #bg:after {
			-moz-transform: scale(1.0825);
			-webkit-transform: scale(1.0825);
			-ms-transform: scale(1.0825);
			transform: scale(1.0825);
			-moz-filter: blur(0.2rem);
			-webkit-filter: blur(0.2rem);
			-ms-filter: blur(0.2rem);
			filter: blur(0.2rem);
		}

		body.is-loading #bg:before {
			background-color: #000000;
		}
</style>
	</head>
	<body>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="logo">
		<img src="<?php echo $arrdata['images']; ?>" class="logo">
						</div>
						<div class="content">
							<div class="inner">
								<h1><?php echo $arrdata['title']; ?>-<?php echo $arrdata['author']; ?></h1>
		<p><?php echo $arrdata['comment_content']; ?></p>
				<p>————网易云ID：<?php echo $arrdata['comment_nickname']; ?></p>

							</div>
						</div>
						<nav>
							<ul>
								<li><a href="index.php">刷新</a></li>
								<li><a href="somusic/index.php?name=<?php echo $arrdata['song_id']; ?>&type=netease" target="_blank">播放</a></li>
								
							</ul>
						</nav>
					</header>

			

				<!-- Footer -->
					<footer id="footer">
						<p class="copyright">&copy; Untitled. Design: <a href="#">网易云热评-致我逝去的青春</a>.</p>
					</footer>

			</div>

		<!-- BG -->
			<div id="bg"></div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
