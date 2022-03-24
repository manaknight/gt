<?php

function portfolios_function($atts = array())
{
  include_once 'portfolios_short_codes.php';
}

add_action('wp_enqueue_scripts', 'wpbootstrap_enqueue_styles');
