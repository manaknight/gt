<script>

  let contest_id = findGetParameter('contest_id');
  function findGetParameter(parameterName) {
      var result = null,
          tmp = [];
      location.search
          .substr(1)
          .split("&")
          .forEach(function (item) {
            tmp = item.split("=");
            if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
          });
      return result;
  }

  function run_tournament_cronjob() {
      jQuery.ajax({
          type: "POST",
          dataType: "json",
          data: {
              "contest_id": contest_id
          },
          url: "/wp-admin/admin-ajax.php?action=run_tournament_cronjob",
          before: function () {
              $('#error-box').append("<p>Please wait data is loading...</p>");
              jQuery("#tour_game").css('opacity', '0.5');
          },
          success: function (data) {

          },
          complete: function () {
              jQuery("#tour_game").css('opacity', '1');
              get_contest_by_id();
          }
      });
  }

  function get_contest_by_id() {
      jQuery.ajax({
          type: "POST",
          dataType: "json",
          data: {
              "contest_id": contest_id
          },
          url: "/wp-admin/admin-ajax.php?action=get_contest_by_id",
          success: function(data)
          {
              data = data.data;
              if(data !== 'undefined' && data.length > 0)
              {
                  $('.choose-box').hide();
                  $('.contest-title').show();
                  $('.contest-title').empty();
                  $('.contest-title').append(data[0].title+ ' ( Round '+ data[0].contest_level + ' )');


                  jQuery.ajax({
                      type: "POST",
                      dataType: "json",
                      data: {
                          "contest_id": contest_id
                      },
                      url: "/wp-admin/admin-ajax.php?action=get_portfolios_for_game",
                      success: function(data)
                      {
                          response = data.data;
                          if(data.success === true)
                          {
                              $('#error-box').html("");
                              append_portfolois(response);
                              $('.choose-box').show();
                          }
                          else
                          {
                              $('#error-box').html("");
                              $('.choose-box').hide();
                              $('#content-box').hide();
                              $('#error-box').addClass('p-2');
                              $('#error-box').show();
                              $('#error-box').append(response);
                          }
                      }
                  });
              }
              else
              {
                  $('#error-box').html("<p>No Contest found.</p>");
                  console.log('No Contest found.');
              }
          }
      });
  }

  function append_portfolois(data)
  {
      var html = '';
      $('#content-box').empty();
      count = 1;
      data.forEach(element => {
          var p = '';
          bg = element.image_url ? element.image_url : '#FFFFFF';

          if (bg.length > 8) {
              background = "background-image: url('" + bg + "')";

          }
          if (bg.length < 8) {
              background = "background: " + bg + "";
          }
          if(data.length == 2)
          {
              $('#content-id').val('0');
          }
          if(count === 1)
          {
              html += `<div
                    class="main-box content-one flex-css-column mr-3"
                    id="content-one"
                  >
                    <div class="title py-4 flex-css">
                      <h1>Content 1</h1>
                    </div>
                    <div class="box flex-css" style="` + background + `">
                      <div class="inner-content">
                        <p>`+ element.content +`</p>
                      </div>
                      <a href="javascript:void(0)" class="arrow-link" id="arrow-one">
                        <i class="fas fa-arrow-right"></i>
                      </a>
                    </div>
                    <div class="round pt-2">
                      <p class="p-0 round_number">Round 1</p>
                    </div>
                    <div class="btn-container flex-css py-4">
                      <button class="btn-success choose-content" id="data-one" data-pcid="`+ element.pc_id +`" data-id="1">Choose</button>
                      <h1 class="text-success winner" style="display:none;text-decoration:underline;">Winner</h1>
                    </div>
                  </div>`;
          }
          else if(count === 2)
          {
              html += `<div
                    class="main-box content-two mobile-view flex-css-column mr-3"
                    id="content-two"
                  >
                    <div class="title py-4 flex-css">
                      <h1>Content 2</h1>
                    </div>
                    <div class="box flex-css" style="` + background + `">
                      <div class="inner-content">
                        <p>`+ element.content +`</p>
                      </div>
                      <a href="javascript:void(0)" class="arrow-link" id="arrow-two">
                        <i class="fas fa-arrow-left"></i>
                      </a>
                    </div>
                    <div class="round pt-2">
                      <p class="p-0 round_number">Round 1</p>
                    </div>
                    <div class="btn-container flex-css py-4">
                      <button class="btn-success choose-content" id="data-two" data-pcid="`+ element.pc_id +`" data-id="2">Choose</button>
                      <h1 class="text-success winner" style="display:none;text-decoration:underline;">Winner</h1>
                    </div>
                  </div>`;
          }
          else if(count === 3)
          {
              $('#content-id').val(element.pc_id);
          }
          else
          {
              return false;
          }
          count = count+1
      });

      $('#content-box').append(html);
      choose_option();
      next_arrow();
  }

  $(document).ready(function() {
        run_tournament_cronjob();
  });
