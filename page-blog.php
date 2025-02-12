<?php
?>
<?php get_header();?>

<div class="blog-container">
    <div>
        <?php
        $category=get_category_by_slug('blog');
        if($category):
        ?>
        <div>
            <h1><?php echo esc_html($category->name);?></h1>
        </div>
        <?php endif;?>
    </div>
    <div>
        <?php 
        $blog_query=new WP_Query(array(
            'category_name'=>'Blog',
            'order'=>'ASC',
            'posts_per_page'=>-1
        ));
        if($blog_query->have_posts()):
            while($blog_query->have_posts()):$blog_query->the_post();
            ?>
            <div>
                <div>
                    <img src="<?php the_post_thumbnail_url("large")?>" alt="">
                </div>
                <div>
                    <h1><?php the_title();?></h1>
                    <p>
                        <?php the_content(); ?>
                    </p>
                </div>
            </div>
            <?php endwhile;
            wp_reset_postdata();
            endif;
            ?>

    </div>


</div>
<?php get_footer();?>