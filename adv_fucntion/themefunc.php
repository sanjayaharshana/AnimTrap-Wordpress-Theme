<?php
// create custom plugin settings menu
add_action('admin_menu', 'theme_func_menu');

function theme_func_menu() {

    //create new top-level menu
    add_menu_page('Theme Control', 'Theme Function', 'administrator', __FILE__, 'theme_func_set_page' , plugins_url('/images/icon.png', __FILE__) );

    //call register settings function
    add_action( 'admin_init', 'register_theme_func_settings' );
}


function register_theme_func_settings() {
    //register our settings
    register_setting( 'theme-func-settings-group', 'company_name' );
    register_setting( 'theme-func-settings-group', 'facebook_link' );
    register_setting( 'theme-func-settings-group', 'twitter_link' );
    register_setting( 'theme-func-settings-group', 'gplus_link' );
    register_setting( 'theme-func-settings-group', 'copyright_note' );
    register_setting( 'theme-func-settings-group', 'seo_key_tag' );
}

function theme_func_set_page() {
    ?>
    <div class="wrap">
        <h1>Theme Functions Control Panel</h1>

        <form method="post" action="options.php">
            <?php settings_fields( 'theme-func-settings-group' ); ?>
            <?php do_settings_sections( 'theme-func-settings-group' ); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Company Name</th>
                    <td><input type="text" name="company_name" value="<?php echo esc_attr( get_option('company_name') ); ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row">Facebook Link</th>
                    <td><input type="text" name="facebook_link" value="<?php echo esc_attr( get_option('facebook_link') ); ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row">Twitter Link</th>
                    <td><input type="text" name="twitter_link" value="<?php echo esc_attr( get_option('twitter_link') ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Google Pluse Link</th>
                    <td><input type="text" name="gplus_link" value="<?php echo esc_attr( get_option('gplus_link') ); ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row">Copyright Text</th>
                    <td><input type="text" name="copyright_note" value="<?php echo esc_attr( get_option('copyright_note') ); ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row">SEO Key Tag</th>
                    <td><input type="text" name="seo_key_tag" value="<?php echo esc_attr( get_option('seo_key_tag') ); ?>" /></td>
                </tr>

                <?php submit_button(); ?>
            </table>

        </form>
    </div>
<?php } ?>