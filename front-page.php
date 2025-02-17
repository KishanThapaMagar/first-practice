<?php
/*
template name:Kalki automation;
*/

get_header();
?>
    <div class="Page-Container">

        <?php
                $args = array(
                    'post_type' => 'page',
                    'pagename' => 'achievement', // Make sure this matches the page slug
                    'posts_per_page' => 1
                );
                $new_page_query = new WP_Query($args);

                if ($new_page_query->have_posts()):
                    while($new_page_query->have_posts()) : $new_page_query->the_post();
            ?>
            <div>
                <?php the_content(); ?>
            </div>
            <?php
                    endwhile;
                    wp_reset_postdata();
                else:
                    echo '<p>No content found.</p>';
                endif;
        ?>
    </div>
    
<!-- this is service Page-Container -->
    <div class="Our-service">
            <div class="ourserviceContainer">
                <div class="service-content-one">
                    <?php
                    $category_slug='ourservice';
                    $category= get_term_by('slug',$category_slug,'category');
                        if($category){
                            $category_id=$category->term_id;
                            $category_name=esc_html($category->name);
                            $category_description=esc_html($category->description);


                            $category_image=get_option('z_taxonomy_image'.$category_id);


                            
                            $cat_name=explode('-',$category_name);
                            ?>
                            <div class="service-category-content">
                                <p class="default-header">
                                    <?php  echo isset($cat_name[0])?$cat_name[0]:'';?><br>
                                <e> <?php echo  isset($cat_name[1])?$cat_name[1]:'';?></e>
                                </p>
                                <p class="service-paragraph"><?php echo $category_description?></p>
                                <a href="<?php echo esc_url(get_category_link($category_id))?>" class="a-button">VIEW ALL</a>

                            </div>
                            <div class="service-category-image">
                                <img src="<?php echo isset($category_image)?$category_image:'';?>" alt="">
                            </div>
                            <?php
                        }
                    ?>

                </div>
                <!-- sevice -->
                <div class="service-content-two">
                <div class="circle-container">
                    <?php
                        $circle_args =[
                            'category_name' => 'ourservice',  // Fetch posts from 'circle' category
                            'posts_per_page' => 4 ,
                            'post__not_in'   => [get_queried_object_id()]        // Fetch 5 posts
                        ];
                        $circle_query = new WP_Query($circle_args);
                        $circle_classes = ['circle-top', 'circle-left', 'circle-right', 'circle-bottom'];
                        $icons = ['fa-gem', 'fa-layer-group', 'fa-desktop', 'fa-gear',];
                        $i = 0;
                    
                        if ($circle_query->have_posts()) {
                            while ($circle_query->have_posts() && $i < 4) { // Fetch 5 posts now
                                $circle_query->the_post(); ?>
                                
                                <div class="circle <?php echo esc_attr($circle_classes[$i]); ?>">
                                    <i class="fas <?php echo esc_attr($icons[$i]); ?>"></i>
                                    
                                    <?php if ($i < 4): ?>
                                        <h1><?php the_title(); ?></h1>
                                        <h3><?php the_excerpt(); ?></h3> <!-- Show excerpt for first 4 circles -->
                                <!-- Show full content in the extra circle -->
                                    <?php endif; ?>
                                    
                                </div>

                                <?php
                                $i++;
                            }
                            wp_reset_postdata();
                        } else {
                            echo '<p>No content found</p>'; // Fixed closing tag
                        }
                    ?>
                     
                    </div>
                
                </div>        
            </div>
    </div>
<!-- feature  project -->
    <div class="feature-project-wrap">  
            <div class="feature-project">
                <div class="feature-content-one">
                        <?php
                            $feature=array(
                                'post_type'=>'page',
                                'pagename'=>'featureproject',
                                'posts_per_page'=>1,
                            );
                            $feature_query= new WP_Query($feature);
                            if($feature_query->have_posts()):
                                while($feature_query->have_posts()):$feature_query->the_post();
                        ?>
                        <div>
                            <?php the_content();?>
                            
                        </div>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                    else:
                        echo '<p>no content found</p>';
                    endif;
                        ?> 
                        <div class="feature-btn">
                        <a href="<?php echo esc_url(get_category_link(get_category_by_slug('slider')->term_id)); ?>" class="view-all">VIEW ALL</a>
                        </div>
                        <div class="nav-button">
                                <button id="prev">&#8592;</button>
                                <button id="next">&#8594;</button>
                        </div>

                </div>
                <div class="feature-content-two">
                    <div class="slider"> 
                        
                        <?php
                        $slider= array(
                            'category_name'=>'slider',
                            'posts_per_page'=>-1
                        );
                        $slider_query= new WP_Query($slider);
                        if($slider_query->have_posts()):
                        while($slider_query->have_posts()):$slider_query->the_post();?>
                        <div class="slide">
                            <?php if(has_post_thumbnail()):?>
                                <img src="<?php the_post_thumbnail_url('large');?>" alt="<?php the_title();?>">
                                <?php endif;?>
                                <h3><?php the_title();?></h3>
                                <p><?php the_excerpt();?></p>
                        </div>
                        <?php endwhile;
                        wp_reset_postdata();
                            else:?>
                            <p>no projects available</p>;
                            <?php endif;?>
                        
                    </div>
                

                </div>
                
            </div>
    </div>

