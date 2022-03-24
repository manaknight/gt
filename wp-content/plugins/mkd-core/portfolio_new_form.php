<style type="text/css">
    .wp-editor-tabs{
        display: none;
    }
    @media (max-width: 320px) {
        .btn-list-container{
            width: 100%;
            text-align: center;
        }
    }
</style>
<div class="container-fluid main-form-container">
    <form class="form-container" enctype="multipart/form-data" name="portfolioForm" id="form">
        <div class="form-heading bg-light px-3 py-2">
            <h1 class="m-0" id="form_heading">Add Portfolio</h1>
        </div>
        <div class="inputs-container px-3">
        <div class="row">
                <div class="col-md-6">
                    <div class="form-group my-3">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input name="title" type="text" class="form-control" id="title">
                        <small id="TitleError" class="form-text text-danger"></small>
                    </div>
                </div>
            </div> 
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group my-3">
                        <label for="exampleFormControlTextarea1">Your Content <span class="text-danger">*</span></label>
                        <?php  
                            wp_editor( '', 'contents', array(
                                    'quicktags' => false,
                                    'media_buttons' => false,
                                    'textarea_rows' => 10,
                                    'teeny' => true,
                                    'tinymce'       => array( 'toolbar1'      => 'undo,redo'),
                                    'textarea_name' => "content",
                                ) );
                        ?> 
                        <small id="ContentError" class="form-text text-danger"></small>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group my-3">
                        <label for="title">Writer name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="psuedoname" id="psuedoname">
                        <small id="PsuedonameError" class="form-text text-danger"></small>
                    </div>
                </div>
            </div> 

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group my-3">
                        <label for="exampleFormControlSelect1">Fonts <span class="text-danger">*</span></label>
                        <?php
                            echo getFonts();
                        ?>
                        <small id="FontError" class="form-text text-danger"></small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group my-3">
                        <label for="exampleFormControlSelect1">Premade Background</label> <br>
                        <button class="bg-info choose-btn" id="choose-btn">Choose</button>
                        <button class="bg-danger choose-btn" id="remove-background">Remove</button>
                        <div class="background-preview">
                            <div class="image-container form-preview-container" style="display: none;">
                                <img id="bg-image" src="" alt=""/>
                            </div>
                            <div class="color-container form-preview-container" style="display: none;">
                            </div>
                        </div>
                        <input type="hidden" name="color" id="color">
                        <input type="hidden" name="image" id="image">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group my-3">
                        <label for="exampleFormControlSelect1">Category <span class="text-danger">*</span></label>
                        <?php
                            echo getCategory();
                        ?>
                        <small id="CategoryError" class="form-text text-danger"></small>
                    </div>
                </div>
            </div>

            <div class="last-input flex-css-row-sb pb-4">
                <div class="form-group mt-3 mb-5">
                    <label for="exampleFormControlSelect1">Visibility <span class="text-danger">*</span></label>
                    <select class="form-control public-input" name="visibility" id="visibility">
                        <option value="public">Public</option>
                        <option value="private">Private</option>
                    </select>
                </div>
                <div class="btn-list-container">
                    <button type="button" class="btn btn-info validate-preview" name="preview" id="preview-btn">Preview</button>
                    <button type="button" onclick="clearValues()" class="bg-danger">Cancel</button>
                    <button type="submit" id="submit" name="submit" value="submit" class="bg-success">Publish</button>
                </div>
            </div>

        </div>
    </form>
</div>