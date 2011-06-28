		<?php get_header();
		if ( is_front_page() && is_active_sidebar( 'front-top' ) ): ?>
		<div class="front-top">
			<?php dynamic_sidebar( 'front-top' ); ?>
		</div>
		<?php endif; ?>
		<?php if ( is_front_page() && is_active_sidebar( 'front-main' ) ): ?>
			<div class="front-main">
				<?php dynamic_sidebar( 'front-main' ); ?>
			</div>
		<?php
		else:
			if ( have_posts() ) :
				$heading_tag = ($heading_tag == 'h1' ? 'h2' : 'h1');
				?><div class="hfeed" role="main">
					<?php if ( is_archive() ): ?>
						<div class="cat-info">
							<?php if ( function_exists( 'fokus_taxonomy_image' ) ):
								fokus_taxonomy_image();
							endif ?>
							<h1 class="cat-title"><?php single_cat_title(); ?></h1>
							<?php echo category_description(); ?>
						</div>
					<?php endif; ?>
						<div class="posts"><?php
				while ( have_posts() ) :
					the_post();
					?>
					<div role="article" id="post-<?php the_ID(); ?>" <?php post_class( is_single() ? 'single' : '' ); ?>>
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

							<div class="nav">
								<?php if (get_previous_posts_link()): ?>
								<div class="prev"><?php previous_posts_link('Previous entries'); ?></div>
								<?php endif; ?>
								<?php if (get_next_posts_link()): ?>
								<div class="next"><?php next_posts_link('Next entries'); ?></div>
								<?php endif; ?>
							</div><!-- .nav -->

						<?php else : ?>
							<div class="entry-summary">
								<?php the_excerpt(); ?>
							</div><!-- .entry-summary -->
						<?php endif; ?>
					</div>

					<?php
				endwhile;
				?></div></div><!-- .hfeed .posts --><?php
			endif;
		endif;
		?>

		<?php if ( is_front_page() && is_active_sidebar( 'front-middle' ) ): ?>
			<div class="middle" role="complementary">
				<?php dynamic_sidebar( 'front-middle' ); ?>
			</div>
		<?php elseif ( is_active_sidebar( 'middle' ) ): ?>
			<div class="middle" role="complementary">
				<?php dynamic_sidebar( 'middle' ); ?>
			</div>
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'sidebar' ) ): ?>
			<div class="sidebar" role="complementary">
				<?php dynamic_sidebar( 'sidebar' ); ?>
			</div>
		<?php endif;
		get_footer(); ?>