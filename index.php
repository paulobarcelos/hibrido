<?php get_header(); ?>
<?php $options = get_option('settings_options');?>
<?/*$options = get_option('settings_options');
	$select = $options['drp_select_box'];*/?>
<div id="curlybrace">
	<div class="outer left"></div>
	<div class="inner left"></div>
	<div class="inner right"></div>
	<div class="outer right"></div>
</div>
<p class="text"><?php echo $options['intro']; ?></p>
<?php get_footer(); ?>