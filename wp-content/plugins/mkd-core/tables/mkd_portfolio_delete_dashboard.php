<?php
$id = esc_sql($_GET['id']);
global $wpdb;

$sql = "DELETE FROM mkd_portfolio where id = '" . $id . "' ";
$wpdb->query( $sql );
 
if($wpdb->last_error === '')
{ 
	?>

    <script type="text/javascript">  
        window.location.href = '<?php echo home_url() ."/wp-admin/admin.php?page=mkd_portfolio_list_dashboard"; ?>'; 
    </script>

    <?php 
}

?>
 
  