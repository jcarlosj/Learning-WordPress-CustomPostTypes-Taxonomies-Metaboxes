<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Gourmet_Artist
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'row' ); ?>>

	<?php if( is_singular() ): # Condicional para la imagen ?>
		<?php the_title( '<h1 class="entry-title text-center">', '</h1>' ); ?>
		<?php the_post_thumbnail(); ?>
	<?php else: ?>
		<div class="imagen medium-6 columns">
			<?php the_post_thumbnail( 'entry-image' ); ?>
		</div>
	<?php endif; ?>

	<?php if( is_singular() ): # Solo condiciona el despliegue de la clase (estilos) del DIV Tag ?>
		<div>
	<?php else: ?>
		<div class="medium-6 columns">
	<?php endif; ?>
		<header class="entry-header">
			<?php
			if ( is_singular() ) :
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
			<?php # is_singular() ~= is_single() || is_page() || is_attachment() ?>
			<?php if( is_singular() ): ?>
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
				 <a href="<?php the_permalink(); ?>" class="button">Ver Receta</a>
			<?php endif; ?>
		</div><!-- .entry-content -->

	</div><!-- .medium-6 columns -->

</article><!-- #post-<?php the_ID(); ?> -->
