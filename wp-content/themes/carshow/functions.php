<?php
/** Start the engine */
require_once( TEMPLATEPATH . '/lib/init.php' );
/**
 * Functions
 *
 * @package      Ezra John
 * @author       Ezra John <john@constantclick.com>
 * @copyright    Copyright (c) 2013, Ezra John
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */

/**
 * Theme Setup
 *
 * This setup function attaches all of the site-wide functions 
 * to the correct actions and filters. All the functions themselves
 * are defined below this setup function.
 *
 */

add_action('genesis_setup','child_theme_setup', 15);
function child_theme_setup() {

	// Add Nav to Header
	add_action( 'genesis_header', 'be_nav_menus' );

}

/**
 * Remove Metaboxes
 * This removes unused or unneeded metaboxes from Genesis > Theme Settings. See /genesis/lib/admin/theme-settings.php for all metaboxes.
 *
 */

function be_remove_metaboxes( $_genesis_theme_settings_pagehook ) {
	remove_meta_box( 'genesis-theme-settings-nav', $_genesis_theme_settings_pagehook, 'main' );
}

function be_nav_menus() {
	echo '<div class="menus"><div class="primary">';
	wp_nav_menu( array( 'menu' => 'Primary' ) );
	echo '</div><!-- .primary --><div class="secondary">';
	wp_nav_menu( array( 'menu' => 'Secondary' ) );
	echo '</div><!-- .secondary --></div><!-- .menus -->';

}

// Force full width
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// Remove Page Title
remove_action( 'genesis_post_title', 'genesis_do_post_title' );

// Add Rotator
add_action( 'genesis_after_header', 'be_home_rotator' );

/**
 * Rotator 
 *
 */

function be_home_rotator() {
	do_action( 'home_rotator' );
}