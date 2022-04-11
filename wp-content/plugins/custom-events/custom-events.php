<?php
/*
Plugin Name: Custom Events
Description: Custom Events.
Author: Andrii Piroh
Text Domain: custom-events
Version: 1.0.0
*/

//create custom post type Events
function create_custom_events_post_type() {
    $args = [
        'labels' => [
            'name' => 'Events',
            'singular_name' => 'Event'
        ],
        'hierarchical' => true,
        'menu_icon' => 'dashicons-images-alt2',
        'public' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'custom-fields' )
    ];
    register_post_type('event', $args);
}
add_action('init', 'create_custom_events_post_type');

function create_meta_box_event_fields() {
    add_meta_box( 'meta_box_event_fields', __( 'Event Fields'), 'create_meta_box_event_fields_callback', 'event' );
}
add_action( 'add_meta_boxes', 'create_meta_box_event_fields' );

function create_meta_box_event_fields_callback() {
    include plugin_dir_path( __FILE__ ) . './form-event-fields.php';
}

/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function event_fields_save_meta_box( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( $parent_id = wp_is_post_revision( $post_id ) ) {
        $post_id = $parent_id;
    }
    $fields = [
        'event_status',
        'event_date',
    ];
    foreach ( $fields as $field ) {
        if ( array_key_exists( $field, $_POST ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
        }
    }
}
add_action( 'save_post', 'event_fields_save_meta_box' );

include plugin_dir_path( __FILE__ ) . './widgets/widgets.php';
include plugin_dir_path( __FILE__ ) . './widgets/events.php';

function event_shortcode_function( $atts, $content ) {
    $atts = shortcode_atts( [
        'event_status' => 'public',
        'event_limit'  => 3,
    ], $atts );

    $html = '';
    $eventsData = [];
    $eventLimit = (int)$atts['event_limit'];
    $event_status = $atts['event_status'];
    $limitCounter = 0;
    $eventPostCollection = new WP_Query('post_type=event');
    $eventPosts = $eventPostCollection->get_posts();
    foreach ($eventPosts as $eventPost) {
        if ($limitCounter == $eventLimit) {
            break;
        }
        $eventStatus = get_post_meta($eventPost->ID, "event_status", true);
        if ($eventStatus === $event_status) {
            $eventData = [];
            $eventData['title'] = $eventPost->post_title;
            $eventData['date'] = get_post_meta($eventPost->ID, "event_date", true);
            $eventsData[] = $eventData;
            $limitCounter++;
        }
    }

    $html .= '<h2>Events</h2>';
    if (!empty($eventsData)) {
        foreach ($eventsData as $item) {
            $html .= '<p>' . $item['date'] . ' - <strong>' . $item['title'] . '</strong></p>';
        }
    } else {
        $html .= '<p>Events not found.</p>';
    }

    return $html;
}
add_shortcode('event-shortcode', 'event_shortcode_function');

add_filter( 'Event_Widget', 'do_shortcode' );