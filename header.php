<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<title><?php
		global $page, $paged;

		wp_title( '|', true, 'right' );

		bloginfo( 'name' );

		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";

		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'fokus' ), max( $paged, $page ) );
	?></title>
	<?php wp_head(); ?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
</head>
<body <?php body_class(); ?>>
	<div class="evil-wrapper">
		<div class="header">
			<div class="site-info">
				<?php $heading_tag = ( is_home() || is_front_page() || !is_singular() ) ? 'h1' : 'div'; ?>
				<<?php echo $heading_tag; ?> class="title <?php if ( get_header_image() ) : echo('header-image'); else : echo('no-header-image'); endif ?>">
					<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<?php if ( get_header_image() ) : ?>
							<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="<?php bloginfo( 'name' ); ?>" />
						<?php else: ?>
							<?php bloginfo( 'name' ); ?>
						<?php endif; ?>
					</a>
				</<?php echo $heading_tag; ?>>
				<div id="site-description"><?php bloginfo( 'description' ); ?></div>
			</div><!-- .site-info -->
			<div class="site-menu">
				<?php wp_nav_menu( array( 'container_class' => 'primary-menu', 'menu_class' => 'primary-menu', 'theme_location' => 'primary', 'depth' => 1 ) ); ?>
				<?php
					$sec_menu = wp_nav_menu( array( 'container' => FALSE, 'theme_location' => 'secondary', 'depth' => 1, 'fallback_cb' => FALSE, 'echo' => FALSE ) );
					if ($sec_menu || is_active_sidebar( 'secondary-menu' )):
				?>
				<div class="secondary-menu">
					<?php echo $sec_menu; ?>
					<?php dynamic_sidebar( 'secondary-menu' ); ?>
				</div>
				<?php endif; ?>
			</div><!-- .menu -->
			<?php get_search_form(); ?>
		</div><!-- .header -->