<?php

define( 'FOKUS_THEMEURL', get_bloginfo( 'template_directory' ) );
define( 'FOKUS_THEMENAME', "fokus" );

// Include color settings page
require_once('inc/settings.inc');

// Register stylesheets
// wp_enqueue_style( 'id', FOKUS_THEMEURL . '/style/FILE.css' );

// Register javascript
wp_enqueue_script( 'jquery' );
wp_enqueue_script( 'placeholder', FOKUS_THEMEURL . '/js/jquery.textPlaceholder.js', array( 'jquery' ) );
wp_enqueue_script( 'fokus', FOKUS_THEMEURL . '/js/jquery.fokus.js', array( 'jquery', 'placeholder' ) );

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

	// Feed support
	add_theme_support( 'automatic-feed-links' );

	// Register sidebars
	$zones = array(
		array('name' => 'Front-main'),
		array('name' => 'Sidebar'),
		array('name' => 'Footer'),
	);
	foreach ( $zones as $zone ) {
		register_sidebar( $zone );
	}

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

/**
 * Override search form
 */
function fokus_search_form($form) {
	$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	<div>
	<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __('Search for...') . '" title="' . __('Search for...') . '" />
	<input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
	</div>
	</form>';

	return $form;
}
add_filter( 'get_search_form', 'fokus_search_form' );


/**
 * Apply custom colors
 */
if ( ! function_exists( 'fokus_custom_colors' ) ) :
function fokus_custom_colors() {
	global $fokus_colors;

	// Setup colors
	$pri_theme_co = $fokus_colors[FOKUS_THEMENAME . '_theme_primary']   ? $fokus_colors[FOKUS_THEMENAME . '_theme_primary']   : '';
	$sec_theme_co = $fokus_colors[FOKUS_THEMENAME . '_theme_secondary'] ? $fokus_colors[FOKUS_THEMENAME . '_theme_secondary'] : '';

	$pri_menu_bg_in = $fokus_colors[FOKUS_THEMENAME . '_primary_menu_bg_inactive']    ? 'background: #' . $fokus_colors[FOKUS_THEMENAME . '_primary_menu_bg_inactive'] . ';' : '';
	$pri_menu_co_in = $fokus_colors[FOKUS_THEMENAME . '_primary_menu_color_inactive'] ? 'color: #' . $fokus_colors[FOKUS_THEMENAME . '_primary_menu_color_inactive'] . ';'   : '';
	$pri_menu_bg_ac = $fokus_colors[FOKUS_THEMENAME . '_primary_menu_bg_active']      ? 'background: #' . $fokus_colors[FOKUS_THEMENAME . '_primary_menu_bg_active'] . ';'   : 'background: #' . $pri_theme_co . ';';
	$pri_menu_co_ac = $fokus_colors[FOKUS_THEMENAME . '_primary_menu_color_active']   ? 'color: #' . $fokus_colors[FOKUS_THEMENAME . '_primary_menu_color_active'] . ';'     : '';
	$pri_menu_bg_ho = $fokus_colors[FOKUS_THEMENAME . '_primary_menu_bg_hover']       ? 'background: #' . $fokus_colors[FOKUS_THEMENAME . '_primary_menu_bg_hover'] . ';'    : '';
	$pri_menu_co_ho = $fokus_colors[FOKUS_THEMENAME . '_primary_menu_color_hover']    ? 'color: #' . $fokus_colors[FOKUS_THEMENAME . '_primary_menu_color_hover'] . ';'      : '';

	$sec_menu_bg_in = $fokus_colors[FOKUS_THEMENAME . '_secondary_menu_bg_inactive']    ? 'background: #' . $fokus_colors[FOKUS_THEMENAME . '_secondary_menu_bg_inactive'] . ';' : '';
	$sec_menu_co_in = $fokus_colors[FOKUS_THEMENAME . '_secondary_menu_color_inactive'] ? 'color: #' . $fokus_colors[FOKUS_THEMENAME . '_secondary_menu_color_inactive'] . ';'   : '';
	$sec_menu_bg_ac = $fokus_colors[FOKUS_THEMENAME . '_secondary_menu_bg_active']      ? 'background: #' . $fokus_colors[FOKUS_THEMENAME . '_secondary_menu_bg_active'] . ';'   : 'background: #' . $sec_theme_co . ';';
	$sec_menu_co_ac = $fokus_colors[FOKUS_THEMENAME . '_secondary_menu_color_active']   ? 'color: #' . $fokus_colors[FOKUS_THEMENAME . '_secondary_menu_color_active'] . ';'     : '';
	$sec_menu_bg_ho = $fokus_colors[FOKUS_THEMENAME . '_secondary_menu_bg_hover']       ? 'background: #' . $fokus_colors[FOKUS_THEMENAME . '_secondary_menu_bg_hover'] . ';'    : '';
	$sec_menu_co_ho = $fokus_colors[FOKUS_THEMENAME . '_secondary_menu_color_hover']    ? 'color: #' . $fokus_colors[FOKUS_THEMENAME . '_secondary_menu_color_hover'] . ';'      : 'color: #' . $pri_theme_co . ';';
?>
<style type="text/css">
<?php if ($pri_theme_co): ?>
	a:link    { color: #<?php echo $pri_theme_co; ?>; }
	a:visited { color: #<?php echo $pri_theme_co; ?>; }
	a:hover,
	a:focus   { color: #<?php echo $pri_theme_co; ?>; }
	a:active  { color: #<?php echo $pri_theme_co; ?>; }
<?php endif; ?>
<?php if ($pri_menu_bg_in || $pri_menu_co_in): ?>
	.primary-menu li a { <?php echo $pri_menu_bg_in . ' ' . $pri_menu_co_in; ?> }
<?php endif; ?>
<?php if ($pri_menu_bg_ac || $pri_menu_co_ac): ?>
	.primary-menu li.current-menu-item a { <?php echo $pri_menu_bg_ac . ' ' . $pri_menu_co_ac; ?> }
<?php endif; ?>
<?php if ($pri_menu_bg_ho || $pri_menu_co_ho): ?>
	.primary-menu li a:hover { <?php echo $pri_menu_bg_ho . ' ' . $pri_menu_co_ho; ?> }
<?php endif; ?>
<?php if ($sec_menu_bg_in || $sec_menu_co_in): ?>
	.secondary-menu li a { <?php echo $sec_menu_bg_in . ' ' . $sec_menu_co_in; ?> }
<?php endif; ?>
<?php if ($sec_menu_bg_ac || $sec_menu_co_ac): ?>
	.secondary-menu li.current-menu-item a { <?php echo $sec_menu_bg_ac . ' ' . $sec_menu_co_ac; ?> }
<?php endif; ?>
<?php if ($sec_menu_bg_ho || $sec_menu_co_ho): ?>
	.secondary-menu li a:hover { <?php echo $sec_menu_bg_ho . ' ' . $sec_menu_co_ho; ?> }
<?php endif; ?>
</style>
<?php
}
endif;

$fokus_colors = get_settings( FOKUS_THEMENAME . '_settings' );
if ($fokus_colors) {
	add_action('wp_head', 'fokus_custom_colors');
}
