<?php get_header(); ?>
<?php
	$info = simple_fields_get_post_group_values(get_the_id(),"Area Info", true, 1);
	$color = strtolower($info['Color'][0]);
	$metadescription = $info['Meta Description'][0];
	$description = $info['Description'][0];
	
	$cases_ids =& get_children( 'post_type=case&post_parent='.get_the_ID() );
?>
<div class="side">
	<div id='area' class="<?php echo $color;?>">
		<div class="ir shape"></div>
		<h1 class="name"><?php the_title();?></h1>
	</div>
		
</div>
<div class="central">
	<p class="heading"><?php echo $metadescription;?></p>
	<?php echo wpautop($description); ?>
	<div class="itemlist">
		<?php
		$i = -1;
		$left = false;
		foreach($cases_ids as $id => $case_id):
			$case = get_post($id);
			$case_info = simple_fields_get_post_group_values($case->ID,"Case Info", true, 1);
			$case_title = get_the_title($id);
			$case_metadescription = $case_info['Meta Description'][0];
			$case_image = wp_get_attachment_image_src($case_info['Featured Image'][0], "thumbnail");
			$i ++;
			if($i > 2) $i = 0;
			if($left) $left = false;
			else $left = true;
		?>
		<article class="item <?php echo $color;?> <?php echo 'color'.$i;?> <?php echo ($left)?'left':'right';?>" style="<?php echo($case_image)?'background-image:url(\''.$case_image[0].'\');':''; ?>" >
			<a href="<?php echo get_post_permalink($id);?>">
				<h1><?php echo $case_title;?></h1>
				<p class="description"><?php echo $case_metadescription;?></p>
			</a>
		</article>
		<?php endforeach;?>
	</div>
	
	
</div>		
<?php get_footer(); ?>