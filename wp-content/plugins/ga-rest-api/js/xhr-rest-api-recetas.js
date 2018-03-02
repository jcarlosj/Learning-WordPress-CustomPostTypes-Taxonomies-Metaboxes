/* Crea Scroll Infinito con WP REST API y AJAX
 * para la publicación del Post Anterior al hacer Scroll Vertical */
$ = jQuery .noConflict();

$( document ) .ready( function() {
  var url = url_rest_api .url;
  console .log( url );

  // Publica un post al realizar desplazamiento vertical
  function scroll_post() {
    // Obtiene el último elemento 'a' con la clase 'receta_anterior'
    var ultimoElementoA = $( '.receta-anterior' ) .last();

    // Valida si el elemento existe en el DOM
    if( ultimoElementoA .length > 0 ) {
      // Calcula la distancia que se debe recorrer haciendo 'scroll'
      distanciaARecorrer = ultimoElementoA .offset() .top - $( window ) .outerHeight();

      // Dispara el evento desplazamiento en la ventana
      $( window ) .scroll( function( event ) {
        //console .log( `Distancia vertical recorrida: ${ $( window ) .scrollTop() }` );

        // Valida si la distancia que se debe recorrer es mayor a la distancia recorrida
        if( distanciaARecorrer > $( window ) .scrollTop() ) {
          console .log( 'No' );

          return;                   // Evita que continue la ejecución del script
        }
        else {
          console .log( 'Sí' );
          load_previous_post();     // Carga Post Anterior
        }

      });
    }
    else {

      return;                       // Evita que continue la ejecución del script
    }
    /* NOTA:  last() función de jQuery que obtiene último el elemento con la clase 'receta_anterior' (enlace 'Receta Anterior')
              $( window ) Representa las propiedades de la ventana del navegador
              offset() obtiene las coordenadas actuales del de uno o varios elementos relativo al DOM en pixeles, retorna un objeto con las propiedades: top, left
              outerHeight() obtiene la distancia que hay entre el alto exterior de la ventana, incluida barra de herramientas y barras de desplazamiento
              scrollTop() obtiene la coordenada vertical de la ventana relativa a la pantalla
              scroll() controlador de eventos de jQuery asociado al evento 'scroll' de JavaScript, que activa el evento cuando el usuario se desplaza a un lugar diferente en el elemento asociado
    */
  }
  // Llamada a la funcionalidad
  scroll_post();

  // Carga el Post Anterior
  function load_previous_post() {
    // Obtiene el ID del último elemento 'a' con la clase 'receta_anterior'
    var idUltimoElementoA = $( '.receta-anterior' ) .last() .attr( 'data-receta-anterior' ),
        json_url = url + idUltimoElementoA;

    //console .log( json_url );

    $.ajax({
      dataType: 'json',
      url: json_url,
    }) .done( function( response ) {
      template_post( response );
    });

    function template_post( data ) {
      console .log( data );
    }

  }
});
