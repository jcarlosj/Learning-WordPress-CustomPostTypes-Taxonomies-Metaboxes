$ = jQuery .noConflict();

$( document ) .ready( function() {

    /*** Limpiamos todos los campos del Formulario Enviar Receta (Cualquiera de las 3 opciones funciona)  ***/
    //document .getElementById( 'form_enviar_receta' ) .reset();
    //$( '#form_enviar_receta' )[ 0 ] .reset();    // Evita que al darle atrás al navegador se guarden los valores insertados en los campos con anterioridad
    $( '#form_enviar_receta' ) .trigger( 'reset' );

    $( document ) .foundation();

    /*** Orbit Foundation (Slider) ***/
    var element = $( '.orbit' );

    /* Funciones predefinidas de Orbit Foundation (Slider) */
    var options = {
      animInFromLeft  : 'fade-in',
      animInFromRight : 'fade-in',
      animOutToLeft   : 'fade-out',
      animOutToRight  : 'fade-out',
      timerDelay      : 5000
    }

    /* Creamos la instancia Orbit Foundation (Slider) */
    var slider = new Foundation .Orbit( element, options );

    /*** Filtrar Recetas por Taxonomía y términos al hacer click sobre el Menú (tipo_receta) ***/

    $( '#recetas > div' ) .not( ':first' ) .hide();                         // Ocultar todas las recetas menos la primera
    $( '#content #filtra-terminos .menu-center ul li:first-child' ) .addClass( 'active' );     // Selecciona el

    // Evento 'click' a los enlaces del menú (Tipo Receta)
    $( '#filtra-terminos .menu a' ) .on( 'click', function() {
      var enlace = $( this ) .attr( 'href' );   // Obtiene el atributo 'href' del enlace al que se le hace click

      console .log( enlace );

      $( '#content #filtra-terminos .menu-center ul li' ) .removeClass( 'active' );
      $( this ) .parent() .addClass( 'active' );

      // Oculta todos las recetas
      $( '#recetas > div' ) .hide();    // Con > se selecciona el elemento hijo de primer nivel (todos los div seguidos del padre #recetas)

      // Muestra las recetas que pertenecen a la Taxonomía al que se le hace click
      $( enlace ) .fadeIn();

      return false;     // Elimina el salto producido por el # (ancla) en el enlace
    });

});
