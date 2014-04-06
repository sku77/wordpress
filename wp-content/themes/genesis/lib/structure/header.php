<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Header
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/genesis/
 */

add_action( 'genesis_doctype', 'genesis_do_doctype' );
/**
 * Echo the doctype and opening markup.
 *
 * If you are going to replace the doctype with a custom one, you must remember to include the opening <html> and
 * <head> elements too, along with the proper attributes.
 *
 * It would be beneficial to also include the <meta> tag for content type.
 *
 * The default doctype is XHTML v1.0 Transitional, unless HTML support os present in the child theme.
 *
 * @since 1.3.0
 *
 * @uses genesis_html()          Check for HTML5 support.
 * @uses genesis_html5_doctype() Markup for HTML5 output.
 * @uses genesis_xhtml_doctype() Markup for XHTML output.
 */
function genesis_do_doctype() {

	if ( genesis_html5() )
		genesis_html5_doctype();
	else
		genesis_xhtml_doctype();

}

/**
 * XHTML 1.0 Transitional doctype markup.
 *
 * @since 2.0.0
 */
function genesis_xhtml_doctype() {

	?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<?php

}

/**
 * HTML5 doctype markup.
 *
 * @since 2.0.0
 */
function genesis_html5_doctype() {

	?><!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php

}

add_filter( 'wp_title', 'genesis_doctitle_wrap', 20 );
/**
 * Wraps the page title in a `title` element.
 *
 * Only applies, if not currently in admin, or for a feed.
 *
 * @since 1.3.0
 *
 * @param string $title Page title.
 *
 * @return string Plain text or HTML markup
 */
function genesis_doctitle_wrap( $title ) {

	return is_feed() || is_admin() ? $title : sprintf( "<title>%s</title>\n", $title );

}

add_action( 'genesis_title', 'wp_title' );
add_filter( 'wp_title', 'genesis_default_title', 10, 3 );
/**
 * Return filtered post title.
 *
 * This function does 3 things:
 *  1. Pulls the values for `$sep` and `$seplocation`, uses defaults if necessary.
 *  2. Determines if the site title should be appended.
 *  3. Allows the user to set a custom title on a per-page or per-post basis.
 *
 * @since 0.1.3
 *
 * @uses genesis_get_seo_option() Get SEO setting value
 * @uses genesis_get_custom_field() Get custom field value
 *
 * @global WP_Query $wp_query Query object.
 *
 * @param string $title       Existing page title.
 * @param string $sep         Separator character(s). Default is `–` if not set.
 * @param string $seplocation Separator location - "left" or "right". Default is "right" if not set.
 *
 * @return string Page title
 */
function genesis_default_title( $title, $sep, $seplocation ) {

	global $wp_query;

	if ( is_feed() )
		return trim( $title );

	$sep = genesis_get_seo_option( 'doctitle_sep' ) ? genesis_get_seo_option( 'doctitle_sep' ) : '–';
	$seplocation = genesis_get_seo_option( 'doctitle_seplocation' ) ? genesis_get_seo_option( 'doctitle_seplocation' ) : 'right';

	//* If viewing the home page
	if ( is_front_page() ) {
		//* Determine the doctitle
		$title = genesis_get_seo_option( 'home_doctitle' ) ? genesis_get_seo_option( 'home_doctitle' ) : get_bloginfo( 'name' );

		//* Append site description, if necessary
		$title = genesis_get_seo_option( 'append_description_home' ) ? $title . " $sep " . get_bloginfo( 'description' ) : $title;
	}

	//* if viewing a post / page / attachment
	if ( is_singular() ) {
		//* The User Defined Title (Genesis)
		if ( genesis_get_custom_field( '_genesis_title' ) )
			$title = genesis_get_custom_field( '_genesis_title' );
		//* All-in-One SEO Pack Title (latest, vestigial)
		elseif ( genesis_get_custom_field( '_aioseop_title' ) )
			$title = genesis_get_custom_field( '_aioseop_title' );
		//* Headspace Title (vestigial)
		elseif ( genesis_get_custom_field( '_headspace_page_title' ) )
			$title = genesis_get_custom_field( '_headspace_page_title' );
		//* Thesis Title (vestigial)
		elseif ( genesis_get_custom_field( 'thesis_title' ) )
			$title = genesis_get_custom_field( 'thesis_title' );
		//* SEO Title Tag (vestigial)
		elseif ( genesis_get_custom_field( 'title_tag' ) )
			$title = genesis_get_custom_field( 'title_tag' );
		//* All-in-One SEO Pack Title (old, vestigial)
		elseif ( genesis_get_custom_field( 'title' ) )
			$title = genesis_get_custom_field( 'title' );
	}

	if ( is_category() ) {
		//$term = get_term( get_query_var('cat'), 'category' );
		$term  = $wp_query->get_queried_object();
		$title = ! empty( $term->meta['doctitle'] ) ? $term->meta['doctitle'] : $title;
	}

	if ( is_tag() ) {
		//$term = get_term( get_query_var('tag_id'), 'post_tag' );
		$term  = $wp_query->get_queried_object();
		$title = ! empty( $term->meta['doctitle'] ) ? $term->meta['doctitle'] : $title;
	}

	if ( is_tax() ) {
		$term  = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$title = ! empty( $term->meta['doctitle'] ) ? wp_kses_stripslashes( wp_kses_decode_entities( $term->meta['doctitle'] ) ) : $title;
	}

	if ( is_author() ) {
		$user_title = get_the_author_meta( 'doctitle', (int) get_query_var( 'author' ) );
		$title      = $user_title ? $user_title : $title;
	}

	if ( is_post_type_archive() && genesis_has_post_type_archive_support() ) {
		$title = genesis_get_cpt_option( 'doctitle' ) ? genesis_get_cpt_option( 'doctitle' ) : $title;
	}

	//* If we don't want site name appended, or if we're on the home page
	if ( ! genesis_get_seo_option( 'append_site_title' ) || is_front_page() )
		return esc_html( trim( $title ) );

	//* Else append the site name
	$title = 'right' === $seplocation ? $title . " $sep " . get_bloginfo( 'name' ) : get_bloginfo( 'name' ) . " $sep " . $title;
	return esc_html( trim( $title ) );

}

