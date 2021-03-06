<?php
  /*
   Plugin Name: Gourmet Artist Post Types
   Plugin URI:
   Description: Agrega 'Custom Post Types' al sitio Gourmet Artist
   Version: 1.0
   Author: Juan Carlos Jiménez Gutiérrez
   Author URI:
   License: GPL2
   License URI: https://www.gnu.org/licenses/gpl-2.0.html
   */

// Crea un post type 'Recetas'
function crear_post_type_recetas() {

  // Array de etiquetas personalizadas para el 'Post Type'
  $labels = array(
      'name'                => _x( 'Recetas', 'Post Type General Name', 'gourmet-artist' ),         // Nombre del post type (para la vista)
      'singular_name'       => _x( 'Receta', 'Post Type Singular Name', 'gourmet-artist' ),
      'menu_name'           => __( 'Recetas', 'gourmet-artist' ),
      'parent_item_color'   => __( 'Receta Padre', 'gourmet-artist' ),
      'all_items'           => __( 'Todas las Recetas', 'gourmet-artist' ),
      'view_item'           => __( 'Ver Receta', 'gourmet-artist' ),
      'add_new_item'        => __( 'Agregar Nueva Receta', 'gourmet-artist' ),
      'add_new'             => __( 'Agregar Nueva Receta', 'gourmet-artist' ),
      'edit_item'           => __( 'Editar Receta', 'gourmet-artist' ),
      'update_item'         => __( 'Actualizar Receta', 'gourmet-artist' ),
      'search_items'        => __( 'Buscar Receta', 'gourmet-artist' ),
      'not_found'           => __( 'Receta no encontrada', 'gourmet-artist' ),
      'not_found_in_trash'  => __( 'Receta no encontrada en la papelera', 'gourmet-artist' )
  );
  /* NOTA: se agrega 'gourmet-artist' en cada una de las etiquetas, por que es importante si se va a usar la 'internacionalización del theme de WP' */

  // Más opciones para la personalización del 'Post Type'
  $args = array(
    'label'         => __( 'recetas', 'gourmet-artist' ),               // Nombre de la etiqueta del post type
    'description'   => __( 'Recetas para cocina', 'gourmet-artist' ),
    'labels'        => $labels,                                         // Etiquetas personalizadas para el 'Post Type' definidas en la variable $labels
    'supports'      => array(                                           // Todas las características que soportará el 'Custom Post Type'
        'title',            // Campo de Título
        'editor',           // Campo para editar contenido tradicional del CPT
        'excerpt',          // Campo de Descripción corta
        'author',           // Campo de Autor
        'thumbnail',        // Campo de imágen destacada
        'comments',         // Campo para comentarios
        'revisions',        // Versionamiento de contenidos del CPT
        'custom-fields'     // Campos personalizados
    ),
    'hierarchical'        => false,                                           // [true/false] habilitar o deshabilitar el comportamiento jerarquico (padres e hijos) su comportamiento sería como el de una página (page)
    'public'              => true,          // El 'Post Type' va a ser público
    'show_ui'             => true,          // [true/false] Genera y permite o no una interfaz de usuario para administrar esta publicación en el administrador (que se vea la interfaz)
    'show_in_menu'        => true,          // [true/false] Mostrar o no publicación en el menú de administración (que se vea en el menu lateral en el admin)
    'show_in_admin_bar'   => true,          // [true/false] Mostrar o no publicación en la barra de administración
    'menu_position'       => 6,             // Posición en el menú lateral en el admin (Orden de aparición del item en el menú) 'show_in_menu' debe ser true
    'menu_icon'           => 'dashicons-book-alt',  // Agrega ícono al ítem de menú lateral en el admin (Usando DashIcons de WordPress en este caso)
    'can_export'          => true,          // [true/false] habilitar o deshabilitar la exportación como XML para importarlo en otro lugar
    'has_archive'         => true,          // [true/false] habilitar o deshabilitar el uso del archivo 'archive.php'
    'exclude_from_search' => false,         // [true/false] habilitar o deshabilitar posibilidad de busqueda de contenidos en el buscador de WordPress
    'capability_type'     => 'page',         // Capacidad construir capacidades de lectura, edición y eliminación (se puede pasar como 'Array', para permitir plurales alternativos)
                                            // en este caos se le pasa un tipo de capacidad definida en WordPress 'page', aunque por defecto si no se definen por defecto tomará 'post'
    'show_in_rest'        => true,          // [true/false] habilitar o desahabilitar publicación del Custom Post Type como REST API (Resultados JSON)
    'rest_base'           => 'rest-api-recetas' // Reescribe la base de la publicación de la REST API
  );

  // 'register_post_type' Crea y registra un post type en WP
  register_post_type(
    'recetas',          // Nombre del identificador del post type (para la WP)
    $args               // Los argumentos de personalización del CPT
  );

}
// Hook: es la acción que permite identificar una funcionalidad por WP y donde se desea ejecutar
add_action(
  'init',                                     // Lugar donde queremos que se ejecute la funcionalidad
  'crear_post_type_recetas',                  // La funcionalidad o código a desplegar
  0                                           // 0 (cero): Prioridad de ejecución para que se ejecute primero
);
/* NOTA: Se establecen prioridades cuando se usa un Hook para asociar dos funciones (funcionalidades) */

