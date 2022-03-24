<div class='wrap'>
<h1 class='wp-heading-inline'>Background</h1>
<a href='/wp-admin/admin.php?page=mkd_background_add_dashboard' class='page-title-action'>Add New</a>
<hr class='wp-header-end'>
</div>

          <?php
require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
class mkd_background_list_dashboard extends WP_List_Table {
public function prepare_items(){
        global $wpdb;
    $per_page = 25;
    $current_page = $this->get_pagenum() - 1;
    $results = $wpdb->get_results("SELECT * FROM mkd_background limit " . ($current_page  * $per_page) . ", " . $per_page);
    $totalItems = $wpdb->get_results("SELECT count(*) as total FROM mkd_background")[0]->total;
    $this->set_pagination_args( array(
        'total_items' => $totalItems,
        'per_page'    => $per_page
    ));

    $this->items = $results;
    $columns = $this->get_columns();
    $hidden = $this->get_hidden_columns();
    $shortable = $this->get_sortable_columns();
    $this->_column_headers = array($columns, $hidden, $shortable);
}

public function get_columns(){

        $columns = array(
		'cb' => "<input type='checkbox' />",
		'id' => 'ID',
		'name' => 'Name',
		'url' => 'URL'
	);
        return $columns;

}
public function column_default($item, $column_name){
    switch($column_name){
	case 'id':
		return $item->id;
	case 'name':
		return $item->name;
	case 'url':
		return $item->url;
	default:
            return 'no value';
      }
}

public function column_cb($item){

        return sprintf(
          "<input type='checkbox' name='id[]' value='%s' />", $item->id
        );
}

public function get_bulk_actions(){
     $action = array(
		'delete' => 'Delete',

	);
        return $action;
}

public function get_hidden_columns(){
    	return array();
}


public function column_id($item){
    	$actions = array(
		'Edit' => sprintf('<a href="?page=%s&action=%s&id=%s">Edit</a>',"mkd_background_edit_dashboard",'edit',$item->id),
		'Delete' => sprintf('<a href="?page=%s&action=%s&id=%s">Delete</a>',"mkd_background_delete_dashboard",'delete',$item->id),
	);
	return sprintf('%1$s %2$s', $item->id, $this->row_actions($actions));

}
}

function showTable(){
	$example_lt = new mkd_background_list_dashboard();
	$example_lt->prepare_items();
	$example_lt->display();
}
showTable();?>
