<?php 


if ( ! defined( 'ABSPATH' ) ) {

    die;

}


add_menu_page( 'Unify Mobile Banner', 'Unify Mobile Banner', 'manage_options', 'unify_mobile_banner', array( $this, 'menu_page_markup'), 'dashicons-slides', 20 );

add_submenu_page( 'unify_mobile_banner', 'Settings', 'Settings', 'manage_options', 'banner_settings', array( $this, 'submenu_page_markup') );
