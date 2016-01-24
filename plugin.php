<?php
/**
 * Plugin Name: Blackbird AdSense
 * Plugin URI: https://github.com/Herm71/blackbird-adsense
 * Description: Add your Google AdSense account to your WordPress Theme. Theme independent.
 * Version: 1.1.0
 * Author: Blackbird Consulting
 * Author URI: http://www.blackbirdconsult.com/
 * License: GPL2
 * Text Domain: blackbird-adsense
 * GitHub Plugin URI: https://github.com/Herm71/blackbird-adsense
 * GitHub Branch: master
 * 
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

// Plugin Directory 
define( 'BB_ADSENSE_DIR', dirname( __FILE__ ) );

// General
include_once( BB_ADSENSE_DIR . '/lib/functions/general.php' );

// Shortcodes
include_once( BB_ADSENSE_DIR . '/lib/shortcodes/adsense-shortcodes.php' );

// Widget
include_once( BB_ADSENSE_DIR . '/lib/widgets/adsense-widgets.php' );

