<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title( '|', true, 'right' ) . bloginfo( 'name' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="wrapper">
		<div id="header">
			<div class="title">
				<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php if ( get_header_image() ) : ?>
						<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="<?php bloginfo( 'name' ); ?>" />
					<?php else: ?>
						<?php bloginfo( 'name' ); ?>
					<?php endif; ?>
				</a>
			</div>
			<?php wp_nav_menu( array( 'container_class' => 'primary-menu', 'theme_location' => 'primary' ) ); ?>
			<?php wp_nav_menu( array( 'container_class' => 'secondary-menu', 'theme_location' => 'secondary', 'fallback_cb' => FALSE ) ); ?>
			<?php get_search_form(); ?>
		</div><!-- #header -->

		<div id="content">
<?php
	if (have_posts()) :
		while (have_posts()) :
			the_post();
			the_content();
		endwhile;
	endif;
?>
		</div><!-- #content -->

		<div id="footer">
		</div><!-- #footer -->
	</div><!-- #wrapper -->
	<?php wp_footer(); ?>
</body>
</html>