add_action( 'get_header', 'genesis_doc_head_control' );
/**
 * Remove unnecessary code that WordPress puts in the `head`.
 *
 * @since 1.3.0
 *
 * @uses genesis_get_option() Get theme setting value
 * @uses genesis_get_seo_option() Get SEO setting value
 */
function genesis_doc_head_control() {

	remove_action( 'wp_head', 'wp_generator' );

	if ( ! genesis_get_seo_option( 'head_adjacent_posts_rel_link' ) )
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

	if ( ! genesis_get_seo_option( 'head_wlwmanifest_link' ) )
		remove_action( 'wp_head', 'wlwmanifest_link' );

	if ( ! genesis_get_seo_option( 'head_shortlink' ) )
		remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

	if ( is_single() && ! genesis_get_option( 'comments_posts' ) )
		remove_action( 'wp_head', 'feed_links_extra', 3 );

	if ( is_page() && ! genesis_get_option( 'comments_pages' ) )
		remove_action( 'wp_head', 'feed_links_extra', 3 );

}

add_action( 'genesis_meta', 'genesis_seo_meta_description' );
/**
 * Output the meta description based on contextual criteria.
 *
 * Output nothing if description isn't present.
 *
 * @since 1.2.0
 *
 * @uses genesis_get_seo_option()   Get SEO setting value.
 * @uses genesis_get_custom_field() Get custom field value.
 *
 * @global WP_Query $wp_query Query object
 */
function genesis_seo_meta_description() {

	global $wp_query;

	$description = '';

	//* If we're on the home page
	if ( is_front_page() )
		$description = genesis_get_seo_option( 'home_description' ) ? genesis_get_seo_option( 'home_description' ) : get_bloginfo( 'description' );

	//* If we're on a single post / page / attachment
	if ( is_singular() ) {
		//* Description is set via custom field
		if ( genesis_get_custom_field( '_genesis_description' ) )
			$description = genesis_get_custom_field( '_genesis_description' );
		//* All-in-One SEO Pack (latest, vestigial)
		elseif ( genesis_get_custom_field( '_aioseop_description' ) )
			$description = genesis_get_custom_field( '_aioseop_description' );
		//* Headspace2 (vestigial)
		elseif ( genesis_get_custom_field( '_headspace_description' ) )
			$description = genesis_get_custom_field( '_headspace_description' );
		//* Thesis (vestigial)
		elseif ( genesis_get_custom_field( 'thesis_description' ) )
			$description = genesis_get_custom_field( 'thesis_description' );
		//* All-in-One SEO Pack (old, vestigial)
		elseif ( genesis_get_custom_field( 'description' ) )
			$description = genesis_get_custom_field( 'description' );
	}

	if ( is_category() ) {
		//$term = get_term( get_query_var('cat'), 'category' );
		$term = $wp_query->get_queried_object();
		$description = ! empty( $term->meta['description'] ) ? $term->meta['description'] : '';
	}

	if ( is_tag() ) {
		//$term = get_term( get_query_var('tag_id'), 'post_tag' );
		$term = $wp_query->get_queried_object();
		$description = ! empty( $term->meta['description'] ) ? $term->meta['description'] : '';
	}

	if ( is_tax() ) {
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$description = ! empty( $term->meta['description'] ) ? wp_kses_stripslashes( wp_kses_decode_entities( $term->meta['description'] ) ) : '';
	}

	if ( is_author() ) {
		$user_description = get_the_author_meta( 'meta_description', (int) get_query_var( 'author' ) );
		$description = $user_description ? $user_description : '';
	}

	if ( is_post_type_archive() && genesis_has_post_type_archive_support() ) {
		$description = genesis_get_cpt_option( 'description' ) ? genesis_get_cpt_option( 'description' ) : '';
	}

	//* Add the description if one exists
	if ( $description )
		echo '<meta name="description" content="' . esc_attr( $description ) . '" />' . "\n";

}

