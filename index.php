<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width">

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
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
</head>
<body <?php body_class(); ?>>
	<div class="evil-wrapper">
		<div class="header">
			<?php $heading_tag = ( is_home() || is_front_page() || !is_singular() ) ? 'h1' : 'div'; ?>
			<<?php echo $heading_tag; ?> class="title">
				<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php if ( get_header_image() ) : ?>
						<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="<?php bloginfo( 'name' ); ?>" />
					<?php else: ?>
						<?php bloginfo( 'name' ); ?>
					<?php endif; ?>
				</a>
			</<?php echo $heading_tag; ?>>
			<div id="site-description"><?php bloginfo( 'description' ); ?></div>

			<?php wp_nav_menu( array( 'container_class' => 'primary-menu', 'theme_location' => 'primary' ) ); ?>
			<?php wp_nav_menu( array( 'container_class' => 'secondary-menu', 'theme_location' => 'secondary', 'fallback_cb' => FALSE ) ); ?>

			<?php get_search_form(); ?>
		</div><!-- .header -->

		<?php
		if (have_posts()) :
			$heading_tag = ($heading_tag == 'h1' ? 'h2' : 'h1');
			?><div class="hfeed"><?php
			while (have_posts()) :
				the_post();
				?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<<?php echo $heading_tag; ?> class="entry-title">
						<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
					</<?php echo $heading_tag; ?>>

					<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
						<div class="entry-summary">
							<?php the_excerpt(); ?>
						</div><!-- .entry-summary -->
					<?php else : ?>
						<div class="entry-content">
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
						</div><!-- .entry-content -->
					<?php endif; ?>
				</div>
				<?php
			endwhile;
			?></div><?php
		endif;
		?>

		<div id="footer">
		</div><!-- #footer -->
	</div><!-- .evil-wrapper -->

	<?php wp_footer(); ?>
</body>
</html>