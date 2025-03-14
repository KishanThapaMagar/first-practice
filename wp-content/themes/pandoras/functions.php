<?php
function pandora_enqueue_assets() {
    wp_enqueue_style('pandora', get_template_directory_uri() . '/assets/css/pandoras.css');
    wp_enqueue_style('pandora-headnfoot', get_template_directory_uri() . '/assets/css/headnfoot.css');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
    wp_enqueue_style('bootstrap-css','https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-css','https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js');
    wp_enqueue_script('custom-js',get_template_directory_uri() . '/assets/js/custom.js', array('jquery'),null,true);
        wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
        wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], false, true);

}
add_action('wp_enqueue_scripts', 'pandora_enqueue_assets');

function enable_featured_images() {
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'enable_featured_images');

?>
