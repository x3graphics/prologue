<?php

/**
* Add content type for orbit slider
*/
function create_orbit_slider() {
	register_post_type( 'orbit_slider',
		array(
			'labels' => array(
				'name' 				=> 'Slides',
				'singular_name' 	=> 'Slide',
				'all_items'			=> 'All Slides',
				'menu_name'			=> 'Sliders'
			),
		'public' 			=> true,
		'has_archive' 		=> false,
		'capability_type' 	=> 'page',
		'supports'      	=> array( 'title', 'editor', 'thumbnail'),
    'rewrite' => array('slug' => 'slide'),
		)
	);
}
add_action( 'init', 'create_orbit_slider' );

// Add the Optons Box
function orbit_slider_options_box() {
// add_meta_box( $id, $title, $callback, $page, $context, $priority, $callback_args );

        add_meta_box(
            'orbit_slider_options_box',
            'Slide Options',
            'orbit_slider_options_cb',
            'orbit_slider',
            'side',
            'default'

        );
}
add_action( 'add_meta_boxes', 'orbit_slider_options_box' );

function orbit_slider_options_cb( $post ) {

  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'orbit_slider_options_cb', 'orbit_slider_options_box_nonce' );

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
  $values = get_post_custom( $post->ID );
  $url = isset( $values['orbit_slider_link'] ) ? esc_attr( $values['orbit_slider_link'][0] ) : '';
  $target = isset( $values['orbit_slider_link_target'] ) ? esc_attr( $values['orbit_slider_link_target'][0] ) : '';
  $weight = isset( $values['orbit_slider_sort_weight'] ) ? $values['orbit_slider_sort_weight'][0] : '';

  echo '<p>';
  echo '<label for="orbit_slider_link">';
  echo 'Link Url';
  echo '</label> ';
  echo '<input type="text" id="orbit_slider_link" name="orbit_slider_link" value="' . esc_attr( $url ) . '" />';
  echo '</p>';

  echo '<p>';
  echo '<label for="orbit_slider_link_target">';
  echo 'Target';
  echo '</label> ';
  echo '<select name="orbit_slider_link_target" id="orbit_slider_link_target">';
    echo '<option value="_blank"' . selected( $target, '_blank' ) . '>_blank</option>';
    echo '<option value="_self"' . selected( $target, '_self' ) . '>_self</option>';
    echo '<option value="_parent"'.  selected( $target, '_parent' ) . '>_parent</option>';
    echo '<option value="_top"' . selected( $target, '_top' ) . '>_top</option>';
  echo '</select>';
  echo '</p>';

  echo '<p>';
  echo '<label for="orbit_slider_sort_weight">';
  echo 'Weight';
  echo '</label> ';
  echo '<input type="number" min="10" step="10" id="orbit_slider_sort_weight" name="orbit_slider_sort_weight" size="3" value="' . esc_attr( $weight ) . '" />';
  echo '</p>';

}

function orbit_slider_options_save_postdata( $post_id ) {

  /*
   * We need to verify this came from the our screen and with proper authorization,
   * because save_post can be triggered at other times.
   */

  // Check if our nonce is set.
  if ( ! isset( $_POST['orbit_slider_options_box_nonce'] ) )
    return $post_id;

  $nonce = $_POST['orbit_slider_options_box_nonce'];

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, 'orbit_slider_options_cb' ) )
      return $post_id;

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;

  // Check the user's permissions.
  if ( 'page' == $_POST['orbit_slider'] ) {

    if ( ! current_user_can( 'edit_page', $post_id ) )
        return $post_id;
  
  } else {

    if ( ! current_user_can( 'edit_post', $post_id ) )
        return $post_id;
  }

  /* OK, its safe for us to save the data now. */

  // Make sure your data is set before trying to save it
    if( isset( $_POST['orbit_slider_link'] ) )
        update_post_meta( $post_id, 'orbit_slider_link', esc_attr( $_POST['orbit_slider_link'] ) );
         
    if( isset( $_POST['orbit_slider_link_target'] ) )
        update_post_meta( $post_id, 'orbit_slider_link_target', esc_attr( $_POST['orbit_slider_link_target'] ) );

    if( isset( $_POST['orbit_slider_sort_weight'] ) )
        update_post_meta( $post_id, 'orbit_slider_sort_weight', esc_attr( $_POST['orbit_slider_sort_weight'] ) );
}
add_action( 'save_post', 'orbit_slider_options_save_postdata' );
