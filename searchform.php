<?php
/**
 * The template for displaying search forms in Prologue
 *
 * @package Prologue
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="row collapse">
		<div class="small-8 columns">
			<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'Prologue' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
		</div>
		<div class="small-4 columns">
			<input type="submit" class="search-submit button prefix" value="<?php echo esc_attr_x( 'Search', 'submit button', 'Prologue' ); ?>">
		</div>
	</div>
</form>
