
<?php
        global $wpdb;
        $message = '';
        if (isset($_POST['Add'])) {
          unset($_POST['Add']);
          
              $result = $wpdb->insert('mkd_categories' ,$_POST ,array('%s'));
              if($wpdb->last_error === ''){
  				$message .= "Category Added. <a href='/wp-admin/admin.php?page=mkd_categories_list_dashboard'>Click Here to go back to list</a>";
			}
          }
        ?>


      <div class='wrap'>
                <?php if (strlen($message) > 0) : ?>
            <div class="updated">
                <p><?php echo $message; ?></p>
            </div>
        <?php endif; ?>
        <h1 id="add-new-font">Add Contest Category</h1>

        <p>When you have a new category, add here.</p>

      <form method='POST' >

        <table class='form-table' role='presentation'>
          <tbody><tr class='form-field'>
            <th scope='row'>
                <label for='name'>
                    Name
                </label>
            </th>
            <td>
                <input name='name' id='name' type="text" required='true'/>
            </td>
        </tr>

    </tbody>
  </table>

        <?php
          submit_button('add', 'primary', 'Add');
        ?>
    </form>
  </div>