const contentBox = document.getElementById("content-box");
const contentArrows = document.querySelectorAll(".arrow-link");
//console.log(contentArrows);

// modal
const alertWrapper = document.getElementById("choose-alert-wrapper");
const alertContent = document.querySelectorAll(".alert-content");
const alertClose = document.getElementById("alert-close-icon");
const yesAlert = document.getElementById("yes-alert-btn");
const noAlert = document.getElementById("no-alert-btn");
const okAlert = document.getElementById("ok-alert-btn");

function declare_variable()
{
  const contentOne = document.getElementById("content-one");
  const contentTwo = document.getElementById("content-two");
}
declare_variable();

function next_arrow()
{
  document.querySelectorAll(".arrow-link").forEach((arrow) => {
    arrow.addEventListener("click", function (e) {
      e.preventDefault();
      console.log('here');
      const arrowID = e.target.id;
      if (arrowID === "arrow-one") {
        document.getElementById("content-one").classList.add("mobile-view");
        document.getElementById("content-two").classList.remove("mobile-view");
      } else {
        document.getElementById("content-two").classList.add("mobile-view");
        document.getElementById("content-one").classList.remove("mobile-view");
      }
    });
  });
}

// modal
function choose_option()
{
const chooseContent = document.querySelectorAll(".choose-content");
  chooseContent.forEach((btn) => {
    btn.addEventListener("click", function (e) {
      const dataId = e.target.getAttribute('data-id');
      yesAlert.setAttribute('data-id', dataId);
      alertWrapper.classList.remove("hidden");
    });
  });
}
choose_option();
alertClose.addEventListener("click", function (e) {
  e.preventDefault();
  alertWrapper.classList.add("hidden");
  alertContent.forEach((content) => {
    content.classList.add("hidden");
  });
  document.getElementById("options-alert").classList.remove("hidden");
});

okAlert.addEventListener("click", function (e) {
  e.preventDefault();
  alertWrapper.classList.add("hidden");
  alertContent.forEach((content) => {
    content.classList.add("hidden");
  });
  document.getElementById("options-alert").classList.remove("hidden");
});

noAlert.addEventListener("click", function (e) {
  e.preventDefault();
  alertWrapper.classList.add("hidden");
});

