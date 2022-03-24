<?php
global $wpdb;
$id = esc_sql($_GET['id']);
$results = $id != null ? $wpdb->get_results('SELECT * FROM mkd_contest WHERE id = ' . $id) : null;
$results = $results[0];
$message = '';
if (isset($_POST['edit'])) 
{
     $title = esc_sql($_POST['title']);
    $description = esc_sql($_POST['description']);
    $category_id = esc_sql($_POST['category_id']);
    $start_date = esc_sql($_POST['start_date']);
    $end_date = esc_sql($_POST['end_date']);
    $no_of_particpants = esc_sql($_POST['no_of_particpants']);
    $no_of_left = esc_sql($_POST['no_of_left']);

    $winner_1 = esc_sql($_POST['winner_1']);
    $winner_2 = esc_sql($_POST['winner_2']);
    $winner_3 = esc_sql($_POST['winner_3']);
    $winner_4 = esc_sql($_POST['winner_4']);
    $winner_5 = esc_sql($_POST['winner_5']);
    $prize_draw = esc_sql($_POST['prize_draw']);
    $draw_winner = esc_sql($_POST['draw_winner']);
 
    $user_id = esc_sql($_POST['user_id']);
    $num_winners = esc_sql($_POST['num_winners']);
    $total_prize_pool = esc_sql($_POST['total_prize_pool']);
    $url = esc_sql($_POST['url']);
    $video_url = esc_sql($_POST['video_url']);
    $wpdb->update('mkd_contest', [
        'user_id' => $user_id,
        'title' => $title,
        'description' => $description,
        'category_id' => $category_id,
        'start_date' => $start_date,
        'end_date'=> $end_date,
        'no_of_left'=> $no_of_left,
        'num_winners'=> $num_winners,
        'winner_1'=> $winner_1,
        'winner_2'=> $winner_2,
        'winner_3'=> $winner_3,
        'winner_4'=> $winner_4,
        'winner_5'=> $winner_5,
        'prize_draw'=> $prize_draw,
        'draw_winner'=> $draw_winner,
        

        'total_prize_pool' => $total_prize_pool,
        'url'=> $url,
        'video_url'=>$video_url,
    ], array('id' => $id));

    if ($wpdb->last_error === '') {
        $results->user_id = $user_id;
        $results->title = $title;
        $results->description = $description;
        $results->category_id = $category_id;
        $results->start_date = $start_date;
        $results->end_date = $end_date;
        $results->no_of_particpants = $no_of_particpants;
        $results->no_of_left = $no_of_left;
        $results->num_winners = $num_winners;
        $results->winner_1 = $winner_1;
        $results->winner_2 = $winner_2;
        $results->winner_3 = $winner_3;
        $results->winner_4 = $winner_4;
        $results->winner_5 = $winner_5;
        $results->draw_winner = $draw_winner;
        $results->prize_draw = $prize_draw;
        $results->total_prize_pool = $total_prize_pool;
        $results->url = $url;
        $results->video_url = $video_url;


        $message .= "Contest Edited. <a href='/wp-admin/admin.php?page=mkd_contest_list_dashboard'>Click Here to go back to list</a>";
    }
}

