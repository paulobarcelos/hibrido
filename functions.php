<?php 
// CUSTOM POST TYPES ---------------------------------------------------------------
// AREA
add_action( 'init', 'register_cpt_area' );
function register_cpt_area() {
    $labels = array( 
        'name' => _x( 'Areas', 'area' ),
        'singular_name' => _x( 'Area', 'area' ),
        'add_new' => _x( 'Add New', 'area' ),
        'add_new_item' => _x( 'Add New Area', 'area' ),
        'edit_item' => _x( 'Edit Area', 'area' ),
        'new_item' => _x( 'New Area', 'area' ),
        'view_item' => _x( 'View Area', 'area' ),
        'search_items' => _x( 'Search Areas', 'area' ),
        'not_found' => _x( 'No areas found', 'area' ),
        'not_found_in_trash' => _x( 'No areas found in Trash', 'area' ),
        'parent_item_colon' => _x( 'Parent Area:', 'area' ),
        'menu_name' => _x( 'Areas', 'area' ),
    );
    $args = array( 
        'labels' => $labels,
        'hierarchical' => true,
        
        'supports' => array( 'title' ),
        
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 4,
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => false,
        'capability_type' => 'post'
    );
    register_post_type( 'area', $args );
	global $wp_rewrite;
	$wp_rewrite->add_rewrite_tag("%area%", '([^/]+)', "area=");
	$wp_rewrite->add_permastruct('area', '%area%', false);
	flush_rewrite_rules( false );
}
// Remove the slug from the custom post types permalink 
/*add_filter('post_type_link', 'area_link_filter_function', 1, 3);
function area_link_filter_function( $post_link, $id = 0, $leavename = FALSE ) {
	if (!is_object($post) || $post->post_type != 'area') {
		return str_replace('area/', '', $post_link);
	}
}*/
// CASE
add_action( 'init', 'register_cpt_case' );
function register_cpt_case() {
    $labels = array( 
        'name' => _x( 'Cases', 'case' ),
        'singular_name' => _x( 'Case', 'case' ),
        'add_new' => _x( 'Add New', 'case' ),
        'add_new_item' => _x( 'Add New Case', 'case' ),
        'edit_item' => _x( 'Edit Case', 'case' ),
        'new_item' => _x( 'New Case', 'case' ),
        'view_item' => _x( 'View Case', 'case' ),
        'search_items' => _x( 'Search Cases', 'case' ),
        'not_found' => _x( 'No cases found', 'case' ),
        'not_found_in_trash' => _x( 'No cases found in Trash', 'case' ),
        'parent_item_colon' => _x( 'Parent Case:', 'case' ),
        'menu_name' => _x( 'Cases', 'case' ),
    );
    $args = array( 
        'labels' => $labels,
        'hierarchical' => true,
        
        'supports' => array( 'title', 'post-formats' ),
        
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => false,
        'capability_type' => 'post'
    );
    register_post_type( 'case', $args );
	global $wp_rewrite;
	$wp_rewrite->add_rewrite_tag("%case%", '([^/]+)', "case=");
	$wp_rewrite->add_permastruct('case', '%case%', false);
}
// Remove the slug from the custom post types permalink 
add_filter('post_type_link', 'case_link_filter_function', 1, 3);
function case_link_filter_function( $post_link, $id = 0, $leavename = FALSE ) {
	if (!is_object($post) || $post->post_type != 'case') {
		return str_replace('case/', '', $post_link);
	}
}
// Make the Areas become possible parents for the cases ----------------------------
function remove_meta_box_handler (){
	remove_meta_box('pageparentdiv', 'case', 'normal');
}
function add_meta_box_handler (){
	add_meta_box('case-parent', 'Area', 'case_attributes_meta_box', 'case', 'side', 'high');
}
add_action('admin_menu', 'remove_meta_box_handler');
add_action('add_meta_boxes', 'add_meta_box_handler');
function case_attributes_meta_box($post) {
    $post_type_object = get_post_type_object($post->post_type);
	if ( $post_type_object->hierarchical ) {
		$pages = wp_dropdown_pages(array('post_type' => 'area', 'selected' => $post->post_parent, 'name' => 'parent_id', 'show_option_none' => __('(no parent)'), 'sort_column'=> 'menu_order, post_title', 'echo' => 0));
		if ( ! empty($pages) ) {
			echo $pages;
		}
	}
}
// CUSTOM IMAGE SIZES --------------------------------------------------------------
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'thumbnail', 350, 196, true ); //(cropped)
	add_image_size( 'gallery-image', 750, 9999 ); //(unlimited height)
}


