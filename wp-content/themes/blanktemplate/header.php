<!DOCTYPE html>
<html <?php language_attributes(); ?>>

    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />

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

        <link rel="shortcut icon" href="/favicon.ico">
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <link rel="shortcut icon" href="#">
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/assets/css/bootstrap.min.css" media="screen, projection">
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/libraries/chosen/chosen.min.css" media="screen, projection">
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/libraries/pictopro-outline/pictopro-outline.css" media="screen, projection">
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/libraries/pictopro-normal/pictopro-normal.css" media="screen, projection">
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/libraries/colorbox/colorbox.css" media="screen, projection">
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/libraries/jslider/bin/jquery.slider.min.css" media="screen, projection">
        <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:100,400,700,400italic,700italic" rel="stylesheet" type="text/css"  media="screen, projection">
<?php if (is_singular()) wp_enqueue_script('comment-reply'); ?>

<?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div class="topbar gray">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-xs-12 header-top-left">
                        <div>
                            <div class="news">
                                <div class="inner">
                                    <ul class="news-list">
                                        <li>Chrysler plans new <a href="#">product</a> at Windsor, Ontario, plant, report says</li>
                                        <li>Tesla retail model faces new legal challenge in Ohio</li>
                                        <li>Toyota revealing new model</li>

                                    </ul><!-- /.news-list -->
                                </div><!-- /.inner -->
                            </div><!-- /.news -->
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-12 header-top-right">
                        <div>
                            <div class="social">
                                <div class="inner">
                                    <ul class="social-links">
                                        <li class="social-icon google-plus"><a href="#">Google+</a></li>
                                        <li class="social-icon youtube"><a href="#">YouTube</a></li>
                                        <li class="social-icon twitter"><a href="#">Twitter</a></li>
                                        <li class="social-icon pinterest"><a href="#">Pinterest</a></li>
                                        <li class="social-icon facebook"><a href="#">Facebook</a></li>
                                    </ul><!-- /.social-links -->
                                </div><!-- /.inner -->
                            </div><!-- /.social -->

                            <div class="languages">
                                <ul>
                                    <li><a href="#"><img src="assets/img/flags/en.png" alt="#"></a></li>
                                    <li><a href="#"><img src="assets/img/flags/ru.png" alt="#"></a></li>
                                </ul>
                            </div><!-- /.languages -->

                            <form class="navbar-form search-form" role="search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search" required="required">

                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="icon icon-normal-magnifier"></i></button>
                                    </span><!-- /.input-group-btn -->
                                </div><!-- /.input-group -->                     
                            </form><!-- /.search-form -->
                        </div>
                    </div><!-- /.col-md-5 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.topbar -->

        <header id="header">
            <div class="header-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 clearfix">
                            <div class="brand">
                                <div class="logo">
                                    <a href="/">
                                        <img src="assets/img/logo.png" alt="Carat HTML Template">
                                    </a>
                                </div><!-- /.logo -->

                                <div class="slogan">Car Rental, Dealership,<br>Magazine Template</div><!-- /.slogan -->
                            </div><!-- /.brand -->

                            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                            <nav class="collapse navbar-collapse navbar-collapse" role="navigation">
                                <ul class="navigation">
                                    <li><a href="index.html">Home</a></li>						

                                    <li class="menuparent has-regularmenu">
                                        <a href="magazine.html">Features</a>

                                        <div class="regularmenu">
                                            <ul class="regularmenu-inner">
                                                <li><a href="detail.html"><i class="icon icon-normal-car"></i> Car Detail</a></li>
                                                <li><a href="filter.html"><i class="icon icon-normal-magnifier"></i> Search results</a></li>
                                                <li><a href="about.html"><i class="icon icon-normal-profile-checkbox"></i> About</a></li>
                                                <li><a href="faq.html"><i class="icon icon-normal-collage-hat"></i> FAQ</a></li>
                                                <li><a href="pricing.html"><i class="icon icon-normal-coins"></i> Pricing</a></li>
                                                <li><a href="blog.html"><i class="icon icon-normal-question-mark"></i> Blog</a></li>
                                                <li><a href="article.html"><i class="icon icon-normal-file-text"></i>Article Detail</a></li>
                                                <li><a href="404.html"><i class="icon icon-normal-cog-wheel"></i>Page Not Found</a></li>
                                            </ul><!-- /.regularmenu-inner -->
                                        </div><!-- /.regularmenu -->
                                    </li>

                                    <li class="menuparent has-regularmenu">
                                        <a href="#">Reservation</a>

                                        <div class="regularmenu">
                                            <ul class="regularmenu-inner">
                                                <li><a href="rental-1.html"><strong>1.</strong> Request Reservation</a></li>
                                                <li><a href="rental-2.html"><strong>2.</strong> Select Your Car</a></li>
                                                <li><a href="rental-3.html"><strong>3.</strong> Extra Features</a></li>
                                                <li><a href="rental-4.html"><strong>4.</strong> Review &amp; Checkout</a></li>
                                            </ul><!-- /.regularmenu-inner -->
                                        </div><!-- /.regularmenu -->
                                    </li>

                                    <li><a href="magazine.html">Magazine</a></li>
                                    <li class="menuparent has-megamenu">
                                        <a href="#">Popular</a>

                                        <div class="megamenu">
                                            <div class="megamenu-inner clearfix">
                                                <div class="col-md-4 col-sm-6 col-xs-12">
                                                    <div class="block random-cars">
                                                        <div class="title">
                                                            <h2>Popular Cars</h2>
                                                        </div><!-- /.title -->

                                                        <div class="items">
                                                            <div class="teaser-item-wrapper">
                                                                <div class="teaser-item">
                                                                    <div class="title">
                                                                        <a href="detail.html">Toyota Landcruiser</a>
                                                                    </div><!-- /.title -->

                                                                    <div class="subtitle">Windsor Locks, CT </div><!-- /.subtitle -->

                                                                    <div class="row">
                                                                        <div class="picture-wrapper col-md-4 col-sm-4 col-xs-4">
                                                                            <div class="picture">
                                                                                <a href="detail.html">
                                                                                    <span class="hover">
                                                                                        <span class="hover-inner">
                                                                                            <i class="icon icon-normal-link"></i>
                                                                                        </span><!-- /.hover-inner -->
                                                                                    </span><!-- /.hover -->

                                                                                    <img src="assets/img/content/toyota4.jpg" alt="#">
                                                                                </a>
                                                                            </div><!-- /.picture -->
                                                                        </div><!-- /.col-md-5 -->

                                                                        <div class="content-wrapper col-md-8 col-sm-8 col-xs-8">
                                                                            <div class="price">$9,799</div>
                                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu vulputate neque.</p>
                                                                        </div><!-- /.col-md-7 -->
                                                                    </div><!-- /.row -->
                                                                </div><!-- /.teaser-item -->
                                                            </div><!-- /.teaser-item-wrapper -->

                                                            <div class="teaser-item-wrapper">												
                                                                <div class="teaser-item">
                                                                    <div class="title">
                                                                        <a href="detail.html">Toyota Landcruiser</a>
                                                                    </div><!-- /.title -->

                                                                    <div class="subtitle">Windsor Locks, CT </div><!-- /.subtitle -->

                                                                    <div class="row">
                                                                        <div class="picture-wrapper col-md-4 col-sm-4 col-xs-4">
                                                                            <div class="picture">
                                                                                <a href="detail.html">
                                                                                    <span class="hover">
                                                                                        <span class="hover-inner">
                                                                                            <i class="icon icon-normal-link"></i>
                                                                                        </span><!-- /.hover-inner -->
                                                                                    </span><!-- /.hover -->

                                                                                    <img src="assets/img/content/toyota6.jpg" alt="#">
                                                                                </a>
                                                                            </div><!-- /.picture -->
                                                                        </div><!-- /.col-md-5 -->

                                                                        <div class="content-wrapper col-md-8 col-sm-8 col-xs-8">
                                                                            <div class="price">$9,799</div>
                                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu vulputate neque.</p>
                                                                        </div><!-- /.col-md-7 -->
                                                                    </div><!-- /.row -->
                                                                </div><!-- /.teaser-item -->
                                                            </div><!-- /.teaser-item-wrapper -->
                                                        </div><!-- /.items -->
                                                    </div><!-- /.block -->				
                                                </div>

                                                <div class="col-md-3 col-sm-6">
                                                    <h2>Recent Posts</h2>

                                                    <div class="latest-reviews block">
                                                        <div class="block-inner">
                                                            <div class="inner">
                                                                <div class="item-wrapper">
                                                                    <div class="item">
                                                                        <div class="title">
                                                                            <a href="detail.html">Toyota Landcruiser</a>
                                                                        </div><!-- /.title -->

                                                                        <div class="date">10/12/2013</div><!-- /.date -->

                                                                        <div class="description">
                                                                            <p>
                                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu vulputate...
                                                                            </p>
                                                                        </div><!-- /.description -->
                                                                    </div><!-- /.item -->
                                                                </div><!-- /.item-wrapper -->

                                                                <div class="item-wrapper">
                                                                    <div class="item">
                                                                        <div class="title">
                                                                            <a href="detail.html">Toyota RAV</a>
                                                                        </div><!-- /.title -->

                                                                        <div class="date">12/12/2013</div><!-- /.date -->

                                                                        <div class="description">
                                                                            <p>
                                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu vulputate...
                                                                            </p>
                                                                        </div><!-- /.description -->
                                                                    </div><!-- /.item -->			
                                                                </div><!-- /.item-wrapper -->

                                                                <div class="item-wrapper">
                                                                    <div class="item">
                                                                        <div class="title">
                                                                            <a href="detail.html">Toyota 4Runner</a>
                                                                        </div><!-- /.title -->

                                                                        <div class="date">20/12/2013</div><!-- /.date -->

                                                                        <div class="description">
                                                                            <p>
                                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu vulputate...
                                                                            </p>
                                                                        </div><!-- /.description -->
                                                                    </div><!-- /.item -->			
                                                                </div><!-- /.item-wrapper -->
                                                            </div><!-- /.inner -->
                                                        </div><!-- /.block-inner -->
                                                    </div><!-- /.block -->									
                                                </div>

                                                <div class="col-md-5 col-sm-12">
                                                    <h2>Our Brands</h2>								

                                                    <div class="brands block">
                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-6">
                                                                <ul>
                                                                    <li><a href="#"><img src="assets/img/brands/ford.png" alt="#"> Ford</a></li>
                                                                    <li><a href="#"><img src="assets/img/brands/toyota.png" alt="#"> Toyota</a></li>
                                                                    <li><a href="#"><img src="assets/img/brands/kia.png" alt="#"> Kia</a></li>
                                                                    <li><a href="#"><img src="assets/img/brands/opel.png" alt="#"> Opel</a></li>
                                                                    <li><a href="#">&nbsp;<img src="assets/img/brands/bmw.png" alt="#"> BMW</a></li>
                                                                </ul>
                                                            </div><!-- /.col-md-6 -->

                                                            <div class="col-md-6 col-sm-6">
                                                                <ul>
                                                                    <li><a href="#"><img src="assets/img/brands/audi.png" alt="#"> Audi</a></li>
                                                                    <li><a href="#"><img src="assets/img/brands/honda.png" alt="#"> Honda</a></li>
                                                                    <li><a href="#"><img src="assets/img/brands/volkswagen.png" alt="#"> Volkswagen</a></li>
                                                                    <li><a href="#"><img src="assets/img/brands/peugot.png" alt="#"> Peugot</a></li>
                                                                    <li><a href="#"><img src="assets/img/brands/chevrolet.png" alt="#"> Chevrolet</a></li>
                                                                </ul>
                                                            </div><!-- /.col-md-6 -->											
                                                        </div><!-- /.row -->
                                                    </div><!-- /.brands -->
                                                </div><!-- /.col-md-5 -->
                                            </div><!-- /.megamenu-inner -->
                                        </div><!-- /.mega-menu-->
                                    </li>
                                    <li><a href="contact.html">Contact</a></li>
                                </ul><!-- /.nav -->
                            </nav>
                        </div><!-- /.col-md-12 -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.header-inner -->
        </header><!-- /#header -->


        <div class="infobar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ol class="breadcrumb pull-left">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Featured Cars</a></li>
                            <li class="active">Buy</li>
                        </ol>

                        <div class="contact pull-right">
                            <div class="contact-item phone">
                                <div class="label"><i class="icon icon-normal-mobile-phone"></i></div><!-- /.label -->
                                <div class="value">123-456-789</div><!-- /.value -->
                            </div><!-- /.phone -->

                            <div class="contact-item mail">
                                <div class="label"><i class="icon icon-normal-mail"></i></div><!-- /.label -->
                                <div class="value"><a href="mailto:example@example.com">example@example.com</a></div><!-- /.value -->
                            </div><!-- /.mail -->

                            <div class="contact-item opening">
                                <div class="label"><i class="icon icon-normal-clock"></i></div><!-- /.label -->
                                <div class="value">Mon - Sun: 8:00 - 16:00</div><!-- /.value -->
                            </div><!-- /.opening -->
                        </div><!-- /.contact -->
                    </div><!-- /.col-md-12 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.infobar -->  