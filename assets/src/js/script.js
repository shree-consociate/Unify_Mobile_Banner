jQuery(document).ready(function () {
  var row_id = 0;
  jQuery("#addnewrow").click(function () {
    jQuery('#addnewrow').hide();
    jQuery('#slide_container').show();
    jQuery('#mobile_slides').show();
    jQuery('#products_container').show();
    jQuery('#products_categories').show();
    jQuery('#coupons_container').show();
    jQuery('#coupons_offers').show();
    jQuery('#trending_products_container').show();
    jQuery('#trending_products_categories').show();
    ++row_id;
    tablerow = '<tr id="r' + row_id + '"><td class=slot_identity width="30%">';
    tablerow += '<input type="text" name="slot_identity' + row_id + '" class="w-100"></td>';
    tablerow += '<td width="30%">';
    tablerow += '<select class="country w-100" id="country_' + row_id + '" name="country_' + row_id + '" ><option> <option><select>';
    tablerow += '</td>';
    tablerow += '<td width="30%">';
    tablerow += '<select class="state w-100" id="state_' + row_id + '" name="state_' + row_id + '" ><option> <option><select>';
    tablerow += '</td>';
    tablerow += '<td width="10%"><button type="button" class="dlt dltbutton"><img class="dltimg" src=" ' + image_url.image_path + 'dustbin.png"></button></td></tr>';


    jQuery('#insertnewrow').append(tablerow);
    jQuery('#rowcount').val(row_id);

    create_country_dropdown("country_" + row_id);
    create_states_dropdown("country_" + row_id, "state_" + row_id);

  });

  jQuery('#all_banners').click(function () {
    jQuery('#slottable').toggle();
  });

  jQuery('#slottable ').on('change', '.country', function () {
    let ids = jQuery(this).attr('id');
    const id = ids.split('_');
    create_states_dropdown("country_" + id[1], "state_" + id[1]);

  });


  jQuery('#slottable').on('click', '.dlt', function () {

    var child = jQuery(this).closest('tr').nextAll();
    jQuery('#addnewrow').show();
    child.each(function () {

      var id = jQuery(this).attr('id');

      var slot_identity = jQuery(this).children('.slot_identity').children('input');
      var day = jQuery(this).children('.day').children('input');
      var holiday = jQuery(this).children('.holiday').children('input');
      var opentime = jQuery(this).children('.opentime').children('input');
      var closetime = jQuery(this).children('.closetime').children('input');
      var active_disable = jQuery(this).children('.active_disable').children('input');
      var dayid = jQuery(this).children('.day');

      var dig = parseInt(id.substring(1));
      --dig;
      slot_identity.attr('name', "slot_identity" + dig);
      day.attr('name', "day" + dig + "[]");
      dayid.attr('id', "day" + dig);
      holiday.attr('name', "holiday" + dig);
      opentime.attr('name', "opentime" + dig);
      closetime.attr('name', "closetime" + dig);
      active_disable.attr('name', "active_disable" + dig);

      jQuery(this).attr('id', "r" + dig);
    });

    jQuery(this).closest('tr').remove();

    row_id--;
    jQuery('#rowcount').val(row_id);
  });


  jQuery('.dslotidentity').click(function () {
    var id = jQuery(this).children().children('input').val();
    jQuery('#addnewrow').hide();
    jQuery('.slide_container').hide();
    jQuery('#slide_container' + id).show();
    jQuery('.coupons_container').hide();
    jQuery('#coupons_container' + id).show();
    jQuery('.products_container').hide();
    jQuery('#products_container' + id).show();
    jQuery('.trending_products_container').hide();
    jQuery('#trending_products_container' + id).show();
  });

});

// setInterval(function(){ jQuery('#success_mssg').html(''); }, 6000);
// setInterval(function(){ jQuery('#emptyfields').html(''); }, 6000);



let user_country_code = "IN";


function create_country_dropdown(id) {

  let country_list = country_and_states['country'];

  // creating country name drop-down
  let option = '';
  option += '<option>select country</option>';
  for (let country_code in country_list) {
    // set selected option user country
    let selected = (country_code == user_country_code) ? ' selected' : '';
    option += '<option value="' + country_code + '"' + selected + '>' + country_list[country_code] + '</option>';
  }

  document.getElementById(id).innerHTML = option;
}


