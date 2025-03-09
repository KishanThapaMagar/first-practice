<?php 
/**
 * Template Name : cart;
 */

get_header();
?>
<div> 
    <h1>Your Cart</h1>
</div>
<div class="cart">
    <?php  echo do_shortcode('[woocommerce_cart]');?>
</div>
<div class="page-cart-button">
<a href="<?php echo esc_url(get_permalink(get_page_by_path('/projects'))); ?>" class="page-cart-button-a">← Back to Shop</a>
</div>
<?php
get_footer();
?>
