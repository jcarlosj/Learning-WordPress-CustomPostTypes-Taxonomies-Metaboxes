<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Gourmet_Artist
 */

get_header(); ?>

	<?php /* Orbit Foundation (Slider) */
		get_template_part( 'template-parts/slider' );
	?>

	<!-- TERMINOS -->
	<!-- Menú Terminos -->
	<?php
		# Obtenemos los terminos de una taxonomía específica 'tipo_receta'
		$terminos = get_terms(
			array(
				'taxonomy' => 'tipo_receta'
			)
		);
	?>

	<div id="filtra-terminos" class"row">
		<ul class="menu">
			<?php
				# Recorremos cada uno de los términos
				foreach ($terminos as $key => $termino ) :
					# Imprime cada término dentro de un elemento li
					echo '<li>
									<a href="#' .$termino -> slug. '">'
										.$termino -> name .
									'</a>
								</li>';
				endforeach;
			?>
		</ul>		<!-- .menu -->

		<div id="recetas">
			<?php
				# Recorremos cada uno de los términos
				foreach ($terminos as $key => $termino ) :
					mostrar_post_type_recetas_por_tipo_receta( $termino -> slug );
				endforeach;
			?>
		</div>	<!-- .recetas -->

	</div>	<!-- .filtra-terminos -->

	<!-- FIN - TERMINOS -->

	<div id="primary" class="content-area medium-8 columns">
		<span class="file">index.php</span>
		<main id="main" class="site-main">

			<h2 class="ultimas-recetas text-center">Últimas Recetas</h2>

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop */

			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile; wp_reset_postdata();

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
