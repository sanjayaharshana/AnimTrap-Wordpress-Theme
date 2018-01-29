<?php
// create custom plugin settings menu
add_action('admin_menu', 'my_cool_plugin_create_menu');

function my_cool_plugin_create_menu() {

    //create new top-level menu
    add_menu_page('AnimTrap Control', 'AnimTrap', 'administrator', __FILE__, 'my_cool_plugin_settings_page' , plugins_url('/images/icon.png', __FILE__) );

    //call register settings function
    add_action( 'admin_init', 'register_my_cool_plugin_settings' );
}


function register_my_cool_plugin_settings() {
    //register our settings
    register_setting( 'my-cool-plugin-settings-group', 'new_option_name' );
    register_setting( 'my-cool-plugin-settings-group', 'some_other_option' );
    register_setting( 'my-cool-plugin-settings-group', 'option_etc' );
    register_setting( 'my-cool-plugin-settings-group', 'select_animation' );
     register_setting( 'my-cool-plugin-settings-group', 'scroll_select_animation' );
      register_setting( 'my-cool-plugin-settings-group', 'blog_card_hover' );
}

function my_cool_plugin_settings_page() {
?>
<div class="wrap">
<h1>AnimTrap Control Panel</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'my-cool-plugin-settings-group' ); ?>
    <?php do_settings_sections( 'my-cool-plugin-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">New Option Name</th>
        <td><input type="text" name="new_option_name" value="<?php echo esc_attr( get_option('new_option_name') ); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Some Other Option</th>
        <td><input type="text" name="some_other_option" value="<?php echo esc_attr( get_option('some_other_option') ); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Options, Etc.</th>
        <td><input type="text" name="option_etc" value="<?php echo esc_attr( get_option('option_etc') ); ?>" /></td>
        </tr>


        <tr valign="top">
        <th scope="row">Hover Animation</th>
        <td>
            <select name="select_animation" value="<?php echo esc_attr( get_option('select_animation') ); ?>">
                <option value="<?php echo esc_attr( get_option('select_animation') ); ?>"><?php echo esc_attr( get_option('select_animation') ); ?></option>
                <option value="anim-hover-shrink">shrink</option>
                <option value="anim-hover-pulse">pluse</option>
                <option value="anim-hover-pulse-grow">pulse grow</option>
                <option value="anim-hover-pulse-shrink">shink</option>
                <option value="anim-hover-push">push</option>
                <option value="anim-hover-pop">pop</option>
                <option value="anim-hover-bounce-in">bounce in</option>
                <option value="anim-hover-bounce-out">bounce out</option>
                <option value="anim-hover-rotate">rotate</option>
                <option value="anim-hover-grow-rotate">Saab</option>
                <option value="anim-hover-float">Mercedes</option>
                <option value="anim-hover-sink">Audi</option>
                <option value="anim-hover-bob">Volvo</option>
                <option value="anim-hover-hang">Saab</option>
                <option value="anim-hover-skew">skew</option>
                <option value="anim-hover-skew-forward">skew forward</option>
                <option value="anim-hover-skew-backward">skew backward</option>
                <option value="anim-hover-wobble-horizontal">wobble horizontal</option>
                <option value="anim-hover-buzz">buzz</option>
                <option value="anim-hover-buzz-out">buzz-out</option>
                <option value="anim-hover-forward">forward</option>
                <option value="anim-hover-backward">backward</option>                
            </select>
        </td>

        <tr valign="top">
        <th scope="row">Scroll Animation</th>
        <td>
            <select name="scroll_select_animation" value="<?php echo esc_attr( get_option('scroll_select_animation') ); ?>">
                <option value="<?php echo esc_attr( get_option('scroll_select_animation') ); ?>"><?php echo esc_attr( get_option('scroll_select_animation') ); ?></option>
                <option value="fade-up">fade-up</option>
                <option value="fade-down">fade down</option>
                <option value="fade-right">fade right</option>
                <option value="fade-left">fade left</option>
                <option value="fade-up-right">fade up right</option>
                <option value="fade-up-left">fade up left</option>
                <option value="fade-down-right">fade down right</option>
                <option value="fade-down-left">fade down left</option>
                <option value="flip-left">flip left</option>
                <option value="flip-right">flip right</option>
                <option value="flip-up">flip up</option>
                <option value="flip-down">flip down</option>
                <option value="zoom-in">zoom in</option>
                <option value="zoom-in-up">zoom in up</option>
                <option value="zoom-in-down">zoom in down</option>
                <option value="zoom-in-left">zoom in left</option>
                <option value="zoom-in-right">zoom in right</option>
                <option value="zoom-out">zoom out</option>
                <option value="zoom-out-up">zoom out up</option>
                <option value="zoom-out-down">zoom out down</option>
                <option value="zoom-out-right">zoom out right</option>
                <option value="zoom-out-left">zoom out left</option>                
            </select>
        </td>
    </table>


     <tr valign="top">
        <th scope="row">Blog Hover Animation</th>
        <td>
            <select name="blog_card_hover" value="<?php echo esc_attr( get_option('blog_card_hover') ); ?>">
                <option value="<?php echo esc_attr( get_option('blog_card_hover') ); ?>"><?php echo esc_attr( get_option('blog_card_hover') ); ?></option>
                <option value="anim-hover-shrink">shrink</option>
                <option value="anim-hover-pulse">pluse</option>
                <option value="anim-hover-pulse-grow">pulse grow</option>
                <option value="anim-hover-pulse-shrink">shink</option>
                <option value="anim-hover-push">push</option>
                <option value="anim-hover-pop">pop</option>
                <option value="anim-hover-bounce-in">bounce in</option>
                <option value="anim-hover-bounce-out">bounce out</option>
                <option value="anim-hover-rotate">rotate</option>
                <option value="anim-hover-grow-rotate">Saab</option>
                <option value="anim-hover-float">Mercedes</option>
                <option value="anim-hover-sink">Audi</option>
                <option value="anim-hover-bob">Volvo</option>
                <option value="anim-hover-hang">Saab</option>
                <option value="anim-hover-skew">skew</option>
                <option value="anim-hover-skew-forward">skew forward</option>
                <option value="anim-hover-skew-backward">skew backward</option>
                <option value="anim-hover-wobble-horizontal">wobble horizontal</option>
                <option value="anim-hover-buzz">buzz</option>
                <option value="anim-hover-buzz-out">buzz-out</option>
                <option value="anim-hover-forward">forward</option>
                <option value="anim-hover-backward">backward</option>                
            </select>
        </td>
    


    <?php submit_button(); ?>

</form>
</div>
<?php } ?>