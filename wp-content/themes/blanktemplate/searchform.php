<form id="searchform" method="get" action="<?php  bloginfo('siteurl'); ?>">
		<div id="s-container">
				<label class="screen-reader-text" for="s"></label>
				<input id="s" class="searchbg" type="text" value="Search this site" name="s" 
				onfocus="this.value=(this.value=='Search this site') ? '' : this.value;" 
				onblur="this.value=(this.value=='') ? 'Search this site' : this.value;"/>
				<input id="searchsubmit" class="search-button" title="search" type="image" 
				alt="mag" src="<?php  bloginfo('template_url'); ?>/images/mag.png"/>
		</div>
</form>
				
				
