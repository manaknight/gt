<?php include_once 'portfolio_code_add.php'; ?>
<!-- Custom Style -->
<style>
    #bp-nouveau-activity-form {
        background-color: rgb(254, 254, 254);
        padding: 10px;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;

    }

    .boxes {
        margin-left: 10px;
        box-sizing: border-box;

    }



    .box {
        height: 300px;

        background-color: orange;
        color: black;
        margin: 5px;
        text-align: center;
        box-sizing: border-box;
        /* overflow:auto */

    }

    .box a {
        float: right;
        visibility: hidden;

    }

    .box:hover a,
    .box:active a {
        visibility: visible;

    }

    .box .avatar {
        visibility: hidden;

    }

    .box:hover .avatar {
        visibility: visible;

    }

    .box:hover h6 {
        visibility: visible;

    }

    .box h6 {
        visibility: hidden;

    }

    .f-content {

        text-align: center;
        padding-top: 150px;
    }

    /* For Colors Modal */
    .modal {
        text-align: center;


    }



    /* img modal */

    .caption {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        padding: 0 10px;
        box-sizing: border-box;
        pointer-events: none;
    }

    .content {
        text-align: center;
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        /* margin-top: -9px; */
    }

    .pusedoname {
        text-align: right;
        position: absolute;
        top: 95%;
        left: 0;
        right: 0;
        width: 40vw;
    }

    .caption span {
        display: inline-block;
        padding: 10px;
        color: #fff;
        background: rgba(0, 0, 0, 0.5);
        font-family: 'Myriad Pro regular';
        font-size: 15.31px;
    }

    .image_grid {
        display: inline-block;
        padding-left: 25px;
    }

    .image_grid label {
        position: relative;
        display: inline-block;
    }

    .image_grid img {
        display: block;
    }

    .image_grid input {
        display: none;
    }

    .image_grid input:checked+.caption {
        background: rgba(0, 0, 0, 0.5);
    }

    .image_grid input:checked+.caption::after {
        content: '✔';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 70px;
        height: 70px;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 60px;
        line-height: 80px;
        text-align: center;
        border: 2px solid white;
        border-radius: 50%;
    }

    .modal::before {
        content: "";
        display: inline-block;
        height: 80%;
        margin-right: -4px;
        vertical-align: middle;
    }

    .modal-dialog {
        display: inline-block;
        text-align: left;
        vertical-align: middle;
        overflow-y: initial !important
    }


    /* Important part */

    .modal-body {
        /* height: 80vh;
        overflow-y: auto; */
        margin: 0;


    }


    .p_title {
        margin-left: 90px;
        cursor: pointer;
    }


    #palette {
        width: 400px;
        list-style-type: none;
    }

    #palette li {
        height: 40px;
        width: 40px;
        cursor: pointer;
        float: left;
        margin: 2px;
    }

    #palette li.active {
        border: solid 1px;
        margin: 1px;

    }

    #d_content {
        position: relative;
        bottom: 23px;
    }

    .filter {
        margin-left: 83%;
    }

    .btn-groups {
        position: relative;
        left: 5%;
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

        .box h4 {
            margin-left: 60px !important;
        }

        .previeModal {
            width: 90vw !important;
        }

        .pusedoname {
            margin-left: 130px !important;
        }

        .filter {
            margin-left: 200px !important;
        }

        .btn-groups {
            position: relative;
            right: 12%;
        }


    }
</style>
<?php if(get_current_user_id() == bbp_get_user_id() ) {
    include_once 'portfolio_form.php';
}?>



<!-- Preview modal -->

<div class="modal fade bd-example-modal-lg" id="bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" id="modal-preview">

        <div class="modal-content">
            <div class="modal-header" id="preview_modal_header" style="background-color: orange; border:none">
                <button type="button" class="close" data-dismiss="modal" style="background-color: transparent; border:none">X</button>
            </div>

            <div class="modal-body" id="data" style="background-color: orange; border:none">

                <div class="row previeModal" style="width: 52vw; height:40vh">



                    <div class="col-md-10" id="content_data">

                    </div>

                </div>


            </div>
        </div>

    </div>
