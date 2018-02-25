/* */
$ = jQuery .noConflict();

$( document ) .ready( function() {

  // Valida si el elemento con la clase 'filtra-recetas' existe
  if( $( '.filtra-recetas' ) .length ) {
    // Aplica la funcionalidad del Plugin al elemento
    $( '.filtra-recetas' ) .filterizr();
  }

  //
  $( '.simplefilter li' ) .on( 'click', function() {
    //console .log( $( this )[ 0 ] );
    $( '.simplefilter li' ) .removeClass( 'active' );
    $( this ) .addClass( 'active' );
  });
});

//#content #primary main ul.simplefilter li:active
