<?php
/*
 * Blackbird Google AdSense Settings Admin Area
 * 
 * Adds Google Adwords admin area
 * These Theme Settings were created with the help
 * of Otto's tutorial and many references to the WordPress Codex
 * http://ottopress.com/2009/wordpress-settings-api-tutorial/
 * 
 * Verison: 0.0.0
 * Author: Blackbird Consulting
 * Author URI: http://www.blackbirdconsult.com
 * 
 */

/*
 * 
 * Add Google AdSence Javascript
 * 
 */

function google_adsense(){ ?>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    
<?php;}

add_action( 'wp_head', 'google_adsense', 10 );

/*
 * Add Settings Area
 * 
 */


add_action('admin_menu', 'add_bb_adsense_admin_menu_settings');


/*
 * 
 * Display Blackbird Google AdSense Settings Page
 * 
 * register_setting( $option_group, $option_name, $sanitize_callback )
 * 
 * add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position )
 * 
 * 
 */

function add_bb_adsense_admin_menu_settings() {
    register_setting('bb_adsense_settings', 'bb_adsense_settings');
    
    add_menu_page('Blackbird AdSense Settings', 'Blackbird AdSense Settings', 'manage_options', 'adsense_functions', 'bb_adsense_settings_page');
}

function bb_adsense_settings_page() {
    ?>
    <div class="wrap">
        <h1> Blackbird Google AdSense Settings</h1>           
        <form method="post" action="options.php">
    
        <?php 
        settings_fields('bb_adsense_settings');
        do_settings_sections('bb_adsense'); 
        ?><?php 

}

/* 
 * Register and add the admin settings
 * 
 * register_setting( $option_group, $option_name, $sanitize_callback
 * 
 */
add_action ('admin_init', 'bb_adsense_admin_init');

function bb_adsense_admin_init() {
    register_setting('bb_adsense_settings', 'bb_adsense_settings', 'bb_adsense_settings_validate');


    /*
     * Add Settings Sections
     * 
     * add_settings_section ($id, $title, $callback, $page)
     * 
     */

    add_settings_section('bb_adsense_settings_section', 'Blackbird Google AdSense Settings', 'bb_adsense_settings_section', 'bb_adsense');


    /* Add Input Fields
     * add_settings_field ($id, $title, $callback, $page, $section, $args)
     * 
     */


    /* test */
    add_settings_field('bb_adsense_setting_string', ' Background Color (Hex  theme default: #FFFFFF):', 'bb_adsense_setting_string', 'bb_adsense', 'bb_adsense_settings_section');
}

/*
 * 
 * Callback Functions to display Section Output
 * 
 */

function bb_adsense_settings_section () {
    echo "<p>This is where Explainer Text goes</p>";    
}


/*
 * 
 * Callback Functions to display Options Fields output
 * 
 * get_option( $option, $default )
 * 
 */

function bb_adsense_setting_string() {
$options = get_option('bb_adsense_settings');
echo "<input id='bb_adsense_text_string' name='bb_adsense_settings[text_string]' size='40' type='text' value='{$options['text_string']}' />";
}


/*
 * SAVE btton
 */
function bb_adsense_setting_save() {
?> <input class="button-primary" name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" /><?php
}


/*
 *  Blackbird Google AdSense Settings
 * 
 */
function bb_adsense_background_string() {
$options = get_option('bb_adsense_settings');

echo get_option('bb_adsense_settings[background_string]');
echo "<input id='bb_adsense_background' name='bb_adsense_settings[background_string]' size='8' type='text' value='{$options['background_string']}' />";
}

/*
 *  Blackbird Google AdSense Validate Options
 * 
 */

function plugin_options_validate($input) {
$options = get_option('bb_adsense_settings');
//text string
$options['text_string'] = trim($input['text_string']);
if(!preg_match('/^[a-z0-9]{32}$/i', $options['text_string'])) {
$options['text_string'] = '';
}
}

/*
 * Text fields for Authors to add their own AdSense Ads
 * 
 * Adds Google Adwords admin area
 * Based on EnvatoTuts
 * http://code.tutsplus.com/tutorials/making-the-best-of-google-adsense-in-wordpress--wp-29938
 * 
 */

// show the textarea fields for authors' to enter their AdSense ad codes
// source: http://www.stemlegal.com/greenhouse/2012/adding-custom-fields-to-user-profiles-in-wordpress/
function wptuts_profile_adsense_show( $user ) {
    echo '<h3>Your Google AdSense Ads</h3>
    <table class="form-table">
        <tr>
            <th><label for="adsense_300x250">AdSense Ad Code (300x250)</label></th>
            <td><textarea name="adsense_300x250" id="adsense_300x250" rows="5" cols="30">' . get_user_meta( $user->ID, 'adsense_300x250', true) . '</textarea><br>
            <span class="adsense_300x250">Your Google AdSense JavaScript code for the 300x250 ad space.</span></td>
        </tr>
        <tr>
            <th><label for="adsense_468x60">AdSense Ad Code (468x60)</label></th>
            <td><textarea name="adsense_468x60" id="adsense_468x60" rows="5" cols="30">' . get_user_meta( $user->ID, 'adsense_468x60', true) . '</textarea><br>
            <span class="adsense_468x60">Your Google AdSense JavaScript code for the 468x60 ad space.</span></td>
        </tr>
    </table>';
}
add_action( 'show_user_profile', 'wptuts_profile_adsense_show' );
add_action( 'edit_user_profile', 'wptuts_profile_adsense_show' );
 
// save the changes above
function wptuts_profile_adsense_save( $user_id ) {
    if ( ! current_user_can( 'edit_user', $user_id ) )
        return false;
    update_user_meta( $user_id, 'adsense_300x250', $_POST['adsense_300x250'] );
    update_user_meta( $user_id, 'adsense_468x60',  $_POST['adsense_468x60']  );
}
add_action( 'personal_options_update', 'wptuts_profile_adsense_save' );
add_action( 'edit_user_profile_update', 'wptuts_profile_adsense_save' );

// our main function to return the ad codes
// remember: other functions below use this function, too!
function wptuts_return_adsense( $ad_type = '468x60' ) {
    // the default ad codes - don't forget to change them!
    $default_ad_codes = array(
        '300x250' => '<img src="http://dummyimage.com/300x250" />',
        '468x60'  => '<img src="http://dummyimage.com/480x60" />'
    );
    if ( is_single() ) {
        global $post;
        $user_id = $post->post_author;
        $ad_code = get_user_meta( $user_id, 'adsense_' . $ad_type, true );
    } else {
        $ad_code = $default_ad_codes[$ad_type];
    }
    if ( $ad_code != '' ) {
        // we'll return the ad code within a div which has a class for the ad type, just in case
        return '<div class="adsense_' . $ad_type . '">' . $ad_code . '</div>';
    } else {
        return false;
    }
}

// the function to insert the ads automatically after the "n"th paragraph in a post
// the following code is borrowed from Internoetics, then edited:
// http://www.internoetics.com/2010/02/08/adsense-code-within-content/
function wptuts_auto_insert_adsense( $post_content ) {
    if ( !is_single() ) return $post_content;
    $afterParagraph = 1; // display after the "n"th paragraph
    $adsense = wptuts_return_adsense( '468x60' );
    preg_match_all( '/<\/p>/', $post_content, $matches, PREG_OFFSET_CAPTURE );
    $insert_at = $matches[0][$afterParagraph - 1][1];
    return substr( $post_content, 0, $insert_at) . $adsense . substr( $post_content, $insert_at, strlen( $post_content ) );
}
add_filter( 'the_content', 'wptuts_auto_insert_adsense' );
