
<style>

.tour-details-container{
    box-shadow: rgb(0 0 0 / 16%) 0px 1px 4px;
}

.tour-details-container .heading h1 {
  font-size: 24px;
  font-weight: 600;
}

.tour-details-container .heading p {
}

.tour-details-container .info .info-data h1 {
  font-size: 20px;
}

.tour-details-container .info .info-data p {
  font-size: 18px;
}

.tour-details-container .info .info-data .big-text {
  font-weight: 600;
  font-size: 18px;
}

.tour-details-container .note p {
  text-align: justify;
}

.tour-details-container .video-player iframe {
  border: none;
}

.tour-details-container .btn-container button {
  outline: none;
  border: none;
  padding: 7px 25px;
  color: #ffffff;
  border-radius: 6px;
  border-color: transparent;
  font-weight: 600;
}

@media (max-width: 767px) {
  .tour-details-container .heading {
    flex-direction: column;
  }
  .tour-details-container .heading h1 {
    margin: 0 !important;
    margin-bottom: 5px !important;
    text-align: center;
  }
  .tour-details-container .heading p {
    text-align: center;
  }
}

@media (max-width: 550px) {
  .tour-details-container .info {
    flex-direction: column;
  }
  .tour-details-container .info .info-data {
    margin: 0 !important;
    margin-bottom: 10px !important;
  }
  .tour-details-container .info .info-data p {
    text-align: center;
  }
  .tour-details-container .heading h1 {
    font-size: 20px;
  }
}

@media (max-width: 450px) {
  .tour-details-container .video-player iframe {
    width: 400px;
    height: 300px;
  }
}

@media (max-width: 350px) {
  .tour-details-container .video-player iframe {
    width: 300px;
    height: 200px;
  }
}

</style>

<div class="container-fluid tour-details-container bg-light mb-4">
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
          <div class="video-player fitvidsignore flex-css py-4">
                  <iframe width="450" height="340" src="https://www.youtube.com/embed/tgbNymZ7vqY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
          </div>
          <div class="btn-container flex-css py-4">
            <button class="btn-info">Judging Other Work</button>
          </div>
        </div>
      </div>