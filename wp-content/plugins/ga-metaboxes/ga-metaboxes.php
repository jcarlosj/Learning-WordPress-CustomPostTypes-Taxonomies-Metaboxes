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

// Crea la zona donde se despliegan los campos para el Metabox 'ga-metaboxes'
function zona_ga_metaboxes( $post ) {
  # wp_nonce_field(): Valida que el contenido de la solicitud del formulario proviene de la ubicación en el sitio actual y no en otro.
  wp_nonce_field(
    basename( __FILE__ ),
    'meta-box-nonce'        // Nombre del Nonce o del campo del formulario oculto que se creará. Vaor predeterminado: _wpnonce
  );

  $opciones_calificacion = array( 1, 2, 3, 4, 5 );

  echo '
    <div>
      <label for="input-metabox">Calorías: </label>
      <input name="input-metabox" type="text" />
      </br>
      <label for="textarea-metabox">Subtítulo de la receta: </label>
      <textarea name="textarea-metabox"></textarea>
      </br>
      <label for="dropdown-metabox">Calificación</label>
      <select name="dropdown-metabox">
  ';

        foreach ( $opciones_calificacion as $key => $opcion ) {
            echo '<option value="' .$opcion. '">' .$opcion. '</option>';
        }

  echo '
      </select>
    </div>
  ';

}

?>