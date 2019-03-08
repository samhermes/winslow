<?php
/**
 * Winslow functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Winslow
 */

if ( ! function_exists( 'winslow_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function winslow_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'winslow', get_template_directory() . '/languages' );

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

	/*
	 * Add custom image size for posts on homepage and archive pages.
	 */
	add_image_size( 'winslow-post-3x2', 1500, 1000, true );
	add_image_size( 'winslow-post-3x2-small', 750, 500, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'winslow' ),
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

	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name' => __( 'Small', 'winslow' ),
				'shortName' => __( 'S', 'winslow' ),
				'size' => 18,
				'slug' => 'small',
			),
			array(
				'name' => __( 'Normal', 'winslow' ),
				'shortName' => __( 'M', 'winslow' ),
				'size' => 20,
				'slug' => 'normal',
			),
			array(
				'name' => __( 'Large', 'winslow' ),
				'shortName' => __( 'L', 'winslow' ),
				'size' => 30,
				'slug' => 'large',
			),
			array(
				'name' => __( 'Huge', 'winslow' ),
				'shortName' => __( 'XL', 'winslow' ),
				'size' => 40,
				'slug' => 'huge',
			),
		)
	);
}
endif;
add_action( 'after_setup_theme', 'winslow_setup' );

/*
 * Register sidebar for the site footer.
 */
function winslow_footer_widget_area() {
	register_sidebar( array(
		'name' => __( 'Footer', 'winslow' ),
		'id' => 'footer',
		'description' => __( 'Widgets in this area will be shown in the site footer.', 'winslow' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'winslow_footer_widget_area' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function winslow_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'winslow_content_width', 640 );
}
add_action( 'after_setup_theme', 'winslow_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function winslow_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'winslow-work-sans', 'https://fonts.googleapis.com/css?family=Libre+Franklin:400,400i,600,600i|Montserrat' );
	wp_enqueue_style( 'winslow-style', get_stylesheet_uri(), array(), $theme_version );

	wp_enqueue_script( 'winslow-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'winslow-stickyfill' ), '20160908', true );

	wp_localize_script( 'winslow-scripts', 'winslowL10n', array(
		'menu'  => esc_html__( 'Menu', 'winslow' ),
		'close' => esc_html__( 'Close', 'winslow' ),
		'comments_show' => esc_html__( 'Show Comments', 'winslow' ),
		'comments_hide' => esc_html__( 'Hide Comments', 'winslow' ),
	) );

	wp_enqueue_script( 'winslow-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'winslow-stickyfill', get_template_directory_uri() . '/js/stickyfill.js', array( 'jquery' ), '1.1.4', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'winslow_scripts' );

/**
 * Add editor styles.
 */
function winslow_editor_styles() {
    $font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Libre+Franklin:400,400i,600,600i' );
    add_editor_style( $font_url );
    add_editor_style();
}
add_action( 'after_setup_theme', 'winslow_editor_styles' );

/**
 * Enqueue block editor styles for Gutenberg.
 */
function winslow_block_editor_styles() {
	$this_theme = wp_get_theme();
	$this_version = $this_theme->get( 'Version' );

	wp_enqueue_style( 'winslow-block-editor-styles', get_theme_file_uri( '/block-editor-style.css' ), false, $this_version );

	// Add Google fonts to editor
	wp_enqueue_style( 'winslow-editor-fonts', 'https://fonts.googleapis.com/css?family=Libre+Franklin:400,400i,600,600i' );
}
add_action( 'enqueue_block_editor_assets', 'winslow_block_editor_styles' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function winslow_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'winslow_pingback_header' );

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
 * Filter the except length.
 */
function winslow_custom_excerpt_length( $length ) {
	if ( is_admin() ) {
		return $length;
	}
	return 35;
}
add_filter( 'excerpt_length', 'winslow_custom_excerpt_length', 999 );

/**
 * Filter the "read more" excerpt string to link to the post.
 */
function winslow_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}
	return sprintf( '... <a class="read-more" href="%1$s">%2$s %3$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
		__( 'Read more', 'winslow' ),
		'<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>'
	);
}
add_filter( 'excerpt_more', 'winslow_excerpt_more' );

/**
 * Add class to the_excerpt.
 */
function winslow_excerpt_class( $excerpt ) {
	return str_replace( '<p', '<p class="entry-excerpt"', $excerpt );
}
add_action( 'the_excerpt', 'winslow_excerpt_class' );

/**
 * Set up arguments for featured stories.
 */
function winslow_get_featured_args() {
	$featured_category_id = get_cat_ID( 'Featured' );

	if ( $featured_category_id && get_category( $featured_category_id )->category_count > 3 ) {
		$args = array(
			'posts_per_page' => 4,
			'meta_query' => array(
				array(
					'key' => '_thumbnail_id'
				)
			),
			'ignore_sticky_posts' => 1,
			'cat' => $featured_category_id,
		);
	} else {
		$args = array(
			'posts_per_page' => 4,
			'meta_query' => array(
				array(
					'key' => '_thumbnail_id'
				)
			),
			'ignore_sticky_posts' => 1,
		);
	}

	return $args;
}

/**
 * Determine which stories to feature on homepage.
 */
function winslow_get_featured_stories() {
	global $post;
	$featured_stories = array();

	$featured_query = new WP_Query( winslow_get_featured_args() );
	while ( $featured_query->have_posts() ) : $featured_query->the_post();
        $featured_stories[] = $post->ID;
    endwhile;

    wp_reset_postdata();

    return $featured_stories;
}

/**
 * Set global variable with IDs of featured posts
 */
global $winslow_featured_ids;
$winslow_featured_ids = winslow_get_featured_stories();

/**
 * Remove featured stories from homepage query.
 */
function winslow_remove_featured_from_query( $query ) {
	global $winslow_featured_ids;
	if ( $query->is_home() && $query->is_main_query() ) {
		$query->set( 'post__not_in', $winslow_featured_ids );
	}
}
add_action('pre_get_posts', 'winslow_remove_featured_from_query');
