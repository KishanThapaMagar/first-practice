<?php 
/**
 * Template Name: Projects
 */
get_header();



?>
<div>
    <!-- <?php 
    $category=get_term_by('slug','project','product_cat');
    if($category){
        ?>
    <h2 class="heading-project"><?php echo esc_html($category->name);?></h2>
    <?php
    }
    ?>     -->
    <div class="project-header-section">
        <div>
            <h2 class="heading-project">Project & Product</h2>
        </div>
        <div> 
            <a href="<?php echo wc_get_cart_url(); ?>" class="cart-button">🛒<span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
            </a>
            <?php
            echo 
           "<script type='text/javascript'>
                       jQuery(function($) {
                            function updateCartCount() {
                                $.ajax({
                                    url: wc_add_to_cart_params.ajax_url,
                                    type: 'POST',
                                    data: {
                                        action: 'get_cart_count'
                                    },
                                    success: function(response) {
                                        $('.cart-count').text(response);
                                    }
                                });
                            }

                            // Update cart count when an item is added to the cart
                            $(document.body).on('added_to_cart', function() {
                                updateCartCount();
                            });

                            // Initialize cart count when page loads
                            updateCartCount();
                        });

            </script>"
            ?>
        </div>
    </div>

    <div class="project-wrap">
    <div class="project">
        <?php 
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $project_products = new WP_Query(array(
            'post_type' => 'product',
            'posts_per_page' => 9,
            'post_status' => 'publish',
            'order' => 'ASC',
            'paged' => $paged,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => 'project',
                ),
            ),
        ));

        if ($project_products->have_posts()) {
            while ($project_products->have_posts()) {
                $project_products->the_post();
                $products = wc_get_product(get_the_ID());
                if (!$products) {
                    continue; // Skip if not a valid product
                }
                ?>
                <div class="project-container">
                    <div class="project-content">
                        <?php if (has_post_thumbnail()): ?>
                            <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>" alt="">
                        <?php else: ?>
                            <img src="<?php echo esc_url(wc_placeholder_img_src()); ?>" alt="">
                        <?php endif; ?>
                        <div class="project-content-details">
                            <h1><?php the_title(); ?></h1>
                            <p>
                                <?php 
                                $regular_price=$products->get_regular_price();
                                $sale_price=$products->get_sale_price();
                                $currency_symbol='Rs.';
                                if($sale_price && $regular_price){
                                    echo '<span>'. $currency_symbol .'<del class="regular-price">'. number_format($regular_price) . '</del> &nbsp; '. 
                                    '<span class="sale-price">'. $sale_price .'</span>'.
                                    '</span>';  
                                }
                                ?>
                            </p>
                            <a href="<?php the_permalink(); ?>">VIEW DETAILS</a>
                            <a href="<?php echo esc_url($products->add_to_cart_url()); ?>" 
                            data-quantity="1" 
                                class="add-to-cart-button button ajax_add_to_cart" 
                                data-product_id="<?php echo esc_attr($products->get_id()); ?>" 
                                data-product_sku="<?php echo esc_attr($products->get_sku()); ?>" rel="nofollow">
                                <?php echo esc_html($products->add_to_cart_text()); ?>
                            </a>

                        </div>
                    </div>
                </div>
                <?php
            }
            wp_reset_postdata();
        } else {
            echo '<p>No content found</p>';
        }
        ?>
    </div>
    </div>

<!-- Pagination -->
    <div class="pagination">
        <?php 
        echo paginate_links(array(
            'total' => $project_products->max_num_pages
        ));
        ?>
    </div>

</div>


<?php get_footer(); ?>
