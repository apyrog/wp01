<?php
/*
Plugin Name: WooCommerce Checkout
Description: WooCommerce Checkout.
Author: Andrii Piroh
Text Domain: woocommerce-checkout
Version: 1.0.0
*/

// Add additional field to checkout
function add_additional_info_checkout_fields($fields){
    $fields['additional_checkout_fields'] = array(
        'additional_info_add_field' => array(
            'type' => 'text',
            'required'      => true,
            'label' => __( 'Additional Info' )
        )
    );
    return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'add_additional_info_checkout_fields' );

// add additional info box to checkout
function add_additional_info_box_checkout_fields(){
    $checkout = WC()->checkout(); ?>
    <div class="col2-set">
        <h3><?php _e( 'Additional Info Box' ); ?></h3>
        <?php
        foreach ( $checkout->checkout_fields['additional_checkout_fields'] as $key => $field ) : ?>
            <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
        <?php endforeach; ?>
    </div>
<?php }
add_action( 'woocommerce_checkout_after_customer_details' ,'add_additional_info_box_checkout_fields' );

// save additional info checkout fields
function save_additional_info_checkout_fields( $order_id, $posted ){
    if ( isset( $posted['additional_info_add_field'] ) ) {
        update_post_meta( $order_id, '_additional_info_add_field', sanitize_text_field( $posted['additional_info_add_field'] ) );
    }
}
add_action( 'woocommerce_checkout_update_order_meta', 'save_additional_info_checkout_fields', 10, 2 );

// Display the Data to User
function additional_info_display_order_data( $order_id ){  ?>
    <h2><?php _e( 'Additional Info Box' ); ?></h2>
    <table class="shop_table shop_table_responsive additional_info">
        <tbody>
        <tr>
            <th><?php _e( 'Additional Info : ' ); ?></th>
            <td><?php echo get_post_meta( $order_id, '_additional_info_add_field', true ); ?></td>
        </tr>
        </tbody>
    </table>
<?php }
add_action( 'woocommerce_thankyou', 'additional_info_display_order_data', 20 );
add_action( 'woocommerce_view_order', 'additional_info_display_order_data', 20 );

// display additional info on the Dashboard WC order details page
function additional_info_display_order_data_in_admin( $order ){  ?>
    <div class="order_data_column">
        <h4><?php _e( 'Additional Info Box', 'woocommerce' ); ?><a href="#" class="edit_address"><?php _e( 'Edit', 'woocommerce' ); ?></a></h4>
        <div class="address">
            <?php
            echo '<p><strong>' . __( 'Additional Info' ) . ':</strong>' . get_post_meta( $order->id, '_additional_info_add_field', true ) . '</p>'; ?>
        </div>
        <div class="edit_address">
            <?php woocommerce_wp_text_input( array( 'id' => '_additional_info_add_field', 'label' => __( 'Additional Info' ), 'wrapper_class' => '_billing_company_field' ) ); ?>
        </div>
    </div>
<?php }
add_action( 'woocommerce_admin_order_data_after_order_details', 'additional_info_display_order_data_in_admin' );

// save data from admin
function save_additional_info_details( $post_id, $post ){
    update_post_meta( $post_id, '_additional_info_add_field', wc_clean( $_POST[ '_additional_info_add_field' ] ) );
}
add_action( 'woocommerce_process_shop_order_meta', 'save_additional_info_details', 45, 2 );

// add the field to email template
function additional_info_email_order_meta_fields( $fields, $sent_to_admin, $order ) {
    $fields['additional_info_checkout_field'] = array(
        'label' => __( 'Additional Info' ),
        'value' => get_post_meta( $order->id, '_additional_info_add_field', true ),
    );
    return $fields;
}
add_filter('woocommerce_email_order_meta_fields', 'additional_info_email_order_meta_fields', 10, 3 );
