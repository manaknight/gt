<?php include_once 'tourneys_code_add.php'; ?>
<style>
    * {
        box-sizing: border-box;
    }


    .hole {
        height: 300px;
        border: 1px solid rgba(0, 0, 0, .125);
        position: relative;
        margin-left: 20px;
    }

    .hole:before {
        content: '';
        display: block;
        height: 36px;
        width: 36px;
        border: 1px solid rgba(0, 0, 0, .125);
        background-color: #fff !important;
        position: absolute;
        left: -17px;
        top: 139px;
        border-radius: 50%;
    }

    .hole:after {
        content: '';
        display: block;
        height: 100px;
        width: 20px;
        background-color: #fff !important;
        position: absolute;
        left: -23px;
        top: 140px;
    }

    #line {
        height: 270px;
        border-left: 1px solid black;
        position: relative;
        top: -50px;
    }


    .contest-img {
        position: relative;
        bottom: 50px;
    }

    .enter-btn {
        width: 150px !important;
        position: relative;
        bottom: 30px;
    }

    .tourney-card {
        background-color: #E9ECEF !important;
        border: 1px solid black;
        margin-top: 10px;

    }

    .jumbotron {
        background-color: #E9ECEF !important;


    }

    /* For Modal */
    #modal {
        position: fixed;
        width: 600px;
        top: 40px;
        left: calc(50% - 300px);
        bottom: 40px;
        z-index: 100;
        vertical-align: middle;


    }

    #contestModal {
        top: 25%;
        vertical-align: middle;

    }



    /* For desktop: */
    .col-1 {
        width: 8.33%;
    }

    .col-2 {
        width: 16.66%;
    }

    .col-3 {
        width: 25%;
    }

    .col-4 {
        width: 33.33%;
    }

    .col-5 {
        width: 41.66%;
    }

    .col-6 {
        width: 50%;
    }

    .col-7 {
        width: 58.33%;
    }

    .col-8 {
        width: 66.66%;
    }

    .col-9 {
        width: 75%;
    }

    .col-10 {
        width: 83.33%;
    }

    .col-11 {
        width: 91.66%;
    }

    .col-12 {
        width: 100%;
    }



    @media only screen and (max-width: 768px) {

        /* For mobile phones: */
        [class*="col-"] {
            width: 100%;
        }


        .hole {
            height: 740px;
            width: 335px;
            position: relative;
            right: 28px;
            bottom: 40px;
        }

        .hole:before {
            content: '';
            display: block;
            height: 36px;
            width: 36px;
            border: 1px solid rgba(0, 0, 0, .125);
            background-color: #fff !important;
            position: absolute;
            left: -17px;
            top: 139px;
            border-radius: 50%;
        }

        .hole:after {
            content: '';
            display: block;
            height: 100px;
            width: 20px;
            background-color: #fff !important;
            position: absolute;
            left: -23px;
            top: 140px;
        }




        #line {
            visibility: hidden;

        }

        .enter-btn {
            position: relative;
            top: 40px;
            margin-bottom: 30px;
            height: 35px;

        }



        .contest-heading {
            width: 300px;
            font-size: 20px;
        }

        .contest-img {
            position: relative;
            top: 20px;
        }

        .contest-content {
            position: relative;
            bottom: 200px;
        }

        h4 {
            font-size: 16px;
            width: 200px;
        }

        .emoji {
            height: 20px;
        }

        #all_tournaments>p {
            position: relative;
            top: 50px;
        }

    }
</style>
<div class="tab-content">
    <div class="tab-pane fade show active" id="timeline">
        <ul class="nav nav-tabs mt-3">
            <li class="nav-item">
                <a href="#scheduled_tournaments" class="nav-link active" data-toggle="tab">Scheduled Tournaments</a>
            </li>
            <li class="nav-item">
                <a href="#my_tournaments" class="nav-link" data-toggle="tab">My Tournaments</a>
            </li>
        </ul>

    </div>
    <div class="row mt-5">
        <div class="col-sm-9"></div>
        <div class="col-sm-2">


            <label for="category"> Filter</label><br>
            <?php
            echo getCategory();
            ?>


        </div>


    </div>
