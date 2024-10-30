<?php

class Meridian_One_Slide_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'meridian_one_slide_widget', // Base ID
			esc_html__( 'MeridianOne - Slider Item', 'meridian-one' ), // Name
			array( 
				'description' => esc_html__( 'Show slider item.', 'meridian-one' ),
			)
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
		
		extract( $args );
		
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
			
		$image = '';
		$video = '';
		$heading = '';
		$content = '';
		$button_url = '';
		$button_text = '';

		if ( ! empty( $instance['image'] ) ) {
			$image = $instance['image'];
		}

		if ( ! empty( $instance['video'] ) ) {
			$video = $instance['video'];
		}

		if ( defined( 'MERIDIAN_ONE_PLUS' ) ) {
			include get_parent_theme_file_path() . '/inc/mobile-detect.php';
			$detect = new Mobile_Detect;
			if( $detect->isMobile() ){
				$video = false;
			}
		} else {
			$video = false;
		}

		if ( ! empty( $instance['heading'] ) ) {
			$heading = $instance['heading'];
		}

		if ( ! empty( $instance['content'] ) ) {
			$content = $instance['content'];
		}

		if ( ! empty( $instance['button_url'] ) ) {
			$button_url = $instance['button_url'];
		}

		if ( ! empty( $instance['button_text'] ) ) {
			$button_text = $instance['button_text'];
		}

		echo $before_widget;

		/* Start - Widget Content */

		?>

			<?php if ( isset( $image ) || isset( $video ) ) : ?>

				<div class="slide">

					<?php if ( $video ) : ?>

						<div class="slide-video">

							<div class="screen mute" id="slide-video-<?php echo rand( 0, 100 ); ?>" data-video-id="<?php echo $video; ?>"></div>
							<div class="slide-video-cover"></div>

						</div><!-- .slide-video -->

					<?php else : ?>

						<?php
							$image = wp_get_attachment_image_src( $image, 'full' );
							$image = $image[0];
						?>
						<img src="<?php echo esc_url( $image ); ?>">

					<?php endif; ?>

					<?php if ( $heading || $content || $button_url ) : ?>

						<div class="slide-info">

							<div class="wrapper">

								<div class="slide-info-inner">
									
									<?php if ( $heading ) : ?>
										<h2 class="slide-info-title"><?php echo esc_html( $heading ); ?></h2>
									<?php endif; ?>

									<?php if ( $content ) : ?>
										<div class="slide-info-content"><?php echo wp_kses_post( $content ); ?></div>
									<?php endif; ?>

									<?php if ( $button_url ) : ?>
										<a href="<?php echo esc_url( $button_url ); ?>" class="slide-info-button"><?php echo esc_html( $button_text ); ?><span>&rarr;</span></a>
									<?php endif; ?>

								</div><!-- .slide-info-inner -->

							</div><!-- .wrapper -->

						</div><!-- .slide-info -->

					<?php endif; ?>

				</div><!-- .slide -->

			<?php endif; ?>

		<?php

		/* End - Widget Content */

		echo $after_widget;

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
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['image'] = strip_tags( $new_instance['image'] );
		$instance['video'] = strip_tags( $new_instance['video'] );
		$instance['heading'] = strip_tags( $new_instance['heading'] );
		$instance['content'] = strip_tags( $new_instance['content'] );
		$instance['button_text'] = strip_tags( $new_instance['button_text'] );
		$instance['button_url'] = strip_tags( $new_instance['button_url'] );

		return $instance;

	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		// Get values
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ]; else $title = 'Slider Item';
		if ( isset( $instance[ 'image' ] ) ) $image = $instance[ 'image' ]; else $image = '';
		if ( isset( $instance[ 'video' ] ) ) $video = $instance[ 'video' ]; else $video = '';
		if ( isset( $instance[ 'heading' ] ) ) $heading = $instance[ 'heading' ]; else $heading = '';
		if ( isset( $instance[ 'content' ] ) ) $content = $instance[ 'content' ]; else $content = '';
		if ( isset( $instance[ 'button_text' ] ) ) $button_text = $instance[ 'button_text' ]; else $button_text = '';
		if ( isset( $instance[ 'button_url' ] ) ) $button_url = $instance[ 'button_url' ]; else $button_url = '';

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'meridian-one' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php esc_html_e( 'Image:', 'meridian-one' ); ?></label> 
			<input class="widefat meridian-one-customizer-image-select-value" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" type="hidden" value="<?php echo esc_attr( $image ); ?>" />
			<span class="meridian-one-customizer-image-current">
				<?php if ( $image ) : ?>
					<?php
						$image = wp_get_attachment_image_src( $image, 'thumbnail' );
						$image = $image[0];
					?>
					<img src="<?php echo esc_url( $image ); ?>" />
				<?php endif; ?>
			</span>
			<br>
			<span class="meridian-one-customizer-image-select-hook button"><?php esc_html_e( 'Select Image', 'meridian-one' ); ?></span>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'video' ) ); ?>"><?php esc_html_e( 'Youtube Video ID:', 'meridian-one' ); ?></label> 
			<br><small><?php esc_html_e( 'For example in youtube.com/watch?v=EYs_FckMqow the ID is EYs_FckMqow', 'meridian-one' ); ?></small>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'video' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'video' ) ); ?>" type="text" value="<?php echo esc_attr( $video ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'heading' ) ); ?>"><?php esc_html_e( 'Heading:', 'meridian-one' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'heading' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'heading' ) ); ?>" type="text" value="<?php echo esc_attr( $heading ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>"><?php esc_html_e( 'Content:', 'meridian-one' ); ?></label> 
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'content' ) ); ?>"><?php echo esc_attr( $content ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>"><?php esc_html_e( 'Button Text:', 'meridian-one' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_text' ) ); ?>" type="text" value="<?php echo esc_attr( $button_text ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'button_url' ) ); ?>"><?php esc_html_e( 'Button URL:', 'meridian-one' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_url' ) ); ?>" type="text" value="<?php echo esc_attr( $button_url ); ?>" />
		</p>
		<?php 

	}

}