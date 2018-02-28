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

# Crea formulario, agrega zona y campos usando el plugin CMB2
function crea_formulario() {
  $prefix_form = 'form_';        # Prefijo Formulario

  # Crea Zona para Formulario
  $formulario = new_cmb2_box(
    array(
      'id'           => $prefix_form. 'enviar_receta',           # Nombre identificador de la Zona del Formulario
      'object_types' => array(                                   # Nombre del o los Post Types que van a usar los Metaboxes
        'page'                                                   # Páginas
      ),
      'hookup'        => false, # [true/false] Si se desea o NO enganchar/conectar y guardar (como borrador) los campos (o Metaboxes CMB2) en las vistas de uno o varios Post. Valor por defecto 'true'
      'save_fields'   => false  # [true/false] Si se desea o no guardar durante el enganchar/conectar (hookup). Valor por defecto 'true'
    )
  );

  # Agrega campo title: Encabezado del Formulario Receta (Separador)
  $formulario -> add_field(
    array(
      'id'      => 'encabezado_receta',                                        # Nombre Identificador del Campo 'ga_formulario_enviar_receta_titulo_receta'
      'type'    => 'title',                                                    # Tipo de campo CMB2: title
      'name'    => __( 'Datos Generales de la Receta:', 'cmb2' )               # Label del campo
    )
  );

  # Agrega campo text: Título de la Receta
  $formulario -> add_field(
    array(
      'id'      => 'titulo',                                                   # Nombre Identificador del Campo
      'type'    => 'text',                                                     # Tipo de campo CMB2: text
      'name'    => __( 'Nombre Receta:', 'cmb2' ),                             # Label del campo
      'desc'    => __( 'Título con el que aparecerá tú receta', 'cmb2' ),      # Descripción para el campo
      'default' => '',                                                         # Valor por defecto del campo
      'attributes' => array(                                                   # Agrega atributos al campo
        'placeholder' => 'Ej: Flan de limón'                                   # Convierte el input en un campo para subir archivos
      )
    )
  );

  # Agrega campo text: Subtítulo de la Receta
  $formulario -> add_field(
    array(
      'id'      => 'subtitulo',                                                # Nombre Identificador del Campo
      'type'    => 'text',                                                     # Tipo de campo CMB2: text
      'name'    => __( 'Subtítulo de la Receta:', 'cmb2' ),                    # Label del campo
      'desc'    => __( 'Subtítulo con el que aparecerá tú receta', 'cmb2' ),   # Descripción para el campo
      'default' => '',                                                         # Valor por defecto del campo
      'attributes' => array(                                                   # Agrega atributos al campo
        'placeholder' => 'Ej: El más suave y delicioso flan'                   # Convierte el input en un campo para subir archivos
      )
    )
  );

  # Agrega campo wysiwyg: Contenido de la Receta
  $formulario -> add_field(
    array(
      'id'      => 'contenido',                                                # Nombre Identificador del Campo 'ga_formulario_enviar_receta_titulo_receta'
      'type'    => 'wysiwyg',                                                  # Tipo de campo CMB2: wysiwyg (Editor WordPress)
      'name'    => __( 'Receta:', 'cmb2' ),                                    # Label del campo
      'desc'    => __( 'Contenido de la receta', 'cmb2' ),                     # Descripción para el campo
      'default' => '',                                                         # Valor por defecto del campo
      'options' => array(                                                      # Opciones para el textarea del campo wysiwyg del CMB2
         'textarea_rows' => 12,
         'media_buttons' => false                                              # Oculta el botón de agregar contenido multimedia
      )
    )
  );

  # Agrega campo text: Calorías de la Receta
  $formulario -> add_field(
    array(
      'id'      => 'calorias',                                                 # Nombre Identificador del Campo 'ga_formulario_enviar_receta_titulo_receta'
      'type'    => 'text',                                                     # Tipo de campo CMB2: text
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

  # Agrega campo text/file: Subtítulo de la Receta
  $formulario -> add_field(
    array(
      'id'      => 'imagen_destacada',                                         # Nombre Identificador del Campo 'ga_formulario_enviar_receta_titulo_receta'
      'type'    => 'text',                                                     # Tipo de campo CMB2: text/file
      'name'    => __( 'Imagen de la Receta:', 'cmb2' ),                       # Label del campo
      'desc'    => __( 'Selecciona una imagen del plato finalizado', 'cmb2' ), # Descripción para el campo
      'default' => '',                                                         # Valor por defecto del campo
      'attributes' => array(                                                   # Agrega atributos al campo
        'type' => 'file',                                                      # Convierte el input en un campo para subir archivos
      )
    )
  );

  # Agrega campo title: Encabezado del Información Extra Receta (Separador)
  $formulario -> add_field(
    array(
      'id'      => 'encabezado_informacion',                                   # Nombre Identificador del Campo 'ga_formulario_enviar_receta_titulo_receta'
      'type'    => 'title',                                                    # Tipo de campo CMB2: title
      'name'    => __( 'Información extra:', 'cmb2' )                          # Label del campo
    )
  );

  # Agrega campo taxonomy_select: Precio Receta
  $formulario -> add_field(
    array(
      'id'       => 'precio',                                                  # Nombre Identificador del Campo 'ga_formulario_enviar_receta_titulo_receta'
      'type'     => 'taxonomy_select',                                         # Tipo de campo CMB2: tipo taxonomy_select. Otras opciones disponibles: taxonomy_radio, taxonomy_radio_inline, taxonomy_multicheck, taxonomy_multicheck_inline
      'name'     => __( 'Precio:', 'cmb2' ),                                   # Label del campo
      'desc'     => __( 'Rango de precio aproximado de la receta', 'cmb2' ),   # Descripción para el campo
      'taxonomy' => 'precio_receta'                                            # Taxonomías que se van a desplegar en el campo
    )
  );

  # Agrega campo taxonomy_multicheck_inline: Encabezado del Formulario Receta (Separador)
  $formulario -> add_field(
    array(
      'id'       => 'tipo',                                                    # Nombre Identificador del Campo 'ga_formulario_enviar_receta_titulo_receta'
      'type'     => 'taxonomy_multicheck_inline',                              # Tipo de campo CMB2: tipo taxonomy_select. Otras opciones disponibles: taxonomy_radio, taxonomy_radio_inline, taxonomy_multicheck, taxonomy_multicheck_inline
      'name'     => __( 'Tipo de receta:', 'cmb2' ),                           # Label del campo
      'desc'     => __( 'Selecciona el tipo de receta', 'cmb2' ),              # Descripción para el campo
      'default'  => '',
      'taxonomy' => 'tipo_receta'                                              # Taxonomías que se van a desplegar en el campo
    )
  );

  # Agrega campo taxonomy_select: Horario Recomendado para la receta
  $formulario -> add_field(
    array(
      'id'       => 'horario',                                                 # Nombre Identificador del Campo 'ga_formulario_enviar_receta_titulo_receta'
      'type'     => 'taxonomy_select',                                         # Tipo de campo CMB2: tipo taxonomy_select. Otras opciones disponibles: taxonomy_radio, taxonomy_radio_inline, taxonomy_multicheck, taxonomy_multicheck_inline
      'name'     => __( 'Hora:', 'cmb2' ),                                     # Label del campo
      'desc'     => __( 'Recomienda una hora del día para preparar tú receta', 'cmb2' ), # Descripción para el campo
      'default'  => '',
      'taxonomy' => 'horario_menu'                                             # Taxonomías que se van a desplegar en el campo
    )
  );

  # Agrega campo taxonomy_select: Etiquetas Estado de Ánimo
  $formulario -> add_field(
    array(
      'id'      => 'estado',                                                   # Nombre Identificador del Campo 'ga_formulario_enviar_receta_titulo_receta'
      'type'    => 'text',                                                     # Tipo de campo CMB2: text
      'name'    => __( 'Etiquetas:', 'cmb2' ),                                 # Label del campo
      'desc'    => __( 'Agrega las etiquetas separadas por coma (,)', 'cmb2' ), # Descripción para el campo
      'default' => '',
      'taxonomy' => array(                                                     # Taxonomías que se van a desplegar en el campo
        'estado_animo'
      ),
      'attributes' => array(                                                   # Agrega atributos al campo
        'placeholder' => 'Ej: Para hacer en casa, Fiesta de niños, Alegría'    # Convierte el input en un campo para subir archivos
      )
    )
  );

  # Agrega campo title: Encabezado del Formulario Receta (Separador)
  $formulario -> add_field(
    array(
      'id'      => 'encabezado_autor',                                         # Nombre Identificador del Campo 'ga_formulario_enviar_receta_titulo_receta'
      'type'    => 'title',                                                    # Tipo de campo CMB2: title
      'name'    => __( 'Información del autor:', 'cmb2' )                      # Label del campo
    )
  );

  # Agrega campo text: Nombre del Autor de la Receta
  $formulario -> add_field(
    array(
      'id'      => 'autor',                                                    # Nombre Identificador del Campo 'ga_formulario_enviar_receta_titulo_receta'
      'type'    => 'text',                                                     # Tipo de campo CMB2: text
      'name'    => __( 'Nombre del Autor:', 'cmb2' ),                          # Label del campo
      'desc'    => __( 'Coloca tú nombre para atribuirte la receta', 'cmb2' ), # Descripción para el campo
      'default' => '',                                                         # Valor por defecto del campo
      'attributes' => array(                                                   # Agrega atributos al campo
        'placeholder' => 'Ej: Elisa María',                                    # Convierte el input en un campo para subir archivos
      )
    )
  );

  # Agrega campo text: Email del Autor de la Receta
  $formulario -> add_field(
    array(
      'id'      => 'email',                                                    # Nombre Identificador del Campo 'ga_formulario_enviar_receta_titulo_receta'
      'type'    => 'text_email',                                               # Tipo de campo CMB2: text
      'name'    => __( 'E-mail:', 'cmb2' ),                                    # Label del campo
      'desc'    => __( 'Coloca tú e-mail para contactarte en caso de ser necesario', 'cmb2' ), # Descripción para el campo
      'default' => '',                                                         # Valor por defecto del campo
      'attributes' => array(                                                   # Agrega atributos al campo
        'placeholder' => 'elisamaria@correo.co',                               # Convierte el input en un campo para subir archivos
      )
    )
  );

}
// Hook: es la acción que permite identificar una funcionalidad por WP y donde se desea ejecutar
add_action(
  'cmb2_init',        # Lugar donde queremos que se ejecute la funcionalidad dentro del Plugin CMB2
  'crea_formulario'   # La funcionalidad o código a desplegar
);

# Realiza la comunicación entre la función que crea el formulario y el que crea los campos del mismo
 function instancia_formulario() {
   $prefix_form = 'form_';        # Prefijo Formulario

   $metabox_id = $prefix_form. 'enviar_receta';  # ID de Objeto (ID Metabox)
   $object_id = 'fake-object-id';                # ID Falso del Objeto (Post a donde se va guardar)
                                                 # Tipo de objeto que se guarda: POST, USER, COMMENT, OPTIONS-PAGE.
                                                 # Se establece de forma predeterminada en el tipo de objeco Metabox (Retorna un objeto)
                                                 # CMB2 recomienda usar 'fake-object-id' (un objecto vacío). No aplica object-id ya que va a generar automáticamente al crearlo.
   return cmb2_get_metabox(
     $metabox_id,
     $object_id
   );
 }

 function crea_template_shortcode() {
     # Obtener una instancia del formulario
     $formulario = instancia_formulario();

     # Variable que contendrá Template
     $template_html = '';

     # Mensaje de notificación de ERROR en el formulario
     if ( ( $error = $formulario -> prop( 'submission_error' ) ) && is_wp_error( $error ) ) {
   		// If there was an error with the submission, add it to our ouput.
   		$template_html .= '<h4>' . sprintf( __( 'Hubo un error con el formulario: %s', 'ga_artist' ), '<strong>'. $error->get_error_message() .'</strong>' ) . '</h4>';    # Imprime Mensaje de Error
 	  }
    /* NOTA: prop() es una función del CMB2 que permite obtener la propiedad del metabox y opcionalmente establecer un respaldo
             'submission_error' propiedad para validar el envío correcto de un formulario CMB2
             is_wp_error() es una función de WordPress y comprueba si la variable es un ERROR de WordPress */

     # Mensaje de Notificación de Envio de Post Exitoso
     if ( isset( $_GET[ 'post_submitted' ] ) && ( $post = get_post( absint( $_GET[ 'post_submitted' ] ) ) ) ) {     # absint(): Valida que sea un valor entero absoluto

     		# Obtener el nombre del usuario proporcionado en el formulario
        $nombre = get_post_meta( # Recupera el campo del meta de publicación de un Post como 'Array'
          $post -> ID,           # (int) ID de publicación
          'autor_receta',        # (string) La meta clave para recuperar. Por defecto devuelve datos para todas las claves. Valor por defecto "". 'autor_receta' hace referencia al campo del formulario
          1                      # (bool) Si se devuelve o no un solo valor. Valor por defecto: false
        );
     		$nombre = $nombre ? ' '. $nombre : '';

     		$template_html .= '<h4>' . sprintf( __( 'Gracias %s tú receta ha sido agregada, una vez que pase la revisión será publicada', 'ga_artist' ), esc_html( $nombre ) ) . '</h4>';      # Imprime Mensaje de Éxito
     	}
      /* NOTA: get_post_meta() recupera campo del meta de publicación de un Post como 'Array' si $single es false. Será el valor del campo de metadatos si $single es true.
               get_post_type() recupera el tipo de publicación de un Post Actual o un Post Determinado (int/WP_Post/null $post = null). Valor por defecto: null
               get_error_message() Recibe un solo mensaje de error. Obtendrá el primer mensaje disponible para el código. Si no se proporciona el código, se usará el primer código disponible (string/ int $code = '') */

     # Agrega el formulario al TEMPLATE
     $template_html .= cmb2_get_metabox_form(
       $formulario,            # "Instancia del Formulario"
       'fake-object-id',       # ID Falso del Objeto (Post a donde se va guardar)
       array(                  # Agrega el botón para envia el Formulario
         'save_button' => 'Enviar Receta'
       )
     );

     return $template_html;
 }
 # ShortCode: Agrega un Hook para una etiqueta tipo 'Abreviación o código corto'
 add_shortcode(
   'formulario-enviar-receta',             # Nombre de la etiqueta que identificará al ShortCode
   'crea_template_shortcode'               # La funcionalidad o código a desplegar
 );

 function insertar_receta() {
   # En caso de que no se envíe los datos del formulario no ejecutar nada.
   if( empty( $_POST ) || !isset( $_POST[ 'submit-cmb' ], $_POST[ 'object_id' ] ) ) {       # Sí el Post viene vacío o Sí No se ha enviado el formulario o Sí no se ha enviado el ID del Post (ID del Objeto)
       return false;     # Detiene el envío (Validación y envío a Base de Datos)
   }

   # Obtener una instancia del formulario
   $formulario = instancia_formulario();

   # Crea un 'Array' para compilar el contenido del Post
   $post_data = array();

   /*** AUTENTICA EL FORMULARIO ***/
   # Validar el NONCE de Seguridad (Token de Seguridad en WP): Es un HASH usado para proteger las URL y formularios de ciertos tipos de usos indebidos, maliciosos o de otro tipo.
   if( !isset( $_POST[ $formulario -> nonce() ] ) || !wp_verify_nonce( $_POST[ $formulario -> nonce() ], $formulario -> nonce() ) ) {       # Validamos nuestra instancia
       return $formulario -> prop( 'submission_error', new WP_Error( 'security_fail', 'Fallo en la seguridad del formulario' ) );           # Si no es valido devuelve la propiedad que contiene los errores
   }
   /* NOTA: wp_verify_nonce() función de WordPress para validar el NONCE frente a WordPress */

   /*** VALIDA LOS CAMPOS DEL FORMULARIO ***/
   # Valida que exista un título de receta
   if( empty( $_POST[ 'titulo' ] ) ) {                                                                                               # Valida que el campo 'titulo_receta' del formulario no se encuentre vacío al envío del mismo
       return $formulario -> prop( 'submission_error', new WP_Error( 'post_data_missing', 'Se requiere un titulo para el post' ) );         # Si no es valido devuelve la propiedad que contiene los errores
   }

   /*** SANITIZAR LOS DATOS ***/
   $valores_formulario = $formulario -> get_sanitized_values( $_POST );
   #echo '<pre>'; var_dump( $valores_formulario ); echo '</pre>';

   # Agrega los valores al 'Array' a la variable $post_data (vacía)
   $post_data[ 'post_title' ] = $valores_formulario[ 'titulo' ];        # Asigna el valor
   unset( $valores_formulario[ 'titulo' ] );                            # Elimina el valor del 'Array'
   $post_data[ 'post_subtitle' ] = $valores_formulario[ 'subtitulo' ];  # Asigna el valor
   unset( $valores_formulario[ 'subtitulo' ] );                         # Elimina el valor del 'Array'
   $post_data[ 'post_content' ] = $valores_formulario[ 'contenido' ];   # Asigna el valor
   unset( $valores_formulario[ 'contenido' ] );                         # Elimina el valor del 'Array'
   $post_data[ 'post_calorias' ] = $valores_formulario[ 'calorias' ];   # Asigna el valor
   unset( $valores_formulario[ 'calorias' ] );                          # Elimina el valor del 'Array'
   $post_data[ 'post_author' ] = $valores_formulario[ 'autor' ];        # Asigna el valor
   unset( $valores_formulario[ 'autor' ] );                             # Elimina el valor del 'Array'
   $post_data[ 'post_email' ] = $valores_formulario[ 'email' ];         # Asigna el valor
   unset( $valores_formulario[ 'email' ] );                             # Elimina el valor del 'Array'

   # Agrega los valores de las TAXONOMÍAS del 'Array' a la variable $post_data (vacía)
   $post_data[ 'tax_input' ] = array(
     'precio_receta' => $valores_formulario[ 'precio' ],                # Asigna el Valor
     'horario_menu'  => $valores_formulario[ 'horario' ],               # Asigna el Valor
     'tipo_receta'   => $valores_formulario[ 'tipo' ],                  # Asigna el Valor
     'estado_animo'  => explode( ',', $valores_formulario[ 'estado' ] ) # Asigna el Valor
   );

   unset( $valores_formulario[ 'precio' ] );                             # Elimina el valor del 'Array'
   unset( $valores_formulario[ 'horario' ] );                            # Elimina el valor del 'Array'
   unset( $valores_formulario[ 'tipo' ] );                               # Elimina el valor del 'Array'
   unset( $valores_formulario[ 'estado' ] );                             # Elimina el valor del 'Array'

   echo '<pre>'; var_dump( $post_data ); echo '</pre>';
   echo '<pre>'; var_dump( $valores_formulario ); echo '</pre>';

 }

 // Hook: es la acción que permite identificar una funcionalidad por WP y donde se desea ejecutar
 add_action(
   'cmb2_after_init',        # Lugar donde queremos que se ejecute la funcionalidad dentro del Plugin CMB2
   'insertar_receta'         # La funcionalidad o código a desplegar
 );
 ?>
