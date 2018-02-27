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
				<label for="precio">Precio:</label>
				<select id="precio" class="" name="precio">
					<option name="default" value="">Seleccione</option>
					<?php
						# Obtenemos los terminos de una taxonomía específica 'tipo_receta'
						$terminos = get_terms(
							array(
								'taxonomy' => 'precio_receta'
							)
						);

						# Recorremos cada uno de los términos creamos cada una de las opciones del elemento select
						foreach ($terminos as $key => $termino ) {
							echo '<option value="' .$termino -> slug. '">' .$termino -> name. '</option>';
						}
					?>
				</select>
				<label for="tipo-receta">Tipo receta:</label>
				<select id="tipo-receta" class="" name="tipo_receta">
					<option name="default" value="">Seleccione</option>
					<?php
						# Obtenemos los terminos de una taxonomía específica 'tipo_receta'
						$terminos = get_terms(
							array(
								'taxonomy' => 'tipo_receta'
							)
						);

						# Recorremos cada uno de los términos creamos cada una de las opciones del elemento select
						foreach ($terminos as $key => $termino ) {
							echo '<option value="' .$termino -> slug. '">' .$termino -> name. '</option>';
						}
					?>
				</select>
				<label for="calorias">Cantidad de Calorías:</label>
				<select id="calorias" class="" name="calorias">
					<option name="default" value="">Seleccione</option>
					<option value="0-200">200 o menos</option>
					<option value="201-400">201 a 400</option>
					<option value="401-600">401 a 600</option>
					<option value="601-10000">601 a 10000</option>
				</select>
				<button id="btn-buscar" type="button" class="button">Buscar</button>
			</div>
			<div id="termino-buscado"></div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