yesAlert.addEventListener("click", function (e) {
  e.preventDefault();
  alertContent.forEach((content) => {
    content.classList.add("hidden");
  });
  round_number = parseInt($('#round_number').val());
  round_number = round_number +1;
  $('#round_number').val(round_number);
  $('.round_number').empty();
  $('.round_number').append('Round '+round_number);
  $('.round_number_started').empty();
  $('.round_number_started').append('Round '+round_number+' started');
  pc_id = parseInt($('#content-id').val());
    const dataId = e.target.getAttribute('data-id');
    declare_variable();
    if(dataId === '1')
    {
      document.getElementById("content-two").remove();
      if(pc_id != '0')
      {
        append_content('two', 2);
      }
    }
    else
    {
      document.getElementById("content-one").remove();
      if(pc_id != '0')
      {
        append_content('one', 1);
      }
    }
    if(pc_id == '0')
    {
      $('.arrow-link').remove();
      $('.main-box').removeClass('mobile-view');
      $('#choose-alert-wrapper').hide();
      $('.round_number').empty();
      $('.choose-content').hide();
      $('.winner').show();
      var winner_pcid = $('.winner').parent().find('.choose-content').data('pcid');
      jQuery.ajax({
          type: "POST",
          dataType: "json",
          data: {
              "contest_id": contest_id,
              'pc_id': winner_pcid
          },
          url: "/wp-admin/admin-ajax.php?action=set_vote_for_winner",
          success: function(data) {
            console.log(data);
          }
        });
    }
    else
    {
      document.getElementById("final-alert").classList.remove("hidden");
    }

    

});

function append_content(value, id)
{
  pc_id = parseInt($('#content-id').val());
  jQuery.ajax({
        type: "POST",
        dataType: "json",
        data: {
            "contest_id": contest_id
        },
        url: "/wp-admin/admin-ajax.php?action=get_portfolios_for_game",
        success: function(data) {
          data = data.data;
          console.log(data);
          var greater_id = 0;
          if(data !== 'undefined' && data.length > 0)
          {
            for(var key=0; key < data.length; key++) {
              console.log(data[key].pc_id);
              next_key = key+1;
          if(data[key].pc_id == pc_id)
          {
            if(data.hasOwnProperty(key+1))
            {
              $('#content-id').val(data[key+1].pc_id);
            }
            else
            {
              $('#content-id').val(0);
            }
          bg = data[key].image_url ? data[key].image_url : '#FFFFFF';

          if (bg.length > 8) {
              background = "background-image: url('" + bg + "')";

          }
          if (bg.length < 8) {
              background = "background: " + bg + "";
          }
          let arrow = ' fa-arrow-left';
          let arrow_id = 'two';
          mobile_class = '';
          $('.main-box').removeClass('mobile-view');            
          $('.arrow-link').removeClass('arrowlink-one');         
          $('.arrow-link').removeClass('arrowlink-two'); 
          $('.arrow-link').addClass('arrowlink-one');
          $('.arrow-link').empty();
          $('.arrow-link').append('<i class="fas fa-arrow-right"></i>');
          
            round_number = parseInt($('#round_number').val());
            html = `<div
                class="main-box content-${value} mobile-view flex-css-column mr-3"
                id="content-${value}"
              >
                <div class="title py-4 flex-css">
                  <h1>Content ${next_key}</h1>
                </div>
                <div class="box flex-css" style="` + background + `">
                  <div class="inner-content">
                    <p>`+ data[key].content +`</p>
                  </div>
                  <a href="javascript:void(0)" class="arrow-link arrowlink-two" id="arrow-${value}">
                    <i class="fas fa-arrow-left"></i>
                  </a>
                </div>
                <div class="round pt-2">
                  <p class="p-0 round_number">Round ${round_number}</p>
                </div>
                <div class="btn-container flex-css py-4">
                  <button class="btn-success choose-content" data-${value}="`+ data[key].pc_id +`" id="data-${value}" data-pcid="`+ data[key].pc_id +`" data-id="${id}">Choose</button>
                  <h1 class="text-success winner" style="display:none;text-decoration:underline;">Winner</h1>
                </div>
              </div>`;
            contentBox.innerHTML += html;
            choose_option();
            next_arrow();
            return false;
          }
        };
          }
          else
          {
              $('#content-id').val(0);
          }
        }
    });
        // modal
}

alertWrapper.addEventListener("click", function (e) {
  const wrapperId = e.target.id;
  if (wrapperId === "choose-alert-wrapper") {
    e.target.classList.add("hidden");
      alertContent.forEach((content) => {
      content.classList.add("hidden");
    });
    document.getElementById("options-alert").classList.remove("hidden");
  }
});

</script>