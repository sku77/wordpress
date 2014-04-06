/* 
* 
* Wordpress Copy paste pasta italiana!
* 
*/

Header Functions
Function                Description	
<?php site_url(); ?>	root url for website	
<?php wp_title(); ?>	title of specific post/page	
<?php bloginfo('name'); ?>	title of site	
<?php bloginfo('description'); ?>	site description	
<?php get_stylesheet_directory(); ?>	stylesheet folder location	
<?php bloginfo('stylesheet_url'); ?>	style.css file location	
<?php bloginfo('pingback_url'); ?>	pingback url	
<?php bloginfo('template_url'); ?>	template folder path	
<?php bloginfo('version'); ?>	wordpress blog version	
<?php bloginfo('atom_url'); ?>	atom url	
<?php bloginfo('rss2_url'); ?>	rss2 url	
<?php bloginfo('url'); ?>	root url for website	
<?php bloginfo('html_type'); ?>	html version	
<?php bloginfo('charset'); ?>	charset parameter

Navigation Menu
Default Navigation Menu	
<?php wp_nav_menu(); ?>	

Specific Navigation Menu	
<?php wp_nav_menu(array('menu' => 'Project Nav')); ?>	

Category Based Navigation	
<ul id="menu">	
    <li <?php if (is_home()) { ?> class="current-cat" <?php } ?>><a href="<?php bloginfo('home'); ?>">Home</a></li>	
    <?php wp_list_categories('title_li=&orderby=id'); ?>	
</ul>	

Page Based Navigation	
<ul id="menu">	
    <li <?php if (is_home()) { ?> class="current-page-item" <?php } ?>><a href="<?php bloginfo('home'); ?>">Home</a></li>	
        <?php wp_list_pages('sort_column=menu_order&depth=1&title_li='); ?>	
</ul>


Template Functions

Function                Description	
<?php the_content(); ?>	content of posts/pages	
<?php if (have_posts()): ?>	check if there are posts	
    <?php while (have_posts()): the_post(); ?>	shows posts	
    <?php endwhile; ?>	closes loop	
<?php endif; ?>	closes if	

<?php get_header(); ?>	header.php file contents	
<?php get_sidebar(); ?>	sidebar.php file contents	
<?php get_footer(); ?>	footer.php file contents	
<?php the_time('m-d-y'); ?>	the date is '08-18-07'	
<?php comments_popup_link(); ?>	link to comments of post	
<?php the_title(); ?>	title of post/page	
<?php the_permalink(); ?>	url of post/page	
<?php the_category(); ?>	category of post/page	
<?php the_author(); ?>	author of post/page	
<?php the_ID(); ?>	id of post/page	
<?php edit_post_link(); ?>	edit link of post/page	
<?php wp_list_bookmarks(); ?>	links from blogroll	
<?php comments_template(); ?>	comment.php file contents	
<?php wp_list_pages(); ?>	list all pages	
<?php wp_list_categories(); ?>	list all categories	
<?php next_post_link('%link'); ?>	url to next post	
<?php previous_post_list('%link'); ?>	url to previous post	
<?php get_calendar(); ?>	show post calendar	
<?php wp_get_archives(); ?>	list of archive urls	
<?php posts_nav_link(); ?>	next and previous post link	
<?php rewind_posts(); ?>	rewinds post for a second loop

The Loop
Basic Loop	
<?php if (have_posts()) { ?>	
    <?php while (have_posts()) { ?>	
        <?php the_post(); ?>	
        <?php // custom post content code for title, excerpt and featured image ?>	
    <?php } // end while ?>	
<?php } // end if ?>


Extra Functions
Function	Description	
/%postname%/	custom permalinks	
<?php include(TEMPLATEPATH . '/x'); ?>	include file from template folder	
<?php the_search_query(); ?>	value returned from search from	
<?php _e('Message'); ?>	return translated text from translate()	
<?php wp_register(); ?>	register link	
<?php wp_loginout(); ?>	login/logout link	
<!--nextpage-->         divide content into pages	
<!--more-->             cut off content and create link to full post	
<?php wp_meta(); ?>	admin meta data	
<?php timer_start(); ?>	start page timer (header.php)	
<?php timer_stop(1); ?>	time to load the page (footer.php)	
<?php echo get_num_queries(); ?> show queries executed to generate page	

