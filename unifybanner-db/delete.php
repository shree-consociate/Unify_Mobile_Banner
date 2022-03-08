<?php

if ( ! defined( 'ABSPATH' ) ) {

    die;

}

  global $wpdb;     
$table_name = array( $wpdb->prefix."unify_mobile_banner",  $wpdb->prefix."unify_mobile_banner_meta");  
$result = $wpdb->get_results ( "SELECT * FROM ". $table_name[0] );
if (!empty($result)) {
foreach ( $result as $print ) 
{
        if(isset($_POST['delete'.$print->id])){
          $id = $_POST['slotid'.$print->id];
          $sql = $wpdb->delete(
          $table_name[0],      
          ['id' => $id],
          ['%d'] 
          );

          $sql1 = $wpdb->delete(
          $table_name[1],      
          ['banner_id' => $print->id],
          ['%d'] 
          );

        if ($sql == 1) {
               $in_ch = " ALTER TABLE " . $table_name[0] . " DROP id ";
               $query_result = $wpdb->query( $in_ch );

               $in = " ALTER TABLE " . $table_name[1] . " DROP id ";
               $query = $wpdb->query( $in );

               if ($query_result == 1) {
                   $in_ch1 =  " ALTER TABLE " . $table_name[0] . " AUTO_INCREMENT = 0 ";
                    $query_result1 = $wpdb->query( $in_ch1 );

                    $in1 =  " ALTER TABLE " . $table_name[1] . " AUTO_INCREMENT = 0 ";
                    $query_result1 = $wpdb->query( $in1);

                   if ($query_result1 == 1) {
                    $in_ch2 = " ALTER TABLE " . $table_name[0] . " ADD id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST";
                        $query_result2 = $wpdb->query( $in_ch2 );

                    $in2 = " ALTER TABLE " . $table_name[1] . " ADD id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST";
                        $query_result2 = $wpdb->query( $in2 );
                   }
               }
        } 
    }
}
}