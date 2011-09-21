<?php get_header(); ?>
<?php
	$parent_title = get_the_title($post->post_parent);
	$parent_permalink = get_post_permalink($post->post_parent);
	
	$info = simple_fields_get_post_group_values(get_the_id(),"Case Info", true, 1);
	$metadescription = $info['Meta Description'][0];
	$description = $info['Description'][0];
	$featured_image = wp_get_attachment_image_src($info['Featured Image'][0], "gallery-image");
	$quote_text = $info['Quote text'][0];
	$quote_author = $info['Quote Author'][0];
	$images_info = simple_fields_get_post_group_values(get_the_ID(),"Case Images", true, 1);
	$images = $images_info["Image"];
	$videos_info = simple_fields_get_post_group_values(get_the_ID(),"Case Videos", true, 1);
	$videos = $videos_info["Embed Code"];	
?>
<div class="side">
	<a href="<?php echo $parent_permalink; ?>" class="back"><?php echo $parent_title; ?></a>		
</div>
<div class="central">
	<h1 class="title"><?php the_title();?></h1>
	
	<?php if($metadescription):?>
		<p class="heading"><?php echo $metadescription; ?></p>
	<?php endif;?>
	
	<?php pb_facebook_like(300);?>
	
	<?php if($featured_image):?>
		<div class="rounded" style="<?php echo 'background-image:url(\''.$featured_image[0].'\'); width: '.$featured_image[1].'px; height: '.$featured_image[2].'px;'; ?>">
			<img class="fallbackimage" src="<?php echo $featured_image[0];?>" />
		</div>
	<?php endif;?>
	
	<?php if($quote_author && $quote_text):?>
		<p class="quote">“<?php echo $quote_text; ?>”<span class="quoteauthor"><?php echo $quote_author; ?></span></p>		
	<?php endif;?>
	
	<?php echo wpautop($description); ?>
	
	<?php if(count($videos)):?>
		<?php foreach($videos as $video):?>
			<div class="galleryitem">
				<?php echo $video;?>
			</div>
		<?php endforeach;?>
	<?php endif;?>
	
	<?php if(count($images)):?>
		<?php foreach($images as $image):?>
			<div class="galleryitem">
				<?php $image = wp_get_attachment_image_src($image, "gallery-image");?>
				<div class="rounded" style="<?php echo 'background-image:url(\''.$image[0].'\'); width: '.$image[1].'px; height: '.$image[2].'px;'; ?>">
					<img class="fallbackimage" src="<?php echo $image[0];?>" />
				</div>
			</div>
		<?php endforeach;?>
	<?php endif;?>
	
	<a href="<?php echo $parent_permalink; ?>" class="back"><?php echo $parent_title; ?></a>
</div>		
<?php get_footer(); ?>