</div>
</div>


<!-- Preview modal for Colors and image -->
<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="background-color: transparent; color:black; border:none">X</button>
            </div>
            <div class="modal-body" style="width: 500px;">

                <ul class="nav nav-tabs">


                    <li class="nav-item" style="margin-left: 133px;">
                        <a href="#colors" class="nav-link active" data-toggle="tab">Colors</a>

                    </li>
                    <li class="nav-item">
                        <a href="#images" class="nav-link" data-toggle="tab">Images</a>
                    </li>
                </ul>
                <div class="tab-content">


                    <div class="tab-pane fade show active" id="colors">
                        <div class="container">
                            <a href="#colors" class="nav-link" data-toggle="tab">Colors</a>
                            <div height="100%" width="100%">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="unselect">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        none
                                    </label>
                                </div>
                                Name: <span id="name"></span>&emsp;Hex: <span id="hex"></span>
                                <ul id="palette">
                                </ul>

                            </div>


                        </div>
                    </div>
                    <div class="tab-pane fade" id="images" style="height: 500px;">
                        <div class="container">

                            <?php

                            echo getBackgroundImages();
                            ?>

                        </div>
                    </div>


                </div>

            </div>

        </div>

    </div>
</div>

<!-- Empty Submit Modal -->
<div class="modal  helomodal" id="submitModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="height:30vh">
            <div class="modal-header" id="preview_modal_header" style="background-color: orange; border:none">
                <button type="button" class="close" data-dismiss="modal" style="background-color: transparent; border:none">X</button>
            </div>

            <div class="modal-body submitMo">

                <p>Please Enter title and pusedoname !.</p>
            </div>

        </div>
    </div>
</div>

