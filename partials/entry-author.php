<?php
/**
 * @package Make
 */

$author_key    = 'layout-' . make_get_current_view() . '-post-author';
$author_option = make_get_thememod_value( $author_key );
?>

<?php if ( 'none' !== $author_option ) : ?>
<div class="entry-author">
	<?php if ( 'avatar' === $author_option ) : ?>
	<div class="entry-author-avatar">
		<?php
		printf(
			'<a class="vcard" href="%1$s">%2$s</a>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			get_avatar( get_the_author_meta( 'ID' ) )
		);
		?>
	</div>
	<?php endif; ?>
	<div class="entry-author-byline">
		<?php
		// GCDI mod to check for nominated posts.
		if ( $item_author = get_post_meta( $post->ID, 'item_author', true ) ) {
			$by = 'Shared by';
		} else {
			$by = 'By';
		}

		printf(
			// GCDI mod to alter byline.
			'%s %s',
			$by,
			sprintf(
				'<a class="vcard fn" href="%1$s">%2$s</a>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				$item_author ? 'GCDI' : esc_html( get_the_author_meta( 'display_name' ) )
			)
		);
		?>
	</div>

	<?php
	// GCDI mod to add Pressforward "item_author" block.
	if ( 'before-content' === $GLOBALS['make_current_location'] && $item_author ) {
		printf( '<div class="entry-author-byline entry-syndicated-byline">written by %s</div>', esc_html( $item_author ) );
	}
	?>

	<?php if ( 'before-content' !== $GLOBALS['make_current_location'] && is_singular() && $author_bio = get_the_author_meta( 'description' ) ) : ?>
	<div class="entry-author-bio">
		<?php echo wpautop( Make()->sanitize()->sanitize_text( $author_bio ) ); ?>
	</div>
	<?php endif; ?>
</div>
<?php endif; ?>