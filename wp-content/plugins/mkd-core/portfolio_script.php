<style>
    /*Haider's CSS*/
    @media (max-width: 320px) {
        .preview-portfolio{
            text-align: center;
            padding: 15px;
        }
    }
    /*Haider's CSS ends here*/
</style>

<script>
    var uri_path = '<?php echo parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?>';
    var url_array = uri_path.split('/');
    var user_name = url_array[2];
    // preview modal 
    const previewModalWrapper = document.getElementById("preview-modal-wrapper");
    const previewBtn = document.getElementById("preview-btn");
    const previewCloseIcon = document.getElementById("preview-close-icon");

    // color modal 
    const modalWrapper = document.getElementById("color-modal-wrapper");
    const tabs = document.querySelectorAll(".tab-link");
    const contents = document.querySelectorAll(".tab-container");


    $('#choose-btn').click(function(e){
        e.preventDefault();
        modalWrapper.classList.remove("hidden");
    });

   $('#close-icon').on("click", function(e){
        e.preventDefault();
        modalWrapper.classList.add("hidden");
    });

    $('#preview-close-icon').on("click", function(e){
        e.preventDefault();
        previewModalWrapper.classList.add("hidden");
    });
    
    $('#preview-modal-wrapper').on("click", function(e){
        e.preventDefault();
        previewModalWrapper.classList.add("hidden");
    });



    tabs.forEach(tab => {
        tab.addEventListener("click", function(e){
            const tabID = e.target.id;
            tabs.forEach(tab => {
                tab.classList.remove("active");
            })
            e.target.classList.add("active");
            contents.forEach(content => {
                content.classList.add("hidden");
            });
            document.getElementById(`${tabID}-content`).classList.remove("hidden");
        })
    });
    // preview modal 
    $('#preview-btn').on("click", function(e)
    {
        e.preventDefault();
        var font_id    = $("#font_id option:selected").val();
        var title      = $('#title').val(); 

        var content    = $(tinymce.get('contents').getBody()).text();
        var color      = $('#color').val().trim();
        var image      = $('#image').val();
        var psuedoname = $('#psuedoname').val();
        var visibility = $('#visibility').val();
        var category   = $("#category_id option:selected").val();

        if(title != '' && content != '' && psuedoname != '' && font_id != '' && category != '')
        {
            previewModalWrapper.classList.remove("hidden");
            $('.preview-modal').removeAttr('style');
            $(".preview-modal").css("font-family", font_id);
            if (color.length > 0) {

                $('.preview-modal').css("background", color);

            } else if (image.length > 0) {
                $('.preview-modal').css({"background-image": `url(` + image + `)`, 'background-repeat': 'no-repeat', 'background-size': 'cover', 'background-position': 'center'});
            }
            content = $(tinymce.get('contents').getBody()).html();
            $('#preview-title').html(title);
            $('#preview-content').html(content);
            $('#preview-writer').html(psuedoname);
        }
        else
        {
            let TitleErrorText      =(title=='')?'Title field is required':'';
            let ContentErrorText    =(content=='')?'Content field is required':'';
            let PsuedonameErrorText =(psuedoname=='')?'Writer name field is required':'';
            let FontErrorText      =(font_id=='')?'Fonts field is required':'';
            let CategoryErrorText      =(category=='')?'Category field is required':'';

            $('#TitleError').text(TitleErrorText);
            $('#ContentError').text(ContentErrorText);
            $('#PsuedonameError').text(PsuedonameErrorText);
            $('#FontError').text(FontErrorText);
            $('#CategoryError').text(CategoryErrorText);
        }

    });
</script>

