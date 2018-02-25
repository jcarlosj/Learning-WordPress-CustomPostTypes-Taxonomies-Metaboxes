<?php
/**
 * Template Name: Buscador Recetas
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Gourmet_Artist
 */

get_header(); ?>

	<div id="primary" class="content-area columns">
		<main id="main" class="site-main" role="main">
			<span class="file">page-buscador-recetas.php</span>
			<?php
				# Obtenemos los terminos de una taxonomía específica 'tipo_receta'
				$terminos = get_terms(
					array(
						'taxonomy' => 'tipo_receta'
					),
					array(
						'hide_empty' => false					// [true/false] Oculta o NO los términos de la taxonomía que están vacías
					)
				);
			?>
			<ul class="simplefilter menu">
				<li class="active" data-filter="all">Todos</li>

				<?php foreach ( $terminos as $key => $termino ): ?>
					<?php echo '<li data-filter="' .$termino -> term_taxonomy_id. '">' .$termino -> name. '</li>'; ?>
				<?php endforeach; ?>
			</ul>

			<?php

				# Creamos los argumentos de la consulta que deseamos hacer a WordPress
	      $args = array(
	        'post_type'      => 'recetas',   				# Nombre del 'Post Type' (Se puede ver en la URL del ADMIN)
	        'posts_per_page' => -1,                 # Cantidad de registros a mostrar por página (-1 significa imprimirlos todos
	        'orderby'        => 'title',            # Ordenar por: Fecha de publicación, orden alfabético, Author etc.
	        'order'          => 'ASC'              # Tipo de orden: Ascendente, Descendente
	      );
	      #
	      $recetas = new WP_Query( $args );          # Hacemos la consulta usando el 'WP_Query' y pasamos los argumentos de la misma

				if( $recetas -> have_posts() ) :
			?>
				<div class="filtra-recetas row">
						<div class="small-up-2 medium-up-3 large-up-4">

							<?php while ( $recetas -> have_posts() ): $recetas -> the_post();    # Creamos un loop para imprimir los valores traidos por la consulta ?>
								<?php
									$terminos = wp_get_post_terms(					# Obtiene cada uno de los términos que estén asociados al post que se le pasa
										get_the_ID(),													# ID del Post Type
										'tipo_receta'													# Nombre de la Taxonomía que posee los términos que deseamos obtener
									);

									//echo '<pre>'; var_dump( $terminos ); echo '</pre>';
								?>
								<div class="column filtr-item" data-category=<?php echo $terminos[ 0 ] -> term_taxonomy_id; ?> >
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail( 'entry-image' ); ?>
										<p class="text-center"><?php the_title(); ?></p>
									</a>
								</div>

					    <?php endwhile; ?>

						</div>
				</div>

		<?php endif; ?>

		<?php wp_reset_postdata(); # Solo usamos 'wp_reset_postdata()' cuando se use el 'WP_Query()' ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
