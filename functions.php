<?php
/**
 * The theme functions file
 *
 * @package Simple Blog Theme
 */

/* enqueue styles and scripts */
function jpen_enqueue_assets() {
  /* theme's primary style.css file */
  wp_enqueue_style( 'main-css' , get_stylesheet_uri() );

  /* template's primary css file */
  wp_enqueue_style( 'startup-boostrap-css' , get_template_directory_uri() . './css/blog-post.css' );

  /* boostrap resources from theme files */
  wp_enqueue_script( 'ANIMSCROLL-js',  get_template_directory_uri() . '/js/anim-scroll.js' , array('jquery') );
  wp_enqueue_style( 'bootstrap-css' , get_template_directory_uri() . '/css/bootstrap.min.css' );
  wp_enqueue_style( 'animtrap-css' , get_template_directory_uri() . '/css/animtrap.min.css' );
  wp_enqueue_script( 'bootstrap-js' , get_template_directory_uri() . '/js/bootstrap.min.js' , array( 'jquery' ) , false , true );
  //animtrpjs
  //wp_enqueue_script( 'animtrap-js' , get_template_directory_uri() . '/js/anim-scroll.js' , array('animtrpjs') , false , true );
  
  //wp_enqueue_script( 'animr-js' , get_template_directory_uri() . '/js/animr.js' ,array(), '3.7.0' );

  /*conditional resources for IE 9 */
 
  wp_enqueue_script( 'simple-blog-html5', 'https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js' , array(), '3.7.0' );
  wp_script_add_data( 'simple-blog-html5', 'conditional', 'lt IE 9' );
  wp_enqueue_script( 'simple-blog-respondjs', 'https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js' , array(), '1.4.2' );
  wp_script_add_data( 'simple-blog-respondjs', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts' , 'jpen_enqueue_assets' );

//sj file
function animtrpjsopl() {
  echo "<script> ANIMSCROLL.init({
        easing: 'ease-in-out-sine'
    });
</script>\n";
}
add_action( 'wp_footer', 'animtrpjsopl', 0 );


/* add theme menu area */
register_nav_menus (array(
  'primary' => 'Primary Menu',
));


/* add theme supports */
add_theme_support( 'post-thumbnails' ); 


/* add img-responsive class to all images */
function jpen_add_responsive_class($content){

  $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
  $document = new DOMDocument();
  libxml_use_internal_errors(true);
  $document->loadHTML(utf8_decode($content));

  $imgs = $document->getElementsByTagName('img');
  foreach ($imgs as $img) {           
     $img->setAttribute('class','img-responsive');
  }

  $html = $document->saveHTML();
  return $html;   
}
add_filter( 'the_content', 'jpen_add_responsive_class');


/* register widget areas */
function jpen_sidebar_widget_area() {
  register_sidebar( array(
    'name'          => 'Sidebar Widget Area',
    'id'            => 'jpen-sidebar-widgets',
    'before_widget' => '<div class="well">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
    ));
}
add_action( 'widgets_init' , 'jpen_sidebar_widget_area' );



/*return formatted excerpt */
/* code courtesy of Pieter Goosen at WordPress StackExchange */
/* http://wordpress.stackexchange.com/questions/141125/allow-html-in-excerpt#answer-141136 */
function jpen_allowedtags() {
    // Add custom tags to this string
        return '<table>,<thead>,<tbody>,<tfoot>,<tr>,<td>,<th>,<h1>,<h2>,<h3>,<script>,<style>,<br>,<em>,<i>,<ul>,<ol>,<li>,<a>,<p>,<img>,<video>,<audio>'; 
    }

