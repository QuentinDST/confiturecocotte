<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="header">
        <div class="container">
            <div class="header-inner">
                <div class="header-left">
                    <a href="<?php echo home_url('/'); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/confiture-cocotte-white-small.jpg" alt="Logo">
                    </a>
                </div>
                <div class="header-right">
                    <?php
                    wp_nav_menu(array(
                        'menu' => 'confiturecocotte',
                        'menu_class'     => 'header-menu',
                        'orderby'        => 'menu_order'
                    ));
                    ?>
                </div>
            </div>
            <hr class="header-hr">
        </div>


    </header>