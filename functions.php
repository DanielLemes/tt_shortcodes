<?php
/*==========================================
               TT SHORTCODES         
============================================
       2017, Daniel Lemes - Tutoriart
     https://www.tutoriart.com.br/?p=8941
               Under GPLv 3.0 
 https://www.gnu.org/licenses/gpl-3.0.en.html
===========================================*/
/*  THIS IS THE WORDPRESS FUNCTIONS FILE
AND NOT A STANDALONE! YOU CAN ADD THE CONTENT
        TO YOUR CHILD THEME FUNCTIONS      */

/* enqueue admin styles and scripts */
function tt_enqueue_admin_style() {
    wp_register_style( 'fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css' );
		wp_register_style( 'adminstyles', get_stylesheet_directory_uri() . '/admin/admin-styles.css');
    wp_enqueue_style( array('fontawesome','adminstyles') );
}
add_action( 'admin_enqueue_scripts', 'tt_enqueue_admin_style' );

/* enqueue styles sitewide */
function tt_enqueue_style() {
    wp_register_style( 'ttstyles', get_stylesheet_directory_uri() . '/admin/tt-styles.css');
    wp_register_style( 'fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css' );
    wp_enqueue_style( array('ttstyles', 'fontawesome') );
}
add_action('wp_enqueue_scripts', 'tt_enqueue_style');

/* original https://www.gavick.com/blog/wordpress-tinymce-custom-buttons */
function tt_tinymce_plugin($plugin_a) {
    $plugin_a['tt_shortcode_plugin'] = get_stylesheet_directory_uri() . '/admin/customcodes.js';
    return $plugin_a;
}
function tt_register_button($button) {
    array_push($button, "tt_button_key");
    return $button;
}
function tt_add_button() {
    global $typenow;
    /* verifica permissões do usuário */
    if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
		return;
}
/* verifica tipo de post */
if( ! in_array( $typenow, array( 'post', 'page' ) ) )
    return;
	  /* verifica se WYSIWYG está ativo */
	  if ( get_user_option('rich_editing') == 'true') {
		    add_filter('mce_external_plugins', 'tt_tinymce_plugin');
		    add_filter('mce_buttons', 'tt_register_button');
	  }
}
add_action('admin_head', 'tt_add_button');

/* CAIXAS */
function ttbox($atts, $content = null) {
	extract(shortcode_atts( array(
		'color' => '',
		'icon' => '',
		'title' => ''
	), $atts) );
	if ( $title === '' ) {
		$titulox = ''; 
	} else $titulox = '<div>'. $title .'</div>';

	if ( $color === '' ) {
		$corx = ''; 
	} else $corx = ' caixa-'. $color;

	if ( $icon === '' ) {
		$iconex = ''; 
	} else $iconex = '<i class="fa fa-'. $icon .'"></i>';

	$return = '
	<div class="sbox '. $corx .'"><div class="caixa-cabeca">'. $iconex . $titulox .'</div>
	'. $content .'</div>';
	return $return;
}
add_shortcode('tt_box','ttbox');
?>