// Crea un taxonomy (Tipos de Comida) para el CPT 'Recetas'
function crear_taxonomy_recetas() {
  // Array de etiquetas personalizadas para el 'Taxonomy'
  $labels = array(
      'name'                => _x( 'Tipos de Comida', 'Taxonomy General Name', 'gourmet-artist' ),         // Nombre del post type (para la vista)
      'singular_name'       => _x( 'Tipo de Comida', 'Taxonomy Singular Name', 'gourmet-artist' ),
      'menu_name'           => __( 'Tipos de Comida', 'gourmet-artist' ),
      'search_items'        => __( 'Buscar Tipo de Comida', 'gourmet-artist' ),
      'parent_item'         => __( 'Tipo de comida (Padre)', 'gourmet-artist' ),
      'parent_item_color'   => __( 'Tipo de comida (Padre):', 'gourmet-artist' ),
      'all_items'           => __( 'Todos los tipos', 'gourmet-artist' ),
      'add_new_item'        => __( 'Agregar Nuevo Tipo de Comida', 'gourmet-artist' ),
      'new_item_name'       => __( 'Nuevo Tipo de Comida', 'gourmet-artist' ),
      'edit_item'           => __( 'Editar Tipo de Comida', 'gourmet-artist' ),
      'update_item'         => __( 'Actualizar Tipo de Comida', 'gourmet-artist' )
  );
  /* NOTA: se agrega 'gourmet-artist' en cada una de las etiquetas, por que es importante si se va a usar la 'internacionalización del theme de WP' */

  // Más opciones para la personalización del 'Taxonomy'
  $args = array(
    'labels'              => $labels,       // Etiquetas personalizadas para el 'Taxonomy' definidas en la variable $labels
    'hierarchical'        => true,          // [true/false] habilitar o deshabilitar el comportamiento jerarquico (padres e hijos) su comportamiento sería como el de una página (page)
    'show_ui'             => true,          // [true/false] Genera y permite o no una interfaz de usuario para administrar esta publicación en el administrador (que se vea la interfaz)
    'show_admin_column'   => true,          // [true/false] Mostrar o no la creación de columnas de taxonomía en la tabla de tipos asociados en la administración
    'query_var'           => true,          // [true/false] Habilita o no el uso el nombre de la taxonomía para hacer consultas directas a través de WP_Query y consultas URL (Aunque se pueden realizar consultas haciendo uso de una consulta WP_Query específica)
    'rewrite'             => array(         // Establece reescritura de la URL automática
      'slug' => 'tipo-receta'               // Nombre del Slug para la taxonomía creada
    ),
  );

  // 'register_taxonomy' Crea y registra una taxonomía en WP
  register_taxonomy(
    'tipo_receta',        // Nombre de la taxonomía
    array( 'recetas' ),   // Nombre del "Post Type" o los "Post Types" donde se desea aplicar esta taxonomía
    $args                 // Los argumentos de personalización del "Taxonomy"
  );

}
// Hook: es la acción que permite identificar una funcionalidad por WP y donde se desea ejecutar
add_action(
  'init',                                     // Lugar donde queremos que se ejecute la funcionalidad
  'crear_taxonomy_recetas'                    // La funcionalidad o código a desplegar
);

