<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Comley
 * @since Comley 1.0
 */
?>
<?php if ( is_single() ) : ?>
<div class="entry">
   <?php else : ?> 
    <div class="left-section wow fadeInUp">
        <?php endif; ?>
         <header class="entry-header wow fadeInUp">
                <h2 class="entry-title"><?php comley_post_title(); ?></h2>
                <!--entry-meta--> 
              </header>
              <div class="entry-summary wow fadeInUp"> <?php comley_post_thumbnail(); ?>
                  <?php the_content(); ?>
              </div>
              <!--entry-summary--> 
            </div>
            <!--entry-->