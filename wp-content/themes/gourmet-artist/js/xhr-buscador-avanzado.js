/* Funcionalidad del JavaScript para el Buscador Avanzado */
$ = jQuery .noConflict();

$( document ) .ready( function() {

  // Evento para el Botón Buscar
  $( '#btn-buscar' ) .on( 'click', function() {

    var termino = $( '#buscar' ) .val();    // Obtiene el valor contenido por el elemento con el ID 'buscar'
    console .log( 'termino a buscar: ', termino );

    // Consulta datos usando AJAX para desplegarlo en la vista
    $.ajax({
      url: admin_url .url,                          // Accedemos al archivo 'xhr-admin.php' y todas las funciones que posee a través del nombre del Objeto 'admin_url'
      type: 'post',
      data: {
        action: 'buscar_resultados',  // Nombre de la función que deseamos acceder
        buscar: termino
      }
    }) .done( function( response ) {
      console .log( response );             // Respuesta

    });

  });
});