function create_states_dropdown(country_id, state_id) {
  // get selected country code
  let country_code = document.getElementById(country_id).value;
  let states_list = country_and_states['states'];
  let states = states_list[country_code];

  // invalid country code or no states add textbox
  if (!states) {
    state_code_id.innerHTML = text_box;
    return;
  }
  let option = '';
  if (states.length > 0) {
    for (let i = 0; i < states.length; i++) {
      option += '<option value="' + states[i].code + '">' + states[i].name + '</option>';
    }
  } else {
    // create input textbox if no states 
    option = text_box
  }
  document.getElementById(state_id).innerHTML = option;
}


function upload_image(id) {
  var image = wp.media({
    title: 'Select Image',
    multiple: false
  }).open()
    .on('select', function (e) {
      var uploaded_image = image.state().get('selection').first();
      var image_url = uploaded_image.toJSON().url;
      document.getElementById('image_url_' + id).value = image_url;
      document.getElementById('image_' + id).style.background = "url('" + image_url + "') no-repeat center";
      document.getElementById('image_' + id).style.backgroundSize = "cover";
    });
}



jQuery(document).ready(function ($) {
  $('#fetch_slide_container').on('click', '.mobile_slide', function () {
    var main_id = $(this).attr('id');
    const id = main_id.split('_');
    var image = wp.media({
      title: 'Select Image',
      multiple: false
    }).open()
      .on('select', function (e) {
        var uploaded_image = image.state().get('selection').first();
        var image_url = uploaded_image.toJSON().url;
        document.getElementById('dimage_url_' + id[1] + '_' + id[2]).value = image_url;
        document.getElementById(main_id).style.background = "url('" + image_url + "') no-repeat center";
        document.getElementById(main_id).style.backgroundSize = "cover";

      });
  });

  $('#fetch_slide_container').on('click', '.dadd_banner_slide', function () {
    var main_id = $(this).attr('id');
    const id = main_id.split('_');
    var row_id = $('#slides_count_' + id[3]).val();
    if (row_id == null) {
      row_id = 0
    }
    var index = Number(row_id) + 1;
    var col = "<div class='col-3 p-0 m-3 border border-success mobile_slide' id='dimage_" + id[3] + '_' + row_id + "'>";
    col += "<span class='closebtn bg-danger rounded-circle p-2' name='ddelete_" + id[3] + '_' + row_id + "' id='ddelete_" + id[3] + '_' + row_id + "' onclick='ddelete_slide('#dimage_" + id[3] + "_" + row_id + "', " + row_id + "," + row_id + ")'>X</span>";
    col += "<div class='p-5'><h1 class='image_text'>EDIT</h1></div>";
    col += "<input type='text' name='dimage_url_" + id[3] + '_' + row_id + "' id='dimage_url_" + id[3] + '_' + row_id + "' class='regular-text w-25' hidden>";
    col += "</div>";
    $(this).parent().parent().append(col);
    document.getElementById('slides_count_' + id[3]).value++;
    var image = wp.media({
      title: 'Select Image',
      multiple: false
    }).open()
      .on('select', function (e) {
        var uploaded_image = image.state().get('selection').first();
        var image_url = uploaded_image.toJSON().url;
        jQuery('#dimage_url_' + id[3] + '_' + row_id).attr('value', image_url);
        // document.getElementById('dimage_url_'+ id[3] + '_' + row_id).value = image_url;
        document.getElementById('dimage_' + id[3] + '_' + row_id).style.background = "url('" + image_url + "') no-repeat center";
        document.getElementById('dimage_' + id[3] + '_' + row_id).style.backgroundSize = "cover";

      });
  });

  // add row in product fetch section
  $('#fetch_products_container').on('click', '.dadd_products', function () {
    var main_id = $(this).attr('id');
    const id = main_id.split('_');
    var row_id = $('#products_count_' + id[2]).val();
    if (row_id == null) {
      row_id = 0
    }
    var index = Number(row_id) + 1;
    var col = "<div class='row m-2'>";
    col += "<div class='col text-center'>";
    col += "<label class='text-white'>Select Products</label>";
    col += "</div>";
    col += "<div class='col'>";
    col += "<select class='p-1 w-100' id='dproduct_" + id[2] + '_' + row_id + "' name='dproduct_" + id[2] + '_' + row_id + "'>";
    col += "</select>";
    col += "</div>";
    col += "<div class='col'>";
    col += "<button type='button' class='btn btn-danger dlt' id='dproduct_delete_" + id[2] + '_' + row_id + "' name='dproduct_delete_" + id[2] + '_' + row_id + "' onclick='ddelete_product_select(" + id[2] + "," + row_id + ")'>Remove</button>";
    col += "</div>";
    col += "</div>";


    $(this).parent().next('.col').append(col);
    $('#dproduct_' + id[2] + '_' + row_id).html($('#products').html());
    $('#products_count_' + id[2]).val(index);

  });


  // add row trending product fetch
  $('#fetch_trending_products_container').on('click', '.dadd_trending_products', function () {
    var main_id = $(this).attr('id');
    const id = main_id.split('_');
    var row_id = $('#trending_products_count_' + id[2]).val();
    if (row_id == null) {
      row_id = 0
    }
    var index = Number(row_id) + 1;
    var col = "<div class='row m-2'>";
    col += "<div class='trending_product_col text-center'>";
    col += "<label class='text-white'>Select Products</label>";
    col += "</div>";
    col += "<div class='trending_product_col'>";
    col += "<select class='p-1 w-100' id='dtrendingproduct_" + id[2] + '_' + row_id + "' name='dtrendingproduct_" + id[2] + '_' + row_id + "'>";
    col += "</select>";
    col += "</div>";
    col += "<div class='trending_product_col'>";
    col += "<button type='button' class='btn btn-danger dlt' id='trendingproduct_delete_" + id[2] + '_' + row_id + "' name='trendingproduct_delete_" + id[2] + '_' + row_id + "' onclick='trendingproduct_delete_(" + id[2] + "," + row_id + ")'>Remove</button>";
    col += "</div>";
    col += "</div>";


    $(this).parent().next('.trending_product_col').append(col);
    $('#dtrendingproduct_' + id[2] + '_' + row_id).html($('#trending_products').html());
    $('#trending_products_count_' + id[2]).val(index);

  });



  $('#fetch_coupons_container').on('click', '.dadd_coupons_offer', function () {
    var main_id = $(this).attr('id');
    const id = main_id.split('_');
    var row_id = $('#coupons_count_' + id[3]).val();
    var index = Number(row_id) + 1;

    var tablerow = '<tr><td width="30%">';
    tablerow += '<input type="text" name="dmain_title_' + id[3] + '_' + row_id + '" id="dmain_title_' + id[3] + '_' + row_id + '" class="w-100"></td>';
    tablerow += '<td width="30%">';
    tablerow += '<select class="p-1 w-100" id="dcoupon_' + id[3] + '_' + row_id + '" name="dcoupon_' + id[3] + '_' + row_id + '" ><select>';
    tablerow += '</td>';
    tablerow += '<td width="10%"><button type="button" id="dcoupon_delete_' + id[3] + '_' + row_id + '" class="dlt dltbutton" onclick="ddelete_coupon_select(' + id[3] + ',' + row_id + ')"><img class="dltimg" src=" ' + image_url.image_path + 'dustbin.png"></button></td></tr>';

    $('#offers_data_' + id[3]).append(tablerow);
    $('#dcoupon_' + id[3] + '_' + row_id).html($('#coupons').html());
    $('#coupons_count_' + id[3]).val(index);

  });
});



