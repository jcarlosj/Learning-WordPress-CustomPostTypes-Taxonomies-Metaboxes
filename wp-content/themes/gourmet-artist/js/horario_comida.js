$ = jQuery .noConflict();

$( document ) .ready( function() {

    // Obtener la fecha que registra el usuario en su dispositivo
    var fecha = new Date(),
        hora  = fecha .getHours(),
        sugerencia = '';

    //console .log( fecha );

    // Valida la hora para obtener el mensaje de sugerencia
    if( hora <= 10 ) {
      sugerencia = 'desayunar';
    }
    else if( hora <= 17 ) {
      sugerencia = 'almorzar';
    }
    else {
      sugerencia = 'cenar';
    }

    // Consulta datos usando AJAX para desplegarlo en la vista
    $.ajax({
      url: admin_url .url,                      // Accedemos al archivo 'xhr-admin.php' y todas las funciones que posee a través del nombre del Objeto 'admin_url'
      type: 'post',
      data: {
        action: 'sugerencia_recetas_' + sugerencia  // Nombre de la función que deseamos acceder
      }
    }) .done( function( response ) {
      //console .log( response );

      $( '#hora' ) .append( sugerencia );

      /* Recorremos el 'Array' de Objetos para acceder a cada uno de ellos */
      $.each( response, function( index, object ) {
        var template = `
          <div class="medium-4 small-12 columns">
            <a href="${ object .enlace }">
              ${ object .imagen }
              <div class="contenido">
                <h3>
                  ${ object .titulo }
                </h3>
              </div>
            </a>
          </div>
        `;

        //console .log( object );

        // Despliega datos en la vista
        $( '#sugerencia-recetas-horario' ) .append( template );

      });
    });

});
