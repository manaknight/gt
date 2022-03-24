
<?php
          global $wpdb;
          $id = esc_sql($_GET['id']);
          $results = $id != null ? $wpdb->get_results( 'SELECT * FROM mkd_categories WHERE id = '.$id) : null;
          $results = $results[0];
          $message = '';
            if(isset($_POST['edit'])){
                $name = esc_sql($_POST['name']);

                $wpdb->update('mkd_categories' ,[
                  'name' => $name
                ], array('id'=> $id));

                if($wpdb->last_error === '') {
                  $results->name = $name;
                  $message .= "Category Edited. <a href='/wp-admin/admin.php?page=mkd_categories_list_dashboard'>Click Here to go back to list</a>";
			          }
          }
          ?>


      <div class='wrap'>
                <?php if (strlen($message) > 0) : ?>
            <div class="updated">
                <p><?php echo $message; ?></p>
            </div>
        <?php endif; ?>
               <h1 id="add-new-font">Edit Contest Category</h1>
      <form method='POST' >
        <table class='form-table' role='presentation'>
          <tbody><tr class='form-field'>
            <th scope='row'>
                <label for='name'>
                    Name
                </label>
            </th>
            <td>
                <input type="text" name='name' id='name' required='true' value="<?php echo $results->name ?>"/>
            </td>
        </tr>

    </tbody>
  </table>

        <?php
          submit_button('edit', 'primary', 'edit');
        ?>
    </form>
  </div>
