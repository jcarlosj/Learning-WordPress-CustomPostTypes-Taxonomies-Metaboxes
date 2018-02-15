<?php
/**
 * Template Name: Blog
 *
 * The template for displaying all pages
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

	<div id="primary" class="content-area medium-8 medium-push-2 columns">
		<main id="main" class="site-main" role="main">

			<header>
				<?php the_title( '<h1 class="entry-title text-center">', '</h1>' ); ?>
			</header>

			<?php
				/* Personalizamos la consulta */
				$query_entries = array(
					'post_type'      => 'post',   # Elegimos el tipo de entradas que deseamos publicar
					'order'          => 'DESC',   # Orden de la publicación (Descendente)
					'cat'            => 4,        # Elegimos la categoría de las entradas que se van a publicar (Blog)
					'order_by'       => 'date',   # Ordenado por: Fecha
					'posts_per_page' => 5         # Cantidad de publicaciones por página
				);

				/* Realiza la consulta WP_Query */
				$blog = new WP_Query( $query_entries );
			?>
				  <ul class="no-bullet">
			<?php
		    # Imprime las entradas requeridas
		    while( $blog -> have_posts() ):
		      $blog -> the_post();
			?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'row' ); ?>>

					<?php if( is_single() ): # Condicional para la imagen ?>
						<?php the_title( '<h1 class="entry-title text-center">', '</h1>' ); ?>
						<?php the_post_thumbnail(); ?>
					<?php else: ?>
						<div class="imagen medium-6 columns">
							<?php the_post_thumbnail( 'entry-image' ); ?>
						</div>
					<?php endif; ?>

					<?php if( is_single() ): # Solo condiciona el despliegue de la clase (estilos) del DIV Tag ?>
						<div>
					<?php else: ?>
						<div class="medium-6 columns">
					<?php endif; ?>
						<header class="entry-header">
							<?php
							if ( is_single() ) :
								# No Title
							else :
								the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
							endif;

							if ( 'post' === get_post_type() ) : ?>
							<div class="entry-meta">
								<?php gourmet_artist_posted_on(); ?>
							</div><!-- .entry-meta -->
							<?php
							endif; ?>
						</header><!-- .entry-header -->

						<div class="entry-content">
							<?php # is_single() ~= is_single() || is_page() || is_attachment() ?>
							<?php if( is_single() ): ?>
								 <?php the_content(); ?>
							<?php else: ?>
								 <?php
									 # Reduce la impresión del contenido de la publicación
									 $abbreviated_content = substr( get_the_excerpt(), 0, 200 );
									 echo $abbreviated_content. ' ... ';

									 wp_link_pages( array(
										 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gourmet-artist' ),
										 'after'  => '</div>',
									 ) );
								 ?>
								 <a href="<?php the_permalink(); ?>" class="button">Ver Entrada</a>
							<?php endif; ?>
						</div><!-- .entry-content -->

					</div><!-- .medium-6 columns -->

				</article><!-- #post-<?php the_ID(); ?> -->

			<?php endwhile; wp_reset_postdata(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
