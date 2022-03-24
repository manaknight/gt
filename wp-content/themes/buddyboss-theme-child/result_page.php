<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/sanjaya007/flex-library@master/dist/css/sanjaya.min.css" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

      <?php //include_once 'tournament_logic.php'; ?>
<?php

get_header();
?>
<?php /* include_once('tournament_logic.php'); */ ?>
  <div id="primary" class="content-area">
    <main id="main" class="site-main">

      <?php include_once 'tourneys_result.php'; ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php
get_footer();