function get_display_name($id)
{
    global $wpdb;
    global $content;
   
    $r = $wpdb->get_results("SELECT *   from " . $wpdb->prefix . "users where id = " . $id . ")", ARRAY_A);

    $selected =  $id;
    $content .= '<select name="user_id">';

    if ( empty($selected) )
    {
        $content .= '<option value="user_id" selected="selected" >Choose a user</option>';
    
    }
    else
    {
        $r_user = $wpdb->get_results("SELECT *   from " . $wpdb->prefix . "users where ID = " . $selected . "", ARRAY_A);
        $user_id = $r_user[0]['ID'] ;
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
    $selected = '';

    $r = $wpdb->get_results("SELECT *   from " . "mkd_categories", ARRAY_A);

    $content1 .= '<select name="' .  "category_id" . '" id="' .  "category_id" . '" ' . '>';
    $content1 .= '<option value="">Choose Category</option>';
    foreach ($r as $category) {

        $selected = $category['id'] == $ids ? 'Selected' : '';

        $content1 .= "<option $selected  value='$category[id]')'>$category[name]</option>";
    }


    $content1 .= '</select>';

    return $content1;

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

     

    $content .= '<select  name="' . $name . '" id="' . $name . '" ' . $extra . '>';

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
    <form method='POST'>
        <h1 id="add-new-contest">Edit Contest</h1>
        <table class='form-table' role='presentation'>
            <tbody>

            <tr class='form-field'>
                    <th scope='row'>
                        <label for='user'>
                            Title
                        </label>
                    </th>
                    <td>
                        <input name='title' id='title' type="text" required='true' value="<?php echo $results->title ?>"/>
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
                        <label for='start_date'>
                            Start date
                        </label>
                    </th>
                    <td>
                        <input name='start_date' id='start_date' type="date" required='true' value="<?php echo $results->start_date ?>"/>
                    </td>

                </tr>


                <tr class='form-field'>
                    <th scope='row'>
                        <label for='end_date'>
                            End date
                        </label>
                    </th>
                    <td>
                        <input name='end_date' id='end_date' type="date" required='true' value="<?php echo $results->end_date ?>"/>

                    </td>
                </tr>

                <tr class='form-field'>
                    <th scope='row'>
                        <label for='num_winners'>
                            Total number of winners
                        </label>
                    </th>
                    <td>
                        <input min="2" max="5"  name='num_winners' id='num_winners' type="number" required='true' value="<?php echo $results->num_winners ?>" />

                    </td>
                </tr>

                <tr class='form-field'>

                    <th scope='row'>
                        <label for='title'>
                            Winner 1
                        </label>
                    </th>

                    <td>
                        <?php echo getUsersByRole('subscriber', 'winner_1', $results->winner_1); ?> 
                    </td>

                </tr>


                <tr class='form-field'>

                    <th scope='row'>
                        <label for='title'>
                            Winner 2
                        </label>
                    </th>

                    <td>
                        <?php echo getUsersByRole('subscriber', 'winner_2', $results->winner_2); ?> 
                    </td>

                </tr>


                <tr class='form-field'>

                    <th scope='row'>
                        <label for='title'>
                            Winner 3
                        </label>
                    </th>

                    <td>
                        <?php echo getUsersByRole('subscriber', 'winner_3', $results->winner_3); ?> 
                    </td>

                </tr>



                <tr class='form-field'>

                    <th scope='row'>
                        <label for='title'>
                            Winner 4
                        </label>
                    </th>

                    <td>
                        <?php echo getUsersByRole('subscriber', 'winner_4', $results->winner_4); ?> 
                    </td>

                </tr>


                <tr class='form-field'>

                    <th scope='row'>
                        <label for='title'>
                            Winner 5
                        </label>
                    </th>

                    <td>
                        <?php echo getUsersByRole('subscriber', 'winner_5', $results->winner_5); ?> 
                    </td>

                </tr>



                <tr class='form-field'>
                    <th scope='row'>
                        <label for='total_prize_pool'>
                            Total prize pool
                        </label>
                    </th>
                    <td>
                        <input name='total_prize_pool' id='total_prize_pool' type="text" required='true' value="<?php echo $results->total_prize_pool ?>"/>

                    </td>
                </tr>


                <tr class='form-field'>

                    <th scope='row'>
                        <label for='title'>
                            Draw Winner
                        </label>
                    </th>

                    <td>
                        <?php echo getUsersByRole('subscriber', 'draw_winner', $results->draw_winner); ?> 
                    </td>

                </tr>



                <tr class='form-field'>

                    <th scope='row'>
                        <label for='title'>
                            Draw Prize
                        </label>
                    </th>

                    <td>
                        <input name='prize_draw'  type="text"  value="<?php echo $results->prize_draw ?>"/>
                    </td>

                </tr>
                <tr class='form-field'>
                    <th scope='row'>
                        <label for='image'>
                            Image url
                        </label>
                    </th>
                    <td>
                        <input name='url' id='url' type="text" required='true' value="<?php echo $results->url ?>"/>

                    </td>
                </tr>
                <tr class='form-field'>
                    <th scope='row'>
                        <label for='image'>
                           Video url
                        </label>
                    </th>
                    <td>
                        <input name='video_url' id='video_url' type="text" required='true' value="<?php echo $results->video_url ?>"/>

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
                         
                            <textarea class="form-control" id="description" name="description" rows="3"><?php echo $results->description ?></textarea>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <?php
        submit_button('edit', 'primary', 'edit');
        ?>
    </form>
</div>