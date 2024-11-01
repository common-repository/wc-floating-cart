<?php
/**
 * Plugin Name: Floating Cart for WooCommerce
 * Plugin URI:  https://profiles.wordpress.org/walexconcepts/
 * Description: Woocommerce interaction mini cart with many styles and effects. It is great-looking and responsive, and absolutely free!.  
 * Version:     2.0
 * Author:      Awodeyi Adewale Emmanuel
 * Author URI:  https://www.walexconcepts.com/
 * License:     GPLv2+
 */ 
if ( ! defined( 'ABSPATH' ) ) exit;
wp_enqueue_script('jquery');



function floating_woocommerce_cart_after_install(){
define('FLOATING_CART_PATH', __FILE__ . '/'); 
$installpath = explode('plugins', FLOATING_CART_PATH);
define('FLOATING_CART_INSTALLATION_PATH', dirname($installpath[0]) . '/'); 
$path = plugin_dir_path( __FILE__ ) . 'system/wc_floating_woocommerce_cart.sql';
$sql = file_get_contents($path);
require_once( FLOATING_CART_INSTALLATION_PATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );
}
register_activation_hook( __FILE__, 'floating_woocommerce_cart_after_install' );



function floating_woocommerce_cart_after_uninstall() {
global $wpdb;
$wpdb->query( 'DROP TABLE IF EXISTS wc_floating_woocommerce_cart' );
}
register_uninstall_hook( __FILE__, 'floating_woocommerce_cart_after_uninstall' );



function floating_woocommerce_cart_request() {
	global $wpdb;
	global $woocommerce;
    if ( isset($_REQUEST['total']) ) {
        $total = sanitize_text_field($_REQUEST['total']);   
        echo esc_html($total);
    }
	if ( isset($_REQUEST['count']) ) { 	
    $count = 0;
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $count++;
    }
	echo esc_html($count);
    }	
   die();
}
add_action( 'wp_ajax_floating_woocommerce_cart_request', 'floating_woocommerce_cart_request' );
add_action( 'wp_ajax_nopriv_floating_woocommerce_cart_request', 'floating_woocommerce_cart_request');





function floating_woocommerce_cart_header() {	
global $woocommerce;
global $wpdb;
				$result = $wpdb->get_results($wpdb->prepare("SELECT * FROM wc_floating_woocommerce_cart"));
				if($result)
				{
					foreach($result as $row)
					{
					$popbg = sanitize_text_field($row->popbg);
					$basbg = sanitize_text_field($row->basbg);
					$position = sanitize_text_field($row->position);
					$modebox1 = sanitize_text_field($row->modebox);
					$varsubject1 = sanitize_text_field($row->varsubject);	   					
				
					}
				}	
 
wp_enqueue_style( 'font-awesome.min', plugins_url( 'css/font-awesome.min.css', __FILE__ ));
require plugin_dir_path( __FILE__ ) . 'include/floating_cart_myform.php';
}
add_action('wp_head', 'floating_woocommerce_cart_header');




function floating_woocommerce_cart_admin_menu() {
    add_menu_page( 'Floating Woocommerce Cart', 'Floating Woocommerce Cart', null, 'administrator_floating_cart', '', plugin_dir_url( __FILE__ ) . 'adminicon.png');
    add_submenu_page( 'administrator_floating_cart', __( 'Help', 'administrator_floating_cart' ), __( 'Help', 'administrator_floating_cart' ), 'manage_options', 'help_floating_cart', 'floating_cart_help');	
	wp_enqueue_style( 'formstylesheet', plugins_url( 'css/floating_cart_formstylesheet.css', __FILE__ ));
	
}
function floating_cart_help(){
	require plugin_dir_path( __FILE__ ) . 'admin/floating_cart_help.php';
}
add_action('admin_menu', 'floating_woocommerce_cart_admin_menu');




function floating_woocommerce_cart_settings_link( $links){
	$links[] = '<a href="admin.php?page=help_floating_cart">Help</a>' ;		
	$links[] = '<a target="_blank" href="https://walexconcepts.com/index.php?page=item&id=13">Go Premium!</a>' ;
	return $links;
}
add_filter( 'plugin_action_links_'.plugin_basename(__FILE__), 'floating_woocommerce_cart_settings_link');














