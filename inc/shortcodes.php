<?php
/**
* Just some short codes
*/

// Add Row Shortcode
function row_shortcode( $atts , $content = null ) {

	return '<div class="row">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'row', 'row_shortcode' );

// Add Columns Shortcode
function columns_shortcode( $atts , $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'small' => '',
			'medium' => '',
			'large' => '',
		), $atts )
	);

return '<div class="small-' . $small . ' medium-' . $medium . ' large-' . $large . ' columns">' . $content . '</div>';
}
add_shortcode( 'columns', 'columns_shortcode' );