<script>
    function validate() {
        nameREGX = "[a-zA-Z0-9]+";
        var title = document.getElementById('title').value;
        var psuedoname = document.getElementById('psuedoname').value;

        var titleResult = nameREGX.test(title);
        var psuedonameResult = nameREGX.test(psuedoname);
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
        document.getElementById('visibility').value = 'public';
        document.getElementById("submit").value = '';
        document.getElementById("submit").innerText = 'Publish';
        document.getElementById("form_heading").innerText = 'Add Portfolio';

        document.getElementById('font_id').value = '';
        document.getElementById('category_id').value = '';
        $('.image-container').hide();
        $('.color-container').hide();
        $('html, body').animate({ scrollTop: $('#object-nav').offset().top }, 'slow');

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
    function editPortfolio(id) 
    { 
        $('html, body').animate({ scrollTop: $('#object-nav').offset().top }, 'slow');
        jQuery.ajax({
            type: "POST",
            dataType: "json",
            data: {
                "id": id
            },
            url: "/wp-admin/admin-ajax.php?action=get_portfolio_by_id_ajax",
            success: function(data) {
                data = data.data;
                if(data !== 'undefined' && data.length > 0)
                {
                    element = data[0];
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


                    $('#font_id').val(element.font_id).trigger('change');
                    $('#category_id').val(element.category_id).trigger('change');
                    $('#visibility').val(element.visibility).trigger('change');


                    document.getElementById('title').value = element.title;
                    // document.getElementById('contents').innerHTML = element.content;

                    $(tinymce.get('contents').getBody()).html(element.content);
                    if(element.type == 'color')
                    {
                        document.getElementById('color').value = element.image_url;
                        $('.image-container').hide();
                        $('.color-container').show();
                        $(".color-container").css("background-color", element.image_url);
                    }
                    else if(element.type == 'image')
                    {
                        document.getElementById('image').value = element.image_url;
                        $('.image-container').show();
                        $('.color-container').hide();
                        $('#bg-image').attr('src', element.image_url);
                    }
                    document.getElementById('psuedoname').value = element.psuedoname; 
                    document.getElementById("submit").value     = element.id;
                    document.getElementById("submit").innerText = "Update";
                    document.getElementById("form_heading").innerText = "Update Portfolio";
                }
            }
        })
    };

    //Preiew Portfolio from box
    function display(id) {
        console.log('here');
        $('#bd-example-modal-lg').modal({
            show: true
        });
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


            success: function(data) {
                data = data.data;
                if(data !== 'undefined' && data.length > 0)
                {
                    previewModalWrapper.classList.remove("hidden");

                    var font_id = data[0].font_id;
                    var title = data[0].title ? data[0].title : 'N/A';

                    var content = data[0].content ? data[0].content : 'N/A';
                    var color = data[0].image_url ? data[0].image_url : '#FFFFFF';
                    var psuedoname = data[0].psuedoname ? data[0].psuedoname : 'N/A';
                    var visibility = data[0].visibility;
                    console.log(color);

                    $('.preview-modal').removeAttr( 'style' );

                    $(".preview-modal").css("font-family", font_id);
                    if (color.length < 8) {

                        $('.preview-modal').css("background", color);

                    } else if (color.length > 8) {
                        $('.preview-modal').css({"background-image": `url(` + color + `)`, 'background-repeat': 'no-repeat', 'background-size': 'cover', 'background-position': 'center'});


                    }
                    $('#preview-title').html(title);
                    $('#preview-content').html(content);
                    $('#preview-writer').html(psuedoname);

                }
            }
        })
    };
</script>
<!-- Modal Data -->

