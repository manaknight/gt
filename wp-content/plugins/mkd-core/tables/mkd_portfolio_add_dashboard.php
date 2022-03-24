<?php
global $wpdb;
$message = '';

 

if (isset($_POST['Add'])) 
{ 
    unset($_POST['Add']);
    unset($_POST['content_2']);

    $_POST['content']     = str_replace('"', "'", $_POST['content']); 
    $result = $wpdb->insert('mkd_portfolio', $_POST, array('%s', '%s', '%s', '%s', '%s','%s', '%s'));
    if ($wpdb->last_error === '') 
    {
        $message .= "Portfolio Added. <a href='/wp-admin/admin.php?page=mkd_portfolio_list_dashboard'>Click Here to go back to list</a>";
    }
 
}

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

    $content .= '<select required="true" name="' . $name . '" id="' . $name . '" ' . $extra . '>';

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

// <?php
// //Select users
// echo "<select >";
// $res = $mysqli->query("SELECT id, user_nicename FROM wp_users");
// if ($res) {
//     while ($row = $res->fetch_assoc()) {
//         echo '<option value="' . $row['id'] . '">' . $row['user_nicename'] . '</option>';
//     }
// }
// echo '</select>';
// 

function getCategory()
{
    global $wpdb;
    global $content1;

    $r = $wpdb->get_results("SELECT *   from " . "mkd_categories", ARRAY_A);

    $content1 .= '<select required  name="' .  "category_id" . '" id="' .  "category_id" . '" ' . '>';
    $content1 .= '<option value="" selected="selected">Choose Category</option>';
    foreach ($r as $category) {

        $content1 .= "<option value='$category[id]')'>$category[name]</option>";
    }


    $content1 .= '</select>';

    return $content1;
}


function getFonts()
{
    global $wpdb;
    global $content2;

    $r = $wpdb->get_results("SELECT *   from " . "mkd_font", ARRAY_A);

    $content2 .= '<select required="true" name="' .  "font_id" . '" id="' .  "font_id" . '" ' . '>';
    $content2 .= '<option value="" selected="selected">Choose Fonts</option>';
    foreach ($r as $font) {

        $content2 .= "<option value='$font[id]')'>$font[name]</option>";
    }


    $content2 .= '</select>';

    return $content2;
}
?>

 
<style type="text/css">
    .wp-editor-tabs{
        display: none;
    }
</style>

<div class='wrap'>
    <?php if (strlen($message) > 0) : ?>
        <div class="updated">
            <p><?php echo $message; ?></p>
        </div>
    <?php endif; ?>
    <h1 id="add-new-portfolio">Add Portfolio</h1>

    <form method='POST'>

        <table class='form-table' role='presentation'>
            <tbody>
                <tr class='form-field'>
                    <th scope='row'>
                        <label for='user_id'>
                            Select User
                        </label>
                    </th>
                    <td>
                        <div class="col-md-6">
                            <?php echo getUsersByRole('subscriber', 'user_id'); ?> 
                        </div>
                    </td>
                </tr>

                <tr class='form-field'>

                    <th scope='row'>
                        <label for='title'>
                            Title
                        </label>
                    </th>

                    <td>
                        <input name='title' required id='title' type="text" required='true' />
                    </td>

                </tr> 
                <tr class='form-field'>

                    <th scope='row'>
                        <label for='category'>
                            Category
                        </label>
                    </th>

                    <td>
                        <?php
                        echo getCategory();
                        ?>

                    </td>

                </tr>

                
                <tr class='form-field'>

                    <th scope='row'>
                        <label for='category'>
                            Fonts
                        </label>
                    </th>

                    <td>
                        <?php
                        echo getFonts();
                        ?>

                    </td>

                </tr>


                <tr class='form-field'>
                    <th scope='row'>
                        <label for='content'>
                            Content
                        </label>
                    </th>
                    <td>
                        <?php  
                            wp_editor( "" , 'content_id', array(
                                    'quicktags' => false,
                                    'media_buttons' => false,
                                    'required' => true,
                                    'textarea_rows' => 10,
                                    'teeny' => true,
                                    'textarea_name' => "content_2",
                                    'tinymce'       => array( 'toolbar1'      => 'undo,redo'),
                                ) );
                            ?>   
                        <textarea  style="display: none;" name="content" id="content_fill"></textarea>
                    </td>

                </tr>
                
                <!-- <tr class='form-field'>
                    <th scope='row'>
                        <label for='submitted_to_contest'>
                            Submitted to contest
                        </label>
                    </th>
                    <td>
                        <p>
                            <input type="radio" name="submitted_to_contest" value="yes" checked>Yes</input>
                        </p>
                        <p>
                            <input type="radio" name="submitted_to_contest" value="no">No</input>
                        </p>
                    </td>
                </tr> -->
                <tr class='form-field'>


                    <th scope='row'>
                        <label for='visibility'>
                            Visibility
                        </label>
                    </th>
                    <td>
                        <div class="col-md-6">
                            <select name="visibility" class="form-select" aria-label="Default select example">
                                <option value="public">Public</option>
                                <option value="private">Private</option>
                                <option selected value="">Select</option>
                            </select>
                        </div>
                    </td>
                </tr>




            </tbody>
        </table>

        <?php
        submit_button('add', 'primary', 'Add');
        ?>
    </form>
</div>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function(){ 
        setInterval(function () {
            var content = jQuery(tinymce.get('content_id').getBody()).html();

            jQuery('#content_fill').val(content);
        }, 1000);
    }, false);
</script>