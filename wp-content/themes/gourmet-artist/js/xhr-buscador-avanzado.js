/* */
$ = jQuery .noConflict();

$( document ) .ready( function() {

  // Evento para el Botón Buscar
  $( '#btn-buscar' ) .on( 'click', function() {
    alert( 'Hey! amigo me has pulsado' );
  });
});
