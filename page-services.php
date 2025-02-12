<?php
/*template name:Services;
*/
?>
<?php get_header();?>

<div class="service-container">
    <div>
        <?php 
        $category=get_category_by_slug('Services');
        if($category):
           ?>  
            <div>
                <h1><?php echo esc_html($category->name);?></h1>
            </div>
        <?php
        endif;
        ?>
    </div>
    <div class="service-content">
        <?php
        $arr= new WP_Query(array(
            'category_name'=>'Services',
            'posts_per_page'=>-1
        ));
        
        if($arr->have_posts()):
            while($arr->have_posts()):$arr->the_post();
        ?>
        <div>
            <div>
                <h1><?php the_title(); ?></h1>
                <p><?php the_content();?></p>
            </div>
            <div>
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