// Crea un taxonomy (Horarios de Comida) para el CPT 'Recetas'
function crear_taxonomy_horario_comida() {
  // Array de etiquetas personalizadas para el 'Taxonomy'
  $labels = array(
      'name'                => _x( 'Horarios de Comida', 'Taxonomy General Name', 'gourmet-artist' ),         // Nombre del post type (para la vista)
      'singular_name'       => _x( 'Horario de Comida', 'Taxonomy Singular Name', 'gourmet-artist' ),
      'menu_name'           => __( 'Horarios', 'gourmet-artist' ),
      'search_items'        => __( 'Buscar Horario de Comida', 'gourmet-artist' ),
      'parent_item'         => __( 'Horario (Padre)', 'gourmet-artist' ),
      'parent_item_color'   => __( 'Horario (Padre):', 'gourmet-artist' ),
      'all_items'           => __( 'Todos los horarios', 'gourmet-artist' ),
      'add_new_item'        => __( 'Agregar Nuevo Horario', 'gourmet-artist' ),
      'new_item_name'       => __( 'Nuevo Horario de Comida', 'gourmet-artist' ),
      'edit_item'           => __( 'Editar Horario de Comida', 'gourmet-artist' ),
      'update_item'         => __( 'Actualizar Horario de Comida', 'gourmet-artist' )
  );
  /* NOTA: se agrega 'gourmet-artist' en cada una de las etiquetas, por que es importante si se va a usar la 'internacionalización del theme de WP' */

  // Más opciones para la personalización del 'Taxonomy'
  $args = array(
    'labels'              => $labels,       // Etiquetas personalizadas para el 'Taxonomy' definidas en la variable $labels
    'hierarchical'        => true,          // [true/false] habilitar o deshabilitar el comportamiento jerarquico (padres e hijos) su comportamiento sería como el de una página (page)
    'show_ui'             => true,          // [true/false] Genera y permite o no una interfaz de usuario para administrar esta publicación en el administrador (que se vea la interfaz)
    'show_admin_column'   => true,          // [true/false] Mostrar o no la creación de columnas de taxonomía en la tabla de tipos asociados en la administración
    'query_var'           => true,          // [true/false] Habilita o no el uso el nombre de la taxonomía para hacer consultas directas a través de WP_Query y consultas URL (Aunque se pueden realizar consultas haciendo uso de una consulta WP_Query específica)
    'rewrite'             => array(         // Establece reescritura de la URL automática
      'slug' => 'horario-comida'            // Nombre del Slug para la taxonomía creada
    ),
  );

  // 'register_taxonomy' Crea y registra una taxonomía en WP
  register_taxonomy(
    'horario_menu',       // Nombre de la taxonomía
    array( 'recetas' ),   // Nombre del "Post Type" o los "Post Types" donde se desea aplicar esta taxonomía
    $args                 // Los argumentos de personalización del "Taxonomy"
  );

}
// Hook: es la acción que permite identificar una funcionalidad por WP y donde se desea ejecutar
add_action(
  'init',                                     // Lugar donde queremos que se ejecute la funcionalidad
  'crear_taxonomy_horario_comida'             // La funcionalidad o código a desplegar
);

