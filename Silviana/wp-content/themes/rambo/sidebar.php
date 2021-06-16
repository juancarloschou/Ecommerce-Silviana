<?php if(is_active_sidebar('sidebar-primary')){ ?>
<div class="span4 sidebar">	
			       <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-primary') ) : ?> 
					<?php endif;?>
</div>
<?php } ?>