<?php 
/**
 * Template Name: pandoras
 */
get_header();
?>
<div class="banner">

    <?php
    $page_id = 41; // Replace with the actual Page ID
    $featured_image_url = get_the_post_thumbnail_url($page_id, 'large'); // 'full' can be 'thumbnail', 'medium', etc.

    if ($featured_image_url) {
        echo '<img src="' . esc_url($featured_image_url) . '" alt="Featured Image">';
    } else {
        echo 'No featured image found.';
    }
?>
</div>
<div class="discovery-wrap">
    <div class="discovery-container">
        <div class="discovery">
            <?php 

            $project_products = new WP_Query(array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'order' => 'ASC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'slug',
                        'terms' => 'discovery',
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
                    <a href="<?php the_permalink();?>">
                        <div class="project-container">
                            <?php if (has_post_thumbnail()): ?>
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>" alt="">
                            <?php else: ?>
                                <img src="<?php echo esc_url(wc_placeholder_img_src()); ?>" alt="">
                                <?php endif; ?>
                            <div class="project-content">
                                <div class="project-content-details">
                                    <h1><?php the_title(); ?></h1>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                }
                wp_reset_postdata();
            } else {
                echo '<p>No content found</p>';
            }
            ?>
        </div>
        <div class="discovery-title">
            <h3>Discover a world of <br>jewelery</h3>
        </div>
    </div>
</div>
<div class="bestseller-header">
    <div class="bestseller-header-content">
        <h3>The bestseller you don't want to miss</h3>
    </div>
</div>
<div class="bestseller-wrap">
       <div class="bestseller">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php
                $bestseller = new WP_Query([
                    'post_type'      => 'product',
                    'posts_per_page' => -1,
                    'post_status'    => 'publish',
                    'order'          => 'ASC',
                    'tax_query'      => [
                        [
                            'taxonomy' => 'product_cat',
                            'field'    => 'slug',
                            'terms'    => 'bestseller',
                        ],
                    ],
                ]);

                if ($bestseller->have_posts()) {
                    while ($bestseller->have_posts()) {
                        $bestseller->the_post();

                        $product = wc_get_product(get_the_ID());
                        if (!$product) continue;
                        ?>
                        <div class="swiper-slide">
                            <a href="<?php the_permalink(); ?>">
                                <div class="bestseller-container">
                                    <?php if (has_post_thumbnail()): ?>
                                        <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>" alt="">
                                    <?php else: ?>
                                        <img src="<?php echo esc_url(wc_placeholder_img_src()); ?>" alt="Placeholder">
                                    <?php endif; ?>

                                    <div class="bestseller-content">
                                        <h2><?php the_title(); ?></h2>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    wp_reset_postdata();
                } else {
                    echo '<p>No bestseller products found.</p>';
                }
                ?>
            </div>
            <!-- Pagination and navigation -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            
        </div>
    </div>    
   
</div>
<div class="shop-btn">
    <div><a href="#">Shop</a></div>
</div>  
   

<!-- Initialize Swiper -->
<script>

document.addEventListener('DOMContentLoaded', function() {
    document.querySelector(".swiper-button-next").style.color = "black";
    document.querySelector(".swiper-button-prev").style.color = "black";
    document.querySelectorAll(".swiper-pagination-bullet").forEach((bullet) => {
        bullet.style.background = "black";
        
    });

    // Observe changes in the DOM to update pagination dynamically
    const observer = new MutationObserver(() => {
        document.querySelectorAll(".swiper-pagination-bullet").forEach((bullet) => {
            bullet.style.background = "black";
        });
    });

    observer.observe(document.querySelector(".swiper-pagination"), { childList: true });
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 4.5, // Number of visible slides
        spaceBetween: 10, // Spacing between slides
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            1000: { slidesPerView:  5 },
            750: { slidesPerView: 4 },
            600: { slidesPerView: 3 },
            450: { slidesPerView: 2 },
            300: { slidesPerView: 1 },
        }
    });
});

</script>


<?php get_footer(); ?>