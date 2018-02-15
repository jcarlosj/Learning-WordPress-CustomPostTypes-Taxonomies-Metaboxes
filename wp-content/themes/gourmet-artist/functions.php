<?php
/**
 * Gourmet Artist functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Gourmet_Artist
 */

if ( ! function_exists( 'gourmet_artist_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function gourmet_artist_setup() {
		/* Personalizamos nu nuevo tamaño de imagen */
		add_image_size(
			'entry-image', 	# Nombre del tamaño de imagen que hemos registrado
			619, 						# Alto de la imagen en pixeles
			462, 						# Ancho de la imagen en pixeles
			true 						# TRUE -> Si deseamos que haga un cropping de la imagen
		);
		add_image_size(
			'slider-image', # Nombre del tamaño de imagen que hemos registrado
			1200, 				  # Alto de la imagen en pixeles
			370, 						# Ancho de la imagen en pixeles
			true 						# TRUE -> Si deseamos que haga un cropping de la imagen
		);
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Gourmet Artist, use a find and replace
		 * to change 'gourmet-artist' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'gourmet-artist', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'gourmet-artist' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'gourmet-artist' ),
			'social-menu' => esc_html__( 'Social Menu', 'gourmet-artist' )
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
		add_theme_support( 'custom-background', apply_filters( 'gourmet_artist_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'gourmet_artist_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gourmet_artist_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'gourmet_artist_content_width', 640 );
}
add_action( 'after_setup_theme', 'gourmet_artist_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function gourmet_artist_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'gourmet-artist' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'gourmet-artist' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title text-center">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'gourmet_artist_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function gourmet_artist_scripts() {
	wp_enqueue_style( 'gourmet-artist-style', get_stylesheet_uri() );
	/* Implementa las librerías CSS principales de 'Foundation' al "UnderScores Theme" de WordPress */
	wp_enqueue_style(
		'foundation-css',
		get_template_directory_uri(). '/css/app.css'
	);
	/* Implementa las librerías CSS principales de 'Foundation Icons' al "UnderScores Theme" de WordPress */
	wp_enqueue_style(
		'foundation-icons-css',
		get_template_directory_uri(). '/css/foundation-icons.css'
	);

	/* Implementamos jQuery que viene integrado con WordPress */
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'gourmet-artist-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	/* Implementa las librerías JS de 'Foundation' al "UnderScores Theme" de WordPress */
	wp_enqueue_script(
		'foundation-js',
		get_template_directory_uri(). '/bower_components/foundation-sites/dist/js/foundation.js',
		array(),
		'6.4.0'
	);
	/* Implementa las librerías de 'What Input' */
	wp_enqueue_script(
		'what-input',
		get_template_directory_uri(). '/bower_components/what-input/dist/what-input.min.js',
		array(),
		'v4.1.6'
	);
	/* Implementa las librerías JS principales de 'Foundation' al "UnderScores Theme" de WordPress */
	wp_enqueue_script(
		'app-js',
		get_template_directory_uri(). '/js/app.js'
 	);
	wp_enqueue_script( 'gourmet-artist-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'gourmet_artist_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/* Load Widgets @Jce_ */
require get_template_directory() . '/inc/widgets.php';

/*******************************************************************************
 * Establecer un valor de tiempo de espera personalizado para cURL
 ******************************************************************************/
// Establecer un valor de tiempo de espera personalizado para cURL. Usar un valor alto para prioridad para asegurar que la función se ejecute después de cualquier otra agregada al mismo gancho de acción.
add_action('http_api_curl', 'sar_custom_curl_timeout', 9999, 1);
function sar_custom_curl_timeout( $handle ){
	curl_setopt( $handle, CURLOPT_CONNECTTIMEOUT, 30 ); // 30 seconds. Too much for production, only for testing.
	curl_setopt( $handle, CURLOPT_TIMEOUT, 30 ); // 30 seconds. Too much for production, only for testing.
}

// Establecer el tiempo de espera personalizado para la solicitud HTTP
add_filter( 'http_request_timeout', 'sar_custom_http_request_timeout', 9999 );
function sar_custom_http_request_timeout( $timeout_value ) {
	return 30; // 30 seconds. Too much for production, only for testing.
}

// Configurar el tiempo de espera personalizado en argumentos de solicitud HTTP
add_filter('http_request_args', 'sar_custom_http_request_args', 9999, 1);
function sar_custom_http_request_args( $r ){
	$r['timeout'] = 30; // 30 seconds. Too much for production, only for testing.
	return $r;
}
