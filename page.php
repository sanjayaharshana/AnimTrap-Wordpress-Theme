<?php
/**
 * The page template
 *
 * Displays the content portion of all individual pages
 *
 * @package Simple Blog Theme
 */
  
get_header(); ?>

<!-- Page Content -->

<?php get_template_part( 'template-parts/content' , 'page' ); ?>    
    <!-- Blog Entries Column -->
   
  <?php get_sidebar(); ?>    
  <?php get_footer(); ?>