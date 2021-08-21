<div class="card">
    <div class="card-header bg-info">
        <h4 class="mb-0 text-white">Izba č. <?= $i ?></h4>
    </div>
    <div class="card-body">
        <input type="hidden" name="Data[izba][<?= $i ?>][order_id]]" value="<?= $i ?>" id="order-id-<?= $i ?>" class="to-store">
        <div class="row">
            <div class="col-md-12 form-group">
                <label class="control-label">Názov izby</label>
                <select name="Data[izba][<?= $i ?>][nazov]" class="form-control select-drop to-store" id="izba-nazov-<?= $i ?>">
                    <option value="">Vyberte alebo zadajte názov izby</option>
                    <?php
                    foreach($nazov_izieb as $item){
                        echo "<option value='{$item['id']}'>{$item['nazov']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-group">
                <label class="control-label">Poschodie</label>
                <input type="text" name="Data[izba][<?= $i ?>][poschodie]" class="form-control to-store" id="izbz-poschodie-<?= $i ?>">
            </div>
            <div class="col-md-6 form-group">
                <label class="control-label">Plocha (m<sup>2</sup>)</label>
                <input type="text" name="Data[izba][<?= $i ?>][plocha]" class="form-control to-store" id="frm-plocha-<?= $i ?>" value="0">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-group">
                <label class="control-label">Šírka (m)</label>
                <input type="text" name="Data[izba][<?= $i ?>][sirka]" class="form-control to-store" id="frm-sirka-<?= $i ?>" value="0">
            </div>

            <div class="col-md-6 form-group">
                <label class="control-label">Dĺžka (m)</label>
                <input type="text" name="Data[izba][<?= $i ?>][dlzka]" class="form-control to-store" id="frm-dlzka-<?= $i ?>" value="0">
            </div>

        </div>

        <div class="row">
            <div class="col-md-6 form-group">
                <label class="control-label">Povrch steny</label>
                <select
                        class="form-control select-drop to-store"
                        name="Data[izba][<?= $i ?>][povrch_stena]"
                        id="dat-povrch-<?= $i ?>"
                >
                    <option value="">Zvoľte povrch steny</option>
                    <?php
                    foreach ($povrch_steny as $item) {
                        echo "<option value={$item['id']}>{$item['nazov']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6 form-group" id="col-<?= $i ?>">
                <label class="control-label">Farba steny</label>
                <br>
                <button class="btn btn-success" onclick="return add_color(<?= $i ?>);" id="btn-plus"><i class="fas fa-plus"></i>&nbsp; Pridat farbu</button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-group">
                <label class="control-label">Podlaha</label>
                <select name="Data[izba][<?= $i ?>][podlaha][]" class="form-control select-drop to-store" id="podlaha-<?= $i ?>" multiple>
                    <?php
                    $podlahaArray = isset($basic_info) && $basic_info['podlaha'] != '' ? explode(',',$basic_info['podlaha']) : [];
                    foreach ($podlaha as $item) {
                        $selected = in_array($item['id'],$podlahaArray) ? ' selected' : '';
                        echo "<option value={$item['id']}{$selected}>{$item['nazov']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6 form-group">
                <label class="control-label">Kúrenie</label>
                <select name="Data[izba][<?= $i ?>][kurenie][]" class="form-control select-drop to-store" id="kurenie-<?= $i ?>" multiple>
                    <?php
                    $kurenieArray = isset($basic_info) && $basic_info['kurenie'] != '' ? explode(',',$basic_info['kurenie']) : [];
                    foreach($kurenie as $item) {
                        $selected = in_array($item['id'],$kurenieArray) ? ' selected' : '';
                        echo "<option value={$item['id']}{$selected}>{$item['nazov']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-group">
                <label class="control-label">Okno</label>
                <select name="Data[izba][<?= $i ?>][okno][]" class="form-control select-drop to-store" id="okno-<?= $i ?>" multiple>
                    <?php
                    $oknoArray = isset($basic_info) && $basic_info['okno'] != '' ? explode(',',$basic_info['okno']) : [];
                    foreach ($okno as $item) {
                        $selected = in_array($item['id'],$oknoArray) ? ' selected' : '';
                        echo "<option value={$item['id']}{$selected}>{$item['nazov']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6 form-group">
                <label class="control-label">Nábytok</label>
                <select name="Data[izba][<?= $i ?>][nabytok][]" class="form-control select-drop to-store" id="nabytok-<?= $i ?>" multiple>
                    <?php
                    foreach ($nabytok as $item) {
                        echo "<option value={$item['id']}>{$item['nazov']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-group">
                <label class="control-label">Osvetlenie</label>
                <select name="Data[izba][<?= $i ?>][osvetlenie][]" class="form-control select-drop to-store" id="osvetlenie-<?= $i ?>" multiple>
                    <?php
                    foreach ($osvetlenie as $item) {
                        echo "<option value={$item['id']}>{$item['nazov']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6 form-group">
                <label class="control-label">Stena</label>
                <select name="Data[izba][<?= $i ?>][stena][]" class="form-control select-drop to-store" id="stena-<?= $i ?>" multiple>
                    <?php
                    $stenaArray = isset($basic_info) && $basic_info['stena'] != '' ? explode(',',$basic_info['stena']) : [];
                    foreach ($stena as $item) {
                        $selected = in_array($item['id'],$stenaArray) ? ' selected' : '';
                        echo "<option value={$item['id']}{$selected}>{$item['nazov']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-group">
                <input type="checkbox" name="Data[izba][<?= $i ?>][balkon]" value="1" class="to-store" id="izba-balkon-<?= $i ?>">&nbsp;
                <label class="control-label">Balkón</label>
            </div>
            <div class="col-md-6 form-group">
                <input type="checkbox" name="Data[izba][<?= $i ?>][francuzsky_balkon]" value="1" class="to-store" id="izba-francuzsky-<?= $i ?>">&nbsp;
                <label class="control-label">Francúzsky balkón</label>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-group">
                <input type="checkbox" name="Data[izba][<?= $i ?>][terasa]" value="1" class="to-store" id="izba-terasa-<?= $i ?>">&nbsp;
                <label class="control-label">Terasa</label>
            </div>
            <div class="col-md-6 form-group">
                <input type="checkbox" name="Data[izba][<?= $i ?>][klima]" value="1" class="to-store" id="izba-klima-<?= $i ?>">&nbsp;
                <label class="control-label">Klíma</label>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-group">
                <input type="checkbox" name="Data[izba][<?= $i ?>][ventilator]" value="1" class="to-store" id="izba-ventilator-<?= $i ?>">
                <label class="control-label">Ventilátor</label>
            </div>
            <div class="col-md-6 form-group">
            </div>
        </div>

        <script type="text/template" id="qq-template-manual-trigger-<?= $i?>">
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
                    <button type="button" id="trigger-upload-<?= $i ?>" class="btn btn-primary upload-trigger">
                        <i class="fa fa-upload"></i> Nahrať
                    </button>
                </div>
                <span class="qq-drop-processing-selector qq-drop-processing">
                                <span>Processing dropped files...</span>
                                <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
                            </span>
                <ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals" id="qq-upload-list-<?= $i?>">
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
            <div class="col-md-5">
                <a class="btn btn-danger upload-reset" id="upload-reset-<?= $i?>"><i class="fa fa-recycle"></i>&nbsp;Reset</a>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-12 form-group">
                <div id="fine-uploader-manual-trigger-<?= $i ?>" class="fine-uploader-manual-trigger"></div>
            </div>
        </div>

    </div>
</div>

<?php

$js = <<< JS

    $("#frm-plocha-{$i}").on('click',function(){
       $(this).val(''); 
    }).on('blur',function(){
        let p = parseFloat($(this).val());
        let s = parseFloat($("#frm-sirka-{$i}").val());
        let d = parseFloat($("#frm-dlzka-{$i}").val());
                
        if(isNaN(p)) {
            $(this).val(0);
        }
        if (p>0 && s>0) {
            $("#frm-dlzka-{$i}").val(roundNum(p/s,2));
        } else if (p>0 && d>0) {
            $("#frm-sirka-{$i}").val(roundNum(p/d,2));
        }
    });
    $("#frm-sirka-{$i}").on('click',function(){
       $(this).val(''); 
    }).on('blur',function(){
       let p = parseFloat($("#frm-plocha-{$i}").val());
       let s = parseFloat($(this).val());
       let d = parseFloat($("#frm-dlzka-{$i}").val());
       if(isNaN(s)) {
           $(this).val(0);
       }
       if (s>0 && p>0) {
           $("#frm-dlzka-{$i}").val(roundNum(p/s,2));
       } else if (s>0 && d>0) {
           $("#frm-plocha-{$i}").val(s*d);
       }
    });
    $("#frm-dlzka-{$i}").on('click',function(){
       $(this).val(''); 
    }).on('blur',function(){
       let p = parseFloat($("#frm-plocha-{$i}").val());
       let s = parseFloat($("#frm-sirka-{$i}").val());
       let d = parseFloat($(this).val());
       if(isNaN(d)) {
           $(this).val(0);
       }
       if (d>0 && p>0) {
           $("#frm-sirka-{$i}").val(roundNum(p/d,2));
       } else if (s>0 && d>0) {
           $("#frm-plocha-{$i}").val(s*d);
       }

    });
    $("#dat-add-2-list-{$i}").on("click",function(){
        console.log($("#dat-farba-{$i}").val());
        return false;
    });
    $("#podlaha-{$i}").select2({
        theme: "bootstrap",
        placeholder: "Vyberte typ podlahy",
        tags:true
    });
    $("#kurenie-{$i}").select2({
        theme: "bootstrap",
        placeholder: "Vyberte typ kúrenia",
        tags:true
    });
    $("#okno-{$i}").select2({
        theme: "bootstrap",
        placeholder: "Vyberte typ okna",
        tags: true
    });
    $("#nabytok-{$i}").select2({
        theme: "bootstrap",
        placeholder: "Vyberte typ nábytku",
        tags: true
    });
    $("#osvetlenie-{$i}").select2({
        theme: "bootstrap",
        placeholder: "Vyberte typ osvetlenia",
        tags: true
    });
    $("#stena-{$i}").select2({
        theme: "bootstrap",
        placeholder: "Vyberte typ steny",
        tags: true
    });
JS;

$this->registerJS($js);

$js = <<< JS
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var manualUploader_{$i} = new qq.FineUploader({
        element:document.getElementById('fine-uploader-manual-trigger-{$i}'),
        template:'qq-template-manual-trigger-{$i}',
        request:{
            endpoint:'/backoffice/contracts/upload-image',
            params:{
                zmluva_id: {$_GET['id']},
                miestnost_id: {$i}
            }
        },
        thumbnails:{
            placeholders:{waitingPath:'/backoffice/assets/fine-uploader/placeholders/waiting-generic.png',
            notAvailablePath:'/backoffice/assets/fine-uploader/placeholders/not_available-generic.png'}
        },
        autoUpload:false,
        multiple: true,
        camera: true,
        debug:true,
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
            }
        }
    });
    
    qq(document.getElementById("trigger-upload-{$i}")).attach("click",function(){
        manualUploader_{$i}.uploadStoredFiles();
    });
JS;

$this->registerJS($js);

$js = <<< JS
    $("#upload-reset-{$i}").on("click",function(){
        $('#qq-upload-list-{$i}').empty();   
    });
JS;

$this->registerJS($js);


?>