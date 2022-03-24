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
    
    .bs-bp-container{
        width:100% !important;
    }
    .bb-grid-cell, .bb-grid>* {
        flex: none !important;
    }
    .item-body{
        width: 100% !important;
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
<div id="bp-nouveau-activity-form" class="activity-update-form">

    <form data-="multipart/form-data" onsubmit="return validate()" name="portfolioForm" id="form">
        <div id="whats-new-avatar">

            <span class="mt-3"> <b id="form_heading">Add Portfolio</b></span>
        

        </div>
        <label for="textarea">Your Content </label>
        <div class="form-group ">

            <textarea name="content" class="form-control" id="contents" rows="4"></textarea>
        </div>


        <div class="row">
            <div class="col-md-6">
                <label for="title">Title <span style="color: tomato;">*</span></label>
                <input type="text" class="form-control required" name="title" id="title" minlength="4" maxlength="70">
                <p style="color: red;" id="TitleError"></p>

            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="psuedoname">Writer Name <span style="color: tomato;">*</span></label>
                <input type="text" class="form-control " name="psuedoname" id="psuedoname" title="psuedoname" minlength="4" maxlength="50">
                <p style="color: red;" id="PsuedonameError"></p>

            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <label for="fonts"> Fonts</label><br>
                <?php
                echo getFonts();
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div> <label for="favcolor">Premade Background</label>
                    <input type="hidden" name="color" id="color">
                    <input type="hidden" name="image" id="image">

                </div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                    Choose
                </button>
            </div>
        </div>


        <div class="row mt-2">
            <div class="col-md-6">
                <label for="category"> Category</label><br>
                <?php
                echo getCategory();
                ?>

            </div>
        </div>


        <div class="row mt-5">
            <div class="col-md-6">
                <label for="visibility"> Visibility</label><br>
                <select class="form-select" name="visibility" id="visibility" aria-label="Default select example">
                    <option value="public">Public</option>
                    <option value="private">Private</option>
                </select>
            </div> 
        </div>

        <div class="row mt-3">
            <div class="col-md-8">

            </div>
            <div class="col-md-4 btn-groups">
                <!-- data-toggle="modal" data-target=".bd-example-modal-lg" name="preview" -->
                <button type="button" class="btn btn-info validate-preview"  id="preview">Preview</button>

                <input type="button" class="bg-dark" value="Cancel">

                <button type="submit" id="submit" name="submit" value="submit">Publish</button>

            </div>
        </div>
    </form>
 
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $('.validate-preview').click(function()
    {
        let title       =$('#title').val();
        let psuedoname  =$('#psuedoname').val();
        let validation_failure=0;
        if(title ==''){
            $('#TitleError').text('Title Field is required');
            validation_failure=1;
        }
        else{
            $('#TitleError').text('');
        }
        if(psuedoname ==''){
            $('#PsuedonameError').text('Writer Name Field is required');
            validation_failure=1;
        }
        else{
            $('#PsuedonameError').text('');
        }
        if(validation_failure == 0)
        {
            $('.bd-example-modal-lg').modal('toggle');
        }else{
            alert("Please fix errors")
        }
    })
</script>

 