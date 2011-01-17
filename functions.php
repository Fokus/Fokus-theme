<?php

define( 'FOKUS_THEMEURL', get_bloginfo( 'template_directory' ) );
define( 'FOKUS_THEMENAME', "fokus" );

// Include color settings page
require_once('inc/settings.inc');

add_action( 'after_setup_theme', 'fokus_setup' );

if ( ! function_exists( 'fokus_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @uses add_theme_support() To add support for post thumbnails.
 * @uses add_custom_background() To add support for a custom background.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_image_header() To add support for a custom header, in this case we use it for a logo instead.
 */
function fokus_setup() {
	// Post thumbs
	add_theme_support( 'post-thumbnails' );

	// Menus
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'fokus' ),
		'secondary' => __( 'Secondary Navigation', 'fokus' ),
	) );

	// This theme allows users to set a custom background
	add_custom_background();

	// Header image (Logo)
	if ( ! defined( 'HEADER_TEXTCOLOR' ) )
		define( 'HEADER_TEXTCOLOR', '' );

	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'fokus_header_logo_width', 100 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'fokus_header_logo_height', 50 ) );

	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	if ( ! defined( 'NO_HEADER_TEXT' ) )
		define( 'NO_HEADER_TEXT', true );

	add_custom_image_header( '', NULL );
}

endif;

// Register stylesheets
// wp_enqueue_style( 'id', FOKUS_THEMEURL . '/style/FILE.css' );

// Register javascript
wp_enqueue_script( 'jquery' );

// Apply custom colors
$fokus_colors = get_settings( FOKUS_THEMENAME . '_settings' );
if ($fokus_colors) {
	add_action('wp_head', 'fokus_custom_colors');
}

if ( ! function_exists( 'fokus_custom_colors' ) ) :
function fokus_custom_colors() {
	global $fokus_colors;
?>
<style type="text/css">
	.primary-menu a { background: #<?php echo $fokus_colors['fokus_menu_bg_inactive']; ?>; color: #<?php echo $fokus_colors['fokus_menu_color_inactive']; ?>; }
	.primary-menu a.active { background: #<?php echo $fokus_colors['fokus_menu_bg_active']; ?>; color: #<?php echo $fokus_colors['fokus_menu_color_active']; ?>; }
	.primary-menu a:hover { background: #<?php echo $fokus_colors['fokus_menu_bg_hover']; ?>; color: #<?php echo $fokus_colors['fokus_menu_color_hover']; ?>; }
</style>
<?php
}
endif;
