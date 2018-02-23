<?php
/*
 Plugin Name: Gourmet Artist CMB2 v2.3.0
 Plugin URI:
 Description: Agrega plugin <strong>CMB2 v2.3.0</strong> como plugin personalizado para crear 'Metaboxes' al sitio Gourmet Artist
 Version: 1.0
 Author: Juan Carlos Jiménez Gutiérrez
 Author URI:
 License: GPL2
 License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

 # Valida que el directorio del Plugin que deseamos integrar al plugin personalizado existe
 if( file_exists( dirname( __FILE__ ). '/CMB2/init.php' ) ) {
   # Hacemos el llamado al archivo que se encarga de inicializar la funcionalidad del Plugin CMB2
   require_once( dirname( __FILE__ ). '/CMB2/init.php' );
 }

 # Conecta el plugin CMB2 al plugin personalizado
 function registrar_campos_eventos() {
   $prefix = 'ga_campos_eventos_';        # Prefijo para registrar los campos

   # Agregar Zona para los Metaboxes
   $metabox_eventos = new_cmb2_box(
     array(
       'id'           => $prefix. 'metabox',                      // Nombre identificador de la Zona del Metabox
       'title'        => __( 'Campos Eventos - CMB2', 'cmb2' ),   // Título del campo
       'object_types' => array(                                   // Nombre del o los Post Types que van a usar los Metaboxes
         'eventos'
       )
     )
   );

   # Agrega campo Ciudad
   $metabox_eventos -> add_field(
     array(
       'id'      => $prefix. 'ciudad',                                          # Nombre Identificador del Campo 'ga_campos_eventos_ciudad'
       'type'    => 'text',                                                     # Tipo de campo CMB2: input de tipo text
       'name'    => __( 'Ciudad:', 'cmb2' ),                                    # Label del campo
       'desc'    => __( 'Ciudad en la que se realizará el evento', 'cmb2' ),    # Descripción para el campo
       'default' => ''                                                          # Valor por defecto del campo
     )
   );

   # Agrega campo Lugares disponibles
   $metabox_eventos -> add_field(
     array(
       'id'      => $prefix. 'lugares',                                   # Nombre Identificador del Campo 'ga_campos_eventos_lugares'
       'type'    => 'text',                                               # Tipo de campo CMB2: input de tipo text
       'name'    => __( 'Lugares disponibles:', 'cmb2' ),                 # Label del campo
       'desc'    => __( 'Lugares disponibles para el evento', 'cmb2' ),   # Descripción para el campo
       'default' => ''                                                    # Valor por defecto del campo
     )
   );

   # Agrega campo Fecha del Evento
   $metabox_eventos -> add_field(
     array(
       'id'      => $prefix. 'fecha',                                                     # Nombre Identificador del Campo 'ga_campos_eventos_fecha'
       'type'    => 'text_datetime_timestamp',                                            # Tipo de campo CMB2: 2 input para Fecha y hora
       'name'    => __( 'Fecha del evento:', 'cmb2' ),                                    # Label del campo
       'desc'    => __( 'Fecha del evento en la que se realizará el evento', 'cmb2' ),    # Descripción para el campo
       'default' => ''                                                                    # Valor por defecto del campo
     )
   );

   # Agrega campo Temas que se van atratar en el evento
   $metabox_eventos -> add_field(
     array(
       'id'      => $prefix. 'temas',                                           # Nombre Identificador del Campo 'ga_campos_eventos_temas'
       'type'    => 'text',                                                     # Tipo de campo CMB2: 2 input de tipo text
       'name'    => __( 'Temas:', 'cmb2' ),                                     # Label del campo
       'desc'    => __( 'Temas que se van a tratar en el evento', 'cmb2' ),     # Descripción para el campo
       'default' => '',                                                         # Valor por defecto del campo
       'repeatable' => true
     )
   );

 }
 // Hook: es la acción que permite identificar una funcionalidad por WP y donde se desea ejecutar
 add_action(
   'cmb2_admin_init',                   // Lugar donde queremos que se ejecute la funcionalidad dentro del Plugin CMB2
   'registrar_campos_eventos'           // La funcionalidad o código a desplegar
 );

# Consulta Pŕoximos Eventos
function mostrar_proximos_eventos( $titulo ) {  # 'titulo' propiedad a la que se pasa un valor dentro del ShorCode
  /* Personalizamos la consulta */
  $args = array(
    'post_type'      => 'eventos',                  # Elegimos el tipo de entradas que deseamos publicar
    'meta_key'       => 'ga_campos_eventos_fecha',  # (string) Nombre Identificador del Campo
    'meta_query'     => array(                      # (array) Contiene una o más 'Arrays' con con claves para consulta
      array(
        'key' => 'ga_campos_eventos_fecha',         # (string) Llave que se desea comparar
        'value' => time(),                          # (string/array) Hora Actual. Puede ser un 'Array' cuando la comparación es: IN, NOT IN, BETWEEN, NOT BETWEEN
        'compare' => '>=',                          # (string) Operador para comparar (Sus valores puede ser: =, !=, >, >=, <, <=, LIKE, NOT LIKE, IN, NOT, REGEXP, NOT REGEXP, RLIKE)
        'type' => 'NUMERIC'                         # Tipo de Campo Personalizado (Sus valores pueden ser: NUMERIC, BINARY, CHAR, DATE, DATETIME, DECIMAL, SIGNED, TIME, UNSIGNED)
      )
    ),
    'orderby'        => 'meta_value',               # Valor personalizado En este caso hace referencia a: 'value' => time() del 'meta_query'
    'order'          => 'ASC',                      # Orden de la publicación (Descendente)
    'posts_per_page' => -1                          # Cantidad de publicaciones por página (-1) Todos
  );

  /* Realiza la consulta WP_Query */
  $eventos = new WP_Query( $args );

  echo '<h2 class="text-center">' .$titulo[ 'titulo' ]. '</h2>';  # 'titulo' Imprime propiedad a la que se pasa un valor dentro del ShorCode

  # Imprime las entradas requeridas
  while( $eventos -> have_posts() ):
    $eventos -> the_post();

    echo '<h4 class="text-center">' .get_the_title(). '</h4>';

  endwhile; wp_reset_postdata();
}
# ShortCode: Agrega un Hook para una etiqueta tipo 'Abreviación o código corto'
add_shortcode(
  'proximos-eventos',             # Nombre de la etiqueta que identificará al ShortCode
  'mostrar_proximos_eventos'      # La funcionalidad o código a desplegar
);

?>
