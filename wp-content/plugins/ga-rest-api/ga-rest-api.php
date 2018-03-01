<?php
  /*
   Plugin Name: Gourmet Artist REST API
   Plugin URI:
   Description: Agrega REST API al sitio Gourmet Artist
   Version: 1.0
   Author: Juan Carlos Jiménez Gutiérrez
   Author URI:
   License: GPL2
   License URI: https://www.gnu.org/licenses/gpl-2.0.html
   */

function rest_api_scripts() {
  /* Implementa archivo JavaScript para el Manejo de Datos con AJAX en WordPress (Horario Comida) en 'index.php' */
  wp_enqueue_script(
    'resp-api-recetas-js',
    plugin_dir_url( __FILE__ ). '/js/rest-api-recetas.js'
  );
}
add_action( 'wp_enqueue_scripts', 'rest_api_scripts' );
/* NOTA: plugin_dir_url() Obtiene la ruta del directorio de URL
        __FILE__ Directorio actual */
?>
