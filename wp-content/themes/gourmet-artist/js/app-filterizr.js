/* */
$ = jQuery .noConflict();

$( document ) .ready( function() {
  // Valida si el elemento con la clase 'filtra-recetas' existe
  if( $( '.filtra-recetas' ) .length ) {
    // Aplica la funcionalidad del Plugin al elemento
    $( '.filtra-recetas' ) .filterizr();
  }
});
