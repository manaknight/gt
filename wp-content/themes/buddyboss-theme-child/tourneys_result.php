<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/sanjaya007/flex-library@master/dist/css/sanjaya.min.css" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<style>

.tour-result-container{
    box-shadow: rgb(0 0 0 / 16%) 0px 1px 4px;
}

.tour-result-container .heading h1 {
  font-size: 24px;
  font-weight: 600;
}

.tour-result-container .heading p {
}

.tour-result-container .info .info-data h1 {
  font-size: 20px;
}

.tour-result-container .info .info-data p {
  font-size: 18px;
}

.tour-result-container .info .info-data .big-text {
  font-weight: 600;
  font-size: 18px;
}

.tour-result-container .note p {
  text-align: justify;
}

.tour-result-container .final-content-box .title h1 {
  font-size: 24px;
  font-weight: 600;
}

.tour-result-container .final-content-box .box {
  border: 3px solid #000000;
  background-color: #ff9900;
  min-width: 200px;
  max-width: 200px;
  min-height: 150px;
  max-height: 150px;
  position: relative;
}

.tour-result-container .final-content-box .box p {
  margin: 0;
  font-weight: bold;
  color: #000000;
}

.tour-result-container .btn-container button {
  padding: 6px 20px;
  border-color: transparent;
  border-radius: 6px;
  font-size: 14px;
  font-weight: bold;
}

.tour-result-container .winner-note h1 {
  font-size: 26px;
  text-align: center;
  color: #000000;
}

</style>

<?php
/*
 Template Name: Tournament Result
 */

get_header();
?>
  <div id="primary" class="content-area">
    <main id="main" class="site-main">

      <?php include_once 'tourneys_result_script.php'; ?>
      <div class="container-fluid tour-result-container bg-light mb-4" id="tour_result">
        <div class="details-box px-2 py-4">
          <div class="heading flex-css mb-4">
            <h1 class="m-0 mr-3 contest-title"></h1>
            <p class="m-0" id="remaining_time">Running for </p>
          </div>
          <div class="info-box flex-css">
            <div class="info flex-css mb-4">
              <div class="info-data mx-5">
                <h1 class="m-0">Prize Pool</h1>
                <p class="m-0 big-text" id="prize-pool"></p>
              </div>
              <div class="info-data">
                <h1 class="m-0">Entries</h1>
                <p class="m-0 big-text" id="participants"></p>
              </div>
            </div>
          </div>
          <div class="result-content flex-css" id="winner_1"></div>
          <div class="row p-0 w-100 m-0 py-4" id="winner_data"></div>
          <div class="result-content flex-css" id="winner_draw"></div>
          <div class="winner-note py-4">
            <h1 class="m-0">
              Congratulate <span id="winner_name"></span> for winning the whole contest
              !
            </h1>
          </div>
          <div class="btn-container flex-css pb-4">
            <a href="<?php echo site_url(); ?>" class="btn-info">Back to Lobby</a>
          </div>
        </div>
      </div>

      <div class="container-fluid tour-result-container bg-light p-5" id="tour_no_result" style="display: none;">
        <h1>No matching contest found.</h1>
      </div>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php
get_footer();