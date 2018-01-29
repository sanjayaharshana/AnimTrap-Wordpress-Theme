<?php 
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * It is used to display a page when nothing more specific matches a query.
 * It puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Simple Blog Theme
 */

 get_header(); ?>   
<?php // get_template_part( 'sliderpack/slider' ); ?>
<?php // get_template_part( 'template-parts/content' ); ?>

 <header class="bg-primary text-white">
<div class="" data-animscroll="fade-up">
 <br><br><br>
 <?php if (get_theme_mod('lwp-footer-callout-display') == "Yes") { ?>
      <div class="container text-center">
        <h1><?php echo get_theme_mod('lwp-footer-callout-headline') ?></h1>
        <p class="lead"><?php echo wpautop(get_theme_mod('lwp-footer-callout-text')) ?></p>
      </div><br><br>
  </div>
  </header>

  <div class="row">
        <div class="container">

    <div class="footer-callout clearfix">
      <div class="footer-callout-image">
        <a href="<?php echo get_permalink(get_theme_mod('lwp-footer-callout-link')) ?>"><img src="<?php echo wp_get_attachment_url(get_theme_mod('lwp-footer-callout-image')) ?>"></a>
      </div>     
    <?php } ?>




<?php  get_template_part( 'template-parts/millayer' ); ?>
<?php  get_template_part( 'template-parts/blogroad' ); ?>
<?php  get_template_part( 'template-parts/content' ); ?>

<?php get_footer(); ?>


  </div>



<?php //get_footer(); ?>