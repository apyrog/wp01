<?php

/**
 * Adds Event_Widget widget.
 */
class Event_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'event_widget',
			esc_html__( 'Events', 'text_domain' ),
			array( 'description' => esc_html__( 'A Event Widget', 'text_domain' ), )
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
        extract( $instance );
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

        // custom code
        $shortcodeText = "[event-shortcode event_status=" . $event_status . " event_limit=" . (int)$event_limit . "]";
        echo do_shortcode($shortcodeText);
        // end custom code

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
        extract( $instance );
        ?>
        <div>
            <span>Status</span>
            <br>
            <p>
                <label>
                    <input type="radio"
                           value="public"
                           name="<?php echo $this->get_field_name( 'event_status' ); ?>"
                        <?php checked( $event_status, 'public' ); ?>
                           id="<?php echo $this->get_field_id( 'event_status' ); ?>" />
                    <?php esc_attr_e( 'Open event', 'text_domain' ); ?>
                </label>
            </p>
            <p>
                <label>
                    <input type="radio"
                           value="private"
                           name="<?php echo $this->get_field_name( 'event_status' ); ?>"
                        <?php checked( $event_status, 'private' ); ?>
                           id="<?php echo $this->get_field_id( 'event_status' ); ?>" />
                    <?php esc_attr_e( 'Event by invitation only', 'text_domain' ); ?>
                </label>
            </p>
        </div>
        <br>
        <div>
            <span>Limit</span>
            <p>
                <input id="<?php echo esc_attr( $this->get_field_id( 'event_limit' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'event_limit' ) ); ?>"
                       type="text"
                       value="<?php echo esc_attr( $event_limit ); ?>">
            </p>
        </div>
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
        extract( $new_instance );
		$instance = array();
        $instance['event_status'] = ( !empty( $event_status ) ) ? sanitize_text_field( $event_status ) : null;
        $instance['event_limit'] = ( !empty( $event_limit ) ) ? sanitize_text_field( $event_limit ) : '';
		return $instance;
	}

}
