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
    'xhr-resp-api-recetas-js',
    plugin_dir_url( __FILE__ ). '/js/xhr-rest-api-recetas.js'
  );

  /* Localiza una secuencia de comandos (Funciona solo si el script ya se ha agregado) */
	wp_localize_script(
		'xhr-resp-api-recetas-js',		                    // Nombre del Manejador de scripts que adjuntará WP a los datos
		'url_rest_api',									                  // Nombre para el Objeto JavaScript
		array(												                    // Datos que se pasarán al Objeto 'rest_url'
			'url' => rest_url( 'wp/v2/rest-api-recetas/' )	// rest_url() es una función de WordPress que recupera el URL a un 'endpoint' (punto de entrada final) REST para el sitio actual
		)
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
  # register_rest_field() Registra un nuevo campo de un tipo de Objeto existente en WordPress, para obtener el ID del POST ANTERIOR
  register_rest_field(
    'recetas',                                            # (string/array) Nombre del Post Type u Objeto(s) en el que se está registrando el campo
    'data_post_anterior',                                 # (string) Nombre de la llave o atributo
    array(                                                # (array) [Opcional] Argumentos utilizados para manejar el campo registrado
      'get_callback'    => 'get_id_receta_anterior',      # (string/Array/null) [Opcional] CallBack: Función que retorna el valor recuperado del campo. Valor por defecto: null, el campo no se devolverá en la respuesta
      'schema'          => null,                          # (string/Array/null) [Opcional] Función para crear un schema para este campo. El valor por defecto es: null, no se devolverá ningún schema
      'update_callback' => null                           # (string/Array/null) [Opcional] CallBack: Función para establecer o actualizar el valor del campo. Valor por defecto: null, el campo no se podrá establecer o actualizr el campo
    )
  );
  # register_rest_field() Registra un nuevo campo de un tipo de Objeto existente en WordPress, para obtener los datos de los METABOXES del Post Actual
  register_rest_field(
    'recetas',                                            # (string/array) Nombre del Post Type u Objeto(s) en el que se está registrando el campo
    'data_metaboxes',                                     # (string) Nombre de la llave o atributo
    array(                                                # (array) [Opcional] Argumentos utilizados para manejar el campo registrado
      'get_callback'    => 'get_metaboxes',               # (string/Array/null) [Opcional] CallBack: Función que retorna el valor recuperado del campo. Valor por defecto: null, el campo no se devolverá en la respuesta
      'schema'          => null,                          # (string/Array/null) [Opcional] Función para crear un schema para este campo. El valor por defecto es: null, no se devolverá ningún schema
      'update_callback' => null                           # (string/Array/null) [Opcional] CallBack: Función para establecer o actualizar el valor del campo. Valor por defecto: null, el campo no se podrá establecer o actualizr el campo
    )
  );
  # register_rest_field() Registra un nuevo campo de un tipo de Objeto existente en WordPress, para obtener los datos de las TAXONOMIAS del Post Actual
  register_rest_field(
    'recetas',                                            # (string/array) Nombre del Post Type u Objeto(s) en el que se está registrando el campo
    'data_taxonomies',                                    # (string) Nombre de la llave o atributo
    array(                                                # (array) [Opcional] Argumentos utilizados para manejar el campo registrado
      'get_callback'    => 'get_taxonomias',              # (string/Array/null) [Opcional] CallBack: Función que retorna el valor recuperado del campo. Valor por defecto: null, el campo no se devolverá en la respuesta
      'schema'          => null,                          # (string/Array/null) [Opcional] Función para crear un schema para este campo. El valor por defecto es: null, no se devolverá ningún schema
      'update_callback' => null                           # (string/Array/null) [Opcional] CallBack: Función para establecer o actualizar el valor del campo. Valor por defecto: null, el campo no se podrá establecer o actualizr el campo
    )
  );
  # register_rest_field() Registra un nuevo campo de un tipo de Objeto existente en WordPress, para obtener los TÉRMINOS DE LA TAXONOMÍA 'precio_receta' del Post Actual
  register_rest_field(
    'recetas',                                            # (string/array) Nombre del Post Type u Objeto(s) en el que se está registrando el campo
    'data_termino_precio',                                # (string) Nombre de la llave o atributo
    array(                                                # (array) [Opcional] Argumentos utilizados para manejar el campo registrado
      'get_callback'    => 'get_terminos_precio',         # (string/Array/null) [Opcional] CallBack: Función que retorna el valor recuperado del campo. Valor por defecto: null, el campo no se devolverá en la respuesta
      'schema'          => null,                          # (string/Array/null) [Opcional] Función para crear un schema para este campo. El valor por defecto es: null, no se devolverá ningún schema
      'update_callback' => null                           # (string/Array/null) [Opcional] CallBack: Función para establecer o actualizar el valor del campo. Valor por defecto: null, el campo no se podrá establecer o actualizr el campo
    )
  );
  # register_rest_field() Registra un nuevo campo de un tipo de Objeto existente en WordPress, para obtener los TÉRMINOS DE LA TAXONOMÍA 'tipo_receta' del Post Actual
  register_rest_field(
    'recetas',                                            # (string/array) Nombre del Post Type u Objeto(s) en el que se está registrando el campo
    'data_termino_tipo_receta',                           # (string) Nombre de la llave o atributo
    array(                                                # (array) [Opcional] Argumentos utilizados para manejar el campo registrado
      'get_callback'    => 'get_terminos_tipo_receta',    # (string/Array/null) [Opcional] CallBack: Función que retorna el valor recuperado del campo. Valor por defecto: null, el campo no se devolverá en la respuesta
      'schema'          => null,                          # (string/Array/null) [Opcional] Función para crear un schema para este campo. El valor por defecto es: null, no se devolverá ningún schema
      'update_callback' => null                           # (string/Array/null) [Opcional] CallBack: Función para establecer o actualizar el valor del campo. Valor por defecto: null, el campo no se podrá establecer o actualizr el campo
    )
  );
  # register_rest_field() Registra un nuevo campo de un tipo de Objeto existente en WordPress, para obtener los TÉRMINOS DE LA TAXONOMÍA 'horario_menu' del Post Actual
  register_rest_field(
    'recetas',                                            # (string/array) Nombre del Post Type u Objeto(s) en el que se está registrando el campo
    'data_termino_horario',                               # (string) Nombre de la llave o atributo
    array(                                                # (array) [Opcional] Argumentos utilizados para manejar el campo registrado
      'get_callback'    => 'get_terminos_horario',        # (string/Array/null) [Opcional] CallBack: Función que retorna el valor recuperado del campo. Valor por defecto: null, el campo no se devolverá en la respuesta
      'schema'          => null,                          # (string/Array/null) [Opcional] Función para crear un schema para este campo. El valor por defecto es: null, no se devolverá ningún schema
      'update_callback' => null                           # (string/Array/null) [Opcional] CallBack: Función para establecer o actualizar el valor del campo. Valor por defecto: null, el campo no se podrá establecer o actualizr el campo
    )
  );
  # register_rest_field() Registra un nuevo campo de un tipo de Objeto existente en WordPress, para obtener los TÉRMINOS DE LA TAXONOMÍA 'estado_animo' del Post Actual
  register_rest_field(
    'recetas',                                            # (string/array) Nombre del Post Type u Objeto(s) en el que se está registrando el campo
    'data_termino_estado',                                # (string) Nombre de la llave o atributo
    array(                                                # (array) [Opcional] Argumentos utilizados para manejar el campo registrado
      'get_callback'    => 'get_terminos_estado_animo',   # (string/Array/null) [Opcional] CallBack: Función que retorna el valor recuperado del campo. Valor por defecto: null, el campo no se devolverá en la respuesta
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

# CallBack: Recupera los metaboxes del Post Actual
function get_metaboxes() {
  global $post;                     # Obtiene el objeto del Post Actual y toda su información
  $post_id = $post -> ID;           # Asigna solo el ID del Post Actual
  return get_post_meta( $post_id ); # get_post_meta() Recupera el campo de meta del Post
}
/* NOTA: get_post_meta( $post_id, $key, $single )
         $post_id (int) ID del post
         $key:    (string) [Opcional] El meta (metabox) key para recuperar. Por defecto retorno el valor de todas las claves
         $single: (boolean) [Opcional] [true/false] Si se devuelve o no un solo valor. Valor por defecto> false
*/

# CallBack: Recupera las taxonomías del Post Actual
function get_taxonomias() {
  global $post;                           # Obtiene el objeto del Post Actual y toda su información
  return get_object_taxonomies( $post );  # get_object_taxonomies() Retorna los nombres u objetos de las taxonomías registradas en un Post determinado
}
/* NOTA: get_object_taxonomies( $object, $output )
         $object: (string/Array/WP_Post) Nombre del Objeto o Post de Taxonomía
         $output: (string) [Opcional] Salida a devolver en 'Array'. Acepta taxonomía 'names' y 'objects'. Valor por defecto: names
*/

# CallBack: Recupera los términos de la taxonomía 'precio_receta' del Post Actual
function get_terminos_precio() {
  global $post;
  $post_id = $post -> ID;
  return get_the_term_list(
    $post_id,        # ID del POST
    'precio_receta'  # Nombre de la taxonomía
  );
}

# CallBack: Recupera los términos de la taxonomía 'tipo_receta' del Post Actual
function get_terminos_tipo_receta() {
  global $post;
  $post_id = $post -> ID;
  return get_the_term_list(
    $post_id,       # ID del POST
    'tipo_receta'   # Nombre de la taxonomía
  );
}

# CallBack: Recupera los términos de la taxonomía 'horario_menu' del Post Actual
function get_terminos_horario() {
  global $post;
  $post_id = $post -> ID;
  return get_the_term_list(
    $post_id,       # ID del POST
    'horario_menu'  # Nombre de la taxonomía
  );
}

# CallBack: Recupera los términos de la taxonomía 'estado_animo' del Post Actual
function get_terminos_estado_animo() {
  global $post;
  $post_id = $post -> ID;
  return get_the_term_list(
    $post_id,       # ID del POST
    'estado_animo'  # Nombre de la taxonomía
  );
}

/* NOTA: get_the_term_list() Recupera los términos de una publicación como una lista con formato especificado
         get_the_term_list( $di, $taxonomy, $before, $separation, $after );
         $id         (int) Id del POST
         $taxonomy   (string) Nombre de la taxonomía
         $before     (string) [Opcional] Lo que se agregará antes de la lista de términos generados. Valor por defecto: ''
         $separation (string) [Opcional] Lo que separará a cada uno de los términos de la lista. Valor por defecto: ''
         $after      (string) [Opcional] Lo que se agregará despúes de la lista de términos generados. Valor por defecto: ''

         Si deseamos devolver los valores sin formato se puede hacer uso de la función de WordPress wp_get_post_terms()
         wp_get_post_terms( $post_id, $taxonomy, $args )
         $post_id    (int) Id del POST. Valor por defecto: 0
         $taxonomy   (string/Array) [Opcional] Nombre de la taxonomía. Valor por defecto: 'post_tag'
         $args       (Array) [Opcional] Parámetros de consulta de términos
            'fields' (string) Nombre de los campos de los terminos a recuperar. Valor por defecto: 'all'

         wp_get_post_terms(
           $post_id,       # ID del POST
           'estado_animo',  # Nombre de la taxonomía
           array(
             'fields' => 'names'
           )
*/

?>
