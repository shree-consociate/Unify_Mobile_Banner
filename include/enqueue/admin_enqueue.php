<?php 

if ( ! defined( 'ABSPATH' ) ) {

    die;

}

wp_register_script( 'unifybanner-admin', UNIFYBANNER_URL . 'assets/src/js/script.js', array( 'jquery' ), false, true );

wp_register_script( 'unifycountry-admin', UNIFYBANNER_URL . 'assets/src/js/country-states.js');

wp_register_script('unifymobilebanner_bootstrap', UNIFYBANNER_URL . 'assets/src/js/bootstrap.min.js');

wp_register_style('unifymobilebanner_bootstrap', UNIFYBANNER_URL . 'assets/src/css/bootstrap.min.css');

wp_register_style('unifymobilebanner_fontawesome', UNIFYBANNER_URL . 'assets/src/css/fontawesome.min.css');

wp_register_style( 'unifybanner-admin', UNIFYBANNER_URL . 'assets/src/css/style.css' );

$image_path = array( 'image_path' => UNIFYBANNER_URL . 'assets/images/' );

wp_localize_script( 'unifybanner-admin', 'image_url', $image_path );

$dir_path = array( 'dir_path' => UNIFYBANNER_URL );

wp_localize_script( 'unifybanner-admin', 'dir_url', $dir_path );

wp_localize_script( 'unifybanner-admin', 'unifybanner_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

if( 'toplevel_page_unify_mobile_banner' == $hook || 'unify-mobile-banner_page_banner_settings' == $hook ){

	wp_enqueue_script( 'unifycountry-admin' );

	wp_enqueue_script( 'unifybanner-admin' );

	wp_enqueue_style( 'unifybanner-admin' );

    wp_enqueue_script('unifymobilebanner_bootstrap');

    wp_enqueue_style('unifymobilebanner_bootstrap');

    wp_enqueue_style('unifymobilebanner_fontawesome');

    wp_enqueue_media();

}

