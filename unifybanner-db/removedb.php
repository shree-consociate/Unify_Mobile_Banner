<?php
if ( !defined( 'ABSPATH' ) ) 
{
    die;
}
    global $wpdb;
    $table_name = array( $wpdb->prefix."unify_mobile_banner",  $wpdb->prefix."unify_mobile_banner_meta");
   for ($i=0; $i <count($table_name); $i++) { 

     $sql[$i] = "DROP TABLE IF EXISTS $table_name[$i]";
     $wpdb->query($sql[$i]);
    } 