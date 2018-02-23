<?php
/*
 Plugin Name: Gourmet Artist Metaboxes
 Plugin URI:
 Description: Agrega 'Metaboxes' al sitio Gourmet Artist
 Version: 1.0
 Author: Juan Carlos Jiménez Gutiérrez
 Author URI:
 License: GPL2
 License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// Crea un metaboxes
function crear_metaboxes() {
  add_meta_box(
    'ga-metaboxes',         // (string) Nombre del Metabox (Metabox ID)
    'Nuestro Metabox',      // Título del cuadro del Meta
    'zona_ga_metaboxes',    // Callback: Función que va a ejecutar el diseño de los cuadros que se van a agregar
    'recetas',              // (string/ array/WP_Screen) Screen: Representa el Post Type en donde se van a mostrar los cuadros
    'normal',               // (Opcional) [advanced, normal, side] Lugar donde deberían nostrarse los cuadros. Valor por defecto: advanced
    'high',                 // (Opcional) [high, low] Prioridad en la que deberían mostrarse los cuadros. Valor por defecto: default
    null                    // (Opcional) Calback Argument: Datos que se establecen como prioridad de la matriz del cuadros (segundo parámetro
                            //            que se pasa a la devolución de la llamada). Valor por defecto: default
  );
}
// Hook: es la acción que permite identificar una funcionalidad por WP y donde se desea ejecutar
add_action(
  'add_meta_boxes',                   // Lugar donde queremos que se ejecute la funcionalidad
  'crear_metaboxes'                   // La funcionalidad o código a desplegar
);

// Crea la función que guarda los valores de los campos del metabox creado 'ga-metaboxes'
function guardar_metaboxes( $post_id, $post, $update ) {

  # Inicializa campos del metabox 'ga-metabox' vacíos
  $input_metabox = '';
  $textarea_metabox = '';
  $dropdown_metabox = '';

  /*** AGREGA SEGURIDAD A LOS CAMPOS DEL METABOX ***/
  # PRIMERO: Valida que la información del formulario NO proviene del propio sitio
  #          Validando el campo oculto creado 'meta-box-nonce' y no provenga de un ataque
  if( !isset( $_POST[ 'meta-box-nonce' ] ) || !wp_verify_nonce( $_POST[ 'meta-box-nonce' ], basename( __FILE__ ) ) ) {
    return $post_id;
  }
  /* NOTA: Con el método WP 'wp_verify_nonce()' verifica que el campo oculto del formulario se ejecute dentro del sitio en un tiempo determinado
           wp_verify_nonce(
              $_POST[ 'meta-box-nonce' ],   // (string) Nombre del 'Nonce', campo oculto (o Token) que se usa para verificar la autencidad del Formulario dentro del sitio
              basename( __FILE__ )          // (string/int) Da el contexto en el que se debe hacer dicha verificación. Lugar donde se creó el 'Nonce', campo oculto (o Token)
           );
   */

  # SEGUNDO: Valida si el usuario tiene permisos para editar el Post
  if( !current_user_can( 'edit_post', $post_id ) ) {
    return $post_id;
  }
  /* NOTA: Con el método WP 'current_user_can()' verifica si el usuario actual tiene una capacidad o permiso específico
           current_user_can(
              'edit_post',    // (string) Nombre de la capacidad o permiso que se desea verificar
              $post_id        // (int) ID del objeto específico que se desea comprobar. En este caso el ID del Post.
           );
   */


  # TERCERO: defined es una variable global de WordPress
  if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
    return $post_id;
  }
  /* NOTA: Con el método 'defined()' de PHP se comprueba si existe una constante con nombre dada */

  /*** VALIDA Y AGREGA LOS VALORES DE LOS CAMPOS DEL METABOX A LA BASE DE DATOS ***/

  # Valida si el campo 'input_metabox' tiene un valor para actualizar
  if( isset( $_POST[ 'input-metabox' ] ) ) {
    $input_metabox = $_POST[ 'input-metabox' ];       # Asigna el valor
  }
  # Actualiza el valor del campo en la Base de datos de WordPress
  update_post_meta(
    $post_id,           # ID de la entrada (o Post)
    'input-metabox',    # Nombre del campo del METABOX
    $input_metabox      # Valor del campo que se va a actualizar
  );

  # Valida si el campo 'textarea_metabox' tiene un valor para actualizar
  if( isset( $_POST[ 'textarea-metabox' ] ) ) {
    $textarea_metabox = $_POST[ 'textarea-metabox' ]; # Asigna el valor
  }
  # Actualiza el valor del campo en la Base de datos de WordPress
  update_post_meta(
    $post_id,              # ID de la entrada (o Post)
    'textarea-metabox',    # Nombre del campo del METABOX
    $textarea_metabox      # Valor del campo que se va a actualizar
  );

  if( isset( $_POST[ 'dropdown-metabox' ] ) ) {
    $dropdown_metabox = $_POST[ 'dropdown-metabox' ]; # Asigna el valor
  }
  # Actualiza el valor del campo en la Base de datos de WordPress
  update_post_meta(
    $post_id,              # ID de la entrada (o Post)
    'dropdown-metabox',    # Nombre del campo del METABOX
    $dropdown_metabox      # Valor del campo que se va a actualizar
  );
}
// Hook: es la acción que permite identificar una funcionalidad por WP y donde se desea ejecutar
add_action(
  'save_post',                         // Lugar donde queremos que se ejecute la funcionalidad
  'guardar_metaboxes',                 // La funcionalidad o código a desplegar
  10,                                  // Prioridad
  3                                    // Cantidad de parámetros que le vamos a pasar a la función en nuestro caso 'guardar_metaboxes' ( $post_id, $post, $update )
);