// Remove junk from head -----------------------------------------------------------
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

add_action( 'widgets_init', 'remove_recent_comments_style' );
function remove_recent_comments_style() {  
    global $wp_widget_factory;  
    remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );  
}  
// Customize media upload tabs --------------------------------------------------
add_filter( 'media_upload_tabs', 'custom_media_upload_tabs');
add_filter( 'media_upload_default_tab', 'custom_media_upload_default_tab');
function custom_media_upload_tabs($arr_tabs) {
	if ( (isset($_GET["simple_fields_action"]) || isset($_GET["simple_fields_action"]) ) && ($_GET["simple_fields_action"] == "select_file" || $_GET["simple_fields_action"] == "select_file_for_tiny") ) {
		unset($arr_tabs["type"], $arr_tabs["gallery"], $arr_tabs["type_url"]);
	return $arr_tabs;
	}
}
function custom_media_upload_default_tab($tab) {
	$tab = 'library';
	return $tab;
}
// OPTIONS -------------------------------------------------------------------------------
add_action('admin_init', 'settings_init' );
add_action('admin_menu', 'settings_add_options_page');
// Init plugin options to white list our options
function settings_init(){
	register_setting( 'settings_plugin_options', 'settings_options', 'settings_validate_options' );
}
// Add menu page
function settings_add_options_page() {
	add_options_page('Options Page', 'Options', 'manage_options', __FILE__, 'settings_render_form');
}
// Render the Plugin options form
function settings_render_form() {
	?>
	<div class="wrap">		
		<!-- Display Plugin Icon, Header, and Description -->
		<div class="icon32" id="icon-options-general"><br></div>
		<h2>Options</h2>
		<!-- Beginning of the Plugin Options Form -->
		<form method="post" action="options.php">
			<?php settings_fields('settings_plugin_options'); ?>
			<?php $options = get_option('settings_options'); ?>
			<!-- Table Structure Containing Form Controls -->
			<!-- Each Plugin Option Defined on a New Table Row -->
			<table class="form-table">
				<!-- Textbox Control -->
				<tr>
					<th scope="row">Título do Site</th>
					<td>
						<input type="text" size="57" name="settings_options[site_title]" value="<?php echo $options['site_title']; ?>" />
					</td>
				</tr>				
				<!-- Textbox Control -->
				<tr>
					<th scope="row">Tagline</th>
					<td>
						<input type="text" size="57" name="settings_options[tagline]" value="<?php echo $options['tagline']; ?>" />
					</td>
				</tr>
				<!-- Text Area Control -->
				<tr>
					<th scope="row">Meta Descrição</th>
					<td>
						<textarea name="settings_options[description]" rows="3" cols="50" type='textarea'><?php echo $options['description']; ?></textarea>
						<br />
						<span style="color:#666666;margin-left:2px;">Aparecerá abaixo da logo e também na meta-description da home.<br />Use palavras chave pois este conteúdo é muito relevante para SEO.</span>
					</td>
				</tr>				
				<!-- Text Area Control -->
				<tr>
					<th scope="row">Introdução</th>
					<td>
						<textarea name="settings_options[intro]" rows="7" cols="50" type='textarea'><?php echo $options['intro']; ?></textarea>
						<br />
						<span style="color:#666666;margin-left:2px;">Aparecerá abaixo das áreas de atuação na home.</span>
					</td>
				</tr>
				<!-- Textbox Control -->
				<tr>
					<th scope="row">Label dos Clientes</th>
					<td>
						<input type="text" size="57" name="settings_options[clients_label]" value="<?php echo $options['clients_label']; ?>" />
						<br />
						<span style="color:#666666;margin-left:2px;">Exemplo: "Alguns de nossos clientes:"</span>
					</td>
				</tr>
				<!-- Textbox Control -->
				<tr>
					<th scope="row">Logos dos Clientes (ID da image)</th>
					<td>
						<input type="text" size="10" name="settings_options[clients_logos]" value="<?php echo $options['clients_logos']; ?>" />
						<br />
						<span style="color:#666666;margin-left:2px;">Para encontrar a ID, abra a imagem na "Media Library" e olhe a URL,<br />a ID esterá incluída lá como "attachment_id".<br />Exemplo(a ID é 16): www.hibrido.cc/wp-admin/media.php?attachment_id=16&action=edit</span>
					</td>
				</tr>
				<!-- Textbox Control -->
				<tr>
					<th scope="row">Contatos</th>
					<td>
						<textarea name="settings_options[contacts]" rows="2" cols="50" type='textarea'><?php echo $options['contacts']; ?></textarea>
						<br />
						<span style="color:#666666;margin-left:2px;">Não se esqueça de utilizar a tag <?php echo htmlentities('<br />');?> para quebrar a linha.</span>
					</td>
				</tr>				
				<!-- Textbox Control -->
				<tr>
					<th scope="row">Endereço do Blog</th>
					<td>
						<input type="text" size="57" name="settings_options[blog]" value="<?php echo $options['blog']; ?>" />
					</td>
				</tr>
				<!-- Textbox Control -->
				<tr>
					<th scope="row">Página no Facebook</th>
					<td>
						<input type="text" size="57" name="settings_options[facebook]" value="<?php echo $options['facebook']; ?>" />
					</td>
				</tr>
				<!-- Textbox Control -->
				<tr>
					<th scope="row">Página no Twitter</th>
					<td>
						<input type="text" size="57" name="settings_options[twitter]" value="<?php echo $options['twitter']; ?>" />
					</td>
				</tr>
				<!-- Textbox Control -->
				<tr>
					<th scope="row">Google Analytics Track ID</th>
					<td>
						<input type="text" size="57" name="settings_options[analytics]" value="<?php echo $options['analytics']; ?>" />
					</td>
				</tr>
			</table>
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
		</form>
	</div>
	<?php	
}
// Sanitize and validate input. Accepts an array, return a sanitized array.
function settings_validate_options($input) {
	 // strip html from textboxes
	$input['textarea_one'] =  wp_filter_nohtml_kses($input['textarea_one']); // Sanitize textarea input (strip html tags, and escape characters)
	$input['txt_one'] =  wp_filter_nohtml_kses($input['txt_one']); // Sanitize textbox input (strip html tags, and escape characters)
	return $input;
}
add_filter( 'plugin_action_links', 'settings_plugin_action_links', 10, 2 );
// Display a Settings link on the main Plugins page
function settings_plugin_action_links( $links, $file ) {
	if ( $file == plugin_basename( __FILE__ ) ) {
		$settings_links = '<a href="'.get_admin_url().'options-general.php?page=plugin-options-starter-kit/plugin-options-starter-kit.php">'.__('Settings').'</a>';
		// make the 'Settings' link appear first
		array_unshift( $links, $settings_links );
	}
	return $links;
}


// DISPLAY  BUILDERS -----------------------------------------------------
function pb_facebook_like($width, $url = false){
?>
	<div class="fb-like" style="width: <?php echo $width;?>px;">
		<iframe src="//www.facebook.com/plugins/like.php?app_id=237679169615804&amp;href<?php echo ($url)?"=".$url:"";?>&amp;send=false&amp;layout=standard&amp;width=<?php echo $width;?>&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:<?php echo $width;?>px; height:80px;" allowTransparency="true"></iframe>
	</div>
<?php
}
?>