<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://liftcreations.com
 * @since             1.0.0
 * @package           LIFT_WP_VC_ADDON_MAIN
 *
 * @wordpress-plugin
 * Plugin Name:       @LIFT Creations - LIFT Addons for Visual Composer
 * Plugin URI:        https://liftcreations.com
 * Description:       A collection of LIFT's addons for use in WPBakery Page Builder. WPBakery Page Builder must be installed and activated.
 * Version:           5.2.0
 * Author:            Nguyen Pham
 * Author URI:        https://baonguyenyam.github.io/cv
 * Plugin URI:        https://baonguyenyam.github.io/cv
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bn-wp-vc-addon
 * Domain Path:       /languages
 */

// don't load directly
if (!defined('ABSPATH')) {
    die('-1');
}

define( 'LIFT_VERSION', '4.9.0' );


add_action( 'vc_before_init', 'lift_wpc_vc_before_init_actions' );

function lift_wpc_vc_before_init_actions() {
    include( plugin_dir_path( __FILE__ ) . 'lift-vc-core.php');
}

if ( !class_exists( 'LIFT_Addons_All_in_One' ) ) {
    final class LIFT_Addons_All_in_One
    {
        private static  $instance ;
        public static function instance()
        {
            
            if ( !isset( self::$instance ) && !self::$instance instanceof LIFT_Addons_All_in_One ) {
                self::$instance = new LIFT_Addons_All_in_One();
                self::$instance->hooks();
            }
            
            return self::$instance;
        }

        public function load_fonts_scripts() {
            wp_register_style( 'font-awesome', plugin_dir_url( __FILE__ ) . 'assets/lib/font-awesome/css/font-awesome.min.css' , array() );
            wp_enqueue_style( 'font-awesome' );
            wp_register_style( 'vc_typicons', plugin_dir_url( __FILE__ ) . 'assets/lib/typicons/src/font/typicons.min.css' , false );
            wp_enqueue_style( 'vc_typicons' );
            wp_register_style( 'vc_openiconic', plugin_dir_url( __FILE__ ) . 'assets/lib/vc-open-iconic/vc_openiconic.min.css' , false );
            wp_enqueue_style( 'vc_openiconic' );
            wp_register_style( 'vc_linecons', plugin_dir_url( __FILE__ ) . 'assets/lib/vc-linecons/vc_linecons_icons.min.css' , false );
            wp_enqueue_style( 'vc_linecons' );
            wp_register_style( 'vc_entypo', plugin_dir_url( __FILE__ ) . 'assets/lib/vc-entypo/vc_entypo.min.css' , false );
            wp_enqueue_style( 'vc_entypo' );
            wp_register_style( 'vc_monosocialiconsfont', plugin_dir_url( __FILE__ ) . 'assets/lib/monosocialiconsfont/monosocialiconsfont.min.css' , false );
            wp_enqueue_style( 'vc_monosocialiconsfont' );
            wp_register_style( 'vc_material', plugin_dir_url( __FILE__ ) . 'assets/lib/vc-material/vc_material.min.css' , false );
            wp_enqueue_style( 'vc_material' );
            wp_register_style( 'vc_steadysets', plugin_dir_url( __FILE__ ) . 'assets/lib/steadysets.css' , false );
            wp_enqueue_style( 'vc_steadysets' );
            wp_register_style( 'vc_linea', plugin_dir_url( __FILE__ ) . 'assets/lib/fonts/svg/font/style.css' , false );
            wp_enqueue_style( 'vc_linea' );
            wp_register_style( 'vc_iconsmind', plugin_dir_url( __FILE__ ) . 'assets/lib/iconsmind.css' , false );
            wp_enqueue_style( 'vc_iconsmind' );
        }

        public function load_admin_scripts() {
            wp_enqueue_style( 'lift_admin_css',  plugin_dir_url( __FILE__ ) . 'admin/assets/css/dist/main.min.css', array() );
            wp_enqueue_script('lift_admin_js');
            wp_register_script('lift_admin_js', plugin_dir_url( __FILE__ ) . 'admin/assets/js/dist/main.prod.js', array('jquery'), false, true);
            wp_enqueue_script('lift_admin_js');
        }

        public function load_frontend_scripts() {
            wp_register_style( 'lift_animated_css',  plugin_dir_url( __FILE__ ) . 'assets/css/animate.min.css', array() );
            wp_enqueue_style( 'lift_animated_css' );
            wp_register_style( 'lift_fancybox_css',  plugin_dir_url( __FILE__ ) . 'assets/css/jquery.fancybox.min.css', array() );
            wp_enqueue_style( 'lift_fancybox_css' );
            wp_register_style( 'lift_core_css',  plugin_dir_url( __FILE__ ) . 'assets/css/dist/main.min.css', array() );
            wp_enqueue_style( 'lift_core_css' );
            wp_register_script('lift_core_js', plugin_dir_url( __FILE__ ) . 'assets/js/dist/main.prod.js', array('jquery'), false, true);
            wp_enqueue_script('lift_core_js');
            // wp_register_script('lift_popper', plugin_dir_url( __FILE__ ) . 'assets/js/popper.min.js', array('jquery'), false, true);
            // wp_enqueue_script('lift_popper');
            // wp_register_script('lift_bootstrap', plugin_dir_url( __FILE__ ) . 'assets/js/bootstrap.bundle.min.js', array('jquery'), false, true);
            // wp_enqueue_script('lift_bootstrap');
            wp_register_script('fancyBox', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.fancybox.min.js', array('jquery'), false, false);
            wp_enqueue_script('fancyBox');
            wp_register_script('wpb_composer_front_js', plugin_dir_url( __FILE__ ) . 'assets/js/js_composer_front.min.js', array('jquery'), false, true);
            wp_enqueue_script('wpb_composer_front_js');
            wp_register_script('waypoints', plugin_dir_url( __FILE__ ) . 'assets/js/waypoints.min.js', array('jquery'), false, true);
            wp_enqueue_script('waypoints');
        }

        private function hooks()
        {
            add_action( 'wp_enqueue_scripts', array( $this, 'load_frontend_scripts' ), 10 );
            add_action( 'wp_enqueue_scripts', array( $this, 'load_fonts_scripts' ), 10 );
            add_action( 'admin_enqueue_scripts', array( $this, 'load_admin_scripts' ), 999999 );
            add_action( 'admin_enqueue_scripts', array( $this, 'load_fonts_scripts' ), 999999 );
            add_filter(
                'vc_shortcodes_css_class',
                array( $this, 'custom_css_classes_for_vc_row' ),
                10,
                3
            );
        }

        function custom_css_classes_for_vc_row( $class_string, $tag = '', $atts = null )
        {
            if ( !empty($atts) && !empty($tag) ) {
                if ( $tag == 'vc_row' || $tag == 'vc_row_inner' ) {
                    if ( isset( $atts['lvca_dark_bg'] ) && $atts['lvca_dark_bg'] == 'true' ) {
                        $class_string .= ' lvca-dark-bg';
                    }
                }
            }
            return $class_string;
        }
        
    
    }
}

function LIFT_Addons_byNguyen()
{
    return LIFT_Addons_All_in_One::instance();
}
// Get LIFT_Addons_byNguyen Running
LIFT_Addons_byNguyen();


