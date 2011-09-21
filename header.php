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
  	$META_TITLE = "";
	$META_DESCRIPTION = "";
	$META_URL = "";
	$META_IMAGE = "";
	$META_TYPE = "";
	$META_IMAGE = get_bloginfo('stylesheet_directory')."/img/hibrido.png";
	$META_SITE_NAME = $options['site_title'];
	$META_AUTHOR = "Paulo Barcelos";
	
	if (is_home()): 
		$META_URL = get_bloginfo('url');
		$META_TITLE = $options['site_title'];
		$META_DESCRIPTION = strip_tags($options['description']);
		$META_TYPE = "website";
	elseif (is_single()):
		$META_URL = get_post_permalink();
		$META_TITLE = get_the_title().' - '.$options['site_title'];
		$META_TYPE = "article";
		
		$type = get_post_type();
		$info;
		if($type == "area"){
			$info = simple_fields_get_post_group_values(get_the_id(),"Area Info", true, 1);
		}elseif($type == "case"){
			$info = simple_fields_get_post_group_values(get_the_id(),"Case Info", true, 1);
			$image = wp_get_attachment_image_src($info['Featured Image'][0], "gallery-image");
			if($image) $META_IMAGE = $image[0];
		}
		$META_DESCRIPTION = $info['Meta Description'][0];
	else:
		$META_TITLE = "Página não encontrada";
	endif;
	?>
	<?php if(!empty($META_TITLE)):?><title><?php echo $META_TITLE;?></title><?php endif;?>
	<?php if(!empty($META_DESCRIPTION)):?><meta name="description" content="<?php echo $META_DESCRIPTION;?>">	<?php endif;?>
	<?php if(!empty($META_TITLE)):?><meta property="og:title" content="<?php echo $META_TITLE;?>"><?php endif;?>
    <?php if(!empty($META_TYPE)):?><meta property="og:type" content="<?php echo $META_TYPE;?>"><?php endif;?>
    <?php if(!empty($META_URL)):?><meta property="og:url" content="<?php echo $META_URL;?>"><?php endif;?>
    <?php if(!empty($META_IMAGE)):?><meta property="og:image" content="<?php echo $META_IMAGE;?>"><?php endif;?>
    <?php if(!empty($META_SITE_NAME)):?><meta property="og:site_name" content="<?php echo $META_SITE_NAME;?>"><?php endif;?>
    <?php if(!empty($META_DESCRIPTION)):?><meta property="og:description" content="<?php echo $META_DESCRIPTION;?>"><?php endif;?>
  	
  	<?php if(!empty($META_AUTHOR)):?><meta name="author" content="<?php echo $META_AUTHOR;?>"><?php endif;?>
  	<meta name="viewport" content="width=device-width,initial-scale=1">

	<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory');?>/img/favicon.ico">
	<link rel="apple-touch-icon-precomposed" href="<?php bloginfo('stylesheet_directory');?>/img/apple-touch-icon-114x114-precomposed.png">	
	
  	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory');?>/css/style.css">
  	
  	<script src="<?php bloginfo('stylesheet_directory');?>/js/libs/modernizr-2.0.6.min.js"></script>
</head>
<?php
	if(is_single()){
		$root_id;
		if($post->post_parent) $root_id = $post->post_parent;
		else $root_id = get_the_ID();
		$root_info = simple_fields_get_post_group_values($root_id,"Area Info", true, 1);
		$root_color = strtolower($root_info['Color'][0]);	
	}
?>
<body class="<?php echo implode(" ", get_body_class());?> <?php if(isset($root_color)) echo $root_color; ?>" >
	<header id="header">
		<div class="container">
			<div class="logo">				
			<?php if (!is_home()) :?>
				<a href="<?php bloginfo('url');?>">
			<?php endif; ?>				
					<h1 class="logotype ir"><?php bloginfo('name'); ?></h1>
					<?php if (is_home()) :?>
						<p class="tagline"><?php echo $options['tagline']; ?></p>
					<?php endif; ?>
					<p class="description">
						<?php if (is_home()) :?>
							<span><?php echo $options['description']; ?></span>
						<?php else: ?>
							<span><?php echo $options['tagline']; ?></span>
						<?php endif; ?>	
					</p>
			<?php if (!is_home()) :?>
				</a>
			<?php endif; ?>
			</div>
			<nav id="mainnavigation">
				<ul>
					<?php $loop = new WP_Query( array( 'post_type' => 'area' ) ); ?>
					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<?php
					$area_info = simple_fields_get_post_group_values(get_the_ID(),"Area Info", true, 1);
					$color = strtolower($area_info['Color'][0]);
					?>
					<li class="<?php echo $color;?> <?php if(isset($root_id)):if($root_id==get_the_ID()):echo 'selected';endif;endif;?> ">	
						<a href="<?php the_permalink(); ?>">					
							<div class="shapes">
								<?php if (is_home()) :?>
								<div class="a"></div>
								<div class="b"></div>
								<div class="c"></div>
								<div class="d"></div>
								<?php endif; ?>
							</div>						
							<span class="link"><?php the_title();?></span>
						</a>
					</li>
					<?php endwhile; ?>
					<?php wp_reset_query(); ?>
				</ul>
			</nav>
		</div>
	</header>
	<article id="main" role="main">
		<div class="container clearfix">