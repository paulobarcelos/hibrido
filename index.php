<?php get_header(); ?>
<?php $options = get_option('settings_options');?>
<div id="curlybrace">
	<div class="outer left"></div>
	<div class="inner left"></div>
	<div class="inner right"></div>
	<div class="outer right"></div>
</div>
<p class="text"><?php echo $options['intro']; ?></p>
<?php pb_facebook_like(300);?>
<?php get_footer(); ?>