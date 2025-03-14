<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <?php
    wp_head();?>
</head>

<body>
    <div class="NavBar">
        <div class="nav-logo">
            <a href="<?php echo home_url();?>">
                <img src="<?php echo get_template_directory_uri()?>/assets/img/logo.png" alt="">
            </a>
        </div>
        <div><?php
                wp_nav_menu([
                    'menu' => 'menu1', // Use registered menu location
                    'menu_class' => 'NavBar-menu',
                ]);
                ?>
        </div>  

        <div class="NavBar-icon"> 
            <a href="#" id="search-icon">
                <i class="fas fa-search"></i>
            </a>

            <div class="search-container" id="search-box">
                <input type="text" class="search-input" placeholder="Free search">
                <button class="search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </div>

            <a href="#"><i class="fas fa-user"></i></a>
            <a href="#"><i class="fas fa-shopping-bag"></i></a>
        </div>
        
    </div>
<!-- <script>
    document.getElementById("search-icon").addEventListener("click", function(event) {
    event.preventDefault();
    let searchBox = document.getElementById("search-box");

    if (searchBox.style.display === "block") {
        searchBox.style.display = "none";
    } else {
        searchBox.style.display = "block";
    }
});

</script> -->