// Crea la zona donde se despliegan los campos para el Metabox 'ga-metaboxes'
function zona_ga_metaboxes( $post ) {
  # wp_nonce_field(): Valida que el contenido de la solicitud del formulario proviene de la ubicación en el sitio actual y no en otro.
  wp_nonce_field(
    basename( __FILE__ ),
    'meta-box-nonce'        // Nombre del Nonce o del campo del formulario oculto que se creará. Vaor predeterminado: _wpnonce
  );

  $calificacion = array( 1, 2, 3, 4, 5 );

  echo '
    <div>
      <label for="input-metabox">Calorías: </label>
      <input name="input-metabox" type="text" value="' .get_post_meta( $post -> ID, 'input-metabox', true ). '" />
      </br>
      <label for="textarea-metabox">Subtítulo de la receta: </label>
      <textarea name="textarea-metabox">
        ' .get_post_meta( $post -> ID, 'textarea-metabox', true ). '
      </textarea>
      </br>
      <label for="dropdown-metabox">Calificación</label>
      <select name="dropdown-metabox">
  ';

        foreach ( $calificacion as $key => $opcion ) {
          # Valida si existe un valor ya seleccionado desde la base de datos
          if( $opcion == get_post_meta( $post -> ID, 'dropdown-metabox', true ) ) {
            echo '<option value="' .$opcion. '" selected>' .$opcion. '</option>';     # Agrega el atributo de seleccionado a la opción que viene de la Base de Datos de WordPress
          }
          else {
            echo '<option value="' .$opcion. '">' .$opcion. '</option>';
          }

        }

  echo '
      </select>
    </div>
  ';

  /* NOTA: Con el método WP 'get_post_meta()'' se obtienen los valores de los metaboxes de cada uno de los campos
           get_post_meta(
              $post -> ID,          // ID del Post al que pertenece el Metabox
              'input-metabox',      // Nombre del campo del formulario al que hace referencia el valor
              true                  // [true/false] True si retorna uno o más valores
           );
   */

}

?>
