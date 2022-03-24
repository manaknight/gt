<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script>
    var uri_path = '<?php echo parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?>';
    var url_array = uri_path.split('/');
    var user_name = url_array[2];

      $(document).ready(function() {
        loadContests();
    }); 
    const tabs     = document.querySelectorAll(".tour-tab");
    const contents = document.querySelectorAll(".tour-category");

    // tabs
    tabs.forEach((tab) => 
    {
        tab.addEventListener("click", function (e) 
        {
            const tabID = e.target.id;
            tabs.forEach((tab) => 
            {
                tab.classList.remove("active");
            });
            e.target.classList.add("active");
            contents.forEach((content) => 
            {
                content.classList.add("hidden");
            });


            if(tabID == "schedule-tab")
            { 
                document.getElementById(`schedule-tournament`).classList.add("active_class");
                document.getElementById(`schedule-tournament`).classList.remove("hidden_class");

                document.getElementById(`my-tournament`).classList.remove("active_class");
                document.getElementById(`my-tournament`).classList.add("hidden_class");
            }

            if(tabID == "my-tab")
            {
                document.getElementById(`my-tournament`).classList.add("active_class");
                document.getElementById(`my-tournament`).classList.remove("hidden_class");

                document.getElementById(`schedule-tournament`).classList.remove("active_class");
                document.getElementById(`schedule-tournament`).classList.add("hidden_class");
            }
            document.getElementById(`${tabID}-content`).classList.remove("hidden");
        });
    });

// modal
const tourModalWrapper = document.getElementById("tour-modal-wrapper");
//const tourBtn = document.querySelectorAll(".enter-btn");
const tourCloseIcon = document.getElementById("tour-close-icon");

// modal tabs
const tourModalContent = document.querySelectorAll(".tour-modal-content");
const tourInfoContent = document.getElementById("tour-info-content");
const noPortfolioContent = document.getElementById("no-portfolio-content");
const addPortfolioContent = document.getElementById("add-portfolio-content");
const selectPreviewContent = document.getElementById("select-preview-content");
const joinBtn = document.getElementById("join-btn");
const newSubmitBtn = document.getElementById("new-submit-btn");
const previewNewSubmitBtn = document.getElementById("preview-new-submit-btn");

//color modal
const modalWrapper = document.getElementById("color-modal-wrapper");
const chooseBtn = document.getElementById("choose-btn");
const colorCloseIcon = document.getElementById("color-close-icon");
const colorTabs = document.querySelectorAll(".tab-link");
const colorContents = document.querySelectorAll(".tab-container");

// tourBtn.forEach((btn) => {
//   btn.addEventListener("click", function (e) {
//     e.preventDefault();
//     tourModalContent.forEach((modal) => {
//       modal.classList.add("hidden");
//     });
//     tourModalWrapper.classList.remove("hidden");
//   });
// });

tourCloseIcon.addEventListener("click", function (e) {
  e.preventDefault();
  tourModalWrapper.classList.add("hidden");
});


tourModalWrapper.addEventListener("click", function (e) {
  const wrapperId = e.target.id;
  if (wrapperId === "tour-modal-wrapper") {
    e.target.classList.add("hidden");
  }
});

joinBtn.addEventListener("click", function () {
  var contest_id = $('#data-contestId').val();
  console.log(contest_id);
  jQuery.ajax({
            type: "POST",
            dataType: "json",
            data: {
                "contest_id": contest_id,
                "user_name": user_name
            },
            url: "/wp-admin/admin-ajax.php?action=get_portfolios_in_contest_category",
            success: function(data) {
              data = data.data;
              if(data !== 'undefined' && data.length > 0)
              {
                append_portfolois(data);
                showSelectPreviewContent();
              }
              else
              {
                showNoPortfolioContent();
              }
            }
        });
  // showNoPortfolioContent();
  //showSelectPreviewContent();
});

newSubmitBtn.addEventListener("click", function () {
  showAddPortfolioContent();
});

previewNewSubmitBtn.addEventListener("click", function () {
  showAddPortfolioContent();
});

const showTourInfo = () => {
  tourModalContent.forEach((modal) => {
    modal.classList.add("hidden");
  });
  tourInfoContent.classList.remove("hidden");
};

const showNoPortfolioContent = () => {
  tourModalContent.forEach((modal) => {
    modal.classList.add("hidden");
  });
  noPortfolioContent.classList.remove("hidden");
};

const showAddPortfolioContent = () => {
  tourModalContent.forEach((modal) => {
    modal.classList.add("hidden");
  });
  addPortfolioContent.classList.remove("hidden");
};

