
<h2><?php echo esc_attr( get_option('select_animation') ); ?></h2>
    <div class="row">
        <div class="col-sm-4">
            <div class="<?php echo esc_attr( get_option('select_animation') ); ?>">            
                <div class="" data-animscroll="fade-up">
                    <br>
                    <a href="<?php echo get_permalink(get_theme_mod('midlayer-image1-link')) ?>">
                    <img class="img-responsive" src="<?php echo wp_get_attachment_url(get_theme_mod('midlayer-image1')) ?>" alt="<?php echo esc_attr( get_option('seo_key_tag') ); ?>"  >
                    </a>
                </div>           
            </div>
        </div>
         <div class="col-sm-4">
            <div class="<?php echo esc_attr( get_option('select_animation') ); ?>">
                <div class="" data-animscroll="fade-up">
                    <br>
                    <a href="<?php echo get_permalink(get_theme_mod('midlayer-image2-link')) ?>">
                    <img class="img-responsive" src="<?php echo wp_get_attachment_url(get_theme_mod('midlayer-image2')) ?>" alt="<?php echo esc_attr( get_option('seo_key_tag') ); ?>"  >
                    </a>
                </div>
            </div>
        </div>
         <div class="col-sm-4">
            <div class="<?php echo esc_attr( get_option('select_animation') ); ?>">
                <div class="" data-animscroll="fade-up">
                    <br>
                    <a href="<?php echo get_permalink(get_theme_mod('midlayer-image3-link')) ?>">
                    <img class="img-responsive" src="<?php echo wp_get_attachment_url(get_theme_mod('midlayer-image3')) ?>" alt="<?php echo esc_attr( get_option('seo_key_tag') ); ?>"  >
                    </a>
                </div>
            </div>
        </div>

        
        
    </div>