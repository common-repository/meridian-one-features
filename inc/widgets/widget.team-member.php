<?php

class Meridian_One_Team_Member_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'meridian_one_team_member_widget', // Base ID
			esc_html__( 'MeridianOne - Team Member', 'meridian-one-features' ), // Name
			array( 
				'description' => esc_html__( 'Show a team member.', 'meridian-one-features' ),
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
			
		$image = '';
		$name = '';
		$position = '';

		if ( ! empty( $instance['image'] ) ) {
			$image = $instance['image'];
		}

		if ( ! empty( $instance['name'] ) ) {
			$name = $instance['name'];
		}

		if ( ! empty( $instance['position'] ) ) {
			$position = $instance['position'];
		}

		echo $before_widget;

		/* Start - Widget Content */

		?>

			<div class="section-team-item">

				<?php if ( $image ) : ?>
					<?php
						$image = wp_get_attachment_image_src( $image, 'full' );
						$image = $image[0];
					?>
					<div class="section-team-item-thumb">
						<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $name ); ?>" />
					</div><!-- .section-team-item-thumb -->
				<?php endif; ?>

				<?php if ( $name ) : ?>
					<h2 class="section-team-item-title"><?php echo esc_html( $name ); ?></h2>
				<?php endif; ?>

				<?php if ( $position ) : ?>
					<span class="section-team-item-extra"><?php echo esc_html( $position ); ?></span>
				<?php endif; ?>

			</div><!-- .section-team-item -->

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
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['position'] = strip_tags( $new_instance['position'] );

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
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ]; else $title = 'Team Member';
		if ( isset( $instance[ 'image' ] ) ) $image = $instance[ 'image' ]; else $image = '';
		if ( isset( $instance[ 'name' ] ) ) $name = $instance[ 'name' ]; else $name = '';
		if ( isset( $instance[ 'position' ] ) ) $position = $instance[ 'position' ]; else $position = '';

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'meridian-one-features' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php esc_html_e( 'Image:', 'meridian-one-features' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" type="hidden" value="<?php echo esc_attr( $image ); ?>" />
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
			<span class="meridian-one-customizer-image-select-hook button"><?php esc_html_e( 'Select Image', 'meridian-one-features' ); ?></span>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>"><?php esc_html_e( 'Name:', 'meridian-one-features' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" type="text" value="<?php echo esc_attr( $name ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'position' ) ); ?>"><?php esc_html_e( 'Position:', 'meridian-one-features' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'position' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'position' ) ); ?>" type="text" value="<?php echo esc_attr( $position ); ?>" />
		</p>
		<?php 

	}

}