if ( ! function_exists( 'jpen_custom_wp_trim_excerpt' ) ) : 

  function jpen_custom_wp_trim_excerpt($jpen_excerpt) {
  $raw_excerpt = $jpen_excerpt;
    if ( '' == $jpen_excerpt ) {

      $jpen_excerpt = get_the_content('');
      $jpen_excerpt = strip_shortcodes( $jpen_excerpt );
      $jpen_excerpt = apply_filters('the_content', $jpen_excerpt);
      $jpen_excerpt = str_replace(']]>', ']]&gt;', $jpen_excerpt);
      $jpen_excerpt = strip_tags($jpen_excerpt, jpen_allowedtags()); /*IF you need to allow just certain tags. Delete if all tags are allowed */

      //Set the excerpt word count and only break after sentence is complete.
      $excerpt_word_count = 75;
      $excerpt_length = apply_filters('excerpt_length', $excerpt_word_count); 
      $tokens = array();
      $excerptOutput = '';
      $count = 0;

      // Divide the string into tokens; HTML tags, or words, followed by any whitespace
      preg_match_all('/(<[^>]+>|[^<>\s]+)\s*/u', $jpen_excerpt, $tokens);

      foreach ($tokens[0] as $token) { 

        if ($count >= $excerpt_length && preg_match('/[\,\;\?\.\!]\s*$/uS', $token)) { 
        // Limit reached, continue until , ; ? . or ! occur at the end
          $excerptOutput .= trim($token);
          break;
        }

        // Add words to complete sentence
        $count++;

        // Append what's left of the token
        $excerptOutput .= $token;
      }

      $jpen_excerpt = trim(force_balance_tags($excerptOutput));

      //$excerpt_end = ' <a href="'. esc_url( get_permalink() ) . '">' . '&nbsp;&raquo;&nbsp;' . sprintf(__( 'Read more about: %s &nbsp;&raquo;', 'jpen' ), get_the_title()) . '</a>'; 
      $excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end); 

      //$pos = strrpos($jpen_excerpt, '</');
      //if ($pos !== false)
      // Inside last HTML tag
      //$jpen_excerpt = substr_replace($jpen_excerpt, $excerpt_end, $pos, 0); /* Add read more next to last word */
      //else
      // After the content
      $jpen_excerpt .= $excerpt_more; /*Add read more in new paragraph */

    return $jpen_excerpt;   

    }
  return apply_filters('jpen_custom_wp_trim_excerpt', $jpen_excerpt, $raw_excerpt);
  } 

endif; 

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'jpen_custom_wp_trim_excerpt'); 



/* Walker class for comments */
/* Adapted from GitHub Gist by Georgie Luhur */
/* Original: https://gist.github.com/georgiecel/9445357 */
class comment_walker extends Walker_Comment {
  var $tree_type = 'comment';
  var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );
 
  // constructor – wrapper for the comments list
  function __construct() { ?>
    <section class="comments-list">
  <?php }

  // start_lvl – wrapper for child comments list
  function start_lvl( &$output, $depth = 0, $args = array() ) {
    $GLOBALS['comment_depth'] = $depth + 2; ?>
    <div class="media">
  <?php }
  
  // end_lvl – closing wrapper for child comments list
  function end_lvl( &$output, $depth = 0, $args = array() ) {
    $GLOBALS['comment_depth'] = $depth + 2; ?>
    </div>
  <?php }

  // start_el – HTML for comment template
  function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
    $depth++;
    $GLOBALS['comment_depth'] = $depth;
    $GLOBALS['comment'] = $comment;
    $parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); 
  
    if ( 'article' == $args['style'] ) {
      $tag = 'article';
      $add_below = 'comment';
    } else {
      $tag = 'article';
      $add_below = 'comment';
    } ?>

    <div class="media" <?php comment_class(empty( $args['has_children'] ) ? '' :'parent') ?> id="comment-<?php comment_ID() ?>" itemprop="comment" itemscope itemtype="http://schema.org/Comment">
      <a class="pull-left comment-author-link" href="<?php comment_author_url(); ?>" itemprop="author">
        <figure class="media-object gravatar"><?php echo get_avatar( $comment, 65, '[default gravatar URL]', 'Author’s gravatar' ); ?></figure>
      </a>
      <div class="media-body comment-meta post-meta" role="complementary">
        <h4 class="media-heading comment-author">
          <?php comment_author(); ?>
          <small><time class="comment-meta-item" datetime="<?php comment_date('Y-m-d') ?>T<?php comment_time('H:iP') ?>" itemprop="datePublished"><?php comment_date('jS F Y') ?> at <a href="#comment-<?php comment_ID() ?>" itemprop="url"><?php comment_time() ?></a></time></small>
        </h4>
        <?php if ($comment->comment_approved == '0') : ?>
        <p class="comment-meta-item">Your comment is awaiting moderation.</p>
        <?php endif; ?>
        <?php comment_text() ?>
        <small><?php edit_comment_link('Edit this comment','You can ',' or '); ?><?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></small>       

    <?php }

  // end_el – closing HTML for comment template
  function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>
    </div></div>
  <?php }

  // destructor – closing wrapper for the comments list
  function __destruct() { ?>
    </section>
  <?php }

  }



/* Sidebar Categories Widget */

// create category list widget
class jpen_Category_List_Widget extends WP_Widget {

