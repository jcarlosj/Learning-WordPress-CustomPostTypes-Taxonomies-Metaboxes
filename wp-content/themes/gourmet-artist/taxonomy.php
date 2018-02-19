<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Gourmet_Artist
 */

get_header(); ?>
taxonomy.php
	<div id="primary" class="content-area medium-8 columns">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				  // Sin usar las funciones de 'UnderScore Theme', al estilo WordPress
					$termino_actual = get_queried_object();													// Obtiene el término Actual
					$taxonomia      = get_taxonomy( $termino_actual -> taxonomy );	// Obtiene la taxonomía a partir del término actual
				?>
				<h1 class="page-title text-center">
					<?php echo $taxonomia -> label; ?>:
						<span class="archive-description">
							<?php echo $termino_actual -> name; ?>
						</span>
				</h1>

				<?php
				  # Funciones de 'UnderScore Theme'
					#the_archive_title( '<h1 class="page-title text-center">', '</h1>' );
					#the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
