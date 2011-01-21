			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'fokus' ); ?></p>
			</div><!-- #comments -->
<?php
		return;
	endif;
?>

<?php if ( have_comments() ) : ?>
			<h3 id="comments-title"><?php printf( _n( '1 comment', '%1$s comments', get_comments_number(), 'fokus' ), number_format_i18n( get_comments_number() ) ); ?></h3>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'fokus' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'fokus' ) ); ?></div>
			</div> <!-- .navigation -->
<?php endif; ?>

			<ul class="commentlist">
				<?php wp_list_comments( 'avatar_size=0' ); ?>
			</ul>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'fokus' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'fokus' ) ); ?></div>
			</div><!-- .navigation -->
<?php endif; ?>

<?php else :

	if ( ! comments_open() ) :
?>
	<p class="nocomments"><?php _e( 'Comments are closed.', 'fokus' ); ?></p>
<?php endif; ?>

<?php endif; ?>

			</div><!-- #comments -->

<?php
	$fields =  array(
		'author' => '<p class="comment-form-author">' .
		            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />' .
		            '<label for="author">' . __( 'Name' ) . '</label>' . ( $req ? '<span class="required">*</span>' : '' ) . '</p>',
		'email'  => '<p class="comment-form-email">' .
		            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />' .
		            '<label for="email">' . __( 'Email' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '</p>',
		'url'    => '<p class="comment-form-url">' .
		            '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />' .
		            '<label for="url">' . __( 'Website' ) . '</label></p>',
	);

	$ovverrides = array(
		'fields'              => $fields,
	  'comment_field'       => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
	  'comment_notes_after' => ''
	);

	comment_form( $ovverrides );
?>