<?php

/**
 * Plugin Name:       Unify Mobile Banner
 * Description:       Set Your Different banners for different location for Unify mobie App.
 * Version:           1.0.1
 * Author:            Consociate Solution Pvt Ltd
 * Author URI:        https://consociatesolutions.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       unify-banner
 * Domain Path:       /languages
 */


if ( ! defined( 'ABSPATH' ) ) {

    die;

}


define('UNIFYBANNER_URL', plugin_dir_url( __FILE__ ) );
define('UNIFYBANNER_PATH', plugin_dir_path( __FILE__ ) );

if ( !class_exists( 'UnifyBanner' ) ) {
    
    class UnifyBanner
    {

        function register(){

            add_action( 'admin_menu' , array( $this, 'menu') );
            
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue') );

            add_action( 'in_admin_header', array( $this, 'menu_page_header' ) );

            add_action('rest_api_init', function () {
              register_rest_route( 'unifybanner/v1','fetch/banner', array(
                        'methods'  => 'POST',
                        'callback' =>  array( $this, 'fetch_api_country_data' ),
                        'permission_callback' => '__return_true'
              ));
            });

            add_action( 'rest_api_init', array($this, 'data_api_hooks') );


        }

        function data_api_hooks() {
          register_rest_route(
            'wp/v2', '/data',
            array(
              'methods'  => 'GET',
              'callback' =>  array($this, 'wc_view'),
            )
          );
        }

            function generateRandomString($length = 40) {
                return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyz', ceil($length/strlen($x)) )),1,$length);
                
            }

            function wc_view(){

            $show=get_option( 'universal_view' );

            if($show==null)
            {

            $consumer_key='ck_'.$this->generateRandomString();
            $consumer_secret='cs_'.$this->generateRandomString();
            $truncated_key = substr( $consumer_key, -7 );   
            $data = array();
            $data['ck'] = $consumer_key;
            $data['cs'] = $consumer_secret;
            add_option( 'universal_view', $data );
            global $wpdb;
            $table_name=$wpdb->prefix . 'woocommerce_api_keys';
            $wpdb->insert( $table_name,
                                      array( 'user_id' => 1,
                                            'description' => 'universal',
                                            'permissions' => 'read',
                                            'consumer_key' => wc_api_hash($consumer_key) ,
                                            'consumer_secret' => $consumer_secret,
                                            'truncated_key' => $truncated_key));


            }

            $show=get_option( 'universal_view' );

            return $show;
            }

        function fetch_api_country_data($request){
                include( plugin_dir_path( __FILE__ ). 'include/api/api_send_data.php' );
        }

        function menu()
        {
                include( plugin_dir_path( __FILE__ ). 'assets/menus/menu.php' );

        }

        function fetch()
        {
                
            include( plugin_dir_path( __FILE__ ). 'unifybanner-db/fetch.php' );

        }

        function fetch_slides()
        {
                
            include( plugin_dir_path( __FILE__ ). 'unifybanner-db/fetch_slides.php' );

        }

        function fetch_products()
        {
            include( plugin_dir_path( __FILE__ ). 'unifybanner-db/fetch_products.php' );
        }

        function fetchTrendingProducts()
        {
            include( plugin_dir_path( __FILE__ ). 'unifybanner-db/fetch_trending_products.php' );
        }

        function fetch_coupons()
        {
                
            include( plugin_dir_path( __FILE__ ). 'unifybanner-db/fetch_coupons.php' );

        }

        function delete()
        {
                
            include( plugin_dir_path( __FILE__ ). 'unifybanner-db/delete.php' );

        }


        function insert()
        {
                
            include( plugin_dir_path( __FILE__ ). 'unifybanner-db/insert.php' );

        }

        function alertmessage($mssg_type, $mssg ){

            echo "<div class=$mssg_type>$mssg</div>";
        }


        function menu_page_markup(){            

            include( plugin_dir_path( __FILE__ ). 'template/menu_page_markup.php' ); 
        }


        function menu_page_header()
        {                
                $current_screen    = get_current_screen();
                if ( 'toplevel_page_unify_mobile_banner' == $current_screen->id ) {
                    include( plugin_dir_path( __FILE__ ). 'template/header.php' ); 
                }

                if ( 'unify-mobile-banner_page_banner_settings' == $current_screen->id ) {
                    include( plugin_dir_path( __FILE__ ). 'template/settings_header.php' ); 
                }
        }

        function submenu_page_markup(){
                
            include( plugin_dir_path( __FILE__ ). 'template/settings_page.php' ); 
            
        }

        function enqueue( $hook ){

            include( plugin_dir_path( __FILE__ ). 'include/enqueue/admin_enqueue.php' );
        }

        function create_db_table(){
            
            include( plugin_dir_path( __FILE__ ). 'unifybanner-db/createdb.php' );

        }

        function remove_db_table() {
        
            include( plugin_dir_path( __FILE__ ). 'unifybanner-db/removedb.php' );

        }

        function default_markup(){
            include( plugin_dir_path( __FILE__ ). 'template/default_markup.php' );
        }

    }

}


if ( class_exists( 'UnifyBanner' )) {
    
    $unifybanner = new UnifyBanner();
    $unifybanner->register();
}


register_activation_hook( __FILE__, array( $unifybanner, 'create_db_table' ) );

register_deactivation_hook( __FILE__, array( $unifybanner, 'remove_db_table' ) );
