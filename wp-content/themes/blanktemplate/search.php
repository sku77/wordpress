<div class="content">
				
	<?php  if (have_posts()) : ?>
				
		<div class="content-heading">
		<h2>Search Results</h2>
		</div>
			<?php while (have_posts()) :the_post();?>
			<div <?php  post_class()   ?> id="post-<?php  the_ID(); ?>">
			<h2><?php  the_title(); ?></h2>
			<?php  the_excerpt(); ?>
			</div>
					
			<?php  endwhile; ?>
								
			<?php  else : ?>
						
			<div class="content-heading">
			<h2>Search Results</h2>	
			</div>
			<p>We are sorry, we can't find what you are looking for.</p>
			
	<?php  endif; ?>

</div>
