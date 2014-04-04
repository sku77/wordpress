<?php  get_header(); ?>
	<div class="content">
		<div class="content-heading">
					<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
					<?php /* If this is a category archive */ if (is_category()) { ?>
					<h2>Archive for <?php single_cat_title(); ?></h1>
					<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
					<h2>Tagged <?php single_tag_title(); ?></h1>
					<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
					<h2>Archive for <?php the_time('F jS, Y'); ?></h1>
					<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
					<h2>Archive for <?php the_time('F, Y'); ?></h1>
					<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
					<h2>Archive for <?php the_time('Y'); ?></h1>
					<?php /* If this is an author archive */ } elseif (is_author()) { ?>
					<h2>Författararkiv</h1>
					<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
					<h2>Archives</h2>
					<?php } ?>
		</div>
			<?php global $query_string;query_posts($query_string . '&order=DESC&post_status=publish&posts_per_page=5');
			if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<h4><?php the_author_posts_link(); ?> on <?php the_time('j F, Y'); ?></h4>
				<p><?php the_excerpt(); ?></p>
				
				<?php endwhile; endif; ?>
						
				<div class="navigation">
					<div class="alignleft"><?php next_posts_link('<< Previous') ?></div>
					<div class="alignright"><?php previous_posts_link('Next entries >>') ?></div>
				</div>
			<?php wp_reset_query(); ?>
		</div>
		
	<?php  get_sidebar(); ?>

<?php  get_footer(); ?>