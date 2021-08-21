<?php

use yii\helpers\Url;

?>

    <!--<div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-1">
                    <a href="<?= Url::to(['/contracts/add'])?>" class="btn btn-info btn-block btn-block text-white"><i class="fa fa-plus text-white"></i>&nbsp; Pridať</a>
                </div>
                <div class="col-sm-11"></div>
            </div>
        </div>
    </div>-->

    <div class="card">
    <div class="card-body">
        <form method="get" action="<?= Url::to(['/contracts'])?>">
            <div class="row mb-2">
                <!-- Typ -->
                <div class="col-sm-4">
                    <label class="control-label">Typ</label>
                    <select
                            class="form-control custom-select"
                            name="Search[t][]"
                            id="frm-t"
                            multiple
                    >
                        <?php
                        foreach ($typy as $typ) {
                            echo "<option value={$typ['id']}>{$typ['name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <!-- Druh -->
                <div class="col-sm-4">
                    <label class="control-label">Druh</label>
                    <select
                            class="form-control custom-select"
                            name="Search[dru][]"
                            id="frm-d"
                            multiple
                    >
                        <?= $druhy ?>
                    </select>
                </div>
                <!-- Stav -->
                <div class="col-sm-4">
                    <label class="control-label">Stav</label>
                    <select
                            class="form-control custom-select"
                            name="Search[st][]"
                            id="frm-st"
                            multiple
                    >
                        <option value="0">Všetky stavy</option>
                        <?php
                        foreach ($stav as $item) {
                            echo "<option value={$item['id']}>{$item['nazov']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row mb-2">
                <!-- Stat -->
                <div class="col-sm-3">
                    <label class="control-label">Štáty</label>
                    <select
                            class="form-control
                            custom-select"
                            name="Search[stt][]"
                            id="frm-s"
                            multiple
                    >
                        <?php
                        foreach ($staty as $stat) {
                            echo "<option value={$stat['name']}>{$stat['name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <!-- kraj -->
                <div class="col-sm-3">
                    <label class="control-label">Kraj</label>
                    <select
                            class="form-control
                            custom-select"
                            name="Search[kr][]"
                            id="frm-kraj"
                            multiple
                    >
                        <?= $kraje ?>
                    </select>
                </div>

                <!-- okres -->
                <div class="col-sm-3">
                    <label class="control-label">Okres</label>
                    <select
                            class="form-control
                            custom-select"
                            name="Search[okr][]"
                            id="frm-okres"
                            multiple
                    >
                        <?= $okresy ?>
                    </select>
                </div>

                <!-- Mesto -->
                <div class="col-sm-3">
                    <label class="control-label">Mesto</label>
                    <select
                            class="form-control custom-select"
                            name="Search[m][]"
                            id="frm-mesto"
                            multiple
                    >
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-2">
                    <label class="control-label">Cena od</label>
                    <input type="text" class="form-control" placeholder="0" name="Search[cod]">
                </div>
                <div class="col-sm-2">
                    <label class="control-label">do</label>
                    <input type="text" class="form-control" placeholder="0" name="Search[cdo]">
                </div>
                <div class="col-sm-2">
                    <label class="control-label">Výmera od</label>
                    <input type="text" class="form-control" placeholder="0 m2" name="Search[vod]">
                </div>
                <div class="col-sm-2">
                    <label class="control-label">do</label>
                    <input type="text" class="form-control" placeholder="0 m2" name="Search[vdo]">
                </div>
                <div class="col-sm-4">
                    <label class="control-label">Počet miestností</label>
                    <select
                            class="form-control custom-select"
                            name="Search[pocmiest][]"
                            id="frm-pocmiest"
                            multiple
                    >
                        <option value="0">Všetky počty</option>
                        <?php
                        for ($i=1; $i < 21; $i++) {
                            echo "<option value={$i}>{$i}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!--<div class="row mb-4">
                <div class="col-sm-12">
                    <label class="control-label">Fulltext / ID</label>
                    <input type="text" class="form-control" name="Search[ftx]">
                </div>
            </div>-->
            <br>
            <div class="row">
                <div class="col-sm-6 col-md-2">
                    <button type="submit" class="btn btn-dark btn-block form-control text-white">Hľadat</button>
                </div>
                <div class="col-sm-6 col-md-2">
                    <button type="button" class="btn btn-success btn-block btn-block text-white" id="btn-new-constract" onclick="redirect_it()"><i class="fa fa-plus text-white"></i>&nbsp; Pridať</button>
                </div>
            </div>
        </form>
    </div>
    </div>
<?php
$urlMesta = Url::to(["/ajax/get-cities"]);
$js = <<< JS
    formatSingleResult = function(result) {
        if ($(result.element).hasClass('option-parent')) {
            let el = $('<span>');
            el.text(result.text);
            el.addClass($(result.element).attr('class'));
            return el;
        } 
        if ($(result.element).hasClass('option-child')) {
            let el = $('<span>');
            el.text(result.text);
            el.addClass($(result.element).attr('class'));
            return el;
        }
        return result.text.trim();
    }

    formatCountryResult = function(result) {
        return result.text.trim();
    }
    
    $("#frm-d").select2({
        theme: "bootstrap",
        placeholder: "Vyberte druh/y",
        templateResult: formatSingleResult
    });
    $("#frm-t").select2({
        theme: "bootstrap",
        placeholder: "Vyberte typ"
    });
    $("#frm-okres").select2({
        theme: "bootstrap",
        placeholder: "Vyberte okres",
        templateResult: formatSingleResult
    });
    $("#frm-kraj").select2({
        theme: "bootstrap",
        placeholder: "Vyberte kraj",
        templateResult: formatSingleResult
    });
    $("#frm-s").select2({
        theme: "bootstrap",
        placeholder: "Vyberte štát"
    });
    $("#frm-st").select2({
        theme: "bootstrap",
        placeholder: "Vyberte stav"
    });
    $("#frm-pocmiest").select2({
        theme: "bootstrap",
        placeholder: "Vyberte počet miestností"
    });
    $("#frm-mesto").select2({
        theme: "bootstrap",
        placeholder: "Vyberte mesto",
        minimumInputLength: 3,
        ajax : {
            url: '{$urlMesta}',
            dataType: 'json',
            delay: 250,
            data: function(params){
                return {
                    q: params.term
                }
            },
            processResults: function(data,params) {
                return {
                    results: $.map( data.items, function(val,ind){ return {id: ind, text: val};})   
                };
            }
        }
    });
JS;

$this->registerJS($js);

$css = <<<CSS
.option-parent{
    font-size: 0.85rem !important;
    color: #0000aa !important;
    font-weight: bold !important;
    width: 100% !important; 
    font-family: "Poppins",Sans-serif !important;
}
.option-child {
    font-size: 0.80rem !important;
    margin-left: 20px;
}
CSS;

$this->registerCSS($css);

?>