function upload_logo(id) {
  var image = wp.media({
    title: 'Select Logo',
    multiple: false
  }).open()
    .on('select', function (e) {
      var uploaded_image = image.state().get('selection').first();
      var image_url = uploaded_image.toJSON().url;
      document.getElementById(id).value = image_url;
    });
}

function remove_image(id) {
  id.parentElement.remove();
}

jQuery(document).ready(function ($) {
  $('#add_banner_slide').on('click', function () {
    var row_id = $('#slide_count').val();
    ++row_id;
    var col = "<div class='col-3 p-0 m-3 border border-success mobile_slide' id='image_" + row_id + "'>";
    col += "<span class='closebtn bg-danger rounded-circle p-2' id='delete_" + row_id + "' onclick='delete_slide(" + row_id + ")'>X</span>";
    col += "<div class='p-5'><h1 class='image_text'>EDIT</h1></div>";
    col += "<input type='text' name='image_url_" + row_id + "' id='image_url_" + row_id + "' class='regular-text w-25' hidden>";
    col += "</div>";
    $(this).parent().parent().append(col);
    $('#slide_count').val(row_id);
    upload_image(row_id);
  });


  $('#mobile_slides').on('click', '.mobile_slide', function () {
    let ids = $(this).attr('id');
    const id = ids.split('_');
    upload_image(id[1]);
  });

  $('#slides_toggle').click(function () {
    $('#mobile_slides').fadeToggle("slow");
  });

  $('#coupons_toggle').click(function () {
    $('#coupons').fadeToggle("slow");
  });

  $('#products_toggle').click(function () {
    $('#products_categories').fadeToggle("slow");
  });

  $('#trending_products_toggle').click(function () {
    $('#trending_products_categories').fadeToggle("slow");
  });

});

