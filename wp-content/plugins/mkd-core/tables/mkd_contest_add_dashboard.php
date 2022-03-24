

<?php
global $wpdb;
 
$message = '';
if(isset($_POST['Add'])) {
    unset($_POST['Add']);

    $res = $_POST['end_date'];
    $_POST['no_of_particpants'] = 0;
    echo $res;
     $result = $wpdb->insert('mkd_contest', $_POST, array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'));
    var_dump($result);
    if ($wpdb->last_error === '') {
        $message .= "Contest Added. <a href='/wp-admin/admin.php?page=mkd_contest_list_dashboard'>Click Here to go back to list</a>";
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

    $content  = "";
    $ids = implode(',', $role_data_ids);

    $r = $wpdb->get_results("SELECT  wp_users.display_name,mkd_portfolio.id  FROM mkd_portfolio INNER JOIN wp_users on mkd_portfolio.user_id = wp_users.id ", ARRAY_A);

     

    $content .= '<select required="true" name="' . $name . '" id="' . $name . '" ' . $extra . '>';

    if ( empty($selected) )
    {
        $content .= '<option value="" selected="selected">Choose a user</option>';
    } 
    else 
    {
        $r_user = $wpdb->get_results("SELECT  wp_users.display_name,mkd_portfolio.id  FROM mkd_portfolio INNER JOIN wp_users on mkd_portfolio.user_id = wp_users.id WHERE mkd_portfolio.id = '" . $selected . "' ", ARRAY_A);

        // $r_user = $wpdb->get_results("SELECT *   from " . $wpdb->prefix . " users where ID = " . $selected . "", ARRAY_A);
        $content .= '<option value="' . $selected . '" selected="selected">' . stripslashes($r_user[0]['display_name']) . '</option>';
    }

    for ($i = 0; $i < count($r); $i++) 
    {
        
        $content .= '<option value="' . $r[$i]['id'] . '">' . stripslashes($r[$i]['display_name']) . '</option>';
    }
    $content .= '</select>';

    return $content;
}

function getCategory()
{
    global $wpdb;
    global $content1;

    $r = $wpdb->get_results("SELECT *   from " . "mkd_categories", ARRAY_A);

    $content1 .= '<select name="' .  "category_id" . '" id="' .  "category_id" . '" ' . '>';
    $content1 .= '<option value="" selected="selected">Choose Category</option>';
    foreach ($r as $category) {

        $content1 .= "<option value='$category[id]')'>$category[name]</option>";
    }


    $content1 .= '</select>';

    return $content1;
}

?>

<style>
    input[type="date"] {
        position: relative;
    }

    input[type="date"]::-webkit-calendar-picker-indicator {
        background: transparent;
        bottom: 0;
        color: transparent;
        cursor: pointer;
        height: auto;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        width: auto;
    }
</style>

<div class='wrap'>
    <?php if (strlen($message) > 0) : ?>
        <div class="updated">
            <p><?php echo $message; ?></p>
        </div>
    <?php endif; ?>
    <h1 id="add-new-contest">Add Contest</h1>

    <form method='POST'>

        <table class='form-table' role='presentation'>
            <tbody>
                <tr class='form-field'>
                    <th scope='row'>
                        <label for='user'>
                            Title
                        </label>
                    </th>
                    <td>
                        <input name='title' id='title' type="text" required='true' />
                    </td>
                </tr>
                <tr class='form-field'>
                    <th scope='row'>
                        <label for='description'>
                            Description
                        </label>
                    </th>
                    <td>
                        <div class="form-group">

                            <textarea name="description" class="form-control" id="textarea" rows="3"></textarea>
                        </div>
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
                        <label for='start_date'>
                            Start date
                        </label>
                    </th>
                    <td>
                        <input name='start_date' id='start_date' type="date" required='true' />
                    </td>

                </tr>


                <tr class='form-field'>
                    <th scope='row'>
                        <label for='end_date'>
                            End date
                        </label>
                    </th>
                    <td>
                        <input name='end_date' id='end_date' type="date" required='true' />

                    </td>
                </tr>

                <tr class='form-field'>
                    <th scope='row'>
                        <label for='num_winners'>
                            Total number of winners
                        </label>
                    </th>
                    <td>
                        <input min="2" max="5" name='num_winners' id='num_winners' type="number" required='true' />

                    </td>
                </tr>

                <tr class='form-field'>

                    <th scope='row'>
                        <label for='title'>
                            Draw Prize
                        </label>
                    </th>

                    <td>
                        <input name='prize_draw'  type="text"   />
                    </td>

                </tr>

                <tr class='form-field'>
                    <th scope='row'>
                        <label for='total_prize_pool'>
                            Total prize pool
                        </label>
                    </th>
                    <td>
                        <input name='total_prize_pool' id='total_prize_pool' type="text" required='true' />

                    </td>
                </tr>
                <tr class='form-field'>
                    <th scope='row'>
                        <label for='image'>
                          Image  url
                        </label>
                    </th>
                    <td>
                        <input name='url' id='url' type="text" required='true' />

                    </td>
                </tr>
                <tr class='form-field'>
                    <th scope='row'>
                        <label for='Video Url'>
                          Video url
                        </label>
                    </th>
                    <td>
                        <input name='video_url' id='video_url' type="text" required='true' />

                    </td>
                </tr>
           


            </tbody>
        </table>

        <?php
        submit_button('add', 'primary', 'Add');
        ?>
    </form>
</div>