<div class="card">
    <div class="card-header bg-info">
        <h4 class="mb-0 text-white">Kuchyňa č. <?= $i ?></h4>
    </div>
    <div class="card-body">
        <input type="hidden" name="Data[kuchyna][<?= $i ?>][order_id]]" value="<?= $i ?>" class="to-store" id="order-id-<?= $i ?>">

        <div class="form-row">
            <div class="col-md-6 form-group">
                <label class="control-label">Poschodie</label>
                <input type="text" name="Data[kuchyna][<?= $i ?>][poschodie]" class="form-control to-store" id="poschodie-<?= $i ?>">
            </div>
            <div class="col-md-6 form-group">
                <label class="control-label">Plocha (m<sup>2</sup>)</label>
                <input type="text" name="Data[kuchyna][<?= $i ?>][plocha]" class="form-control to-store" value="0" id="frm-plocha-<?= $i ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6 form-group">
                <label class="control-label">Šírka (m)</label>
                <input type="text" name="Data[kuchyna][<?= $i ?>][sirka]" class="form-control to-store" value="0" id="frm-sirka-<?= $i ?>">
            </div>

            <div class="col-md-6 form-group">
                <label class="control-label">Dĺžka (m)</label>
                <input type="text" name="Data[kuchyna][<?= $i ?>][dlzka]" class="form-control to-store" value="0" id="frm-dlzka-<?= $i ?>">
            </div>

        </div>

        <div class="form-row">
            <div class="col-md-6 form-group">
                <label class="control-label">Povrch steny</label>
                <select
                        class="form-control select-drop to-store"
                        name="Data[kuchyna][<?= $i ?>][povrch_stena]"
                        id="dat-povrch"
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
                <button class="btn btn-success" onclick="return add_color('col', <?= $i ?>,'stena');" id="btn-plus"><i class="fas fa-plus"></i>&nbsp; Pridat farbu</button>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6 form-group">
                <label class="control-label">Podlaha</label>
                <select name="Data[kuchyna][<?= $i ?>][podlaha][]" class="form-control select-drop to-store" id="podlaha-<?= $i ?>" multiple>
                    <option value="0">Vyberte materiál</option>
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
                <select name="Data[kuchyna][<?= $i ?>][kurenie][]" class="form-control select-drop to-store" id="kurenie-<?= $i ?>" multiple>
                    <option value="0">Vyberte typ</option>
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

        <div class="form-row">
            <div class="col-md-6 form-group">
                <label class="control-label">Okno</label>
                <select name="Data[kuchyna][<?= $i ?>][okno][]" class="form-control select-drop to-store" id="okno-<?= $i ?>" multiple>
                    <option value="0">Vyberte typ</option>
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
                <select name="Data[kuchyna][<?= $i ?>][nabytok][]" class="form-control select-drop to-store" id="nabytok-<?= $i ?>" multiple>
                    <?php
                    foreach ($nabytok as $item) {
                        echo "<option value={$item['id']}>{$item['nazov']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6 form-group">
                <label class="control-label">Osvetlenie</label>
                <select name="Data[kuchyna][<?= $i ?>][osvetlenie][]" class="form-control select-drop to-store" id="osvetlenie-<?= $i ?>" multiple>
                    <?php
                    foreach ($osvetlenie as $item) {
                        echo "<option value={$item['id']}>{$item['nazov']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6 form-group">
                <label class="control-label">Stena</label>
                <select name="Data[kuchyna][<?= $i ?>][stena][]" class="form-control select-drop to-store" id="stena-<?= $i ?>" multiple>
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

        <div class="form-row">
            <div class="col-md-6 form-group">
                <label class="control-label">Kuchynská linka</label>
                <select name="Data[kuchyna][<?= $i ?>][kuchyn_link]" class="form-control select-drop to-store" id="kuchyn-link-<?= $i ?>">
                    <option value="0">Vyberte typ</option>
                    <option value="1">Štandardná</option>
                    <option value="2">Vyrobená na mieru</option>
                </select>
            </div>
            <div class="col-md-6 form-group">
                <label class="control-label">Značka</label>
                <select
                        name="Data[kuchyna][<?= $i ?>][kuchyn_link_znacka][]"
                        class="form-control select-drop to-store"
                        id="kuch-link-znacka-<?= $i ?>"
                        multiple
                >
                    <?php
                    foreach($kuch_link_znacka as $item) {
                        echo "<option value={$item['nazov']}>{$item['nazov']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6 form-group">
                <label class="control-label">Kuchynská linka - materiál</label>
                <select name="Data[kuchyna][<?= $i ?>][kuchyn_link_material][]" class="form-control select-drop to-store" id="linka-mater-<?= $i ?>" multiple>
                    <?php
                    foreach ($kuch_linka_material as $item) {
                        echo "<option value='{$item['nazov']}'>{$item['nazov']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6 form-group" id="col-linka-<?= $i ?>">
                <label class="control-label">Farba</label>
                <br>
                <button class="btn btn-success" onclick="return add_color('col-linka', <?= $i ?>,'kuchyn_link_material');" id="btn-plus"><i class="fas fa-plus"></i>&nbsp; Pridat farbu</button>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6 form-group">
                <label class="control-label">Kuchynská linka - pracovná doska</label>
                <select name="Data[kuchyna][<?= $i ?>][kuchyn_link_pracdosk][]" class="form-control select-drop to-store" id="linka-pracdosk-<?= $i ?>" multiple>
                    <?php
                    foreach ($kuch_linka_pracdosk as $item) {
                        echo "<option value='{$item['nazov']}'>{$item['nazov']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6 form-group" id="col-pracdosk-<?= $i ?>">
                <label class="control-label">Farba</label>
                <br>
                <button class="btn btn-success" onclick="return add_color('col-pracdosk', <?= $i ?>,'kuchyn_link_pracdosk');" id="btn-plus"><i class="fas fa-plus"></i>&nbsp; Pridat farbu</button>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-4 form-group">
                <label class="control-label">Chladnička</label>
                <select name="Data[kuchyna][<?= $i ?>][chladnicka]" class="form-control select-drop to-store" id="chladnicka-<?= $i ?>">
                    <option value="0">Vyberte typ</option>
                    <option value="1">Bez mrazničky</option>
                    <option value="2">S mrazničkou</option>
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label class="control-label">Typ</label>
                <select name="Data[kuchyna][<?= $i ?>][chladnicka_typ]" class="form-control select-drop to-store" id="chladnicka-typ-<?= $i ?>">
                    <option value="0">Vyberte typ</option>
                    <option value="1">Vstavaná </option>
                    <option value="2">Samostatne stojaca</option>
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label class="control-label">Značka</label>
                <select
                        name="Data[kuchyna][<?= $i ?>][chladnicka_znacka][]"
                        class="form-control select-drop to-store"
                        id="chladnicka-znacka-<?= $i ?>"
                        multiple
                >
                    <?php
                        foreach($chladnicka_znacka as $item) {
                            echo "<option value='{$item['nazov']}'>{$item['nazov']}</option>";
                        }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-4 form-group">
                <label class="control-label">Sporák</label>
                <select name="Data[kuchyna][<?= $i ?>][sporak]" class="form-control select-drop to-store" id="sporak-<?= $i ?>">
                    <option value="0">Vyberte typ</option>
                    <option value="1">Keramický</option>
                    <option value="2">Plynový</option>
                    <option value="3">Kombinovaná</option>
                    <option value="4">Elektrická</option>
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label class="control-label">Typ podľa uloženia</label>
                <select name="Data[kuchyna][<?= $i ?>][sporak_typ]" class="form-control select-drop to-store" id="sporak-typ-<?= $i ?>">
                    <option>Vyberte typ</option>
                    <option value="1">Vstavaná</option>
                    <option value="2">Samostatne sotjacie</option>
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label class="control-label">Značka</label>
                <select
                        name="Data[kuchyna][<?= $i ?>][sporak_znacka][]"
                        class="form-control select-drop to-store"
                        id="sporak-znacka-<?= $i ?>"
                        multiple
                >
                    <?php
                    foreach($sporak_znacka as $item) {
                        echo "<option value='{$item['nazov']}'>{$item['nazov']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6 form-group">
                <label class="control-label">Mikrovlnka</label>
                <select name="Data[kuchyna][<?= $i ?>][mikrovlnka]" class="form-control select-drop to-store" id="mikrovlnka-<?= $i ?>">
                    <option value="0">Vyberte typ</option>
                    <option value="1">Vstavaná </option>
                    <option value="2">Samostatne stojaca</option>
                </select>
            </div>
            <div class="col-md-6 form-group">
                <label class="control-label">Značka</label>
                <select
                        name="Data[kuchyna][<?= $i ?>][mikrovlnka_znacka][]"
                        class="form-control select-drop to-store"
                        id="mikrovlnka-znacka-<?= $i ?>"
                        multiple
                >
                    <?php
                    foreach($mikro_znacka as $item) {
                        echo "<option value='{$item['nazov']}'>{$item['nazov']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6 form-group">
                <label class="control-label">Umývačka riadu</label>
                <select name="Data[kuchyna][<?= $i ?>][umyv_riad]" class="form-control select-drop to-store" id="umyv-riad-<?= $i ?>">
                    <option value="">Vyberte typ</option>
                    <option value="1">Vstavaná</option>
                    <option value="2">Samostatne sotjacie</option>
                </select>
            </div>
            <div class="col-md-6 form-group">
                <label class="control-label">Značka</label>
                <select
                        name="Data[kuchyna][<?= $i ?>][umyv_riad_znacka][]"
                        class="form-control select-drop to-store"
                        id="umyvriad-znacka-<?= $i ?>"
                        multiple
                >
                    <?php
                    foreach($umyvriad_znacka as $item) {
                        echo "<option value='{$item['nazov']}'>{$item['nazov']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6 form-group">
                <label class="control-label">Práčka</label>
                <select name="Data[kuchyna][<?= $i ?>][pracka]" class="form-control select-drop to-store" id="pracka-<?= $i ?>">
                    <option value="">Zvoľte typ</option>
                    <option value="1">Samostatne stojaca</option>
                    <option value="2">Zabudovaná</option>
                </select>
            </div>
            <div class="col-md-6 form-group">
                <label class="control-label">Značka</label>
                <select
                        name="Data[kuchyna][<?= $i ?>][pracka_znacka][]"
                        class="form-control select-drop to-store"
                        id="pracka-znacka-<?= $i ?>"
                        multiple
                >
                    <?php
                    foreach($pracka_znacka as $item) {
                        echo "<option value='{$item['nazov']}'>{$item['nazov']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6 form-group">
                 <label class="control-label">Digestor</label>
                <select name="Data[kuchyna][<?= $i ?>][digestor]" class="form-control select-drop">
                    <option value="">Zvoľte typ</option>
                    <option value="1">Samostatne stojaca</option>
                    <option value="2">Zabudovaná</option>
                </select>
            </div>
            <div class="col-md-6 form-group">
                <label class="control-label">Značka</label>
                <select
                        name="Data[kuchyna][<?= $i ?>][digestor_znacka][]"
                        class="form-control select-drop"
                        id="digestor-znacka-<?= $i ?>"
                        multiple
                >
                    <?php
                    foreach($digestor_znacka as $item) {
                        echo "<option value='{$item['nazov']}'>{$item['nazov']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6 form-group">
                <label class="control-label">Sušička</label>
                <select name="Data[kuchyna][<?= $i ?>][susicka]" class="form-control select-drop to-store" id="susicka-<?= $i ?>">
                    <option value="">Zvoľte typ</option>
                    <option value="1">Samostatne stojaca</option>
                    <option value="2">Zabudovaná</option>
                </select>
            </div>
            <div class="col-md-6 form-group">
                <label class="control-label">Značka</label>
                <select
                        name="Data[kuchyna][<?= $i ?>][susicka_znacka][]"
                        class="form-control select-drop to-store"
                        id="susicka-znacka-<?= $i ?>"
                        multiple
                >
                    <?php
                    foreach($susicka_znacka as $item) {
                    echo "<option value='{$item['nazov']}'>{$item['nazov']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6 form-group">
                <label class="control-label">Klíma</label>
                <select name="Data[kuchyna][<?= $i ?>][klima]" class="form-control select-drop to-store" id="klima-<?= $i ?>">
                    <option value="">Zvoľte typ</option>
                    <option value="1">Montovaná</option>
                    <option value="2">Mobilná</option>
                </select>
            </div>
            <div class="col-md-6 form-group">
                <label class="control-label">Značka</label>
                <select
                        name="Data[kuchyna][<?= $i ?>][klima_znacka][]"
                        class="form-control select-drop to-store"
                        id="klima-znacka-<?= $i ?>"
                        multiple
                >
                    <?php
                    foreach($klima_znacka as $item) {
                        echo "<option value='{$item['nazov']}'>{$item['nazov']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6 form-group">
                <label class="control-label">Mraznička (samostatna bez chladnicky)</label>
                <select name="Data[kuchyna][<?= $i ?>][mraznicka]" class="form-control select-drop to-store" id="kuchyna-mraznicka-<?= $i ?>">
                    <option value="">Zvoľte typ</option>
                    <option value="1">Samostatne stojaca</option>
                    <option value="2">Zabudovaná</option>
                </select>
            </div>
            <div class="col-md-6 form-group">
                <label class="control-label">Značka</label>
                <select
                        name="Data[kuchyna][<?= $i ?>][mraznicka_znacka][]"
                        class="form-control select-drop to-store"
                        id="mraznicka-znacka-<?= $i ?>"
                        multiple
                >
                    <?php
                    foreach($mraznicka_znacka as $item) {
                        echo "<option value='{$item['nazov']}'>{$item['nazov']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6 form-group">
                <input type="checkbox" name="Data[kuchyna][<?= $i ?>][balkon]" value="1">&nbsp;
                <label class="control-label">Balkón</label>
            </div>
            <div class="col-md-6 form-group">
                <input type="checkbox" name="Data[kuchyna][<?= $i ?>][francuzsky_balkon]" value="1">&nbsp;
                <label class="control-label">Francúzsky balkón</label>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6 form-group">
                <input type="checkbox" name="Data[kuchyna][<?= $i ?>][terasa]" value="1">&nbsp;
                <label class="control-label">Terasa</label>
            </div>
            <div class="col-md-6 form-group">
                <input type="checkbox" name="Data[kuchyna][<?= $i ?>][komora]" value="1">
                <label class="form-check-label">Komora</label>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6 form-group">
                <input type="checkbox" name="Data[kuchyna][<?= $i ?>][spajza]" value="1">
                <label class="form-check-label">Špajza</label>
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
        <div class="form-row">
            <div class="col-md-5">
                <a class="btn btn-danger upload-reset" id="upload-reset-<?= $i?>"><i class="fa fa-recycle"></i>&nbsp;Reset</a>
            </div>
        </div>
        <br>
        <div class="form-row">
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
           $("#frm-plocha-{$i}").val(roundNum(s*d,2));
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
           $("#frm-plocha-{$i}").val(roundNum(s*d,2));
       }
    });
     $("#mraznicka-znacka-{$i}").select2({
        theme: "bootstrap",
        placeholder: "Vyberte značku",
        tags: true
    });
     $("#klima-znacka-{$i}").select2({
        theme: "bootstrap",
        placeholder: "Vyberte značku",
        tags: true
    });
     $("#susicka-znacka-{$i}").select2({
        theme: "bootstrap",
        placeholder: "Vyberte značku",
        tags: true
    });
     $("#digestor-znacka-{$i}").select2({
        theme: "bootstrap",
        placeholder: "Vyberte značku",
        tags: true
    }); 
     $("#pracka-znacka-{$i}").select2({
        theme: "bootstrap",
        placeholder: "Vyberte značku",
        tags: true
    });
     $("#linka-pracdosk-{$i}").select2({
        theme: "bootstrap",
        placeholder: "Vyberte značku",
        tags: true
    });
    $("#umyvriad-znacka-{$i}").select2({
        theme: "bootstrap",
        placeholder: "Vyberte značku",
        tags: true
    });
    $("#linka-mater-{$i}").select2({
        theme: "bootstrap",
        placeholder: "Vyberte materiál",
        tags: true
    });
    $("#podlaha-{$i}").select2({
        theme: "bootstrap",
        placeholder: "Vyberte typ podlahy",
        tags: true
    });
    $("#kuch-link-znacka-{$i}").select2({
        theme: "bootstrap",
        placeholder: "Vyberte alebo zadajte značku",
        tags: true
    });
    $("#chladnicka-znacka-{$i}").select2({
        theme: "bootstrap",
        placeholder: "Vyberte alebo zadajte značku",
        tags: true
    });
    $("#mikrovlnka-znacka-{$i}").select2({
        theme: "bootstrap",
        placeholder: "Vyberte alebo zadajte značku",
        tags: true
    });
    $("#sporak-znacka-{$i}").select2({
        theme: "bootstrap",
        placeholder: "Vyberte alebo zadajte značku",
        tags: true
    });
    $("#kurenie-{$i}").select2({
        theme: "bootstrap",
        placeholder: "Vyberte typ kurenia",
        tags: true
    });
    $("#okno-{$i}").select2({
        theme: "bootstrap",
        placeholder: "Vyberte typ okna",
        tags: true
    });
    $("#osvetlenie-{$i}").select2({
        theme: "bootstrap",
        placeholder: "Vyberte typ osvetlenia",
        tags: true
    });
    $("#nabytok-{$i}").select2({
        theme: "bootstrap",
        placeholder: "Vyberte typ nábytku",
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