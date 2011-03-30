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
			<div class="site-info">
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
			</div><!-- .site-info -->
			<div class="site-menu">
				<?php wp_nav_menu( array( 'container_class' => 'primary-menu', 'theme_location' => 'primary', 'depth' => 1 ) ); ?>
				<?php
					$sec_menu = wp_nav_menu( array( 'container' => FALSE, 'theme_location' => 'secondary', 'depth' => 1, 'fallback_cb' => FALSE, 'echo' => FALSE ) );
					if ($sec_menu || dynamic_sidebar( 'secondary-menu' )):
				?>
				<div class="secondary-menu">
					<?php echo $sec_menu; ?>
					<?php dynamic_sidebar( 'secondary-menu' ); ?>
				</div>
				<?php endif; ?>
			</div><!-- .menu -->
			<?php get_search_form(); ?>
		</div><!-- .header -->

		<?php
		if ( have_posts() ) :
			if ( is_front_page() && is_active_sidebar( 'front-main' ) ):
		?>
			<div class="front-main">
				<?php dynamic_sidebar( 'front-main' ); ?>
			</div>
		<?php
			else:
				$heading_tag = ($heading_tag == 'h1' ? 'h2' : 'h1');
				?><div class="hfeed">
					<?php if ( is_archive() ): ?>
						<div class="cat-info">
							<?php if ( function_exists( 'fokus_taxonomy_image' ) ):
								fokus_taxonomy_image();
							endif ?>
							<h1 class="cat-title"><?php single_cat_title(); ?></h1>
							<?php echo category_description(); ?>
						</div>
					<?php endif; ?>
					<?php if ( is_single() ) : ?>
						<?php fokus_get_related( get_the_ID() ); ?>
					<?php endif; ?>
						<div class="posts"><?php
				while ( have_posts() ) :
					the_post();
					?>
					<div id="post-<?php the_ID(); ?>" <?php post_class( is_single() ? 'single' : '' ); ?>>
						<?php
							// Post thumbnails
							if ( has_post_thumbnail() ):
								if ( is_single() ):
									the_post_thumbnail( 'large-fokus-thumbnail' );
								else:
									echo '<a href="' . get_permalink() . '" rel="bookmark">';
									the_post_thumbnail( 'small-fokus-thumbnail' );
									echo '</a>';
								endif;
							endif;
						?>
						<<?php echo $heading_tag; ?> class="entry-title">
							<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
						</<?php echo $heading_tag; ?>>

						<div class="entry-meta">
							<span class="author vcard">
								<?php
									printf( __( 'Text %1$s', 'fokus' ),
										sprintf( 'Published <a class="url fn n" href="%1$s" >%2$s</a>',
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
							<?php edit_post_link( __( 'Edit this' ), '<span class="edit">', '</span>' ); ?>
						</div><!-- .entry-meta -->

						<?php if ( is_singular() ) : // Only display excerpts for archives and search. ?>
							<div class="entry-content">
								<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'fokus' ) ); ?>
								<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'fokus' ), 'after' => '</div>' ) ); ?>
								<?php comments_template(); ?>
							</div><!-- .entry-content -->
						<?php else : ?>
							<div class="entry-summary">
								<?php the_excerpt(); ?>
							</div><!-- .entry-summary -->

							<div class="nav">
								<?php if (get_previous_posts_link()): ?>
								<div class="prev"><?php previous_posts_link('Previous entries'); ?></div>
								<?php endif; ?>
								<?php if (get_next_posts_link()): ?>
								<div class="next"><?php next_posts_link('Next entries'); ?></div>
								<?php endif; ?>
							</div><!-- .nav -->

						<?php endif; ?>
					</div>

					<?php
				endwhile;
				?></div></div><!-- .hfeed .posts --><?php
			endif;
		endif;
		?>

		<?php if ( is_active_sidebar( 'sidebar' ) ): ?>
		<div class="sidebar">
			<?php dynamic_sidebar( 'sidebar' ); ?>
		</div>
		<?php endif; ?>

		<div class="footer"><?php dynamic_sidebar( 'footer' ); ?></div><!-- .footer -->
	</div><!-- .evil-wrapper -->

	<?php wp_footer(); ?>
</body>
</html>