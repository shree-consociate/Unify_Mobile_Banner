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

?>
    <tr class="dslotidentity">
        <td width="30%">
            <input type="hidden" name="slotid<?php echo $print->id;?>" class="slotid" value="<?php echo $print->id;?>" readonly>
            <?php echo $print->name;?>
        </td>
        <td width="30%">
            <script>
                document.write(country_and_states['country']['<?php echo $print->country;?>']);
            </script>
        </td>
        <td width="30%">
            <script>
                for( let j=0; j< country_and_states['states']['<?php echo $print->country;?>'].length; j++){
                   if (country_and_states['states']['<?php echo $print->country;?>'][j].code == '<?php echo $print->state;?>'){
                         document.write(country_and_states['states']['<?php echo $print->country;?>'][j].name);
                   }    
                } 
            </script>
            
        </td>
        <td class="delete" width="10%">
            <button name="delete<?php echo $print->id;?>" class="dltbutton"><img class="dltimg" src="<?php echo UNIFYBANNER_URL . 'assets/images/dustbin.png'; ?>"></button>
        </td>
    </tr>
 <?php
$tid++;
}
}
