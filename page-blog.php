<?php
?>
<?php get_header();?>

<div class="blog">
    <div class="blog-container-wrap">
        <div class="blog-header">
            <?php
            $category = get_category_by_slug('blog');
            if ($category):
            ?>
            <div>
                <h1><?php echo esc_html($category->name); ?></h1>
            </div>
            <?php endif; ?>
        </div>

        <div class="blog-content-wrap">
            <?php 
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $blog_query = new WP_Query(array(
                'category_name' => 'blog',
                'order' => 'ASC',
                'posts_per_page' => 6, // Change this number for different pagination size
                'paged' => $paged
            ));

            if ($blog_query->have_posts()):
                while ($blog_query->have_posts()): $blog_query->the_post();
            ?>
                <div class="blog-card">
                    <div class="blog-image">
                        <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>">
                    </div>
                    <div class="blog-text">
                        <h2><?php the_title(); ?></h2>
                        <p><?php echo wp_trim_words(get_the_content(), 15, '...'); ?></p>
                        <a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?php 
            echo paginate_links(array(
                'total' => $blog_query->max_num_pages,
                'prev_text' => '«',
                'next_text' => '»',
            )); 
            ?>
        </div>

        <?php wp_reset_postdata(); ?>
        <?php else: ?>
            <p>No posts found.</p>
        <?php endif; ?>
    </div>
</div>

<div class="get-latest-news-wrap">
    <?php 
    $email_query=new WP_Query(array(
        'post_type'=>'post',
        'name'=>'Get the latest-news into your inbox',
        'posts_per_page'=>1,
        'post_status'=>'publish'
    ));
    if($email_query->have_posts()):
        while($email_query->have_posts()):$email_query->the_post();
        $title=get_the_title();
        $tit=explode('-',$title)
        
        ?>
        <div class="get-latest-news">
            <div class="get-latest-title">
                <?php echo isset($tit[0])?$tit[0]:'';?><br>
                <?php echo isset($tit[1])?$tit[1]:'';?>
            </div>
            <div class="get-latest-content">
                <?php the_content();?>
            </div>
        </div>
    <?php 
    endwhile;
    wp_reset_postdata();
endif;
    ?>
</div>

<?php get_footer();?>