<script>
    //for page reload category
    $(document).ready(function() {
        $('.color-container').hide();
        $('.image-container').hide();
            jQuery.ajax({
                type: "POST",
                dataType: "json",                
                data: {
                    "user_name": user_name
                },
                url: "/wp-admin/admin-ajax.php?action=get_portfolio_All_ajax", 
                success: function(data) {
                    append_portfolois(data);
                },

            })
        });

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
                    "cat_id": cat_id,
                    "user_name": user_name
                },
                url: url,
                success: function(data) {
                    append_portfolois(data);
                },

            })
    });

    function append_portfolois(data)
    {
        user_id = '<?php echo get_current_user_id() ?>';
        var html = '';
        $('#portfolio-list').empty();
        data = data.data;
        if(data.length == '0')
        {
            html += '<div class = "col-md-3 box">';
                html += '<h2>No Portfolio To Show </h2>';
                html += "</div>";

        } else {
                data.forEach(element => {
                    var p = '';
                    bg = element.image_url ? element.image_url : '#FFFFFF';

                    if (bg.length > 8) {
                        background = "background-image: url('" + bg + "')";

                    }
                    if (bg.length < 8) {
                        background = "background: " + bg + "";
                    }
                    psuedoname = (element.psuedoname && element.psuedoname != 'undefined') ? element.psuedoname : 'N/A';
                    content = (element.content && element.content != 'undefined') ? element.content : 'N/A';
                    html += `<div 
                                   class="col-md-6 my-3 preview-portfolio" data-idelems=`+element.id+`>
                                   <input type="hidden" id="idelem`+element.id+`" class="data-attributes" data-title="`+element.title+`" data-psuedoname="`+psuedoname+`"  />
                    <div  class="list-box flex-css preview-portfolio" data-idelems=`+element.id+` style="background-repeat: no-repeat;background-size: cover;padding:30px;background-position: center center;` + background + `">
                    <div  class="inner-name flex-css preview-portfolio" data-idelems=`+element.id+`>
                        <i class="fas fa-user preview-portfolio" data-idelems=`+element.id+`></i> <p  class="pl-2 data-idelems=`+element.id+` preview-portfolio">` + psuedoname + `</p>
                    </div>
                    <div class="action-icons">`;
                    if(user_id == element.user_id) {
                        html += `<a href="javascript:void(0)"  onclick="editPortfolio(` + element.id + `);ignorePreview(this)" class="px-2 ignore-preview">
                            <i class="fas fa-pen ignore-preview"></i>
                        </a>
                        <a href="javascript:void(0)" onclick="deletePortfolio(` + element.id + `);ignorePreview(this)" class="ignore-preview">
                            <i class="fas fa-trash-alt ignore-preview"></i>
                        </a>`
                    }
                    html += `</div>
                    <div style="word-break:break-word;"  class="text-list  preview-portfolio" data-idelems=`+element.id+` onclick="display(` + element.id + `)">
                        `+ content +`
                    </div>
                    </div>
                    </div>`;
                });
            }

        $('#portfolio-list').append(html);
    }

    $('#portfolio-list').on('click', '.preview-portfolio',function(e){
        if(e.target != this){
            return;
        }
        let element_id  = $(this).attr('data-idelems');
        let title       = $('#idelem'+element_id).attr('data-title');
        let psuedoname  = $('#idelem'+element_id).attr('data-psuedoname');
        let content     = $('#idelem'+element_id).attr('data-content');
        let bg          = $('#idelem'+element_id).attr('data-bg');

        
        previewModalWrapper.classList.remove("hidden");
            $('.preview-modal').removeAttr('style');

            if (bg.length == 7) {
                $('.preview-modal').css("background", bg);
            } else if (bg.length > 7) {
                $('.preview-modal').css({"background-image": `url(` + bg + `)`, 'background-repeat': 'no-repeat', 'background-size': 'cover', 'background-position': 'center'});
            }
           
            $('#preview-title').html(title);
            $('#preview-content').html(content);
            $('#preview-writer').html(psuedoname);
    });
    
    function ignorePreview(event)
    {
        // event.preventDefault();
        previewModalWrapper.classList.add("hidden");
    }

    $("#form").submit(function(event) {
        event.preventDefault();
        var buttonPress = document.getElementById('submit').innerText;
        console.log(buttonPress);
        if (buttonPress == 'Publish') 
        {
            var cat_id = $('#category_id').val();
            var font_id = $("#font_id option:selected").val();
            var title = $('#title').val();

            var content = $(tinymce.get('contents').getBody()).text();
            
            // var content = $('#contents').val();
            var color = $('#color').val().trim();
            var image = $('#image').val();
            var psuedoname = $('#psuedoname').val();
            var visibility = $("#visibility  option:selected").val();
            var TitleErrorText      =(title=='')?'Title field is required':'';
            var ContentErrorText    =(content=='')?'Content field is required':'';
            var PsuedonameErrorText =(psuedoname=='')?'Writer name field is required':'';
            var FontErrorText      =(font_id=='')?'Fonts field is required':'';
            var CategoryErrorText      =(cat_id=='')?'Category field is required':'';
            
            if(title == '' || content == '' || psuedoname == '' || font_id == '' || category == '')
            {
                console.log('test');
                $('#TitleError').text(TitleErrorText);
                $('#ContentError').text(ContentErrorText);
                $('#PsuedonameError').text(PsuedonameErrorText);
                $('#FontError').text(FontErrorText);
                $('#CategoryError').text(CategoryErrorText);
                return false;
            }

            if (title.length > 3 && psuedoname.length > 3) 
            {
                content = $(tinymce.get('contents').getBody()).html();
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
            } 
            else 
            {
                $('#submitModal').modal({
                    show: true
                });
            }
        } 
        else if (buttonPress == 'Update') 
        {
            var id = document.getElementById('submit').value;

            var cat_id     = $('#category_id').val();
            var font_id    = $("#font_id option:selected").val();
            var title      = $('#title').val(); 
            var content    = $(tinymce.get('contents').getBody()).text();

             // $('#contents').val();
            var color      = $('#color').val().trim();
            var image      = $('#image').val();
            var psuedoname = $('#psuedoname').val();
            var visibility = $("#visibility  option:selected").val();

            if(title == '' || content == '' || psuedoname == '' || font_id == '' || category == '')
            { 
                var TitleErrorText         =(title=='')?'Title field is required':'';
                var ContentErrorText       =(content=='')?'Content field is required':'';
                var PsuedonameErrorText    =(psuedoname=='')?'Writer name field is required':'';
                var FontErrorText          =(font_id=='')?'Fonts field is required':'';
                var CategoryErrorText      =(cat_id=='')?'Category field is required':'';
                $('#TitleError').text(TitleErrorText);
                $('#ContentError').text(ContentErrorText);
                $('#PsuedonameError').text(PsuedonameErrorText);
                $('#FontError').text(FontErrorText);
                $('#CategoryError').text(CategoryErrorText);
                return false;
            }

            if (title.length > 3 && psuedoname.length > 3) 
            {
                content = $(tinymce.get('contents').getBody()).html();

                $('#TitleError').text(""); 
                $('#PsuedonameError').text(""); 
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
            } 
            else 
            {
                TitleErrorText = "";
                if (title.length < 4)
                {
                    TitleErrorText      = 'Title must have characters greater then 3.'; 
                }
                
                PsuedonameErrorText = "";
                if (title.psuedoname < 4)
                {
                    PsuedonameErrorText      = 'Writer name must have characters greater then 3.'; 
                }
                 

                $('#TitleError').text(TitleErrorText); 
                $('#PsuedonameError').text(PsuedonameErrorText); 

                $('#submitModal').modal({
                    show: true
                });

            }
        }

    });
</script>
