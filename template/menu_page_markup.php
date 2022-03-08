<?php 

if ( ! defined( 'ABSPATH' ) ) {

    die;

}

$this->wc_view();

    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );
    $loop = new WP_Query( $args );

global $wpdb;
$results = $wpdb->get_results( "SELECT post_title,post_name FROM {$wpdb->prefix}posts WHERE post_type = 'shop_coupon' AND post_status='publish'" );
?>
<br><br>
<select id="coupons" hidden>
    <?php foreach($results as $print){?>
    <option value="<?php echo $print->post_name;?>"><?php echo $print->post_title;?></option>
    <?php } ?>
</select>

<select id="products" hidden>
    <?php 
    // foreach($loop->posts as $allp){
    // for($p = 0; $p<count($products); $p++){
    for($p = 0; $p<count($loop->posts); $p++){
    ?>
    <option value="<?php echo $loop->posts[$p]->ID; ?>"><?php echo '['. $loop->posts[$p]->ID.'] '.$loop->posts[$p]->post_title; ?></option>
<?php } ?>
</select>

<!-- (mar_8) -->
<select id="trending_products" hidden>
    <?php 
    for($tp = 0; $tp<count($loop->posts); $tp++){
    ?>
    <option value="<?php echo $loop->posts[$tp]->ID; ?>"><?php echo '['. $loop->posts[$tp]->ID.'] '.$loop->posts[$tp]->post_title; ?></option>
<?php } ?>
</select>

<div class="slotmain" id="slotmain" >

    <!-- <h1 class="slots_header">Unify Mobile Banner</h1> -->
                <div id="success_mssg">     
                    <?php $this->insert(); ?>
                    <?php $this->delete(); ?>
                </div>
<form method="POST">
<div class="main_container mb-5">
<div id="all_banners_table" class="mb-5">
    <div class="d-flex mb-0" id="all_banners">
        <h2 class="btn flex-grow-1 btn-dark p-2 mb-0">Banners</h2>
    </div>
<table border="1" cellspacing="0" cellpadding="20" id="slottable" align="center" width="100%" class="table text-dark mt-0">
    <thead>
        <th class="text-dark">Name</th>
        <th class="text-dark">Country</th>
        <th class="text-dark">State</th>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
    </thead>
    <tbody id="insertnewrow">
        <?php $this->fetch(); ?>
    </tbody>
    </table>
                <div class="emptyfields" id="emptyfields"> </div>
                <input type="number" name="rowcount" id="rowcount" value="0" hidden>
                <input type="number" name="slide_count" id="slide_count" value="0" hidden>
                <input type="number" name="products_count" id="products_count" value="0" hidden>
                <input type="number" name="trending_products_count" id="trending_products_count" value="0" hidden>
                <input type="number" name="coupons_count" id="coupons_count" value="0" hidden>
</div>
<div id="slide_container" class="mb-5 slide_container">
    <div class="container bg-dark p-0">
            <div class="row">
                <div class="d-flex">
                    <button type="button" id="slides_toggle" class="btn flex-grow-1 btn-dark"><h2 class="text-white">Slides</h2></button>
                </div>
            </div>
        <div class="row mobile_slides" id="mobile_slides">
            <div class="col-3 m-3">
                <button type="button" class="btn btn-outline-success p-5" id="add_banner_slide">
                <span class="dashicons dashicons-plus-alt text-white mb-4 me-3" style="font-size:40px;"></span>
                <h4 class="text-white">
                        New Slide
                </h4> 
                </button>
            </div>
        </div>
    </div>
</div>
<div id="fetch_slide_container" class="mb-5">
            <?php $this->fetch_slides(); ?>         
</div>
    <div id="coupons_container" class="mb-5 coupons_container">
    <div class="container p-2">
            <div class="row">
                <div class="d-flex bg-dark px-0 mx-0">
                    <button type="button" id="coupons_toggle" class="btn flex-grow-1 btn-dark"><h2 class="text-white">Coupons and Offers</h2></button>
                    <button type="button" class="btn btn-success" id="add_coupons_offer">
                        Add Offers
                   </button>
                </div>
            </div>
        <div class="row" id="coupons_offers">
            <table width="100%" class="table">
                <thead>
                    <th class="text-dark">Main Title</th>
                    <th class="text-dark">Coupon</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                </thead>
                <tbody id="offers_data">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="fetch_coupons_container" class="mb-5">
            <?php $this->fetch_coupons(); ?>            
</div>
<div id="products_container" class="mb-5 products_container">
    <div class="container bg-dark p-0">
            <div class="row">
                <div class="d-flex">
                    <button type="button" id="products_toggle" class="btn flex-grow-1 btn-dark"><h2 class="text-white">Products Advertisements</h2></button>
                </div>
            </div>
        <div class="row" id="products_categories">
            <div class="col-3 m-2">
                <button type="button" class="btn btn-outline-success" id="add_products">
                <h4 class="text-white">
                    Add Products
                </h4> 
                </button>
            </div>
            <div class="col"></div>
        </div>
    </div>
</div>
<div id="fetch_products_container" class="mb-5">
            <?php $this->fetch_products(); ?>           
</div>
<!-- (Mar_7) -->
<div id="trending_products_container" class="mb-5 trending_products_container">
    <div class="container bg-dark p-0">
            <div class="row">
                <div class="d-flex">
                    <button type="button" id="trending_products_toggle" class="btn flex-grow-1 btn-dark"><h2 class="text-white">Trending Products</h2></button>
                </div>
            </div>
        <div class="row" id="trending_products_categories">
            <div class="col-3 m-2">
                <button type="button" class="btn btn-outline-success" id="add_trending_products">
                    <h4 class="text-white">
                        Trending Products
                    </h4> 
                </button>
            </div>
            <div class="trending_product_col"></div>
        </div>
    </div>
</div>
<div id="fetch_trending_products_container" class="mb-5">
    <?php $this->fetchTrendingProducts(); ?>            
</div>

    <button name="ssubmit" type="submit" id="ssubmit" style="font-size:25px;float: right;" class="save btn btn-success mb-4 me-4 p-auto">Save</button>

</div>
</form>
</div>