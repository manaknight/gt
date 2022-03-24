<script type="text/javascript">
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
  $(document).ready(function() {
  jQuery.ajax({
            type: "POST",
            dataType: "json",
            data: {
                "contest_id": contest_id
            },
            url: "/wp-admin/admin-ajax.php?action=get_contest_winners",
            success: function(response) {
              data = response.data;
              console.log(data);
              if(data !== 'undefined' && response.success === true)
              {
                $('.contest-title').empty();
                $('.contest-title').append(data.title);
                $('#prize-pool').append(data.total_prize_pool);
                $('#participants').append(data.entries);
                $('#remaining_time').append(data.running_time);
                $('#winner_name').append(data.winner[1].display_name);
                append_portfolois(data.winner);
                
              }
              else
              {
                $('#tour_result').hide();
                $('#tour_no_result').show();
                console.log('No Contest found.');
              }
            }
        });
});


    function append_portfolois(data)
    {
        var html = '';
        $('#winner_data').empty();
        $('#winner_1').empty();
        $('#winner_draw').empty();
        count = 1;
        for (const [key, value] of Object.entries(data)) {

            if(data[key].length == 0)
            {
              continue;
            }
          console.log(key, value);
          var p = '';
          bg = data[key].image_url ? data[key].image_url : '#FFFFFF';

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
          if(key == 1)
          {
            console.log('here');
            html = `
            <div class="final-content-box flex-css-column">
              <div class="title py-4 flex-css">
                <h1 class="m-0">!! Winner !!</h1>
              </div>
              <div class="box flex-css" style="` + background + `">
                <div class="inner-content">
                    <p>`+ data[key].content +`</p>
                </div>
              </div>
            </div>`; 

        $('#winner_1').append(html);
          }
          else if(key == 'draw')
          {
            html = `<div class="final-content-box flex-css-column">
              <div class="title py-4 flex-css">
                <h1 class="m-0">Draw Prize Winner</h1>
              </div>
              <div class="box flex-css" style="` + background + `">
                <div class="inner-content">
                    <p>`+ data[key].content +`</p>
                </div>
              </div>
            </div>`; 

          $('#winner_draw').append(html);
          }
          else if(key > 1 && key <= 5)
          {
            if(key == '2')
            {
              position = '2nd';
            }else if(key == '2')
            {
              position = '3rd';
            }else if(key == '4')
            {
              position = '4th';
            }else if(key == '5')
            {
              position = '5th';
            }
            html = `
            <div class="col-lg-3 col-md-6 flex-css">
              <div class="final-content-box flex-css-column">
                <div class="title py-4 flex-css">
                  <h1 class="m-0">`+ position +`</h1>
                </div>
                <div class="box flex-css" style="` + background + `">
                  <div class="inner-content">
                    <p>`+ data[key].content +`</p>
                  </div>
                </div>
              </div>
            </div>`;
          $('#winner_data').append(html);
          }
}
}
</script>