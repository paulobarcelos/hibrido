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
<p class="clientslabel"><?php echo $options['clients_label']; ?></p>
<?php $clients_logos = wp_get_attachment_image_src($options['clients_logos'], "full");?>
<div class="clientslogos">
	<img src="<?php echo $clients_logos[0];?>" />
</div>
<?php get_footer(); ?>