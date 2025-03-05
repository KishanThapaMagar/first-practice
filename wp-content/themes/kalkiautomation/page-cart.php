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
<?php
get_footer();
?>
