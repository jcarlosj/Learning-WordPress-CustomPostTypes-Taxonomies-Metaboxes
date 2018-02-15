$ = jQuery .noConflict();

$( document ) .ready( function() {

    $( document ) .foundation();

    /* Orbit Foundation (Slider) */
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

});