function delete_slide(el) {
  var count = jQuery('#slide_count').val();
  var cnt = el + 1;
  var t = el;
  for (var i = cnt; i <= count; i++) {
    jQuery('#image_' + i).attr('id', 'image_' + t);
    jQuery('#image_url_' + i).attr('name', 'image_url_' + t);
    jQuery('#image_url_' + i).attr('id', 'image_url_' + t);
    jQuery('#delete_' + i).attr('onclick', 'delete_slide(' + t + ')');
    jQuery('#delete_' + i).attr('id', 'delete_' + t);
    t++;
  }
  jQuery('#image_' + el).remove();
  --count;
  jQuery('#slide_count').val(count);
}

function ddelete_slide(el, count, current) {
  // var count = jQuery('#slide_count').val();
  var cnt = current + 1;
  // var t = el;
  var new_count = count - 1;
  const id = el.split('_');
  for (var i = cnt; i <= count; i++) {
    jQuery('#dimage_' + id[1] + '_' + i).attr('id', '#dimage_' + id[1] + '_' + current);
    jQuery('#dimage_url_' + id[1] + '_' + i).attr('name', 'dimage_url_' + id[1] + '_' + current);
    jQuery('#dimage_url_' + id[1] + '_' + i).attr('id', 'dimage_url_' + id[1] + '_' + current);
    jQuery('#ddelete_' + id[1] + '_' + i).attr('onclick', 'ddelete_slide("#dimage_' + id[1] + '_' + i + '",' + new_count + ',' + current + ')');
    jQuery('#ddelete_' + id[1] + '_' + i).attr('id', 'ddelete_' + id[1] + '_' + current);
    current++;
  }

  jQuery('#slides_count_' + id[1]).val(new_count);
  // console.log(current);
  // console.log(count);
  jQuery(el).remove();
}


// advertisement product row count
jQuery(document).ready(function ($) {
  $('#add_products').on('click', function () {
    var row_id = $('#products_count').val();
    ++row_id;
    var col = "<div class='row m-2'>";
    col += "<div class='col text-center'>";
    col += "<label class='text-white'>Select Products</label>";
    col += "</div>";
    col += "<div class='col'>";
    col += "<select class='p-1 w-100' id='product" + row_id + "' name='product" + row_id + "'>";
    col += "</select>";
    col += "</div>";
    col += "<div class='col'>";
    col += "<button type='button' class='btn btn-danger dlt' id='product_delete" + row_id + "' onclick='delete_product_select(" + row_id + ")'>Remove</button>";
    col += "</div>";
    col += "</div>";

    $(this).parent().next('.col').append(col);
    $('#product' + row_id).html($('#products').html());
    $('#products_count').val(row_id);

  });
});


