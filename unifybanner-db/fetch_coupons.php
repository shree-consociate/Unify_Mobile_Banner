<?php 

if ( ! defined( 'ABSPATH' ) ) {
    die;
}


global $wpdb;
$coupons = $wpdb->get_results( "SELECT post_title,post_name FROM {$wpdb->prefix}posts WHERE post_type = 'shop_coupon' AND post_status='publish'" );

$table_name = array( $wpdb->prefix."unify_mobile_banner",  $wpdb->prefix."unify_mobile_banner_meta");  

$result = $wpdb->get_results ( "SELECT * FROM ". $table_name[0] );

$tid = 1;

if (!empty($result)) {
foreach ( $result as $print ) 
{
$result[$print->id] = $wpdb->get_results ( "SELECT * FROM $table_name[1] WHERE banner_id=$print->id");
    $dcoupons[$print->id] = unserialize($print->coupons);
    $dmain_title[$print->id] = unserialize($print->main_title);
    if (!empty($dcoupons[$print->id])) {
        $cnt_coupons[$print->id] = count($dcoupons[$print->id]);
    }else{
        $cnt_coupons[$print->id] = 0;
    }
?>
<input type="number" name="coupons_count_<?php echo $print->id; ?>" id="coupons_count_<?php echo $print->id; ?>" value="<?php echo $cnt_coupons[$print->id]; ?>" hidden>
<div id="coupons_container<?php echo $print->id; ?>" class="mb-5 coupons_container">
    <div class="container p-2">
            <div class="row">
                <div class="d-flex bg-dark px-0 mx-0">
                    <button type="button" id="coupons_toggle<?php echo $print->id; ?>" class="btn flex-grow-1 btn-dark"><h2 class="text-white">Coupons and Offers</h2></button>
                    <button type="button" class="btn btn-success dadd_coupons_offer" id="add_coupons_offer_<?php echo $print->id; ?>">
                        Add Offers
                   </button>
                </div>
            </div>
        <div class="row" id="coupons_offers<?php echo $print->id; ?>">
                        <table width="100%" class="table">
                <thead>
                    <th class="text-dark">Main Title</th>
                    <th class="text-dark">Coupon</th>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                </thead>
                <tbody id="offers_data_<?php echo $print->id; ?>">
                    
<?php 
if (!empty($dcoupons[$print->id])) {
for ($i=0; $i < $cnt_coupons[$print->id]; $i++) {  
// foreach ( $result1 as $print1 ) {  
    ?>
    <tr>
        <td width="30%">
            <input type="text" name="dmain_title_<?php echo $print->id."_".$i; ?>" id="dmain_title_<?php echo $print->id."_".$i; ?>" value="<?php echo $dmain_title[$print->id][$i]; ?>" class="w-100">
        </td>
        <td width="30%">
 <select class='p-1 w-100' id='dcoupon_<?php echo $print->id."_".$i; ?>' name='dcoupon_<?php echo $print->id."_".$i; ?>'>
                            <?php foreach($coupons as $coupon){?>
                    <option value="<?php echo $coupon->post_name;?>" <?php if($coupon->post_name == $dcoupons[$print->id][$i]) {
                            echo "selected";
                        }?>><?php echo $coupon->post_title;?></option>
                    <?php } ?>
            </select>
        </td>
        <td width="10%">
            <button type="button" id="dcoupon_delete_<?php echo $print->id."_".$i; ?>" name="dcoupon_delete_<?php echo $print->id."_".$i; ?>" class="dlt dltbutton" onclick="ddelete_coupon_select(<?php echo $print->id.",".$i; ?>)"><img class="dltimg" src="<?php echo UNIFYBANNER_URL . 'assets/images/dustbin.png'; ?>"></button>
        </td>
    </tr>
                <?php } } ?>
                </tbody>
            </table>

            </div>
        </div>
    </div>
<?php 
}
}