<?php
/**
 * Front Page
 *
 * @package      Ezra John  
 * @author       Ezra John <john@constantclick.com>
 * @copyright    Copyright (c) 2013, Ezra John
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */
// Force full width 
add_filter('genesis_pre_get_option_site_layout', '__genesis_return_full_width_content');

// Remove Page Title 
remove_action('genesis_post_title', 'genesis_do_post_title');

// Add Rotator 
add_action('genesis_after_header', 'be_home_rotator');

// /** * Rotator * */ 
function be_home_rotator() {
    do_action('home_rotator');
}

// Content Area remove_action( 'genesis_loop', 'genesis_do_loop' ); 
add_action('genesis_loop', 'be_home_loop');

/** * Home Content Area * */
function be_home_loop() {
    echo '<div class="content-left">';
    while (have_posts()): the_post();
        the_content();
    endwhile;
    echo '</div><!-- .content-left -->';
    echo '<div class="content-middle">';
    echo '<h3>Latest News</h3>';
    $news = new WP_Query('posts_per_page=3');
    while ($news->have_posts()): $news->the_post();
        global $post;
        echo '<div class="news-item">';
        echo '<div class="thumbnail"><a href="' . get_permalink() . '">' . get_the_post_thumbnail($post->ID, 'thumbnail') . '</a></div>';
        echo '<div class="content"><span class="date">' . get_the_date() . '</span><a href="' . get_permalink() . '">' . get_the_title() . '</a></div><!-- .content -->';
        echo '</div><!-- .news-item -->';
    endwhile;
    wp_reset_query();
    echo '</div><!-- .content-middle -->';
    echo '<div class="content-right">';
    dynamic_sidebar('home-sidebar');
    ?> <div class="events-links-entry"> <div class="entry-header"> <p class="col-1">Events</p> <p class="col-2">Popular Links</p> </div><!-- /entry-header --> <div class="entry-content"> <?php
    $args = array('post_type' => 'event', 'posts_per_page' => '5', 'orderby' => 'ASC', 'order' => 'meta_value_num', 'meta_query' => array(array('key' => 'be_events_manager_end_date', 'value' => time(), 'compare' => '>')));
    $events = new WP_Query($args);
    if ($events->have_posts()): echo '<ul class="col-1">';
        while ($events->have_posts()): $events->the_post();
            echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
        endwhile;
        wp_reset_query();
        echo '</ul>';
    endif;
    ?> <ul class="col-2"> <?php $args = array('limit' => -1, 'title_li' => '', 'category' => 2, 'categorize' => 0);
        wp_list_bookmarks($args);
    ?> </ul> <div class="cl"> </div> </div><!-- /entry-content --> </div><!-- /events-links --> </div><!-- .content-right --> <?php }

        genesis();
?> - See more at: http://www.artofblog.com/building-a-genesis-child-theme/#sthash.PPsHlLi4.dpuf



genesis();
?>

