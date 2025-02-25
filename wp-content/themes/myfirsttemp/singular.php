<?php 
get_header();

echo"this is the singular page.";

while(have_posts()){
    the_post();
    the_title();
}
get_footer();
?>