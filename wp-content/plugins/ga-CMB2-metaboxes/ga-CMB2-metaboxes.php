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
 }
 // Hook: es la acción que permite identificar una funcionalidad por WP y donde se desea ejecutar
 add_action(
   'cmb2_admin_init',                   // Lugar donde queremos que se ejecute la funcionalidad dentro del Plugin CMB2
   'registrar_campos_eventos'           // La funcionalidad o código a desplegar
 );

?>
