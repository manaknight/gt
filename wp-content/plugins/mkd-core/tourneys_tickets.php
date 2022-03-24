
<?php include_once 'tourneys_code_add.php'; ?>
<!-- link -->
<link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
      integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
<link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/gh/sanjaya007/flex-library@master/dist/css/sanjaya.min.css"
      crossorigin="anonymous"
    />

<style>
@import url("https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap");

.hidden_class{
    display: none;
}
.active_class{
    display: block;
}
.choosen-portfolio {
  border: 2px solid #000000 !important;
  transform: scale(0.9);
}
.tourneys-main-container {
  background-color: rgb(254, 254, 254);
  box-shadow: rgb(0 0 0 / 16%) 0px 1px 4px;
}

.tourneys-main-container .tour-tabs-box {
  margin-bottom: -1px;
}

.tourneys-main-container .tour-tabs-box .tour-tab {
  color: #000000;
  text-decoration: none;
  padding: 10px 20px;
}

.tourneys-main-container .tour-tabs-box .tour-tab.active {
  background-color: #ffffff;
  border-radius: 6px 6px 0 0;
  border: 1px solid #e3e3e3;
  border-bottom: 1px solid #ffffff;
}

.tourneys-main-container .tours-list-container {
  border-top: 1px solid #e3e3e3;
}

.tourneys-main-container .tours-list-container .tour-list-box {
  background-color: #ffffff;
  border: 1px solid #e3e3e3;
}

.tourneys-main-container .tours-list-container .tour-list-box .list-box {
  border: 1px solid #e3e3e3;
  background-color: #000000;
  border-radius: 10px;
  position: relative;
}

.tourneys-main-container
  .tours-list-container
  .tour-list-box
  .list-box
  .ticket-cut {
  height: 40px;
  width: 40px;
  background-color: #ffffff;
  position: absolute;
  top: 0;
  right: 0;
  border-radius: 50%;
  top: calc(45% - 20px);
  right: -20px;
}

.tourneys-main-container
  .tours-list-container
  .tour-list-box
  .tour-category.hidden {
  display: none;
}

.tourneys-main-container
  .tours-list-container
  .tour-list-box
  .list-box
  .left-box {
  /* border-right: 1px solid #cdcdcd; */
}

.tourneys-main-container
  .tours-list-container
  .tour-list-box
  .list-box
  .left-box
  .image-container-tour {
  height: 250px;
  width: 250px;
  position: relative;
  border-radius: 10px 0 0 10px;
}

.tourneys-main-container
  .tours-list-container
  .tour-list-box
  .list-box
  .left-box
  .image-container-tour
  img {
  height: 100%;
  width: 100%;
  object-fit: cover;
  border-radius: inherit;
}

.tourneys-main-container
  .tours-list-container
  .tour-list-box
  .list-box
  .left-box
  .btn-container {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  background-color: rgba(0, 0, 0, 0.3);
  border-radius: inherit;
}

.tourneys-main-container
  .tours-list-container
  .tour-list-box
  .list-box
  .left-box
  .btn-container
  .enter-btn {
  padding: 2px 25px;
  border-color: transparent;
  font-size: 14px;
  background-color: #000000;
  color: #e10217;
  font-weight: bold;
  text-transform: uppercase;
  cursor: pointer;
  font-family: "Oswald", sans-serif;
  letter-spacing: 0.1em;
  border-radius: 4px !important;
  border: none;
  outline: none;
}

.tourneys-main-container
  .tours-list-container
  .tour-list-box
  .list-box
  .right-box {
  width: 100%;
}

.tourneys-main-container
  .tours-list-container
  .tour-list-box
  .list-box
  .right-box
  .heading
  p {
  color: #e10217;
  font-size: 12px;
  font-family: "Oswald", sans-serif;
  letter-spacing: 0.05em;
  display: inline-block;
  position: relative;
}

.tourneys-main-container
  .tours-list-container
  .tour-list-box
  .list-box
  .right-box
  .heading
  p:after {
  content: "";
  position: absolute;
  height: 1px;
  width: 70px;
  background-color: #e10217c9;
  bottom: calc(50% - 2px);
  right: -75px;
}

