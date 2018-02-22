$ = jQuery .noConflict();

$( document ) .ready( function() {

    $.ajax({
      url: admin_url .url,                      // Accedemos al archivo 'xhr-admin.php' y todas las funciones que posee a través del nombre del Objeto 'admin_url'
      type: 'post',
      data: {
        action: 'sugerencia_recetas_horario'    // Nombre de la función que deseamos acceder
      }
    }) .done( function( response ) {
      console .log( response );
    });

});
