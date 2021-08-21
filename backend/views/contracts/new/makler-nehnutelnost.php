<?php
use yii\helpers\Url;
use backend\assets\RealAsset;
$this->title="Nová zákazka";

$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.1/jquery-confirm.min.css',['depends'=>RealAsset::className()]);
$this->registerJSFile('https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.1/jquery-confirm.min.js',['depends'=>RealAsset::className()]);

$this->registerJSFile('@web/assets/fine-uploader/fine-uploader.min.js',['depends'=>RealAsset::className()]);
$this->registerCSSFile('@web/assets/fine-uploader/fine-uploader.min.css',['depends'=>RealAsset::className()]);
$this->registerCSSFile('@web/assets/fine-uploader/fine-uploader-gallery.min.css',['depends'=>RealAsset::className()]);
$this->registerCSSFile('@web/assets/fine-uploader/fine-uploader-new.min.css',['depends'=>RealAsset::className()]);

?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title?></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <form action="<?=Url::to(['contracts/save-makler-nehnutelnost'])?>" method="post" enctype="multipart/form-data" id="form-makler">
                <input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
                <input type="hidden" name="Data[zmluva_id]" value="<?= $zmluva_id ?>" id="zmluva-id">

                <div class="card">
                    <div class="card-header bg-info">
                        <h4 class="mb-0 text-white">Identifikačné údaje zmluvy</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-body">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label class="control-label">Číslo zákazky</label>
                                        <input type="text" class="form-control" name="Data[cislo]" value="<?= $contract_number ?>" id="zmluva-cislo">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Maklér</label>
                                        <select class="form-control select-drop" name="Data[agent][id]" id="main-agent" onchange="getComission()">
                                            <option value="">-- Zvoľte makléra --</option>
                                            <?php
                                            $selected='';
                                            if (count($agents) == 1) {
                                                $selected = " selected";
                                            }
                                            foreach($agents as $item) {
                                                echo "<option value={$item['id']} data-content={$item['comission']}{$selected}>{$item['agent_name']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="control-label">Stupeň</label>
                                        <?php
                                        $comission = 0;
                                        if (count($agents)==1) {
                                            $comission = $agents[0]['comission'];
                                        }
                                        ?>
                                        <input
                                                type="text"
                                                class="form-control"
                                                name="Data[agent][comission]"
                                                id="main-comission"
                                                value="<?= $comission ?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-info">
                        <h4 class="mb-0 text-white">Typ nehnuteľnosti</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label class="control-label">Kategória nehnuteľnosti</label>
                                <select class="form-control select-drop" name="Data[kategoria]" id="kategoria">
                                    <option value="">Zvolte kategoriu</option>
                                    <?php
                                    foreach ($kategorie as $item) {
                                        echo "<option value={$item['id']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label class="control-label">Druh nehnuteľnosti</label>
                                <select class="form-control select-drop" name="Data[druh_nehnut]" id="nehnut-druh">
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-info">
                        <h4 class="mb-0 text-white">List valstníctva</h4>
                    </div>

                    <script type="text/template" id="qq-template-manual-trigger">
                        <div class="qq-uploader-selector qq-uploader" qq-drop-area-text="Drop files here">
                            <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
                                <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
                            </div>
                            <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
                                <span class="qq-upload-drop-area-text-selector"></span>
                            </div>
                            <div class="buttons">
                                <div class="qq-upload-button-selector qq-upload-button">
                                    <div>Súbory</div>
                                </div>
                                <button type="button" id="trigger-upload" class="btn btn-primary upload-trigger">
                                    <i class="fa fa-upload"></i> Nahrať
                                </button>
                                <button type="button" id="trigger-remove" class="btn btn-danger" style="padding: 7px 20px;">
                                    <i class="fa fa-trash-alt"></i>&nbsp;&nbsp;Zmazať
                                </button>

                            </div>
                            <span class="qq-drop-processing-selector qq-drop-processing">
                                <span>Processing dropped files...</span>
                                <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
                            </span>
                            <ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals" id="qq-upload-list">
                                <li>
                                    <div class="qq-progress-bar-container-selector">
                                        <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                                    </div>
                                    <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                                    <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>
                                    <span class="qq-upload-file-selector qq-upload-file"></span>
                                    <span class="qq-edit-filename-icon-selector qq-edit-filename-icon" aria-label="Edit filename"></span>
                                    <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                                    <span class="qq-upload-size-selector qq-upload-size"></span>
                                    <button type="button" class="qq-btn qq-upload-cancel-selector qq-upload-cancel">Zrušiť</button>
                                    <button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry">Znovu</button>
                                    <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">Zmazať</button>
                                    <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
                                </li>
                            </ul>

                            <dialog class="qq-alert-dialog-selector">
                                <div class="qq-dialog-message-selector"></div>
                                <div class="qq-dialog-buttons">
                                    <button type="button" class="qq-cancel-button-selector">Close</button>
                                </div>
                            </dialog>

                            <dialog class="qq-confirm-dialog-selector">
                                <div class="qq-dialog-message-selector"></div>
                                <div class="qq-dialog-buttons">
                                    <button type="button" class="qq-cancel-button-selector">No</button>
                                    <button type="button" class="qq-ok-button-selector">Yes</button>
                                </div>
                            </dialog>

                            <dialog class="qq-prompt-dialog-selector">
                                <div class="qq-dialog-message-selector"></div>
                                <input type="text">
                                <div class="qq-dialog-buttons">
                                    <button type="button" class="qq-cancel-button-selector">Cancel</button>
                                    <button type="button" class="qq-ok-button-selector">Ok</button>
                                </div>
                            </dialog>
                        </div>
                    </script>

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <div id="fine-uploader-manual-trigger" class="fine-uploader-manual-trigger"></div>
                        </div>
                    </div>
                </div>

                <div class="card" id="identifikovany-majitelia">
                    <div class="card-header bg-info">
                        <h4 class="mb-0 text-white">Identifikovaný majitelia</h4>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="table-identifikovany-majitelia" class="table color-table muted-table hover-table" style="margin-left: 10px; margin-right: 10px; margin-top: 10px; width: 99%">
                                </table>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="card">
                    <div class="form-actions">
                        <div class="card-body">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-arrow-circle-right"></i>&nbsp;Pokračovať</button>
                            <button type="button" class="btn btn-dark" onclick="redirectTo('<?= Url::to(['/contracts'])?>')" ><i class="fa fa-times-circle"></i>&nbsp;Zrušiť</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$urlKategorie = Url::to(['contracts/vrat-kategorie']);
$urlZmazatLv = Url::to(['contracts/zmaz-lv']);

$js = <<< JS
    $("#main-agent").on('change',function(){
        var agent = $(this).val();
        if (agent != '') {
            $(this).removeClass('is-invalid');
        }
    });

    $("#kategoria").on('change',function(){
        var kategoria = $(this).val();
        if (kategoria != '') {
            $(this).removeClass('is-invalid');
        }
    });

    
    
    $("#form-makler").submit(function(){
       var agent = $("#main-agent").val();
       var return_val = true;
       var kategoria = $("#kategoria").val();
       
       if (agent == '') {
           $("#main-agent").addClass("is-invalid");
           return_val = false;
       }
       
       if (kategoria == '') {
           $("#kategoria").addClass("is-invalid");
           return_val = false;
       }
       
       if (!return_val) {
           $.confirm({
                    title: 'Chyba',
                    content: 'Formulár obsahuje chyby!',
                    type:'red',
                    typeAnimated: true,
                    buttons: {
                        close: function () {
                        }
                    }
                });
       }
       
       return return_val;
    });
    
    redirectTo = function(url)
    {
        $.confirm({
            title: 'Skončiť',
            content: 'Naozaj chcete skončiť?',
            buttons: {
                ano: function () {
                    window.location.replace(url);
                },
                nie: function () {
                }
            }
        });
    }
    
    getComission = function()
    {
        var agent = $('#main-agent');
        var comission = agent.find(':selected').data("content");
        $('#main-comission').val(comission);
    }
    
	$('#kategoria').on('change',function(){
       var kategoria = $(this).val();
       manualUploader.setParams({
            cislo: $('#zmluva-cislo').val(),
            kategoria: $('#kategoria').val()
       });
       $.ajax({
            url: '{$urlKategorie}',
            dataType: 'json',
            data: {kat:kategoria},
            success: function(data) {
                $('#nehnut-druh').empty();
                $('#nehnut-druh').html(data.items);
            }
       });
    });
    
     var manualUploader = new qq.FineUploader({
        element:document.getElementById('fine-uploader-manual-trigger'),
        template:'qq-template-manual-trigger',
        request:{
            endpoint:'/backoffice/contracts/upload-lv',
            params:{
                
            }
        },
        thumbnails:{
            placeholders:{waitingPath:'/backoffice/assets/fine-uploader/placeholders/waiting-generic.png',
            notAvailablePath:'/backoffice/assets/fine-uploader/placeholders/not_available-generic.png'}
        },
        autoUpload:false,
        callbacks:{
            onError: function(id, name, errorReason, xhrOrXdr) {
                $.confirm({
                    title: 'Chyba',
                    content: errorReason,
                    type:'red',
                    typeAnimated: true,
                    buttons: {
                        close: function () {
                        }
                    }
                });
            },
            onComplete: function(id, name, responseJSON, xhrOrXdr) {
                console.log(responseJSON.items);
                $('#table-identifikovany-majitelia').empty().append(responseJSON.items);
            }
        }
    });
    
    qq(document.getElementById("trigger-upload")).attach("click",function(){
        manualUploader.uploadStoredFiles();
    });
    
    qq(document.getElementById("trigger-remove")).attach("click",function(){
        $.ajax({
            url: '{$urlZmazatLv}',
            dataType: 'json',
            data: {cislo: $('#zmluva-cislo').val()},
            success: function(data) {
                $('#qq-upload-list').empty();
                $('#table-identifikovany-majitelia').empty().append(data.items);
            }
       });
        
    });
JS;

$this->registerJS($js);

$css = <<< CSS
    .upload-trigger {
        color: white;
        background-color: #00ABC7;
        font-size: 14px;
        padding: 7px 20px;
        background-image: none;
    }

    .fine-uploader-manual-trigger .qq-upload-button {
        margin-right: 15px;
    }

    .fine-uploader-manual-trigger .buttons {
        width: 36%;
    }

    .fine-uploader-manual-trigger .qq-uploader .qq-total-progress-bar-container {
        width: 60%;
    }

    a.upload-reset {
        color: white !important;
        font-weight: 500;
        
    }
    .has-error {border:1px solid rgb(185, 74, 72) !important;}
CSS;

$this->registerCSS($css);

?>