.tourneys-main-container
  .tours-list-container
  .tour-list-box
  .list-box
  .right-box
  .heading
  h1 {
  color: #f1f1f1;
  font-size: 22px;
  text-transform: uppercase;
  font-family: "Oswald", sans-serif;
  line-height: 0.5;
}

.tourneys-main-container
  .tours-list-container
  .tour-list-box
  .list-box
  .right-box
  .heading
  h1
  span
  i {
  font-size: 18px;
}

.tourneys-main-container
  .tours-list-container
  .tour-list-box
  .list-box
  .right-box
  .info
  h1 {
  color: #f1f1f1;
  font-size: 14px;
  font-family: "Oswald", sans-serif;
}

.tourneys-main-container
  .tours-list-container
  .tour-list-box
  .list-box
  .right-box
  .info
  p {
  color: #f1f1f1;
  font-size: 12px;
  font-family: "Oswald", sans-serif;
  margin: 0;
}

.tourneys-main-container
  .tours-list-container
  .tour-list-box
  .list-box
  .right-box
  .info
  .reg-closes-text {
  text-align: center;
  box-shadow: 0 0 20px #e10217ad;
  padding: 5px !important;
}

.tourneys-main-container
  .tours-list-container
  .tour-list-box
  .list-box
  .right-box
  .note
  p {
    display: none;
  color: #f1f1f1;
  font-size: 12px;
  font-family: "Oswald", sans-serif;
}

.tour-modal-wrapper {
  position: fixed;
  top: 0;
  left: 0;
  height: 100vh;
  width: 100%;
  background-color: rgba(0, 0, 0, 0.7);
  z-index: 888;
}

.tour-modal-wrapper.hidden {
  display: none;
}

.tour-modal .tour-close-icon {
  color: #000000;
  text-decoration: none;
  position: absolute;
  top: 5px;
  right: 16px;
}

.tour-modal {
  /* background-color: #ffffff; */
  width: 70%;
  position: relative;
}

.tour-modal h1 {
  font-size: 22px;
}

.tour-modal .tour-modal-content {
  max-height: 50vh;
  overflow-y: auto;
}

.tour-modal .tour-modal-content.hidden {
  display: none;
}

.tour-modal .tour-modal-content p {
  font-size: 14px;
  text-align: justify;
  word-break: break-word;
}

.tour-modal .tour-modal-content .video-player iframe {
  border: none;
}

.tour-modal .tour-modal-content .btn-container .join-btn {
  border-radius: 3px;
  padding: 5px 25px;
  border-color: transparent;
  font-weight: 600;
  font-size: 14px;
}

.modal-form-container {
  background-color: rgb(254, 254, 254);
  border: 1px solid #e6e6e6;
  box-shadow: rgb(0 0 0 / 16%) 0px 1px 4px;
  padding: 0;
}

.modal-form-container .form-container .form-heading {
  border: 1px solid #d9d9d9;
}

.modal-form-container .form-container .form-heading h1 {
  font-size: 18px;
}

.modal-form-container .form-container .inputs-container .choose-btn {
  border-radius: 3px;
  padding: 7px 25px;
  border-color: transparent;
  font-size: 14px;
  color: #ffffff;
  font-weight: 600;
  cursor: pointer;
}

.modal-form-container
  .form-container
  .inputs-container
  .btn-list-container
  button {
  border-radius: 3px;
  padding: 7px 25px;
  border-color: transparent;
  font-size: 14px;
  color: #ffffff;
  font-weight: 600;
  cursor: pointer;
}

.modal-form-container .form-container .inputs-container .public-input {
  min-width: 100px;
}

.modal-preview-container .preview-list .list-box {
  background-color: #f8c76e;
  min-height: 300px;
  max-height: 300px;
  overflow: auto;
}
.modal-preview-container .preview-list .list-box.flex-css{
  display: grid !important;
  place-content: center;
}

.modal-preview-main-container .btn-list-container button {
  border-radius: 3px;
  padding: 7px 25px;
  border-color: transparent;
  font-size: 14px;
  color: #ffffff;
  font-weight: 600;
  cursor: pointer;
}

