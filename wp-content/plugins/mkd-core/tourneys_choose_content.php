<style>

.choose-container{
    box-shadow: rgb(0 0 0 / 16%) 0px 1px 4px;
}

.choose-container .heading h1 {
  font-size: 28px;
  font-weight: 600;
}

.choose-container .content-box .title {
  width: 100%;
}

.choose-container .content-box .title h1 {
  font-size: 24px;
  font-weight: 600;
}

.choose-container .content-box .box {
  border: 3px solid #000000;
  background-color: #ff9900;
  min-width: 300px;
  max-width: 300px;
  min-height: 200px;
  max-height: 200px;
  position: relative;
}

.choose-container .content-box .box p {
  margin: 0;
  font-weight: bold;
  color: #000000;
}

.choose-container .content-box .btn-container button {
  padding: 6px 20px;
  border-color: transparent;
  border-radius: 6px;
  font-size: 14px;
  font-weight: bold;
}

.choose-container .content-box .main-box {
  width: 100%;
}

.choose-container .content-box .main-box .box .arrow-link {
  text-decoration: none;
  color: #000000;
  cursor: pointer;
  position: absolute;
  top: calc(50% - 11px);
  display: none;
}

.choose-container .content-box .main-box .box .arrow-link i {
  font-weight: bold;
  font-size: 22px;
  pointer-events: none;
}

.choose-container .content-box .main-box.content-one .box .arrow-link {
  right: -40px;
}

.choose-container .content-box .main-box.content-two .box .arrow-link {
  left: -40px;
}

.choose-alert-wrapper {
  position: fixed;
  top: 0;
  left: 0;
  height: 100vh;
  width: 100%;
  background-color: rgba(0, 0, 0, 0.7);
  z-index: 999;
}

.choose-alert-wrapper.hidden {
  display: none;
}

.choose-alert-wrapper .alert-modal {
  background-color: #ffffff;
  border: 3px solid #000000;
  width: 350px;
  height: 200px;
  position: relative;
}

.choose-alert-wrapper .alert-modal .alert-close-icon {
  text-decoration: none;
  color: #000000;
  position: absolute;
  top: 8px;
  right: 15px;
}

.choose-alert-wrapper .alert-modal .alert-content.hidden {
  display: none;
}

.choose-alert-wrapper .alert-modal .alert-content p {
  font-weight: bold;
  font-size: 16px;
}

.choose-alert-wrapper .alert-modal .alert-content .btn-container button {
  outline: none;
  border: none;
  padding: 6px 20px;
  color: #ffffff;
  font-weight: 600;
  border-color: transparent;
  border-radius: 6px;
  font-size: 14px;
}

/* responsive  */
@media (max-width: 767px) {
  .choose-container .content-box {
    flex-direction: column;
  }
  .choose-container .content-box .title {
    justify-content: center;
  }
  .choose-container .content-box .main-box {
    margin: 0 !important;
  }
  .choose-container .content-box .main-box .box .arrow-link {
    display: block;
  }
  .choose-container .content-box .main-box.content-one.mobile-view {
    display: none;
  }
  .choose-container .content-box .main-box.content-two.mobile-view {
    display: none;
  }
}

@media (max-width: 450px) {
  .choose-container .content-box .box {
    min-width: 250px;
    max-width: 250px;
    min-height: 180px;
    max-height: 180px;
  }
  .choose-container .content-box .main-box.content-one .box .arrow-link {
    right: -30px;
  }
  .choose-container .content-box .main-box.content-two .box .arrow-link {
    left: -30px;
  }
}

</style>
<div class="container-fluid choose-container bg-light">
        <div class="choose-box px-2 py-4">
          <div class="heading mb-5">
            <h1 class="m-0 text-center">Haku Contest June 2021</h1>
          </div>
          <div class="content-box flex-css">
             
            <div
              class="main-box content-one flex-css-column mr-3"
              id="content-one"
            >
              <div class="title py-4 flex-css-start">
                <h1>Content 1</h1>
              </div>
              <div class="box flex-css">
                <div class="inner-content">
                  <p>Poem Line 1</p>
                  <p>Poem Line 2</p>
                  <p>Poem Line 3</p>
                </div>
                <a href="javascript:void(0)" class="arrow-link" id="arrow-one">
                  <i class="fas fa-arrow-right"></i>
                </a>
              </div>
              <div class="round pt-2">
                <p class="p-0">Round 1</p>
              </div>
              <div class="btn-container flex-css py-4">
                <button class="btn-success choose-content">Choose</button>
              </div>
            </div>

            <!-- two  -->
            <div
              class="main-box content-two mobile-view flex-css-column ml-3"
              id="content-two"
            >
              <div class="title py-4 flex-css-end">
                <h1>Content 2</h1>
              </div>
              <div class="box flex-css">
                <div class="inner-content">
                  <p>Haku Line 1</p>
                  <p>Haku Line 2</p>
                  <p>Haku Line 3</p>
                </div>
                <a href="javascript:void(0)" class="arrow-link" id="arrow-two">
                  <i class="fas fa-arrow-left"></i>
                </a>
              </div>
              <div class="round pt-2">
                <p class="p-0">Round 1</p>
              </div>
              <div class="btn-container flex-css py-4">
                <button class="btn-success choose-content">Choose</button>
              </div>
            </div>
          </div>
        </div>
        <div
          class="choose-alert-wrapper hidden flex-css"
          id="choose-alert-wrapper"
        >
          <div class="alert-modal px-4 py-3">
            <a
              href="javascript:void(0)"
              class="alert-close-icon"
              id="alert-close-icon"
            >
              <i class="fas fa-times"></i>
            </a>
            <div class="alert-content" id="options-alert">
              <p class="pt-4">Are you sure you choose this piece?</p>
              <div class="btn-container flex-css-row-sa pt-4">
                <button class="bg-success" id="yes-alert-btn">Yes</button>
                <button class="bg-danger" id="no-alert-btn">No</button>
              </div>
            </div>
            <div class="alert-content hidden" id="final-alert">
              <p class="text-center pt-4">Round 2 started</p>
              <div class="btn-container flex-css pt-4">
                <button class="bg-info" id="ok-alert-btn">Ok</button>
              </div>
            </div>
          </div>
        </div>
      </div>

<?php include_once 'tourneys_choose_scripts.php'; ?>
