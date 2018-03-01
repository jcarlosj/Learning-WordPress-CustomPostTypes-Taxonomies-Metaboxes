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
// Hook: es la acción que permite identificar una funcionalidad por WP y donde se desea ejecutar
add_action(
  'wp_enqueue_scripts',       # Lugar donde queremos que se ejecute la funcionalidad. En este caso antes de obtener los posts de la página del sitio
  'rest_api_scripts'          # La funcionalidad o código a desplegar
);
/* NOTA: plugin_dir_url() Obtiene la ruta del directorio de URL
        __FILE__ Directorio actual */

# Agrega toda la funcionalidad relacionada con la REST API WordPress
function rest_api() {
  # register_rest_field() Registra un nuevo campo de un tipo de Objeto existente en WordPress, para obtener el ID del Post Anterior
  register_rest_field(
    'recetas',                                            # (string/array) Nombre del Post Type u Objeto(s) en el que se está registrando el campo
    'data_post_anterior',                                 # (string) Nombre de la llave o atributo
    array(                                                # (array) [Opcional] Argumentos utilizados para manejar el campo registrado
      'get_callback'    => 'get_id_receta_anterior',      # (string/Array/null) [Opcional] CallBack: Función que retorna el valor recuperado del campo. Valor por defecto: null, el campo no se devolverá en la respuesta
      'schema'          => null,                          # (string/Array/null) [Opcional] Función para crear un schema para este campo. El valor por defecto es: null, no se devolverá ningún schema
      'update_callback' => null                           # (string/Array/null) [Opcional] CallBack: Función para establecer o actualizar el valor del campo. Valor por defecto: null, el campo no se podrá establecer o actualizr el campo
    )
  );
  # register_rest_field() Registra un nuevo campo de un tipo de Objeto existente en WordPress, para obtener los datos de los Metaboxes del Post Actual
  register_rest_field(
    'recetas',                                            # (string/array) Nombre del Post Type u Objeto(s) en el que se está registrando el campo
    'data_metaboxes',                                     # (string) Nombre de la llave o atributo
    array(                                                # (array) [Opcional] Argumentos utilizados para manejar el campo registrado
      'get_callback'    => 'get_id_post_actual',          # (string/Array/null) [Opcional] CallBack: Función que retorna el valor recuperado del campo. Valor por defecto: null, el campo no se devolverá en la respuesta
      'schema'          => null,                          # (string/Array/null) [Opcional] Función para crear un schema para este campo. El valor por defecto es: null, no se devolverá ningún schema
      'update_callback' => null                           # (string/Array/null) [Opcional] CallBack: Función para establecer o actualizar el valor del campo. Valor por defecto: null, el campo no se podrá establecer o actualizr el campo
    )
  );
}
// Hook: es la acción que permite identificar una funcionalidad por WP y donde se desea ejecutar
add_action(
  'rest_api_init',            # Lugar donde queremos que se ejecute la funcionalidad. En este caso antes de obtener los posts de la página del sitio
  'rest_api'                  # La funcionalidad o código a desplegar
);

# CallBack: Recupera el ID del Post Anterior
function get_id_receta_anterior() {
  return get_previous_post() -> ID;
}

function get_id_post_actual() {
  global $post;                     # Obtiene el objeto del Post Actual y toda su información
  $post_id = $post -> ID;           # Asigna solo el ID del Post Actual
  return get_post_meta( $post_id ); # get_post_meta() Recupera el campo de meta del Post
}
/* NOTA: get_post_meta( $post_id, $key, $single )
         $post_id (int) ID del post
         $key:    (string) [Opcional] El meta (metabox) key para recuperar. Por defecto retorno el valor de todas las claves
         $single: (boolean) [Opcional] [true/false] Si se devuelve o no un solo valor. Valor por defecto> false
*/

?>
