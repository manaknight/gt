<?php include_once 'portfolio_code_add.php'; ?>


<!-- link  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/sanjaya007/flex-library@master/dist/css/sanjaya.min.css" crossorigin="anonymous">
<!-- css starts -->
<style>
    .main-form-container{
        background-color: rgb(254, 254, 254);
        box-shadow: rgb(0 0 0 / 16%) 0px 1px 4px;
        padding: 0;
    }

    .main-form-container .form-container .form-heading{
        <!-- border: 1px solid #d9d9d9; -->
    }

    .main-form-container .form-container .form-heading h1{
        font-size: 18px;
    }

    .main-form-container .form-container .inputs-container .choose-btn{
        border-radius: 3px;
        padding: 7px 25px;
        border-color: transparent;
    }

    .main-form-container .form-container .inputs-container .btn-list-container button{
        border-radius: 3px;
        padding: 7px 25px;
        border-color: transparent;
    }

    .main-form-container .form-container .inputs-container .public-input{
        min-width: 100px;               
    }


    .color-modal-wrapper{
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 999;
    }

    .color-modal-wrapper.hidden{
        display: none;
    }

    .color-modal{
        background-color: #ffffff;
        width: 70%;
        position: relative;
    }

    .color-modal .close-icon{
        text-decoration: none;
        color: #000000;
        position: absolute;
        top: 10px;
        right: 24px;
    }
    
    .color-modal .inner-modal{
        /* min-height: 50vh; */
        border: 1px solid #c9c9c9;
    }
    .color-modal .modal-tabs{
        margin-bottom: -1px;
    }

    .color-modal .modal-tabs .tab-link{
        text-decoration: none;
        color: #000000;
        padding: 5px 15px;
    }
    
    .color-modal .modal-tabs .tab-link.active{
        background-color: #ffffff;
        border-radius: 6px 6px 0 0;
        border: 1px solid #c9c9c9;
        border-bottom: 1px solid #ffffff;
    }

    .color-modal .inner-modal .tab-container.hidden{
        display: none;
    }

    .preview-modal-wrapper{
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 999;
    }

    .preview-modal-wrapper.hidden{
        display: none;
    }

    .preview-modal{
        background-color: #ffffff;
        width: 70%;
        position: relative;
    }

    .preview-modal .preview-content{
        min-height: 50vh;
    }

    .preview-modal .preview-content p{
        color: #000000;
        margin: 0;
        word-break: break-word;
    }

    .preview-modal .preview-title p{
        color: #000000;
        font-weight: bold;
        margin: 0;
        font-size: 18px;
    }

    .preview-modal .preview-writer p{
        color: #000000;
        margin: 0;
    }

    .preview-modal .preview-close-icon{
        color: #000000;
        text-decoration: none;
        position: absolute;
        top: 5px;
        right: 16px;
    }

    #palette{
        overflow-y: auto;
    }

    .modal-img-container{
        min-height: 42vh;
        max-height: 42vh;
        overflow-y: auto;
    }

    #palette li{
        min-height: 40px;
        max-height: 40px;
        min-width: 40px;
        max-width: 40px;
        list-style-type: none;
        margin: 1px;
        cursor: pointer;
    }

    #palette li.active{
        border: 2px solid #000000 !important;
        opacity: 0.7;
        transform: scale(0.9);
    }

    .form-preview-container{
        min-height: 70px;
        max-height: 70px;
        min-width: 70px;
        max-width: 70px;
        margin-top: 10px;
        height: 70px;
        width: 70px;
    }

    .form-preview-container img{
        height: 100%;
        width: 100%;
        object-fit: cover;
    }

    .modal-img{
        position: relative;
    }

    .modal-img-list{
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-img-list.hidden{
        display: none;
    }

    .modal-img-list i{
        color: #ffffff;
        position: absolute;
        top: 5px;
        right: 5px;
    }

    #select_image{
        border-radius: 3px;
        padding: 7px 25px;
        border-color: transparent;
    }

    #select_color{
        border-radius: 3px;
        padding: 7px 25px;
        border-color: transparent;
    }

    @media (max-width: 1497px){
        #palette{
        min-height: 33vh;
        max-height: 33vh;
        overflow-y: auto;
    }
    }
    

    @media (max-width: 767px){
        .last-input{
            flex-direction: column;
            align-items: flex-start;
        }
        .color-modal{
            width: 80%;
        }
        .preview-modal{
            width: 80%;
        }
    }

    @media (max-width: 550px){
        .color-modal{
            width: 90%;
        }
        .preview-modal{
            width: 90%;
        }
    }

    @media (max-width: 450px){
        .main-form-container .form-container .inputs-container .choose-btn{
            font-size: 14px;
            padding: 5px 16px;
        }
        .main-form-container .form-container .inputs-container .btn-list-container button{
            font-size: 14px;
            padding: 5px 16px;
        }
        .main-form-container label{
            font-size: 14px;
        }
        .main-form-container .form-control{
            font-size: 14px;
        }
        .preview-container label{
            font-size: 14px;
        }
        .preview-container .form-control{
            font-size: 14px;
        }
        .color-modal{
            width: 95%;
        }
        .preview-modal{
            width: 95%;
        }
        #palette li{
        min-height: 30px;
        max-height: 30px;
        min-width: 30px;
        max-width: 30px;
        }
    }

    @media (max-width: 350px){
        .main-form-container .form-container .inputs-container .choose-btn{
            font-size: 12px;
            padding: 5px 14px;
        }
        .main-form-container .form-container .inputs-container .btn-list-container button{
            font-size: 12px;
            padding: 5px 14px;
        }
    }


