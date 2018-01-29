
<head>
  <style type="text/css">
<!--


.css3-shadow,
.css3-gradient1,
.css3-gradient2
{
    position:relative;
  -webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);
            box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);
}

/*==================================================
 * Drop shadow effect with box-shadow
 * ===============================================*/
.css3-shadow:after
{
  content:"";
    position:absolute;
    z-index:-1;
    -webkit-box-shadow:0 0 40px rgba(0,0,0,0.8);
        box-shadow:0 0 40px rgba(0,0,0,0.8);
    bottom:0px;
  width:80%;
  height:50%;
    -moz-border-radius:100%;
    border-radius:100%;
  left:10%;
  right:10%;
}

/*==================================================
 * Drop shadow effect with radial gradient
 * ===============================================*/
.css3-gradient1:after{
  content:"";
    position:absolute;
    z-index:-1;
    top:100%;
    bottom:0;
  width:120%;
  height:50px;
  left:-10%;
  right:-10%;
background:-webkit-radial-gradient(50% -3%, ellipse cover, rgba(00, 00, 00, 0.5), rgba(97, 97, 97, 0.0) 40%);
background:      radial-gradient(ellipse at 50% -3%, rgba(00, 00, 00, 0.5), rgba(97, 97, 97, 0.0) 40%);
}

/*==================================================
 * Glow effect with box-shadow
 * ===============================================*/
.css3-gradient2:after{
  content:"";
    position:absolute;
    z-index:-1;
    top:100%;
    bottom:0;
  width:120%;
  height:90px;
  left:-10%;
  right:-10%;
background: -webkit-radial-gradient(50% -3%, ellipse cover, rgba(96, 251, 202, 0.8), rgba(112, 220, 255, 0.5), rgba(255, 116, 225, 0.0) 50%), -webkit-radial-gradient(80% 10%, circle contain, rgba(96, 251, 202, 0.8), rgba(255, 255, 255, 0.0) 180%), -webkit-radial-gradient(90% 20%, circle contain, rgba(255, 255, 202, 0.8), rgba(255, 255, 255, 0.0) 60%);
background:radial-gradient(ellipse at 50% -3%, rgba(96, 251, 202, 0.8), rgba(112, 220, 255, 0.5), rgba(255, 116, 225, 0.0) 50%), radial-gradient(circle at 80% 10%, rgba(96, 251, 202, 0.8), rgba(255, 255, 255, 0.0) 2%), radial-gradient(circle at 90% 20%, rgba(255, 251, 202, 0.8), rgba(255, 255, 255, 0.0) 1%);
}


/*Those styles are for the tutorial page only, you can delete them*/
body {
  
}
.wrap1,
.wrap2{
  padding:10px 0 30px;
  background:url(22.jpg) center top;
  position:relative;
  z-index:-10;
}
.wrap1{
  background:#098fb6;
}
.box h4{
  background:#eee;
  margin:0;
  padding:60px 20px;
  text-align:center;
  -webkit-box-shadow:0 0px 4px rgba(0, 0, 0, 0.2);
            box-shadow:0 0px 4px rgba(0, 0, 0, 0.2);
}
.box {
  padding:20px;
  background:#fff;
  margin:20px auto 60px;
  border-radius:2px;
}


-->
</style>

<style>
  /* Just to align the container */


</style>

</head>



<div class="container">

 <div class="row">
<?php
/**
 * The loop for index.php and any other pages that don't have a more specific loop
 *
 * @package Simple Blog Theme
 */
?>

<!-- The Loop -->

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <article id="post-<?php the_ID(); ?>"div class="col-6 col-md-4" <?php post_class(); ?>>
  <div class="<?php echo esc_attr( get_option('blog_card_hover') ); ?>">
<div class="" style=""> 

</div>

    
  <div class="box css3-shadow" style="" ><div class="" data-animscroll="fade-up"> 



    <!--generate page / post header-->
    <?php if ( is_front_page() && is_home() ) {

      // Front page is posts page
   

    } elseif ( is_front_page() ) {

      // Static homepage, do nothing

    } elseif ( is_home() ) {

 

    } elseif ( is_single() ) {

      // Single posts
      ?><header>

        <h1><?php the_title(); ?></h1>
        <p class="lead">by <?php the_author_posts_link(); ?></p>
        <hr>
        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php the_date( $format = 'l, F j, Y, \a\t g:i A' ); ?>
      </div>
      </header>
      <hr><?php
    } ?>
    <!--end generate post/page header -->
    
    <!--display thumbnail if has thumbnail -->
    <?php if ( has_post_thumbnail() ) {
      the_post_thumbnail( $size = 'post-thumbnail', $attr = 'class=img-responsive');
      ?><hr><?php
    } ?>
    <!--end display thumbnail-->

      <h1>
    <?php the_title( sprintf( '', esc_url( get_permalink() ) ), '</a>' ); ?>
  </h1>

    <!--display excerpt for posts page and content everywhere else-->
    <div class="entry-content">
      <?php if ( is_home() ) {
        the_excerpt();
        ?><a class="btn btn-primary" href="<?php the_permalink(); ?>">Read More</a><hr><?php
      } else {
        the_content();
      } ?>
    </div>
    <!--end display excerpt or content-->
  </article>

  <!--display comments if on a single post or page and comments are enabled-->
  <?php if ( is_single()) {
    if ( have_comments() or comments_open() ) {
      /* Add comments section here */
    }
  } ?>
  <!--end comments-->

<?php endwhile; else : ?>
  <p><?php _e( 'Sorry, there doesn\'t appear to be anything here.' ); ?></p>
<?php endif; ?>

<!--end loop-->
</div>
</div>


  </div>
</div>