<?php
/*
 * Blackbird Responsive Custom Theme Settings Admin Area
 * 
 * Adds custom theme setting admin area
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
 * Add Settings Area
 * 
 */

add_action('admin_menu', 'plugin_admin_add_page');
function plugin_admin_add_page() {
add_options_page('Custom Plugin Page', 'Custom Plugin Menu', 'manage_options', 'plugin', 'plugin_options_page');
}

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
function plugin_options_page() {
?>
<div>
<h2>My custom plugin</h2>
Options relating to the Custom Plugin.
<form action="options.php" method="post">
<?php settings_fields('plugin_options'); ?>
<?php do_settings_sections('plugin'); ?>
 
<input name="Submit" class="button-primary" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
</form></div>
 
<?php
}

/* 
 * Register and add the admin settings
 * 
 * register_setting( $option_group, $option_name, $sanitize_callback
 * 
 */
add_action('admin_init', 'plugin_admin_init');
function plugin_admin_init(){
register_setting( 'plugin_options', 'plugin_options', 'plugin_options_validate' );
add_settings_section('plugin_main', 'Main Settings', 'plugin_section_text', 'plugin');
add_settings_field('plugin_text_string', 'Plugin Text Input', 'plugin_setting_string', 'plugin', 'plugin_main');
}

// Settings Sections
function plugin_section_text() {
echo '<p>Main description of this section here.</p>';
}

// Input Fields
function plugin_setting_string() {
$options = get_option('plugin_options');
echo "<input id='plugin_text_string' name='plugin_options[text_string]' size='40' type='text' value='{$options['text_string']}' />";
}

// validate our options
function plugin_options_validate($input) {
$options = get_option('plugin_options');
$options['text_string'] = trim($input['text_string']);
if(!preg_match('/^[a-z0-9]{32}$/i', $options['text_string'])) {
$options['text_string'] = '';
}
return $options;
}