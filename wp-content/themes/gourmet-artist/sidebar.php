<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Gourmet_Artist
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area medium-4 columns" role="complementary">
		<span class="file">sidebar.php</span>
	<!-- Imagen del Newsletter -->
	<div class="row">
		<div class="medium-12 columns">
			<a data-open="newsletter">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/newsletter.jpg" alt="Suscribete al Newsletter">
			</a>
		</div>
	</div>

	<!-- "LightBox/Reveal" del Newsletter -->
	<div id="newsletter" class="small reveal" data-reveal data-animation-in="spin-in" data-animation-out="spin-out">
		<form class="" action="#">
			<h2 class="text-center">Suscribete al Newsletter</h2>
			<div class="row columns">
				<label for="nombre">Nombre
					<input type="text" name="nombre" placeholder="Tú nombre" />
				</label>
			</div>
			<div class="row columns">
				<label for="email">Correo electrónico
					<input type="text" name="email" placeholder="Tú email" />
				</label>
			</div>
			<div class="row columns">
				<button id="btn-send-newsletter" type="submit" class="button">Enviar</button>
			</div>
		</form>
	</div>

	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