add_action( 'genesis_meta', 'genesis_seo_meta_keywords' );
/**
 * Output the meta keywords based on contextual criteria.
 *
 * Outputs nothing if keywords aren't present.
 *
 * @since 1.2.0
 *
 * @uses genesis_get_seo_option()   Get SEO setting value.
 * @uses genesis_get_custom_field() Get custom field value.
 *
 * @global WP_Query $wp_query Query object
 */
function genesis_seo_meta_keywords() {

	global $wp_query;

	$keywords = '';

	//* If we're on the home page
	if ( is_front_page() )
		$keywords = genesis_get_seo_option( 'home_keywords' );

	//* If we're on a single post, page or attachment
	if ( is_singular() ) {
		//* Keywords are set via custom field
		if ( genesis_get_custom_field( '_genesis_keywords' ) )
			$keywords = genesis_get_custom_field( '_genesis_keywords' );
		//* All-in-One SEO Pack (latest, vestigial)
		elseif ( genesis_get_custom_field( '_aioseop_keywords' ) )
			$keywords = genesis_get_custom_field( '_aioseop_keywords' );
		//* Thesis (vestigial)
		elseif ( genesis_get_custom_field( 'thesis_keywords' ) )
			$keywords = genesis_get_custom_field( 'thesis_keywords' );
		//* All-in-One SEO Pack (old, vestigial)
		elseif ( genesis_get_custom_field( 'keywords' ) )
			$keywords = genesis_get_custom_field( 'keywords' );
	}

	if ( is_category() ) {
		$term     = $wp_query->get_queried_object();
		$keywords = ! empty( $term->meta['keywords'] ) ? $term->meta['keywords'] : '';
	}

	if ( is_tag() ) {
		$term     = $wp_query->get_queried_object();
		$keywords = ! empty( $term->meta['keywords'] ) ? $term->meta['keywords'] : '';
	}

	if ( is_tax() ) {
		$term     = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$keywords = ! empty( $term->meta['keywords'] ) ? wp_kses_stripslashes( wp_kses_decode_entities( $term->meta['keywords'] ) ) : '';
	}

	if ( is_author() ) {
		$user_keywords = get_the_author_meta( 'meta_keywords', (int) get_query_var( 'author' ) );
		$keywords = $user_keywords ? $user_keywords : '';
	}

	if ( is_post_type_archive() && genesis_has_post_type_archive_support() ) {
		$keywords = genesis_get_cpt_option( 'keywords' ) ? genesis_get_cpt_option( 'keywords' ) : '';
	}

	//* Add the keywords if they exist
	if ( $keywords )
		echo '<meta name="keywords" content="' . esc_attr( $keywords ) . '" />' . "\n";

}

add_action( 'genesis_meta', 'genesis_robots_meta' );
/**
 * Output the `index`, `follow`, `noodp`, `noydir`, `noarchive` robots meta code in the document `head`.
 *
 * @since 0.1.3
 *
 * @uses genesis_get_seo_option()   Get SEO setting value.
 * @uses genesis_get_custom_field() Get custom field value.
 *
 * @global WP_Query $wp_query Query object.
 *
 * @return null Return early if blog is not public.
 */
