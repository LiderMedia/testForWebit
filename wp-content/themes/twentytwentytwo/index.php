<?php
// There is nothing output here because block themes do not use php templates.
// There is a core ticket discussing removing this requirement for block themes:
// https://core.trac.wordpress.org/ticket/54272.


$params = array('posts_per_page' => 5);
$wc_query = new WP_Query($params);
?>
<?php if ($wc_query->have_posts()) :?>
<?php while ($wc_query->have_posts()) :
                $wc_query->the_post();?>
<?php the_title(); ?>
<?php endwhile; ?>
<?php wp_reset_postdata();?>
<?php else:  ?>
<p>
     <?php _e( 'No Products' ); ?>
</p>
<?php endif; ?>