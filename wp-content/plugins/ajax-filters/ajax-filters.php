<?php
/*
Plugin Name: Ajax Filters
Description: Ajax Filters.
Author: Andrii Piroh
Text Domain: ajax-filters
Version: 1.0.0
*/

function ajax_filter_init_js() {
    wp_enqueue_script( 'ajax-filter-js', plugins_url( '/js/ajax-filter.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
}
add_action('wp_enqueue_scripts','ajax_filter_init_js');

include plugin_dir_path( __FILE__ ) . './widgets/widgets.php';
include plugin_dir_path( __FILE__ ) . './widgets/ajax-filter.php';

add_action( 'wp_footer', 'ajax_url_init' );
function ajax_url_init() {
    ?>
        <script type="text/javascript">
            var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
        </script>
    <?php
}

add_action('wp_ajax_ajax_filter' , 'ajax_filter_function');
add_action('wp_ajax_nopriv_ajax_filter','ajax_filter_function');
function ajax_filter_function ()
{
    $checkPostTitle = getParam('post_title');
    $postLimit = getParam('post_limit');
    $postFromDate = getParam('from_date');
    if ( empty($checkPostTitle) || empty($postLimit) || empty($postFromDate) ) {
        echo getPostsNotFoundHtml();
        die();
    }
    $args = array(
        'posts_per_page' => $postLimit,
        's' => esc_attr( $checkPostTitle ),
        'date_query' => array(
            array(
                'after' => $postFromDate,
                'inclusive' => true,
            ),
        ),
    );
    $the_query = new WP_Query( $args );
    $posts = $the_query->get_posts();
    if( $the_query->have_posts() ) {
        foreach ($posts as $post) {
            echo '<br><a href="' . esc_url( get_permalink( $post ) ) . '">' . $post->post_title . '</a>';
        }
    } else {
        echo getPostsNotFoundHtml();
    }
    die();
}

function getParam($param)
{
    return $_POST[$param] ?? '';
}

function getPostsNotFoundHtml(): string
{
    return '<br><strong>Posts not found.</strong>';
}
