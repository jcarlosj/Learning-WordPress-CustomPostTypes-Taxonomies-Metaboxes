<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Gourmet_Artist
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php gourmet_artist_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">

		<?php if( 'recetas' == get_post_type() ): ?>

				<div class="taxonomy">
					 <div class="hora-comida">
						 <?php
							 // Obtiene el listado de términos de una taxonomía, de acuerdo a una publicación indicada a través de su ID
							 echo get_the_term_list(
									$post -> ID,									// ID de la publicación
									'horario_menu',							// Taxonomía registrada que contiene los términos
									'Hora de plato: ', 					// Lo que se desea Imprimir antes de los términos
									', ', 												// Lo que se desea Imprimir como separador de los términos
									'' 													// Lo que se desea Imprimir después de los términos
							 );
						 ?>
					 </div>
					 <div class="tipo-comida">
						 <?php
							 // Obtiene el listado de términos de una taxonomía, de acuerdo a una publicación indicada a través de su ID
							 echo get_the_term_list(
									$post -> ID,									// ID de la publicación
									'tipo_receta',						    // Taxonomía registrada que contiene los términos
									'Tipo de plato: ', 					// Lo que se desea Imprimir antes de los términos
									', ', 												// Lo que se desea Imprimir como separador de los términos
									'' 										      // Lo que se desea Imprimir después de los términos
							 );
						 ?>
					 </div>
				</div>		<!-- .taxonomy -->

		<?php endif; # if( 'recetas' == get_post_type() ) ?>

		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php gourmet_artist_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
