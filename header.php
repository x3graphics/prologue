<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Prologue
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<div class="contain-to-grid <?php if( get_theme_mod( 'sticky_nav' ) != '') { echo 'sticky';} ?>">
		<nav class="top-bar" data-topbar>
			 <ul class="title-area">
			   <!-- Title Area -->
			   <li class="name">
			     <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'description' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			   </li>
			   <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
			   <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
			 </ul>
			 <section class="top-bar-section">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'walker' => new Foundation_Nav_Walker() ) ); ?>
			</section>
		</nav>
	</div>


	<?php //Orbit Slider

	 if(is_home()){

		$args = array( 
			'post_type' => 'orbit_slider',
			'meta_key' => 'orbit_slider_sort_weight',
            'orderby' => 'meta_value_num',
            'order'=>'ASC'
			 );

		// The Query
		$the_query = new WP_Query( $args );

		// The Loop
		if ( $the_query->have_posts() ) {
		        echo '<ul class="orbit-slider" data-orbit data-options="animation:'. get_theme_mod( 'orbit_animation_type' ) .'; timer_speed:'. get_theme_mod( 'orbit_speed' ) .'; animation_speed:'. get_theme_mod( 'orbit_animation_speed' ) .'; navigation_arrows:'. ((get_theme_mod( 'orbit_navigation_arrows' ) == TRUE) ? 'true' : 'false') .'; bullets:'. ((get_theme_mod( 'orbit_show_bullets' ) == TRUE) ? 'true' : 'false') .'; slide_number:'. ((get_theme_mod( 'orbit_show_slide_number' ) == TRUE) ? 'true' : 'false') .'; stack_on_small:'. ((get_theme_mod( 'orbit_stack_on_small' ) == TRUE) ? 'true' : 'false') .'; resume_on_mouseout: true">';
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				echo '<li>';
				if ( has_post_thumbnail()) {
				   $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');

					if (get_post_meta($post->ID, 'orbit_slider_link', true) != ""){

					   echo '<a href="' . get_post_meta($post->ID, 'orbit_slider_link', true) . '" target="' . get_post_meta($post->ID, 'orbit_slider_link_target', true) . '" title="' . the_title_attribute('echo=0') . '" >';
					   the_post_thumbnail('full');
					   echo '</a>';
					}else{
						the_post_thumbnail('full');
					}
				 }
				echo '<div class="orbit-caption">' . get_the_title() . '</div>';
				echo '</li>';
			}
		        echo '</ul>';
		} else {
			// no posts found
		}
		/* Restore original Post Data */
		wp_reset_postdata();
	}
	?>

	<div id="content" class="site-content row">