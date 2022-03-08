<?php
if ( !defined( 'ABSPATH' ) ) 
{
    die;
}

?>

<div id="slide_container">
    <div class="container bg-dark p-0">
            <div class="row">
                <div class="d-flex">
                    <button type="button" id="slides_toggle" class="btn flex-grow-1 btn-dark"><h2 class="text-white">Slides</h2></button>
                </div>
            </div>
        <div class="row" id="mobile_slides">
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