<!-- Display portfolio work -->
<div>

    <div class="row mt-5">
        <div class="col-md-9"></div>
        <div class="col-md-2 filter">
            <label for="filter" class="lbl-filter"> Filter</label>

            <?php
            echo getCategories();
            ?>
        </div>


    </div>

    <!-- Display boxes -->
    <div class="boxes">
        <div class="row portfolios">


        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script>
    //print
    function printPreview(id) {

        var html2 = '';

        jQuery.ajax({
            type: "POST",
            dataType: "json",
            data: {
                "id": id
            },
            url: "/wp-admin/admin-ajax.php?action=get_portfolio_by_id_ajax",


            success: function(data) {

                for (i in data) {

                    if (jQuery.isEmptyObject({
                            data
                        })) {
                        return
                    } else {


                        data[i].forEach(element => {
                            html2 += '<table border="1"><thead><tr> <th scope="col">#</th><th scope="col">Title</th> <th scope="col">Content</th><th scope="col">Pusedoname</th></tr></thead>' +
                                '  <tbody> <tr><th scope="row">1</th><td>' + element.title + '</td><td>' + element.content + '</td><td>' + element.content + '</td></tr></tbody></table>';
                        });

                        var printWindow = window.open("", "_blank", "location,status,scrollbars,width=650,height=600");
                        if (printWindow) {
                            printWindow.document.write(html2);
                            printWindow.document.close();
                            printWindow.focus();
                        } else alert("Please allow popups");
                    }


                }
            }
        })

    }

    function validate() {
        nameREGX = "[a-zA-Z0-9]+";
        var title = document.getElementById('title').value;
        var psuedoname = document.getElementById('psuedoname').value;

        var titleResult = nameRGEX.test(title);
        var psuedonameResult = nameRGEX.test(psuedoname);
        if (psuedonameResult == false) {
            $('#PsuedonameError').innerHTML = "Please enter alphabets only! ";

            return false;
        }

        if (titleResult == false) {
            $('#TitleError').innerHTML = "Please enter alphabets only! ";
            return false;
        }

        return true;
    }


    function clearValues() {
        document.getElementById('font_id').value = '';
        document.getElementById('category_id').value = '';

        document.getElementById('title').value = '';
        document.getElementById('contents').innerHTML = '';
        document.getElementById('color').value = '';
        document.getElementById('image').value = '';
        document.getElementById('psuedoname').value = '';
        document.getElementById('visibility').value = '';
        document.getElementById("submit").value = '';
        document.getElementById("submit").innerText = 'Publish';
        document.getElementById("form_heading").innerText = 'Add Portfolio';

        document.getElementById('font_id').value = '';
        document.getElementById('category_id').value = '';

    }


    // Delete Portfolio
    function deletePortfolio(id) {



        jQuery.ajax({
            type: "POST",
            dataType: "json",
            data: {
                "id": id
            },
            url: "/wp-admin/admin-ajax.php?action=delete_portfolio_ajax",


            success: function(data) {


                window.location.reload()

            }

        })
    };
    //Edit
    function editPortfolio(id) {
        console.log('here');
        $('html, body').animate({ scrollTop: $('#object-nav').offset().top }, 'slow');
        jQuery.ajax({
            type: "POST",
            dataType: "json",
            data: {
                "id": id
            },
            url: "/wp-admin/admin-ajax.php?action=get_portfolio_by_id_ajax",
            success: function(data) {

                for (i in data) {

                    if (jQuery.isEmptyObject({
                            data
                        })) {
                        return
                    } else {


                        data[i].forEach(element => {
                            document.getElementById('font_id').value = '';
                            document.getElementById('category_id').value = '';

                            document.getElementById('title').value = '';
                            document.getElementById('contents').innerHTML = '';
                            document.getElementById('color').value = '';
                            document.getElementById('image').value = '';
                            document.getElementById('psuedoname').value = '';
                            document.getElementById('visibility').value = '';
                            document.getElementById("submit").value = '';
                            document.getElementById("submit").innerText = '';
                            document.getElementById("form_heading").innerText = '';

                            document.getElementById('font_id').value = '';
                            document.getElementById('category_id').value = '';


                            document.getElementById('font_id').value = element.font_id;
                            document.getElementById('category_id').value = element.category_id;

                            document.getElementById('title').value = element.title;
                            document.getElementById('contents').innerHTML = element.content;

                            if(element.type == 'color')
                            {
                                document.getElementById('color').value = element.image_url;
                            }
                            else if(element.type == 'image')
                            {
                                document.getElementById('image').value = element.image_url;
                            }
                            document.getElementById('psuedoname').value = element.psuedoname;
                            document.getElementById('visibility').value = element.visibility;
                            document.getElementById("submit").value = element.id;
                            document.getElementById("submit").innerText = "Update";
                            document.getElementById("form_heading").innerText = "Update Portfolio";


                        });
                    }
                }
            }
        })
    };








    //Preiew Portfolio from box
    function display(id) 
    {

        $('#bd-example-modal-lg').modal({
            show: true
        });

        $('#content_data').html("<p>Loading data please wait...</p>");

        var html = '';
        var html2 = '';
        var content = '';
        jQuery.ajax({
            type: "POST",
            dataType: "json",
            data: {
                "id": id
            },
            url: "/wp-admin/admin-ajax.php?action=get_portfolio_by_id_ajax", 
            success: function(data) 
            {

                for (i in data) 
                {

                    if (jQuery.isEmptyObject({
                            data
                        })) {
                        return
                    } else 
                    { 
                        data[i].forEach(element => {
                            html2 += `<h2 class='mt-1 ' id="d_content">   ` + element.title + `</h2>`;
                            html2 += `<p class="content">   ` + element.content + `</p>`;

                            html2 += `<p class="pusedoname">   ` + element.psuedoname + `</p>`;
 
                            $('#content_data').html(html2);

                            $('#user_data').html(html);

                        });
                    }
                }
            }
        })
    };




    $('#preview').click(function() {
        //   //Some code
        var html = '';
        var html2 = '';
        var font_id = $("#font_id option:selected").val();
        var title = $('#title').val();

        var content = $('#contents').val();
        var color = $('#color').val().trim();
        var image = $('#image').val();
        var psuedoname = $('#psuedoname').val();
        var visibility = $('#visibility').val();



        if (color.length > 0) {

            $("#data").css("background", color);
            $('#preview_modal_header').css("background", color);

        } else if (image.length > 0) {

            $("#data").css("background-image", `url(` + image + `)`);
            $('#preview_modal_header').css("background-image", `url(` + image + `)`);

            $("#data").css("background-size", `cover`);
            $("#data").css("  font-family", font_id);


        }

        jQuery.ajax({
            type: "POST",
            dataType: "json",
            data: {
                "font_id": font_id
            },
            url: "http://localhost:9003/wp-admin/admin-ajax.php?action=get_font_url_ajax",


            success: function(data) {


                for (i in data) {
                    var html = '';
                    if (jQuery.isEmptyObject({
                            data
                        })) {



                        return
                    } else {


                        data[i].forEach(element => {
                            $("<style> " + element.url + "  </style>").appendTo("head")
                            $('#data').css({
                                "font-family": element.name
                            })
                            $('#d_content').css({
                                "font-family": element.name
                            })



                        });
                    }

                }



            },

        })


        html2 += `<h2 class='mt-1 ' id="d_content">   ` + title + `</h2>`;
        html2 += `<p class="content">   ` + content + `</p>`;

        html2 += `<p class="pusedoname">   ` + psuedoname + `</p>`;


        // html += "<?php $current_user = wp_get_current_user();


                    ?>";

        $('#content_data').html(html2);
        console.log(html2);



    });
