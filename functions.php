<?php
/**
 * Prologue functions and definitions
 *
 * @package Prologue
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'Prologue_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function Prologue_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Prologue, use a find and replace
	 * to change 'Prologue' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'prologue', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'Prologue' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	add_theme_support( 'post-thumbnails' ); 

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'prologue_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // Prologue_setup
add_action( 'after_setup_theme', 'Prologue_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function Prologue_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'Prologue' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'class'			=> 'no-bullet',
		'before_widget' => '<aside id="%1$s" class="widget panel %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'prologue_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function Prologue_scripts() {
	wp_enqueue_style( 'prologue-normalize', get_template_directory_uri() . '/css/normalize.css' );

	wp_enqueue_style( 'prologue-fontawesome', get_template_directory_uri() . '/css/font-awesome.css' );

	wp_enqueue_style( 'prologue-foundation', get_template_directory_uri() . '/css/foundation.css', array('prologue-normalize')  );

	wp_enqueue_style( 'prologue-style', get_stylesheet_uri(), array('prologue-foundation') );

	//wp_enqueue_script( 'Prologue-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'prologue-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'prologue-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

	wp_enqueue_script( 'prologue-foundation-js', get_template_directory_uri() . '/js/foundation.min.js', array('jquery') );

	wp_enqueue_script( 'prologue-modernizr', get_template_directory_uri() . '/js/modernizr-2.6.2.min.js' );
}
add_action( 'wp_enqueue_scripts', 'prologue_scripts' );


// Customizer
function Prologue_customizer_css() {
    ?>
    <style type="text/css">
        a { color: <?php echo get_theme_mod( 'Prologue_link_color' ); ?>; }
        a:hover, a:active{ color: <?php echo get_theme_mod( 'Prologue_link_color_hover' ); ?>;}
        .row{max-width: <?php echo get_theme_mod( 'Prologue_grid_max_width' ); ?> }
    </style>
    <?php
}
add_action( 'wp_head', 'Prologue_customizer_css' );


//Custom Comment Form Fields

add_filter('comment_form_default_fields', 'Prologue_comment_fields');

function Prologue_comment_fields($fields) {
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
    $fields =  array(

  'author' =>
    '<div class="comment-form-author row collapse"><label for="author">' . __( 'Name', 'domainreference' ) . 
    ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
    '<div class="small-1 columns"><span class="prefix"><i class="icon fa fa-user"></i></span></div>' . 
    '<div class="small-11 columns"><input id="author" name="author" placeholder="Name" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>' . 
    '</div>',

  'email' =>
    '<div class="comment-form-email row collapse"><label for="email">' . __( 'Email', 'domainreference' ) .
    ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
    '<div class="small-1 columns"><span class="prefix"><i class="icon fa fa-envelope"></i></span></div>' . 
    '<div class="small-11 columns"><input id="email" name="email" placeholder="Email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>' .
    '</div>',

  'url' =>
    '<div class="comment-form-url row collapse"><label for="url">' . __( 'Website', 'domainreference' ) . '</label>' .
    '<div class="small-1 columns"><span class="prefix"><i class="icon fa fa-globe"></i></span></div>' . 
    '<div class="small-11 columns"><input id="url" name="url" type="text"placeholder="http://" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>' .
    '</div>',
);
    return $fields;
}


/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Orbit Slider.
 */
require get_template_directory() . '/inc/orbit_slider.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Foundation Menu Walker.
 */
require get_template_directory() . '/inc/wp_foundation_menu_walker.php';

/**
 * Load Shortcodes.
 */
require get_template_directory() . '/inc/shortcodes.php';
