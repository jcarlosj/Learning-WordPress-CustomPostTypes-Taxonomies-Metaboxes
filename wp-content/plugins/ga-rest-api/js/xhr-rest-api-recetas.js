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
          $( this ) .off( event );  // Función de jQuery para eliminar el manejador de eventos, creado con el método on()
                                    // ó en nuestro caso manejador incluido en la línea 20, donde se dispara un evento scroll
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
        json_url = `${ url }${ idUltimoElementoA }?&_embed=true`;
    /* NOTA: Agregarle ?&_embed=true al final de la URL habilita dentro del objeto la propiedad (_embedded) que permite acceder a las imagenes del Post y todos sus tamaños disponibles en WordPress */

    //console .log( json_url );

    $.ajax({
      dataType: 'json',
      url: json_url,
    }) .done( function( response ) {
      template_post( response );
    });

    function template_post( data ) {
      console .log( data );

      // Crea plantilla y despliega los datos del Post
      template_html = `
        <article class="row">
            <span class="file">xhr-rest-api-recetas.js</span>
            <h1 class="entry-title text-center">${ data .title .rendered }</h1>
            <img class="attachment-post-thumbnail size-post-thumbnail wp-post-image" src="${ data . _embedded[ 'wp:featuredmedia' ][ 0 ] .media_details .sizes[ 'slider-image' ] .source_url }" />
            <div>
              <div class="entry-content">
                 <div class="taxonomy">
                    <div class="hora-comida">
                      Hora de plato: ${ data .data_termino_horario }
                    </div>
                    <div class="tipo-comida">
                      Tipo de plato: ${ data .data_termino_tipo_receta }
                    </div>
                    <div class="rango-precio">
                      Rango precio: ${ data .data_termino_precio }
                    </div>
                    <div class="estado-animo">
                      Estado de ánimo: ${ data .data_termino_estado }
                    </div>
                 </div>

                 <div class="informacion-extra">
                    <div class="calorias">
                      <p>Calorías: ${ data .data_metaboxes[ 'input-metabox' ] }</p>
                    </div>
                    <div class="calificacion">
                      <p>Calificación: ${ data .data_metaboxes[ 'dropdown-metabox' ] }</p>
                    </div>
                    <div class="subtitulo">
                      <blockquote> ${ data .data_metaboxes[ 'textarea-metabox' ] } </blockquote>
                    </div>
                 </div>
                 ${ data .content .rendered }

                <a class="receta-anterior" href="#" data-receta-anterior="${ data .data_post_anterior }" >Receta Anterior</a>

              </div><!-- .entry-content -->
          </div>

        </article>
      `;

      // Inserta el contenido (plantilla y datos) al final de cada elemento en el conjunto de elementos coincidentes
      $( 'article.recetas' ) .append( template_html );

      // Volvemos a Carga el Post Anterior (Por que detuvimos el evento y necesitamos reiniciarlo)
      scroll_post();

    }

  }
});
