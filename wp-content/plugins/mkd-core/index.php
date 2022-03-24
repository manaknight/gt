<?php

/**
 * @package Manaknightdigital
 * @version 1.0.0
 */
/*
Plugin Name: Manaknight Core
Plugin URI: https://manaknightdigital.com
Description: Game tournament
Author: Ryan Wong
Version: 1.0.0
Author URI: https://manaknightdigital.com
*/

/*
Buddy boss
User: Caleb4705@icloud.com
Password: 1234567890-/:;()$&@"

e3cf5de9-8cf3-4fac-9309-0443830dc276
caleb4705@icloud.com

my.interserver.net
caleb4705@icloud.com
xoKnih-jesky0-wanbyn
*/
define('ROOTDIR', plugin_dir_path(__FILE__));

//Create Tables in Database

function mkd_core_install()
{
	$sql = array(
		"
  CREATE TABLE mkd_categories (
    id INT(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    PRIMARY KEY (id));",
		"
  CREATE TABLE mkd_background (
    id INT(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `url` TEXT NOT NULL,
       PRIMARY KEY (id));",
		"
  CREATE TABLE mkd_pods (
	id INT(11) NOT NULL AUTO_INCREMENT,
	`contest_id` int NOT NULL,
	PRIMARY KEY (id));",
		"
   CREATE TABLE mkd_pod_competitors (
	`id` int NOT NULL,
	`pod_id` int NOT NULL,
	`portfolio_id` int NOT NULL,
	`votes` varchar(10) NOT NULL DEFAULT '0',
	PRIMARY KEY (id));",
		"
	CREATE TABLE `mkd_pod_competitor_votes` (
	 `id` int NOT NULL,
	 `mkd_pod_competitors_id` int NOT NULL,
	 `voter_id` int NOT NULL,
	 `pod_id` int NOT NULL,
	  PRIMARY KEY (id));",
		"	  

  CREATE TABLE mkd_font(
    id INT(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `url`  varchar(255) NOT NULL,
       PRIMARY KEY (id));",
		"

   CREATE TABLE mkd_portfolio(
		 id INT(11) NOT NULL AUTO_INCREMENT,
		 `user_id` INT(11) NOT NULL,
		 `font_id` INT(11) NOT NULL,
		 `category_id` INT(11) NOT NULL,
		 `description` varchar(255)  null ,
		 `type` varchar(255) ,
		 `image_url` varchar(255),
		 `psuedoname` varchar(255),
		 `email` varchar(255),
		 `title`  varchar(255) NOT NULL,
		 `content`  varchar(255) NOT NULL,
		 `submitted_to_contest`  varchar(255) NOT NULL,
		 `visibility`  varchar(255) NOT NULL,

			PRIMARY KEY (id));",
		"
	
	 CREATE TABLE mkd_contest(
				  id INT(11) NOT NULL AUTO_INCREMENT,
 				  `title`  varchar(255) NOT NULL,
				  `description`  varchar(255) NOT NULL,
				  `category_id` INT(11) NOT NULL,
				  `start_date`  date  NOT NULL,
				  `end_date`  date  NOT NULL,
				  `no_of_particpants`   INT(11),
				  `no_of_left`   INT(11),
				  `user_id`  INT(11) NOT NULL,
				  `total_prize_pool`  varchar(255) NOT NULL,
				  `url` TEXT NOT NULL,
 				  `winner_1`  INT(11) ,
				  `winner_2`  INT(11) ,
				  `winner_3`  INT(11) ,
				  `winner_4`  INT(11) ,
				  `winner_5`  varchar(255) ,
				  `draw_winner`  varchar(255) ,
				  `num_winners`  varchar(255) ,
				  `prize_1`  varchar(255) ,
				  `prize_2`  varchar(255) ,
				  `prize_3`  varchar(255) ,
				  `prize_4`  varchar(255) ,
				  `prize_5`  varchar(255) ,
				  `prize_draw`  varchar(255) ,
				  `video_url`  varchar(255) ,
		  PRIMARY KEY (id));",
		"

		  CREATE TABLE mkd_email_crud(
					   id INT(11) NOT NULL AUTO_INCREMENT,
						`subject`  varchar(255) NOT NULL,
					   `body`  varchar(255) NOT NULL,
					   `slug` INT(11) NOT NULL,


			   PRIMARY KEY (id));",


	);


	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	foreach ($sql as $value) {
		dbDelta($value);
	}
};

function mkd_core_uninstall()
{
	$sql = array(
		"DROP TABLE IF EXISTS mkd_categories;",
		"DROP TABLE IF EXISTS background;",
		"DROP TABLE IF EXISTS mkd_font;",
		"DROP TABLE IF EXISTS mkd_portfolio;",
		"DROP TABLE IF EXISTS mkd_contest;"
	);
}

function crud_tables_menus()
{
	add_menu_page('Email Templates', 'Email Templates', 'manage_options', 'mkd_email_template_dashboard', 'mkd_email_template_dashboard');
	add_submenu_page('mkd_email_template_dashboard', 'Add Email Template', 'Add Email Template', 'manage_options', 'mkd_email_template_add_dashboard', 'mkd_email_template_add_dashboard');
	add_submenu_page(NULL, 'Edit Email Template', 'Edit Email Template', 'manage_options', 'mkd_email_template_edit_dashboard', 'mkd_email_template_edit_dashboard');
	add_submenu_page('mkd_email_template_dashboard', 'List Email Template', 'List Email Template', 'manage_options', 'mkd_email_template_list_dashboard', 'mkd_email_template_list_dashboard');
	add_submenu_page(NULL, 'mkd_email_template_delete', 'mkd_email_template_delete', 'manage_options', 'mkd_email_template_delete_dashboard', 'mkd_email_template_delete_dashboard');
	
	add_menu_page('Game Settings', 'Game Settings', 'manage_options', 'mkd_categories_dashboard', 'mkd_categories_dashboard');
	add_submenu_page('mkd_categories_dashboard', 'Add Contest Category', 'Add Contest Category', 'manage_options', 'mkd_categories_add_dashboard', 'mkd_categories_add_dashboard');
	add_submenu_page(NULL, 'Edit Contest Category', 'Edit Contest Category', 'manage_options', 'mkd_categories_edit_dashboard', 'mkd_categories_edit_dashboard');
	add_submenu_page('mkd_categories_dashboard', 'List Contest Category', 'List Contest Category', 'manage_options', 'mkd_categories_list_dashboard', 'mkd_categories_list_dashboard');
	add_submenu_page(NULL, 'mkd_categories_delete', 'mkd_categories_delete', 'manage_options', 'mkd_categories_delete_dashboard', 'mkd_categories_delete_dashboard');

	add_submenu_page('mkd_categories_dashboard', 'Add Background Image', 'Add Background Image', 'manage_options', 'mkd_background_add_dashboard', 'mkd_background_add_dashboard');
	add_submenu_page(NULL, 'Edit Background Image', 'Edit Background Image', 'manage_options', 'mkd_background_edit_dashboard', 'mkd_background_edit_dashboard');
	add_submenu_page('mkd_categories_dashboard', 'List Background Image', 'List Background Image', 'manage_options', 'mkd_background_list_dashboard', 'mkd_background_list_dashboard');
	add_submenu_page(NULL, 'mkd_background_delete', 'mkd_background_delete', 'manage_options', 'mkd_background_delete_dashboard', 'mkd_background_delete_dashboard');

	add_submenu_page('mkd_categories_dashboard', 'Add Font', 'Add Font', 'manage_options', 'mkd_font_add_dashboard', 'mkd_font_add_dashboard');
	add_submenu_page(NULL, 'Edit Font', 'Edit Font', 'manage_options', 'mkd_font_edit_dashboard', 'mkd_font_edit_dashboard');
	add_submenu_page('mkd_categories_dashboard', 'List Font', 'List Font', 'manage_options', 'mkd_font_list_dashboard', 'mkd_font_list_dashboard');
	add_submenu_page(NULL, 'mkd_font_delete', 'mkd_font_delete', 'manage_options', 'mkd_font_delete_dashboard', 'mkd_font_delete_dashboard');

	add_submenu_page('mkd_categories_dashboard', 'Add Portfolio', 'Add Portfolio', 'manage_options', 'mkd_portfolio_add_dashboard', 'mkd_portfolio_add_dashboard');
	add_submenu_page(NULL, 'Edit Portfolio', 'Edit Portfolio', 'manage_options', 'mkd_portfolio_edit_dashboard', 'mkd_portfolio_edit_dashboard');
	add_submenu_page('mkd_categories_dashboard', 'List Portfolio', 'List Portfolio', 'manage_options', 'mkd_portfolio_list_dashboard', 'mkd_portfolio_list_dashboard');
	add_submenu_page(NULL, 'mkd_portfolio_delete', 'mkd_portfolio_delete', 'manage_options', 'mkd_portfolio_delete_dashboard', 'mkd_portfolio_delete_dashboard');


	add_submenu_page('mkd_categories_dashboard', 'Add Contest', 'Add Contest', 'manage_options', 'mkd_contest_add_dashboard', 'mkd_contest_add_dashboard');
	add_submenu_page(NULL, 'Edit Contest', 'Edit Contest', 'manage_options', 'mkd_contest_edit_dashboard', 'mkd_contest_edit_dashboard');
	add_submenu_page('mkd_categories_dashboard', 'List Contest', 'List Contest', 'manage_options', 'mkd_contest_list_dashboard', 'mkd_contest_list_dashboard');
	add_submenu_page(NULL, 'mkd_contets_delete', 'mkd_contest_delete', 'manage_options', 'mkd_contest_delete_dashboard', 'mkd_contest_delete_dashboard');
}

add_action('admin_menu', 'crud_tables_menus');
function mkd_email_template_dashboard()
{
	echo '<script> window.location.href="' . home_url() . "/wp-admin/admin.php?page=mkd_email_template_list_dashboard" .  '";</script>';
}

function mkd_email_template_add_dashboard()
{

	ob_start();
	include(plugin_dir_path(__FILE__) . '/tables/mkd_email_template_add_dashboard.php');
	$template = ob_get_contents();
	ob_end_clean();
	echo $template;
}

function mkd_email_template_edit_dashboard()
{

	ob_start();
	include(plugin_dir_path(__FILE__) . '/tables/mkd_email_template_edit_dashboard.php');
	$template = ob_get_contents();
	ob_end_clean();
	echo $template;
}

function mkd_email_template_list_dashboard()
{

	ob_start();
	include(plugin_dir_path(__FILE__) . '/tables/mkd_email_template_list_dashboard.php');
	$template = ob_get_contents();
	ob_end_clean();
	echo $template;
}

function mkd_email_template_delete_dashboard()
{

	ob_start();
	include(plugin_dir_path(__FILE__) . '/tables/mkd_email_template_delete_dashboard.php');
	$template = ob_get_contents();
	ob_end_clean();
	echo $template;
}
function mkd_categories_dashboard()
{
	echo '<script> window.location.href="' . home_url() . "/wp-admin/admin.php?page=mkd_categories_list_dashboard" .  '";</script>';
}

function mkd_categories_add_dashboard()
{

	ob_start();
	include(plugin_dir_path(__FILE__) . '/tables/mkd_categories_add_dashboard.php');
	$template = ob_get_contents();
	ob_end_clean();
	echo $template;
}

function mkd_categories_edit_dashboard()
{

	ob_start();
	include(plugin_dir_path(__FILE__) . '/tables/mkd_categories_edit_dashboard.php');
	$template = ob_get_contents();
	ob_end_clean();
	echo $template;
}

function mkd_categories_list_dashboard()
{

	ob_start();
	include(plugin_dir_path(__FILE__) . '/tables/mkd_categories_list_dashboard.php');
	$template = ob_get_contents();
	ob_end_clean();
	echo $template;
}

function mkd_categories_delete_dashboard()
{

	ob_start();
	include(plugin_dir_path(__FILE__) . '/tables/mkd_categories_delete_dashboard.php');
	$template = ob_get_contents();
	ob_end_clean();
	echo $template;
}

function mkd_font_add_dashboard()
{

	ob_start();
	include(plugin_dir_path(__FILE__) . '/tables/mkd_font_add_dashboard.php');
	$template = ob_get_contents();
	ob_end_clean();
	echo $template;
}

function mkd_font_edit_dashboard()
{

	ob_start();
	include(plugin_dir_path(__FILE__) . '/tables/mkd_font_edit_dashboard.php');
	$template = ob_get_contents();
	ob_end_clean();
	echo $template;
}

function mkd_font_list_dashboard()
{

	ob_start();
	include(plugin_dir_path(__FILE__) . '/tables/mkd_font_list_dashboard.php');
	$template = ob_get_contents();
	ob_end_clean();
	echo $template;
}

function mkd_font_delete_dashboard()
{

	ob_start();
	include(plugin_dir_path(__FILE__) . '/tables/mkd_font_delete_dashboard.php');
	$template = ob_get_contents();
	ob_end_clean();
	echo $template;
}

function mkd_background_add_dashboard()
{

	ob_start();
	include(plugin_dir_path(__FILE__) . '/tables/mkd_background_add_dashboard.php');
	$template = ob_get_contents();
	ob_end_clean();
	echo $template;
}

function mkd_background_edit_dashboard()
{

	ob_start();
	include(plugin_dir_path(__FILE__) . '/tables/mkd_background_edit_dashboard.php');
	$template = ob_get_contents();
	ob_end_clean();
	echo $template;
}

function mkd_background_list_dashboard()
{

	ob_start();
	include(plugin_dir_path(__FILE__) . '/tables/mkd_background_list_dashboard.php');
	$template = ob_get_contents();
	ob_end_clean();
	echo $template;
}

function mkd_background_delete_dashboard()
{

	ob_start();
	include(plugin_dir_path(__FILE__) . '/tables/mkd_background_delete_dashboard.php');
	$template = ob_get_contents();
	ob_end_clean();
	echo $template;
}


// Portfolio
function mkd_portfolio_add_dashboard()
{


	ob_start();
	include(plugin_dir_path(__FILE__) . '/tables/mkd_portfolio_add_dashboard.php');
	$template = ob_get_contents();
	ob_end_clean();
	echo $template;
}

function mkd_portfolio_edit_dashboard()
{

	ob_start();
	include(plugin_dir_path(__FILE__) . '/tables/mkd_portfolio_edit_dashboard.php');
	$template = ob_get_contents();
	ob_end_clean();
	echo $template;
}

function mkd_portfolio_list_dashboard()
{

	ob_start();
	include(plugin_dir_path(__FILE__) . '/tables/mkd_portfolio_list_dashboard.php');
	$template = ob_get_contents();
	ob_end_clean();
	echo $template;
}

function mkd_portfolio_delete_dashboard()
{

	ob_start();
	include(plugin_dir_path(__FILE__) . '/tables/mkd_portfolio_delete_dashboard.php');
	$template = ob_get_contents();
	ob_end_clean();
	
	echo $template;
}

//contest

function mkd_contest_add_dashboard()
{

	ob_start();
	include(plugin_dir_path(__FILE__) . '/tables/mkd_contest_add_dashboard.php');
	$template = ob_get_contents();
	ob_end_clean();
	echo $template;
}

function mkd_contest_edit_dashboard()
{

	ob_start();
	include(plugin_dir_path(__FILE__) . '/tables/mkd_contest_edit_dashboard.php');
	$template = ob_get_contents();
	ob_end_clean();
	echo $template;
}

function mkd_contest_list_dashboard()
{

	ob_start();
	include(plugin_dir_path(__FILE__) . '/tables/mkd_contest_list_dashboard.php');
	$template = ob_get_contents();
	ob_end_clean();
	echo $template;
}

function mkd_contest_delete_dashboard()
{

	ob_start();
	include(plugin_dir_path(__FILE__) . '/tables/mkd_contest_delete_dashboard.php');
	$template = ob_get_contents();
	ob_end_clean();
	echo $template;
}




function get_portfolio_ajax()
{

	//TODO, ask for page # and load ajax
	$user_id = get_current_user_id();
	if (!empty(isset($_POST['cat_id']))) {
		$cat_id = (int) $_POST['cat_id'];

		global $wpdb;

		$results = $wpdb->get_results("SELECT   mkd_portfolio.* FROM mkd_portfolio
	 where mkd_portfolio.user_id = '$user_id'
	 AND mkd_portfolio.category_id = '$cat_id'");

		echo json_encode([
			'data' => $results
		]);
		exit();
	}
}

function get_font_url_ajax()
{

	//TODO, ask for page # and load ajax
	$user_id = get_current_user_id();
	if (!empty(isset($_POST['font_id']))) {
		$font_id = (int) $_POST['font_id'];

		global $wpdb;

		$results = $wpdb->get_results("SELECT  * FROM   mkd_font

	 where mkd_font.id= '$font_id'");

		echo json_encode([
			'data' => $results
		]);
		exit();
	}
}


function get_portfolio_All_ajax()
{

	//TODO, ask for page # and load ajax
	global $wpdb;
	
	$user_id = get_current_user_id();
	$where_visibility = '';
	$where_category = '';
	$user_login = $_POST['user_name'];
	$user = $wpdb->get_results("SELECT  * FROM   wp_users where user_login= '$user_login'");
	if(count($user) < 1)
	{
		echo json_encode([
			'data' => []
		]);
		exit();
	}
	if(!$user_id || $user_id != $user[0]->ID)
	{
		$where_visibility = " AND visibility = 'public'";
	}
	if (!empty(isset($_POST['cat_id'])) && $_POST['cat_id'] != '0' && $_POST['cat_id'] != '') {
		$cat_id = (int) $_POST['cat_id'];
		$where_category = " AND category_id = $cat_id";
	}
	$user_id = $user[0]->ID;
	$results = $wpdb->get_results("SELECT   mkd_portfolio.* FROM mkd_portfolio
	 where mkd_portfolio.user_id = '$user_id' $where_visibility $where_category");

	echo json_encode([
		'data' => $results
	]);
	exit();
}

function get_portfolios_in_contest_category()
{

	//TODO, ask for page # and load ajax
	global $wpdb;
	
	$user_id = get_current_user_id();
	$where_visibility = '';
	$where_category = '';
	$user_login = $_POST['user_name'];
	$contest_id = $_POST['contest_id'];
	$user = $wpdb->get_results("SELECT  * FROM   wp_users where user_login= '$user_login'");
	$contest = $wpdb->get_results("SELECT  * FROM   mkd_contest where id= '$contest_id'");
	if(count($user) < 1 && count($contest) < 1)
	{
		echo json_encode([
			'data' => []
		]);
		exit();
	}
	if(!$user_id || $user_id != $user[0]->ID)
	{
		$where_visibility = " AND visibility = 'public'";
	}

	$user_id = $user[0]->ID;
	$cat_id = $contest[0]->category_id;
	$results = $wpdb->get_results("SELECT   mkd_portfolio.* FROM mkd_portfolio
	 where mkd_portfolio.user_id = '$user_id' AND category_id = $cat_id");
	echo json_encode([
		'data' => $results
	]);
	exit();
}

function get_portfolio_by_id_ajax()
{
	if (!empty(isset($_POST['id']))) {

		//$user_id = get_current_user_id();
		$id = (int) $_POST['id'];


		global $wpdb;

		$results = $wpdb->get_results("SELECT   mkd_portfolio.* FROM mkd_portfolio
	 where mkd_portfolio.id = $id");

		echo json_encode([
			'data' => $results
		]);
		exit();
	}
}

// Save Portfolio
function save_portfolio_ajax()
{
	global $wpdb;
	$user_id = get_current_user_id();
	$title = (string) $_POST['title'];
	$content =  $_POST['content'];
	$type = (string) $_POST['type'];
	$font_id = (int) $_POST['font_id'];
	$visibility = (string) $_POST['visibility'];
	$psuedoname = (string)   $_POST['psuedoname'];
	$cat_id = (string)   $_POST['cat_id'];
	$contest_id = !empty(isset($_POST['contest_id'])) ? (int) $_POST['contest_id'] : '';

	$_POST['user_id']  = $user_id;
	$image = (string) $_POST['image'];
	$color = (string) $_POST['color'];
	if (strlen($color != null)) {


		$type = 'color';
	} else if (strlen($image != null)) {
		$type = 'image';
		$color =  $image;
	} else {
		$type = '';
	}
	$data = array(
		'title' => $title,
		'content' => $content,
		'type' => $type,
		'image_url' => $color,
		'user_id' => $user_id,
		'font_id' => $font_id,
		'category_id' => $cat_id,
		'psuedoname' => $psuedoname,
		'visibility' => $visibility

	);
	$result = $wpdb->insert('mkd_portfolio', $data);
	if(!$result)
	{
		echo json_encode([
			'data' => 0
		]);
		exit();
	}
	echo json_encode([
		'data' => $result
	]);
	exit();
}
// Save Portfolio
function save_portfolio_ticket_ajax()
{
	global $wpdb;
	$user_id = get_current_user_id();
	$title = (string) $_POST['title'];
	$content = $_POST['content'];
	$type = (string) $_POST['type'];
	$font_id = (int) $_POST['font_id'];
	$visibility = (string) $_POST['visibility'];
	$psuedoname = (string)   $_POST['psuedoname'];
	$contest_id = !empty(isset($_POST['contest_id'])) ? (int) $_POST['contest_id'] : '';

	$contest_detail = $wpdb->get_results("SELECT   * FROM mkd_contest
	 where id = $contest_id");
	if(count($contest_detail) < 1)
	{
		echo json_encode([
			'data' => 0
		]);
		exit();
	}
	$contest_category = $contest_detail[0]->category_id;
	$_POST['user_id']  = $user_id;
	$image = (string) $_POST['image'];
	$color = (string) $_POST['color'];
	if (strlen($color != null)) {


		$type = 'color';
	} else if (strlen($image != null)) {
		$type = 'image';
		$color =  $image;
	} else {
		$type = '';
	}
	$data = array(
		'title' => $title,
		'content' => $content,
		'type' => $type,
		'image_url' => $color,
		'user_id' => $user_id,
		'font_id' => $font_id,
		'category_id' => $contest_category,
		'psuedoname' => $psuedoname,
		'visibility' => $visibility

	);
	$result = $wpdb->insert('mkd_portfolio', $data);
	if(!$result)
	{
		echo json_encode([
			'data' => 0
		]);
		exit();
	}
	$portfolio_id = $wpdb->insert_id;
	$create_contest_portfolio = $wpdb->insert('mkd_contest_portfolio', [
		'contest_id' => $contest_id,
		'user_id' => $user_id,
		'portfolio_id' => $portfolio_id
	]);
	echo json_encode([
		'data' => $result
	]);

    $results = $wpdb->query("UPDATE mkd_contest set no_of_particpants = no_of_particpants+1 where id = " . $contest_id);
	exit();
}
//Update Portfolio
function update_portfolio_ajax()
{
	global $wpdb;
	$id = esc_sql($_POST['id']);
	$results = $id != null ? $wpdb->get_results('SELECT * FROM mkd_portfolio WHERE id = ' . $id) : null;
	$results = $results[0];
	$message = '';

	$user_id 	 = get_current_user_id();
	$title 		 = (string) $_POST['title'];
	$content 	 = $_POST['content']; 
	$content 	 = str_replace('"', "'", $content);  
	$type 		 = (string) $_POST['type'];
	$font_id 	 = (int) $_POST['font_id'];
	$category_id = (int) $_POST['cat_id'];
	$visibility  = (string) $_POST['visibility'];
	$psuedoname  = (string) $_POST['psuedoname'];
	//$email = (string)   $_POST['email'];

	$image = (string) $_POST['image'];
	$color = (string) $_POST['color'];

	if (strlen($color != null)) 
	{ 
		$type = 'color';
	} else if (strlen($image != null)) 
	{
		$type = 'image';
		$color =  $image;
	} else 
	{
		$type   = '';
	}

	// $sql = " UPDATE `mkd_portfolio` SET `content`='" . $content . "' WHERE `id` =  '" . $id . "' ";
	// $results = $wpdb->query($sql);

	$results = $wpdb->update('mkd_portfolio', [
		'user_id'     => $user_id,
		'title'       => $title,
		'content'     => $content,
		'category_id' => $category_id,
		'psuedoname'  => $psuedoname, 
		'font_id'     => $font_id,
		'category_id' => $category_id,
		'visibility'  => $visibility,
		'image_url'   => $color,
		'type'        => $type,
	], array('id' => $id));

	if ($wpdb->last_error === '') 
	{
		$results->user_id 	  = $title;
		$results->title 	  = $title;
		$results->content     = $content;
		$results->category_id = $category_id;
		$results->psuedoname  = $psuedoname;
		//$results->email = $email;
		$results->font_id 	  = $font_id;
		$results->category_id = $category_id;
		$results->visibility  = $visibility;
		$results->image_url   = $color;
		$results->type        = $type;


		$message .= "Contest Edited. <a href='/wp-content/plugins/mkd-core/portfolio_short_code.php'>Click Here to go back </a>";
	} 
	echo json_encode([
		'data' => $results
	]);
	exit();
}

//Update Portfolio
function update_contest_to_portfolio()
{
	global $wpdb;
	$id = $_POST['portfolio_id'];
	$portfolio = $id != null ? $wpdb->get_results('SELECT * FROM mkd_portfolio WHERE id = ' . $id) : null;
	if(count($portfolio) < 1)
	{
		echo json_encode([
			'data' => 0
		]);
		exit();
	}
	$portfolio = $portfolio[0];
	$message = '';

	$user_id = get_current_user_id();
	$contest_id = (int) $_POST['contest_id'];


	$results = $wpdb->insert('mkd_contest_portfolio', [
				'contest_id' => $contest_id,
				'user_id' => $portfolio->user_id,
				'portfolio_id' => $id
			]);

    $results = $wpdb->query("UPDATE mkd_contest set no_of_particpants = no_of_particpants+1 where id = " . $contest_id);

	echo json_encode([
		'data' => 1
	]);
	exit();
}





function delete_portfolio_ajax()
{
	if (!empty(isset($_POST['id']))) {

		$user_id = get_current_user_id();
		$id = (int) $_POST['id'];

		global $wpdb;

		$results =   $wpdb->query("DELETE FROM mkd_portfolio where id = " . $id);


		echo json_encode([
			'data' => $results
		]);
		exit();
	}
}

function get_calc_remaining_time($end_date){
	$response='';

	$start_date = date("Y-m-d h:i:s");
	$end_date   = date("Y-m-d h:i:s", strtotime($end_date));

	$start  = date_create($start_date);
	$end    = date_create($end_date);
	$diff   = date_diff( $start, $end );

	$response .= (($diff->d) > 0)?$diff->d.' Days ':'';
	$response .= (($diff->h) > 0)?$diff->h.' Hours ':'';
	$response .= (($diff->i) > 0)?$diff->i.' Minutes ':'';

	if($start_date > $end_date)
	{
		return [
			'deadline' 	=> 'Registration closed',
			'running_time' => $response
		];
	}
	else {
		return [
			'deadline'     => $response,
			'running_time' => ''
		];
	}
}


function get_calc_remaining_time_v2($end_date){
	$response='';

	$start_date = date("Y-m-d h:i:s");
	$end_date   = date("Y-m-d h:i:s", strtotime($end_date));

	$start  = date_create($start_date);
	$end    = date_create($end_date);
	$diff   = date_diff( $start, $end );

	$response .= (($diff->d) > 0)?$diff->d.' Days ':'';
	$response .= (($diff->h) > 0)?$diff->h.' Hours ':'';
	$response .= (($diff->i) > 0)?$diff->i.' Minutes ':'';

	if($start_date > $end_date)
	{
		return [
			'deadline' 	=> 'Registration closed',
			'running_time' => $response
		];
	}
	else {
		return [
			'deadline'     => $end_date,
			'running_time' => ''
		];
	}
}

// Function Get All Contest/Tournament by id
function get_contests()
{
	//$user_id  		= get_current_user_id();
	$cat_id 		= (int) $_POST['cat_id'];
	$contest_type 	= $_POST['contest_type']; 
	$user_id		= (int) $_POST['user_id']; 

	$where_user = " AND user_id != $user_id";
	

	$where_cat = "";
	if($cat_id != '')
	{
		$where_cat = " AND category_id = $cat_id";
	}


	global $wpdb;
	$today = date("Y-m-d");
	if($contest_type == 'my')
	{
		if($cat_id != '')
		{
			$where_cat = " AND c.category_id = $cat_id";
		}
		$results = $wpdb->get_results("SELECT  DISTINCT(c.id),c.*, cat.name as cat_name FROM mkd_contest_portfolio as p INNER JOIN mkd_contest as c ON p.contest_id=c.id LEFT JOIN mkd_categories as cat ON c.category_id=cat.id Where p.user_id = '$user_id' and start_date <= '$today' and  (c.status = '0' OR c.status = 1) $where_cat ORDER BY end_date ASC");
	}
	else
	{ 

		$sql = "SELECT  c.*, cat.name as cat_name FROM mkd_contest as c LEFT JOIN mkd_categories as cat ON c.category_id=cat.id Where start_date <= '$today' and (status = '0' OR status='1') $where_cat ORDER BY end_date ASC"; 
		$results = $wpdb->get_results($sql);
	}

	foreach($results as $_key => &$_value)
	{
		$time_line = get_calc_remaining_time_v2($_value->end_date);
		$_value    = (array) $_value;
		

		$_value['remaining_time'] = $time_line['deadline'];
		$_value['running_time']   = $time_line['running_time'];

		$contest_id = $_value['id'];

		$sql = "SELECT * FROM mkd_contest_portfolio WHERE user_id = $user_id and contest_id = $contest_id";


		$portfolio  = $wpdb->get_results($sql);

		$_value['contest_start'] = strtotime($today) > strtotime($_value['end_date']) ? true : false;
		if($contest_type == 'my')
		{

//			if(count($portfolio) < 1)
//			{
//				$_value['entered_to_contest'] = false;
//				continue;
//			}
			$_value['entered_to_contest'] = true;
		}
		else
		{ 
			if(count($portfolio) < 1)
			{
				$_value['entered_to_contest'] = false;
				continue;
			}else
			{ 
				unset($results[$_key]);
			}  
		}
	}
	// for($i=0;$i<sizeof($results);$i++)
	// {
	// 	$time_line = get_calc_remaining_time($results[$i]->end_date);
	// 	$results[$i] = (array) $results[$i];
		

	// 	$results[$i]['remaining_time'] = $time_line['deadline'];
	// 	$results[$i]['running_time']   = $time_line['running_time'];

	// 	$contest_id = $results[$i]['id'];

	// 	$sql = "SELECT * FROM mkd_contest_portfolio WHERE user_id = $user_id and contest_id = $contest_id";


	// 	$portfolio  = $wpdb->get_results($sql);
	// 	$results[$i]['contest_start'] = strtotime($today) > strtotime($results[$i]['end_date']) ? true : false;
	// 	if($contest_type == 'my')
	// 	{
			 
	// 		if(count($portfolio) < 1)
	// 		{
	// 			$results[$i]['entered_to_contest'] = false;
	// 			continue;
	// 		}
	// 		$results[$i]['entered_to_contest'] = true;
	// 	}
	// 	else
	// 	{ 
	// 		if(count($portfolio) < 1)
	// 		{
	// 			$results[$i]['entered_to_contest'] = false;
	// 			continue;
	// 		}else
	// 		{ 
	// 			unset($results[$i]);
	// 		}  
	// 	}
	// 	// echo "<pre>";
	// 	// print_r($results);
	// 	// die();
	// }

	if($contest_type == 'all')
	{
		if(!empty($results))
		{
			$results = array_values($results);
		}
	}

	// echo "<pre>";
	// print_r($results);
	// die();
	echo json_encode([
		'data' 	=> $results,
		'status'	=> 200
	]);
	exit();
}



function send_email($slug, $payload, $email){
	global $wpdb;
	global $phpmailer;

	// (Re)create it, if it's gone missing
	if ( ! ( $phpmailer instanceof PHPMailer ) ) {
		require_once ABSPATH . WPINC . '/class-phpmailer.php';
		require_once ABSPATH . WPINC . '/class-smtp.php';
	}
	$phpmailer = new PHPMailer;

    $phpmailer->IsSMTP();
    $phpmailer->Host = 'smtp.sendgrid.net';
    $phpmailer->Port = '587';
    $phpmailer->SMTPSecure = 'tls';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Username = 'apikey';
    $phpmailer->Password = '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'; // password if gmail : manage account->security->allow less secure apps

    $phpmailer->addAddress($email);
    $phpmailer->setFrom('synysterdevil@gmail.com', 'Game Tournament');
    //$phpmailer->addReplyTo('info@example.com', 'Information');
    $phpmailer->isHTML(true);

	$template =   $wpdb->get_results("SELECT * FROM mkd_email_crud where slug = '$slug'")[0];
    $phpmailer->Subject = inject_substitute($template->subject,$template->tag,$payload);
    $phpmailer->Body    = inject_substitute($template->body,$template->tag,$payload);
    if(!$phpmailer->send()){
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $phpmailer->ErrorInfo;
	}else{
//		echo 'Message has been sent';
	}
}

function inject_substitute($raw, $tags, $data) 
{
	$tags = explode(',', $tags);
	foreach ($data as $key => $value) 
	{
		if (in_array($key, $tags))
		{
			$raw = str_replace('{{{' . $key . '}}}', $value, $raw);
		}
	}
	return $raw;
}
// Function Add contest/Tournament
function save_contest_ajax(){
	global $wpdb;
	
	$user_id		  = (int) $_POST['user_id'];

	$title 			  = $_POST['title'];
	$description  	  = $_POST['description'];
	$category_id 	  = (int) $_POST['category_id'];
	$start_date 	  = $_POST['start_date'];
	$end_date 		  = $_POST['end_date'];
	$total_prize_pool = $_POST['total_prize_pool'];
	$url  			  = $_POST['url'];
	$prize_draw 	  = $_POST['prize_draw'];
	$video_url 		  = $_POST['video_url'];
	$message		  = '';

	$validations	  =[];
	if(empty($user_id)){
		$validations[]	= 'user_id field is required';
	}
	if(empty($title)){
		$validations[]	= 'title field is required';
	}
	if(empty($description)){
		$validations[]	='description field is required';
	}
	if(empty($category_id)){
		$validations[]	='category_id field is required';
	}
	if(empty($start_date)){
		$validations[]	='start_date field is required';
	}
	if(empty($end_date)){
		$validations[]	='end_date field is required';
	}
	if(empty($total_prize_pool)){
		$validations[]	='total_prize_pool field is required';
	}
	if(empty($url)){
		$validations[]	='url field is required';
	}
	
    if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $start_date) && !empty($start_date)) {
		$validations[]	='start_date should be in formate YYYY-mm-dd';
	}
	if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $end_date) && !empty($end_date)) {
		$validations[]	='end_date should be in formate YYYY-mm-dd';
	}

	if(!empty($validations)){
		echo json_encode([
			'data'   => $validations,
			'status' => 400
		]);
		exit();
	}

	$result = $wpdb->insert('mkd_contest', array(
		'title' 			=> $title,
		'description' 		=> $description,
		'category_id' 		=> $category_id,
		'start_date' 		=> $start_date,
		'end_date' 			=> $end_date,
		'total_prize_pool'	=> $total_prize_pool,
		'url'				=> $url,
		'prize_draw'		=> $prize_draw,
		'video_url'			=> $video_url,
		'user_id'			=> $user_id,
        'no_of_particpants' => 0
	));

	echo json_encode([
		'data' 	=> $result,
		'status'=> 200
	]);
	exit();
	
}
// Function set 1st,2nd,3rd,4th and 5th winners
function set_winners($contest_id){
	global $wpdb;
	$pod = $wpdb->get_results("SELECT * FROM mkd_pods WHERE	contest_id = $contest_id ");
	if(!empty($pod)){
		$pod_id = $pod[0]->id;
		$winners = $wpdb->get_results("SELECT * FROM mkd_pod_competitors WHERE pod_id = $pod_id ORDER BY votes DESC");
		if(!empty($winners)){
			$wpdb->update('mkd_contest', [
				'winner_1' 		=> $winners[0],
				'winner_2' 		=> $winners[1],
				'winner_3' 		=> $winners[2],
				'winner_4' 		=> $winners[3],
				'winner_5' 		=> $winners[4],
			], array('id' => $contest_id));
		}
	}
	return true;
}
// Create Pods
// function create_pods_ajax(){
// 	global $wpdb;
// 	$today = date("Y-m-d");

// 	/**
// 	 * loop through all the pods
// 	 * find the candidate with minium voting
// 	 * and avoid that candidate to be appeared in the next pods
// 	 */
// 	 $pods_loosers = [];
// 	 $existing_pods = $wpdb->get_results("SELECT  * FROM mkd_pods");
// 	 foreach($existing_pods as $pod){
// 		 $pods_looser = $wpdb->get_results("SELECT * FROM mkd_pod_competitors WHERE pod_id = $pod->id ORDER BY votes ASC");
// 		 if(!empty($pods_looser[0]->portfolio_id)){
// 			 $id=$pods_looser[0]->portfolio_id;

// 			 $wpdb->update('mkd_portfolio', [
// 				'looser_status' => 1
// 			], array('id' => $id));
// 		 }
// 	 }
// 	 /**
// 	  * create new pods
// 	  */
// 	$wpdb->query('TRUNCATE TABLE mkd_pods');
// 	$wpdb->query('TRUNCATE TABLE mkd_pod_competitors');
// 	$wpdb->query('TRUNCATE TABLE mkd_pod_competitor_votes');

// 	$categories = $wpdb->get_results("SELECT  * FROM mkd_categories");
// 	foreach($categories as $category){
// 		$contests = $wpdb->get_results("SELECT  * FROM mkd_contest Where end_date >= $today and category_id = $category->id and (winner_1 = '' OR winner_1 = null)");
// 		foreach($contests as $contest){
// 			$portfolios = $wpdb->get_results("SELECT  * FROM mkd_portfolio Where submitted_to_contest = $contest->id and looser_status = 0");
// 			if(!empty($portfolios)){
// 				if(sizeof($portfolios) <= 11){
// 					if(sizeof($portfolios) < 6){
// 						set_winners($contest);
// 					}
// 					else{
// 						$result = $wpdb->insert('mkd_pods', array(
// 							'contest_id' => $contest->id
// 						));
// 						$pod_id = $wpdb->insert_id;
// 						foreach($portfolios as $portfolio){
// 							$wpdb->insert('mkd_pod_competitors', array(
// 								'pod_id' 		=> $pod_id,
// 								'portfolio_id' 	=> $portfolio->id
// 							));
// 						}
// 					}
// 				}
// 				else{
// 					$pod_size=5;
// 					if(sizeof($portfolios) % 4 == 0){
// 						$pod_size=4;
// 					}
// 					$chunked_arr= array_chunk($portfolios, $pod_size);
// 					for($i=0;$i<sizeof($chunked_arr);$i++){
// 						$result = $wpdb->insert('mkd_pods', array(
// 							'contest_id' => $contest->id
// 						));
// 						$pod_id = $wpdb->insert_id;
// 						foreach($chunked_arr[$i] as $chunked_arr_current){
// 							/**
// 							 * send email notification to each candidate
// 							 */
// 							if(!empty($chunked_arr_current->email) && filter_var($chunked_arr_current->email, FILTER_VALIDATE_EMAIL)){
// 								send_email($chunked_arr_current->email);
// 							}
							
// 							$wpdb->insert('mkd_pod_competitors', array(
// 								'pod_id' 		=> $pod_id,
// 								'portfolio_id' 	=> $chunked_arr_current->id
// 							));
// 						}
// 					}
// 				}
// 			}
// 		}
// 	}
	
// }
function run_tournament_cronjob()
{
	global $wpdb;
	$today = date("Y-m-d");

	$contests = $wpdb->get_results("SELECT  * FROM mkd_contest Where mkd_contest.status = 0 and  mkd_contest.end_date >= DATE(NOW())");

    foreach ($contests as $key => $contest) {
        $checkCroneJob = $wpdb->get_results("SELECT  * FROM mkd_check_cronejob Where date = CURDATE() && contest_id = $contest->id ");
        if(empty($checkCroneJob)){
            $wpdb->insert('mkd_check_cronejob', array(
                'contest_id' => $contest->id,
                'date' => $today
            ));
            $response = create_pods_ajax($contest->id);
            return $response;
        }
	}
	exit();
}

function create_pods_ajax($contest_id=0){
	global $wpdb;
	$today = date("Y-m-d");

	/**
	 * loop through all the pods
	 * find the candidate with minium voting
	 * and avoid that candidate to be appeared in the next pods
	 */
	// $user_id = get_current_user_id();
	// if(!$user_id)
	// {
	// 	return [
	// 		'data' => 0,
	// 		'message' => 'Please login.'
	// 	];exit();
	// }
	// $contest_id = $contest_id;
	//$contest_level = 1;
	//$contest_id = $_POST['contest_id'];
	if($contest_id == 0)
	{
		return [
			'data' => 0,
			'message' => 'No contest found.'
		];
	}
	$contest_query = $wpdb->get_results("SELECT  * FROM mkd_contest where id = '$contest_id' AND status = 0");
	if(count($contest_query) == '0' && $contest_id)
	{
		return [
			'data' => 0,
			'message' => 'No pending contest found.'
		];
	}
	$contest = $contest_query[0];
	$contest_level = $contest->contest_level;
	if($contest_level == 'final')
	{
		$num_winners = $contest->num_winners ? $contest->num_winners : 3;
		$contest_competitors = $wpdb->get_results("SELECT  * FROM mkd_pod_competitors where contest_id = '$contest_id' AND contest_level = 'final' ORDER BY votes DESC");
		//echo json_encode($contest_competitors);exit();
		$max_vote = max(array_column($contest_competitors, 'votes'));
		if($max_vote == '0')
		{
			$wpdb->update('mkd_contest', [
					'status' => 2
				], array('id' => $contest_id));
		}
		$winners = [];
		$winner_user_ids = [];
		$votes = array_column($contest_competitors, 'votes');
		$unique_votes = array_unique($votes);
		$winner_loop = 0;
		foreach ($unique_votes as $u_key => $vote_check) {
			$i = $u_key+1;
			if($i > $num_winners || $i > 5)
			{
				continue;
			}
			$winner_pc['winner_'.$i] = [];
			foreach ($contest_competitors as $i_key => $contest_competitor) {
				if($contest_competitor->votes == $vote_check)
				{
					$winner_pc['winner_'.$i][] = $contest_competitor;
				}
			}
			if(count($winner_pc['winner_'.$i]) == '1')
			{
				$winners['winner_'.$i] = $winner_pc['winner_'.$i][0]->portfolio_id;
				$winner_user_ids[] = $winner_pc['winner_'.$i][0]->user_id;
				$contest_user_id = $winner_pc['winner_'.$i][0]->user_id;
				$contest_user = $wpdb->get_results("SELECT  * FROM wp_users where ID = '$contest_user_id'")[0];
				$email = $contest_user->user_email;
				$email_payload = array(
					'link' => 'https://gametournament.manaknightdigital.com/tournament-result/?contest_id='.$contest->id,
					'email' => $email,
					'position' => $i == '1' ? 'First' : $i

				);
				$response = send_email('congratulation-message', $email_payload, $email);
				continue;
			}
			$winner_loop = $i;
			foreach ($winner_pc['winner_'.$i] as $key => $winner_place) {
				if($winner_loop > 5 || $winner_loop > $num_winners || (in_array($winner_place->user_id, $$winner_user_ids)))
				{
					continue;
				}
				$winner_key = array_rand($winner_pc['winner_'.$i]);
				$winners['winner_'.$winner_loop] = $winner_pc['winner_'.$i][$winner_key]->portfolio_id;
				$winner_user_ids[] = $winner_pc['winner_'.$i][$winner_key]->user_id;
				$contest_user_id = $winner_pc['winner_'.$i][$winner_key]->user_id;
				$contest_user = $wpdb->get_results("SELECT  * FROM wp_users where ID = '$contest_user_id'")[0];
				$email = $contest_user->user_email;
				$email_payload = array(
					'link' => 'https://gametournament.manaknightdigital.com/index.php/winners/?contest_id='.$contest->id,
					'email' => $email,
					'postition' => $winner_loop == '1' ? 'First' : $winner_loop

				);
				$response = send_email('congratulation-message', $email_payload, $email);
				unset($winner_pc['winner_'.$i][$winner_key]);
				$winner_loop++;
			}
		}
		// foreach ($contest_competitors as $key => $contest_competitor) {
		// 	$freqs = array_count_values($contest_competitor->votes);
		// 	if($key < $num_winners)
		// 	{
		// 		$i = $key+1;
		// 		$winners['winner_'.$i] = $contest_competitor->portfolio_id;
		// 		$winner_user_ids[] = $contest_competitor->user_id;
		// 	}
		// }
		$winner_user_string = $$winner_user_ids ? implode(',', $winner_user_ids) : '';
		$not_in_voters = $winner_user_string == '' ? '' : " AND voter_id NOT IN ('$winner_user_string')"; 
		$random_competitors = $wpdb->get_results("SELECT  * FROM   mkd_pod_competitor_votes where contest_id='$contest_id' $not_in_voters");
		$key = array_rand($random_competitors);
		$draw_user_id = $random_competitors[$key]->voter_id;
		$draw_user_portfolio = $wpdb->get_results("SELECT  * FROM mkd_pod_competitors where contest_id = '$contest_id' AND user_id = '$draw_user_id' ORDER BY votes DESC");
		$winners['draw_winner'] = $draw_user_portfolio[0]->id;
		$contest_user_id = $draw_user_portfolio[0]->user_id;
		$contest_user = $wpdb->get_results("SELECT  * FROM wp_users where ID = '$contest_user_id'")[0];
		$email = $contest_user->user_email;
		$email_payload = array(
			'link' => 'https://gametournament.manaknightdigital.com/index.php/winners/?contest_id='.$contest->id,
			'email' => $email

		);
		$response = send_email('drawwinner-message', $email_payload, $email);
		$winners['status'] = 1;
		$wpdb->update('mkd_contest',
			$winners, array('id' => $contest_id));
		
		return [
			'success' => 1,
			'message' => 'Competition result published.'
		];
	}
	
	if($contest_level != '0')
	{
		//winner from pod selection logic
		$contest_pods = $wpdb->get_results("SELECT  * FROM mkd_pods where contest_id = $contest_id AND contest_level = $contest_level");
		foreach ($contest_pods as $key => $contest_pod) {
			$pod_competitors = $wpdb->get_results("SELECT  * FROM  mkd_pod_competitors as pc WHERE pc.contest_id = '$contest_id' AND pc.contest_level = '$contest_level' AND pc.pod_id = '$contest_pod->id'");
			$max_vote = max(array_column($pod_competitors, 'votes'));
			if($max_vote == '0')
			{
				$winner_query = '';
			}
			else
			{
				//select greatest vote
				$pod_competitors_winners = $wpdb->get_results("SELECT  pc.* FROM  mkd_pod_competitors as pc WHERE pc.contest_id = '$contest_id' AND pc.contest_level = '$contest_level' AND pc.pod_id = '$contest_pod->id' AND votes = '$max_vote'");
				//remove those who didn't vote

				$pod_voters = $wpdb->get_results("SELECT  pv.* FROM  mkd_pod_competitor_votes as pv WHERE pv.contest_id = '$contest_id' AND pv.contest_level = '$contest_level' AND pv.pod_id = '$contest_pod->id'");
				$voter_ids = array_column($pod_voters, 'voter_id');
				$final_winners = [];
				foreach ($pod_competitors_winners as $key => $check_winner_vote) {
					if(in_array($check_winner_vote->user_id, $voter_ids))
					{
						$final_winners[] = $check_winner_vote;
					}
				}
				$key = array_rand($final_winners);
				$winner_portfolio = $final_winners[$key]->portfolio_id;
				$winner_query = " AND pc.portfolio_id != '$winner_portfolio'";
			}
			$pod_competitors_delete_list = $wpdb->get_results("SELECT  * FROM  mkd_pod_competitors as pc WHERE pc.contest_id = '$contest_id' AND pc.contest_level = '$contest_level' AND pc.pod_id = '$contest_pod->id' $winner_query");
			foreach ($pod_competitors_delete_list as $key => $list) {

				$contest_user = $wpdb->get_results("SELECT  * FROM wp_users where ID = '$list->user_id'")[0];
				$email = $contest_user->user_email;
				$email_payload = array(
					'link' => 'https://gametournament.manaknightdigital.com/index.php/tournament/?contest_id='.$contest_id,
					'email' => $email,
					'round_number' => $contest_level

				);
				$response = send_email('eliminated', $email_payload, $email);
				$wpdb->get_results("UPDATE mkd_contest_portfolio SET status = 0 where portfolio_id = '$list->portfolio_id' AND contest_id = '$contest_id'");
					continue;
			}
		}
	}
	$contest_portfolios = $wpdb->get_results("SELECT  * FROM mkd_contest_portfolio where contest_id = $contest_id AND status = 1");
	if(count($contest_portfolios) < 12 && $contest->contest_level == '0')
	{
		$wpdb->update('mkd_contest', [
				'status' => 2
			], array('id' => $contest_id));
		return [
			'data' => 0,
			'message' => 'Number of users participating is not sufficient.'
		];
	}
	else if(count($contest_portfolios) < 12)
	{
		$wpdb->insert('mkd_pods', array(
			'contest_id' => $contest->id,
			'contest_level' => 'final'
		));
		$pod_id = $wpdb->insert_id;
		$contest_user_ids = '';
		foreach ($contest_portfolios as $key => $contest_portfolio) {
			$contest_user = $wpdb->get_results("SELECT  * FROM wp_users where ID = '$contest_portfolio->user_id'")[0];
			$email = $contest_user->user_email;
			$contest_user_ids .= $contest_user->ID.',';
			$email_payload = array(
				'link' => 'https://gametournament.manaknightdigital.com/index.php/tournament/?contest_id='.$contest->id,
				'email' => $email,
				'round_number' => 'final'

			);
			$response = send_email('next-round', $email_payload, $email);
			$wpdb->insert('mkd_pod_competitors', array(
				'pod_id' 		=> $pod_id,
				'contest_id' => $contest->id,
				'user_id'		=> $contest_portfolio->user_id,
				'portfolio_id' 	=> $contest_portfolio->portfolio_id,
				'contest_level' => 'final'
			));
		}
		$contest_user_ids = rtrim($contest_user_ids, ',');
		$contest_final_voting = $wpdb->get_results("SELECT DISTINCT(voter_id) FROM mkd_pod_competitor_votes WHERE contest_id = $contest_id AND voter_id NOT IN ($contest_user_ids)");
		foreach ($contest_final_voting as $key => $final_voter) {
			$contest_user = $wpdb->get_results("SELECT  * FROM wp_users where ID = '$final_voter->voter_id'")[0];
			$email = $contest_user->user_email;
			$email_payload = array(
				'link' => 'https://gametournament.manaknightdigital.com/index.php/tournament/?contest_id='.$contest->id,
				'email' => $email,
				'round_number' => 'final'
			);
			$response = send_email('final-round-voting', $email_payload, $email);
		}
		$wpdb->update('mkd_contest', [
				'contest_level' => 'final'
			], array('id' => $contest_id));
		return [
			'success' => 1,
			'message' => 'Final tier created.'
		];

	}
	//$wpdb->query("UPDATE mkd_pod_competitors SET votes = votes + 1 WHERE portfolio_id = $competitor_id AND contest_level=$contest_level AND pod_id = $pod_id");
	// $pod_length = count($contest_portfolios) % 4;
	// for($i=0; $i <= $pod_size; $i++)
	// {
	// 	$wpdb->insert('mkd_pods', array(
	// 		'contest_id' => $contest->id
	// 	));
	// }

	$pod_size = 4;
	$chunked_arr= array_chunk($contest_portfolios, $pod_size);
	if(count($contest_portfolios) % $pod_size != '0')
	{
		$remaining_portfolios = $chunked_arr[count($chunked_arr) -1];
		foreach ($remaining_portfolios as $key => $remaining_portfolio) {
			array_push($chunked_arr[$key], $remaining_portfolio);
		}
		array_pop($chunked_arr);
	}
	foreach ($chunked_arr as $key => $chunked) {
		$wpdb->insert('mkd_pods', array(
			'contest_id' => $contest->id,
			'contest_level' => $contest_level+1
		));
		$pod_id = $wpdb->insert_id;
		foreach ($chunked as $key => $contest_portfolio) {			
			$contest_user = $wpdb->get_results("SELECT  * FROM wp_users where ID = '$contest_portfolio->user_id'")[0];
			$email = $contest_user->user_email;
			$email_payload = array(
				'link' => 'https://gametournament.manaknightdigital.com/index.php/tournament/?contest_id='.$contest->id,
				'email' => $email,
				'round_number' => $contest_level+1

			);
			$response = send_email('next-round', $email_payload, $email);
			$wpdb->insert('mkd_pod_competitors', array(
				'pod_id' 		=> $pod_id,
				'contest_id' => $contest->id,
				'user_id'		=> $contest_portfolio->user_id,
				'portfolio_id' 	=> $contest_portfolio->portfolio_id,
				'contest_level' => $contest_level+1
			));
		}
	}
	$wpdb->update('mkd_contest', [
			'contest_level' => $contest_level+1
		], array('id' => $contest_id));
	return [
			'success' => 1,
			'message' => 'New tier created.'
		];
}
// Function get pods
function get_pods_ajax(){
	global $wpdb;
	$pods = $wpdb->get_results("SELECT  * FROM mkd_pods");
	for($i=0;$i<sizeof($pods);$i++){
		$pod_id=$pods[$i]->id;
		$pods[$i]->competitors = $wpdb->get_results("SELECT  * FROM mkd_pod_competitors WHERE pod_id = $pod_id");
	}

	echo json_encode([
		'data' 		=> $pods,
		'status'	=>200
	]);
	exit();
}

// Function submit vote
// function submit_vote_ajax(){
// 	global $wpdb;
// 	$voter_id 		= $_POST['voter_id'];
// 	$competitor_id	= $_POST['competitor_id'];
// 	$pod_id			= $_POST['pod_id'];
// 	$contest_level			= $_POST['contest_level'];

// 	$validations	  =[];
// 	if(empty($voter_id)){
// 		$validations[]	='voter_id field is required';
// 	}
// 	if(empty($competitor_id)){
// 		$validations[]	='competitor_id field is required';
// 	}
// 	if(empty($pod_id)){
// 		$validations[]	='pod_id field is required';
// 	}
// 	if(empty($pod_id)){
// 		$validations[]	='contest_level field is required';
// 	}
// 	if(!empty($validations)){
// 		echo json_encode([
// 			'data'   => $validations,
// 			'status' => 400
// 		]);
// 		exit();
// 	}

// 	if($voter_id == $competitor_id){
// 		echo json_encode([
// 			'data' 		=> 'You can not vote yourself',
// 			'status'	=> 400
// 		]);
// 		exit();
// 	}

// 	$existing=$wpdb->get_results("SELECT  * FROM mkd_pod_competitor_votes WHERE voter_id=$voter_id AND contest_level=$contest_level AND pod_id = $pod_id");	
// 	if(!empty($existing)){
// 		echo json_encode([
// 			'data' 		=> 'You can not cast multiple votes in the same pod',
// 			'status'	=> 400
// 		]);
// 		exit();
// 	}

// 	$result=$wpdb->insert('mkd_pod_competitor_votes', array(
// 		'mkd_pod_competitors_id' 	=> $competitor_id,
// 		'voter_id' 					=> $voter_id,
// 		'contest_level' 			=> $contest_level,
// 		'pod_id' 					=> $pod_id
// 	));
// 	if($result == 1){
// 		$wpdb->query("UPDATE mkd_pod_competitors SET votes = votes + 1 WHERE portfolio_id = $competitor_id AND contest_level=$contest_level AND pod_id = $pod_id");
// 	}
	
// 	echo json_encode([
// 		'data' 		=> $result,
// 		'status'	=>200
// 	]);
// 	exit();
// }

// Function Get Contest/Tournament by id
function get_my_contest_by_id()
{
	if (!empty(isset($_POST['id']))) {
		$id = (int) $_POST['id'];

		global $wpdb;
		$today = date("Y-m-d");


		$results = $wpdb->get_results("SELECT  * FROM mkd_contest Where mkd_contest.id = $id and  mkd_contest.end_date >= $today");

		for($i=0;$i<sizeof($results);$i++){
			$time_line = get_calc_remaining_time($results[$i]->end_date);
			$results[$i]->remaining_time=$time_line['deadline'];
			$results[$i]->running_time=$time_line['running_time'];
		}

		echo json_encode([
			'data' => $results
		]);
		exit();
	}
}



function my_login_redirect($url, $request, $user)
{
	if ($user && is_object($user) && is_a($user, 'WP_User')) {
		if (!user_can($user->ID, 'administrator')) {
			$url = home_url('/members/' . $user->user_login);
		}
	}
	return $url;
}

function submit_portfolio_to_contest($portfolio_id, $contest_id)
{
	$wpdb->query("UPDATE mkd_portfolio SET submitted_to_contest = $contest_id WHERE id = $portfolio_id ");
	return true;
}

function get_portfolio_not_used_ajax()
{

	//TODO, ask for page # and load ajax
	$user_id = get_current_user_id();
	if (!empty(isset($_POST['cat_id']))) {
		$cat_id = (int) $_POST['cat_id'];

		global $wpdb;

		$results = $wpdb->get_results("SELECT   mkd_portfolio.* FROM mkd_portfolio
	 where mkd_portfolio.user_id = '$user_id'
	 AND mkd_portfolio.category_id = '$cat_id' AND submitted_to_contest = ''");

		echo json_encode([
			'data' => $results
		]);
		exit();
	}
}


function get_portfolios_for_game()
{

	//TODO, ask for page # and load ajax
	global $wpdb;
	$today = date("Y-m-d");
	
	$user_id = get_current_user_id();
	$where_visibility = '';
	$where_category = '';
	if(!$user_id)
	{
		echo json_encode([
			'success' => false,
			'data' => 'Please login.'
		]);
		exit();
	}
	$contest_id = $_POST['contest_id'];
	$where_pc_id = '';
	// if(isset($_POST['pc_id']) && $_POST['pc_id'] != '0')
	// {
	// 	$where_pc_id = " AND pc.id = ".$_POST['pc_id'];
	// }

	$user = $wpdb->get_results("SELECT  * FROM   wp_users where ID= '$user_id'");
	$contest = $wpdb->get_results("SELECT  * FROM   mkd_contest where id= '$contest_id' AND end_date < '$today' AND status = 0");
	if(count($user) < 1 && count($contest) < 1)
	{
		echo json_encode([
			'success' => false,
			'data' => 'Contest not found'
		]);
		exit();
	}
	$contest = $contest[0];
	$contest_level = $contest->contest_level;
	$user_where = " AND pc.user_id != '$user_id' ";
	if($contest->contest_level == 'final')
	{
		$user_where = "";
		$check_eligible_for_final_voter = $wpdb->get_results("SELECT  * FROM   mkd_pod_competitor_votes INNER JOIN mkd_pods on mkd_pods.id = mkd_pod_competitor_votes.pod_id where mkd_pods.contest_id = '$contest_id' AND voter_id = '$user_id'");
		if(count($check_eligible_for_final_voter) == 0)
		{
			echo json_encode([
				'success' => false,
				'data' => 'You haven\' voted in any tiers. Therefore you are not able to vote.' 
			]);
			exit();
		}
	}
	//check if user already voted
	$check_if_user_voted = $wpdb->get_results("SELECT  * FROM   mkd_pod_competitor_votes INNER JOIN mkd_pods on mkd_pods.id = mkd_pod_competitor_votes.pod_id where mkd_pods.contest_id = '$contest_id' AND mkd_pod_competitor_votes.contest_level = '$contest_level' AND voter_id = '$user_id'");
	if(count($check_if_user_voted) > 0)
	{
		echo json_encode([
			'success' => false,
			'data' => 'You have already voted. Please wait for the next schedule.'
		]);
		exit();
	}
	//check if user exist in game
	$check_user_in_game = $wpdb->get_results("SELECT  * FROM   mkd_pod_competitors INNER JOIN mkd_pods on mkd_pods.id = mkd_pod_competitors.pod_id where mkd_pods.contest_id = '$contest_id' and (user_id= '$user_id' || mkd_pods.contest_level = 'final') AND mkd_pod_competitors.contest_level = '$contest_level'");
	//echo $wpdb->last_query;exit();
	if(count($check_user_in_game) == 0)
	{
		echo json_encode([
			'success' => false,
			'data' => 'User doesn\'t exist in tournament' 
		]);
		exit();
	}
	$user_pod = $check_user_in_game[0]->pod_id;
	$results = $wpdb->get_results("SELECT   p.*,pc.pod_id,pc.id as pc_id FROM mkd_pod_competitors as pc INNER JOIN mkd_portfolio as p on pc.portfolio_id = p.id
	 where pc.pod_id = '$user_pod' $user_where $where_pc_id ORDER BY pc.id ASC");
	echo json_encode([
		'success' => true,
		'data' => $results
	]);
	exit();
}

function set_vote_for_winner()
{
	//TODO, ask for page # and load ajax
	global $wpdb;
	$today = date("Y-m-d");
	
	$user_id = get_current_user_id();
	$where_visibility = '';
	$where_category = '';
	if(!$user_id)
	{
		echo json_encode([
			'error' => 'No User'
		]);
		exit();
	}
	$contest_id = $_POST['contest_id'];
	$pc_id = $_POST['pc_id'];
	// if(isset($_POST['pc_id']) && $_POST['pc_id'] != '0')
	// {
	// 	$where_pc_id = " AND pc.id = ".$_POST['pc_id'];
	// }

	$user = $wpdb->get_results("SELECT  * FROM   wp_users where ID= '$user_id'");
	$contest = $wpdb->get_results("SELECT  * FROM   mkd_contest where id= '$contest_id' AND end_date < '$today' AND status = 0");
	if(count($user) < 1 && count($contest) < 1)
	{
		echo json_encode([
			'data' => 'Contest not found'
		]);
		exit();
	}
	$contest_level = $contest[0]->contest_level;
	//check if user exist in game
	$check_user_in_game = $wpdb->get_results("SELECT  * FROM   mkd_pod_competitors INNER JOIN mkd_pods on mkd_pods.id = mkd_pod_competitors.pod_id where mkd_pods.contest_id = '$contest_id' and (user_id= '$user_id' || mkd_pods.contest_level = 'final') AND mkd_pod_competitors.contest_level = '$contest_level'");
	//echo $wpdb->last_query;exit();
	if(count($check_user_in_game) == 0)
	{
		echo json_encode([
			'success' => false,
			'data' => 'User doesn\'t exist in tournament' 
		]);
		exit();
	}
	$user_pod = $check_user_in_game[0]->pod_id;	
	//$portfolio_id = $check_user_in_game[0]->portfolio_id;
	$voted_portfolio = $wpdb->get_results("SELECT  * FROM   mkd_pod_competitors where id='$pc_id'")[0];

	$existing=$wpdb->get_results("SELECT  * FROM mkd_pod_competitor_votes WHERE contest_id='$contest_id' AND voter_id=$user_id AND contest_level=$contest_level AND pod_id = $user_pod");	
	if(!empty($existing)){
		echo json_encode([
			'data' 		=> 'You can not cast multiple votes in the same pod',
			'success'	=> false
		]);
		exit();
	}

	$result=$wpdb->insert('mkd_pod_competitor_votes', array(
		'mkd_pod_competitors_id' 	=> $voted_portfolio->id,
		'voter_id' 					=> $user_id,
		'contest_level' 			=> $contest_level,
		'pod_id' 					=> $user_pod,
		'contest_id' => $contest_id
	));
	if($result == 1){
		$wpdb->query("UPDATE mkd_pod_competitors SET votes = votes + 1 WHERE id='$pc_id'");
	}
	
	echo json_encode([
		'data' 		=> $result,
		'success'	=>true
	]);
	exit();
}

function get_contest_by_id()
{
	global $wpdb;
	$contest_id = $_POST['contest_id'];

	$contest = $wpdb->get_results("SELECT  * FROM   mkd_contest where id= '$contest_id'");
	echo json_encode([
		'data' 		=> $contest,
		'success'	=>true
	]);
	exit();
}

function get_contest_winners()
{
	global $wpdb;
	$contest_id = $_POST['contest_id'];
	$contest = $wpdb->get_results("SELECT  * FROM   mkd_contest where id= '$contest_id' AND status = 1");
	if(count($contest) === 0)
	{
		echo json_encode([
			'data' 		=> 'Contest Not found.',
			'success'	=>false
		]);
		exit();
	}
	$contest = $contest[0];
	$contest->winner['1'] = [];
	$contest->winner['2'] = [];
	$contest->winner['3'] = [];
	$contest->winner['4'] = [];
	$contest->winner['5'] = [];
	$contest->winner['draw'] = [];
	$contest_entries = $wpdb->get_results("SELECT  * FROM   mkd_contest_portfolio where contest_id= '$contest_id'");
	if($contest->winner_1)
	{
		$portfolio = $wpdb->get_results("SELECT  mkd_portfolio.*, wp_users.display_name FROM   mkd_portfolio LEFT JOIN wp_users on wp_users.ID = mkd_portfolio.user_id where mkd_portfolio.id= '$contest->winner_1'")[0];
		//echo $wpdb->last_query;exit();
		if($portfolio)
		{
			$contest->winner['1'] = $portfolio;
		}
	}
	if($contest->winner_2)
	{
		$portfolio = $wpdb->get_results("SELECT  mkd_portfolio.*, wp_users.display_name FROM   mkd_portfolio LEFT JOIN wp_users on wp_users.ID = mkd_portfolio.user_id where mkd_portfolio.id= '$contest->winner_2'")[0];
		if($portfolio)
		{
			$contest->winner['2'] = $portfolio;
		}
	}
	if($contest->winner_3)
	{
		$portfolio = $wpdb->get_results("SELECT  mkd_portfolio.*, wp_users.display_name FROM   mkd_portfolio LEFT JOIN wp_users on wp_users.ID = mkd_portfolio.user_id where mkd_portfolio.id= '$contest->winner_3'")[0];
		if($portfolio)
		{
			$contest->winner['3'] = $portfolio;
		}
	}
	if($contest->winner_4)
	{
		$portfolio = $wpdb->get_results("SELECT  mkd_portfolio.*, wp_users.display_name FROM   mkd_portfolio LEFT JOIN wp_users on wp_users.ID = mkd_portfolio.user_id where mkd_portfolio.id= '$contest->winner_4'")[0];
		if($portfolio)
		{
			$contest->winner['4'] = $portfolio;
		}
	}
	if($contest->winner_5)
	{
		$portfolio = $wpdb->get_results("SELECT  mkd_portfolio.*, wp_users.display_name FROM   mkd_portfolio LEFT JOIN wp_users on wp_users.ID = mkd_portfolio.user_id where mkd_portfolio.id= '$contest->winner_5'")[0];
		if($portfolio)
		{
			$contest->winner['5'] = $portfolio;
		}
	}
	if($contest->draw_winner)
	{
		$portfolio = $wpdb->get_results("SELECT  mkd_portfolio.*, wp_users.display_name FROM   mkd_portfolio LEFT JOIN wp_users on wp_users.ID = mkd_portfolio.user_id where mkd_portfolio.id= '$contest->draw_winner'")[0];
		if($portfolio)
		{
			$contest->winner['draw'] = $portfolio;
		}
	}
	$contest->entries = count($contest_entries);
	//$contest->remaining_time=get_calc_remaining_time($contest->end_date);

		$time_line = get_calc_remaining_time($results[$i]->end_date);
		$contest->remaining_time=$time_line['deadline'];
		$contest->running_time=$time_line['running_time'];
	echo json_encode([
		'data' 		=> $contest,
		'success'	=>true
	]);
	exit();
}

function create_users()
{
	global $wpdb;
	$emails = [
		'Jayla@mailinator.com',
		'Kaiav@mailinator.com',
		'Thea@mailinator.com',
		'Adriana@mailinator.com',
		'Mariah@mailinator.com',
		'Juliet@mailinator.com',
		'Oaklynnv@mailinator.com',
		'Kiarav@mailinator.com',
		'Alexis@mailinator.com',
		'Havenvv@mailinator.com',
		'Aniyah@mailinator.com',
		'Delaney@mailinator.com',
		'Gracelynnv@mailinator.com',
		'Kendall@mailinator.com',
		'Winter@mailinator.com',
		'Lilithv@mailinator.com',
		'Logan@mailinator.com',
		'Amiyah@mailinator.com',
		'Evie@mailinator.com',
		'Alexandria@mailinator.com',
		'Gracelyn@mailinator.com',
		'Gabriela@mailinator.com',
		'Sutton@mailinator.com',
		'Harlow@mailinator.com',
		'Madilyn@mailinator.comv',
		'Makayla@mailinator.com',
		'Evelynn@mailinator.com',
		'Gia@mailinator.com',
		'Nina@mailinator.com',
		'Aminav@mailinator.com',
		'Giselle@mailinator.com',
		'Brynnv@mailinator.com',
		'Blair@mailinator.com',
		'Amari@mailinator.com',
		'Octaviav@mailinator.com',
		'Michelle@mailinator.com',
		'Talia@mailinator.com',
		'Demi@mailinator.com',
		'Avianna@mailinator.com',
		'Felicity@mailinator.com',
		'Aylin@mailinator.com',
		'Miracle@mailinator.com',
		'Sabrina@mailinator.com',
		'Lana@mailinator.com',
		'Ophelia@mailinator.com',
		'Elianna@mailinator.com',
		'Royalty@mailinator.com',
		'Madeleine@mailinator.com',
		'Esmeralda@mailinator.com',
		'Joy@mailinator.com',
		'Kalani@mailinator.com',
		'Esme@mailinator.com',
		'Jessica@mailinator.com',
		'Leighton@mailinator.com',
		'Ariah@mailinator.com',
		'Makenna@mailinator.com',
		'Nylah@mailinator.com',
		'Viviana@mailinator.com',
		'Camryn@mailinator.com',
		'Cassidy@mailinator.com',
		'Dream@mailinator.com',
		'Luciana@mailinator.com',
		'Maisie@mailinator.com',
		'Stevie@mailinator.com',
		'Kate@mailinator.com',
		'Lyric@mailinator.com',
		'Daniella@mailinator.com',
		'Izabella@mailinator.com',
		'Fatima@mailinator.com',
		'Tatum@mailinator.com',
		'Makenzie@mailinator.com',
		'Lilliana@mailinator.com',
		'Arielle@mailinator.com',
		'Palmer@mailinator.com',
		'Melissa@mailinator.com',
		'Willa@mailinator.com',
		'Samara@mailinator.com',
		'Destiny@mailinator.com',
		'Dahlia@mailinator.com',
		'Celeste@mailinator.com',
		'Ainsley@mailinator.com',
		'Rylie@mailinator.com',
		'Reign@mailinator.com',
		'Laura@mailinator.com',
		'Adelynn@mailinator.com',
		'Gabrielle@mailinator.com',
		'Remington@mailinator.com',
		'Wrenv@mailinator.com',
		'Brinley@mailinator.com',
		'Amora@mailinator.com',
		'Lainey@mailinator.com',
		'Collins@mailinator.com',
		'Lexi@mailinator.com',
		'Aitana@mailinator.com',
		'Alessandra@mailinator.com',
		'Kenzie@mailinator.com',
		'Raelyn@mailinator.com',
		'Elle@mailinator.com',
		'Everlee@mailinator.com',
		'Haisleyv@mailinator.com',
		'Hallie@mailinator.com',
		'Wynter@mailinator.com',
		'Daleyza@mailinator.com',
		'Gwendolyn@mailinator.com',
		'Paislee@mailinator.com',
		'Ariyah@mailinator.com',
		'Veronica@mailinator.com',
		'Heidi@mailinator.com',
		'Anaya@mailinator.com',
		'Cataleya@mailinator.com',
		'Kira@mailinator.com',
		'Olivia@mailinator.com',
		'Emma@mailinator.com',
		'Ava@mailinator.com',
		'Charlotte@mailinator.com',
		'Sophia@mailinator.com',
		'Amelia@mailinator.com',
		'Isabella@mailinator.com',
		'Mia@mailinator.com',
		'Evelyn@mailinator.com',
		'Harper@mailinator.com',
		'Camila@mailinator.com',
		'Gianna@mailinator.com',
		'Abigail@mailinator.com',
		'Luna@mailinator.com',
		'Ella@mailinator.com',
		'Elizabeth@mailinator.com',
		'Sofia@mailinator.com',
		'Emily@mailinator.com',
		'Avery@mailinator.com',
		'Mila@mailinator.com',
		'Scarlett@mailinator.com',
		'Eleanor@mailinator.com',
		'Madison@mailinator.com',
		'Layla@mailinator.com',
		'Penelope@mailinator.com',
		'Aria@mailinator.com',
		'Chloe@mailinator.com',
		'Grace@mailinator.com',
		'Ellie@mailinator.com',
		'Nora@mailinator.com',
		'Hazel@mailinator.com',
		'Zoey@mailinator.com',
		'Riley@mailinator.com',
		'Victoria@mailinator.com',
		'Lily@mailinator.com',
		'Aurora@mailinator.com',
		'Violet@mailinator.com',
		'Nova@mailinator.com',
		'Hannah@mailinator.com',
		'Emilia@mailinator.com',
		'Zoe@mailinator.com',
		'Stella@mailinator.com',
		'Everlyv@mailinator.com',
		'Isla@mailinator.com',
		'Leah@mailinator.com',
		'Lillian@mailinator.com',
		'Addison@mailinator.com',
		'Willow@mailinator.com',
		'Lucyv@mailinator.com',
		'Paisley@mailinator.com',
		'Natalie@mailinator.com',
		'Naomi@mailinator.com',
		'Eliana@mailinator.com',
		'Brooklyn@mailinator.com',
		'Elena@mailinator.com',
		'Aubrey@mailinator.com',
		'Claire@mailinator.com',
		'Ivy@mailinator.com',
		'Kinsley@mailinator.com',
		'Audrey@mailinator.com',
		'Maya@mailinator.com',
		'Genesis@mailinator.com',
		'Skylar@mailinator.com',
		'Bella@mailinator.com',
		'Aaliyah@mailinator.com',
		'Madelyn@mailinator.com',
		'Savannah@mailinator.com',
		'Anna@mailinator.com',
		'Delilah@mailinator.com',
		'Serenity@mailinator.com',
		'Caroline@mailinator.com',
		'Kennedy@mailinator.com',
		'Valentina@mailinator.com',
		'Ruby@mailinator.com',
		'Sophie@mailinator.com',
		'Alice@mailinator.com',
		'Gabriella@mailinator.com',
		'Sadie@mailinator.com',
		'Ariana@mailinator.com',
		'Allison@mailinator.com',
		'Hailey@mailinator.com',
		'Autumn@mailinator.com',
		'Nevaeh@mailinator.com',
		'Natalia@mailinator.com',
		'Quinn@mailinator.com',
		'Josephine@mailinator.com',
		'Sarah@mailinator.com',
		'Cora@mailinator.com',
		'Emery@mailinator.com',
		'Samantha@mailinator.com',
		'Piper@mailinator.com',
		'Leilani@mailinator.com',
		'Eva@mailinator.com',
		'Everleigh@mailinator.com',
		'Madeline@mailinator.com',
		'Lydia@mailinator.com',
		'Jade@mailinator.com',
		'Peyton@mailinator.com',
		'Brielle@mailinator.com',
		'Adeline@mailinator.com',
		'Vivianv@mailinator.com',
		'Rylee@mailinator.com',
		'Clara@mailinator.com',
		'Raelynn@mailinator.com',
		'Melanie@mailinator.com',
		'Melody@mailinator.com',
		'Julia@mailinator.com',
		'Athena@mailinator.com',
		'Maria@mailinator.com',
		'Liliana@mailinator.com',
		'Hadley@mailinator.com',
		'Arya@mailinator.com',
		'Rose@mailinator.com',
		'Reagan@mailinator.com',
		'Eliza@mailinator.com',
		'Adalynn@mailinator.com',
		'Kaylee@mailinator.com',
		'Lyla@mailinator.com',
		'Mackenzie@mailinator.com',
		'Alaia@mailinator.com',
		'Isabelle@mailinator.com',
		'Charlie@mailinator.com',
		'Arianna@mailinator.com',
		'Mary@mailinator.com',
		'Remi@mailinator.com',
		'Margaret@mailinator.com',
		'Iris@mailinator.com',
		'Parker@mailinator.com',
		'Ximena@mailinator.com',
		'Eden@mailinator.com',
		'Ayla@mailinator.com',
		'Kylie@mailinator.com',
		'Ellia@mailinator.com',
		'Josie@mailinator.com',
		'Katherine@mailinator.com',
		'Faith@mailinator.com',
		'Alexandra@mailinator.com',
		'Eloise@mailinator.com',
		'Adalyn@mailinator.com',
		'Amaya@mailinator.com',
		'Jasmine@mailinator.com',
		'Amara@mailinator.com',
		'Daisy@mailinator.com',
		'Reese@mailinator.com',
		'Valerie@mailinator.com',
		'Brianna@mailinator.com',
		'Cecilia@mailinator.com',
		'Andrea@mailinator.com',
		'Summer@mailinator.com',
		'Valeria@mailinator.com',
		'Norah@mailinator.com',
		'Ariella@mailinator.com',
		'Esther@mailinator.com',
		'Ashley@mailinator.com',
		'Emerson@mailinator.com',
		'Aubree@mailinator.com',
		'Isabel@mailinator.com',
		'Anastasia@mailinator.com',
		'Ryleigh@mailinator.com',
		'Khloe@mailinator.com',
		'Taylor@mailinator.com',
		'Londyn@mailinator.com',
		'Lucia@mailinator.com',
		'Emersyn@mailinator.com',
		'Callie@mailinator.com',
		'Sienna@mailinator.com',
		'Blakely@mailinator.com',
		'Kehlani@mailinator.com',
		'Genevieve@mailinator.com',
		'Alina@mailinator.com',
		'Bailey@mailinator.com',
		'Juniper@mailinator.com',
		'Maeve@mailinator.com',
		'Molly@mailinator.com',
		'Harmony@mailinator.com',
		'Georgia@mailinator.com',
		'Magnolia@mailinator.com',
		'Catalina@mailinator.com',
		'Freya@mailinator.com',
		'Juliette@mailinator.com',
		'Sloane@mailinator.com',
		'June@mailinator.com',
		'Sara@mailinator.com',
		'Ada@mailinator.com',
		'Kimberly@mailinator.com',
		'River@mailinator.com',
		'Ember@mailinator.com',
		'Juliana@mailinator.com',
		'Aliyah@mailinator.com',
		'Millie@mailinator.com',
		'Brynlee@mailinator.com',
		'Teagan@mailinator.com',
		'Morgan@mailinator.com',
		'Jordyn@mailinator.com',
		'London@mailinator.com',
		'Alaina@mailinator.com',
		'Olive@mailinator.com',
		'Rosalie@mailinator.com',
		'Alyssa@mailinator.com',
		'Ariel@mailinator.com',
		'Finley@mailinator.com',
		'Arabella@mailinator.com',
		'Journee@mailinator.com',
		'Hope@mailinator.com',
		'Leila@mailinator.com',
		'Alana@mailinator.com',
		'Gemma@mailinator.com',
		'Vanessa@mailinator.com',
		'Gracie@mailinator.com',
		'Noelle@mailinator.com',
		'Marley@mailinator.com',
		'Elise@mailinator.com',
		'Presley@mailinator.com',
		'Kamila@mailinator.com',
		'Zara@mailinator.com',
		'Amy@mailinator.com',
		'Kayla@mailinator.com',
		'Payton@mailinator.com',
		'Blake@mailinator.com',
		'Ruth@mailinator.com',
		'Alani@mailinator.com',
		'Annabelle@mailinator.com',
		'Sage@mailinator.com',
		'Aspen@mailinator.com',
		'Laila@mailinator.com',
		'Lila@mailinator.com',
		'Rachel@mailinator.com',
		'Trinity@mailinator.com',
		'Daniela@mailinator.com',
		'Alexa@mailinator.com',
		'Lillyv@mailinator.com',
		'Lauren@mailinator.com',
		'Elsie@mailinator.com',
		'Margotv@mailinator.com',
		'Adelyn@mailinator.com',
		'Zuri@mailinator.com',
		'Brooke@mailinator.com',
		'Sawyer@mailinator.com',
		'Lilahv@mailinator.com',
		'Lola@mailinator.com',
		'Selena@mailinator.com',
		'Mya@mailinator.com',
		'Sydney@mailinator.com',
		'Diana@mailinator.com',
		'Ana@mailinator.com',
		'Vera@mailinator.com',
		'Alayna@mailinator.com',
		'Nyla@mailinator.com',
		'Elaina@mailinator.com',
		'Rebeccav@mailinator.com',
		'Angela@mailinator.com',
		'Kali@mailinator.com',
		'Alivia@mailinator.com',
		'Raegan@mailinator.com',
		'Rowan@mailinator.com',
		'Phoebev@mailinator.com',
		'Camilla@mailinator.com',
		'Joanna@mailinator.com',
		'Malia@mailinator.com',
		'Vivienne@mailinator.com',
		'Dakota@mailinator.com',
		'Brooklynn@mailinator.com',
		'Evangeline@mailinator.com',
		'Camille@mailinator.com',
		'Jane@mailinator.com',
		'Nicole@mailinator.com',
		'Catherine@mailinator.com',
		'Jocelyn@mailinator.com',
		'Julianna@mailinator.com',
		'Lena@mailinator.com',
		'Lucille@mailinator.com',
		'Mckenna@mailinator.com',
		'Paigev@mailinator.com',
		'Adelaide@mailinator.com',
		'Charlee@mailinator.com',
		'Mariana@mailinator.com',
		'Myla@mailinator.com',
		'Mckenzie@mailinator.com',
		'Tessa@mailinator.com',
		'Miriam@mailinator.com',
		'Oakley@mailinator.com',
		'Kailani@mailinator.com',
		'Alayah@mailinator.com',
		'Amira@mailinator.com',
		'Adaline@mailinator.com',
		'Phoenix@mailinator.com',
		'Milani@mailinator.com',
		'Annie@mailinator.com',
		'Lia@mailinator.com',
		'Angelinav@mailinator.com',
		'Harley@mailinator.com',
		'Cali@mailinator.com',
		'Maggie@mailinator.com',
		'Hayden@mailinator.com',
		'Leiav@mailinator.com',
		'Fiona@mailinator.com',
		'Briella@mailinator.com',
		'Journeyv@mailinator.com',
		'Lennon@mailinator.com',
		'Saylor@mailinator.com',
		'Jayla@mailinator.com',
		'Kaiav@mailinator.com',
		'Thea@mailinator.com',
		'Adriana@mailinator.com',
		'Mariah@mailinator.com',
		'Juliet@mailinator.com',
		'Oaklynnv@mailinator.com',
		'Kiarav@mailinator.com',
		'Alexis@mailinator.com',
		'Havenvv@mailinator.com',
		'Aniyah@mailinator.com',
		'Delaney@mailinator.com',
		'Gracelynnv@mailinator.com',
		'Kendall@mailinator.com',
		'Winter@mailinator.com',
		'Lilithv@mailinator.com',
		'Logan@mailinator.com',
		'Amiyah@mailinator.com',
		'Evie@mailinator.com',
		'Alexandria@mailinator.com',
		'Gracelyn@mailinator.com',
		'Gabriela@mailinator.com',
		'Sutton@mailinator.com',
		'Harlow@mailinator.com',
		'Madilyn@mailinator.comv',
		'Makayla@mailinator.com',
		'Evelynn@mailinator.com',
		'Gia@mailinator.com',
		'Nina@mailinator.com',
		'Aminav@mailinator.com',
		'Giselle@mailinator.com',
		'Brynnv@mailinator.com',
		'Blair@mailinator.com',
		'Amari@mailinator.com',
		'Octaviav@mailinator.com',
		'Michelle@mailinator.com',
		'Talia@mailinator.com',
		'Demi@mailinator.com',
		'Avianna@mailinator.com',
		'Felicity@mailinator.com',
		'Aylin@mailinator.com',
		'Miracle@mailinator.com',
		'Sabrina@mailinator.com',
		'Lana@mailinator.com',
		'Ophelia@mailinator.com',
		'Elianna@mailinator.com',
		'Royalty@mailinator.com',
		'Madeleine@mailinator.com',
		'Esmeralda@mailinator.com',
		'Joy@mailinator.com',
		'Kalani@mailinator.com',
		'Esme@mailinator.com',
		'Jessica@mailinator.com',
		'Leighton@mailinator.com',
		'Ariah@mailinator.com',
		'Makenna@mailinator.com',
		'Nylah@mailinator.com',
		'Viviana@mailinator.com',
		'Camryn@mailinator.com',
		'Cassidy@mailinator.com',
		'Dream@mailinator.com',
		'Luciana@mailinator.com',
		'Maisie@mailinator.com',
		'Stevie@mailinator.com',
		'Kate@mailinator.com',
		'Lyric@mailinator.com',
		'Daniella@mailinator.com',
		'Izabella@mailinator.com',
		'Fatima@mailinator.com',
		'Tatum@mailinator.com',
		'Makenzie@mailinator.com',
		'Lilliana@mailinator.com',
		'Arielle@mailinator.com',
		'Palmer@mailinator.com',
		'Melissa@mailinator.com',
		'Willa@mailinator.com',
		'Samara@mailinator.com',
		'Destiny@mailinator.com',
		'Dahlia@mailinator.com',
		'Celeste@mailinator.com',
		'Ainsley@mailinator.com',
		'Rylie@mailinator.com',
		'Reign@mailinator.com',
		'Laura@mailinator.com',
		'Adelynn@mailinator.com',
		'Gabrielle@mailinator.com',
		'Remington@mailinator.com',
		'Wrenv@mailinator.com',
		'Brinley@mailinator.com',
		'Amora@mailinator.com',
		'Lainey@mailinator.com',
		'Collins@mailinator.com',
		'Lexi@mailinator.com',
		'Aitana@mailinator.com',
		'Alessandra@mailinator.com',
		'Kenzie@mailinator.com',
		'Raelyn@mailinator.com',
		'Elle@mailinator.com',
		'Everlee@mailinator.com',
		'Haisleyv@mailinator.com',
		'Hallie@mailinator.com',
		'Wynter@mailinator.com',
		'Daleyza@mailinator.com',
		'Gwendolyn@mailinator.com',
		'Paislee@mailinator.com',
		'Ariyah@mailinator.com',
		'Veronica@mailinator.com',
		'Heidi@mailinator.com',
		'Anaya@mailinator.com',
		'Cataleya@mailinator.com',
		'Kira@mailinator.com',
		'Olivia@mailinator.com',
		'Emma@mailinator.com',
		'Ava@mailinator.com',
		'Charlotte@mailinator.com',
		'Sophia@mailinator.com',
		'Amelia@mailinator.com',
		'Isabella@mailinator.com',
		'Mia@mailinator.com',
		'Evelyn@mailinator.com',
		'Harper@mailinator.com',
		'Camila@mailinator.com',
		'Gianna@mailinator.com',
		'Abigail@mailinator.com',
		'Luna@mailinator.com',
		'Ella@mailinator.com',
		'Elizabeth@mailinator.com',
		'Sofia@mailinator.com',
		'Emily@mailinator.com',
		'Avery@mailinator.com',
		'Mila@mailinator.com',
		'Scarlett@mailinator.com',
		'Eleanor@mailinator.com',
		'Madison@mailinator.com',
		'Layla@mailinator.com',
		'Penelope@mailinator.com',
		'Aria@mailinator.com',
		'Chloe@mailinator.com',
		'Grace@mailinator.com',
		'Ellie@mailinator.com',
		'Nora@mailinator.com',
		'Hazel@mailinator.com',
		'Zoey@mailinator.com',
		'Riley@mailinator.com',
		'Victoria@mailinator.com',
		'Lily@mailinator.com',
		'Aurora@mailinator.com',
		'Violet@mailinator.com',
		'Nova@mailinator.com',
		'Hannah@mailinator.com',
		'Emilia@mailinator.com',
		'Zoe@mailinator.com',
		'Stella@mailinator.com',
		'Everlyv@mailinator.com',
		'Isla@mailinator.com',
		'Leah@mailinator.com',
		'Lillian@mailinator.com',
		'Addison@mailinator.com',
		'Willow@mailinator.com',
		'Lucyv@mailinator.com',
		'Paisley@mailinator.com',
		'Natalie@mailinator.com',
		'Naomi@mailinator.com',
		'Eliana@mailinator.com',
		'Brooklyn@mailinator.com',
		'Elena@mailinator.com',
		'Aubrey@mailinator.com',
		'Claire@mailinator.com',
		'Ivy@mailinator.com',
		'Kinsley@mailinator.com',
		'Audrey@mailinator.com',
		'Maya@mailinator.com',
		'Genesis@mailinator.com',
		'Skylar@mailinator.com',
		'Bella@mailinator.com',
		'Aaliyah@mailinator.com',
		'Madelyn@mailinator.com',
		'Savannah@mailinator.com',
		'Anna@mailinator.com',
		'Delilah@mailinator.com',
		'Serenity@mailinator.com',
		'Caroline@mailinator.com',
		'Kennedy@mailinator.com',
		'Valentina@mailinator.com',
		'Ruby@mailinator.com',
		'Sophie@mailinator.com',
		'Alice@mailinator.com',
		'Gabriella@mailinator.com',
		'Sadie@mailinator.com',
		'Ariana@mailinator.com',
		'Allison@mailinator.com',
		'Hailey@mailinator.com',
		'Autumn@mailinator.com',
		'Nevaeh@mailinator.com',
		'Natalia@mailinator.com',
		'Quinn@mailinator.com',
		'Josephine@mailinator.com',
		'Sarah@mailinator.com',
		'Cora@mailinator.com',
		'Emery@mailinator.com',
		'Samantha@mailinator.com',
		'Piper@mailinator.com',
		'Leilani@mailinator.com',
		'Eva@mailinator.com',
		'Everleigh@mailinator.com',
		'Madeline@mailinator.com',
		'Lydia@mailinator.com',
		'Jade@mailinator.com',
		'Peyton@mailinator.com',
		'Brielle@mailinator.com',
		'Adeline@mailinator.com',
		'Vivianv@mailinator.com',
		'Rylee@mailinator.com',
		'Clara@mailinator.com',
		'Raelynn@mailinator.com',
		'Melanie@mailinator.com',
		'Melody@mailinator.com',
		'Julia@mailinator.com',
		'Athena@mailinator.com',
		'Maria@mailinator.com',
		'Liliana@mailinator.com',
		'Hadley@mailinator.com',
		'Arya@mailinator.com',
		'Rose@mailinator.com',
		'Reagan@mailinator.com',
		'Eliza@mailinator.com',
		'Adalynn@mailinator.com',
		'Kaylee@mailinator.com',
		'Lyla@mailinator.com',
		'Mackenzie@mailinator.com',
		'Alaia@mailinator.com',
		'Isabelle@mailinator.com',
		'Charlie@mailinator.com',
		'Arianna@mailinator.com',
		'Mary@mailinator.com',
		'Remi@mailinator.com',
		'Margaret@mailinator.com',
		'Iris@mailinator.com',
		'Parker@mailinator.com',
		'Ximena@mailinator.com',
		'Eden@mailinator.com',
		'Ayla@mailinator.com',
		'Kylie@mailinator.com',
		'Ellia@mailinator.com',
		'Josie@mailinator.com',
		'Katherine@mailinator.com',
		'Faith@mailinator.com',
		'Alexandra@mailinator.com',
		'Eloise@mailinator.com',
		'Adalyn@mailinator.com',
		'Amaya@mailinator.com',
		'Jasmine@mailinator.com',
		'Amara@mailinator.com',
		'Daisy@mailinator.com',
		'Reese@mailinator.com',
		'Valerie@mailinator.com',
		'Brianna@mailinator.com',
		'Cecilia@mailinator.com',
		'Andrea@mailinator.com',
		'Summer@mailinator.com',
		'Valeria@mailinator.com',
		'Norah@mailinator.com',
		'Ariella@mailinator.com',
		'Esther@mailinator.com',
		'Ashley@mailinator.com',
		'Emerson@mailinator.com',
		'Aubree@mailinator.com',
		'Isabel@mailinator.com',
		'Anastasia@mailinator.com',
		'Ryleigh@mailinator.com',
		'Khloe@mailinator.com',
		'Taylor@mailinator.com',
		'Londyn@mailinator.com',
		'Lucia@mailinator.com',
		'Emersyn@mailinator.com',
		'Callie@mailinator.com',
		'Sienna@mailinator.com',
		'Blakely@mailinator.com',
		'Kehlani@mailinator.com',
		'Genevieve@mailinator.com',
		'Alina@mailinator.com',
		'Bailey@mailinator.com',
		'Juniper@mailinator.com',
		'Maeve@mailinator.com',
		'Molly@mailinator.com',
		'Harmony@mailinator.com',
		'Georgia@mailinator.com',
		'Magnolia@mailinator.com',
		'Catalina@mailinator.com',
		'Freya@mailinator.com',
		'Juliette@mailinator.com',
		'Sloane@mailinator.com',
		'June@mailinator.com',
		'Sara@mailinator.com',
		'Ada@mailinator.com',
		'Kimberly@mailinator.com',
		'River@mailinator.com',
		'Ember@mailinator.com',
		'Juliana@mailinator.com',
		'Aliyah@mailinator.com',
		'Millie@mailinator.com',
		'Brynlee@mailinator.com',
		'Teagan@mailinator.com',
		'Morgan@mailinator.com',
		'Jordyn@mailinator.com',
		'London@mailinator.com',
		'Alaina@mailinator.com',
		'Olive@mailinator.com',
		'Rosalie@mailinator.com',
		'Alyssa@mailinator.com',
		'Ariel@mailinator.com',
		'Finley@mailinator.com',
		'Arabella@mailinator.com',
		'Journee@mailinator.com',
		'Hope@mailinator.com',
		'Leila@mailinator.com',
		'Alana@mailinator.com',
		'Gemma@mailinator.com',
		'Vanessa@mailinator.com',
		'Gracie@mailinator.com',
		'Noelle@mailinator.com',
		'Marley@mailinator.com',
		'Elise@mailinator.com',
		'Presley@mailinator.com',
		'Kamila@mailinator.com',
		'Zara@mailinator.com',
		'Amy@mailinator.com',
		'Kayla@mailinator.com',
		'Payton@mailinator.com',
		'Blake@mailinator.com',
		'Ruth@mailinator.com',
		'Alani@mailinator.com',
		'Annabelle@mailinator.com',
		'Sage@mailinator.com',
		'Aspen@mailinator.com',
		'Laila@mailinator.com',
		'Lila@mailinator.com',
		'Rachel@mailinator.com',
		'Trinity@mailinator.com',
		'Daniela@mailinator.com',
		'Alexa@mailinator.com',
		'Lillyv@mailinator.com',
		'Lauren@mailinator.com',
		'Elsie@mailinator.com',
		'Margotv@mailinator.com',
		'Adelyn@mailinator.com',
		'Zuri@mailinator.com',
		'Brooke@mailinator.com',
		'Sawyer@mailinator.com',
		'Lilahv@mailinator.com',
		'Lola@mailinator.com',
		'Selena@mailinator.com',
		'Mya@mailinator.com',
		'Sydney@mailinator.com',
		'Diana@mailinator.com',
		'Ana@mailinator.com',
		'Vera@mailinator.com',
		'Alayna@mailinator.com',
		'Nyla@mailinator.com',
		'Elaina@mailinator.com',
		'Rebeccav@mailinator.com',
		'Angela@mailinator.com',
		'Kali@mailinator.com',
		'Alivia@mailinator.com',
		'Raegan@mailinator.com',
		'Rowan@mailinator.com',
		'Phoebev@mailinator.com',
		'Camilla@mailinator.com',
		'Joanna@mailinator.com',
		'Malia@mailinator.com',
		'Vivienne@mailinator.com',
		'Dakota@mailinator.com',
		'Brooklynn@mailinator.com',
		'Evangeline@mailinator.com',
		'Camille@mailinator.com',
		'Jane@mailinator.com',
		'Nicole@mailinator.com',
		'Catherine@mailinator.com',
		'Jocelyn@mailinator.com',
		'Julianna@mailinator.com',
		'Lena@mailinator.com',
		'Lucille@mailinator.com',
		'Mckenna@mailinator.com',
		'Paigev@mailinator.com',
		'Adelaide@mailinator.com',
		'Charlee@mailinator.com',
		'Mariana@mailinator.com',
		'Myla@mailinator.com',
		'Mckenzie@mailinator.com',
		'Tessa@mailinator.com',
		'Miriam@mailinator.com',
		'Oakley@mailinator.com',
		'Kailani@mailinator.com',
		'Alayah@mailinator.com',
		'Amira@mailinator.com',
		'Adaline@mailinator.com',
		'Phoenix@mailinator.com',
		'Milani@mailinator.com',
		'Annie@mailinator.com',
		'Lia@mailinator.com',
		'Angelinav@mailinator.com',
		'Harley@mailinator.com',
		'Cali@mailinator.com',
		'Maggie@mailinator.com',
		'Hayden@mailinator.com',
		'Leiav@mailinator.com',
		'Fiona@mailinator.com',
		'Briella@mailinator.com',
		'Journeyv@mailinator.com',
		'Lennon@mailinator.com',
		'Saylor@mailinator.com'
		];
	foreach ($emails as $key => $email) {
		$data = array(
			'user_login' => 'user_key_'.$key,
			'user_pass' => '$P$Bzl8hHYxerHFe2aufXIGUhBQ5PXZ.v.',
			'user_email' => $email,
			'user_nicename' => 'user_key_'.$key,
			'user_status' => 0,
			'display_name' => 'New User '.$key

		);
		$result = $wpdb->insert('wp_users', $data);
		$user_id = $wpdb->insert_id;
		$portflio = array(
		'title' => 'Test title '.$key,
		'content' => 'Test content '.$key,
		'type' => 'color',
		'image_url' => '#EEE8AA',
		'user_id' => $user_id,
		'font_id' => 2,
		'category_id' => 6,
		'psuedoname' => 'Manaknight',
		'visibility' => 'public'
		);
		$result = $wpdb->insert('mkd_portfolio', $portflio);
		$portfolio_id = $wpdb->insert_id;
		$create_contest_portfolio = $wpdb->insert('mkd_contest_portfolio', [
			'contest_id' => '9',
			'user_id' => $user_id,
			'portfolio_id' => $portfolio_id
		]);

	}
	echo 'success';exit();
}

add_filter('login_redirect', 'my_login_redirect', 10, 3);

add_action("wp_ajax_create_users", "create_users");
add_action("wp_ajax_nopriv_create_users", "create_users");

add_action("wp_ajax_run_tournament_cronjob", "run_tournament_cronjob");
add_action("wp_ajax_nopriv_run_tournament_cronjob", "run_tournament_cronjob");


add_action("wp_ajax_get_contest_winners", "get_contest_winners");
add_action("wp_ajax_nopriv_get_contest_winners", "get_contest_winners");

add_action("wp_ajax_get_portfolio_All_ajax", "get_portfolio_All_ajax");
add_action("wp_ajax_nopriv_get_portfolio_All_ajax", "get_portfolio_All_ajax");

//Update contest_id to portfolio
add_action("wp_ajax_update_contest_to_portfolio", "update_contest_to_portfolio");
add_action("wp_ajax_nopriv_update_contest_to_portfolio", "update_contest_to_portfolio");

add_action("wp_ajax_get_portfolio_ajax", "get_portfolio_ajax");
add_action("wp_ajax_nopriv_get_portfolio_ajax", "get_portfolio_ajax");
// fonts
add_action("wp_ajax_get_font_url_ajax", "get_font_url_ajax");
add_action("wp_ajax_noprivget_font_url_ajax", "get_font_url_ajax");

//get portfolio_by_id
add_action("wp_ajax_get_portfolio_by_id_ajax", "get_portfolio_by_id_ajax");
add_action("wp_ajax_nopriv_get_portfolio_by_id_ajax", "get_portfolio_by_id_ajax");

//Save Portfolio
add_action("wp_ajax_save_portfolio_ajax", "save_portfolio_ajax");
add_action("wp_ajax_nopriv_save_portfolio_ajax", "save_portfolio_ajax");
//Save Portfolio
add_action("wp_ajax_save_portfolio_ticket_ajax", "save_portfolio_ticket_ajax");
add_action("wp_ajax_nopriv_save_portfolio_ticket_ajax", "save_portfolio_ticket_ajax");

//Update Portfolio
add_action("wp_ajax_update_portfolio_ajax", "update_portfolio_ajax");
add_action("wp_ajax_nopriv_update_portfolio_ajax", "update_portfolio_ajax");


//GET Portfolios in contest category
add_action("wp_ajax_get_portfolios_in_contest_category", "get_portfolios_in_contest_category");
add_action("wp_ajax_nopriv_get_portfolios_in_contest_category", "get_portfolios_in_contest_category");

//Delete Portfolio
add_action("wp_ajax_delete_portfolio_ajax", "delete_portfolio_ajax");
add_action("wp_ajax_nopriv_delete_portfolio_ajax", "delete_portfolio_ajax");

//Get All Contests
add_action("wp_ajax_get_contests", "get_contests");
add_action("wp_ajax_nopriv_get_contests", "get_contests");

//Save contests
add_action("wp_ajax_save_contest_ajax", "save_contest_ajax");
add_action("wp_ajax_nopriv_save_contest_ajax", "save_contest_ajax");

//Create Pods
add_action("wp_ajax_create_pods_ajax", "create_pods_ajax");
add_action("wp_ajax_nopriv_create_pods_ajax", "create_pods_ajax");

//Create Pods
add_action("wp_ajax_get_pods_ajax", "get_pods_ajax");
add_action("wp_ajax_nopriv_get_pods_ajax", "get_pods_ajax");

//Cast a vote against pod
add_action("wp_ajax_submit_vote_ajax", "submit_vote_ajax");
add_action("wp_ajax_nopriv_submit_vote_ajax", "submit_vote_ajax");

//Cast a vote against pod
add_action("wp_ajax_set_vote_for_winner", "set_vote_for_winner");
add_action("wp_ajax_nopriv_set_vote_for_winner", "set_vote_for_winner");

//Get My Contest By ID
add_action("wp_ajax_get_my_contest_by_id", "get_my_contest_by_id");
add_action("wp_ajax_nopriv_get_my_contest_by_id", "get_my_contest_by_id");

//get portfolio not used contest
add_action("wp_ajax_get_portfolio_not_used_ajax", "get_portfolio_not_used_ajax");
add_action("wp_ajax_nopriv_get_portfolio_not_used_ajax", "get_portfolio_not_used_ajax");

//Submit Portfolio to contest
add_action("wp_ajax_submit_portfolio_to_contest", "submit_portfolio_to_contest");
add_action("wp_ajax_nopriv_submit_portfolio_to_contest", "submit_portfolio_to_contest");

add_action("wp_ajax_get_portfolios_for_game", "get_portfolios_for_game");
add_action("wp_ajax_nopriv_get_portfolios_for_game", "get_portfolios_for_game");


add_action("wp_ajax_get_contest_by_id", "get_contest_by_id");
add_action("wp_ajax_nopriv_get_contest_by_id", "get_contest_by_id");

register_deactivation_hook(__FILE__, 'mkd_core_uninstall');
register_uninstall_hook(__FILE__, 'mkd_core_uninstall');
register_activation_hook(__FILE__, 'mkd_core_install');
add_action('admin_menu', 'crud_tables_menus');

include(plugin_dir_path(__FILE__) . '/portfolio_function.php');
add_shortcode('mkd_portfolio', 'portfolio_function');

include(plugin_dir_path(__FILE__) . '/portfolios_function.php');
add_shortcode('mkd_portfolios', 'portfolios_function');

include(plugin_dir_path(__FILE__) . '/tourneys_function.php');
add_shortcode('mkd_tourneys', 'tourneys_function');