function delete_product_select(el) {
  var count = jQuery('#products_count').val();
  var cnt = el + 1;
  var t = el;
  for (var i = cnt; i <= count; i++) {
    jQuery('#product' + i).attr('id', 'product' + t);
    jQuery('#product' + i).attr('name', 'product' + t);
    jQuery('#product_delete' + i).attr('onclick', 'delete_product_select(' + t + ')');
    jQuery('#product_delete' + i).attr('id', 'product_delete' + t);
    t++;
  }
  jQuery('#product' + el).parent().parent().remove();
  --count;
  jQuery('#products_count').val(count);
}


// add trending product row
jQuery(document).ready(function ($) {
  $('#add_trending_products').on('click', function () {
    var row_id = $('#trending_products_count').val();
    ++row_id;
    var col = "<div class='row m-2'>";
    col += "<div class='col text-center'>";
    col += "<label class='text-white'>Select Products</label>";
    col += "</div>";
    col += "<div class='col'>";
    col += "<select class='p-1 w-100' id='trending_product" + row_id + "' name='trending_product" + row_id + "'>";
    col += "</select>";
    col += "</div>";
    col += "<div class='col'>";
    col += "<button type='button' class='btn btn-danger dlt' id='trending_product_delete" + row_id + "' onclick='delete_trending_product_select(" + row_id + ")'>Remove</button>";
    col += "</div>";
    col += "</div>";


    $(this).parent().next('.trending_product_col').append(col);
    $('#trending_product' + row_id).html($('#trending_products').html());
    $('#trending_products_count').val(row_id);

  });
});


// delete trending product row
function delete_trending_product_select(el) {
  var count = jQuery('#trending_products_count').val();
  var cnt = el + 1;
  var t = el;
  for (var i = cnt; i <= count; i++) {
    jQuery('#trending_product' + i).attr('id', 'trending_product' + t);
    jQuery('#prodtrending_productuct' + i).attr('name', 'trending_product' + t);
    jQuery('#trending_product_delete' + i).attr('onclick', 'delete_trending_product_select(' + t + ')');
    jQuery('#trending_product_delete' + i).attr('id', 'trending_product_delete' + t);
    t++;
  }
  jQuery('#trending_product' + el).parent().parent().remove();
  --count;
  jQuery('#trending_products_count').val(count);
}



jQuery(document).ready(function ($) {
  $('#add_coupons_offer').on('click', function () {
    var row_id = $('#coupons_count').val();
    ++row_id;
    var col = "<div class='row m-2'>";
    col += "<div class='col text-center'>";
    col += "<label class='text-white'>Select Coupons</label>";
    col += "</div>";
    col += "<div class='col'>";
    col += "<select class='p-1 w-100' id='coupon" + row_id + "' name='coupon" + row_id + "'>";
    col += "</select>";
    col += "</div>";
    col += "<div class='col'>";
    col += "<button type='button' class='btn btn-danger dlt' id='coupon_delete" + row_id + "' onclick='delete_coupon_select(" + row_id + ")'>Remove</button>";
    col += "</div>";
    col += "</div>";


    var tablerow = '<tr><td width="30%">';
    tablerow += '<input type="text" name="main_title' + row_id + '" id="main_title' + row_id + '" class="w-100"></td>';
    tablerow += '<td width="30%">';
    tablerow += '<select class="p-1 w-100" id="coupon' + row_id + '" name="coupon' + row_id + '" ><select>';
    tablerow += '</td>';
    tablerow += '<td width="10%"><button type="button" id="coupon_delete' + row_id + '" class="dlt dltbutton" onclick="delete_coupon_select(' + row_id + ')"><img class="dltimg" src=" ' + image_url.image_path + 'dustbin.png"></button></td></tr>';

    $('#offers_data').append(tablerow);
    $('#coupon' + row_id).html($('#coupons').html());
    $('#coupons_count').val(row_id);

  });
});


function delete_coupon_select(el) {
  var count = jQuery('#coupons_count').val();
  var cnt = el + 1;
  var t = el;
  for (var i = cnt; i <= count; i++) {
    jQuery('#main_title' + i).attr('name', 'main_title' + t);
    jQuery('#main_title' + i).attr('id', 'main_title' + t);
    jQuery('#coupon' + i).attr('name', 'coupon' + t);
    jQuery('#coupon' + i).attr('id', 'coupon' + t);
    jQuery('#coupon_delete' + i).attr('onclick', 'delete_coupon_select(' + t + ')');
    jQuery('#coupon_delete' + i).attr('id', 'coupon_delete' + t);
    t++;
  }
  jQuery('#coupon' + el).parent().parent().remove();
  --count;
  jQuery('#coupons_count').val(count);
}