.modal-preview-container .preview-list .list-box .text-list p {
  margin: 0;
  color: #000000;
  font-size: 16px;
  font-weight: bold;
}

.modal-preview-container .preview-list .list-box {
  position: relative;
  cursor: pointer;
}

.modal-preview-container .preview-list .list-box .inner-name {
  position: absolute;
  left: 10px;
  top: 5px;
  display: none;
}

.modal-preview-container .preview-list .list-box .inner-name i {
  color: #000000;
}

.modal-preview-container .preview-list .list-box .inner-name p {
  color: #000000;
  font-size: 14px;
  margin: 0;
  font-weight: bold;
}

.modal-preview-container .preview-list .list-box:hover .inner-name {
  display: flex;
}

.color-modal-wrapper {
  position: fixed;
  top: 0;
  left: 0;
  height: 100vh;
  width: 100%;
  background-color: rgba(0, 0, 0, 1);
  z-index: 999;
}

.color-modal-wrapper.hidden {
  display: none;
}

.color-modal {
  background-color: #ffffff;
  width: 70%;
  position: relative;
}

.color-modal .close-icon {
  text-decoration: none;
  color: #000000;
  position: absolute;
  top: 10px;
  right: 24px;
}

.color-modal .inner-modal {
  /* min-height: 50vh; */
  border: 1px solid #c9c9c9;
}
.color-modal .modal-tabs {
  margin-bottom: -1px;
}

.color-modal .modal-tabs .tab-link {
  text-decoration: none;
  color: #000000;
  padding: 5px 15px;
}

.color-modal .modal-tabs .tab-link.active {
  background-color: #ffffff;
  border-radius: 6px 6px 0 0;
  border: 1px solid #c9c9c9;
  border-bottom: 1px solid #ffffff;
}

.color-modal .inner-modal .tab-container.hidden {
  display: none;
}


#palette{
        overflow-y: auto;
    }

    .modal-img-container{
        min-height: 42vh;
        max-height: 42vh;
        overflow-y: auto;
    }

#palette li {
  min-height: 40px;
  max-height: 40px;
  min-width: 40px;
  max-width: 40px;
  list-style-type: none;
  margin: 1px;
  cursor: pointer;
}

#palette li.active {
  border: 2px solid #000000 !important;
  opacity: 0.7;
  transform: scale(0.9);
}

.form-preview-container {
  min-height: 70px;
  max-height: 70px;
  min-width: 70px;
  max-width: 70px;
  margin-top: 10px;
  height: 70px;
  width: 70px;
}

.form-preview-container img {
  height: 100%;
  width: 100%;
  object-fit: cover;
}

.modal-img {
  position: relative;
}

.modal-img-list {
  position: absolute;
  height: 100%;
  width: 100%;
  top: 0;
  left: 0;
  background-color: rgba(0, 0, 0, 0.4);
}

.modal-img-list.hidden {
  display: none;
}

.modal-img-list i {
  color: #ffffff;
  position: absolute;
  top: 5px;
  right: 5px;
}

#select_image {
  border-radius: 3px;
  padding: 7px 25px;
  border-color: transparent;
}

#select_color {
  border-radius: 3px;
  padding: 7px 25px;
  border-color: transparent;
}

/* responsive */
@media (max-width: 1497px){
        #palette{
        min-height: 33vh;
        max-height: 33vh;
        overflow-y: auto;
    }
  }

@media (max-width: 880px){
  .tourneys-main-container .tours-list-container .tour-list-box .list-box{
    flex-direction: column;
  }
  .tourneys-main-container .tours-list-container .tour-list-box .list-box .left-box{
    margin-bottom: 20px;
  }
}


@media (max-width: 767px) {
  .tour-modal {
    width: 80%;
  }
  .color-modal {
    width: 80%;
  }
}

@media (max-width: 880px){
  .tourneys-main-container .tours-list-container .tour-list-box .list-box .left-box .image-container-tour{
    border-radius: 10px 10px 0 0;
  }
  .tourneys-main-container .tours-list-container .tour-list-box .list-box .right-box .info{
    flex-direction: column;
    align-items: flex-start;
  }
  .tourneys-main-container .tours-list-container .tour-list-box .list-box .right-box .heading{
    margin-bottom: 20px !important
  }
  .tourneys-main-container .tours-list-container .tour-list-box .list-box .right-box .info .details{
    padding: 0 !important;
    margin: 0 !important;
    margin-bottom: 20px !important;
  }
}