  // php classnames and widget name/description added
  function __construct() {
    $widget_options = array(
      'classname' => 'jpen_category_list_widget',
      'description' => 'Add a nicely formatted list of categories to your sidebar.'
    );
    parent::__construct( 
      'jpen_category_list_widget', 
      'Simple Blog Theme Category List', 
      $widget_options 
    );
  }


  // create the widget output
  function widget( $args, $instance ) {
    
    $title = apply_filters( 'widget_title', $instance[ 'title' ] );
    $categories = get_categories( array(
      'orderby' => 'name',
      'order'   => 'ASC'
      ) );
    $cat_count = 0;
    $cat_col_one = [];
    $cat_col_two = [];
    foreach( $categories as $category ) {
      $cat_count ++;
      $category_link = sprintf( 
          '<li class="list-unstyled"><a href="%1$s" alt="%2$s">%3$s</a></li>',
          esc_url( get_category_link( $category->term_id ) ),
          esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
          esc_html( $category->name )
      );
      if ($cat_count % 2 != 0 ) {
        $cat_col_one[] = $category_link;
      } else {
        $cat_col_two[] = $category_link;
      }
    }

    echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];

    ?><div class="row">
      <div class="col-lg-6"><?php
        foreach( $cat_col_one as $cat_one ) {
          echo $cat_one;
        } ?>
      </div>

      <div class="col-lg-6"><?php 
        foreach( $cat_col_two as $cat_two ) {
          echo $cat_two;
        } ?>
      </div>

    </div><?php
    echo $args['after_widget'];
  }

  function form( $instance ) { 
    $title = ! empty( $instance['title'] ) ? $instance['title'] : ''; ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
      <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <p>This widget displays all of your post categories as a two-column list (or a one-column list when rendered responsively).</p>
  <?php }

  // Update database with new info
  function update( $new_instance, $old_instance ) { 
    $instance = $old_instance;
    $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
    return $instance;
  }
}


// register the widget
function jpen_register_widgets() { 
  register_widget( 'jpen_Category_List_Widget' );
}
add_action( 'widgets_init', 'jpen_register_widgets' );

//own open
function lwp_footer_callout($wp_customize) {
  $wp_customize->add_section('lwp-footer-callout-section', array(
    'title' => 'Head Box'
  ));

  $wp_customize->add_setting('lwp-footer-callout-display', array(
    'default' => 'No'
  ));

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'lwp-footer-callout-display-control', array(
      'label' => 'Display this section?',
      'section' => 'lwp-footer-callout-section',
      'settings' => 'lwp-footer-callout-display',
      'type' => 'select',
      'choices' => array('No' => 'No', 'Yes' => 'Yes')
    )));

  $wp_customize->add_setting('lwp-footer-callout-headline', array(
    'default' => 'Example Headline Text!'
  ));

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'lwp-footer-callout-headline-control', array(
      'label' => 'Headline',
      'section' => 'lwp-footer-callout-section',
      'settings' => 'lwp-footer-callout-headline'
    )));

  $wp_customize->add_setting('lwp-footer-callout-text', array(
    'default' => 'Example paragraph text.'
  ));

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'lwp-footer-callout-text-control', array(
      'label' => 'Text',
      'section' => 'lwp-footer-callout-section',
      'settings' => 'lwp-footer-callout-text',
      'type' => 'textarea'
    )));

  $wp_customize->add_setting('lwp-footer-callout-link');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'lwp-footer-callout-link-control', array(
      'label' => 'Link',
      'section' => 'lwp-footer-callout-section',
      'settings' => 'lwp-footer-callout-link',
      'type' => 'dropdown-pages'
    )));

  $wp_customize->add_setting('lwp-footer-callout-image');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'lwp-footer-callout-image-control', array(
      'label' => 'Image',
      'section' => 'lwp-footer-callout-section',
      'settings' => 'lwp-footer-callout-image',
      'width' => 750,
      'height' => 500
    )));

   $wp_customize->add_setting('lwp-footer-callout-sidesection');

  $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'lwp-footer-callout-sidesection-control', array(
      'label' => 'Side Text',
      'section' => 'lwp-footer-callout-section',
      'settings' => 'lwp-footer-callout-sidesection',
      'type' => 'textarea'
    )));



//mid layer function img1

 $wp_customize->add_section('mid-layer-section', array(
    'title' => 'Mid Layer'
  ));

