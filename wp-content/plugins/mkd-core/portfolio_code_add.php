<?php
global $wpdb;
 
$user_id = get_current_user_id();

$message = '';
 


function getUsersByRole($role, $name, $selected = '', $extra = '')
{
    global $wpdb;
    global $content;
    $wp_user_search = new WP_User_Query(array("role" => $role));
    $role_data = $wp_user_search->get_results();
    foreach ($role_data  as $item) {
        $role_data_ids[] = $item->ID;
    }

    $ids = implode(',', $role_data_ids);
    $r = $wpdb->get_results("SELECT *   from " . $wpdb->prefix . "users where id IN(" . $ids . ")", ARRAY_A);

    $content .= '<select name="' . $name . '" id="' . $name . '" ' . $extra . '>';

    if ($selected == '') {
        $content .= '<option value="" selected="selected">Choose a user</option>';
    } else {
        $r_user = $wpdb->get_results("SELECT *   from " . $wpdb->prefix . "users where ID = " . $selected . "", ARRAY_A);
        $content .= '<option value="' . $selected . '" selected="selected">' . stripslashes($r_user[0]['display_name']) . '</option>';
    }

    for ($i = 0; $i < count($r); $i++) {
        $content .= '<option value="' . $r[$i]['ID'] . '">' . stripslashes($r[$i]['display_name']) . '</option>';
    }
    $content .= '</select>';

    return $content;
}

function dropdown_builder($r, $name)
{
    $content1 = '';
    $content1 .= '<select class="form-control"  name="' .  "$name" . '" id="' .  "$name" . "_id" . '" ' . '>';
    $content1 .= '<option value="">Choose ' . "$name" . '</option>';
    foreach ($r as $option) {

        $content1 .= "<option value='$option[id]'>$option[name]</option>";
    }


    $content1 .= '</select>';

    return $content1;
}
function getCategory()
{
    global $wpdb;

    $r = $wpdb->get_results("SELECT *   from " . "mkd_categories", ARRAY_A);
    return dropdown_builder($r, 'category');
}




function getCategories()
{
    global $wpdb;
    global $content3;

    $r = $wpdb->get_results("SELECT *   from " . "mkd_categories", ARRAY_A);

    $content3 .= '<select name="' .  "category " . '" id="' .  "category" . '" ' . '>';
    $content3 .= '<option value="" selected="selected">All</option>';
    foreach ($r as $category) {

        $content3 .= "<option value='$category[id]')'>$category[name]</option>";
    }


    $content3 .= '</select>';

    return $content3;
}
function getFonts()
{
    global $wpdb;
    global $content2;

    $r = $wpdb->get_results("SELECT *   from " . "mkd_font", ARRAY_A);
    return dropdown_builder($r, 'font');
}


function getFontsbyid($id)
{
    global $wpdb;

    $r = $wpdb->get_results("SELECT *   from " . "mkd_font" . "Where id = " . $id, ARRAY_A);

    return $r;
}

function getBackgroundImages()
{
    global $wpdb;
    global $html;

    $r = $wpdb->get_results("SELECT *   from " . "mkd_background", ARRAY_A);

    $html .= '<div class="row p-0 w-100"> ';
    foreach ($r as $img) {

        $html .= "<div class=' image_grid  col-xl-2 col-lg-3 col-md-4 col-sm-4 col-6 mb-2'><label class='modal-img'>
        <img class='image' id='img' style='height:100px ; width :100px' src='$img[url]' class='img-thumbnail'>
        <div class='modal-img-list hidden'>
            <i class='far fa-check-circle'></i>
        </div>
    </label>
   
  </div>";
    }


    $html .= '</div>';

    return $html;
}
