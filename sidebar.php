<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Prologue
 */
?>

<?php if(is_active_sidebar('sidebar-1')) { ?>
	<div id="secondary" class="widget-area small-12 large-4 columns" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
		<?php if ( dynamic_sidebar( 'sidebar-1' ) ) : ?>

		<?php endif; // end sidebar widget area ?>
	</div><!-- #secondary -->

	<?php } ?>
