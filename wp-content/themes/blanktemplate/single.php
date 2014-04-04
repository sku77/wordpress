<?php get_header(); ?>

<div class="content">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
		
		<div class="content-heading">
		<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
		</div>
		
		<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>

		<div class="content-wrapper">
		<?php the_content(); ?>
		<?php wp_link_pages(array('before' => 'Posts: ', 'next_or_number' => 'number')); ?>
		<?php the_tags( 'Tags: ', ', ', ''); ?>
		</div>
		
		<?php edit_post_link('Edit this entry','','.'); ?>
		
	</div>

	<?php endwhile; ?>

	<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>

	<?php else : ?>
	
	<div class="content-heading">
	<h2>Post Not Found</h2>
	</div>

<?php endif; ?>

</div>

<?php get_footer(); ?>