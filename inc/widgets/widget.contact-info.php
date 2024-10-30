<?php

class Meridian_One_Contact_Info_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'meridian_one_contact_info_widget', // Base ID
			esc_html__( 'MeridianOne - Contact Info', 'meridian-one-features' ), // Name
			array( 
				'description' => esc_html__( 'Show contact information.', 'meridian-one-features' ),
				'customize_selective_refresh' => true
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
			
		$icon = '';
		$heading = '';
		$content = '';

		if ( ! empty( $instance['icon'] ) ) {
			$icon = $instance['icon'];
		}

		if ( ! empty( $instance['heading'] ) ) {
			$heading = $instance['heading'];
		}

		if ( ! empty( $instance['content'] ) ) {
			$content = $instance['content'];
		}

		echo $before_widget;

		/* Start - Widget Content */

		?>

			<div class="section-contact-extra-item clearfix">
				
				<?php if ( $icon ) : ?>
					<span class="section-contact-extra-item-icon"><span class="fa <?php echo esc_attr( $icon ); ?>"></span></span>
				<?php endif; ?>

				<?php if ( $heading || $content ) : ?>
					<div class="section-contact-extra-item-main">
						<?php if ( $heading ) : ?>
							<strong><?php echo esc_html( $heading ); ?></strong>
						<?php endif; ?>
						<?php if ( $content ) : ?>
							<span><?php echo wp_kses_post( $content ); ?></span>
						<?php endif; ?>
					</div><!-- .section-contact-extra-item-main -->
				<?php endif; ?>
			</div><!-- .section-contact-extra-item -->

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
		$instance['icon'] = strip_tags( $new_instance['icon'] );
		$instance['heading'] = strip_tags( $new_instance['heading'] );
		$instance['content'] = strip_tags( $new_instance['content'] );

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
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ]; else $title = 'Contact Info';
		if ( isset( $instance[ 'icon' ] ) ) $icon = $instance[ 'icon' ]; else $icon = '';
		if ( isset( $instance[ 'heading' ] ) ) $heading = $instance[ 'heading' ]; else $heading = '';
		if ( isset( $instance[ 'content' ] ) ) $content = $instance[ 'content' ]; else $content = '';

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'meridian-one-features' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>"><?php esc_html_e( 'Icon:', 'meridian-one-features' ); ?></label> 
			<input class="widefat meridian-one-customizer-icon-select-value" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon' ) ); ?>" type="hidden" value="<?php echo esc_attr( $icon ); ?>" />
			<span class="meridian-one-customizer-icon-current">
				<?php if ( $icon ) : ?>
					<span class="fa <?php echo $icon; ?>"></span>
				<?php endif; ?>
			</span>
			<br>
			<span class="meridian-one-customizer-icon-select-hook button"><?php esc_html_e( 'Select Icon', 'meridian-one-features' ); ?></span>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'heading' ) ); ?>"><?php esc_html_e( 'Heading:', 'meridian-one-features' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'heading' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'heading' ) ); ?>" type="text" value="<?php echo esc_attr( $heading ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>"><?php esc_html_e( 'Content:', 'meridian-one-features' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'content' ) ); ?>" type="text" value="<?php echo esc_attr( $content ); ?>" />
		</p>
		<?php 

	}

}