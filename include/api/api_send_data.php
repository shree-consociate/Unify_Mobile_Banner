<?php 

if ( ! defined( 'ABSPATH' ) ) {

    die;

}
   
    $parameters = $request->get_json_params();
        
        if(isset($parameters['data'])){   
        $data =$parameters['data'];
        if (isset($data['country'])) {
            $country =$data['country'];
        if (isset($data['state'])) {
            $state = $data['state'];

            global $wpdb;   
            $url = get_option('siteurl'); 
            $settings = get_option('Unify_ProductAd_Manager_settings'); 

            $universal_ck = get_option( 'universal_view' );
            $ck = $universal_ck['ck'];
            $cs = $universal_ck['cs'];
            $universal_ck['host'] = $url;
            $table_name = array( $wpdb->prefix."unify_mobile_banner",  $wpdb->prefix."unify_mobile_banner_meta");  
            $result = $wpdb->get_results ( "SELECT * FROM $table_name[0] WHERE country='$country' AND state='$state';" );    
            
            if(!empty($result)) 
            {
                $dbanners = array_filter(explode(",", $result[0]->image_url));
                $dproducts = array_filter(explode(",", $result[0]->products));
                $dcoupons = unserialize($result[0]->coupons);
                $dmaintitles = unserialize($result[0]->main_title);
                // $product = wc_get_product( $dproducts[0] );

                for ($b=0; $b < count($dbanners); $b++) { 
                    $banners[$b] = $dbanners[$b];
                }

                for ($c=0; $c < count($dcoupons); $c++) { 
                $rcoupons = $wpdb->get_results( "SELECT post_title AS coupon FROM {$wpdb->prefix}posts WHERE post_type = 'shop_coupon' AND post_status='publish' AND post_name='$dcoupons[$c]';" );
                    $coupons[$c] = array(
                                    'coupon'=>$rcoupons[0]->coupon, 
                                    'main_title'=> $dmaintitles[$c] );
                }
                
                $args = array(
                        'headers' => array(
                        'Content-Type'   => 'application/json',
                        ));
                for ($p=0; $p < count($dproducts); $p++) { 
                    $presult =  wp_remote_get( "$url/index.php/wp-json/wc/v3/products/$dproducts[$p]?consumer_key=$ck&consumer_secret=$cs", $args );
                        $products[] = json_decode($presult['body']);
                }

                // categories API Data
                $categoriesResult =  wp_remote_get( "$url/index.php/wp-json/wc/v3/products/categories?consumer_key=$ck&consumer_secret=$cs", $args );
                $categories[] = json_decode($categoriesResult['body']);

                $adata['banners'] = $banners;
                $adata['offers'] = $coupons;
                $adata['settings'] = $settings;
                $adata['products'] = $products;
                $adata['category'] = $categories;

                // echo json_encode($host); 
                echo json_encode($adata); 

            }
            else{
            $dresult = $wpdb->get_results ( "SELECT * FROM $table_name[0] WHERE id=1;" );    
                $dbanners = array_filter(explode(",", $dresult[0]->image_url));
                $dproducts = array_filter(explode(",", $dresult[0]->products));
                $dcoupons = unserialize($dresult[0]->coupons);
                $dmaintitles = unserialize($dresult[0]->main_title);
                // $product = wc_get_product( $dproducts[0] );

                for ($b=0; $b < count($dbanners); $b++) { 
                    $banners[$b] = $dbanners[$b];
                }

                for ($c=0; $c < count($dcoupons); $c++) { 
                $rcoupons = $wpdb->get_results( "SELECT post_title AS coupon FROM {$wpdb->prefix}posts WHERE post_type = 'shop_coupon' AND post_status='publish' AND post_name='$dcoupons[$c]';" );
                    $coupons[$c] = array(
                                    'coupon'=>$rcoupons[0]->coupon, 
                                    'main_title'=> $dmaintitles[$c] );
                }

                
                $args = array(
                        'headers' => array(
                        'Content-Type'   => 'application/json',
                        ));

                for ($p=0; $p < count($dproducts); $p++) { 
                    $presult =  wp_remote_get( "$url/index.php/wp-json/wc/v3/products/$dproducts[$p]?consumer_key=$ck&consumer_secret=$cs", $args );
                        $products[] = json_decode($presult['body']);

                }

                $adata['banners']   = $banners;
                $adata['offers']    = $coupons;
                $adata['settings']  = $settings;
                $adata['products']  = $products;
                    
                // echo json_encode($host); 
                echo json_encode($adata); 

            }
        }

        }

}