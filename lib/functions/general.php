<?php
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
function blackbird_profile_adsense_show( $user ) {
    echo '<h3>Your Google AdSense Ads</h3>
    <table class="form-table">
        <tr>
            <th><label for="adsense_300x250">AdSense Ad Code (300x250)</label></th>
            <td><textarea name="adsense_300x250" id="adsense_300x250" rows="5" cols="30">' . get_user_meta( $user->ID, 'adsense_300x250', true) . '</textarea><br>
            <span class="adsense_300x250">Your Google AdSense JavaScript code for the 300x250 ad space.<br /> Shortcode: [display_adsense ad_type="300"]</span></td>
        </tr>
        <tr>
            <th><label for="adsense_468x60">AdSense Ad Code (468x60)</label></th>
            <td><textarea name="adsense_468x60" id="adsense_468x60" rows="5" cols="30">' . get_user_meta( $user->ID, 'adsense_468x60', true) . '</textarea><br>
            <span class="adsense_468x60">Your Google AdSense JavaScript code for the 468x60 ad space.<br /> Shortcode: [display_adsense ad_type="468"]</span></td>
        </tr>
    </table>';
}
add_action( 'show_user_profile', 'blackbird_profile_adsense_show' );
add_action( 'edit_user_profile', 'blackbird_profile_adsense_show' );
 
// save the changes above
function blackbird_profile_adsense_save( $user_id ) {
    if ( ! current_user_can( 'edit_user', $user_id ) )
        return false;
    update_user_meta( $user_id, 'adsense_300x250', $_POST['adsense_300x250'] );
    update_user_meta( $user_id, 'adsense_468x60',  $_POST['adsense_468x60']  );
}
add_action( 'personal_options_update', 'blackbird_profile_adsense_save' );
add_action( 'edit_user_profile_update', 'blackbird_profile_adsense_save' );

// our main function to return the ad codes
// remember: other functions below use this function, too!
function blackbird_return_adsense( $ad_type = '468x60' ) {
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
function blackbird_auto_insert_adsense( $post_content ) {
    if ( !is_single() ) return $post_content;
    $afterParagraph = 1; // display after the "n"th paragraph
    $adsense = blackbird_return_adsense( '468x60' );
    preg_match_all( '/<\/p>/', $post_content, $matches, PREG_OFFSET_CAPTURE );
    $insert_at = $matches[0][$afterParagraph - 1][1];
    return substr( $post_content, 0, $insert_at) . $adsense . substr( $post_content, $insert_at, strlen( $post_content ) );
}
add_filter( 'the_content', 'blackbird_auto_insert_adsense' );
