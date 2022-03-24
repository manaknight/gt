<style>
.tour-thumb-container{
    box-shadow: rgb(0 0 0 / 16%) 0px 1px 4px;
}
.tour-thumb-container .heading h1 {
  font-size: 24px;
  font-weight: 600;
}

.tour-thumb-container .heading p {
}

.tour-thumb-container .info .info-data h1 {
  font-size: 20px;
}

.tour-thumb-container .info .info-data p {
  font-size: 18px;
}

.tour-thumb-container .info .info-data .big-text {
  font-weight: 600;
  font-size: 18px;
}

.tour-thumb-container .note p {
  text-align: justify;
}

.tour-thumb-container .thumb-content-box .title h1 {
  font-size: 24px;
  font-weight: 600;
}

.tour-thumb-container .thumb-content-box .box {
  border: 3px solid #000000;
  background-color: #ff9900;
  min-width: 300px;
  max-width: 300px;
  min-height: 200px;
  max-height: 200px;
  position: relative;
}

.tour-thumb-container .thumb-content-box .box p {
  margin: 0;
  font-weight: bold;
  color: #000000;
}

.tour-thumb-container .thumb-content-box .main-box {
  width: 100%;
}

.tour-thumb-container .thumb-icon-container a {
  text-decoration: none;
  color: #000000;
  font-size: 30px;
}

@media (max-width: 767px) {
  .tour-thumb-container .heading {
    flex-direction: column;
  }
  .tour-thumb-container .heading h1 {
    margin: 0 !important;
    margin-bottom: 5px !important;
    text-align: center;
  }
  .tour-thumb-container .heading p {
    text-align: center;
  }
  .tour-thumb-container .thumb-content-box {
    flex-direction: column;
  }
  .tour-thumb-container .thumb-content-box .title {
    justify-content: center;
  }
  .tour-thumb-container .thumb-content-box .main-box {
    margin: 0 !important;
  }
}

@media (max-width: 550px) {
  .tour-thumb-container .info {
    flex-direction: column;
  }
  .tour-thumb-container .info .info-data {
    margin: 0 !important;
    margin-bottom: 10px !important;
  }
  .tour-thumb-container .info .info-data p {
    text-align: center;
  }
  .tour-thumb-container .heading h1 {
    font-size: 20px;
  }
}

@media (max-width: 450px) {
  .tour-thumb-container .thumb-content-box .box {
    min-width: 250px;
    max-width: 250px;
    min-height: 180px;
    max-height: 180px;
  }
}

</style>
<div class="container-fluid tour-thumb-container bg-light mb-4">
        <div class="details-box px-2 py-4">
          <div class="heading flex-css mb-4">
            <h1 class="m-0 mr-3">Haku Contest June 2021</h1>
            <p class="m-0">Running for 1 day, 22 hours July 28 2021</p>
          </div>
          <div class="info-box flex-css">
            <div class="info flex-css mb-4">
              <div class="info-data">
                <h1 class="m-0">Registration ends</h1>
                <p class="m-0 text-center">34min</p>
              </div>
              <div class="info-data mx-5">
                <h1 class="m-0">Prize Pool</h1>
                <p class="m-0 big-text">$1000</p>
              </div>
              <div class="info-data">
                <h1 class="m-0">Entries</h1>
                <p class="m-0 big-text">354</p>
              </div>
            </div>
          </div>
          <div class="note mb-4">
            <p class="mb-2">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam
              officia facere delectus ut nemo dignissimos adipisci incidunt
              nulla, tenetur excepturi. Similique temporibus asperiores
              consequatur dolores nobis qui aliquid quod et? Lorem ipsum dolor
              sit amet consectetur adipisicing elit. Quam officia facere
              delectus ut nemo dignissimos adipisci incidunt nulla, tenetur
              excepturi. Similique temporibus asperiores consequatur dolores
              nobis qui aliquid quod et? Lorem ipsum dolor sit amet consectetur
              adipisicing elit. Quam officia facere delectus ut nemo dignissimos
              adipisci incidunt nulla, tenetur excepturi. Similique temporibus
              asperiores consequatur dolores nobis qui aliquid quod et? Lorem
              ipsum dolor sit amet consectetur adipisicing elit. Quam officia
              facere delectus ut nemo dignissimos adipisci incidunt nulla,
              tenetur excepturi. Similique temporibus asperiores consequatur
              dolores nobis qui aliquid quod et? Lorem ipsum dolor sit amet
              consectetur adipisicing elit. Quam officia facere delectus ut nemo
              dignissimos adipisci incidunt nulla, tenetur excepturi.
            </p>
            <p>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit.
              Aspernatur, minus? Provident quis consectetur, labore sapiente at
              laborum alias velit qui.
            </p>
          </div>
          <div class="thumb-content-box flex-css">
            <!-- one -->
            <div
              class="main-box content-one flex-css-column mr-3"
              id="content-one"
            >
              <div class="title py-4 flex-css-start">
                <h1 class="m-0">Content 1</h1>
              </div>
              <div class="box flex-css">
                <div class="inner-content">
                  <p>Poem Line 1</p>
                  <p>Poem Line 2</p>
                  <p>Poem Line 3</p>
                </div>
                <!-- <a href="javascript:void(0)" class="arrow-link" id="arrow-one">
                  <i class="fas fa-arrow-right"></i>
                </a> -->
              </div>
              <div class="thumb-icon-container py-3">
                <a href="javascript: void(0)" class="thumb-icon">
                  <i class="fas fa-thumbs-up"></i>
                </a>
              </div>
            </div>

            <!-- two  -->
            <div
              class="main-box content-two mobile-view flex-css-column ml-3"
              id="content-two"
            >
              <div class="title py-4 flex-css-end">
                <h1 class="m-0">Content 3</h1>
              </div>
              <div class="box flex-css">
                <div class="inner-content">
                  <p>Haku Line 1</p>
                  <p>Haku Line 2</p>
                  <p>Haku Line 3</p>
                </div>
                <!-- <a href="javascript:void(0)" class="arrow-link" id="arrow-two">
                  <i class="fas fa-arrow-left"></i>
                </a> -->
              </div>
              <div class="thumb-icon-container py-3">
                <a href="javascript: void(0)" class="thumb-icon">
                  <i class="fas fa-thumbs-up"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>