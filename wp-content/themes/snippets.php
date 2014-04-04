/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Header Functions
Function	Description	
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
<li <?php if(is_home()) { ?> class="current-cat" <?php } ?>>	
<a href="<?php bloginfo('home'); ?>">Home</a></li>	
<?php wp_list_categories('title_li=&orderby=id');?>	
</ul>	

Page Based Navigation	
<ul id="menu">	
<li <?php if(is_home()) { ?> class="current-page-item" <?php } ?>>	
<a href="<?php bloginfo('home'); ?>">Home</a></li>	
<?php wp_list_pages('sort_column=menu_order&depth=1&title_li=');?>	
</ul>
