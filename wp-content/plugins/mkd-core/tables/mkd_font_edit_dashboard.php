
<?php
          global $wpdb;
          $id = esc_sql($_GET['id']);
          $results = $id != null ? $wpdb->get_results( 'SELECT * FROM mkd_font WHERE id = '.$id) : null;
          $results = $results[0];
          $message = '';
            if(isset($_POST['edit'])){
                $name = esc_sql($_POST['name']);
                $url = esc_sql($_POST['url']);

                $wpdb->update('mkd_font' ,[
                  'name' => $name,
                  'url' => $url
                ], array('id'=> $id));

                if($wpdb->last_error === '') {
                  $results->name = $name;
                  $results->url = $url;
                  $message .= "Font Edited. <a href='/wp-admin/admin.php?page=mkd_font_list_dashboard'>Click Here to go back to list</a>";
			          }
          }
          ?>


      <div class='wrap'>
                <?php if (strlen($message) > 0) : ?>
            <div class="updated">
                <p><?php echo $message; ?></p>
            </div>
        <?php endif; ?>
      <form method='POST' >
          <h1 id="add-new-font">Edit Font</h1>
        <table class='form-table' role='presentation'>
          <tbody>
        <tr class='form-field'>
            <th scope='row'>
                <label for='name'>
                    Name
                </label>
            </th>
            <td>
                <input type="text" name='name' id='name' required='true' value="<?php echo $results->name ?>"/>
            </td>
        </tr>
        <tr class='form-field'>
            <th scope='row'>
                <label for='url'>
                    URL
                </label>
            </th>
            <td>
                <input type="text" name='url' id='url' required='true' value="<?php echo $results->url ?>"/>
            </td>
        </tr>

    </tbody>
  </table>

        <?php
          submit_button('edit', 'primary', 'edit');
        ?>
    </form>
  </div>
