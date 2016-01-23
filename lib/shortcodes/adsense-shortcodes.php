<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// shortcode for the above function
// usage: [display_adsense ad_type="468x60"]
function display_adsense_468( $atts ) {
    extract( shortcode_atts( array(
        'ad_type' => '468x60'
    ), $atts ) );
    return blackbird_return_adsense( $ad_type );
}
add_shortcode( 'display_adsense', 'display_adsense_468' );

// shortcode for the above function
// usage: [display_adsense ad_type="300x250"]
function display_adsense_300( $atts ) {
    extract( shortcode_atts( array(
        'ad_type' => '300x250'
    ), $atts ) );
    return blackbird_return_adsense( $ad_type );
}
add_shortcode( 'display_adsense', 'display_adsense_300' );