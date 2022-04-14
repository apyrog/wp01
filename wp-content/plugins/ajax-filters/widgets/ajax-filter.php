<?php

/**
 * Adds Ajax_Filter_Widget widget.
 */
class Ajax_Filter_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'ajax_filter_widget',
			esc_html__( 'Ajax Filters', 'text_domain' ),
			array( 'description' => esc_html__( 'Ajax Filters Widget', 'text_domain' ), )
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
        echo $this->getCustomAjaxFormHtml($post_limit);
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
            <span>Post Limit</span>
            <p>
                <input id="<?php echo esc_attr( $this->get_field_id( 'post_limit' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'post_limit' ) ); ?>"
                       type="text"
                       value="<?php echo esc_attr( $post_limit ); ?>">
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
        $instance['post_limit'] = ( !empty( $post_limit ) ) ? sanitize_text_field( $post_limit ) : '';
		return $instance;
	}

    public function getCustomAjaxFormHtml($postLimit)
    {
        return '
<div><h2>Ajax Filters</h2></div>
<br>
<label for="post_title">Title (required)</label>
<input type="text" name="post_title" id="post_title" onkeyup="get_ajax_filters()" />
<br>
<label for="from_date">From Date (required)</label>
<input type="date" name="from_date" id="from_date" />
<input type="hidden" name="post_limit" id="post_limit" value="' . $postLimit . '">
<div id="response">
    <br>
    <strong>Posts not found</strong>
</div>
';
    }

}
