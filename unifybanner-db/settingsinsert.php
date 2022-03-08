<?php 

   if (isset($_POST['save_settings'])) {
        
        $slot_id = 1;
        $mssgbg_color = $_POST['mssg_bgcolor'];
        $mssgtxt_color = $_POST['mssg_txtcolor'];
        $mssg_position = $_POST['mssglocation'];
        $message = $_POST['message'];

        $settingsdata = array( $mssgbg_color, $mssgtxt_color, $mssg_position, $message );
                    
            if ( get_option( 'storetime_settings' ) !== false ) {
             
                $storesettingsdata = update_option( 'storetime_settings', $settingsdata );
                 
                 if($storesettingsdata == 1){
                    
                    $this->alertmessage( 'successmssg' , 'Record Updated successfully' );

                 }             
            } 
            else {
             
                 $storesettingsdata = add_option( 'storetime_settings', $settingsdata );

                 if($storesettingsdata == 1){
                    
                    $this->alertmessage( 'successmssg' , 'Record Updated successfully' );

                 }
            }

}
