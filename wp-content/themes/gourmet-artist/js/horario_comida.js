$ = jQuery .noConflict();

$( document ) .ready( function() {

    // Consulta datos usando AJAX para desplegarlo en la vista
    $.ajax({
      url: admin_url .url,                      // Accedemos al archivo 'xhr-admin.php' y todas las funciones que posee a través del nombre del Objeto 'admin_url'
      type: 'post',
      data: {
        action: 'sugerencia_recetas_horario'    // Nombre de la función que deseamos acceder
      }
    }) .done( function( response ) {
      //console .log( response );

      /* Recorremos el 'Array' de Objetos para acceder a cada uno de ellos */
      $.each( response, function( index, object ) {
        var template = `
          <div class="medium-4 small-12 columns">
            ${ object .imagen }
            <div class="contenido">
              <h3>
                <a href="${ object .enlace }">${ object .titulo }</a>
              </h3>
            </div>
          </div>
        `;

        console .log( object );

        // Despliega datos en la vista
        $( '#sugerencia-recetas-horario' ) .append( template );

      });
    });

});