</style>
<!-- css ends  -->
<style>
        .preview-container .filter-container select{
        min-width: 100px;
    }

    .preview-container .preview-list .list-box{
        background-color: #f8c76e;
        min-height: 400px;
        max-height: 400px;
    }

    .preview-container .preview-list .list-box .text-list p{
        margin: 0;
        color: #000000;
        font-size: 16px;
        font-weight: bold;
        margin-top: 15px;
    }

    .preview-container .preview-list .list-box{
        position: relative;
        cursor: pointer;
    }

    .preview-container .preview-list .list-box .inner-name {
        position: absolute;
        left: 10px;
        top: 5px;
        display: none;
    }

    .preview-container .preview-list .list-box .inner-name i{
        color: #000000;
    }

    .preview-container .preview-list .list-box .inner-name p{
        color: #000000;
        font-size: 14px;
        margin: 0;
        font-weight: bold;
    }

    .preview-container .preview-list .list-box .action-icons {
        position: absolute;
        right: 10px;
        top: 5px;
        display: none;
    }

    .preview-container .preview-list .list-box .action-icons a{
        color: #000000;
        text-decoration: none;
    }

    .preview-container .preview-list .list-box:hover .inner-name{
        display: flex;
    }

    .preview-container .preview-list .list-box:hover .action-icons{
        display: flex;
    }
    /*Haider's CSS*/
    @media (max-width: 320px) {
        .preview-content-box{
            width: 100%;
            overflow: auto;
            text-align: center;
        }
        .preview-container .preview-list .list-box:hover .inner-name{
            display: flex;
            left: -17;
            top: -17;
        }

        .preview-container .preview-list .list-box:hover .action-icons{
            display: flex;
            right: -17;
            top: -17;
        }
    } // 320 ends here
    /*Haider's CSS ends here*/

</style>
<?php if(get_current_user_id() == bbp_get_user_id() ) {
    include_once 'portfolio_new_form.php';
}?>

<div class="container-fluid preview-container p-0">
    <div class="filter-container flex-css-end">
        <div class="form-group flex-css-end">
            <label class="pr-2">Filter</label>
                <?php echo getCategories(); ?>
        </div>
    </div>
    <div class="preview-list">
        <div class="row" id="portfolio-list">
        </div>
    </div>
</div>


<div class="preview-modal-wrapper hidden flex-css" id="preview-modal-wrapper">
    <div class="preview-modal p-3">
        <a href="javascript:void(0)" class="preview-close-icon" id="preview-close-icon">
            <i class="fas fa-times"></i>
        </a>
        <div class="preview-title flex-css-start">
            <p id="preview-title">Title</p>
        </div>
        <div class="preview-content flex-css">
            <div class="preview-content-box">
                <p id="preview-content">Content</p>
            </div>
        </div>
        <div class="preview-writer flex-css-end">
            <p id="preview-writer">Writer</p>
        </div>
    </div>
</div>


<div class="color-modal-wrapper hidden flex-css" id="color-modal-wrapper">
    <div class="color-modal p-4">
        <a href="javascript:void(0)" class="close-icon" id="close-icon">
            <i class="fas fa-times"></i>
        </a>
        <div class="modal-tabs flex-css">
            <a href="javascript:void(0)" class="tab-link active" id="color-tab">Color</a>
            <a href="javascript:void(0)" class="tab-link" id="images-tab">Images</a>
        </div>
        <div class="inner-modal p-3">
            <div class="tab-container" id="color-tab-content">
                Name: <span id="name"></span>&emsp;Hex: <span id="hex"></span>
                <ul id="palette" class="flex-css-row-start-wrap m-0 my-4">
                </ul>
                <button class="btn btn-info" id="select_color">Select</button>
                <input type="hidden" name="hex_color" id="hex_color">
            </div>
            <div class="tab-container hidden" id="images-tab-content">
                <div class="modal-img-container">
                    <?php
                    echo getBackgroundImages();
                    ?>
                </div>
                <button class="btn btn-info" id="select_image">Select</button>
                <input type="hidden" name="bg_image" id="bg_image">
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<?php include_once 'portfolio_script.php'; ?>
<?php include_once 'color_image_modal.php'; ?>