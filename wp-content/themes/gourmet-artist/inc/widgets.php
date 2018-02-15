<?php
/**
 * Adds UltimosPost widget.
 */
class UltimosPost extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'ultimos_post', // Base ID
			esc_html__( 'Widget - Últimos Post', 'text_domain' ), // Name
			array( 'description' => esc_html__( 'Nuestra los últimos post del Blog', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

    /* Personalizamos la consulta */
    $query_entries = array(
      'post_type'      => 'post',   # Elegimos el tipo de entradas que deseamos publicar
      'order'          => 'DESC',   # Orden de la publicación (Descendente)
      'cat'            => 4,        # Elegimos la categoría de las entradas que se van a publicar
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
    <li class="row">
      <div class="small-6 medium-4 columns">
        <?php the_post_thumbnail( 'entry-image' ); ?>
      </div>
      <div class="small-6 medium-8 columns">
        <h3 class="last-post">
          <a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
        </h3>
      </div>
    </li>
<?php

    endwhile; wp_reset_postdata();
?>
  </ul><!-- .no-bullet -->
<?php
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

} // class UltimosPost


// register UltimosPost widget
function register_ultimos_post() {
    register_widget( 'UltimosPost' );
}
add_action( 'widgets_init', 'register_ultimos_post' );

?>
