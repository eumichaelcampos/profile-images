<?php
/**
 * Plugin Name: Profile Images
 * Plugin URI: https://example.com/profile-images
 * Description: Display thumbnails of user profiles registered on the site with options for random order and quantity limit.
 * Version: 1.0
 * Author: Michael Campos
 * Author URI: https://example.com
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: profile-images
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Define constants
define( 'PROFILE_IMAGES_VERSION', '1.0' );
define( 'PROFILE_IMAGES_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'PROFILE_IMAGES_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Load plugin textdomain
function profile_images_load_textdomain() {
    load_plugin_textdomain( 'profile-images', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'profile_images_load_textdomain' );

// Include the main class file
require_once PROFILE_IMAGES_PLUGIN_DIR . 'includes/class-profile-images.php';
require_once PROFILE_IMAGES_PLUGIN_DIR . 'includes/class-profile-images-admin.php';

// Initialize the plugin
add_action( 'plugins_loaded', array( 'Profile_Images', 'init' ) );
add_action( 'plugins_loaded', array( 'Profile_Images_Admin', 'init' ) );

?>
