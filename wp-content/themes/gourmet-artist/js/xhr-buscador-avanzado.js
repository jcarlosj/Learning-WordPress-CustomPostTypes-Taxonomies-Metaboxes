/* Funcionalidad del JavaScript para el Buscador Avanzado */
$ = jQuery .noConflict();

$( document ) .ready( function() {

  // Evento para el Botón Buscar
  $( '#btn-buscar' ) .on( 'click', function() {

    var termino = $( '#buscar' ) .val();    // Obtiene el valor contenido por el elemento con el ID 'buscar'
    console .log( 'termino a buscar: ', termino );
    $( '#termino-buscado div' ) .remove();         // Elimina lo que esté desplegado en cada busqueda

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

      // Recorre el 'Array' para obtener cada uno de los datos
      $.each( response, function( index, object ) {
        // Crea una plantilla para formatear los datos
        template = `
          <div class="row">
            <div class="medium-4 small-12 columns">
              ${ object .imagen }
            </div>
            <div class="medium-8 columns contenido">
              <a href="${ object .enlace }">
                <h3 class="text-center">${ object .titulo }</h3>
              </a>
              <p>${ object .contenido } ... </p>
              <a href="${ object .enlace }" class="button">Leer más</a>
            </div>
          </div>
        `;

        // Despliega el resultado en la vista
        $( '#termino-buscado' ) .append( template );  // Despliega la plantilla con los datos
      });

    });

  });
});
