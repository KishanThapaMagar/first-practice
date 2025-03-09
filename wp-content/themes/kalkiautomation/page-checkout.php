<?php
/**
 * Template Name: checkout
 */
?>
<?php get_header();?>
<div class="project-checkout"> 
    <?php echo do_shortcode('[woocommerce_checkout]');?>
</div>

<?php get_footer();?>   