function genesis_robots_meta() {

	global $wp_query;

	//* If the blog is private, then following logic is unnecessary as WP will insert noindex and nofollow
	if ( ! get_option( 'blog_public' ) )
		return;

	//* Defaults
	$meta = array(
		'noindex'   => '',
		'nofollow'  => '',
		'noarchive' => genesis_get_seo_option( 'noarchive' ) ? 'noarchive' : '',
		'noodp'     => genesis_get_seo_option( 'noodp' ) ? 'noodp' : '',
		'noydir'    => genesis_get_seo_option( 'noydir' ) ? 'noydir' : '',
	);

	//* Check home page SEO settings, set noindex, nofollow and noarchive
	if ( is_front_page() ) {
		$meta['noindex']   = genesis_get_seo_option( 'home_noindex' ) ? 'noindex' : $meta['noindex'];
		$meta['nofollow']  = genesis_get_seo_option( 'home_nofollow' ) ? 'nofollow' : $meta['nofollow'];
		$meta['noarchive'] = genesis_get_seo_option( 'home_noarchive' ) ? 'noarchive' : $meta['noarchive'];
	}

	if ( is_category() ) {
		$term = $wp_query->get_queried_object();

		$meta['noindex']   = $term->meta['noindex'] ? 'noindex' : $meta['noindex'];
		$meta['nofollow']  = $term->meta['nofollow'] ? 'nofollow' : $meta['nofollow'];
		$meta['noarchive'] = $term->meta['noarchive'] ? 'noarchive' : $meta['noarchive'];

		$meta['noindex']   = genesis_get_seo_option( 'noindex_cat_archive' ) ? 'noindex' : $meta['noindex'];
		$meta['noarchive'] = genesis_get_seo_option( 'noarchive_cat_archive' ) ? 'noarchive' : $meta['noarchive'];

		//* noindex paged archives, if canonical archives is off
		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		$meta['noindex'] = $paged > 1 && ! genesis_get_seo_option( 'canonical_archives' ) ? 'noindex' : $meta['noindex'];
	}

	if ( is_tag() ) {
		$term = $wp_query->get_queried_object();

		$meta['noindex']   = $term->meta['noindex'] ? 'noindex' : $meta['noindex'];
		$meta['nofollow']  = $term->meta['nofollow'] ? 'nofollow' : $meta['nofollow'];
		$meta['noarchive'] = $term->meta['noarchive'] ? 'noarchive' : $meta['noarchive'];

		$meta['noindex']   = genesis_get_seo_option( 'noindex_tag_archive' ) ? 'noindex' : $meta['noindex'];
		$meta['noarchive'] = genesis_get_seo_option( 'noarchive_tag_archive' ) ? 'noarchive' : $meta['noarchive'];

		//* noindex paged archives, if canonical archives is off
		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		$meta['noindex'] = $paged > 1 && ! genesis_get_seo_option( 'canonical_archives' ) ? 'noindex' : $meta['noindex'];
	}

	if ( is_tax() ) {
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

		$meta['noindex']   = $term->meta['noindex'] ? 'noindex' : $meta['noindex'];
		$meta['nofollow']  = $term->meta['nofollow'] ? 'nofollow' : $meta['nofollow'];
		$meta['noarchive'] = $term->meta['noarchive'] ? 'noarchive' : $meta['noarchive'];

		//* noindex paged archives, if canonical archives is off
		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		$meta['noindex'] = $paged > 1 && ! genesis_get_seo_option( 'canonical_archives' ) ? 'noindex' : $meta['noindex'];
	}

	if ( is_post_type_archive() && genesis_has_post_type_archive_support() ) {
		$meta['noindex']   = genesis_get_cpt_option( 'noindex' ) ? 'noindex' : $meta['noindex'];
		$meta['nofollow']  = genesis_get_cpt_option( 'nofollow' ) ? 'nofollow' : $meta['nofollow'];
		$meta['noarchive'] = genesis_get_cpt_option( 'noarchive' ) ? 'noarchive' : $meta['noarchive'];

		//* noindex paged archives, if canonical archives is off
		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		$meta['noindex'] = $paged > 1 && ! genesis_get_seo_option( 'canonical_archives' ) ? 'noindex' : $meta['noindex'];
	}

	if ( is_author() ) {
		$meta['noindex']   = get_the_author_meta( 'noindex', (int) get_query_var( 'author' ) ) ? 'noindex' : $meta['noindex'];
		$meta['nofollow']  = get_the_author_meta( 'nofollow', (int) get_query_var( 'author' ) ) ? 'nofollow' : $meta['nofollow'];
		$meta['noarchive'] = get_the_author_meta( 'noarchive', (int) get_query_var( 'author' ) ) ? 'noarchive' : $meta['noarchive'];

		$meta['noindex']   = genesis_get_seo_option( 'noindex_author_archive' ) ? 'noindex' : $meta['noindex'];
		$meta['noarchive'] = genesis_get_seo_option( 'noarchive_author_archive' ) ? 'noarchive' : $meta['noarchive'];

		//* noindex paged archives, if canonical archives is off
		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		$meta['noindex'] = $paged > 1 && ! genesis_get_seo_option( 'canonical_archives' ) ? 'noindex' : $meta['noindex'];
	}

	if ( is_date() ) {
		$meta['noindex']   = genesis_get_seo_option( 'noindex_date_archive' ) ? 'noindex' : $meta['noindex'];
		$meta['noarchive'] = genesis_get_seo_option( 'noarchive_date_archive' ) ? 'noarchive' : $meta['noarchive'];
	}

	if ( is_search() ) {
		$meta['noindex']   = genesis_get_seo_option( 'noindex_search_archive' ) ? 'noindex' : $meta['noindex'];
		$meta['noarchive'] = genesis_get_seo_option( 'noarchive_search_archive' ) ? 'noarchive' : $meta['noarchive'];
	}

	if ( is_singular() ) {
		$meta['noindex']   = genesis_get_custom_field( '_genesis_noindex' ) ? 'noindex' : $meta['noindex'];
		$meta['nofollow']  = genesis_get_custom_field( '_genesis_nofollow' ) ? 'nofollow' : $meta['nofollow'];
		$meta['noarchive'] = genesis_get_custom_field( '_genesis_noarchive' ) ? 'noarchive' : $meta['noarchive'];
	}

	//* Strip empty array items
	$meta = array_filter( $meta );

	//* Add meta if any exist
	if ( $meta )
		printf( '<meta name="robots" content="%s" />' . "\n", implode( ',', $meta ) );

}

