<?php define('WP_DEBUG', true); ?>
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>  	  	<html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>  	  	<html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  	<?php 
	if (is_single() || is_page()) {
		$title = get_the_title ();
	} else {
		$title = "Página não encontrada";
	}
	?>
	<?php if (is_home()) { ?>
		<title><?php bloginfo('name'); ?></title>
	<?php } else {?>
		<title><?php echo $title;?> - <?php bloginfo('name'); ?></title>
	<?php } ?>
	
  	<meta name="description" content="">
  	<meta name="author" content="Paulo Barcelos">
  	<meta name="viewport" content="width=device-width,initial-scale=1">

	<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory');?>/img/favicon.ico">
	<link rel="apple-touch-icon-precomposed" href="<?php bloginfo('stylesheet_directory');?>/img/apple-touch-icon-114x114-precomposed.png">	
	
  	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory');?>/css/style.css">
  	
  	<script src="<?php bloginfo('stylesheet_directory');?>/js/libs/modernizr-2.0.6.min.js"></script>
</head>
<?php
	$body_class = "";
		 if (is_home())		$body_class = "home";
	else if (is_single() || is_page())	$body_class = "single";
?>
<body class="<?php echo $body_class; ?>">
	<header id="header">
		<div class="container">
			<div class="logo">
				<h1 class="logotype ir"><?php bloginfo('name'); ?></h1>
				<p class="description">
					<?php if (is_home()) :?>
						<span><i>Somos híbridos.</i> Uma empresa de comunicação que produz cultura e uma produtora cultural que comunica.</span>
					<?php else: ?>
						<span><?php bloginfo('description'); ?></span>
					<?php endif; ?>	
				</p>
			</div>
			<nav id="mainnavigation">
				<ul>
					<li class="red">						
							<div class="shapes">
								<?php if (is_home()) :?>
								<div class="a"></div>
								<div class="b"></div>
								<div class="c"></div>
								<div class="d"></div>
								<?php endif; ?>
							</div>						
							<a class="link" href="#">Vídeo</a>
					</li>
					<li class="yellow">
							<div class="shapes">
								<?php if (is_home()) :?>
								<div class="a"></div>
								<div class="b"></div>
								<div class="c"></div>
								<div class="d"></div>
								<?php endif; ?>
							</div>
							<a class="link" href="#">Acessoria de Imprensa</a>
					</li>
					<li class="green">
							<div class="shapes">
								<?php if (is_home()) :?>
								<div class="a"></div>
								<div class="b"></div>
								<div class="c"></div>
								<div class="d"></div>
								<?php endif; ?>
							</div>
							<a class="link" href="#">Vídeo</a>
					</li>
					<li class="blue">
							<div class="shapes">
								<?php if (is_home()) :?>
								<div class="a"></div>
								<div class="b"></div>
								<div class="c"></div>
								<div class="d"></div>
								<?php endif; ?>
							</div>
							<a class="link" href="#">Acessoria de Imprensa</a>
					</li>
				</ul>
			</nav>
		</div>
	</header>
	<article id="main" role="main">
		<div class="container">