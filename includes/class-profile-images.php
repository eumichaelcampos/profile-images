<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Profile_Images {

    public static function init() {
        add_shortcode( 'profile_images', array( __CLASS__, 'render_shortcode' ) );
        add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_assets' ) );
    }

    public static function enqueue_assets() {
        wp_enqueue_style( 'profile-images', PROFILE_IMAGES_PLUGIN_URL . 'css/styles.css', array(), PROFILE_IMAGES_VERSION );
        wp_enqueue_script( 'profile-images', PROFILE_IMAGES_PLUGIN_URL . 'js/scripts.js', array( 'jquery' ), PROFILE_IMAGES_VERSION, true );

        // Add inline styles based on settings
        $options = get_option( 'profile_images_settings' );
        $border_color = isset( $options['border_color'] ) ? $options['border_color'] : '#000';
        $border_size = isset( $options['border_size'] ) ? $options['border_size'] : '1';
        $thumbnail_size = isset( $options['thumbnail_size'] ) ? $options['thumbnail_size'] : '96';

        $custom_css = "
            .profile-thumbnail img {
                border-color: {$border_color};
                border-width: {$border_size}px;
                width: {$thumbnail_size}px;
                height: {$thumbnail_size}px;
            }
        ";
        wp_add_inline_style( 'profile-images', $custom_css );
    }

    public static function render_shortcode( $atts ) {
        $atts = shortcode_atts( array(
            'quantity' => 5,
            'random' => 'false',
        ), $atts, 'profile_images' );

        $quantity = intval( $atts['quantity'] );
        $random = filter_var( $atts['random'], FILTER_VALIDATE_BOOLEAN );

        $args = array(
            'number' => $quantity,
            'orderby' => $random ? 'rand' : 'registered',
            'order' => 'DESC',
        );

        $users = get_users( $args );
        $total_users = count_users();

        ob_start();
        include PROFILE_IMAGES_PLUGIN_DIR . 'templates/profile-thumbnail.php';
        return ob_get_clean();
    }
}

?>