@media (max-width: 550px) {
  .tourneys-main-container .tours-list-container .tour-list-box .list-box .right-box .heading h1 {
    font-size: 20px;
    line-height: 1.2;
  }
  .tour-modal {
    width: 90%;
  }
  .color-modal {
    width: 90%;
  }
  .modal-form-container label {
    font-size: 14px;
  }
  .modal-form-container .form-control {
    font-size: 14px;
  }
  .modal-form-container .form-container .inputs-container .choose-btn {
    font-size: 12px;
    padding: 5px 20px !important;
  }
  .modal-form-container
    .form-container
    .inputs-container
    .btn-list-container
    button {
    font-size: 12px;
    padding: 5px 20px !important;
  }
  .modal-preview-main-container .btn-list-container button {
    font-size: 12px;
    padding: 5px 20px !important;
  }
  .tourneys-main-container .tours-list-container .tour-list-box{
    padding: 1.5rem !important;
  }
}

@media (max-width: 450px) {
  .tour-modal {
    width: 95%;
  }
  .color-modal {
    width: 95%;
  }
  .modal-preview-container .preview-list .list-box {
    min-height: 340px;
  }
  .modal-form-container .form-container .inputs-container .choose-btn {
    font-size: 10px;
    padding: 5px 12px !important;
  }
  .modal-form-container
    .form-container
    .inputs-container
    .btn-list-container
    button {
    font-size: 10px;
    padding: 5px 12px !important;
  }
  .modal-preview-main-container .btn-list-container button {
    font-size: 10px;
    padding: 5px 12px !important;
  }
  #palette li{
        min-height: 30px;
        max-height: 30px;
        min-width: 30px;
        max-width: 30px;
        }
}

@media (max-width: 374px) {
  .tourneys-main-container .tours-list-container .tour-list-box .list-box .left-box .image-container-tour{
    width: 100%;
  }
}

@media (max-width: 370px) {
  .tour-modal .tour-modal-content .video-player iframe {
    width: 250px;
    height: 200px;
  }
  .tour-modal .tour-modal-content p br {
    display: none;
  }
  .tournment-label {
    font-size:17px ;
  }
}
@media (max-width: 350px) {
  .tourneys-main-container .tour-tabs-box .tour-tab {
    padding: 10px 15px;
  }
  .tournment-label {
    font-size:14px !important;
  }
}

/*haider's css starts here*/
.tourneys-main-container .tours-list-container .tour-list-box{
  padding: 0 24px !important;
}
#schedule-tab-content{
  padding: 24px 1px !important;
}
#schedule-tab-content .right-box .inner-box{
  width: 100%;
}
#schedule-tab-content div:last-child {
    margin-bottom: 0px !important;
}
#schedule-tournament .tournment-label{
  margin-right: 5px !important;
  line-height: 16px;
}
#schedule-tournament #category_sch{
  padding: 0px 5px;
  width: 52px !important;
}
#my-tab-content{
  padding: 24px 1px !important;
}
#my-tab-content .right-box .inner-box{
  width: 100%;
  overflow: hidden !important;
}
#my-tab-content div:last-child {
  margin-bottom: 0px !important;
}
#my-tournament #category_my_tour{
  padding: 0px 5px;
  width: 52px !important;
}
#my-tournament .tournment-label{
  margin-right: 5px !important;
  line-height: 16px;
}
#my-tab-content .tourneys-main-container .tours-list-container .tour-list-box .list-box .left-box{
  padding: 0px;
  width: 100%;
}
#my-tab-content .tourneys-main-container .tours-list-container .tour-list-box .list-box .right-box{
  padding: 24px 28px !important;
}
.filter-container{
  text-align: center;
}


@media (max-width: 320px) {
  #schedule-tab-content .right-box{
    padding: 28px 35px !important;
  }
  .bp-personal-tab{
    padding: 0px 20px 0px 0px !important;
    width: 105px;
  }
}

