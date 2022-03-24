
<?php
          global $wpdb;
          $id = esc_sql($_GET['id']);
          $results = $id != null ? $wpdb->get_results( 'SELECT * FROM mkd_email_crud WHERE id = '.$id) : null;
          $results = $results[0];
          $message = '';
            if(isset($_POST['edit'])){
                $subject = esc_sql($_POST['subject']);
                $tag = esc_sql($_POST['tag']);
                $body = stripslashes($_POST['body']);
                $slug = esc_sql($_POST['slug']);
                $template_data = [
                  'subject' => $subject,
                  'tag' => $tag,
                  'body' => $body,
                  'slug' => $slug
                ];
                $wpdb->update('mkd_email_crud' , $template_data, array('id'=> $id));

                if($wpdb->last_error === '') {
                  $results->subject = $subject;
                  $results->tag = $tag;
                  $results->body = $body;
                  $results->slug = $slug;
                  $message .= "Email Template Edited. <a href='/wp-admin/admin.php?page=mkd_email_template_list_dashboard'>Click Here to go back to list</a>";
			          }
          }
          ?>


      <div class='wrap'>
                <?php if (strlen($message) > 0) : ?>
            <div class="updated">
                <p><?php echo $message; ?></p>
            </div>
        <?php endif; ?>
               <h1 id="add-new-font">Edit Email Template</h1>
      <form method='POST' >
        <table class='form-table' role='presentation'>
          <tbody><tr class='form-field'>
            <th scope='row'>
                <label for='Subject'>
                    Subject
                </label>
            </th>
            <td>
                <input name='subject' id='subject' type="text" required='true' value="<?php echo $results->subject ?>"/>
            </td>
          </tr>
          <tr class='form-field'>
            <th scope='row'>
                <label for='Tag'>
                    Tag
                </label>
            </th>
            <td>
                <input name='tag' id='tag' type="text" required='true' value="<?php echo $results->tag ?>"/>
            </td>
          </tr>
          <tr class='form-field'>
            <th scope='row'>
                <label for='Message Body'>
                    Message Body
                </label>
            </th>
            <td>
                <textarea rows="10" name='body' id='body' type="text" required='true'> <?php echo $results->body ?></textarea>
            </td>
          </tr>
          <tr class='form-field'>
            <th scope='row'>
                <label for='Slug'>
                    Slug
                </label>
            </th>
            <td>
                <input name='slug' id='slug' type="text" required='true' value="<?php echo $results->slug ?>"/>
            </td>
        </tr>

    </tbody>
  </table>

        <?php
          submit_button('edit', 'primary', 'edit');
        ?>
    </form>
  </div>
