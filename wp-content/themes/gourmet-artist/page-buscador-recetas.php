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

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

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
      while ( $recetas -> have_posts() ): $recetas -> the_post();    # Creamos un loop para imprimir los valores traidos por la consulta
    ?>

      <?php the_title(); ?><br />

    <?php endwhile; wp_reset_postdata(); # Solo usamos 'wp_reset_postdata()' cuando se use el 'WP_Query()' ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