/*haider's css ends here*/
</style>

<div class="container-fluid tourneys-main-container bg-light px-3 py-5">
        <div class="tour-tabs-box flex-css-row-start">
          <a href="javascript:void(0)" class="tour-tab active" id="schedule-tab"
            >Scheduled Tournament</a
          >
          <a href="javascript:void(0)" class="tour-tab" id="my-tab">My Tournaments</a>
        </div>
        <div class="tours-list-container">
            <div class="filter-container py-4">
                <div class="form-group flex-css " id="schedule-tournament">
                    <label for="" class="m-0 mr-3 tournment-label ">Filter Scheduled Tournaments</label>
                    <?php echo getCategoryV2(); ?>
                </div>

                <div class="form-group flex-css  hidden_class" id="my-tournament">
                    <label for="" class="m-0 mr-3 tournment-label">Filter My Tournaments</label>
                    <?php echo getCategoryTournament(); ?>
                </div>
            </div>
            <div class="tour-list-box ">
                <div class="tour-category tour-padding" id="schedule-tab-content">
                </div>
                <div class="tour-category hidden" id="my-tab-content">
                </div>
             </div>
        </div>
      </div>

      <div class="tour-modal-wrapper hidden flex-css" id="tour-modal-wrapper">
        <input type="hidden" id="data-contestId" value="">
        <input type="hidden" id="data-portfolioId" value="">
      <div class="tour-modal bg-light p-4">
        <a
          href="javascript:void(0)"
          class="tour-close-icon"
          id="tour-close-icon"
        >
          <i class="fas fa-times"></i>
        </a>
        <h1 id="tour-heading"></h1>        
        <span class="text-danger" id="portfolio_error_alert" style="display: none;"></span>
        <span class="text-success" id="portfolio_success_alert" style="display: none;"></span>
        <div class="tour-modal-content" id="tour-info-content">
          <p id="tour-content">
          </p>
          <div class="video-player fitvidsignore flex-css py-2" id="tour-video">
          
          </div>
          <div class="btn-container flex-css pt-4">
            <button class="join-btn btn-success" id="join-btn">Join Contest</button>
          </div>
        </div>
        <div class="tour-modal-content hidden" id="no-portfolio-content">
          <p class="pt-3">
            Oops! looks like you don’t have anything <br />
            available in this category. Please create a new <br />
            work and submit it. Thanks!
          </p>
          <div class="btn-container flex-css pt-4">
            <button class="join-btn btn-info" id="new-submit-btn">
              Submit New
            </button>
          </div>
        </div>
        <div class="tour-modal-content hidden" id="add-portfolio-content">
          <p>
            Thanks for joining the contest. Please submit a work for this
            category
          </p>
          <div class="container-fluid modal-form-container p-0">
            <form class="form-container" enctype="multipart/form-data" name="portfolioForm" id="portfolio-form">
              <div class="form-heading bg-light px-3 py-2">
                <h1 class="m-0" id="form_heading">Add Portfolio</h1>
              </div>
              <div class="inputs-container px-3">
                <div class="row">
                  <div class="col-lg-7">
                    <div class="form-group my-2">
                      <label for="title">Title <span class="text-danger">*</span></label>
                      <input
                        name="title"
                        type="text"
                        class="form-control"
                        id="title"
                      />
                      <small
                        id="TitleError"
                        class="form-text text-danger"
                      ></small>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-7">
                    <div class="form-group my-2">
                      <label for="exampleFormControlTextarea1"
                        >Your Content <span class="text-danger">*</span></label
                      >
                      <textarea
                        name="content"
                        class="form-control"
                        id="contents"
                        rows="4"
                      ></textarea>
                      <small id="ContentError" class="form-text text-danger"></small>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-7">
                    <div class="form-group my-2">
                      <label for="title">Writer name <span class="text-danger">*</span></label>
                      <input
                        type="text"
                        class="form-control"
                        name="psuedoname"
                        id="psuedoname"
                      />
                      <small id="PsuedonameError" class="form-text text-danger"></small>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-7">
                    <div class="form-group my-2">
                      <label for="exampleFormControlSelect1">Fonts <span class="text-danger">*</span></label>
                      <?php
                            echo getFonts();
                        ?>
                      <small id="FontError" class="form-text text-danger"></small>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-7">
                    <div class="form-group my-2">
                      <label for="exampleFormControlSelect1"
                        >Premade Background</label
                      >
                      <br />
                      <button class="bg-info choose-btn" id="choose-btn">
                        Choose
                      </button>
                      <button
                        class="bg-danger choose-btn"
                        id="remove-background"
                      >
                        Remove
                      </button>
                      <div class="background-preview">
                        <div
                          class="image-container form-preview-container"
                          style="display: none"
                        >
                          <img id="bg-image" src="" alt="" />
                        </div>
                        <div
                          class="color-container form-preview-container"
                          style="display: none"
                        ></div>
                      </div>
                      <input type="hidden" name="color" id="color" />
                      <input type="hidden" name="image" id="image" />
                    </div>
                  </div>
                </div>

                <div class="last-input flex-css-row-sb">
                  <div class="form-group my-2">
                    <label for="exampleFormControlSelect1">Visibility <span class="text-danger">*</span></label>
                    <select
                      class="form-control public-input"
                      name="visibility"
                      id="visibility"
                    >
                      <option value="public">Public</option>
                      <option value="private">Private</option>
                    </select>
                  </div>
                </div>

                <div class="btn-list-container flex-css-row-start py-4">
                  <button type="submit" id="submit" name="submit" value="submit" class="btn-info mr-2">Submit New</button>
                  <button class="bg-danger">Cancel</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="tour-modal-content hidden" id="select-preview-content">
          <p>
            Thanks for joining the contest. Please submit a work for this
            category
          </p>
          <div class="container-fluid modal-preview-main-container p-0">
            <div class="modal-preview-container">
              <div class="preview-list">
                <div class="row p-0 w-100" id="portfolio-list">
                  <div class="col-lg-6 p-2 my-2">
                    <div class="list-box flex-css">
                      <div class="inner-name flex-css">
                        <i class="fas fa-user"></i>
                        <p class="pl-2">Sanjaya Paudel</p>
                      </div>
                      <div class="text-list">
                        <p>Poem</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 p-2 my-2">
                    <div class="list-box flex-css">
                      <div class="inner-name flex-css">
                        <i class="fas fa-user"></i>
                        <p class="pl-2">Sanjaya Paudel</p>
                      </div>
                      <div class="text-list">
                        <p>Poem</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="btn-list-container flex-css-row-start py-4">
              <button class="btn-info" id="preview-new-submit-btn">
                Add New
              </button>
              <button class="bg-success mx-2" id="select_portfolio">Submit</button> 
            </div>
          </div>
        </div>
      </div>
      <div class="color-modal-wrapper hidden flex-css" id="color-modal-wrapper">
        <div class="color-modal p-4">
          <a href="javascript:void(0)" class="close-icon" id="color-close-icon">
            <i class="fas fa-times"></i>
          </a>
          <div class="modal-tabs flex-css">
            <a href="javascript:void(0)" class="tab-link active" id="color-tab"
              >Color</a
            >
            <a href="javascript:void(0)" class="tab-link" id="images-tab"
              >Images</a
            >
          </div>
          <div class="inner-modal p-3">
            <div class="tab-container" id="color-tab-content">
              Name: <span id="name"></span>&emsp;Hex: <span id="hex"></span>
              <ul
                id="palette"
                class="flex-css-row-start-wrap m-0 my-4"
              ></ul>
              <button class="btn btn-info" id="select_color">Select</button>
              <input type="hidden" name="hex_color" id="hex_color" />
            </div>
            <div class="tab-container hidden" id="images-tab-content">
              <div
                class="modal-img-container"
              >
                <?php
                    echo getBackgroundImages();
                    ?>
              </div>
              <button class="btn btn-info" id="select_image">Select</button>
              <input type="hidden" name="bg_image" id="bg_image" />
            </div>
          </div>
        </div>
      </div>
    </div>


<?php include_once 'tourneys_tickets_script.php'; ?>
<?php include_once 'color_image_modal.php'; ?>