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
    $dproducts[$print->id] = array_filter(explode(",", $print->products));
    if ( $print->products != null && $print->products != ' ' ) {
        $cnt_products[$print->id] = count($dproducts[$print->id]);
    }else{
        $cnt_products[$print->id] = 0;
    }

?>
<input type="number" name="products_count_<?php echo $print->id; ?>" id="products_count_<?php echo $print->id; ?>" value="<?php echo $cnt_products[$print->id]; ?>" hidden>
<div id="products_container<?php echo $print->id; ?>" class="mb-5 products_container">
    <div class="container bg-dark p-0">
            <div class="row">
                <div class="d-flex">
                    <button type="button" id="dproducts_toggle<?php echo $print->id; ?>" class="btn flex-grow-1 btn-dark"><h2 class="text-white">Products Advertisements</h2></button>
                </div>
            </div>
        <div class="row" id="products_categories<?php echo $print->id; ?>">
            <div class="col-3 m-3">
                <button type="button" class="btn btn-outline-success dadd_products" id="dadd_products_<?php echo $print->id; ?>">
                <h4 class="text-white">
                    Add Products
                </h4> 
                </button>
            </div>
<div class="col">          
<?php for ($i=0; $i < $cnt_products[$print->id]; $i++) {  ?>
    <div class='row m-2'>
      <div class='col text-center'>
      <label class='text-white'>Select Products</label>
      </div>
      <div class='col'>
      <select class='p-1 w-100' id='dproduct_<?php echo $print->id."_$i"; ?>' name='dproduct_<?php echo $print->id."_$i"; ?>'>
        <?php for($p = 0; $p<count($loop->posts); $p++){ ?>
            <option value="<?php echo $loop->posts[$p]->ID; ?>" <?php if($loop->posts[$p]->ID == $dproducts[$print->id][$i]) {
                echo "selected";
            }?>><?php echo '['. $loop->posts[$p]->ID.'] '.$loop->posts[$p]->post_title; ?></option>

        <?php } ?>
      </select>
      </div>
      <div class='col'>
  <button type='button' class='btn btn-danger dlt' name='dproduct_delete_<?php echo $print->id."_$i"; ?>' id='dproduct_delete_<?php echo $print->id."_$i"; ?>' onclick='ddelete_product_select(<?php echo $print->id.",".$i; ?>);'>Remove</button>
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