// INICIO
// Crea un taxonomy (Estado de Animo) para el CPT 'Recetas'
function crear_taxonomy_estado_animo() {
  // Array de etiquetas personalizadas para el 'Taxonomy'
  $labels = array(
      'name'                => _x( 'Estados de Ánimo', 'Taxonomy General Name', 'gourmet-artist' ),         // Nombre del post type (para la vista)
      'singular_name'       => _x( 'Estado de Ánimo', 'Taxonomy Singular Name', 'gourmet-artist' ),
      'menu_name'           => __( 'Estados de Ánimo', 'gourmet-artist' ),
      'search_items'        => __( 'Buscar Estado de Ánimo', 'gourmet-artist' ),
      'parent_item'         => __( 'Estado de Ánimo (Padre)', 'gourmet-artist' ),
      'parent_item_color'   => __( 'Estado de Ánimo (Padre):', 'gourmet-artist' ),
      'all_items'           => __( 'Todos los Estados', 'gourmet-artist' ),
      'add_new_item'        => __( 'Agregar Nuevo Estado de Ánimo', 'gourmet-artist' ),
      'new_item_name'       => __( 'Nuevo Estado de Ánimo', 'gourmet-artist' ),
      'edit_item'           => __( 'Editar Estado de Ánimo', 'gourmet-artist' ),
      'update_item'         => __( 'Actualizar Estado de Ánimo', 'gourmet-artist' )
  );
  /* NOTA: se agrega 'gourmet-artist' en cada una de las etiquetas, por que es importante si se va a usar la 'internacionalización del theme de WP' */

  // Más opciones para la personalización del 'Taxonomy'
  $args = array(
    'labels'              => $labels,       // Etiquetas personalizadas para el 'Taxonomy' definidas en la variable $labels
    'hierarchical'        => false,         // [true/false] habilitar o deshabilitar el comportamiento jerarquico (padres e hijos) su comportamiento sería como el de una página (page)
    'show_ui'             => true,          // [true/false] Genera y permite o no una interfaz de usuario para administrar esta publicación en el administrador (que se vea la interfaz)
    'show_admin_column'   => true,          // [true/false] Mostrar o no la creación de columnas de taxonomía en la tabla de tipos asociados en la administración
    'query_var'           => true,          // [true/false] Habilita o no el uso el nombre de la taxonomía para hacer consultas directas a través de WP_Query y consultas URL (Aunque se pueden realizar consultas haciendo uso de una consulta WP_Query específica)
    'rewrite'             => array(         // Establece reescritura de la URL automática
      'slug' => 'estado-animo'              // Nombre del Slug para la taxonomía creada
    ),
  );

  // 'register_taxonomy' Crea y registra una taxonomía en WP
  register_taxonomy(
    'estado_animo',       // Nombre de la taxonomía
    array( 'recetas' ),   // Nombre del "Post Type" o los "Post Types" donde se desea aplicar esta taxonomía
    $args                 // Los argumentos de personalización del "Taxonomy"
  );

}
// Hook: es la acción que permite identificar una funcionalidad por WP y donde se desea ejecutar
add_action(
  'init',                                     // Lugar donde queremos que se ejecute la funcionalidad
  'crear_taxonomy_estado_animo'             // La funcionalidad o código a desplegar
);
// FIN

