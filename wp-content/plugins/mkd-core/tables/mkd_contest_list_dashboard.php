<div class='wrap'>
    <h1 class='wp-heading-inline'>Contest</h1>
    <a href='/wp-admin/admin.php?page=mkd_contest_add_dashboard' class='page-title-action'>Add New</a>
    <hr class='wp-header-end'>
</div>

<?php
require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
class mkd_contest_list_dashboard extends WP_List_Table
{
    public function prepare_items()
    {
        global $wpdb;
        $per_page = 25;
        $current_page = $this->get_pagenum() - 1;
        $results = $wpdb->get_results("SELECT  mkd_categories.name ,   mkd_contest.* FROM mkd_contest
        left join mkd_categories on mkd_contest.category_id = mkd_categories.id limit " . ($current_page  * $per_page) . ", " . $per_page);





        $totalItems = $wpdb->get_results("SELECT count(*) as total FROM mkd_contest")[0]->total;
        $this->set_pagination_args(array(
            'total_items' => $totalItems,
            'per_page'    => $per_page
        ));
        
        $this->items = $results;
        $columns     = $this->get_columns();
        $hidden      = $this->get_hidden_columns();
        $shortable   = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $shortable);
    }

    public function get_columns()
    {

        $columns = array(
            'cb'    => "<input type='checkbox' />",
            'id'    => 'ID', 
            'title' => 'Title',
            'description'   => 'Description',
            'category'      => 'Category',
            'start_date'    => 'Start date',
            'end_date'      => 'End date',
            'no_of_particpants' => 'Total Participants',
            'no_of_left'        => 'Participants Left',
            'winner_1' => 'Winner 1',
            'winner_2' => 'Winner 2',
            'winner_3' => 'Winner 3',
            'winner_4' => 'Winner 4',
            'winner_5' => 'Winner 5',
            'draw_winner' => 'Draw winner',
            'prize_draw'  => 'Draw Prize',

            
            'total_prize_pool'  => 'Total Prize Pool',
            'url'               => 'URL',
            'video_url'         => 'Video URL'
        );
        return $columns;
    }
    public function column_default($item, $column_name)
    {
        switch ($column_name) {
            case 'id':
                return $item->id;
                // case 'winner':
                //     return $item->user_nicename;
            case 'title':
                return $item->title; 
            case 'description':
                return $item->description;
            case 'category':
                return $item->name;
            case 'start_date':
                return $item->start_date;
            case 'end_date':
                return $item->end_date;
            case 'no_of_particpants':
                return $item->no_of_particpants;
            case 'no_of_left':
                return $item->no_of_left;
             
            case 'winner_1':
                return $this->get_user_name($item->winner_1);
            case 'winner_2':
                return $this->get_user_name($item->winner_2);
            case 'winner_3':
                return $this->get_user_name($item->winner_3);
            case 'winner_4':
                return $this->get_user_name($item->winner_4);
            case 'winner_5':
                return $this->get_user_name($item->winner_5);

            case 'draw_winner':
                return $this->get_user_name($item->draw_winner);
            case 'prize_draw':
                return $item->prize_draw;


            case 'total_prize_pool':
                return $item->total_prize_pool;
            case 'url':
                return $item->url;
            case 'video_url':
                return $item->video_url;
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
            'Edit' => sprintf('<a href="?page=%s&action=%s&id=%s">Edit</a>', "mkd_contest_edit_dashboard", 'edit', $item->id),
            'Delete' => sprintf('<a href="?page=%s&action=%s&id=%s">Delete</a>', "mkd_contest_delete_dashboard", 'delete', $item->id),
        );
        return sprintf('%1$s %2$s', $item->id, $this->row_actions($actions));
    }



    public function get_user_name($id)
    {   
        $user_name = "";
        if (!empty($id)) 
        {
            global $wpdb; 
            $user_data = $wpdb->get_results("SELECT  wp_users.user_nicename  FROM mkd_portfolio INNER JOIN wp_users on mkd_portfolio.user_id = wp_users.id WHERE mkd_portfolio.id = '".$id."' ");

            if (isset($user_data[0])) 
            {
                $user_name =  ucfirst($user_data[0]->user_nicename); 
            }
            
        }
        return $user_name; 
    }
}

function showTable()
{
    $example_lt = new mkd_contest_list_dashboard();
    $example_lt->prepare_items();
    $example_lt->display();
}
showTable(); ?>