Pagination

<?php
$terms = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
$args = array(
    'post_type' => 'car',
    'post_status' => 'publish',
    'posts_per_page' => 4,
    'paged' => $paged,
    'order' => 'DESC',
    'tax_query' => array(
        array(
            'taxonomy' => $terms->taxonomy,
            'field' => 'id',
            'terms' => $terms->term_id // Where term_id of Term 1 is "1".
        )
    )
);
$wp_query = new WP_Query();
$wp_query->query($args);
?>

<?php wpbeginner_numeric_posts_nav(); ?>

Pagination function.php 
<?php
function wpbeginner_numeric_posts_nav() {

    if (is_singular()) {
        return;
    }

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if ($wp_query->max_num_pages <= 1) {
        return;
    }

    $paged = get_query_var('page') ? absint(get_query_var('page')) : 1;
    $max = intval($wp_query->max_num_pages);

    /** 	Add current page to the array */
    if ($paged >= 1) {
        $links[] = $paged;
    }

    /** 	Add the pages around the current page to the array */
    if ($paged >= 3) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if (( $paged + 2 ) <= $max) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<div class="navigation"><ul>' . "\n";

    /** 	Previous Post Link */
    if (get_previous_posts_link()) {
        printf('<li>%s</li>' . "\n", get_previous_posts_link());
    }

    /** 	Link to first page, plus ellipses if necessary */
    if (!in_array(1, $links)) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link(1)), '1');

        if (!in_array(2, $links)) {
            echo '<li>…</li>';
        }
    }

    /** 	Link to current page, plus 2 pages in either direction if necessary */
    sort($links);
    foreach ((array) $links as $link) {
        $class = $paged == $link ? ' class="active"' : '';
        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)), $link);
    }

    /** 	Link to last page, plus ellipses if necessary */
    if (!in_array($max, $links)) {
        if (!in_array($max - 1, $links)) {
            echo '<li>…</li>' . "\n";
        }

        $class = $paged == $max ? ' class="active"' : '';
        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max)), $max);
    }

    /** 	Next Post Link */
    if (get_next_posts_link()) {
        printf('<li>%s</li>' . "\n", get_next_posts_link());
    }

    echo '</ul></div>' . "\n";
}
?>

Get the current terms from the main loop variable

<?php $terms = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); 

array('tax_query' => array(
        array(
            'taxonomy' => $terms->taxonomy,
            'field' => 'id',
            'terms' => $terms->term_id // Where term_id of Term 1 is "1".
        )
    ));
        ?>

Search query
<?php
global $query_string;

$query_args = explode("&", $query_string);
$search_query = array();
$paged = (get_query_var('page')) ? get_query_var('page') : 1;
foreach ($query_args as $key => $string) {
    $query_split = explode("=", $string);
    $search_query[$query_split[0]] = urldecode($query_split[1]);
}
$arg = array(
    's' => $search_query[$query_split[0]],
    'post_type' => 'car',
    'post_status' => 'publish',
    'posts_per_page' => 5,
    'paged' => $paged,
    'order' => 'DESC',
);
$wp_query = new WP_Query();
$wp_query->query($arg);
?>

Theme Style Header
<?php /*   
themes Name: Prestige
themes URI: http://www.exoticcarrentalorlando.com/
Description: WP themes for ECR Orlando
Author: ConstantClick.Com
Author URI: http://www.constantclick.com
Version: Beta
*/
?>

for page template header
<?php
/*
  Template Name: Reservation Page
 */
?>

for posts template header
<?php
/*
  Template Name Posts: Car Detail
 */
?>


Nav Menu 
Arguments

    <?php
$defaults = array(
	'theme_location'  => '',
	'menu'            => '',
	'container'       => 'div',
	'container_class' => '',
	'container_id'    => '',
	'menu_class'      => 'menu',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => 0,
	'walker'          => ''
);

wp_nav_menu( $defaults );

if ( has_nav_menu( 'primary-menu' ) ) { /* if menu location 'primary-menu' exists then use custom menu */
      wp_nav_menu( array( 'theme_location' => 'primary-menu') ); 
}

?>