add_action( 'genesis_meta', 'genesis_responsive_viewport' );
/**
 * Optionally output the responsive CSS viewport tag.
 *
 * Child theme needs to support `genesis-responsive-viewport`.
 *
 * @since 1.9.0
 *
 * @return null Return early if child theme does not support viewport.
 */
function genesis_responsive_viewport() {

	if ( ! current_theme_supports( 'genesis-responsive-viewport' ) )
		return;

	echo '<meta name="viewport" content="width=device-width, initial-scale=1" />' . "\n";

}

add_action( 'wp_head', 'genesis_load_favicon' );
/**
 * Echo favicon link if one is found.
 *
 * Falls back to Genesis theme favicon.
 *
 * URL to favicon is filtered via `genesis_favicon_url` before being echoed.
 *
 * @since 0.2.2
 *
 * @uses CHILD_DIR
 * @uses CHILD_URL
 * @uses PARENT_URL
 */
function genesis_load_favicon() {

	//* Allow child theme to short-circuit this function
	$pre = apply_filters( 'genesis_pre_load_favicon', false );

	if ( $pre !== false )
		$favicon = $pre;
	elseif ( file_exists( CHILD_DIR . '/images/favicon.ico' ) )
		$favicon = CHILD_URL . '/images/favicon.ico';
	elseif ( file_exists( CHILD_DIR . '/images/favicon.gif' ) )
		$favicon = CHILD_URL . '/images/favicon.gif';
	elseif ( file_exists( CHILD_DIR . '/images/favicon.png' ) )
		$favicon = CHILD_URL . '/images/favicon.png';
	elseif ( file_exists( CHILD_DIR . '/images/favicon.jpg' ) )
		$favicon = CHILD_URL . '/images/favicon.jpg';
	else
		$favicon = PARENT_URL . '/images/favicon.ico';

	$favicon = apply_filters( 'genesis_favicon_url', $favicon );

	if ( $favicon )
		echo '<link rel="Shortcut Icon" href="' . esc_url( $favicon ) . '" type="image/x-icon" />' . "\n";

}

add_action( 'wp_head', 'genesis_do_meta_pingback' );
/**
 * Adds the pingback meta tag to the head so that other sites can know how to send a pingback to our site.
 *
 * @since 1.3.0
 */
function genesis_do_meta_pingback() {

	if ( 'open' === get_option( 'default_ping_status' ) )
		echo '<link rel="pingback" href="' . get_bloginfo( 'pingback_url' ) . '" />' . "\n";

}

add_action( 'wp_head', 'genesis_canonical', 5 );
/**
 * Echo custom canonical link tag.
 *
 * Remove the default WordPress canonical tag, and use our custom
 * one. Gives us more flexibility and effectiveness.
 *
 * @since 0.1.3
 *
 * @uses genesis_get_seo_option()   Get SEO setting value.
 * @uses genesis_get_custom_field() Get custom field value.
 *
 * @global WP_Query $wp_query Query object.
 *
 * @return null Return null on failure to determine queried object.
 */
