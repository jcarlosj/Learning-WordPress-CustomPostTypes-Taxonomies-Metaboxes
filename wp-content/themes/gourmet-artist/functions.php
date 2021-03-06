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
			619, 						# Ancho de la imagen en pixeles
			462, 						# Alto de la imagen en pixeles
			true 						# TRUE -> Si deseamos que haga un cropping de la imagen
		);
		add_image_size(
			'slider-image', # Nombre del tamaño de imagen que hemos registrado
			1200, 				  # Ancho de la imagen en pixeles
			370, 						# Alto de la imagen en pixeles
			true 						# TRUE -> Si deseamos que haga un cropping de la imagen
		);
		add_image_size(
			'tipo-receta-image', # Nombre del tamaño de imagen que hemos registrado
			560,  				       # Ancho de la imagen en pixeles
			800, 						     # Alto de la imagen en pixeles
			true 						     # TRUE -> Si deseamos que haga un cropping de la imagen
		);
		add_image_size(
			'horario-receta-image', # Nombre del tamaño de imagen que hemos registrado
			385,  				          # Ancho de la imagen en pixeles
			491, 						        # Alto de la imagen en pixeles
			true 						        # TRUE -> Si deseamos que haga un cropping de la imagen
		);
		add_image_size(
			'busqueda-avanzada-image', # Nombre del tamaño de imagen que hemos registrado
			400,  				             # Ancho de la imagen en pixeles
			380, 						           # Alto de la imagen en pixeles
			true 						           # TRUE -> Si deseamos que haga un cropping de la imagen
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
	/* Implementa el 'plugin' de jQuery Filterizr que: ordena, mezcla y aplica filtros */
	wp_enqueue_script(
		'filterizr',
		get_template_directory_uri(). '/js/jquery.filterizr.min.js',
		array(),
		'v1.3.4'
	);
	/* Implementa Configuración del plugin 'Filterizr' */
	wp_enqueue_script(
		'app-filterizr',
		get_template_directory_uri(). '/js/app-filterizr.js',
		array( 'filterizr' ),
		'v1.0.0'
	);
	/* Implementa JavaScript para el Buscador Avanzado usando AJAX */
	wp_enqueue_script(
		'xhr-buscador-avanzado',
		get_template_directory_uri(). '/js/xhr-buscador-avanzado.js',
		array( 'jquery' ),
		'v1.0.0'
	);
	/* Implementa las librerías JS principales de 'Foundation' al "UnderScores Theme" de WordPress */
	wp_enqueue_script(
		'app-js',
		get_template_directory_uri(). '/js/app.js'
 	);
	/* Implementa archivo JavaScript para el Manejo de Datos con AJAX en WordPress (Horario Comida) en 'index.php' */
	wp_enqueue_script(
		'xhr-horario-comida-js',
		get_template_directory_uri(). '/js/horario_comida.js'
 	);
	/* Localiza una secuencia de comandos (Funciona solo si el script ya se ha agregado) */
	wp_localize_script(
		'xhr-horario-comida-js',			// Nombre del Manejador de scripts que adjuntará WP a los datos
		'admin_url',									// Nombre para el Objeto JavaScript
		array(												// Datos que se pasarán al Objeto 'admin_url'
			'url' => admin_url( 'admin-ajax.php' )		// admin_url() es una función de WordPress que recupera el URL del área de adminitración para el sitio actual
		)
	);
	wp_enqueue_script( 'gourmet-artist-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'gourmet_artist_scripts' );

/* Incluye 'Post Types' o 'Custom Post Types' en el Loop Principal de Wordpress
 * Con ella reemplazamos el usar un WP_Query para poder mostrar uno o más tipos de Posts al tiempo */
function mostrar_post_type( $query ) {
	# Validamos que NO sea la vista de ADMIN usando negando la función is_admin() y que el Query que recibe sea el Query Principal, usamos la función is_main_query() para validarlo
	if( !is_admin() && $query -> is_main_query() ) {
		# Valida que sea el homepage (página principal)
		if( is_home() ) {
			# Agrega los post type que deseamos al query
			$query -> set(
				'post_type',						// Indica a WP que vamos a agregar 'Post Types' al Query
				array(
					'post',								// Nombre del 'Post Type' por defecto de WordPress
					'recetas'							// Nombre del 'Custom Post Type' recetas
				)
			);
		}
	}
}
// Hook: es la acción que permite identificar una funcionalidad por WP y donde se desea ejecutar
add_action(
	'pre_get_posts', 			// Lugar donde queremos que se ejecute la funcionalidad. En este caso antes de obtener los posts de la página del sitio
	'mostrar_post_type' 	// La funcionalidad o código a desplegar
);

# Valida si ha sido seleccionado la opción precio para realizar la BUSQUEDA AVANZADA usando AJAX en WordPress
function get_campo_seleccionado( $campo_seleccionado, $taxonomia ) {
	# Valida si se seleccionó un precio
	if( !empty( $campo_seleccionado ) ) {
			return $campo_seleccionado;					# Asigna el valor seleccionado
	}
	else {
		# Obtenemos los terminos de una taxonomía específica 'tipo_receta'
		$terminos = get_terms(
			array(
				'taxonomy' => $taxonomia
			)
		);

		# Recorre y asigna todos los terminos cuando no se ha seleccionado 'Precio'
		foreach ( $terminos as $key => $termino ) {
			$todos_los_terminos[] = $termino -> slug;
		}

		return $todos_los_terminos;
	}
}

function get_calorias_seleccionado( $calorias ) {
	# Valida si se seleccionó Calorias
	if( empty( $calorias ) ) {
		return array(
			0, 											# Valor Mínimo
			10000 									# Valor Máximo
		);
	}
	else {
		$calorias = explode( '-', $calorias );
		return array(
			(int) $calorias[ 0 ],		# Valor Mínimo
			(int) $calorias[ 1 ]    # Valor Máximo
		);
	}
}

/* Crea consulta para el buscador Avanzado usando AJAX en WordPress */
function buscar_resultados() {
	$listadoPost = array();
	$buscar = $_POST[ 'buscar' ];

	# Valida si las opciones del Buscador han sido o no seleccionadas usando: valor seleccionado del campo y nombre de la taxnomía
	$terminos_precio_receta = get_campo_seleccionado( $_POST[ 'precio' ], 'precio_receta' );
	$terminos_tipo_receta   = get_campo_seleccionado( $_POST[ 'tipo_receta' ], 'tipo_receta' );

	#Valida si la opcion 'Calorias' fue seleccionada
	$rango_calorias = get_calorias_seleccionado( $_POST[ 'calorias' ] );

	#$listadoPost = $rango_calorias;

	/* Personaliza la consulta */
	$args = array(
		'post_type'      => 'recetas',			# Elegimos el tipo de entrada que deseamos publicar
		'posts_per_page' => -1,							# Cantidad de publicaciones (-1 representa todas las publicaciones)
		's'              => $buscar,				# (string) Muestra publicaciones basadas en una busqueda por palabra clave al Título
		'tax_query'			 => array(					# (array) Contiene una o más 'Arrays' con con claves para consulta. Es la forma como se realizan consultas a las Taxonomías
			'relation' 	=> 'AND',							# (string) Relación Lógica entre cada matriz de la taxonomía interna cuando hay más de una (Valores posibles: AND, OR, Valor por defecto: AND)
			array(
				'taxonomy' => 'precio_receta',	# Nombre de la Taxonomía
				'field'		 => 'slug',						# Nombre del campo de la taxonomía sobre le que se realiza la busqueda
				'terms'    => $terminos_precio_receta # (int/string/array) Termino(s) de la taxonomía a buscar
			),
			array(
				'taxonomy' => 'tipo_receta',	      # Nombre de la Taxonomía
				'field'		 => 'slug',						    # Nombre del campo de la taxonomía sobre le que se realiza la busqueda
				'terms'    => $terminos_tipo_receta # (int/string/array) Termino(s) de la taxonomía a buscar
			)
		),
		'meta_query'     => array(                      # (array) Contiene una o más 'Arrays' con con claves para consulta. Es la forma como se realizan consultas a los Metaboxes
			array(
				'key'     => 'input-metabox',         			# (string) Llave que se desea comparar (Calorias)
				'value'   => $rango_calorias,               # (string/array) Hora Actual. Puede ser un 'Array' cuando la comparación es: IN, NOT IN, BETWEEN, NOT BETWEEN
				'type'    => 'NUMERIC',											# Tipo de Campo Personalizado (Sus valores pueden ser: NUMERIC, BINARY, CHAR, DATE, DATETIME, DECIMAL, SIGNED, TIME, UNSIGNED)
				'compare' => 'BETWEEN' 		                  # (string) Operador para comparar (Sus valores puede ser: =, !=, >, >=, <, <=, LIKE, NOT LIKE, IN, NOT, REGEXP, NOT REGEXP, RLIKE)
			)
		),
		'orderby' => 'id'
	);

	/* Realiza la consulta */

	$posts = get_posts( $args );					# Obtiene todos los post

	/* Recorre y asigna cada uno de los valores de los 'template_tags' del post */
	foreach ( $posts as $key => $post ) {
		/* Formatea los datos y permite hacer uso de variables globales de WP
			 Algunas de ellas son: $id, $authordata, $actualday, $currentmonth, $page, $pages, $multipage, $more, $numpages */
		setup_postdata( $post );

		$listadoPost[] = array(
			'id'     => $post -> ID,																											// ID del Post
			'titulo' => $post -> post_title,																							// Título del Post
			'contenido' => substr( apply_filters( 'the_content', $post -> post_content ), 0, 250 ),			// Contenido del Post. La función 'apply_filters()' soluciona el problema de que el contenido del post '${ object .contenido }' que no quedaba embebido en el elemento <p> aunque aún genera el elemento <div> con la clase 'lipsum'
			'imagen' => get_the_post_thumbnail( $post -> ID, 'busqueda-avanzada-image' ),	// Imagen del Post
			'enlace' => get_the_permalink( $post -> ID ),																	// Enlace del Post
			'objecto' => $post																														// Todos los valores del objeto
		);
	}

	/* Convertir el 'Array' a una cadena JSON */
	header( 'Content-type: application/json' );			# Envia encabezado http json al navegador para informarle el tipo de datos que espera
	echo json_encode( $listadoPost );								# Convierte el 'Array' a JSON

	die;			// Es necesario usarla, para resetear como se hace con 'wp_reset_postdata()' un 'WP_Query'
						// Esta es la forma como se hace el RESET, ya que la función 'get_posts' no modifica el Query como si lo hace 'WP_Query'
}
// Doble Hook: es la acción que permite identificar una funcionalidad por WP y donde se desea ejecutar
add_action(
	'wp_ajax_nopriv_buscar_resultados', 	// Lugar donde queremos que se ejecute la funcionalidad. En este caso antes de obtener los posts de la página del sitio
	'buscar_resultados' 									// La funcionalidad o código a desplegar
);
add_action(
	'wp_ajax_buscar_resultados', 		// Lugar donde queremos que se ejecute la funcionalidad. En este caso antes de obtener los posts de la página del sitio
	'buscar_resultados' 					  // La funcionalidad o código a desplegar
);

/* Crea consulta de entradas (Post) 'recetas' para usar Ajax en WordPress */
function sugerencia_recetas_desayunar() {

	/* Personalizamos la consulta */
		$args = array(
			'post_type'      => 'recetas',   # Elegimos el tipo de entradas que deseamos publicar el CPT 'recetas'
			'tax_query'      => array(			 # Muestra publicaciones asociada con determinada taxonomía
				array(
					'taxonomy' => 'horario_menu',			# Taxonomía que se va a publicar
					'field'    => 'slug',							# Campo de la taxonomía a publicar (valores posibles: 'term_id' (valor por defecto), 'name', 'slug', 'term_taxonomy_id')
					'terms'	   => 'desayuno'     	    # Término específico de la taxonomía ( int/string/array )
				)
			),
			'orderby'        => 'rand',      # Ordenado: Aleatorio
			'posts_per_page' => 3            # Cantidad de publicaciones por página
		);

		/* Obtener todas las entradas (o Post) 'get_posts()' sin modificar el Query, solo consulta */
		$posts = get_posts( $args );				// Retorna un Objeto con todos los CPT 'recetas' (Necesario para cuando se trabaja con AJAX)

		/* Asignamos cada Entrada a un campo en un Array */
		$listadoPost = array();

		/* Recorre y asigna cada uno de los valores de los 'template_tags' del post */
		foreach ( $posts as $key => $post ) {
			/* Formatea los datos y permite hacer uso de variables globales de WP
				 Algunas de ellas son: $id, $authordata, $actualday, $currentmonth, $page, $pages, $multipage, $more, $numpages */
			setup_postdata( $post );

			$listadoPost[] = array(
				'id'     => $post -> ID,																											// ID del Post
				'titulo' => $post -> post_title,																							// Título del Post
				'imagen' => get_the_post_thumbnail( $post -> ID, 'horario-receta-image' ),		// Imagen del Post
				'enlace' => get_the_permalink( $post -> ID ),																	// Enlace del Post
				'objecto' => $post																														// Todos los valores del objeto
			);
		}

		/* Convertir el 'Array' a una cadena JSON */
		header( 'Content-type: application/json' );			# Envia encabezado http json al navegador para informarle el tipo de datos que espera
		echo json_encode( $listadoPost );								# Convierte el 'Array' a JSON

		die;			// Es necesario usarla, para resetear como se hace con 'wp_reset_postdata()' un 'WP_Query'
		          // Esta es la forma como se hace el RESET, ya que la función 'get_posts' no modifica el Query como si lo hace 'WP_Query'
}
// Doble Hook: es la acción que permite identificar una funcionalidad por WP y donde se desea ejecutar
add_action(
	'wp_ajax_nopriv_sugerencia_recetas_desayunar', 	// Lugar donde queremos que se ejecute la funcionalidad. En este caso antes de obtener los posts de la página del sitio
	'sugerencia_recetas_desayunar' 									// La funcionalidad o código a desplegar
);
add_action(
	'wp_ajax_sugerencia_recetas_desayunar', 	// Lugar donde queremos que se ejecute la funcionalidad. En este caso antes de obtener los posts de la página del sitio
	'sugerencia_recetas_desayunar' 					  // La funcionalidad o código a desplegar
);

/* NOTA:
   wp_ajax_<nombre-funcion>: 			  El usuario tiene que haber iniciado sesión
   wp_ajax_nopriv_<nombre-funcion>: El usuario NO tiene que haber iniciado sesión
 */

 /* Crea consulta de entradas (Post) 'recetas' para usar Ajax en WordPress */
 function sugerencia_recetas_almorzar() {

 	/* Personalizamos la consulta */
 		$args = array(
 			'post_type'      => 'recetas',   # Elegimos el tipo de entradas que deseamos publicar el CPT 'recetas'
 			'tax_query'      => array(			 # Muestra publicaciones asociada con determinada taxonomía
 				array(
 					'taxonomy' => 'horario_menu',			# Taxonomía que se va a publicar
 					'field'    => 'slug',							# Campo de la taxonomía a publicar (valores posibles: 'term_id' (valor por defecto), 'name', 'slug', 'term_taxonomy_id')
 					'terms'	   => 'almuerzo'     	    # Término específico de la taxonomía ( int/string/array )
 				)
 			),
 			'orderby'        => 'rand',      # Ordenado: Aleatorio
 			'posts_per_page' => 3            # Cantidad de publicaciones por página
 		);

 		/* Obtener todas las entradas (o Post) 'get_posts()' sin modificar el Query, solo consulta */
 		$posts = get_posts( $args );				// Retorna un Objeto con todos los CPT 'recetas' (Necesario para cuando se trabaja con AJAX)

 		/* Asignamos cada Entrada a un campo en un Array */
 		$listadoPost = array();

 		/* Recorre y asigna cada uno de los valores de los 'template_tags' del post */
 		foreach ( $posts as $key => $post ) {
 			/* Formatea los datos y permite hacer uso de variables globales de WP
 				 Algunas de ellas son: $id, $authordata, $actualday, $currentmonth, $page, $pages, $multipage, $more, $numpages */
 			setup_postdata( $post );

 			$listadoPost[] = array(
 				'id'     => $post -> ID,																											// ID del Post
 				'titulo' => $post -> post_title,																							// Título del Post
 				'imagen' => get_the_post_thumbnail( $post -> ID, 'horario-receta-image' ),		// Imagen del Post
 				'enlace' => get_the_permalink( $post -> ID ),																	// Enlace del Post
 				'objecto' => $post																														// Todos los valores del objeto
 			);
 		}

 		/* Convertir el 'Array' a una cadena JSON */
 		header( 'Content-type: application/json' );			# Envia encabezado http json al navegador para informarle el tipo de datos que espera
 		echo json_encode( $listadoPost );								# Convierte el 'Array' a JSON

 		die;			// Es necesario usarla, para resetear como se hace con 'wp_reset_postdata()' un 'WP_Query'
 		          // Esta es la forma como se hace el RESET, ya que la función 'get_posts' no modifica el Query como si lo hace 'WP_Query'
 }
 // Doble Hook: es la acción que permite identificar una funcionalidad por WP y donde se desea ejecutar
 add_action(
 	'wp_ajax_nopriv_sugerencia_recetas_almorzar', 	// Lugar donde queremos que se ejecute la funcionalidad. En este caso antes de obtener los posts de la página del sitio
 	'sugerencia_recetas_almorzar' 									// La funcionalidad o código a desplegar
 );
 add_action(
 	'wp_ajax_sugerencia_recetas_almorzar', 	  // Lugar donde queremos que se ejecute la funcionalidad. En este caso antes de obtener los posts de la página del sitio
 	'sugerencia_recetas_almorzar' 					  // La funcionalidad o código a desplegar
 );

 /* NOTA:
    wp_ajax_<nombre-funcion>: 			  El usuario tiene que haber iniciado sesión
    wp_ajax_nopriv_<nombre-funcion>: El usuario NO tiene que haber iniciado sesión
  */

	/* Crea consulta de entradas (Post) 'recetas' para usar Ajax en WordPress */
	function sugerencia_recetas_cenar() {

		/* Personalizamos la consulta */
			$args = array(
				'post_type'      => 'recetas',   # Elegimos el tipo de entradas que deseamos publicar el CPT 'recetas'
				'tax_query'      => array(			 # Muestra publicaciones asociada con determinada taxonomía
					array(
						'taxonomy' => 'horario_menu',			# Taxonomía que se va a publicar
						'field'    => 'slug',							# Campo de la taxonomía a publicar (valores posibles: 'term_id' (valor por defecto), 'name', 'slug', 'term_taxonomy_id')
						'terms'	   => 'cena'     	    # Término específico de la taxonomía ( int/string/array )
					)
				),
				'orderby'        => 'rand',      # Ordenado: Aleatorio
				'posts_per_page' => 3            # Cantidad de publicaciones por página
			);

			/* Obtener todas las entradas (o Post) 'get_posts()' sin modificar el Query, solo consulta */
			$posts = get_posts( $args );				// Retorna un Objeto con todos los CPT 'recetas' (Necesario para cuando se trabaja con AJAX)

			/* Asignamos cada Entrada a un campo en un Array */
			$listadoPost = array();

			/* Recorre y asigna cada uno de los valores de los 'template_tags' del post */
			foreach ( $posts as $key => $post ) {
				/* Formatea los datos y permite hacer uso de variables globales de WP
					 Algunas de ellas son: $id, $authordata, $actualday, $currentmonth, $page, $pages, $multipage, $more, $numpages */
				setup_postdata( $post );

				$listadoPost[] = array(
					'id'     => $post -> ID,																											// ID del Post
					'titulo' => $post -> post_title,																							// Título del Post
					'imagen' => get_the_post_thumbnail( $post -> ID, 'horario-receta-image' ),		// Imagen del Post
					'enlace' => get_the_permalink( $post -> ID ),																	// Enlace del Post
					'objecto' => $post																														// Todos los valores del objeto
				);
			}

			/* Convertir el 'Array' a una cadena JSON */
			header( 'Content-type: application/json' );			# Envia encabezado http json al navegador para informarle el tipo de datos que espera
			echo json_encode( $listadoPost );								# Convierte el 'Array' a JSON

			die;			// Es necesario usarla, para resetear como se hace con 'wp_reset_postdata()' un 'WP_Query'
			          // Esta es la forma como se hace el RESET, ya que la función 'get_posts' no modifica el Query como si lo hace 'WP_Query'
	}
	// Doble Hook: es la acción que permite identificar una funcionalidad por WP y donde se desea ejecutar
	add_action(
		'wp_ajax_nopriv_sugerencia_recetas_cenar', 	// Lugar donde queremos que se ejecute la funcionalidad. En este caso antes de obtener los posts de la página del sitio
		'sugerencia_recetas_cenar' 									// La funcionalidad o código a desplegar
	);
	add_action(
		'wp_ajax_sugerencia_recetas_cenar', 	// Lugar donde queremos que se ejecute la funcionalidad. En este caso antes de obtener los posts de la página del sitio
		'sugerencia_recetas_cenar' 					  // La funcionalidad o código a desplegar
	);

	/* NOTA:
	   wp_ajax_<nombre-funcion>: 			  El usuario tiene que haber iniciado sesión
	   wp_ajax_nopriv_<nombre-funcion>: El usuario NO tiene que haber iniciado sesión
	 */

/* FUNCIONALIDADES ADICIONALES */
# Muestra Post 'recetas' filtrado por la taxonomía 'tipo_receta' de acuerdo al término seleccionado
function mostrar_post_type_recetas_por_tipo_receta( $termino ) {
	/* Personalizamos la consulta */
		$args = array(
			'post_type'      => 'recetas',   # Elegimos el tipo de entradas que deseamos publicar el CPT 'recetas'
			'tax_query'      => array(			 # Muestra publicaciones asociada con determinada taxonomía
				array(
					'taxonomy' => 'tipo_receta',			# Taxonomía que se va a publicar
					'field'    => 'slug',							# Campo de la taxonomía a publicar (valores posibles: 'term_id' (valor por defecto), 'name', 'slug', 'term_taxonomy_id')
					'terms'	   => $termino     	      # Término específico de la taxonomía ( int/string/array )
				)
			),
			'orderby'        => 'rand',      # Ordenado: Aleatorio
			'posts_per_page' => 4            # Cantidad de publicaciones por página
		);

		/* Realiza la consulta WP_Query */
		$tipo_comida = new WP_Query( $args );

		echo '<div id=' .$termino. ' class="row">';

		# Imprime las entradas requeridas
		while( $tipo_comida -> have_posts() ):
			$tipo_comida -> the_post();

			echo '
				<div class="small-6 medium-3 columns">
					<div class="receta">
					  <a href="' .get_the_permalink(). '">';

			the_post_thumbnail( 'tipo-receta-image' );

			echo '
			            <h2 class="text-center">' .get_the_title(). '</h2>
							  </a>
							</div>
						</div>';

		endwhile;
		wp_reset_postdata();

		echo '</div>';

}

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
