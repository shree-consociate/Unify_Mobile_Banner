<?php

if ( !defined( 'ABSPATH' ) ) 
{
    die;
}

$logoUrl = UNIFYBANNER_URL. "/assets/images/avatar.png";
if(isset( $_POST['save_settings'])){
    // $this->settingsInsertUpdate();

    $settings = [];
    $color      = $_POST['color'];
    $logoUrl    = $_POST['logoUpload'];
    $settings['color']      = $color;
    $settings['logoUrl']    = $logoUrl;

if (!empty(get_option('Unify_ProductAd_Manager_settings'))) {
    $settingsInsert = update_option( 'Unify_ProductAd_Manager_settings', $settings);
}else{    
    $settingsInsert = add_option( 'Unify_ProductAd_Manager_settings', $settings);
}    

    // if($settingsInsert){
    //     echo "<script>alert('success')</script>";
    // }
    // else{
    //     echo "<script>alert('Fail')</script>";
    // }
}
?>
<br><br>
<form method="POST">
    <div class="submenupage">
            
         <?php 
         
    if (!empty(get_option('Unify_ProductAd_Manager_settings'))) {
        $data = get_option('Unify_ProductAd_Manager_settings');
        ?>
            <div class="my-4">
                <label class="form-label me-5" for=""> Select Color </label> 
                <input type="color" class="ms-5" name="color" value="<?php echo $data['color']?>"> 
            </div>
            <?php $logoUrl = $data['logoUrl']?>
            <div class="my-4">
                <label class="form-label d-block" for="upload_logo_button"> Select Logo 
                <img src="<? echo $logoUrl; ?>" width="150px" class="ms-5"> </label>
                <input id="uploadlogo" type="text" name="logoUpload" value="<?php echo $data['logoUrl']?>" hidden> 
                <input id="upload_logo_button" class="button" type="button" 
                value="Upload Image" onclick="upload_logo('uploadlogo')" hidden/>
            </div>
    <?php
    }else{    
?>

<div class="my-4">
                <label class="form-label me-5" for=""> Select Color </label> 
                <input type="color" class="ms-5" name="color" value="#a0bcd6"> 
            </div>

            <div class="my-4">
                <label class="form-label d-block" for="upload_logo_button"> Select Logo 
                <img src="<? echo $logoUrl; ?>" width="150px" class="ms-5"> </label>
                <input id="uploadlogo" type="text" name="logoUpload" value="<? echo $logoUrl; ?>" hidden> 
                <input id="upload_logo_button" class="button" type="button" 
                value="Upload Image" onclick="upload_logo('uploadlogo')" hidden />
            </div>

        <?php
    }    




          ?>   
        <input type="submit" class="btn btn-primary" value="Save Settings" name="save_settings">
    </div>
</form>