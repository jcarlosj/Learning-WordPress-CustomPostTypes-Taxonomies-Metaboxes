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

   # Mensaje de notificación de ERROR en el formulario
   if( ( $error = $id_formulario -> prop( 'submission_error' ) ) && is_wp_error( $error ) ) {
     # Mensaje de Error
     $output .= '<h3>' .sprintf( __( 'Hubo un error: %s', 'ga_artist' ) , '<strong>' .$error -> get_error_message(). '</strong>' ).  '</h3>';     # Imprime Mensaje
   }
   /* NOTA: prop() es una función del CMB2 que permite obtener la propiedad del metabox y opcionalmente establecer un respaldo
            'submission_error' propiedad para validar el envío correcto de un formulario CMB2
            is_wp_error() es una función de WordPress y comprueba si la variable es un ERROR de WordPress */

   # Mensaje de Notificación de Envio de Post Exitoso
   if( isset( $_GET[ 'post_submitted' ] ) && ( $post = get_post( $_GET[ 'post_submmited' ] ) ) ) {
     # Obtener el nombre del usuario
     $nombre = get_post_meta( # Recupera el campo del meta de publicación de un Post como 'Array'
       $post -> ID,           # (int) ID de publicación
       'autor_receta',        # (string) La meta clave para recuperar. Por defecto devuelve datos para todas las claves. Valor por defecto "". 'autor_receta' hace referencia al campo del formulario
       1                      # (bool) Si se devuelve o no un solo valor. Valor por defecto: false
     );
     $nombre = $nombre ? ' ' .$nombre : '';
     # abs(): Valor Absoluto
     $output .= '<h3>' .sprintf( __( 'Gracias %s, tú receta ha sido agregada, una ves pase la revisión será publicada', 'ga_artist' ) , esc_html( $nombre ) ). '</h3>';     # Imprime Mensaje
   }
   /* NOTA: get_post_meta() recupera campo del meta de publicación de un Post como 'Array' si $single es false. Será el valor del campo de metadatos si $single es true.
            get_post_type() recupera el tipo de publicación de un Post Actual o un Post Determinado (int/WP_Post/null $post = null). Valor por defecto: null
             get_error_message() Recibe un solo mensaje de error. Obtendrá el primer mensaje disponible para el código. Si no se proporciona el código, se usará el primer código disponible (string/ int $code = '') */

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

   # Agrega campo title: Encabezado del Formulario Receta (Separador)
   $formulario_recetas -> add_field(
     array(
       'id'      => 'encabezado_receta',                                        # Nombre Identificador del Campo 'ga_formulario_enviar_receta_titulo_receta'
       'type'    => 'title',                                                    # Tipo de campo CMB2: input de tipo text
       'name'    => __( 'Datos Generales de la Receta:', 'cmb2' )               # Label del campo
     )
   );

   # Agrega campo input: Título de la Receta
   $formulario_recetas -> add_field(
     array(
       'id'      => 'titulo_receta',                                            # Nombre Identificador del Campo 'ga_formulario_enviar_receta_titulo_receta'
       'type'    => 'text',                                                     # Tipo de campo CMB2: input de tipo text
       'name'    => __( 'Nombre Receta:', 'cmb2' ),                             # Label del campo
       'desc'    => __( 'Título con el que aparecerá tú receta', 'cmb2' ),      # Descripción para el campo
       'default' => ''                                                          # Valor por defecto del campo
     )
   );

   # Agrega campo input: Subtítulo de la Receta
   $formulario_recetas -> add_field(
     array(
       'id'      => 'subtitulo_receta',                                         # Nombre Identificador del Campo 'ga_formulario_enviar_receta_titulo_receta'
       'type'    => 'text',                                                     # Tipo de campo CMB2: input de tipo text
       'name'    => __( 'Subtítulo de la Receta:', 'cmb2' ),                    # Label del campo
       'desc'    => __( 'Súbtítulo con el que aparecerá tú receta', 'cmb2' ),   # Descripción para el campo
       'default' => ''                                                          # Valor por defecto del campo
     )
   );

   # Agrega campo wysiwyg/textarea: Contenido de la Receta
   $formulario_recetas -> add_field(
     array(
       'id'      => 'contenido_receta',                                         # Nombre Identificador del Campo 'ga_formulario_enviar_receta_titulo_receta'
       'type'    => 'wysiwyg',                                                  # Tipo de campo CMB2: input de tipo wysiwyg/textarea (Editor WordPress)
       'name'    => __( 'Receta:', 'cmb2' ),                                    # Label del campo
       'desc'    => __( 'Contenido de la receta', 'cmb2' ),                     # Descripción para el campo
       'default' => '',                                                         # Valor por defecto del campo
       'options' => array(                                                      # Opciones para el textarea del campo wysiwyg del CMB2
          'textarea_rows' => 12,
          'media_buttons' => false                                              # Oculta el botón de agregar contenido multimedia
       )
     )
   );

   # Agrega campo input: Calorías de la Receta
   $formulario_recetas -> add_field(
     array(
       'id'      => 'calorias_receta',                                          # Nombre Identificador del Campo 'ga_formulario_enviar_receta_titulo_receta'
       'type'    => 'text',                                                     # Tipo de campo CMB2: input de tipo text
       'name'    => __( 'Calorías:', 'cmb2' ),                                  # Label del campo
       'desc'    => __( 'Número aproximado de calorías de la receta', 'cmb2' ), # Descripción para el campo
       'default' => '',                                                         # Valor por defecto del campo
       'attributes' => array(                                                   # Agrega atributos al campo
         'placeholder' => 'Ej: 500',
         'type'        => 'number',
         'min'         => '0',
         'max'         => '10000'
       )
     )
   );

   # Agrega campo input: Subtítulo de la Receta
   $formulario_recetas -> add_field(
     array(
       'id'      => 'imagen_destacada',                                         # Nombre Identificador del Campo 'ga_formulario_enviar_receta_titulo_receta'
       'type'    => 'text',                                                     # Tipo de campo CMB2: input de tipo text/file
       'name'    => __( 'Imagen de la Receta:', 'cmb2' ),                       # Label del campo
       'desc'    => __( 'Selecciona una imagen del plato finalizado', 'cmb2' ), # Descripción para el campo
       'default' => '',                                                         # Valor por defecto del campo
       'attributes' => array(                                                   # Agrega atributos al campo
         'type' => 'file',                                                      # Convierte el input en un campo para subir archivos
       )
     )
   );

   # Agrega campo text/file: Encabezado del Información Extra Receta (Separador)
   $formulario_recetas -> add_field(
     array(
       'id'      => 'encabezado_informacion_extra_receta',                      # Nombre Identificador del Campo 'ga_formulario_enviar_receta_titulo_receta'
       'type'    => 'title',                                                    # Tipo de campo CMB2: input de tipo title
       'name'    => __( 'Información extra:', 'cmb2' )                          # Label del campo
     )
   );

   # Agrega campo taxonomy_select: Encabezado del Formulario Receta (Separador)
   $formulario_recetas -> add_field(
     array(
       'id'      => 'precio_receta',                                            # Nombre Identificador del Campo 'ga_formulario_enviar_receta_titulo_receta'
       'type'    => 'taxonomy_select',                                          # Tipo de campo CMB2: tipo taxonomy_select. Otras opciones disponibles: taxonomy_radio, taxonomy_radio_inline, taxonomy_multicheck, taxonomy_multicheck_inline
       'name'    => __( 'Precio:', 'cmb2' ),                                    # Label del campo
       'desc'    => __( 'Rango de precio aproximado de la receta', 'cmb2' ),    # Descripción para el campo
       'default' => '',
       'taxonomy' => array(                                                     # Taxonomías que se van a desplegar en el campo
         'precio_receta'
       )
     )
   );

   # Agrega campo taxonomy_multicheck_inline: Encabezado del Formulario Receta (Separador)
   $formulario_recetas -> add_field(
     array(
       'id'      => 'tipo_receta',                                              # Nombre Identificador del Campo 'ga_formulario_enviar_receta_titulo_receta'
       'type'    => 'taxonomy_multicheck_inline',                               # Tipo de campo CMB2: tipo taxonomy_select. Otras opciones disponibles: taxonomy_radio, taxonomy_radio_inline, taxonomy_multicheck, taxonomy_multicheck_inline
       'name'    => __( 'Tipo de receta:', 'cmb2' ),                            # Label del campo
       'desc'    => __( 'Selecciona el tipo de receta', 'cmb2' ),               # Descripción para el campo
       'default' => '',
       'taxonomy' => array(                                                     # Taxonomías que se van a desplegar en el campo
         'tipo_receta'
       )
     )
   );

   # Agrega campo taxonomy_select: Encabezado del Formulario Receta (Separador)
   $formulario_recetas -> add_field(
     array(
       'id'      => 'horario_menu_receta',                                      # Nombre Identificador del Campo 'ga_formulario_enviar_receta_titulo_receta'
       'type'    => 'taxonomy_select',                                          # Tipo de campo CMB2: tipo taxonomy_select. Otras opciones disponibles: taxonomy_radio, taxonomy_radio_inline, taxonomy_multicheck, taxonomy_multicheck_inline
       'name'    => __( 'Hora:', 'cmb2' ),                                      # Label del campo
       'desc'    => __( 'Recomienda una hora del día para tú receta', 'cmb2' ), # Descripción para el campo
       'default' => '',
       'taxonomy' => array(                                                     # Taxonomías que se van a desplegar en el campo
         'horario_menu'
       )
     )
   );

   # Agrega campo taxonomy_select: Encabezado del Formulario Receta (Separador)
   $formulario_recetas -> add_field(
     array(
       'id'      => 'etiquetas_receta',                                         # Nombre Identificador del Campo 'ga_formulario_enviar_receta_titulo_receta'
       'type'    => 'text',                                                     # Tipo de campo CMB2: tipo taxonomy_select. Otras opciones disponibles: taxonomy_radio, taxonomy_radio_inline, taxonomy_multicheck, taxonomy_multicheck_inline
       'name'    => __( 'Etiquetas:', 'cmb2' ),                                 # Label del campo
       'desc'    => __( 'Agrega las etiquetas separadas por coma (,)', 'cmb2' ), # Descripción para el campo
       'default' => '',
       'taxonomy' => array(                                                     # Taxonomías que se van a desplegar en el campo
         'estado_animo'
       )
     )
   );

   # Agrega campo title: Encabezado del Formulario Receta (Separador)
   $formulario_recetas -> add_field(
     array(
       'id'      => 'encabezado_autor_receta',                                  # Nombre Identificador del Campo 'ga_formulario_enviar_receta_titulo_receta'
       'type'    => 'title',                                                    # Tipo de campo CMB2: input de tipo text
       'name'    => __( 'Información del autor:', 'cmb2' )                      # Label del campo
     )
   );

   # Agrega campo input: Subtítulo de la Receta
   $formulario_recetas -> add_field(
     array(
       'id'      => 'autor_receta',                                             # Nombre Identificador del Campo 'ga_formulario_enviar_receta_titulo_receta'
       'type'    => 'text',                                                     # Tipo de campo CMB2: input de tipo text/file
       'name'    => __( 'Nombre del Autor:', 'cmb2' ),                          # Label del campo
       'desc'    => __( 'Coloca tú nombre para atribuirte la receta', 'cmb2' ), # Descripción para el campo
       'default' => '',                                                         # Valor por defecto del campo
       'attributes' => array(                                                   # Agrega atributos al campo
         'placeholder' => 'Ej: Juan Carlos Jiménez Gutiérrez',                  # Convierte el input en un campo para subir archivos
       )
     )
   );

   # Agrega campo input: Subtítulo de la Receta
   $formulario_recetas -> add_field(
     array(
       'id'      => 'correo_autor_receta',                                      # Nombre Identificador del Campo 'ga_formulario_enviar_receta_titulo_receta'
       'type'    => 'text_email',                                               # Tipo de campo CMB2: input de tipo text/file
       'name'    => __( 'E-mail:', 'cmb2' ),                                    # Label del campo
       'desc'    => __( 'Coloca tú e-mail para contactarte en caso de ser necesario', 'cmb2' ), # Descripción para el campo
       'default' => '',                                                         # Valor por defecto del campo
       'attributes' => array(                                                   # Agrega atributos al campo
         'placeholder' => 'elautor@tucorreo.co',                                # Convierte el input en un campo para subir archivos
       )
     )
   );

 }
 // Hook: es la acción que permite identificar una funcionalidad por WP y donde se desea ejecutar
 add_action(
   'cmb2_init',        # Lugar donde queremos que se ejecute la funcionalidad dentro del Plugin CMB2
   'crea_formulario'   # La funcionalidad o código a desplegar
 );
 ?>
