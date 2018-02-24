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
			<ul class="simplefilter menu row">
				<?php foreach ( $terminos as $key => $termino ): ?>
					<?php echo '<li data-filter="' .$termino -> term_taxonomy_id. '">' .$termino -> name. '</li>'; ?>
				<?php endforeach; ?>
			</ul>

		</main><!-- #main -->
	</div><!-- #primary -->
	
<?php
get_footer();
