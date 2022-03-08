<?php 

if ( ! defined( 'ABSPATH' ) ) {

    die;

}

if(isset($_POST['ssubmit']))  
{           
        $dimage_url = ' ';
        $dproduct = ' ';
        global $wpdb;      
        $table_name = array( $wpdb->prefix."unify_mobile_banner",  $wpdb->prefix."unify_mobile_banner_meta");  
        $result = $wpdb->get_results ( "SELECT * FROM ". $table_name[0] );
        if (!empty($result)) {
            foreach ($result as $print) {
                // echo $_POST['slides_count_'.$print->id];
                for($s = 0; $s<$_POST['slides_count_'.$print->id]; $s++){
                    if ($s == 0) {
                        $dimage_url = $_POST['dimage_url_'.$print->id.'_'.$s];
                    }else{            
                        $dimage_url .= ",".$_POST['dimage_url_'.$print->id.'_'.$s];
                    }
                }

                for($dp = 0; $dp<$_POST['products_count_'.$print->id]; $dp++){
                    if ($dp == 0) {
                        $dproduct = $_POST['dproduct_'.$print->id.'_'.$dp];
                    }else{            
                        $dproduct .= ",".$_POST['dproduct_'.$print->id.'_'.$dp];
                    }
                }     
                
                // update trending_product
                for($dtp = 0; $dtp<$_POST['trending_products_count_'.$print->id]; $dtp++){
                    if ($dtp == 0) {
                        $dtproduct = $_POST['dtrendingproduct_'.$print->id.'_'.$dtp];
                    }
                    else{            
                        $dtproduct .= ",".$_POST['dtrendingproduct_'.$print->id.'_'.$dtp];
                    }
                } 

                for($dcp = 0; $dcp<$_POST['coupons_count_'.$print->id]; $dcp++){
                    $dcoupon[$print->id][] = $_POST['dcoupon_'.$print->id.'_'.$dcp];
                    $dmain_title[$print->id][] = $_POST['dmain_title_'.$print->id.'_'.$dcp];
                }         
                if (!empty($dcoupon[$print->id])) {
                    $dcoupons[$print->id] = serialize($dcoupon[$print->id]);
                    $dmain_titles[$print->id] = serialize($dmain_title[$print->id]);
                }else{
                    $dcoupons[$print->id] = null;
                    $dmain_titles[$print->id] = null;
                }

              $update_data = $wpdb->update($table_name[0], 
                              array(
                                'image_url'=>$dimage_url,
                                'products'=>$dproduct,
                                'coupons'=>$dcoupons[$print->id],
                                'main_title'=>$dmain_titles[$print->id]
                                ),
                                array('id'=>$print->id)
                            );
  
  // $check = $wpdb->get_results ( "SELECT * FROM $table_name[1] WHERE banner_id=".$print->id);
  //       if (!empty($check)) {
  //         $sql1 = $wpdb->delete(
  //         $table_name[1],      
  //         ['banner_id' => $print->id],
  //         ['%d'] 
  //         );
  //         if ($sql1 ==1) {
  //              $sqlin = " ALTER TABLE " . $table_name[1] . " DROP id ";
  //              $query = $wpdb->query( $sqlin );
  //              if ($query == 1) {
  //                   $sqlin1 =  " ALTER TABLE " . $table_name[1] . " AUTO_INCREMENT = 1 ";
  //                   $query_result1 = $wpdb->query( $sqlin1);
  //                   if ($query_result1 == 1) {
  //                       $sqlin2 = " ALTER TABLE " . $table_name[1] . " ADD id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST";
  //                       $query_result2 = $wpdb->query( $sqlin2 );
                
  //               for($cp = 1; $cp<=$_POST['coupons_count_'.$print->id]; $cp++){
                                            
  //            $uin[]=$wpdb->insert( $table_name[1], array( 'banner_id' => $print->id,
  //                                                   'main_title' => $_POST['dmain_title_'.$print->id.'_'.$cp],
  //                                                       'coupon' => $_POST['dcoupon_'.$print->id.'_'.$cp],
  //                                                       ));

  //                 }
  //   }
  //              }
  //               }
  //           }else{

  //               for($cp = 1; $cp<=$_POST['coupons_count_'.$print->id]; $cp++){
                                            
  //            $uin[]=$wpdb->insert( $table_name[1], array( 'banner_id' => $print->id,
  //                                                   'main_title' => $_POST['dmain_title_'.$print->id.'_'.$cp],
  //                                                       'coupon' => $_POST['dcoupon_'.$print->id.'_'.$cp],
  //                                                       ));
  //                 }

  //           }
        }
            
        }

            $image_url = ' '; 
            $products = ' ';
            for ($i= 1; $i <= $_POST["rowcount"]; $i++) { 

                $slotidentity = $_POST["slot_identity".$i];
                
                $country = $_POST["country_".$i];
                $state = $_POST["state_".$i];
                for($j = 1; $j<=$_POST['slide_count']; $j++){
                    if ($j == 1) {
                        $image_url = $_POST['image_url_'.$j];
                    }else{            
                        $image_url .= ",".$_POST['image_url_'.$j];
                    }
                }

                for($p = 1; $p<=$_POST['products_count']; $p++){
                    if ($p == 1) {
                        $products = $_POST['product'.$p];
                    }else{            
                        $products .= ",".$_POST['product'.$p];
                    }
                }

                // trendig products count
                for($tp = 1; $tp<=$_POST['trending_products_count']; $tp++){
                    if ($tp == 1) {
                        $trendingProducts = $_POST['trending_product'.$tp];
                    }else{            
                        $trendingProducts .= ",".$_POST['trending_product'.$tp];
                    }
                }

                for($c = 1; $c<=$_POST['coupons_count']; $c++){
                    $coupon[] = $_POST['coupon'.$c];
                    $main_title[] = $_POST['main_title'.$c];
                }        
                
                

                $in_ch=$wpdb->insert( $table_name[0], array( 'name' => $slotidentity,
                                                            'country' => $country,
                                                            'state' => $state,
                                                            'image_url' => $image_url,
                                                            'products' => $products,
                                                            'trending_products' => $trendingProducts,
                                                            'coupons'=>serialize($coupon),
                                                            'main_title'=>serialize($main_title)
                                                            ));
                $banner_id = $wpdb->insert_id;

            }

}
// if ( $successmssg['insert'] == 1 ) {
//     $this->alertmessage( 'successmssg' , 'Record created successfully' );
// }elseif($successmssg['insert'] == 2 ) {
//     $this->alertmessage( 'errormssg' , 'Record not created successfully' );
// }
// elseif ( $successmssg['insert'] == 3 ) {
//     $this->alertmessage( 'successmssg' , 'Record Updated successfully' );
// }elseif($successmssg['insert'] == 4 ) {
//     $this->alertmessage( 'errormssg' , 'Record not Updated successfully' );
// }
// }