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
       'id'      => $prefix. 'ciudad',
       'type'    => 'text',
       'name'    => __( 'Ciudad:', 'cmb2' ),
       'desc'    => __( 'Ciudad en la que se realizará el evento', 'cmb2' ),
       'default' => ''
     )
   );

   # Agrega campo Lugares disponibles
   $metabox_eventos -> add_field(
     array(
       'id'      => $prefix. 'lugares',
       'type'    => 'text',
       'name'    => __( 'Lugares disponibles:', 'cmb2' ),
       'desc'    => __( 'Lugares disponibles para el evento', 'cmb2' ),
       'default' => ''
     )
   );

   # Agrega campo Fecha del Evento
   $metabox_eventos -> add_field(
     array(
       'id'      => $prefix. 'fecha',
       'type'    => 'text_datetime_timestamp',
       'name'    => __( 'Fecha del evento:', 'cmb2' ),
       'desc'    => __( 'Fecha del evento en la que se realizará el evento', 'cmb2' ),
       'default' => ''
     )
   );

   # Agrega campo Temas que se van atratar en el evento
   $metabox_eventos -> add_field(
     array(
       'id'      => $prefix. 'temas',
       'type'    => 'text',
       'name'    => __( 'Temas:', 'cmb2' ),
       'desc'    => __( 'Temas que se van a tratar en el evento', 'cmb2' ),
       'default' => '',
       'repeatable' => true
     )
   );

   # Agrega Campos a la Zona de Metaboxes
   /*
   $metabox_eventos -> add_field(
     array(
       'name' => __( 'Ciudad', 'cmb2' ),                                    // Nombre del campo
       'desc' => __( 'Ciudad en la que se realizará el evento', 'cmb2' ),   // Descripción del campo
       'id'   => $prefix. 'ciudad'                                          // Nombre identificador del campo del Metabox
     )
   );*/
 }
 // Hook: es la acción que permite identificar una funcionalidad por WP y donde se desea ejecutar
 add_action(
   'cmb2_admin_init',                   // Lugar donde queremos que se ejecute la funcionalidad dentro del Plugin CMB2
   'registrar_campos_eventos'           // La funcionalidad o código a desplegar
 );

?>
