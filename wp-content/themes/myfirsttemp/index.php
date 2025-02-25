<?php
get_header();
echo"this is the index";
while(have_posts()){
    the_post();
   // the_title();
}
get_footer();
?>