<!-- client's testimonials -->
    <div class="testimonials-container">
        <div class="testimonmial-head">
        <p class="default-header">Clint's<br><e>Testimonials</e></p>

        </div>
        <div class="testimonials">
            <div class="testimonial-wrapper">   
                    <button id="prevTestimonial" class="arrow left">
                        <img id="prevImage" src="" alt="Previous">
                        <span>&#8592;</span>
                    </button>
                    <div class="testimonial-content">
                        <div class="testimonial-slider">
                            <?php
                            $args = array(
                                'post_type'      => 'testimonial',
                                'posts_per_page' => -1,
                                'post_statu'    => 'publish',
                                'order'          => 'DESC'
                            );
                            $query = new WP_Query($args);
                            $testimonials = [];
                            if ($query->have_posts()) :
                                while ($query->have_posts()) : $query->the_post();
                                    $testimonials[] = array(
                                        'image' => get_the_post_thumbnail_url(get_the_ID(), 'medium'),
                                        'title' => get_the_title(),
                                        'content' => apply_filters('the_content', get_the_content()) // Fix content formatting
                                    );
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            ?>
                            <?php foreach ($testimonials as $index => $testimonial) : ?>
                                <div class="testimonial-slide" data-index="<?php echo $index; ?>">
                                    <div class="testimonial-img">
                                        <img src="<?php echo esc_url($testimonial['image']); ?>" alt="<?php echo esc_attr($testimonial['title']); ?>">
                                    </div>
                                    <div class="testimonial-text">
                                        <p><?php echo wp_kses_post($testimonial['content']); ?></p>
                                        <h3><?php echo esc_html($testimonial['title']); ?></h3>
                                        <p>CEO/Founder</p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <button id="nextTestimonial" class="arrow right">
                        <img id="nextImage" src="" alt="Next">
                        <span>&#8594;</span>
                    </button>
            </div>
        </div> 
    </div>
    

    <div class="counter-container">
                    <div class="counter-one">
                        <div class="counter">
                            <div class="counter-content">
                                <div class="timer" data-to="400" data-speed="500"></div>
                                <span>+</span>
                            </div>
                           
                        </div>
                        <p>Project Completed</p>
                    </div>
                    <div class="divider"></div>
                    <div class="counter-two">
                        <div class="counter">
                            <div class="counter-content">
                                <div class="timer" data-to="150" data-speed="500"></div>
                                <span>m</span>
                            </div>
                            
                        </div>
                        <p>Hours Coding</p>
                    </div>
                    <div class="divider"></div>
                    <div class="counter-three">
                        <div class="counter">
                            <div class="counter-content">
                                <div class="timer" data-to="700" data-speed="500"></div>
                                <span>+</span>
                            </div>
                           
                        </div>
                        <p>Happy Clients</p>
                    </div>
                    
        
    </div>

    <div class="recent-post-wrap">
        <section class="recent-posts">
            <div class="recent-posts-header">
                <p class="default-header">Recent<br><e>Posts</e></p>
                <a href="<?php echo esc_url(get_category_link(get_category_by_slug('recent')->term_id)); ?>" class="view-all">VIEW ALL</a>

            </div>
            <div class="recent-posts-container">
                <?php
                $args = array(
                    'post_type'      => 'post',
                    'posts_per_page' => 3,
                    'post_status'    => 'publish',
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'category',
                            'field'    => 'slug',
                            'terms'    => 'recent',
                        ),
                    ),
                );
                
                $query = new WP_Query($args);
                
                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                        $image = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: 'https://via.placeholder.com/600';          
                        $title = get_the_title();
                        $date  = get_the_date('d M, Y');
                        $link  = get_permalink();
                ?>
                        <div class="post-card">
                            <div class="post-image">
                                <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">
                            </div>
                            <div class="post-info">
                                <h3><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($title); ?></a></h3>
                                <p>Admin | <?php echo esc_html($date); ?></p>
                            </div>
                        </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>No posts found.</p>';
                endif;
                ?>
            </div>
        </section>
    </div>

    <div class="contact-container">
            <?php
            $args = array(
                'post_type'      => 'post',
                'posts_per_page' => 1,
                'post_status'    => 'publish',
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'slug',
                        'terms'    => 'contact',
                    ),
                ),
            );
            $new_page_query = new WP_Query($args);
            if ($new_page_query->have_posts()) :
                while ($new_page_query->have_posts()) :
                    $new_page_query->the_post();
                    $title=get_the_title();
                    $arr = explode("-", $title);

            ?>

                    
                    <div class="contact">
                        <div class="contact-first">
                        <img src="<?php the_post_thumbnail_url('large');?>">
                        </div>
                        <div class="contact-second">
                            <div class="default-header">
                                <?php echo isset($arr[0]) ? $arr[0] : ''; ?>
                                <br>
                                <e><?php echo isset($arr[1]) ? $arr[1] : ''; ?></e>
                            </div>
                            <div class="contact-center">
                            <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
            <?php 
                endwhile;
                wp_reset_postdata();
            else : ?>
                <p class="no-content">No content found</p>
            <?php endif; ?>
    </div>

    

  
<?php
get_footer(); 
?>
       