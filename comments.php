<?php
/**
 * The template for displaying comments.
 *
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Forest
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

  <?php if ( have_comments() ) : ?>
		<?php
		global $comments_by_type;
		$comments_by_type = separate_comments( $comments );
		?>

		<?php if ( ! empty( $comments_by_type['comment'] ) ) : // if there are normal comments ?>
	<h2 class="comments-title"><?php comments_number( 'No Comments', 'One Comment', '% Comments' ); ?></h2>

	<ul class="comment-list">
			<?php wp_list_comments( 'type=comment&callback=stag_comments' ); ?>
	</ul>
	<?php endif; ?>

		<?php if ( ! empty( $comments_by_type['pings'] ) ) : // if there are pings ?>
	<h2 class="pings-title"><?php comments_number( 'No Comments', 'One Comment', '% Comments' ); ?></h2>
	<ul class="ping-list">
			<?php wp_list_comments( 'type=pings&callback=stag_list_pings' ); ?>
	</ul>
			<?php
	endif; // end pings


		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :

			?>
	<nav class="navigation comment-navigation" role="navigation">
		<h1 class="screen-reader-text section-heading"><?php esc_html_e( 'Comment navigation', 'forest' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'forest' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'forest' ) ); ?></div>
	</nav><!-- .comment-navigation -->
	<?php endif; // Check for comment navigation ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
	<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'forest' ); ?></p>
	<?php endif; ?>

  <?php endif; // have_comments() ?>

	<?php
	comment_form(
		array(
			'comment_notes_after'  => false,
			'comment_notes_before' => false,
			'logged_in_as'         => false,
			'title_reply'          => __( 'Submit a Comment', 'forest' ),
			'label_submit'         => __( 'Submit Comment', 'forest' ),
		)
	);
	?>

</div><!-- #comments -->
