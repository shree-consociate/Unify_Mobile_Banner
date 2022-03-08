<?php
if ( !defined( 'ABSPATH' ) ) 
{
    die;
}

global $wpdb;
$table_name = array( $wpdb->prefix."unify_mobile_banner",  $wpdb->prefix."unify_mobile_banner_meta");

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
$charset_collate = $wpdb->get_charset_collate();

      $sql_data = array(
            "(  id int NOT NULL AUTO_INCREMENT,
                name varchar(255),
                country varchar(255),
                state varchar(255),
                image_url varchar(255),
                products varchar(255),
                trending_products varchar(255),
                coupons varchar(255),
                main_title varchar(255),
                PRIMARY KEY  (id)
              )$charset_collate;",
          "(
              id int NOT NULL AUTO_INCREMENT,
              banner_id int,
              image_url varchar(255),
              main_title varchar(255),
              sec_title varchar(255),
              coupon varchar(255),
              PRIMARY KEY (id)
            ) $charset_collate;",
            );

      for ($i=0; $i <count($table_name) ; $i++) { 
          $sql[$i] = "CREATE TABLE IF NOT EXISTS $table_name[$i] $sql_data[$i]";
          dbDelta($sql[$i]);
      }