jQuery('.slide_container').hide();
// jQuery('#mobile_slides').hide();
// jQuery('#fetch_slides').hide();

jQuery('.coupons_container').hide();
jQuery('#coupons_offers').hide();
jQuery('.products_container').hide();
jQuery('#products_categories').hide();
jQuery('#fetch_products').hide();
jQuery('.trending_products_container').hide();



function ddelete_product_select(id, el) {
  var count = jQuery('#products_count_' + id).val();
  var cnt = el + 1;
  var t = el;
  for (var i = cnt; i <= count; i++) {
    jQuery('#dproduct_' + id + '_' + i).attr('id', 'dproduct_' + id + '_' + t);
    jQuery('#dproduct_' + id + '_' + i).attr('name', 'dproduct_' + id + '_' + t);
    jQuery('#dproduct_delete_' + id + '_' + i).attr('onclick', 'ddelete_product_select(' + id + ' ,' + i + ')');
    jQuery('#dproduct_delete_' + id + '_' + i).attr('name', 'dproduct_delete_' + id + '_' + t);
    jQuery('#dproduct_delete_' + id + '_' + i).attr('id', 'dproduct_delete_' + id + '_' + t);
    t++;
  }
  jQuery('#dproduct_delete_' + id + '_' + el).parent().parent().remove();
  --count;
  jQuery('#products_count_' + id).val(count);
}


function dtrending_delete_product_select(id, el) {
  var count = jQuery('#trending_products_count_' + id).val();
  var cnt = el + 1;
  var t = el;
  for (var i = cnt; i <= count; i++) {
    jQuery('#dtrendingproduct_' + id + '_' + i).attr('id', 'dtrendingproduct_' + id + '_' + t);
    jQuery('#dtrendingproduct_' + id + '_' + i).attr('name', 'dtrendingproduct_' + id + '_' + t);
    jQuery('#dtrendingproduct_delete_' + id + '_' + i).attr('onclick', 'dtrending_delete_product_select(' + id + ' ,' + i + ')');
    jQuery('#dtrending_product_delete_' + id + '_' + i).attr('name', 'dtrending_product_delete_' + id + '_' + t);
    jQuery('#dtrending_product_delete_' + id + '_' + i).attr('id', 'dtrending_product_delete_' + id + '_' + t);
    t++;
  }
  jQuery('#dtrendingproduct_delete_' + id + '_' + el).parent().parent().remove();
  --count;
  jQuery('#trending_products_count_' + id).val(count);
}




function ddelete_coupon_select(el, id) {
  var count = jQuery('#coupons_count_' + el).val();
  var cnt = id + 1;
  var t = id;
  for (var i = cnt; i <= count; i++) {
    jQuery('#dmain_title_' + el + '_' + i).attr('name', 'dmain_title_' + el + '_' + t);
    jQuery('#dmain_title_' + el + '_' + i).attr('id', 'dmain_title_' + el + '_' + t);
    jQuery('#dcoupon_' + el + '_' + i).attr('name', 'dcoupon_' + el + '_' + t);
    jQuery('#dcoupon_' + el + '_' + i).attr('id', 'dcoupon_' + el + '_' + t);
    jQuery('#dcoupon_delete_' + el + '_' + i).attr('onclick', 'ddelete_coupon_select(' + el + ' ,' + t + ')');
    jQuery('#dcoupon_delete_' + el + '_' + i).attr('name', 'dcoupon_delete_' + el + '_' + t);
    jQuery('#dcoupon_delete_' + el + '_' + i).attr('id', 'dcoupon_delete_' + el + '_' + t);
    t++;
  }
  jQuery('#dcoupon_delete_' + el + '_' + id).parent().parent().remove();
  count--;
  jQuery('#coupons_count_' + el).val(count);
}