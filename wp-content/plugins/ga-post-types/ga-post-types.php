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
  // 'register_post_type' Crea y registra un post type en WP
  register_post_type(
    'recetas',                                // Nombre del post type (identificador para WP)
    array(                                    // Array de etiquetas
      'labels' => array(
          'name' => __( 'Recetas' ),          // Nombre del post type (para la vista)
          'singular_name' => __( 'Receta' )
      ),
      'public' => true,                       // El 'Post Type' va a ser público
      'has_archive' => true,                  // Para que pueda hacer uso del archivo 'archive.php'
    )
  );
}
// Hook: es la acción que permite identificar una funcionalidad por WP y donde se desea ejecutar
add_action(
  'init',                                     // Lugar donde queremos que se ejecute la funcionalidad
  'crear_post_type_recetas'                   // La funcionalidad o código a desplegar
);

?>
