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
   # Obtiene el ID del Formulario para Imprimir el formulario en la Vista del Post

   $id_formulario = instancia_formulario_enviar_receta();

   $output = '';

   $output .= cmb2_get_metabox_form(
     $id_formulario,         # ID del formulario
     'fake-object-id',       # ID Falso del Objeto (Post a donde se va guardar)
     array(                  # Agrega el botón para envia el Formulario
       'save_button' => 'Enviar Receta'
     )
   );

   return $output;
 }
 # ShortCode: Agrega un Hook para una etiqueta tipo 'Abreviación o código corto'
 add_shortcode(
   'formulario-enviar-receta',             # Nombre de la etiqueta que identificará al ShortCode
   'formulario_enviar_receta'              # La funcionalidad o código a desplegar
 );

# Realiza la comunicación entre la función que crea el formulario y el que crea los campos del mismo
 function instancia_formulario_enviar_receta() {
   $prefix = 'ga_formulario_';        # Prefijo para registrar los campos

   $metabox_id = $prefix. 'enviar_receta';  # ID de Objeto (ID Metabox)
   $object_id = 'fake-object-id';           # ID Falso del Objeto (Post a donde se va guardar)
                                            # Tipo de objeto que se guarda: POST, USER, COMMENT, OPTIONS-PAGE.
                                            # Se establece de forma predeterminada en el tipo de objeco Metabox (Retorna un objeto)
                                            # CMB2 recomienda usar 'fake-object-id' (un objecto vacío). No aplica object-id ya que va a generar automáticamente al crearlo.

   return cmb2_get_metabox(
     $metabox_id,
     $object_id
   );
 }

 # Crea los campos del formulario usando el plugin CMB2
 function crea_formulario() {
   $prefix = 'ga_formulario_';        # Prefijo para registrar los campos

   # Crea Zona para Formulario
   $formulario_recetas = new_cmb2_box(
     array(
       'id'           => $prefix. 'enviar_receta',                # Nombre identificador de la Zona del Formulario
       'object_types' => array(                                   # Nombre del o los Post Types que van a usar los Metaboxes
         'page'                                                   # Páginas
       ),
       'hookup'        => false, # [true/false] Si se desea o NO enganchar/conectar y guardar (como borrador) los campos (o Metaboxes CMB2) en las vistas de uno o varios Post. Valor por defecto 'true'
       'save_fields'   => false  # [true/false] Si se desea o no guardar durante el enganchar/conectar (hookup). Valor por defecto 'true'
     )
   );

   # Agrega campo 'Nombre Receta'
   $formulario_recetas -> add_field(
     array(
       'id'      => 'titulo_receta',                                            # Nombre Identificador del Campo 'ga_formulario_enviar_receta_titulo_receta'
       'type'    => 'text',                                                     # Tipo de campo CMB2: input de tipo text
       'name'    => __( 'Nombre Receta:', 'cmb2' ),                             # Label del campo
       'desc'    => __( 'Título con el que aparecerá tú receta', 'cmb2' ),      # Descripción para el campo
       'default' => ''                                                          # Valor por defecto del campo
     )
   );

 }
 // Hook: es la acción que permite identificar una funcionalidad por WP y donde se desea ejecutar
 add_action(
   'cmb2_init',        # Lugar donde queremos que se ejecute la funcionalidad dentro del Plugin CMB2
   'crea_formulario'   # La funcionalidad o código a desplegar
 );
 ?>