function genesis_canonical() {

	//* Remove the WordPress canonical
	remove_action( 'wp_head', 'rel_canonical' );

	global $wp_query;

	$canonical = '';

	if ( is_front_page() )
		$canonical = trailingslashit( home_url() );

	if ( is_singular() ) {
		if ( ! $id = $wp_query->get_queried_object_id() )
			return;

		$cf = genesis_get_custom_field( '_genesis_canonical_uri' );

		$canonical = $cf ? $cf : get_permalink( $id );
	}

	if ( is_category() || is_tag() || is_tax() ) {
		if ( ! $id = $wp_query->get_queried_object_id() )
			return;

		$taxonomy = $wp_query->queried_object->taxonomy;

		$canonical = genesis_get_seo_option( 'canonical_archives' ) ? get_term_link( (int) $id, $taxonomy ) : 0;
	}

	if ( is_author() ) {
		if ( ! $id = $wp_query->get_queried_object_id() )
			return;

		$canonical = genesis_get_seo_option( 'canonical_archives' ) ? get_author_posts_url( $id ) : 0;
	}

	if ( $canonical )
		printf( '<link rel="canonical" href="%s" />' . "\n", esc_url( apply_filters( 'genesis_canonical', $canonical ) ) );

}

add_action( 'wp_head', 'genesis_rel_author' );
/**
 * Echo custom rel="author" link tag.
 *
 * If the appropriate information has been entered, either for the homepage author, or for an individual post/page
 * author, echo a custom rel="author" link.
 *
 * @since 1.9.0
 *
 * @uses genesis_get_seo_option() Get SEO setting value.
 *
 * @global WP_Post $post Post object.
 *
 * @return null Return null on failure.
 */
function genesis_rel_author() {

	global $post;

	if ( is_singular() && post_type_supports( $post->post_type, 'genesis-rel-author' ) && isset( $post->post_author ) && $gplus_url = get_user_option( 'googleplus', $post->post_author ) ) {
		printf( '<link rel="author" href="%s" />' . "\n", esc_url( $gplus_url ) );
		return;
	}

	if ( is_author() && get_query_var( 'author' ) && $gplus_url = get_user_option( 'googleplus', get_query_var( 'author' ) ) ) {
		printf( '<link rel="author" href="%s" />' . "\n", esc_url( $gplus_url ) );
		return;
	}

}

add_action( 'wp_head', 'genesis_rel_publisher' );
/**
 * Echo custom rel="publisher" link tag.
 *
 * If the appropriate information has been entered and we are viewing the front page, echo a custom rel="publisher" link.
 *
 * @since 2.0.2
 *
 * @uses genesis_get_seo_option() Get SEO setting value.
 */
function genesis_rel_publisher() {

	if ( is_front_page() && $publisher_url = genesis_get_seo_option( 'publisher_uri' ) )
		printf( '<link rel="publisher" href="%s" />', esc_url( $publisher_url ) );

}

add_filter( 'genesis_header_scripts', 'do_shortcode' );
add_action( 'wp_head', 'genesis_header_scripts' );
/**
 * Echo header scripts in to wp_head().
 *
 * Allows shortcodes.
 *
 * Applies `genesis_header_scripts` filter on value stored in header_scripts setting.
 *
 * Also echoes scripts from the post's custom field.
 *
 * @since 0.2.3
 *
 * @uses genesis_get_option()       Get theme setting value.
 * @uses genesis_get_custom_field() Echo custom field value.
 */
function genesis_header_scripts() {

	echo apply_filters( 'genesis_header_scripts', genesis_get_option( 'header_scripts' ) );

	//* If singular, echo scripts from custom field
	if ( is_singular() )
		genesis_custom_field( '_genesis_scripts' );

}

add_action( 'after_setup_theme', 'genesis_custom_header' );
/**
 * Activate the custom header feature.
 *
 * It gets arguments passed through add_theme_support(), defines the constants, and calls `add_custom_image_header()`.
 *
 * Applies `genesis_custom_header_defaults` filter.
 *
 * @since 1.6.0
 *
 * @return null Return early if custom header not supported in the theme.
 */
function genesis_custom_header() {

	$custom_header = get_theme_support( 'genesis-custom-header' );
	$wp_custom_header = get_theme_support( 'custom-header' );

	//* If not active (Genesis of WP custom header), do nothing
	if ( ! $custom_header && ! $wp_custom_header )
		return;

	//* Blog title option is obsolete when custom header is active
	add_filter( 'genesis_pre_get_option_blog_title', '__return_empty_array' );

	//* If WP custom header is active, no need to continue
	if ( $wp_custom_header )
		return;

	//* Cast, if necessary
	$custom_header = isset( $custom_header[0] ) && is_array( $custom_header[0] ) ? $custom_header[0] : array();

	//* Merge defaults with passed arguments
	$args = wp_parse_args(
		$custom_header,
		apply_filters(
			'genesis_custom_header_defaults',
			array(
			'width'                 => 960,
			'height'                => 80,
			'textcolor'             => '333333',
			'no_header_text'        => false,
			'header_image'          => '%s/images/header.png',
			'header_callback'       => '',
			'admin_header_callback' => '',
			)
		)
	);

	//* Push $args into theme support array
	add_theme_support( 'custom-header', array(
		'default-image'       => sprintf( $args['header_image'], get_stylesheet_directory_uri() ),
		'header-text'         => $args['no_header_text'] ? false : true,
		'default-text-color'  => $args['textcolor'],
		'width'               => $args['width'],
		'height'              => $args['height'],
		'random-default'      => false,
		'header-selector'     => genesis_html5() ? '.site-header' : '#header',
		'wp-head-callback'    => $args['header_callback'],
		'admin-head-callback' => $args['admin_header_callback'],
	) );

}

