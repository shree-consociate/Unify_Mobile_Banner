<?php 

if ( ! defined( 'ABSPATH' ) ) {

    die;

}

global $wpdb;     
$table_name = array( $wpdb->prefix."unify_mobile_banner",  $wpdb->prefix."unify_mobile_banner_meta");  

$result = $wpdb->get_results ( "SELECT * FROM ". $table_name[0] );

$tid = 1;
if (!empty($result)) {
foreach ( $result as $print ) 
{
    $imageurl[$print->id] = array_filter(explode(",", $print->image_url));
    if ( $print->image_url != null && $print->image_url != ' ' ) {
        $cnt_imageurl[$print->id] = count($imageurl[$print->id]);
    }else{
        $cnt_imageurl[$print->id] = 0;
    }

?>
<input type="number" name="slides_count_<?php echo $print->id; ?>" id="slides_count_<?php echo $print->id; ?>" value="<?php echo $cnt_imageurl[$print->id]; ?>" hidden>
<div id="slide_container<?php echo $print->id; ?>" class="mb-5 slide_container">
    <div class="container bg-dark p-0">
            <div class="row">
                <div class="d-flex">
                    <button type="button" id="dslides_toggle<?php echo $print->id; ?>" class="btn flex-grow-1 btn-dark"><h2 class="text-white">Slides</h2></button>
                </div>
            </div>
<div class="row mobile_slides" id="mobile_slides<?php echo $print->id; ?>">
    <div class="col-3 m-3">
        <button type="button" class="btn btn-outline-success p-5 dadd_banner_slide" id="dadd_banner_slide_<?php echo $print->id; ?>">
        <span class="dashicons dashicons-plus-alt text-white mb-4 me-3" style="font-size:40px;"></span>
        <h4 class="text-white">
                New Slide
        </h4> 
        </button>
    </div>
    <?php
    for ($i=0; $i < $cnt_imageurl[$print->id]; $i++) {  ?>
    <div class='col-3 p-0 m-3 border border-success mobile_slide' id='dimage_<?php echo $print->id."_$i"; ?>' style="background: url('<?php echo $imageurl[$print->id][$i]; ?>') center center / cover no-repeat;">
        <span class='ddelete_slide closebtn bg-danger rounded-circle p-2' name='ddelete_<?php echo $print->id."_$i"; ?>' id='ddelete_<?php echo $print->id."_$i"; ?>' onclick="ddelete_slide('#dimage_<?php echo $print->id."_$i"; ?>', <?php echo count($imageurl[$print->id]); ?>, <?php echo $i; ?>)">X</span>
        <div class='p-5'><h1 class='image_text'>EDIT</h1></div>
        <input type='text' name='dimage_url_<?php echo $print->id."_$i"; ?>' id='dimage_url_<?php echo $print->id."_$i"; ?>' class='regular-text w-25' value="<?php echo $imageurl[$print->id][$i]; ?>" hidden>
      </div>

    <?php }?>
</div>
</div>
</div>
<?php
}
}