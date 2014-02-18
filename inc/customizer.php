<?php
/**
 * Prologue Theme Customizer
 *
 * @package Prologue
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function Prologue_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	$wp_customize->add_setting(
	    'Prologue_link_color',
	    array(
	        'default'     => '#2ba6cb',
	        'transport'   => 'postMessage'
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'link_color',
	        array(
	            'label'      => __( 'Link Color', 'Prologue' ),
	            'section'    => 'colors',
	            'settings'   => 'Prologue_link_color'
	        )
	    )
	);
	
	$wp_customize->add_setting(
	    'Prologue_link_color_hover',
	    array(
	        'default'     => '#2795b6',
	        'transport'   => 'postMessage'
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'link_color_hover',
	        array(
	            'label'      => __( 'Hover Link Color', 'Prologue' ),
	            'section'    => 'colors',
	            'settings'   => 'Prologue_link_color_hover'
	        )
	    )
	);

	$wp_customize->add_section(
	    'Prologue_layout',
	    array(
	        'title'     => 'Layout',
	        'priority'  => 200
	    )
	);

	$wp_customize->add_setting(
	    'Prologue_grid_max_width',
	    array(
	        'default'     => '62.5em',
	        'transport'   => 'postMessage'
	    )
	);

	$wp_customize->add_control(
	    new WP_Customize_Control(
	        $wp_customize,
	        'grid_max_width',
	        array(
	            'label'      => __( 'Max Width', 'Prologue' ),
	            'section'    => 'Prologue_layout',
	            'settings'   => 'Prologue_grid_max_width'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'sticky_nav'
	);

	$wp_customize->add_control(
	        'sticky_nav',
	        array(
	        	'type'		=> 'checkbox',
	            'label'      => __( 'Sticky Navigation', 'Prologue' ),
	            'section'    => 'nav'
	        )
	    
	);

	//Orbit Settings
	$wp_customize->add_section(
		'Prologue_orbit',
		array(
			'title' => 'Slider Settings',
			'priority' => 200
			)
	);
	$wp_customize->add_setting(
	    'orbit_animation_type',
	    	array(
	    		'default'        => 'fade')
	);
	$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize, 
		'orbit_animation_type',
		array(
	        'settings' 	=> 'orbit_animation_type',
	        'label'     => __( 'Animation Type', 'Prologue' ),
	        'section' 	=> 'Prologue_orbit',
	        'type'    	=> 'select',
	        'choices'   => array(
	            'slide' => 'Slide',
	            'fade' 	=> 'Fade'
	        )
	    )    
    ));
	$wp_customize->add_setting(
	    'orbit_speed',
	    	array('default' => 10000 )
	);
	$wp_customize->add_control(
	    new WP_Customize_Control(
	        $wp_customize,
	        'orbit_speed',
	        array(
	            'label'      => __( 'Delay', 'Prologue' ),
	            'section'    => 'Prologue_orbit',
	            'settings'   => 'orbit_speed'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'orbit_animation_speed',
	    	array('default' => 500 )
	);
	$wp_customize->add_control(
	    new WP_Customize_Control(
	        $wp_customize,
	        'orbit_animation_speed',
	        array(
	            'label'      => __( 'Transition Speed', 'Prologue' ),
	            'section'    => 'Prologue_orbit',
	            'settings'   => 'orbit_animation_speed'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'orbit_stack_on_small',
	    	array('default' => true )
	);
	$wp_customize->add_control(
	        'orbit_stack_on_small',
	        array(
	        	'type'		=> 'checkbox',
	            'label'      => __( 'Stack on Small', 'Prologue' ),
	            'section'    => 'Prologue_orbit'
	        )
	    
	);
	$wp_customize->add_setting(
	    'orbit_navigation_arrows',
	    	array('default' => true )
	);
	$wp_customize->add_control(
	        'orbit_navigation_arrows',
	        array(
	        	'type'		=> 'checkbox',
	            'label'      => __( 'Show Navigation Arrows', 'Prologue' ),
	            'section'    => 'Prologue_orbit'
	        )
	    
	);
	$wp_customize->add_setting(
	    'orbit_show_slide_number'
	);
	$wp_customize->add_control(
	        'orbit_show_slide_number',
	        array(
	        	'type'		=> 'checkbox',
	            'label'      => __( 'Show Slide Numbers', 'Prologue' ),
	            'section'    => 'Prologue_orbit'
	        )
	    
	);
	$wp_customize->add_setting(
	    'orbit_show_bullets',
	    	array('default' => true )
	);
	$wp_customize->add_control(
	        'orbit_show_bullets',
	        array(
	        	'type'		=> 'checkbox',
	            'label'      => __( 'Show Bullets', 'Prologue' ),
	            'section'    => 'Prologue_orbit'
	        )
	    
	);
	$wp_customize->add_setting(
	    'orbit_show_timer'
	);
	$wp_customize->add_control(
	        'orbit_show_timer',
	        array(
	        	'type'		=> 'checkbox',
	            'label'      => __( 'Show Timer', 'Prologue' ),
	            'section'    => 'Prologue_orbit'
	        )
	    
	);
}

add_action( 'customize_register', 'Prologue_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function Prologue_customize_preview_js() {
	wp_enqueue_script( 'Prologue_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'Prologue_customize_preview_js' );