add_action( 'wp_head', 'genesis_custom_header_style' );
/**
 * Custom header callback.
 *
 * It outputs special CSS to the document head, modifying the look of the header based on user input.
 *
 * @since 1.6.0
 *
 * @uses genesis_html() Check for HTML5 support.
 *
 * @return null Return null on if custom header not supported, user specified own callback, or no options set.
 */
function genesis_custom_header_style() {

	//* Do nothing if custom header not supported
	if ( ! current_theme_supports( 'custom-header' ) )
		return;

	//* Do nothing if user specifies their own callback
	if ( get_theme_support( 'custom-header', 'wp-head-callback' ) )
		return;

	$output = '';

	$header_image = get_header_image();
	$text_color   = get_header_textcolor();

	//* If no options set, don't waste the output. Do nothing.
	if ( empty( $header_image ) && ! display_header_text() && $text_color === get_theme_support( 'custom-header', 'default-text-color' ) )
		return;

	$header_selector = get_theme_support( 'custom-header', 'header-selector' );
	$title_selector  = genesis_html5() ? '.custom-header .site-title'       : '.custom-header #title';
	$desc_selector   = genesis_html5() ? '.custom-header .site-description' : '.custom-header #description';

	//* Header selector fallback
	if ( ! $header_selector )
		$header_selector = genesis_html5() ? '.custom-header .site-header' : '.custom-header #header';

	//* Header image CSS, if exists
	if ( $header_image )
		$output .= sprintf( '%s { background: url(%s) no-repeat !important; }', $header_selector, esc_url( $header_image ) );

	//* Header text color CSS, if showing text
	if ( display_header_text() && $text_color !== get_theme_support( 'custom-header', 'default-text-color' ) )
		$output .= sprintf( '%2$s a, %2$s a:hover, %3$s { color: #%1$s !important; }', esc_html( $text_color ), esc_html( $title_selector ), esc_html( $desc_selector ) );

	if ( $output )
		printf( '<style type="text/css">%s</style>' . "\n", $output );

}

add_action( 'genesis_header', 'genesis_header_markup_open', 5 );
/**
 * Echo the opening structural markup for the header.
 *
 * @since 1.2.0
 *
 * @uses genesis_markup()          Apply contextual markup.
 * @uses genesis_structural_wrap() Maybe add opening .wrap div tag with header context.
 */
function genesis_header_markup_open() {

	genesis_markup( array(
		'html5'   => '<header %s>',
		'xhtml'   => '<div id="header">',
		'context' => 'site-header',
	) );

	genesis_structural_wrap( 'header' );

}

add_action( 'genesis_header', 'genesis_header_markup_close', 15 );
/**
 * Echo the opening structural markup for the header.
 *
 * @since 1.2.0
 *
 * @uses genesis_structural_wrap() Maybe add closing .wrap div tag with header context.
 * @uses genesis_markup()          Apply contextual markup.
 */
function genesis_header_markup_close() {

	genesis_structural_wrap( 'header', 'close' );
	genesis_markup( array(
		'html5' => '</header>',
		'xhtml' => '</div>',
	) );

}

add_action( 'genesis_header', 'genesis_do_header' );
/**
 * Echo the default header, including the #title-area div, along with #title and #description, as well as the .widget-area.
 *
 * Does the `genesis_site_title`, `genesis_site_description` and `genesis_header_right` actions.
 *
 * @since 1.0.2
 *
 * @global $wp_registered_sidebars Holds all of the registered sidebars.
 *
 * @uses genesis_markup() Apply contextual markup.
 */
