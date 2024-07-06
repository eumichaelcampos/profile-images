<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Profile_Images_Admin {

    public static function init() {
        add_action( 'admin_menu', array( __CLASS__, 'add_admin_menu' ) );
        add_action( 'admin_init', array( __CLASS__, 'settings_init' ) );
        add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_color_picker' ) );
    }

    public static function add_admin_menu() {
        add_menu_page(
            __( 'Profile Images', 'profile-images' ),
            __( 'Profile Images', 'profile-images' ),
            'manage_options',
            'profile-images',
            array( __CLASS__, 'settings_page' ),
            'dashicons-admin-users'
        );

        add_submenu_page(
            'profile-images',
            __( 'Settings', 'profile-images' ),
            __( 'Settings', 'profile-images' ),
            'manage_options',
            'profile_images_settings',
            array( __CLASS__, 'settings_page' )
        );
    }

    public static function settings_init() {
        register_setting( 'profile_images_group', 'profile_images_settings', array( 'sanitize_callback' => array( __CLASS__, 'sanitize' ) ) );

        add_settings_section(
            'profile_images_section',
            __( 'Plugin Settings', 'profile-images' ),
            null,
            'profile-images'
        );

        add_settings_field(
            'border_color',
            __( 'Border Color', 'profile-images' ),
            array( __CLASS__, 'border_color_render' ),
            'profile-images',
            'profile_images_section'
        );

        add_settings_field(
            'border_size',
            __( 'Border Size', 'profile-images' ),
            array( __CLASS__, 'border_size_render' ),
            'profile-images',
            'profile_images_section'
        );

        add_settings_field(
            'random_mode',
            __( 'Random Mode', 'profile-images' ),
            array( __CLASS__, 'random_mode_render' ),
            'profile-images',
            'profile_images_section'
        );

        add_settings_field(
            'thumbnail_size',
            __( 'Thumbnail Size', 'profile-images' ),
            array( __CLASS__, 'thumbnail_size_render' ),
            'profile-images',
            'profile_images_section'
        );
    }

    public static function sanitize( $input ) {
        $sanitized_input = array();
        $sanitized_input['border_color'] = sanitize_text_field( $input['border_color'] );
        $sanitized_input['border_size'] = absint( $input['border_size'] );
        $sanitized_input['random_mode'] = isset( $input['random_mode'] ) ? 1 : 0;
        $sanitized_input['thumbnail_size'] = absint( $input['thumbnail_size'] );
        return $sanitized_input;
    }

    public static function border_color_render() {
        $options = get_option( 'profile_images_settings' );
        $border_color = isset( $options['border_color'] ) ? $options['border_color'] : '';
        ?>
        <input type='text' name='profile_images_settings[border_color]' value='<?php echo esc_attr( $border_color ); ?>' class='profile-images-color-field'>
        <?php
    }

    public static function border_size_render() {
        $options = get_option( 'profile_images_settings' );
        $border_size = isset( $options['border_size'] ) ? $options['border_size'] : '';
        ?>
        <input type='number' name='profile_images_settings[border_size]' value='<?php echo esc_attr( $border_size ); ?>' min='0'>
        <?php
    }

    public static function random_mode_render() {
        $options = get_option( 'profile_images_settings' );
        $random_mode = isset( $options['random_mode'] ) ? $options['random_mode'] : 0;
        ?>
        <input type='checkbox' name='profile_images_settings[random_mode]' <?php checked( $random_mode, 1 ); ?> value='1'>
        <?php
    }

    public static function thumbnail_size_render() {
        $options = get_option( 'profile_images_settings' );
        $thumbnail_size = isset( $options['thumbnail_size'] ) ? $options['thumbnail_size'] : '';
        ?>
        <input type='number' name='profile_images_settings[thumbnail_size]' value='<?php echo esc_attr( $thumbnail_size ); ?>' min='1'>
        <?php
    }

    public static function settings_page() {
        ?>
        <div class="wrap">
            <h1><?php _e( 'Profile Images', 'profile-images' ); ?></h1>
            <form action='options.php' method='post'>
                <?php
                settings_fields( 'profile_images_group' );
                do_settings_sections( 'profile-images' );
                submit_button();
                ?>
            </form>
            <?php self::add_shortcode_generator(); ?>
        </div>
        <?php
    }

    public static function add_shortcode_generator() {
        ?>
        <div class="wrap">
            <h2><?php _e( 'Shortcode Generator', 'profile-images' ); ?></h2>
            <form id="shortcode-generator-form">
                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="quantity"><?php _e( 'Quantity', 'profile-images' ); ?></label></th>
                        <td><input name="quantity" type="number" id="quantity" value="5" min="1" max="10" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="random"><?php _e( 'Random Mode', 'profile-images' ); ?></label></th>
                        <td><input name="random" type="checkbox" id="random" value="1" /></td>
                    </tr>
                </table>
                <p class="submit">
                    <input type="button" id="generate-shortcode" class="button-primary" value="<?php _e( 'Generate Shortcode', 'profile-images' ); ?>" />
                </p>
            </form>
            <textarea id="shortcode-output" readonly style="width: 100%; height: 50px;"></textarea>
        </div>
        <script type="text/javascript">
            document.getElementById('generate-shortcode').addEventListener('click', function() {
                var quantity = document.getElementById('quantity').value;
                var random = document.getElementById('random').checked ? 'true' : 'false';
                var shortcode = '[profile_images quantity="' + quantity + '" random="' + random + '"]';
                document.getElementById('shortcode-output').value = shortcode;
            });
        </script>
        <?php
    }

    public static function enqueue_color_picker( $hook_suffix ) {
        // Enqueue color picker script only on the plugin settings page
        if ( 'toplevel_page_profile-images' !== $hook_suffix && 'profile-images_page_profile_images_settings' !== $hook_suffix ) {
            return;
        }
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'profile-images-color-picker', PROFILE_IMAGES_PLUGIN_URL . 'js/color-picker.js', array( 'wp-color-picker' ), false, true );
    }
}

add_action( 'admin_init', array( 'Profile_Images_Admin', 'init' ) );
add_action( 'admin_menu', array( 'Profile_Images_Admin', 'add_admin_menu' ) );

?>
