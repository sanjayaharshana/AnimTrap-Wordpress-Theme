<?php
/**
 * The loop for pages
 *
 * @package Simple Blog Theme
 */
?>
<!-- The Loop -->

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> 

  

  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <!--generate page / post header-->
    <header class="bg-primary text-white">
    <div class="row">
      
      <br><br><br>
      <div class="container text-center">
        <?php the_title( '<h1>', '</h1>' ); ?>
        <p>Apple Engince</p>
       <br><br>
       
      </div>
    </div>
      
    </header>
    
    <!--display thumbnail if has thumbnail -->
    <?php if ( has_post_thumbnail() ) {
      the_post_thumbnail( $size = 'post-thumbnail', $attr = 'class=img-responsive');
      ?><hr><?php
    } ?>
    <!--end display thumbnail-->

    <div class="entry-content">  
    <div class="container"> 
    <div class="row">
    <div class="col-md-2"></div>
      <div class="col-md-6">
        <?php the_content(); ?> 
      </div>
      <div class="col-md-4">
      <div class="sidebar-nav-fixed pull-right affix">
      <br>
      <div class="list-group-item-primary">
        <a class="btn btn-primary" href="get_round/page/welcome_note.php" role="button">Our Services</a>
        <a class="btn btn-primary" href="get_round/page/welcome_note.php" role="button">Our Services</a>
      <hr>
      </div>
      </div> 
      </div>
    </div>
    
    </div>
    </div> 
       
    </div>

  </article>

<?php endwhile; else : ?>
  <p><?php _e( 'Sorry, there doesn\'t appear to be anything here.' ); ?></p>
<?php endif; ?>

<!--end loop-->

