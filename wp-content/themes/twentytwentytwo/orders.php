<?php
/*
Template Name: orders
*/
?>
<?php
get_header();
?>
<?php
$loop = new WP_Query( array(
    'post_type'         => 'shop_order',
    'post_status'       =>  array_keys( wc_get_order_statuses() ),
    'posts_per_page'    => -1,
) );

// The Wordpress post loop
if ( $loop->have_posts() ): 
while ( $loop->have_posts() ) : $loop->the_post();

// The order ID
$order_id = $loop->post->ID;

// Get an instance of the WC_Order Object
$order = wc_get_order($loop->post->ID);
?>
<h2>
<?php echo($order)?>
</h2>
<?php
endwhile;

wp_reset_postdata();

endif;
?>
<?php
function get_orders_ids_by_product_id( $product_id, $order_status = array( 'wc-completed' ) ){
    global $wpdb;

    $results = $wpdb->get_col("
        SELECT order_items.order_id
        FROM {$wpdb->prefix}woocommerce_order_items as order_items
        LEFT JOIN {$wpdb->prefix}woocommerce_order_itemmeta as order_item_meta ON order_items.order_item_id = order_item_meta.order_item_id
        LEFT JOIN {$wpdb->posts} AS posts ON order_items.order_id = posts.ID
        WHERE posts.post_type = 'shop_order'
        AND posts.post_status IN ( '" . implode( "','", $order_status ) . "' )
        AND order_items.order_item_type = 'line_item'
        AND order_item_meta.meta_key = '_product_id'
        AND order_item_meta.meta_value = '$product_id'
    ");

    return $results;
}
?>

<?php
get_footer();
?>