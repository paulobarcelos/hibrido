<?php define('WP_DEBUG', true); ?>
<?php $options = get_option('settings_options');?>
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
	<?php if (is_home()): ?>
		<title><?php echo $options['site_title'] ?></title>
	<?php else:?>
		<title><?php echo $title;?> - <?php echo $options['site_title'] ?></title>
	<?php endif; ?>
	
	<?php if (is_home()): ?>
		<meta name="description" content="<?php echo strip_tags($options['description']); ?>">
	<?php else:?>
	<?php endif; ?>
  	<meta name="author" content="Paulo Barcelos">
  	<meta name="viewport" content="width=device-width,initial-scale=1">

	<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory');?>/img/favicon.ico">
	<link rel="apple-touch-icon-precomposed" href="<?php bloginfo('stylesheet_directory');?>/img/apple-touch-icon-114x114-precomposed.png">	
	
  	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory');?>/css/style.css">
  	
  	<script src="<?php bloginfo('stylesheet_directory');?>/js/libs/modernizr-2.0.6.min.js"></script>
</head>
<body <?php body_class();?>">
	<header id="header">
		<div class="container">
			<div class="logo">
				<h1 class="logotype ir"><?php bloginfo('name'); ?></h1>
				<p class="description">
					<?php if (is_home()) :?>
						<span><?php echo $options['description']; ?></span>
					<?php else: ?>
						<span><?php echo $options['tagline']; ?></span>
					<?php endif; ?>	
				</p>
			</div>
			<nav id="mainnavigation">
				<ul>
					<?php $loop = new WP_Query( array( 'post_type' => 'area' ) ); ?>
					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<?php
					$area_info = simple_fields_get_post_group_values(get_the_ID(),"Area Info", true, 1);
					$color = strtolower($area_info['Color'][0]);
					?>
					<li class="<?php echo $color;?>">						
							<div class="shapes">
								<?php if (is_home()) :?>
								<div class="a"></div>
								<div class="b"></div>
								<div class="c"></div>
								<div class="d"></div>
								<?php endif; ?>
							</div>						
							<a class="link" href="<?php the_permalink(); ?>"><?php the_title();?></a>
					</li>
					<?php endwhile; ?>
					<?php wp_reset_query(); ?>
				</ul>
			</nav>
		</div>
	</header>
	<article id="main" role="main">
		<div class="container">