</div>

<div class="tab-content">

    <div class="tab-pane fade active show" id="scheduled_tournaments">
        <div class="card tourney_card">

            <div class="card-body">
                <div class="container" id="all_contests">


                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="my_tournaments">
        <div class="card">
            <div class="card-body">
                <div class="container" id="my_contests">


                </div>
            </div>
        </div>
    </div>
</div>


<!--Contest  Modal -->
<div class="modal fade" id="contestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="background-color: transparent; border:none; color:black;">X</button>

            </div>
            <div class="modal-body" id="contestData">
                ...
            </div>

        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


<script>
    // on reload
    //for page reload category
    $(document).ready(function() {
        loadContests();
    });

    $('#category').change(function() {
        loadContests();
    });
</script>

<script>
    function loadContests() {
        getContests('all');
        getContests('my');
    }

    function getContests(type) {
        let tab_id = 'all_contests';
        let user_id= "<?php echo get_current_user_id(); ?>";
        if (type == 'my') {
            tab_id = 'my_contests';
        }
        var cat_id = $('#category').val();
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
                for (i in data) {
                    var html = '';

                    data[i].forEach(element => {

                        html += '<div class="jumbotron mt-5 hole">';
                        html += '<div class="row">';
                        html += '<div class="col-sm-3 text-center">';
                        html += '<img  class="contest-img" style="height: 150px; width:150px  " src= ' +
                            element.url + ' alt="">';
                        html += '<br>';
                        html += '<button class="enter-btn" id="enterbtn" data-id=' + element.id + '   onClick="displayContestById();">Enter</button>';
                        html += "</div>";
                        html += '<div class="col-sm-1" id="line"></div>';
                        html += '  <div class="col-sm-6 contest-content">';
                        html += '<h1 class="contest-heading">' + element.title + '</h1>';


                        html += '  <div class="row">';
                        html += '<div class = "col-sm-5">';
                        html += '<h4>' + "Regestration ends&#8505;" + ' </h4>';
                        html += '<p class="bg-warning text-center mt-0">' + element
                            .remaining_time + ' </p>';
                        html += "</div>";

                        html += '<div class = "col-sm-4">';
                        html += '<h4>' + "Prize Pool&#8505;" + ' </h4>';
                        html += '<p class="bg-warning text-center mt-0">' + element
                            .total_prize_pool + ' </p>';
                        html += "</div>";

                        html += '<div class = "col-sm-3">';
                        html += '<h4>' + "Entries&#8505;" + ' </h4>';
                        html += '<p class="bg-warning text-center mt-0">' + element
                            .no_of_particpants + ' </p>';
                        html += "</div>";

                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";

                    });
                    if (html == '') {
                        html = '<p>No Contests Found</p>';
                    }
                    $('#' + tab_id).html(html);
                }
            }
        });
    }

    //DisplayContestById
    function displayContestById() {
        $('#contestModal').modal({
            show: true
        });
        var id = $("#enterbtn").attr("data-id");


        jQuery.ajax({
            type: "POST",
            dataType: "json",
            data: {
                "id": id,
            },
            url: "/wp-admin/admin-ajax.php?action=get_my_contest_by_id",
            success: function(data) {
                for (i in data) {
                    var html = '';

                    data[i].forEach(element => {
                        html += '<button type="button" class="btn btn-info" onclick="enterTournament(' + element.id + ')">Preview</button>';
                        html += '<h1>' + element.title + '</h1>';
                        html += '<p>' + element.description + '</p>';
                        html += '<iframe width="500" height="400" src="https://www.youtube.com/embed/FRdyXZ8DTk4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';

                    });

                    $('#contestData').html(html);
                }
            }
        });
    }

    function enterTournament(id)
    {
        
    }
</script>