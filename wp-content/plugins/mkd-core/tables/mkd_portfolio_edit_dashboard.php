<?php
global $wpdb;

$id = esc_sql($_GET['id']);
$results = $id != null ? $wpdb->get_results('SELECT * FROM mkd_portfolio WHERE id = ' . $id) : null;
$results = $results[0];
$message = '';
if (isset($_POST['edit'])) 
{
     
    if (empty($_POST['user_id'])) {
        $user_id =  $results->user_id;
    } else {
        $user_id = esc_sql($_POST['user_id']);
    }
    $font_id = esc_sql($_POST['font_id']);
    $category_id = esc_sql($_POST['category_id']); 

    $title = esc_sql($_POST['title']);
    $content =  $_POST['content']; 
    $visibility = esc_sql($_POST['visibility']);

    $content     = str_replace('"', "'", $content); 

    $wpdb->update('mkd_portfolio', [
        'user_id' => $user_id,
        'title' => $title,
        'content' => $content, 
        'visibility' => $visibility,
        'font_id' => $font_id,
        'category_id' => $category_id, 
    ], array('id' => $id));

    if ($wpdb->last_error === '') 
    {
        $results->user_id = $user_id;
        $results->title = $title;
        $results->content = $content; 
        $results->visibility = $visibility;
        $results->font_id = $font_id;
        $results->category_id = $category_id; 

        $message .= "Portfolio Edited. <a href='/wp-admin/admin.php?page=mkd_portfolio_list_dashboard'>Click Here to go back to list</a>";
    }
}

function get_display_name($id)
{
    global $wpdb;
    global $content;

    $r = $wpdb->get_results("SELECT *   from " . $wpdb->prefix . "users where id = " . $id . ")", ARRAY_A);

    $selected =  $id;
    $content .= '<select required name="user_id" id="user_id">';

    if ($selected == '') {
        $content .= '<option value="" selected="selected">Choose a user</option>';
    } else {
        $r_user = $wpdb->get_results("SELECT *   from " . $wpdb->prefix . "users where ID = " . $selected . "", ARRAY_A);
        $user_id = $r_user[0]['ID'];
        $content .= '<option value="' . $r_user[0]['ID'] . '" selected="selected">' . stripslashes($r_user[0]['display_name']) . '</option>';
    }

    for ($i = 0; $i < count($r); $i++) {
        $content .= '<option value="' . $r[$i]['ID'] . '">' . stripslashes($r[$i]['display_name']) . '</option>';
    }
    $content .= '</select>';

    return $content;
}
function get_display_Category_name($ids)
{

    global $wpdb;
    global $content1;

    $r = $wpdb->get_results("SELECT *   from  mkd_categories where id = " . $ids . ")", ARRAY_A);

    $selected =  $ids;
    $content1 .= '<select required name="category_id" id="category_id" >'; 

    if ($selected == '') 
    {
        $content1 .= '<option value="category_id" selected="selected">Choose a Category</option>';
    } 
    else 
    {
        $r_category = $wpdb->get_results("SELECT *   from " . "mkd_categories where mkd_categories.id = " . $selected . "", ARRAY_A);

        if (isset($r_category[0])) 
        {
            $category_id = $r_category[0]['id'];
            $content1 .= '<option value="' . $r_category[0]['id'] . '" selected="selected">' . stripslashes($r_category[0]['name']) . '</option>';
        }else{
            $content1 .= '<option value="' . $selected . '" selected="selected">Record Deleted</option>';
        }
         
    }

    for ($i = 0; $i < count($r); $i++) {
        $content1 .= '<option value="' . $r[$i]['ID'] . '">' . stripslashes($r[$i]['display_name']) . '</option>';
    }
    $content1 .= '</select>';

    return $content1;
}

function get_display_font_name($idss)
{

    global $wpdb;
    global $content2;

    $r = $wpdb->get_results("SELECT *   from  mkd_font where id = " . $idss . ")", ARRAY_A);

    $selected =  $idss;
    $content2 .= '<select required name="font_id" id="font_id">';

    if ($selected == '') {
        $content2 .= '<option value="font_id" selected="selected">Choose a Font</option>';
    } else {
        $r_font = $wpdb->get_results("SELECT *   from " . "mkd_font where mkd_font.id = " . $selected . "", ARRAY_A);
        $category_id = $r_font[0]['id'];
        $content2 .= '<option value="' . $r_font[0]['id'] . '" selected="selected">' . stripslashes($r_font[0]['name']) . '</option>';
    }

    for ($i = 0; $i < count($r); $i++) {
        $content2 .= '<option value="' . $r[$i]['ID'] . '">' . stripslashes($r[$i]['display_name']) . '</option>';
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
    <form method='POST'>
        <h1 id="add-new-portfolio">Edit Portfolio</h1>
        <table class='form-table' role='presentation'>
            <tbody>

                <tr class='form-field'>
                    <th scope='row'>
                        <label for='user_id'>
                            Select User
                        </label>
                    </th>
                    <td>
                        <?php
                        $display_name = get_display_name($results->user_id);
                        echo $display_name;
                        ?>
                    </td>
                </tr>

                <tr class='form-field'>

                    <th scope='row'>
                        <label for='title'>
                            Category
                        </label>
                    </th>

                    <td>
                        <?php
                        $display_category_name = get_display_Category_name($results->category_id);
                        echo $display_category_name;
                        ?>
                    </td>

                </tr>

                <tr class='form-field'>

                    <th scope='row'>
                        <label for='title'>
                            Fonts
                        </label>
                    </th>

                    <td>
                        <?php
                        $display_font_name = get_display_font_name($results->font_id);
                        echo $display_font_name;
                        ?>
                    </td>

                </tr>


                <tr class='form-field'>

                    <th scope='row'>
                        <label for='title'>
                            Title
                        </label>
                    </th>

                    <td>
                        <input name='title' id='title' type="text" required='true' value="<?php echo $results->title ?>" />
                    </td>

                </tr>
 

                <tr class='form-field'>
                    <th scope='row'>
                        <label for='content'>
                            Content
                        </label>
                    </th>
                    <td>
                        <!-- <textarea name="content"><h3>HELLO<h3></textarea> -->
                        <?php  
                            wp_editor( $results->content , 'content_id', array(
                                    'quicktags' => false,
                                    'media_buttons' => false,
                                    'textarea_rows' => 10,
                                    'teeny' => true,
                                    'required' => true,
                                    'textarea_name' => "content_2",
                                    'tabfocus_elements'   => 'content-html,save-post',
                                    'tinymce'       => array(
                                                        'toolbar1'      => 'undo,redo'),
                                ) );
                            ?>    
                    </td>

                    <textarea  style="display: none;" name="content" id="content_fill"><?php echo $results->content; ?></textarea>

                </tr>

                
                
                <tr class='form-field'>


                    <th scope='row'>
                        <label for='visibility'>
                            Visibility
                        </label>
                    </th>
                    <td>
                        <div class="col-md-6">
                            <select name="visibility" id="visibility" class="form-select" aria-label="Default select example" value="<?php echo $results->visibility ?>">
                                <option <?php if ($results->visibility == "public"): echo "selected"; endif ?> value="public">Public</option>
                                <option  <?php if ($results->visibility == "private"): echo "selected"; endif ?>  value="private">Private</option>
                                <option value="">Select</option>
                            </select>
                        </div>
                    </td>
                </tr>


            </tbody>
        </table>

        <?php
        submit_button('edit', 'primary custom_edit', 'edit');
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