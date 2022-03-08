<?php
if ( ! defined( 'ABSPATH' ) ) {

die;

}

$products = wc_get_products(array(
    'limit'  => -1, // All products
    'status' => 'publish', // Only published products
) );

$args = array(
    'post_type' => 'product',
    'post_status' => 'publish',
    'posts_per_page' => -1
);

$loop = new WP_Query( $args );

global $wpdb;     
$table_name = array( $wpdb->prefix."unify_mobile_banner",  $wpdb->prefix."unify_mobile_banner_meta");  

$result = $wpdb->get_results ( "SELECT * FROM ". $table_name[0] );

$tid = 1;

if (!empty($result)) {
foreach ( $result as $print ) 
{
    $dtproducts[$print->id] = array_filter(explode(",", $print->trending_products));
    if ( $print->trending_products != null && $print->trending_products != ' ' ) {
        $cnt_tproducts[$print->id] = count($dtproducts[$print->id]);
    }else{
        $cnt_tproducts[$print->id] = 0;
    }

?>
    <input type="number" name="trending_products_count_<?php echo $print->id; ?>" id="trending_products_count_<?php echo $print->id; ?>" value="<?php echo $cnt_tproducts[$print->id]; ?>" hidden>
    <div id="trending_products_container<?php echo $print->id; ?>" class="mb-5 trending_products_container">
        <div class="container bg-dark p-0">
                <div class="row">
                    <div class="d-flex">
                        <button type="button" id="dtrendingproducts_toggle<?php echo $print->id; ?>" class="btn flex-grow-1 btn-dark"><h2 class="text-white">Products Advertisements</h2></button>
                    </div>
                </div>
            <div class="row" id="trending_products_categories<?php echo $print->id; ?>">
                <div class="col-3 m-3">
                    <button type="button" class="btn btn-outline-success dadd_trending_products" id="dadd_trending_products<?php echo $print->id; ?>">
                    <h4 class="text-white">
                        Add Products
                    </h4> 
                    </button>
                </div>
    <div class="trending_product_col">          
    <?php for ($i=0; $i < $cnt_tproducts[$print->id]; $i++) {  ?>
        <div class='row m-2'>
          <div class='trending_product_col text-center'>
          <label class='text-white'>Select Products</label>
          </div>
          <div class='trending_product_col'>
          <select class='p-1 w-100' id='dtrendingproduct_<?php echo $print->id."_$i"; ?>' name='dtrendingproduct_<?php echo $print->id."_$i"; ?>'>
            <?php for($p = 0; $p<count($loop->posts); $p++){ ?>
                <option value="<?php echo $loop->posts[$p]->ID; ?>" <?php if($loop->posts[$p]->ID == $dtproducts[$print->id][$i]) {
                    echo "selected";
                }?>><?php echo '['. $loop->posts[$p]->ID.']'.$loop->posts[$p]->post_title; ?></option>
    
            <?php } ?>
          </select>
          </div>
          <div class='trending_product_col'>
      <button type='button' class='btn btn-danger dlt' name='dtrending_product_delete_<?php echo $print->id."_$i"; ?>' id='dtrending_product_delete_<?php echo $print->id."_$i"; ?>' onclick='dtrending_delete_product_select(<?php echo $print->id.",".$i; ?>);'>Remove</button>
          </div>
          </div>
                <?php } ?>
        </div>
                </div>
            </div>
        </div>
    <?php 
    }
    }