<div class='wrap'>
    <h1 class='wp-heading-inline'>Portfolio</h1>
    <a href='/wp-admin/admin.php?page=mkd_portfolio_add_dashboard' class='page-title-action'>Add New</a>
    <hr class='wp-header-end'>
</div>

<?php
require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
class mkd_portfolio_list_dashboard extends WP_List_Table
{
    public function prepare_items()
    {
        global $wpdb;
        $per_page = 25;
        $current_page = $this->get_pagenum() - 1;
        $results = $wpdb->get_results("SELECT wp_users.user_nicename , mkd_portfolio.* FROM mkd_portfolio inner join wp_users
        on mkd_portfolio.user_id = wp_users.ID
        limit " . ($current_page  * $per_page) . ", " . $per_page);
        $totalItems = $wpdb->get_results("SELECT count(*) as total FROM mkd_portfolio")[0]->total;
        $this->set_pagination_args(array(
            'total_items' => $totalItems,
            'per_page'    => $per_page
        ));

        $this->items = $results;
        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $shortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $shortable);
    }
 
    public function get_columns()
    {

        $columns = array(
            'cb' => "<input type='checkbox' />",
            'id' => 'ID',
            'user' => 'User',
            'title' => 'Title',
            'content' => 'Content', 
            'visibility' => 'Visibility'



        );
        return $columns;
    }
  

    public function column_default($item, $column_name)
    {
        switch ($column_name) {
            case 'id':
                return $item->id;
            case 'user':
               
              return $item->user_nicename;
            case 'title':
                return $item->title;
            case 'content':
                return $item->content;
            case 'submitted_to_contest':
                return $item->submitted_to_contest;
            case 'visibility':
                return $item->visibility;
            default:
                return 'no value';
        }
    }

    public function column_cb($item)
    {

        return sprintf(
            "<input type='checkbox' name='id[]' value='%s' />",
            $item->id
        );
    }

    public function get_bulk_actions()
    {
        $action = array(
            'delete' => 'Delete',

        );
        return $action;
    }

    public function get_hidden_columns()
    {
        return array();
    }


    public function column_id($item)
    {
        $actions = array(
            'Edit' => sprintf('<a href="?page=%s&action=%s&id=%s">Edit</a>', "mkd_portfolio_edit_dashboard", 'edit', $item->id),
            'Delete' => sprintf('<a href="?page=%s&action=%s&id=%s">Delete</a>', "mkd_portfolio_delete_dashboard", 'delete', $item->id),
        );
        return sprintf('%1$s %2$s', $item->id, $this->row_actions($actions));
    }
}

function showTable()
{
    $example_lt = new mkd_portfolio_list_dashboard();
    $example_lt->prepare_items();
    $example_lt->display();
}
showTable(); ?>