</script>
<!-- Colors Modal -->
<script>
    const colours = [{
            name: 'white',
            hex: '#FFFFFF'
        },

        {
            name: 'whitesmoke',
            hex: '#F5F5F5'
        },
        {
            name: 'seashell',
            hex: '#FFF5EE'
        },
        {
            name: 'beige',
            hex: '#F5F5DC'
        },
        {
            name: 'oldlace',
            hex: '#FDF5E6'
        },
        {
            name: 'floralwhite',
            hex: '#FFFAF0'
        },
        {
            name: 'ivory',
            hex: '#FFFFF0'
        },
        {
            name: 'antiquewhite',
            hex: '#FAEBD7'
        },
        {
            name: 'linen',
            hex: '#FAF0E6'
        },
        {
            name: 'lavenderblush',
            hex: '#FFF0F5'
        },
        {
            name: 'mistyrose',
            hex: '#FFE4E1'
        },
        {
            name: 'gainsboro',
            hex: '#DCDCDC'
        },
        {
            name: 'lightgray',
            hex: '#D3D3D3'
        },
        {
            name: 'silver',
            hex: '#C0C0C0'
        },
        {
            name: 'darkgray',
            hex: '#A9A9A9'
        },
        {
            name: 'gray',
            hex: '#808080'
        },
        {
            name: 'dimgray',
            hex: '#696969'
        },
        {
            name: 'lightslategray',
            hex: '#778899'
        },
        {
            name: 'slategray',
            hex: '#708090'
        },
        {
            name: 'darkslategray',
            hex: '#2F4F4F'
        },
        {
            name: 'black',
            hex: '#000000'
        },
        {
            name: 'cornsilk',
            hex: '#FFF8DC'
        },
        {
            name: 'blanchedalmond',
            hex: '#FFEBCD'
        },
        {
            name: 'bisque',
            hex: '#FFE4C4'
        },
        {
            name: 'navajowhite',
            hex: '#FFDEAD'
        },
        {
            name: 'wheat',
            hex: '#F5DEB3'
        },
        {
            name: 'burlywood',
            hex: '#DEB887'
        },
        {
            name: 'tan',
            hex: '#D2B48C'
        },
        {
            name: 'rosybrown',
            hex: '#BC8F8F'
        },
        {
            name: 'sandybrown',
            hex: '#F4A460'
        },
        {
            name: 'goldenrod',
            hex: '#DAA520'
        },
        {
            name: 'peru',
            hex: '#CD853F'
        },
        {
            name: 'chocolate',
            hex: '#D2691E'
        },
        {
            name: 'saddlebrown',
            hex: '#8B4513'
        },
        {
            name: 'sienna',
            hex: '#A0522D'
        },
        {
            name: 'brown',
            hex: '#A52A2A'
        },
        {
            name: 'maroon',
            hex: '#800000'
        },
        {
            name: 'lightyellow',
            hex: '#FFFFE0'
        },
        {
            name: 'lemonchiffon',
            hex: '#FFFACD'
        },
        {
            name: 'lightgoldenrodyellow',
            hex: '#FAFAD2'
        },
        {
            name: 'papayawhip',
            hex: '#FFEFD5'
        },
        {
            name: 'moccasin',
            hex: '#FFE4B5'
        },
        {
            name: 'peachpuff',
            hex: '#FFDAB9'
        },
        {
            name: 'palegoldenrod',
            hex: '#EEE8AA'
        },
        {
            name: 'khaki',
            hex: '#F0E68C'
        },
        {
            name: 'darkkhaki',
            hex: '#BDB76B'
        },
        {
            name: 'yellow',
            hex: '#FFFF00'
        },
        {
            name: 'lightsalmon',
            hex: '#FFA07A'
        },
        {
            name: 'salmon',
            hex: '#FA8072'
        },
        {
            name: 'darksalmon',
            hex: '#E9967A'
        },
        {
            name: 'lightcoral',
            hex: '#F08080'
        },
        {
            name: 'indianred',
            hex: '#CD5C5C'
        },
        {
            name: 'crimson',
            hex: '#DC143C'
        },
        {
            name: 'firebrick',
            hex: '#B22222'
        },
        {
            name: 'red',
            hex: '#FF0000'
        },
        {
            name: 'darkred',
            hex: '#8B0000'
        },
        {
            name: 'coral',
            hex: '#FF7F50'
        },
        {
            name: 'tomato',
            hex: '#FF6347'
        },
        {
            name: 'orangered',
            hex: '#FF4500'
        },
        {
            name: 'gold',
            hex: '#FFD700'
        },
        {
            name: 'orange',
            hex: '#FFA500'
        },
        {
            name: 'darkorange',
            hex: '#FF8C00'
        },
        {
            name: 'lawngreen',
            hex: '#7CFC00'
        },
        {
            name: 'chartreuse',
            hex: '#7FFF00'
        },
        {
            name: 'limegreen',
            hex: '#32CD32'
        },
        {
            name: 'lime',
            hex: '#00FF00'
        },
        {
            name: 'forestgreen',
            hex: '#228B22'
        },
        {
            name: 'green',
            hex: '#008000'
        },
        {
            name: 'darkgreen',
            hex: '#006400'
        },
        {
            name: 'greenyellow',
            hex: '#ADFF2F'
        },
        {
            name: 'yellowgreen',
            hex: '#9ACD32'
        },
        {
            name: 'springgreen',
            hex: '#00FF7F'
        },
        {
            name: 'mediumspringgreen',
            hex: '#00FA9A'
        },
        {
            name: 'lightgreen',
            hex: '#90EE90'
        },
        {
            name: 'palegreen',
            hex: '#98FB98'
        },
        {
            name: 'darkseagreen',
            hex: '#8FBC8F'
        },
        {
            name: 'mediumseagreen',
            hex: '#3CB371'
        },
        {
            name: 'seagreen',
            hex: '#2E8B57'
        },
        {
            name: 'olive',
            hex: '#808000'
        },
        {
            name: 'darkolivegreen',
            hex: '#556B2F'
        },
        {
            name: 'olivedrab',
            hex: '#6B8E23'
        },
        {
            name: 'lightcyan',
            hex: '#E0FFFF'
        },
        {
            name: 'cyan',
            hex: '#00FFFF'
        },
        {
            name: 'aqua',
            hex: '#00FFFF'
        },
        {
            name: 'aquamarine',
            hex: '#7FFFD4'
        },
        {
            name: 'mediumaquamarine',
            hex: '#66CDAA'
        },
        {
            name: 'paleturquoise',
            hex: '#AFEEEE'
        },
        {
            name: 'turquoise',
            hex: '#40E0D0'
        },
        {
            name: 'mediumturquoise',
            hex: '#48D1CC'
        },
        {
            name: 'darkturquoise',
            hex: '#00CED1'
        },
        {
            name: 'lightseagreen',
            hex: '#20B2AA'
        },
        {
            name: 'cadetblue',
            hex: '#5F9EA0'
        },
        {
            name: 'darkcyan',
            hex: '#008B8B'
        },
        {
            name: 'teal',
            hex: '#008080'
        },
        {
            name: 'powderblue',
            hex: '#B0E0E6'
        },
        {
            name: 'lightblue',
            hex: '#ADD8E6'
        },
        {
            name: 'lightskyblue',
            hex: '#87CEFA'
        },
        {
            name: 'skyblue',
            hex: '#87CEEB'
        },
        {
            name: 'deepskyblue',
            hex: '#00BFFF'
        },
        {
            name: 'lightsteelblue',
            hex: '#B0C4DE'
        },
        {
            name: 'dodgerblue',
            hex: '#1E90FF'
        },
        {
            name: 'cornflowerblue',
            hex: '#6495ED'
        },
        {
            name: 'steelblue',
            hex: '#4682B4'
        },
        {
            name: 'royalblue',
            hex: '#4169E1'
        },
        {
            name: 'blue',
            hex: '#0000FF'
        },
        {
            name: 'mediumblue',
            hex: '#0000CD'
        },
        {
            name: 'darkblue',
            hex: '#00008B'
        },
        {
            name: 'navy',
            hex: '#000080'
        },
        {
            name: 'midnightblue',
            hex: '#191970'
        },
        {
            name: 'mediumslateblue',
            hex: '#7B68EE'
        },
        {
            name: 'slateblue',
            hex: '#6A5ACD'
        },
        {
            name: 'darkslateblue',
            hex: '#483D8B'
        },
        {
            name: 'lavender',
            hex: '#E6E6FA'
        },
        {
            name: 'thistle',
            hex: '#D8BFD8'
        },
        {
            name: 'plum',
            hex: '#DDA0DD'
        },
        {
            name: 'violet',
            hex: '#EE82EE'
        },
        {
            name: 'orchid',
            hex: '#DA70D6'
        },
        {
            name: 'fuchsia',
            hex: '#FF00FF'
        },
        {
            name: 'magenta',
            hex: '#FF00FF'
        },
        {
            name: 'mediumorchid',
            hex: '#BA55D3'
        },
        {
            name: 'mediumpurple',
            hex: '#9370DB'
        },
        {
            name: 'blueviolet',
            hex: '#8A2BE2'
        },
        {
            name: 'darkviolet',
            hex: '#9400D3'
        },
        {
            name: 'darkorchid',
            hex: '#9932CC'
        },
        {
            name: 'darkmagenta',
            hex: '#8B008B'
        },
        {
            name: 'purple',
            hex: '#800080'
        },
        {
            name: 'indigo',
            hex: '#4B0082'
        },
        {
            name: 'pink',
            hex: '#FFC0CB'
        },
        {
            name: 'lightpink',
            hex: '#FFB6C1'
        },
        {
            name: 'hotpink',
            hex: '#FF69B4'
        },
        {
            name: 'deeppink',
            hex: '#FF1493'
        },
        {
            name: 'palevioletred',
            hex: '#DB7093'
        },
        {
            name: 'mediumvioletred',
            hex: '#C71585'
        }
    ];

    const palette = document.getElementById('palette'),
        nameSpan = document.getElementById('name'),
        hexSpan = document.getElementById('hex');
    color = document.getElementById('color');

    const unselectColors = document.getElementById('unselect');

    palette.onclick = e => {
        const li = e.target;
        nameSpan.innerHTML = li.dataset.name;
        hexSpan.innerHTML = li.dataset.hex;
        color.value = li.dataset.hex;
        hexSpan.style.backgroundColor = li.dataset.hex;
        if (palette.active) palette.active.className = palette.active.className.replace(' active', '');
        palette.active = li;
        li.className += ' active';

        $('#unselect').prop('checked', false);
        $('#image').val('');



    };

    unselectColors.onclick = e => {


        const li = e.target;
        nameSpan.innerHTML = '';
        hexSpan.innerHTML = '';
        color.value = '';
        hexSpan.style.backgroundColor = '';
        if (palette.active) palette.active.className = palette.active.className.replace(' active', '');
        palette.active = li;
        li.className += ' active';


    }




    colours.forEach(color => {
        const li = document.createElement('li');
        li.title = color.name;
        li.style.backgroundColor = color.hex;
        li.style.border = "1px solid black";
        li.dataset.name = color.name;
        li.dataset.hex = color.hex;
        palette.appendChild(li);

    });
