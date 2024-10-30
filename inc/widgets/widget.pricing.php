<?php
class Meridian_One_Pricing_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'meridian_one_pricing_widget', // Base ID
			esc_html__( 'MeridianOne - Pricing', 'meridian-one' ), // Name
			array( 'description' => esc_html__( 'Show pricing plan.', 'meridian-one' ) ) // Args
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
				
		$name = 'Plan name';
		$currency = '$';
		$amount = '15';
		$period = 'mo';
		$content = 'Plan description';
		$button_text = 'Get started';
		$button_url = '';
		$featured = '';

		if ( ! empty( $instance['name'] ) ) {
			$name = $instance['name'];
		}

		if ( ! empty( $instance['currency'] ) ) {
			$currency = $instance['currency'];
		}

		if ( ! empty( $instance['amount'] ) ) {
			$amount = $instance['amount'];
		}

		if ( ! empty( $instance['period'] ) ) {
			$period = $instance['period'];
		}

		if ( ! empty( $instance['content'] ) ) {
			$content = $instance['content'];
		}

		if ( ! empty( $instance['button_text'] ) ) {
			$button_text = $instance['button_text'];
		}

		if ( ! empty( $instance['button_url'] ) ) {
			$button_url = $instance['button_url'];
		}

		if ( ! empty( $instance['featured'] ) ) {
			$featured = $instance['featured'];
		}

		echo $before_widget;

		/* Start - Widget Content */

		?>

			<div class="section-pricing-item <?php if ( $featured == 'featured' ) echo 'active'; ?>">
					
				<div class="section-pricing-item-active-bg"></div>
				
				<div class="section-pricing-item-inner">

					<span class="section-pricing-item-title"><span><?php echo esc_html( $name ); ?></span></span>
					<div class="section-pricing-item-price">
						<span class="section-pricing-item-price-currency"><?php echo esc_html( $currency ); ?></span>
						<span class="section-pricing-item-price-amount"><?php echo esc_html( $amount ); ?></span>
						<span class="section-pricing-item-price-per">/ <?php echo esc_html( $period ); ?></span>
					</div><!-- .section-pricing-item-price -->
					<div class="section-pricing-item-list">
						<?php echo wpautop( wp_kses_post( $content ) ); ?>
					</div><!-- -.section-pricing-item-list -->
					<?php if ( $button_url ) : ?>
						<a href="<?php echo esc_url( $button_url ); ?>" class="section-pricing-item-button"><?php echo esc_html( $button_text ); ?></a>
					<?php endif; ?>

				</div><!-- .section-pricing-item-inner -->

			</div><!-- .section-pricing-item -->

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
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['currency'] = strip_tags( $new_instance['currency'] );
		$instance['amount'] = strip_tags( $new_instance['amount'] );
		$instance['period'] = strip_tags( $new_instance['period'] );
		$instance['content'] = strip_tags( $new_instance['content'] );
		$instance['button_text'] = strip_tags( $new_instance['button_text'] );
		$instance['button_url'] = strip_tags( $new_instance['button_url'] );
		$instance['featured'] = strip_tags( $new_instance['featured'] );

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
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ]; else $title = 'Pricing';
		
		if ( isset( $instance[ 'name' ] ) ) $name = $instance[ 'name' ]; else $name = 'Plan name';
		if ( isset( $instance[ 'currency' ] ) ) $currency = $instance[ 'currency' ]; else $currency = '$';
		if ( isset( $instance[ 'amount' ] ) ) $amount = $instance[ 'amount' ]; else $amount = '15';
		if ( isset( $instance[ 'period' ] ) ) $period = $instance[ 'period' ]; else $period = 'mo';
		if ( isset( $instance[ 'content' ] ) ) $content = $instance[ 'content' ]; else $content = 'Plan description';
		if ( isset( $instance[ 'button_text' ] ) ) $button_text = $instance[ 'button_text' ]; else $button_text = 'Get started';
		if ( isset( $instance[ 'button_url' ] ) ) $button_url = $instance[ 'button_url' ]; else $button_url = '';
		if ( isset( $instance[ 'featured' ] ) ) $featured = $instance[ 'featured' ]; else $featured = '';

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>"><?php esc_html_e( 'Name:', 'meridian-one' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" type="text" value="<?php echo esc_attr( $name ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'currency' ) ); ?>"><?php esc_html_e( 'Curency:', 'meridian-one' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'currency' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'currency' ) ); ?>" type="text" value="<?php echo esc_attr( $currency ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'amount' ) ); ?>"><?php esc_html_e( 'Amount:', 'meridian-one' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'amount' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'amount' ) ); ?>" type="text" value="<?php echo esc_attr( $amount ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'period' ) ); ?>"><?php esc_html_e( 'Period:', 'meridian-one' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'period' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'period' ) ); ?>" type="text" value="<?php echo esc_attr( $period ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>"><?php esc_html_e( 'Content:', 'meridian-one' ); ?></label> 
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'content' ) ); ?>"><?php echo esc_html( $content ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>"><?php esc_html_e( 'Button Text:', 'meridian-one' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_text' ) ); ?>" type="text" value="<?php echo esc_attr( $button_text ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'button_url' ) ); ?>"><?php esc_html_e( 'Button URL:', 'meridian-one' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_url' ) ); ?>" type="text" value="<?php echo esc_attr( $button_url ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'featured' ) ); ?>"><?php esc_html_e( 'Featured:', 'meridian-one' ); ?></label> 
			<input id="<?php echo esc_attr( $this->get_field_id( 'featured' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'featured' ) ); ?>" <?php checked( 'featured', $featured, true ); ?> type="checkbox" value="featured" />
		</p>
		<?php 

	}

}