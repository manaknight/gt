<?php

function portfolio_function($atts = array())
{
  include_once 'portfolio_short_code.php';
}


function wpbootstrap_enqueue_styles()
{
  wp_enqueue_style('bootstrap', '//stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css');
  wp_enqueue_style('my-style', get_template_directory_uri() . '/style.css');
  wp_enqueue_script('bootstrap','//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js');
  wp_enqueue_script('bootstrap','//stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js');
  wp_enqueue_script('jquery','//code.jquery.com/jquery-3.6.0.min.js');
  wp_enqueue_script('moment','/wp-content/plugins/mkd-core/moment.js');

  // wp_enqueue_script('jquery','//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js');


 }

add_action('wp_enqueue_scripts', 'wpbootstrap_enqueue_styles');
  