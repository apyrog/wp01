<?php

// register Ajax_Filter_Widget widget
function register_ajax_filter_widget() {
    register_widget( 'Ajax_Filter_Widget' );
}
add_action( 'widgets_init', 'register_ajax_filter_widget' );
