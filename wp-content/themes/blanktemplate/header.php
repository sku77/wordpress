<!DOCTYPE html>
<html <?php language_attributes(); ?>>

    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php if (is_search()) { ?>
            <meta name="robots" content="index,follow" /> 
        <?php } ?>

        <title>
            <?php
            if (function_exists('is_tag') && is_tag()) {
                single_tag_title("Tag Archive for &quot;");
                echo '&quot; - ';
            } elseif (is_archive()) {
                wp_title('');
                echo ' Archive - ';
            } elseif (is_search()) {
                echo 'Search for &quot;' . wp_specialchars($s) . '&quot; - ';
            } elseif (!(is_404()) && (is_single()) || (is_page())) {
                wp_title('');
                echo ' - ';
            } elseif (is_404()) {
                echo 'Not Found - ';
            }
            if (is_home()) {
                bloginfo('name');
                echo ' - ';
                bloginfo('description');
            } else {
                bloginfo('name');
            }
            if ($paged > 1) {
                echo ' - page ' . $paged;
            }
            ?>
        </title>
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/assets/favicon.ico">
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/assets/css/bootstrap.min.css" media="screen, projection">
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/libraries/chosen/chosen.min.css" media="screen, projection">
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/libraries/pictopro-outline/pictopro-outline.css" media="screen, projection">
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/libraries/pictopro-normal/pictopro-normal.css" media="screen, projection">
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/libraries/colorbox/colorbox.css" media="screen, projection">
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/libraries/jslider/bin/jquery.slider.min.css" media="screen, projection">
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/assets/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen, projection">
        <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:100,400,700,400italic,700italic" rel="stylesheet" type="text/css"  media="screen, projection">

        <?php if (is_singular()) wp_enqueue_script('comment-reply'); ?>
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>

        <div id="page-wrap">

            <div id="header">
                <h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
                <div class="description"><?php bloginfo('description'); ?></div>
            </div>
            <div id="nav">
                <?php
                wp_nav_menu(array(
                    'menu' => 'primary',
                    'theme_location' => 'primary',
                    'depth' => 2,
                    'container' => 'div',
                    'container_class' => 'collapse navbar-collapse',
                    'container_id' => 'bs-example-navbar-collapse-1',
                    'menu_class' => 'nav navbar-nav',
                    'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
                    'walker' => new wp_bootstrap_navwalker())
                );
                ?>
            </div>