</script>
<!-- Modal Data -->

<script>
    var uri_path = '<?php echo parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?>';
    var url_array = uri_path.split('/');
    var user_name = url_array[2];

    $('img').click(function() {
        image = document.getElementById('image');  
        var img = $(this).attr('src');
        image.value = img;
        $('#color').val('');
    });
    //for page reload category
    $(document).ready(function() {  
        jQuery.ajax({
            type: "POST",
            dataType: "json", 
            data: {
                "user_name": user_name
            },
            url: "/wp-admin/admin-ajax.php?action=get_portfolio_All_ajax", 
            success: function(data) 
            { 
                for (i in data) 
                {
                    var html = '';
                    var bg = '';
                    var bgs = '';
                    if (jQuery.isEmptyObject({
                            data
                        })) {

                        html += '<h2>Title  : No Portfolio  </h2>';
                        html += "</div>"
                        return
                    } else {

                        $(".box").remove();
                        // elem.parentNode.removeChild(elem);
                        data[i].forEach(element => {


                            var p = '';
                            bg = element.image_url;

                            if (bg.length > 8) {
                                background = "background-image: url('" + bg + "')";

                            }
                            if (bg.length < 8) {
                                background = "background: " + bg + "";
                            }
                            console.log(background);

                            html += '<div class = "col-md-3 box" id="bg-box" style="' + background + '">';
                            //Display Profile and user name
                            // html += "<?php $current_user = wp_get_current_user();
                                        //             echo get_avatar($current_user->ID, 32) . "<h6 style='display:inline'>&nbsp;  $current_user->user_firstname    $current_user->user_lastname   &emsp;&emsp;  &emsp; </h6>";
                                        ?>";
                            html += '<a href="javascript:void(0)"  onclick="editPortfolio(' + element.id + ')"><img src="/wp-content/plugins/mkd-core/icons/pencil.png"/></a>';
                            html += '<a href="javascript:void(0)" onclick="deletePortfolio(' + element.id + ')"><img src="/wp-content/plugins/mkd-core/icons/trash.png"/></a>';


                            html += '<h4 onclick="display(' + element.id + ')" class=" text-center p-5 p_title "style="position:absolute; top:80px" > ' + element.title + ' </h4>';
                            html += '<div style="position:absolute; top:60px">'

                            html += "</div>"





                            html += "</div>"

                        });
                    } 
                } 
                $('.portfolios').append(html); 
            }, 
        })
    }),

    //  on category changed
    $('#category').change(function() {
        if ($("#category  option:selected").text() == "All") {
            var url = "/wp-admin/admin-ajax.php?action=get_portfolio_All_ajax";
        }
        else
        {
            var url = "/wp-admin/admin-ajax.php?action=get_portfolio_All_ajax";
        }

            var cat_id = $('#category').val();
            jQuery.ajax({
                type: "POST",
                dataType: "json",
                data: {
                    "cat_id": cat_id
                },
                url: url,


                success: function(data) {

                    for (i in data) {
                        var html = '';
                        if (jQuery.isEmptyObject({
                                data
                            })) {


                            html = html += '<div class = "col-md-3 box">';
                            html += '<h2>Title  : No Portfolio  </h2>';
                            html += "</div>"
                            return
                        } else {

                            $(".box").remove();
                            data[i].forEach(element => {
                                var p = '';
                                bg = element.image_url;

                                if (bg.length > 8) {
                                    background = "background-image: url('" + bg + "')";

                                }
                                if (bg.length < 8) {
                                    background = "background: " + bg + "";
                                }
                                console.log(background);

                                html += '<div class = "col-md-3 box" style="' + background + '">';
                                // html += "<?php
                                if(get_current_user_id() == bbp_get_user_id() ) {

        }
                                $current_user = wp_get_current_user();
                                            ?>";
                                html += '<a href="javascript:void(0)"  onclick="editPortfolio(' + element.id + ')"><img src="/wp-content/plugins/mkd-core/icons/pencil.png"/></a>';
                                html += '<a href="javascript:void(0)" onclick="deletePortfolio(' + element.id + ')"><img src="/wp-content/plugins/mkd-core/icons/trash.png"/></a>';


                                html += '<h4 onclick="display(' + element.id + ')" class=" text-center p-5 p_title "style="position:absolute; top:80px" > ' + element.title + ' </h4>';
                                html += '<div style="position:absolute; top:60px">'

                                html += "</div>"

                                html += "</div>"
                            });
                        }

                    }

                    $('.portfolios').append(html);

                },

            })
    });
    $("#form").submit(function(event) {
        event.preventDefault();
        var buttonPress = document.getElementById('submit').innerText;
        console.log(buttonPress);
        if (buttonPress == 'Publish') {
            var cat_id = $('#category_id').val();
            var font_id = $("#font_id option:selected").val();
            var title = $('#title').val();

            var content = $('#contents').val();
            var color = $('#color').val().trim();
            var image = $('#image').val();
            var psuedoname = $('#psuedoname').val();
            var visibility = $("#visibility  option:selected").val();

            if (title.length > 3 && psuedoname.length > 3) {
                console.log('herer');
                jQuery.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/wp-admin/admin-ajax.php?action=save_portfolio_ajax",
                    data: {
                        "title": title,
                        "content": content,
                        "psuedoname": psuedoname,
                        "font_id": font_id,
                        "cat_id": cat_id,
                        "visibility": visibility,
                        "image": image,
                        "color": color
                    },
                    success: function(data) {
                        // do something here
                        console.log(data);
                        window.location.reload();

                    }


                });
            } else {
                $('#submitModal').modal({
                    show: true
                });
            }
        } else if (buttonPress == 'Update') {
            var id = document.getElementById('submit').value;

            var cat_id = $('#category_id').val();
            var font_id = $("#font_id option:selected").val();
            var title = $('#title').val();

            var content = $('#contents').val();
            var color = $('#color').val().trim();
            var image = $('#image').val();
            var psuedoname = $('#psuedoname').val();
            var visibility = $("#visibility  option:selected").val();

            if (title.length > 3 && psuedoname.length > 3) {
                jQuery.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/wp-admin/admin-ajax.php?action=update_portfolio_ajax",
                    data: {
                        "title": title,
                        "content": content,
                        "psuedoname": psuedoname,
                        "font_id": font_id,
                        "cat_id": cat_id,
                        "visibility": visibility,
                        "image": image,
                        "color": color,
                        "id": id
                    },
                    success: function(data) {
                        // do something here
                        window.location.reload();
                    }


                });
            } else {


                $('#submitModal').modal({
                    show: true
                });

            }
        }

    });
</script>