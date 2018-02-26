<?php
/**
 * Template Name: Buscador
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

	<div id="primary" class="content-area medium-8 columns">
		<main id="main" class="site-main">
			<span class="file">page-buscador.php</span>
			<h2>Buscador Avanzado</h2>
			<div class="buscador">
				<input id="buscar" type="text" name="buscar" value="" placeholder="Buscar recetas" />
				<p>Escriba el término por el que desea realizar la búsqueda</p>
				<button id="btn-buscar" type="button" class="button">Buscar</button>
			</div>
			<div id="termino-buscado"></div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
