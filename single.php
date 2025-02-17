<?php get_header(); ?>

<?php

    $categories=get_the_category();
    $category_slug=!empty($categories)?$categories[0]->slug:'default';
  
?>
<?php
if(have_posts()):while(have_posts()):the_post();?>
<?php
    if(has_category('services')){
        ?>
        <div class="single-service">
            <div class="service-banner">
                <h1><?php the_title(); ?></h1>
            </div>
             <?php if (has_post_thumbnail()) : ?>
                <div class="service-image">
                    <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title_attribute(); ?>">
                </div>
            <?php endif; ?>

            <div class="service-content">
                <div class="service-description">
                    <p><?php the_content(); ?></p>
                </div>
                
               
            </div>

            <div class="navigation">
                <a href="<?php echo esc_url(get_permalink(get_page_by_path("services")))?>" class="back-to-the">← Back to Services</a>
        </div>
        </div>
<?php

    }

    elseif (has_category('blog')) {
?>
        <div class="blog-container">
            <div>
                <p class="blog-container-paragraph"><?php the_content(); ?></p>
            </div>
             <!-- Corrected the_content() function call -->
        </div>
        <div class="article-header">
            <h1>Recent Articles</h1> <!-- Display heading for recent posts -->
        </div> 
        <div class="blog-detail-content-wrap">
            <div class="blog-detail-content">   
                <?php 
                        $blog_query = new WP_Query(array(
                            'category_name' => 'blog',  // Correct category slug
                            'post__not_in' => array(get_the_ID()),  // Exclude the current post
                            'orderby' => 'rand',  // Random order for articles
                            'posts_per_page' => 2,  // Limit the number of related posts
                        ));

                        if ($blog_query->have_posts()):
                            while ($blog_query->have_posts()): $blog_query->the_post();
                    ?>
                
                                <div class="blog-detail-card">
                                    <div class="blog-detail-image">
                                        <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                                    </div>
                                    <div class="blog-detail-text">
                                        <h2><a href="<?php the_permalink(); ?>" class=""><?php the_title(); ?></a></h2>
                                        <p><?php echo wp_trim_words(get_the_content(), 15, '...'); ?></p>
                                    </div>
                                </div>
                
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?> 
                <?php
                endif?>
            </div>
            <div class="navigation">            
                <a href="<?php echo esc_url(get_permalink(get_page_by_path("Blog")))?>" class="back-to-the">← Back to Blog</a>
            </div>
        </div>    
        <?php
              // End the if statement for blog_query
    }
    elseif(has_category('slider')){
    ?>
    <div>
        
        <h1 style="margin:100px;""><?php echo the_title();?></h1>
        <div>
            <img src="<?php the_post_thumbnail_url('large');?>">
            <?php the_excerpt();?>
        </div>
    </div>
        <a href="<?php echo esc_url(get_category_link(get_cat_ID('slider')));?>" class="view-more">back to recent</a>

    <?php

    }
    elseif(has_category('Our-service')){
        ?>
        <div style="margin:100px;">
            <h1><?php the_title();?></h1>
           <p><?php echo get_the_date('F j,Y')?></>
           <p><?php the_post_thumbnail('large')?></p>
        </div>
        <a href="<?php echo esc_url(get_category_link(get_cat_ID('Our-service')));?>" class="view-more">back to service</a>

        <?php

    }
 
endwhile;
    endif;
?>


<?php get_footer(); ?>
