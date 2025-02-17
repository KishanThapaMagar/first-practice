<?php
/*template name:Services;
*/
?>
<?php get_header();?>
<div class="service-page">
    <div class="service-header">
            <?php 
            $category=get_category_by_slug('Services');
            if($category):
            ?>  
                    <h1><?php echo esc_html($category->name);?></h1>
            <?php
            endif;
            ?>
    </div>
</div>
<div class="service-container">
        
        <div class="service-page-content">
            <?php
            $arr= new WP_Query(array(
                'category_name'=>'Services',
                'order'=>'ASC',
                'posts_per_page'=>-1
            ));
            
            if($arr->have_posts()):
                while($arr->have_posts()):$arr->the_post();
            ?>
            <div class="the-content">
                <div class="content-one">
                    <h1><?php the_title(); ?></h1>
                    <p><?php the_content();?></p>
                    <a href="<?php the_permalink(); ?>" class="view-more">View More</a>
                </div>
                <div class="content-two">
                    <img src="<?php the_post_thumbnail_url('large')?>" alt="">
                </div>
            </div>
            <?php 
            wp_reset_postdata();
            endwhile;
        endif;
            ?>

        </div>
</div>
<?php get_footer();?>