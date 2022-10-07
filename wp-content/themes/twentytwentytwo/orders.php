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
get_footer();
?>