//img 1 section
$wp_customize->add_setting('midlayer-image1');

  $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'midlayer-img1', array(
      'label' => 'mid layer Image 1',
      'section' => 'mid-layer-section',
      'settings' => 'midlayer-image1',
      'width' => 750,
      'height' => 500
    )));

  $wp_customize->add_setting('midlayer-image1-link');
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'midlayer-img1-link', array(
      'label' => 'Mid 1 Link',
      'section' => 'mid-layer-section',
      'settings' => 'midlayer-image1-link',
      'type' => 'dropdown-pages'
    )));

//img 2 section
$wp_customize->add_setting('midlayer-image2');

 $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'midlayer-img2', array(
      'label' => 'mid layer Image 2',
      'section' => 'mid-layer-section',
      'settings' => 'midlayer-image2',
      'width' => 750,
      'height' => 500
    )));

  $wp_customize->add_setting('midlayer-image2-link');
  $wp_customize->add_setting('midlayer-image2-link');
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'midlayer-img2-link', array(
      'label' => 'Mid 2 Link',
      'section' => 'mid-layer-section',
      'settings' => 'midlayer-image2-link',
      'type' => 'dropdown-pages'
    )));

//img 3 section
$wp_customize->add_setting('midlayer-image3');

 $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'midlayer-img3', array(
      'label' => 'mid layer Image 3',
      'section' => 'mid-layer-section',
      'settings' => 'midlayer-image3',
      'width' => 750,
      'height' => 500
    )));


  $wp_customize->add_setting('midlayer-image3-link');
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'midlayer-img3-link', array(
      'label' => 'Mid 3 Link',
      'section' => 'mid-layer-section',
      'settings' => 'midlayer-image3-link',
      'type' => 'dropdown-pages'
    )));


// Semi Mid Controller
     $wp_customize->add_section('semi-mid-layer', array(
    'title' => 'Semi  Mid Layer'
  ));

// Semi Mid Settings
  $wp_customize->add_setting('semi-mid-layer-image-link');

    $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'semi-mid-layer-img-link', array(
      'label' => 'Semi Image',
      'section' => 'semi-mid-layer',
      'settings' => 'semi-mid-layer-image-link',
      'width' => 750,
      'height' => 500
    )));

    $wp_customize->add_setting('semi-mid-layer-content-title');
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'midlayer-img3-con-title', array(
      'label' => 'Mid 3 Content',
      'section' => 'semi-mid-layer',
      'settings' => 'semi-mid-layer-content-title',
      'type' => 'text'
    )));


  $wp_customize->add_setting('semi-mid-layer-content');
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'midlayer-img3-con', array(
      'label' => 'Mid 3 Content',
      'section' => 'semi-mid-layer',
      'settings' => 'semi-mid-layer-content',
      'type' => 'textarea'
    )));

    $wp_customize->add_setting('semi-mid-layer-button');
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'midlayer-button', array(
      'label' => 'Mid 3 Content',
      'section' => 'semi-mid-layer',
      'settings' => 'semi-mid-layer-button',
      'type' => 'dropdown-pages'
    )));

// Semi Mid Settings
  $wp_customize->add_setting('semi-mid-layer-image-link2');

    $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'semi-mid-layer-img-link2', array(
      'label' => 'Semi Image',
      'section' => 'semi-mid-layer',
      'settings' => 'semi-mid-layer-image-link2',
      'width' => 750,
      'height' => 500
    )));

    $wp_customize->add_setting('semi-mid-layer-content-title2');
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'midlayer-img3-con-title2', array(
      'label' => 'Mid 3 Content',
      'section' => 'semi-mid-layer',
      'settings' => 'semi-mid-layer-content-title2',
      'type' => 'text'
    )));


  $wp_customize->add_setting('semi-mid-layer-content2');
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'midlayer-img3-con2', array(
      'label' => 'Mid 3 Content',
      'section' => 'semi-mid-layer',
      'settings' => 'semi-mid-layer-content2',
      'type' => 'textarea'
    )));

    $wp_customize->add_setting('semi-mid-layer-button2');
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'midlayer-button2', array(
      'label' => 'Mid 3 Content',
      'section' => 'semi-mid-layer',
      'settings' => 'semi-mid-layer-button2',
      'type' => 'dropdown-pages'
    )));

add_filter('term_links-post_tag','limit_to_five_tags');
function limit_to_five_tags($terms) {
return array_slice($terms,0,3,true);
}
 

}


add_action('customize_register', 'lwp_footer_callout');

include_once('adv_fucntion/advfunc.php');
include_once('adv_fucntion/themefunc.php');

?>



