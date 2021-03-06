<?php
/**
 * Leading Minds functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Leading_Minds
 */

if ( ! function_exists( 'leading_minds_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function leading_minds_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Leading Minds, use a find and replace
	 * to change 'leading_minds' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'leading_minds', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
    // add_image_size( 'advanced-content-module-header-image', 150, 99999, false );
    add_image_size( 'advanced-content-module-footer-image', 130, 99999, false );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'desktop-nav' => esc_html__( 'Primary', 'leading_minds' ),
        'mobile-nav'  => esc_html__( 'Mobile', 'leading_minds' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	// add_theme_support( 'custom-background', apply_filters( 'leading_minds_custom_background_args', array(
	// 	'default-color' => 'ffffff',
	// 	'default-image' => '',
	// ) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'leading_minds_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function leading_minds_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'leading_minds_content_width', 640 );
}
add_action( 'after_setup_theme', 'leading_minds_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function leading_minds_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'leading_minds' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'leading_minds' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'leading_minds_widgets_init' );

/**
 * Register scripts for later use.
 */
function leading_minds_register_scripts()  {
    if (!is_admin()) {
        wp_deregister_script('jquery');
        // Load the copy of jQuery that comes with WordPress
        // The last parameter set to TRUE states that it should be loaded in the footer.
        wp_register_script('jquery', '/wp-includes/js/jquery/jquery.js', FALSE, FALSE, TRUE);
    }
}
add_action('init', 'leading_minds_register_scripts');

/**
 * Enqueue scripts and styles.
 */
function leading_minds_scripts() {
    wp_enqueue_style( 'leading-minds-style', get_stylesheet_uri() );

    wp_enqueue_script( 'leading-minds-mobile-nav', get_template_directory_uri() . '/js/min/mobile-menu-min.js', array('jquery'), NULL, true );

    // wp_enqueue_script( 'leading-minds-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

    wp_enqueue_script( 'leading-minds-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

    wp_enqueue_script( 'flickity-library', get_template_directory_uri() . '/js/min/flickity-min.js', array('jquery'), NULL, true );

    wp_enqueue_script( 'testimonial-carousel', get_template_directory_uri() . '/js/min/testimonial-carousel-min.js', array('flickity-library'), NULL, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'leading_minds_scripts' );

/**
 * Custom ACF Options
 */
if( function_exists('acf_add_options_page') ) {
	// Company Information Section
    acf_add_options_page(array(
        'page_title'    => 'Contact Information',
        'menu_title'    => 'Contact Information',
        'menu_slug'     => 'contact-info',
        'icon_url'   	=> 'dashicons-phone',
        'capability'    => 'edit_posts',
        'redirect'      => true
    ));

    acf_add_options_page(array(
            'page_title'    => 'Associates Settings',
            'menu_title'    => 'Associates Settings',
            'menu_slug'     => 'associates-settings',
            'capability'    => 'edit_posts',
            'redirect'      => false,
            'position'      => '6.2',
            'icon_url'     => 'dashicons-universal-access-alt',
        ));

    // Testimonial Section
    // acf_add_options_page(array(
    //     'page_title'    => 'Testimonial Settings',
    //     'menu_title'    => 'Testimonials',
    //     'menu_slug'     => 'testimonials',
    //     'icon_url'      => 'dashicons-testimonial',
    //     'capability'    => 'edit_posts',
    //     'redirect'      => true,
    //     'position'      => 20
    // ));

    // Associates Section
    // acf_add_options_page(array(
    //     'page_title'    => 'Associates Settings',
    //     'menu_title'    => 'Associates',
    //     'menu_slug'     => 'associates',
    //     'icon_url'      => 'dashicons-id-alt',
    //     'capability'    => 'edit_posts',
    //     'redirect'      => true,
    //     'position'      => 21
    // ));

//     	acf_add_options_sub_page(array(
//     	    'page_title'    => 'One Bedroom Floorplans Section',
//     	    'menu_title'    => 'One Bedroom',
//     	    'menu_slug'     => 'one_bedroom_floorplan',
//     	    'parent_slug'   => 'floorplans'
//     	));

//     	acf_add_options_sub_page(array(
//     	    'page_title'    => 'Two Bedroom Floorplans Section',
//     	    'menu_title'    => 'Two Bedroom',
//     	    'menu_slug'     => 'two_bedroom_floorplan',
//     	    'parent_slug'   => 'floorplans'
//     	));

//     	acf_add_options_sub_page(array(
//     	    'page_title'    => 'Three Bedroom Floorplans Section',
//     	    'menu_title'    => 'Three Bedroom',
//     	    'menu_slug'     => 'three_bedroom_floorplan',
//     	    'parent_slug'   => 'floorplans'
//     	));
}

// Register Custom Post Type
function leading_minds_create_custom_post_type() {

    $labels = array(
        'name'                  => 'Testimonials',
        'singular_name'         => 'Testimonial',
        'menu_name'             => 'Testimonials',
        'name_admin_bar'        => 'Testimonials',
        'archives'              => 'Testimonials Archives',
        'attributes'            => 'Testimonials Attributes',
        'parent_item_colon'     => 'Parent Item: Testimonials',
        'all_items'             => 'All Testimonials',
        'add_new_item'          => 'Add New Testimonial',
        'add_new'               => 'Add New Testimonial',
        'new_item'              => 'New Testimonial',
        'edit_item'             => 'Edit Testimonial',
        'update_item'           => 'Update Testimonial',
        'view_item'             => 'View Testimonial',
        'view_items'            => 'View Testimonials',
        'search_items'          => 'Search Testimonials',
        'not_found'             => 'Not found',
        'not_found_in_trash'    => 'Not found in Trash',
        'featured_image'        => 'Featured Image',
        'set_featured_image'    => 'Set featured image',
        'remove_featured_image' => 'Remove featured image',
        'use_featured_image'    => 'Use as featured image',
        'insert_into_item'      => 'Insert into item',
        'uploaded_to_this_item' => 'Uploaded to this item',
        'items_list'            => 'Items list',
        'items_list_navigation' => 'Items list navigation',
        'filter_items_list'     => 'Filter items list',
    );
    $rewrite = array(
        'slug'                  => 'testimonial',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => 'Testimonial',
        'description'           => 'Testimonial Section',
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'revisions' ),
        'taxonomies'            => array( 'testimonial' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-testimonial',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'query_var'             => 'testimonial',
        'rewrite'               => $rewrite,
        'capability_type'       => 'page',
        'show_in_rest'          => true,
    );
    register_post_type( 'testimonials', $args );

}
add_action( 'init', 'leading_minds_create_custom_post_type', 0 );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
 * Displays homepage header.
 */
require get_template_directory() . '/inc/main-header.php';

/**
 * Displays contact page content.
 */
require get_template_directory() . '/inc/contact-page-content.php';

/**
 * Displays flexible content.
 */
require get_template_directory() . '/inc/flexible-content-module.php';

/**
 * Section Modules.
 */
require get_template_directory() . '/inc/acf-color-content-section.php';
require get_template_directory() . '/inc/acf-simple-content-section.php';
require get_template_directory() . '/inc/acf-advanced-content-section.php';
require get_template_directory() . '/inc/acf-mid-page-navigation-section.php';
require get_template_directory() . '/inc/acf-testimonial-section.php';
require get_template_directory() . '/inc/acf-associates-section.php';



/**
 * Blog page functions.
 */

// function custom_excerpt_length( $length ) {
//  return 20;
// }
// add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function leading_minds_pagination($pages = '', $range = 4) {
     $showitems = ($range * 2)+1;

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '') {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages) {
             $pages = 1;
         }
     }

     if(1 != $pages) {
         echo "<div class='pagination'><span class='intro'>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";

         for ($i=1; $i <= $pages; $i++) {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."'class='inactive'>".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}

function leading_minds_excerpt_length($length) {
    return 50;
}
add_filter('excerpt_length', 'leading_minds_excerpt_length');

/* Add a link  to the end of our excerpt contained in a div for styling purposes and to break to a new line on the page.*/

function leading_minds_excerpt_more($more) {
    global $post;
    return '<span class="view-full-post"><a href="'. esc_url( get_permalink($post->ID) ) . '" class="view-full-post-btn">Read More ></a></span>';
}
add_filter('excerpt_more', 'leading_minds_excerpt_more');