const showSelectPreviewContent = () => {
  tourModalContent.forEach((modal) => {
    modal.classList.add("hidden");
  });
  selectPreviewContent.classList.remove("hidden");
};

// color modal
chooseBtn.addEventListener("click", function (e) {
  e.preventDefault();
  modalWrapper.classList.remove("hidden");
});

colorCloseIcon.addEventListener("click", function (e) {
  e.preventDefault();
  modalWrapper.classList.add("hidden");
});

modalWrapper.addEventListener("click", function (e) {
  const wrapperId = e.target.id;
  if (wrapperId === "color-modal-wrapper") {
    e.target.classList.add("hidden");
  }
});

colorTabs.forEach((tab) => {
  tab.addEventListener("click", function (e) {
    const tabID = e.target.id;
    colorTabs.forEach((tab) => {
      tab.classList.remove("active");
    });
    e.target.classList.add("active");
    colorContents.forEach((content) => {
      content.classList.add("hidden");
    });
    document.getElementById(`${tabID}-content`).classList.remove("hidden");
  });
});

    </script>


<script>
    // on reload
    //for page reload category
    function append_portfolois(data)
    {
        var html = '';
        $('#portfolio-list').empty();
        data.forEach(element => {
            var p = '';
            bg = element.image_url ? element.image_url : '#FFFFFF';

            if (bg.length > 8) {
                background = "background-image: url('" + bg + "')";

            }
            if (bg.length < 8) {
                background = "background: " + bg + "";
            }
            html += `<div class="col-lg-6 p-2 my-2 contest_portfolio" id="portfolio_` + element.id + `" onClick="select_portfolio_for_contest(` + element.id + `)">
                    <div class="list-box flex-css" style="` + background + `">
                      <div class="inner-name flex-css">
                        <i class="fas fa-user"></i>
                        <p class="pl-2">` + element.psuedoname + `</p>
                      </div>
                      <div class="text-list" style="word-break: break-all;padding: 20px;">
                        <p> `+ element.content +`</p>
                      </div>
                    </div>
                  </div>`;
        });

        $('#portfolio-list').append(html);
    }

    function select_portfolio_for_contest(id) {
        $('.contest_portfolio').removeClass('choosen-portfolio');
        $('#portfolio_'+id).addClass('choosen-portfolio');
        $('#data-portfolioId').val(id);
    }

    $('#select_portfolio').click(function(e)
    {
        portfolio_id = $('#data-portfolioId').val();
        contest_id = $('#data-contestId').val();
        clearAlert();
        if(portfolio_id == '' && contest_id == '')
        {
          $('#portfolio_error_alert').html('Select a portfolio.');
        }
        else
        {
          jQuery.ajax({
              type: "POST",
              dataType: "json",
              url: "/wp-admin/admin-ajax.php?action=update_contest_to_portfolio",
              data: {
                  "portfolio_id": portfolio_id,
                  "contest_id": contest_id
              },
              success: function(data) {
                console.log(data);
                data = data.data;
                if(data != '0')
                {
                  window.location.reload()
                  $('#portfolio_success_alert').html('Portfolio selected.');
                  $('#portfolio_success_alert').show();
                }
                else
                {
                  $('#portfolio_error_alert').html('Error Occured.');
                  $('#portfolio_error_alert').show();
                }
              }
          });
        }
    });

    $('#category').change(function() {
        loadContests();
    });

    $('#category_sch').change(function() 
    {
        getContests('all');
    });

    $('#category_my_tour').change(function() 
    {
        getContests('my');
    });
</script>

