<?php

// register Event_Widget widget
function register_event_widget() {
    register_widget( 'Event_Widget' );
}
add_action( 'widgets_init', 'register_event_widget' );
