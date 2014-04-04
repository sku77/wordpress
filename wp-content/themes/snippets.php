/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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
<?php wp_nav_menu( array('menu' => 'Project Nav' )); ?>	

Category Based Navigation	
<ul id="menu">	
<li <?php if(is_home()) { ?> class="current-cat" <?php } ?>><a href="<?php bloginfo('home'); ?>">Home</a></li>	
<?php wp_list_categories('title_li=&orderby=id');?>	
</ul>	

Page Based Navigation	
<ul id="menu">	
<li <?php if(is_home()) { ?> class="current-page-item" <?php } ?>><a href="<?php bloginfo('home'); ?>">Home</a></li>	
<?php wp_list_pages('sort_column=menu_order&depth=1&title_li=');?>	
</ul>


Template Functions

Function                Description	
<?php the_content(); ?>	content of posts/pages	
<?php if(have_posts()): ?>	check if there are posts	
<?php while(have_posts()): the_post(); ?>	shows posts	
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
<?php if(have_posts()) { ?>	
<?php while(have_posts()) { ?>	
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
<!--nextpage-->	divide content into pages	
<!--more-->	cut off content and create link to full post	
<?php wp_meta(); ?>	admin meta data	
<?php timer_start(); ?>	start page timer (header.php)	
<?php timer_stop(1); ?>	time to load the page (footer.php)	
<?php echo get_num_queries(); ?>	show queries executed to generate page	