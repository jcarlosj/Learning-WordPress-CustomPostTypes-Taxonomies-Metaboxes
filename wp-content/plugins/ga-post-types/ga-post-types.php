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
    'can_export'          => true,          // [true/false] habilitar o deshabilitar la exportación como XML para importarlo en otro lugar
    'has_archive'         => true,          // [true/false] habilitar o deshabilitar el uso del archivo 'archive.php'
    'exclude_from_search' => false,         // [true/false] habilitar o deshabilitar posibilidad de busqueda de contenidos en el buscador de WordPress
    'capability_type'     => 'page'         // Capacidad construir capacidades de lectura, edición y eliminación (se puede pasar como 'Array', para permitir plurales alternativos)
                                            // en este caos se le pasa un tipo de capacidad definida en WordPress 'page', aunque por defecto si no se definen por defecto tomará 'post'
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

?>
