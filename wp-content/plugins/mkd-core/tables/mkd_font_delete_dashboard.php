<?php
          $id = esc_sql($_GET['id']);
          global $wpdb;
          $wpdb->query( "DELETE FROM mkd_font where id = ".$id);

          if($wpdb->last_error === ''){
            ?>

            <script type="text/javascript">  
                window.location.href = '<?php echo home_url() ."/wp-admin/admin.php?page=mkd_font_list_dashboard"; ?>'; 
            </script>

            <?php
  				// wp_redirect(home_url() ."/wp-admin/admin.php?page=mkd_font_list_dashboard");
			}

?>