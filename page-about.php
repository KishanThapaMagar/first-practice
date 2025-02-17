<?php
/*
template name:Aboutus;
*/
?>

<?php get_header();?>

<div class="about-page">
   
    <div class="about-page-container">
        <div class="about-header">
             <h1><?php  echo get_the_title();?></h1>
        </div>
        <?php the_content(); ?>
    </div>
        
   
</div>


<!-- form this quality services -->
<div class="quality-service">
    <?php
    // Query to fetch the category name from any post in the category
    $quality = new WP_Query(array(
        'category_name' => 'we-provide-high-quality-services',
        'order' => 'ASC',
        'posts_per_page' => 1
    ));

    if ($quality->have_posts()):
        $quality->the_post(); // Fetch first post to get category
        $categories = get_the_category(); // Get categories for the post
        
        if (!empty($categories)) {
            $category_name = $categories[0]->name; // Get the first category name
            $cat_parts = explode("-", $category_name); // Split by '-'
            ?>
            <div class="quality-service-header-container">
                <div class="quality-service-header">
                    <h1><?php echo isset($cat_parts[0]) ? $cat_parts[0] : ''; ?><a style="color:blue">&nbsp;&nbsp;<?php echo isset($cat_parts[1]) ? $cat_parts[1] :''; ?></a></h1>
                    <h1><?php echo isset($cat_parts[2]) ? $cat_parts[2] : ''; ?></h1>
                </div>
            </div>
            
            <?php
        }
        wp_reset_postdata(); // Reset post data
    endif;
    ?>
    <div class="quality-container">
        <div class="quality-service-container">
                <?php
                $quality = new WP_Query(array(
                    'category_name' => 'we-provide-high-quality-services',
                    'order' => 'ASC',
                    'posts_per_page' => 5
                ));

                if ($quality->have_posts()):
                    while ($quality->have_posts()): $quality->the_post();
                        $title = get_the_title();
                        $title_parts = explode("-", $title); // Split title into words
                ?>
                        <div class="quality-service-content">
                            <div class="grid-number">
                                <h2><a href="<?php the_permalink(); ?>"><?php echo isset($title_parts[0]) ? $title_parts[0] : ''; ?>
                                </a></h2>
                            </div>
                            
                            <div class="grid-container">
                                <div class="grid-item">
                                    <h2><a href="<?php the_permalink(); ?>">
                                        <?php echo isset($title_parts[1]) ? $title_parts[1] : ''; ?>
                                    </a></h2>
                                </div>
                                <div class="grid-item">
                                    <p><?php the_excerpt(); ?></p>
                                </div>
                            </div>

                        </div>
                <?php 
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>


        </div>
    </div>
    
    

</div>



<!-- director -->
<div class="director-wrap">
    <div class="director">
            <?php 
                $director_query = new WP_Query(array(
                    'category_name' => 'director',
                    'posts_per_page' => 4
                ));

                if ($director_query->have_posts()) { 
                    $first = true;
                    ?>
                    <div class="director-left">
                        <?php 
                        $director_query->the_post(); // Fetch first post for main display
                        ?>
                        <img class="main-image" id="mainImage" src="<?php the_post_thumbnail_url('large'); ?>" 
                            alt="Director">
                    </div>
                    
                    <div class="director-right">
                        <div class="director-content-container">
                            <h1><?php the_title();?></h1>
                            <p><?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?></p> <!-- Excerpt -->

                            <p><?php echo wp_trim_words(get_the_content(), 30, '...'); ?></p> <!--  -->

                            
                            <div class="navigation">
                                <button class="nav-btn prev-btn">←</button>
                                <button class="nav-btn next-btn">→</button>
                            </div>
                        </div>
                        

                        <div class="thumbnail-container">
                        <img class="thumbnail active" 
    src="<?php the_post_thumbnail_url('thumbnail'); ?>" 
    data-title="<?php the_title(); ?>" 
    data-desc="<?php echo esc_attr(get_the_excerpt()); ?>" 
    data-content="<?php echo esc_attr(strip_tags(get_the_content())); ?>" 
    data-img="<?php the_post_thumbnail_url('large'); ?>" 
    alt="">

<?php while ($director_query->have_posts()) { 
    $director_query->the_post(); ?>
    <img class="thumbnail" 
        src="<?php the_post_thumbnail_url('thumbnail'); ?>" 
        data-title="<?php the_title(); ?>" 
        data-desc="<?php echo esc_attr(get_the_excerpt()); ?>" 
        data-content="<?php echo esc_attr(strip_tags(get_the_content())); ?>" 
        data-img="<?php the_post_thumbnail_url('large'); ?>" 
        alt="">
<?php } ?>


                        </div>
                    </div>
            <?php } wp_reset_postdata(); ?>
        

    </div>
</div>

<div class="need-advice">
    <h1>You have a project? Need advice?</h1>
</div>



<?php get_footer();?>
