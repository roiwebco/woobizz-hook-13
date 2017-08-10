<?php
/*
Plugin Name: Woobizz Hook 13 
Plugin URI: http://woobizz.com
Description: Place cart message before cart table on cart page
Author: Woobizz
Author URI: http://woobizz.com
Version: 1.0.0
Text Domain: woobizzhook13
Domain Path: /lang/
*/
//Prevent direct acces
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//Load translation
add_action( 'plugins_loaded', 'woobizzhook13_load_textdomain' );
function woobizzhook13_load_textdomain() {
  load_plugin_textdomain( 'woobizzhook1', false, basename( dirname( __FILE__ ) ) . '/lang' ); 
}
//Check if WooCommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	//echo "woocommerce is active";
	//Hook(s) 13
	add_filter('wp', 'woobizzhook13_move_woocommerce_message');
	
}else{
	//Show message on admin
	//echo "woocommerce is not active";
	add_action( 'admin_notices', 'woobizzhook13_admin_notice' );
}
//Add Hook 13
function woobizzhook13_move_woocommerce_message(){
  remove_action( 'storefront_content_top', 'storefront_shop_messages', 15 );
  add_action( 'woocommerce_before_cart_table', 'storefront_shop_messages', 15 );
}
//Hook13 Notice
function woobizzhook13_admin_notice() {
    ?>
    <div class="notice notice-error is-dismissible">
        <p><?php _e( 'Woobizz Hook 13 needs WooCommerce to work properly, If you do not use this plugin you can disable it!', 'woobizzhook13' ); ?></p>
    </div>
    <?php
}