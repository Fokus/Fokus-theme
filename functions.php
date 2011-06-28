<?php

define( 'FOKUS_THEMEURL', get_template_directory_uri() );
define( 'FOKUS_THEMENAME', 'fokus' );

if ( is_admin() ) {
	wp_enqueue_style( 'fonts', FOKUS_THEMEURL . '/style/admin.css' );
}

// Create the documentation panel and include readme.txt
add_action( 'admin_menu', 'fokus_add_page' );

function fokus_add_page() {
  add_dashboard_page( __( 'Documentation' ), __( 'Documentation' ), 'administrator', 'fokus_help', 'fokus_help_page');
}

function fokus_help_page() { ?>
	<div class="wrap fokus-documentation">
		<?php screen_icon(); echo '<h2>Documentation</h2>';
		include( 'readme.txt' ); ?>
	</div>
<?php }

function fokus_theme_setup() {
  global $content_width;
  if (!isset($content_width)) {
    $content_width = 1020;
  }
}

add_action('after_setup_theme','fokus_theme_setup');

// Include color settings page
require_once( 'inc/settings.inc' );

// Register stylesheets
function fokus_add_css() {
	if ( !is_admin() ) {
		wp_enqueue_style( 'fokus-reset', FOKUS_THEMEURL . '/style/reset.css' );
		wp_enqueue_style( 'fokus-layout', FOKUS_THEMEURL . '/style/layout.css' );
		wp_enqueue_style( 'fokus-text-forms', FOKUS_THEMEURL . '/style/text-forms.css' );
		wp_enqueue_style( 'fokus-menu', FOKUS_THEMEURL . '/style/menu.css' );
		wp_enqueue_style( 'fokus-widgets', FOKUS_THEMEURL . '/style/widgets.css' );
		wp_enqueue_style( 'fokus-posts', FOKUS_THEMEURL . '/style/posts.css' );
		wp_enqueue_style( 'fokus-comments', FOKUS_THEMEURL . '/style/comments.css' );
	}
}

add_action( 'after_setup_theme', 'fokus_add_css' );

// Register javascript
function fokus_add_js() {
	if ( !is_admin() ) :
		wp_enqueue_script( 'placeholder', FOKUS_THEMEURL . '/js/jquery.textPlaceholder.js', array( 'jquery' ) );
		wp_enqueue_script( 'fokus-main', FOKUS_THEMEURL . '/js/jquery.fokus.js', array( 'jquery', 'placeholder' ), false, true );
		if ( is_singular() ) :
			wp_enqueue_script( 'comment-reply' );
		endif;
	endif;
}

add_action( 'wp_enqueue_scripts', 'fokus_add_js' );

// Load translations
load_theme_textdomain( 'fokus', TEMPLATEPATH . '/languages' );

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
	$global = array(
		'before_widget' => '<div id="%1$s" class="widget-container %2$s"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '</div><h3 class="widget-title">',
		'after_title' => '</h3><div class="widget-content">',
	);

	$zones = array(
		array(
			'id' => 'secondary-menu',
			'name' => __( 'Secondary menu', 'fokus' ),
			'description' => __( 'Widgets in the secondary menu of every page', 'fokus' ),
		) + $global,
		array(
			'id' => 'sidebar',
			'name' => __( 'Sidebar', 'fokus' ),
			'description' => __( 'The right sidebar of every page', 'fokus' ),
		) + $global,
		array(
			'id' => 'front-top',
			'name' => __( 'Front, top', 'fokus' ),
			'description' => __( 'The top area of the frontpage', 'fokus' ),
		) + $global,
		array(
			'id' => 'front-main',
			'name' => __( 'Front, main', 'fokus' ),
			'description' => __( 'The main area of the frontpage', 'fokus' ),
		) + $global,
		array(
			'id' => 'front-middle',
			'name' => __( 'Front, middle', 'fokus' ),
			'description' => __( 'The middle area of the frontpage', 'fokus' ),
		) + $global,
		array(
			'id' => 'middle',
			'name' => __( 'Middle column', 'fokus' ),
			'description' => __( 'The middle area of all pages but the front page', 'fokus' ),
		) + $global,
		array(
			'id' => 'footer',
			'name' => __( 'Footer', 'fokus' ),
			'description' => __( 'The footer of every page', 'fokus' ),
		) + $global
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

	if ( ! defined( 'HEADER_IMAGE' ) )
		define( 'HEADER_IMAGE', '' );

	if ( ! defined( 'HEADER_IMAGE_WIDTH' ) )
		define( 'HEADER_IMAGE_WIDTH', apply_filters( 'fokus_header_logo_width', 100 ) );
	if ( ! defined( 'HEADER_IMAGE_HEIGHT' ) )
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'fokus_header_logo_height', 50 ) );

	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Add custom image sizes
	add_image_size( 'small-fokus-thumbnail', 150, 150, true );
	add_image_size( 'medium-fokus-thumbnail', 300, 300 );
	add_image_size( 'large-fokus-thumbnail', 440, 314, true );

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
<?php if ($pri_theme_co): ?>
	.hfeed .post .entry-title a:hover { color: #<?php echo $pri_theme_co; ?>; }
<?php endif; ?>
<?php if ($pri_theme_co): ?>
	.sidebar .widget-container a { color: #<?php echo $sec_theme_co; ?>; }
<?php endif; ?>
</style>
<?php
}
endif;

$fokus_colors = get_settings( FOKUS_THEMENAME . '_settings' );
if ($fokus_colors) {
	add_action('wp_head', 'fokus_custom_colors');
}