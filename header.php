<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title>Document</title>
    <?php wp_head(); ?>
</head>
<body>
    <?php
    if(is_front_page()) :?>
        <div class="banner-container">
            <p>Automate
                <br>
            <e>Workflow</e> With Us</p>
            <button class="banner-button">VIEW MORE</button>
        </div>
        <div calss="banner-img">
            <img src="<?php echo get_template_directory_uri()?>/assets/images/home.jpg" alt="this is banner images" style="width: 100%;z-index: -1;">
        </div>

       
    <?php endif ?>
       
        <div class="NavBar">
            <div class="NavBar-head">
                <!-- <img src="<?php echo get_template_directory_uri()?>/assets/images/logohead.png" alt=""> -->
            </div>
            <div><?php
                wp_nav_menu([
                    'menu' => 'menu1', // Use registered menu location
                    'menu_class' => 'NavBar-menu',
                ]);
                ?>
            </div>   
       
        </div>
    
