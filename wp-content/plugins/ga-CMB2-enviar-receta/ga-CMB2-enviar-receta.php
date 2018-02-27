<?php
/*
 Plugin Name: Gourmet Artist CMB2 v2.3.0 - Enviar Recetas
 Plugin URI:
 Description: Agrega funcionalidad de Enviar Receta (Post) desde el FrontEnd, hace uso del plugin <strong>CMB2 v2.3.0</strong>
 Version: 1.0
 Author: Juan Carlos Jiménez Gutiérrez
 Author URI:
 License: GPL2
 License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

 # Crea formulario para enviar recetas desde el FrontEnd usando un ShortCode
 function formulario_enviar_receta() {
   echo 'Hola soy el futuro formulario para enviar recetas :P';
 }
 # ShortCode: Agrega un Hook para una etiqueta tipo 'Abreviación o código corto'
 add_shortcode(
   'formulario-enviar-receta',             # Nombre de la etiqueta que identificará al ShortCode
   'formulario_enviar_receta'              # La funcionalidad o código a desplegar
 );
 ?>