function genesis_do_header() {

	global $wp_registered_sidebars;

	genesis_markup( array(
		'html5'   => '<div %s>',
		'xhtml'   => '<div id="title-area">',
		'context' => 'title-area',
	) );
	do_action( 'genesis_site_title' );
	do_action( 'genesis_site_description' );
	echo '</div>';

	if ( ( isset( $wp_registered_sidebars['header-right'] ) && is_active_sidebar( 'header-right' ) ) || has_action( 'genesis_header_right' ) ) {
		genesis_markup( array(
			'html5'   => '<aside %s>',
			'xhtml'   => '<div class="widget-area header-widget-area">',
			'context' => 'header-widget-area',
		) );

			do_action( 'genesis_header_right' );
			add_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
			add_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );
			dynamic_sidebar( 'header-right' );
			remove_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
			remove_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );

		genesis_markup( array(
			'html5' => '</aside>',
			'xhtml' => '</div>',
		) );
	}

}

add_action( 'genesis_site_title', 'genesis_seo_site_title' );
/**
 * Echo the site title into the header.
 *
 * Depending on the SEO option set by the user, this will either be wrapped in an `h1` or `p` element.
 *
 * Applies the `genesis_seo_title` filter before echoing.
 *
 * @since 1.1.0
 *
 * @uses genesis_get_seo_option() Get SEO setting value.
 * @uses genesis_html5()          Check or HTML5 support.
 */
function genesis_seo_site_title() {

	//* Set what goes inside the wrapping tags
	$inside = sprintf( '<a href="%s" title="%s">%s</a>', trailingslashit( home_url() ), esc_attr( get_bloginfo( 'name' ) ), get_bloginfo( 'name' ) );

	//* Determine which wrapping tags to use
	$wrap = is_home() && 'title' === genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : 'p';

	//* A little fallback, in case an SEO plugin is active
	$wrap = is_home() && ! genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : $wrap;

	//* And finally, $wrap in h1 if HTML5 & semantic headings enabled
	$wrap = genesis_html5() && genesis_get_seo_option( 'semantic_headings' ) ? 'h1' : $wrap;

	//* Build the title
	$title  = genesis_html5() ? sprintf( "<{$wrap} %s>", genesis_attr( 'site-title' ) ) : sprintf( '<%s id="title">%s</%s>', $wrap, $inside, $wrap );
	$title .= genesis_html5() ? "{$inside}</{$wrap}>" : '';

	//* Echo (filtered)
	echo apply_filters( 'genesis_seo_title', $title, $inside, $wrap );

}

add_action( 'genesis_site_description', 'genesis_seo_site_description' );
/**
 * Echo the site description into the header.
 *
 * Depending on the SEO option set by the user, this will either be wrapped in an `h1` or `p` element.
 *
 * Applies the `genesis_seo_description` filter before echoing.
 *
 * @since 1.1.0
 *
 * @uses genesis_get_seo_option() Get SEO setting value.
 * uses genesis_html5()           Check for HTML5 support.
 */
function genesis_seo_site_description() {

	//* Set what goes inside the wrapping tags
	$inside = esc_html( get_bloginfo( 'description' ) );

	//* Determine which wrapping tags to use
	$wrap = is_home() && 'description' === genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : 'p';

	//* And finally, $wrap in h2 if HTML5 & semantic headings enabled
	$wrap = genesis_html5() && genesis_get_seo_option( 'semantic_headings' ) ? 'h2' : $wrap;

	//* Build the description
	$description  = genesis_html5() ? sprintf( "<{$wrap} %s>", genesis_attr( 'site-description' ) ) : sprintf( '<%s id="description">%s</%s>', $wrap, $inside, $wrap );
	$description .= genesis_html5() ? "{$inside}</{$wrap}>" : '';

	//* Output (filtered)
	$output = $inside ? apply_filters( 'genesis_seo_description', $description, $inside, $wrap ) : '';

	echo $output;

}

/**
 * Sets a common class, `.genesis-nav-menu`, for the custom menu widget if used in the header right sidebar.
 *
 * @since 1.9.0
 *
 * @uses genesis_html5() Check for HTML5 support.
 * @uses genesis_superfish_enabled() Check for superfish support.
 *
 * @param  array $args Header menu args.
 *
 * @return array $args Modified header menu args.
 */
function genesis_header_menu_args( $args ) {

	$args['container']   = genesis_html5() ? '' : 'div';
	$args['menu_class'] .= ' genesis-nav-menu';
	$args['menu_class'] .= genesis_superfish_enabled() ? ' js-superfish' : '';

	return $args;

}

/**
 * Wrap the header navigation menu in its own nav tags with markup API.
 *
 * @since 2.0.0
 *
 * @uses genesis_html5() Check for HTML5 support.
 *
 * @param  $menu Menu output.
 *
 * @return string $menu Modified menu output.
 */
function genesis_header_menu_wrap( $menu ) {

	if ( ! genesis_html5() )
		return $menu;

	return sprintf( '<nav %s>', genesis_attr( 'nav-header' ) ) . $menu . '</nav>';

}