// Crea un post type 'Eventos'
function crear_post_type_eventos() {

  // Array de etiquetas personalizadas para el 'Post Type'
  $labels = array(
      'name'                => _x( 'Eventos', 'Post Type General Name', 'gourmet-artist' ),         // Nombre del post type (para la vista)
      'singular_name'       => _x( 'Evento', 'Post Type Singular Name', 'gourmet-artist' ),
      'menu_name'           => __( 'Eventos', 'gourmet-artist' ),
      'parent_item_color'   => __( 'Evento Padre', 'gourmet-artist' ),
      'all_items'           => __( 'Todos las Eventos', 'gourmet-artist' ),
      'view_item'           => __( 'Ver Evento', 'gourmet-artist' ),
      'add_new_item'        => __( 'Agregar Nuevo Evento', 'gourmet-artist' ),
      'add_new'             => __( 'Agregar Nuevo Evento', 'gourmet-artist' ),
      'edit_item'           => __( 'Editar Evento', 'gourmet-artist' ),
      'update_item'         => __( 'Actualizar Evento', 'gourmet-artist' ),
      'search_items'        => __( 'Buscar Evento', 'gourmet-artist' ),
      'not_found'           => __( 'Evento no encontrada', 'gourmet-artist' ),
      'not_found_in_trash'  => __( 'Evento no encontrada en la papelera', 'gourmet-artist' )
  );
  /* NOTA: se agrega 'gourmet-artist' en cada una de las etiquetas, por que es importante si se va a usar la 'internacionalización del theme de WP' */

  // Más opciones para la personalización del 'Post Type'
  $args = array(
    'label'         => __( 'eventos', 'gourmet-artist' ),               // Nombre de la etiqueta del post type
    'description'   => __( 'Eventos de la empresa', 'gourmet-artist' ),
    'labels'        => $labels,                                         // Etiquetas personalizadas para el 'Post Type' definidas en la variable $labels
    'supports'      => array(                                           // Todas las características que soportará el 'Custom Post Type'
        'title',            // Campo de Título
        'editor',           // Campo para editar contenido tradicional del CPT
        'excerpt',          // Campo de Descripción corta
        'author',           // Campo de Autor
        'thumbnail',        // Campo de imágen destacada
        'comments',         // Campo para comentarios
        'revisions',        // Versionamiento de contenidos del CPT
        'custom-fields'     // Campos personalizados
    ),
    'hierarchical'        => false,                                           // [true/false] habilitar o deshabilitar el comportamiento jerarquico (padres e hijos) su comportamiento sería como el de una página (page)
    'public'              => true,          // El 'Post Type' va a ser público
    'show_ui'             => true,          // [true/false] Genera y permite o no una interfaz de usuario para administrar esta publicación en el administrador (que se vea la interfaz)
    'show_in_menu'        => true,          // [true/false] Mostrar o no publicación en el menú de administración (que se vea en el menu lateral en el admin)
    'show_in_admin_bar'   => true,          // [true/false] Mostrar o no publicación en la barra de administración
    'menu_position'       => 6,             // Posición en el menú lateral en el admin (Orden de aparición del item en el menú) 'show_in_menu' debe ser true
    'menu_icon'           => 'dashicons-calendar-alt',  // Agrega ícono al ítem de menú lateral en el admin (Usando DashIcons de WordPress en este caso)
    'can_export'          => true,          // [true/false] habilitar o deshabilitar la exportación como XML para importarlo en otro lugar
    'has_archive'         => true,          // [true/false] habilitar o deshabilitar el uso del archivo 'archive.php'
    'exclude_from_search' => false,         // [true/false] habilitar o deshabilitar posibilidad de busqueda de contenidos en el buscador de WordPress
    'capability_type'     => 'page'         // Capacidad construir capacidades de lectura, edición y eliminación (se puede pasar como 'Array', para permitir plurales alternativos)
                                            // en este caos se le pasa un tipo de capacidad definida en WordPress 'page', aunque por defecto si no se definen por defecto tomará 'post'
  );

  // 'register_post_type' Crea y registra un post type en WP
  register_post_type(
    'eventos',          // Nombre del identificador del post type (para la WP)
    $args               // Los argumentos de personalización del CPT
  );

}
// Hook: es la acción que permite identificar una funcionalidad por WP y donde se desea ejecutar
add_action(
  'init',                                     // Lugar donde queremos que se ejecute la funcionalidad
  'crear_post_type_eventos',                  // La funcionalidad o código a desplegar
  0                                           // 0 (cero): Prioridad de ejecución para que se ejecute primero
);
/* NOTA: Se establecen prioridades cuando se usa un Hook para asociar dos funciones (funcionalidades) */

