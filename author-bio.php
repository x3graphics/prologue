<?php
/**
 * The template for displaying Author bios.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>
<div class="author-info panel">
<div class="row">
	<div class="author-avatar small-12 large-2 columns">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), 90 ); ?>
	</div><!-- .author-avatar -->
	<div class="author-description small-12 large-10 columns">
		<h2 class="author-title"><?php printf( __( 'About %s', 'prologue' ), get_the_author() ); ?></h2>
		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
			<!-- <a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'prologue' ), get_the_author() ); ?>
			</a> -->
		</p>
	</div><!-- .author-description -->
</div><!-- .author-info -->
</div>