
<?php
        global $wpdb;
        $message = '';
        if (isset($_POST['Add'])) {
          unset($_POST['Add']);
            $_POST['body'] = stripslashes($_POST['body']);
              $result = $wpdb->insert('mkd_email_crud' ,$_POST ,array('%s'));
              if($wpdb->last_error === ''){
  				$message .= "Email Template Added. <a href='/wp-admin/admin.php?page=mkd_email_template_list_dashboard'>Click Here to go back to list</a>";
			}
          }
        ?>


      <div class='wrap'>
                <?php if (strlen($message) > 0) : ?>
            <div class="updated">
                <p><?php echo $message; ?></p>
            </div>
        <?php endif; ?>
        <h1 id="add-new-font">Add Email Template</h1>

        <p>When you have a new email template, add here.</p>

      <form method='POST' >

        <table class='form-table' role='presentation'>
          <tbody><tr class='form-field'>
            <th scope='row'>
                <label for='Subject'>
                    Subject
                </label>
            </th>
            <td>
                <input name='subject' id='subject' type="text" required='true'/>
            </td>
          </tr>
          <tr class='form-field'>
            <th scope='row'>
                <label for='Tag'>
                    Tag
                </label>
            </th>
            <td>
                <input name='tag' id='tag' type="text" required='true'/>
            </td>
          </tr>
          <tr class='form-field'>
            <th scope='row'>
                <label for='Message Body'>
                    Message Body
                </label>
            </th>
            <td>
                <textarea rows="10" name='body' id='body' type="text" required='true'></textarea>
            </td>
          </tr>
          <tr class='form-field'>
            <th scope='row'>
                <label for='Slug'>
                    Slug
                </label>
            </th>
            <td>
                <input name='slug' id='slug' type="text" required='true'/>
            </td>
        </tr>

    </tbody>
  </table>

        <?php
          submit_button('add', 'primary', 'Add');
        ?>
    </form>
  </div>
