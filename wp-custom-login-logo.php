<?php
/**
 * Plugin Name: Custom Admin Login Logo
 * Plugin URI: 
 * Description: Add your custom logo for wp-admin login page.
 * Version: 1.0
 * Author: Patel Sunny
 * Author URI: http://vividwebsolutions.in
 * Text Domain: wp_cust_login_logo
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * @package CustomAdminLoginLogo
 */

final class CustomAdminLoginLogo
{

  public function __construct(){
    add_action( 'init', array( $this, 'sp_wp_cust_login_logo_setup' ), -1 );
    require_once( 'custom/functions.php' );
    require_once( 'class/class_theme_customisations_install.php' );
  }

  /**
   * Setup all the things
   */
  public function sp_wp_cust_login_logo_setup() {
    add_action( 'admin_enqueue_scripts', array( $this, 'sp_wp_cust_login_logo_js' ) );
  }

  /**
   * Enqueue the Javascript
   *
   * @return void
   */
  public function sp_wp_cust_login_logo_js() {
    wp_register_script( 'custom-js', plugins_url( '/assets/js/sp_custom.js', __FILE__ ), array( 'jquery' ));
    // wp_enqueue_script( 'custom-js', plugins_url( '/assets/js/custom.js', __FILE__ ), array( 'jquery' ) );
  }

  /**
   * Plugin Dir path
   * 
   */
  public static function sp_wp_cust_login_logo_plugin_dir() {
    return plugin_dir_path(__FILE__);
  }

  /**
   * Plugin Dir Url
   * 
   */
  public static function sp_wp_cust_login_logo_plugin_url() {
    return plugin_dir_url(__FILE__);
  }


} /* End Class */

/**
 * The 'main' function
 *
 * @return void
 */
function sp_wp_cust_login_logo_main() {
  new CustomAdminLoginLogo();
}

/**
 * Initialise the plugin
 */
add_action( 'plugins_loaded', 'sp_wp_cust_login_logo_main' );

?>