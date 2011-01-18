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
			<?php get_search_form(); ?>
		</div><!-- .header -->
		<div class="menu">
			<?php wp_nav_menu( array( 'container_class' => 'primary-menu', 'theme_location' => 'primary' ) ); ?>
			<?php wp_nav_menu( array( 'container_class' => 'secondary-menu', 'theme_location' => 'secondary', 'fallback_cb' => FALSE ) ); ?>
		</div><!-- .menu -->

		<?php
		if ( have_posts() ) :
			if ( is_front_page() && dynamic_sidebar( 'Front-main' ) ):
				// The sidebar was printed above
			else:
				$heading_tag = ($heading_tag == 'h1' ? 'h2' : 'h1');
				?><div class="hfeed"><?php
				while ( have_posts() ) :
					the_post();
					?>
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<<?php echo $heading_tag; ?> class="entry-title">
							<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
						</<?php echo $heading_tag; ?>>

						<div class="entry-meta">
							<span class="author vcard">
								<?php
									printf( __( 'By: %1$s', 'fokus' ),
										sprintf( '<a class="url fn n" href="%1$s" >%2$s</a>',
											get_author_posts_url( get_the_author_meta( 'ID' ) ),
											get_the_author()
										)
									);
								?>
							</span>
							<span class="published">
								<span class="value-title" title="<?php esc_attr_e(get_the_date('c')); ?>">
									<?php echo get_the_date(); ?> <?php the_time(); ?>
								</span>
							</span>
							<?php edit_post_link( __('Edit this'), '<span class="edit">', '</span>' ); ?>
						</div><!-- .entry-meta -->

						<?php if ( is_singular() ) : // Only display excerpts for archives and search. ?>
							<div class="entry-content">
								<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'fokus' ) ); ?>
								<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'fokus' ), 'after' => '</div>' ) ); ?>
							</div><!-- .entry-content -->
						<?php else : ?>
							<div class="entry-summary">
								<?php the_excerpt(); ?>
							</div><!-- .entry-summary -->
						<?php endif; ?>
					</div>
					<?php
				endwhile;
				?></div><?php
			endif;
		endif;
		dynamic_sidebar( 'Sidebar' );
		?>

		<div class="footer"><?php dynamic_sidebar( 'Footer' ); ?></div><!-- .footer -->
	</div><!-- .evil-wrapper -->

	<?php wp_footer(); ?>
</body>
</html>