<script>
    function loadContests() 
    {
        getContests('all');
        getContests('my');
    }


    function getContests(type) 
    {
        let tab_id = 'schedule-tab-content';
        let user_id= "<?php echo get_current_user_id(); ?>";

        var cat_id = $('#category_sch').val();

        if (type == 'my') 
        {
            tab_id = 'my-tab-content'; 
            var cat_id = $('#category_my_tour').val();
        }
        
        html = '<p style="margin: 0px;padding: 17px 5px;" >Loading data please wait...</p>';
        $('#' + tab_id).removeClass('p-5');
        $('#' + tab_id).html(html);
      
        jQuery.ajax({
            type: "POST",
            dataType: "json",
            data: {
                "cat_id"        : cat_id,
                "contest_type"  : type,
                "user_id"       : user_id
            },
            url: "/wp-admin/admin-ajax.php?action=get_contests",
            success: function(data) {
                var html = '';
                data = data.data;
                console.log('contest', data);
                if(data !== 'undefined' && data.length > 0)
                {
                    data.forEach(element => {
                        if(element.contest_start === true && (element.entered_to_contest === false && type == 'my' )  ) 
                        {
                            html += '';
                        }
                        else
                        {
                            if(element.remaining_time != "Registration closed")
                            {  
                                // Set the date we're counting down to
                                var countDownDate = new Date(element.remaining_time).getTime();

                                // Update the count down every 1 second
                                var x = setInterval(function() 
                                { 
                                    // Get today's date and time
                                    var now      = new Date().getTime();

                                    // Find the distance between now and the count down date
                                    var distance = countDownDate - now;

                                    // Time calculations for days, hours, minutes and seconds
                                    var days    = Math.floor(distance / (1000 * 60 * 60 * 24));
                                    var hours   = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                    // Display the result in the element with id="demo"
                                    document.getElementById("demo_id_" + element.id).innerHTML = days + " Days " + hours + " Hours "
                                    + minutes + " Minutes " + seconds + " Seconds ";

                                      // If the count down is finished, write some text
                                    if (distance < 0) 
                                    { 
                                        document.getElementById("demo_id_" + element.id).innerHTML = "Registration closed";
                                    }
                                }, 1000);

                            }

                            html += `<div class="list-box flex-css-row-sb mb-4">
                                      <div class="left-box">
                                        <div class="image-container-tour">
                                          <img
                                            src="`+ element.url +`"
                                            alt="tour"
                                            referrerpolicy="no-referrer"
                                          />
                                          <div class="btn-container flex-css">`;
                                          if(element.contest_start === true && element.entered_to_contest === true && element.status=='1')
                                          {
                                            html += `<button class="enter-btn" id="tour-btn"><a href="/index.php/tournament-result/?contest_id=`+ element.id + `">See Winners</a></button>`;
                                          }
                                          else if(element.entered_to_contest === false && element.contest_start === false)
                                          {
                                            html += `<button class="enter-btn" id="tour-btn" onClick="displayContestById(`+ element.id +`);">Enter</button>`;
                                          }
                                          else if(element.contest_start === true && element.entered_to_contest === true) {
                                            html += `<button class="enter-btn"  id="tour-btn"><a href="/index.php/tournament/?contest_id=`+ element.id + `">Play Now</a></button>`;
                                          }
                                          else if(element.contest_start === false && element.entered_to_contest === true) {
                                            html += `<button class="enter-btn" id="tour-btn">Entered</button>`;
                                          }
                                          else {
                                            html += `<button class="enter-btn" id="tour-btn">Contest Ongoing</button>`;
                                          }
                                          running_time = element.running_time != '' ? 'Running for '+ element.running_time : '';
                                          running_time = element.status == '0' ? running_time : '';
                                    html += `</div>
                                        </div>
                                      </div>
                                      <div class="right-box px-5 py-4 flex-css">
                                        <div class="inner-box">
                                          <div class="heading mb-3">
                                            <p class="m-0">`+ element.cat_name +`</p>
                                            <h1 class="m-0 tourny-card-title">
                                              `+ element.title +`
                                              <span><i class="fas fa-info-circle"  data-toggle="tooltip" data-placement="top"   title="Title is "></i></span>
                                            </h1>

                                            <span class="m-0" style="color: #e10217;line-height:1.2em; font-size: 11px; font-family: 'Oswald', sans-serif; letter-spacing: 0.05em;  display: inline-block; position: relative;word-break: break-word;">`+ element.description +`</span>
                                          </div>
                                          <div class="info flex-css-row-start ">
                                            <div class="details">
                                              <h1 class="m-0">
                                                Registration closes
                                                <span><i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top"  title="Title is "></i></span>
                                              </h1> 
                                              <p class="reg-closes-text" id="demo_id_` + element.id + `" >`+ element.remaining_time +`</p>
                                            </div>
                                            <div class="details px-4 mx-4">
                                              <h1 class="m-0">
                                                Price Pool
                                                <span><i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Title is "></i></span>
                                              </h1>
                                              <p>`+ element.total_prize_pool +`</p>
                                            </div>
                                            <div class="details">
                                              <h1 class="m-0">
                                                Entries
                                                <span><i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Title is "></i></span>
                                              </h1>
                                              <p>`+ element.no_of_particpants +`</p>
                                            </div>
                                          </div>
                                          <div class="note pt-2">
                                            <p class="m-0">
                                               `+ running_time +`
                                            </p>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="ticket-cut"></div>
                                    </div>`;
                                  
                        }

                    });
                }
                if (html == '') 
                {
                    html = '<p style="margin: 0px;padding: 17px 5px;">No contests found.</p>';
                }else{
                    $('#' + tab_id).addClass('p-5');
                }
                $('#' + tab_id).html(html);

                $('[data-toggle="tooltip"]').tooltip()
    
            }
        });
    }



    



    //DisplayContestById
    function displayContestById(id) {
      tourModalContent.forEach((modal) => {
        modal.classList.add("hidden");
      });
        tourModalWrapper.classList.remove("hidden");
        tourInfoContent.classList.remove("hidden");
        $('#data-contestId').val(id);
        jQuery.ajax({
            type: "POST",
            dataType: "json",
            data: {
                "id": id,
            },
            url: "/wp-admin/admin-ajax.php?action=get_my_contest_by_id",
            success: function(data) {
              console.log(data);
                for (i in data) {
                    var html = '';

                    data[i].forEach(element => {

                      $('#tour-content').html('');
                      $('#tour-heading').html('');
                      $('#tour-video').html('');
                      $('#tour-content').html(element.description);
                      $('#tour-heading').html(element.title);
                      console.log(typeof element.video_url);
                      if(typeof element.video_url == 'string' && element.video_url != '')
                      {
                      $('#tour-video').append('<iframe width="400"  height="300"  src="https://www.youtube.com/embed/'+ getId(element.video_url) +'"   title="YouTube video player"  frameborder="0"   allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
                      }
                      else
                      {
                      $('#tour-video').append('');
                      }
                    });
                }
            }
        });
    }

    function getId(url) {
        const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
        const match = url.match(regExp);

        return (match && match[2].length === 11)
          ? match[2]
          : null;
    }


    // function validate() {
    //     nameREGX = "[a-zA-Z0-9]+";
    //     var title = document.getElementById('title').value;
    //     var psuedoname = document.getElementById('psuedoname').value;

    //     var titleResult = nameRGEX.test(title);
    //     var psuedonameResult = nameRGEX.test(psuedoname);
    //     if (psuedonameResult == false) {
    //         $('#PsuedonameError').innerHTML = "Please enter alphabets only! ";

    //         return false;
    //     }

    //     if (titleResult == false) {
    //         $('#TitleError').innerHTML = "Please enter alphabets only! ";
    //         return false;
    //     }

    //     return true;
    // }

    $("#portfolio-form").submit(function(event) {
        event.preventDefault();
        clearAlert();
        var buttonPress = document.getElementById('submit').innerText;
            var font_id = $("#font_id option:selected").val();
            var title = $('#title').val();

            var content = $('#contents').val();
            var color = $('#color').val().trim();
            var image = $('#image').val();
            var psuedoname = $('#psuedoname').val();
            var visibility = $("#visibility  option:selected").val();
            var contest_id = $('#data-contestId').val();
            let TitleErrorText      =(title=='')?'Title field is required':'';
            let ContentErrorText    =(content=='')?'Content field is required':'';
            let PsuedonameErrorText =(psuedoname=='')?'Writer name field is required':'';
            let FontErrorText      =(font_id=='')?'Fonts field is required':'';
            
            if(title == '' || content == '' || psuedoname == '' || font_id == '')
            {
                $('#TitleError').text(TitleErrorText);
                $('#ContentError').text(ContentErrorText);
                $('#PsuedonameError').text(PsuedonameErrorText);
                $('#FontError').text(FontErrorText);
                return false;
            }
            jQuery.ajax({
                type: "POST",
                dataType: "json",
                url: "/wp-admin/admin-ajax.php?action=save_portfolio_ticket_ajax",
                data: {
                    "title": title,
                    "content": content,
                    "psuedoname": psuedoname,
                    "font_id": font_id,
                    "visibility": visibility,
                    "image": image,
                    "color": color,
                    'contest_id': contest_id
                },
                success: function(data) {
                  window.location.reload();
                  clearValues();
                  $('#portfolio_success_alert').html('Portfolio created and added to contest.');
                  $('#portfolio_success_alert').show();
                },
                error: function(err) 
                {
                  $('#portfolio_error_alert').html('Error.');
                  $('#portfolio_error_alert').show();
                }

            });

    });

    function clearValues() {
        document.getElementById('font_id').value = '';

        document.getElementById('title').value = '';
        document.getElementById('contents').innerHTML = '';
        document.getElementById('color').value = '';
        document.getElementById('image').value = '';
        document.getElementById('psuedoname').value = '';
        document.getElementById('visibility').value = 'public';
        document.getElementById("submit").value = '';
        document.getElementById("submit").innerText = 'Publish';
        document.getElementById("form_heading").innerText = 'Add Portfolio';

        document.getElementById('font_id').value = '';
        $('.image-container').hide();
        $('.color-container').hide();

    }

    function clearAlert()
    {      
      $('#portfolio_error_alert').empty();
      $('#portfolio_success_alert').empty();
      $('#portfolio_error_alert').hide();
      $('#portfolio_success_alert').hide();
    }

    
</script>