// Crea un post type 'Restaurantes' usando 'GenerateWP' - https://generatewp.com
function custom_post_type_restaurantes() {

	$labels = array(
		'name'                  => _x( 'Restaurantes', 'Post Type General Name', 'gourmet-artist' ),
		'singular_name'         => _x( 'Restaurante', 'Post Type Singular Name', 'gourmet-artist' ),
		'menu_name'             => __( 'Restaurantes', 'gourmet-artist' ),
		'name_admin_bar'        => __( 'Restaurantes', 'gourmet-artist' ),
		'archives'              => __( 'Archivo de restaurante', 'gourmet-artist' ),
		'attributes'            => __( 'Atributos de restaurante', 'gourmet-artist' ),
		'parent_item_colon'     => __( 'Restaurante Padre', 'gourmet-artist' ),
		'all_items'             => __( 'Todos los artículos', 'gourmet-artist' ),
		'add_new_item'          => __( 'Agregar Nuevo Restaurante', 'gourmet-artist' ),
		'add_new'               => __( 'Agregar Nuevo Restaurante', 'gourmet-artist' ),
		'new_item'              => __( 'Nuevo Restaurante', 'gourmet-artist' ),
		'edit_item'             => __( 'Editar Restaurante', 'gourmet-artist' ),
		'update_item'           => __( 'Actualizar Restaurante', 'gourmet-artist' ),
		'view_item'             => __( 'Ver Restaurante', 'gourmet-artist' ),
		'view_items'            => __( 'Ver Restaurantes', 'gourmet-artist' ),
		'search_items'          => __( 'Buscar Restaurante', 'gourmet-artist' ),
		'not_found'             => __( 'No Encuentra Restaurante', 'gourmet-artist' ),
		'not_found_in_trash'    => __( 'No Encuentra Restaurante en la Papelera', 'gourmet-artist' ),
		'featured_image'        => __( 'Imagen Destacada', 'gourmet-artist' ),
		'set_featured_image'    => __( 'Agregar Imagen Destacada', 'gourmet-artist' ),
		'remove_featured_image' => __( 'Eliminar Imagen Destacada', 'gourmet-artist' ),
		'use_featured_image'    => __( 'Usar Imagen Destacada', 'gourmet-artist' ),
		'insert_into_item'      => __( 'Insertar Dentro Restaurante', 'gourmet-artist' ),
		'uploaded_to_this_item' => __( 'Agregado a este Restaurante', 'gourmet-artist' ),
		'items_list'            => __( 'Lista de Restaurantes', 'gourmet-artist' ),
		'items_list_navigation' => __( 'Navegación de Restaurantes', 'gourmet-artist' ),
		'filter_items_list'     => __( 'Filtrar Restaurantes', 'gourmet-artist' ),
	);
	$args = array(
		'label'                 => __( 'Restaurante', 'gourmet-artist' ),
		'description'           => __( 'Restaurantes recomendados', 'gourmet-artist' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-store',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'restaurantes', $args );

}
add_action( 'init', 'custom_post_type_restaurantes', 0 );


// Crea y registra un custom taxonomy 'Precios Recetas' usando 'GenerateWP' - https://generatewp.com
function custom_taxonomy_precio_receta() {

	$labels = array(
		'name'                       => _x( 'Precios', 'Taxonomy General Name', 'gourmet-artist' ),
		'singular_name'              => _x( 'Precio', 'Taxonomy Singular Name', 'gourmet-artist' ),
		'menu_name'                  => __( 'Precio', 'gourmet-artist' ),
		'all_items'                  => __( 'Todos los precios', 'gourmet-artist' ),
		'parent_item'                => __( 'Precio (Padre)', 'gourmet-artist' ),
		'parent_item_colon'          => __( 'Precio (Padre):', 'gourmet-artist' ),
		'new_item_name'              => __( 'Agregar Nuevo Precio', 'gourmet-artist' ),
		'add_new_item'               => __( 'Agregar Nuevo Precio', 'gourmet-artist' ),
		'edit_item'                  => __( 'Editar Precio', 'gourmet-artist' ),
		'update_item'                => __( 'Actualizar Precio', 'gourmet-artist' ),
		'view_item'                  => __( 'Ver Precio', 'gourmet-artist' ),
		'separate_items_with_commas' => __( 'Separado por comas', 'gourmet-artist' ),
		'add_or_remove_items'        => __( 'Agregar o Eliminar Precio', 'gourmet-artist' ),
		'choose_from_most_used'      => __( 'Elegir de los más usados', 'gourmet-artist' ),
		'popular_items'              => __( 'Precios Populares', 'gourmet-artist' ),
		'search_items'               => __( 'Buscar Precios', 'gourmet-artist' ),
		'not_found'                  => __( 'Precio No Encontrado', 'gourmet-artist' ),
		'no_terms'                   => __( 'Sin Precios', 'gourmet-artist' ),
		'items_list'                 => __( 'Lista de Precios', 'gourmet-artist' ),
		'items_list_navigation'      => __( 'Navegación de Precios', 'gourmet-artist' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'precio_receta', array( 'recetas' ), $args );

}
add_action( 'init', 'custom_taxonomy_precio_receta', 0 );

?>
