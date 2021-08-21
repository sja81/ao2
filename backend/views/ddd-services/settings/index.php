<?php
use backend\assets\RealAsset;
use yii\helpers\Url;
use backend\helpers\HelpersNum;
use common\models\search\BackendSearch;
$this->title="DDD & Ozone - nastavenia";

$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css',['depends'=>RealAsset::className()]);
$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css',['depends'=>RealAsset::className()]);
$this->registerJSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.full.min.js',['depends'=>RealAsset::className()]);
$this->registerJSFile('@web/assets/node_modules/jqueryui/jquery-ui.min.js',['depends'=>RealAsset::className()]);
$this->registerCSSFile('@web/assets/node_modules/jqueryui/jquery-ui.min.css',['depends'=>RealAsset::className()]);
?>
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-12 align-self-center">
                <h4 class="text-themecolor"><?= $this->title ?></h4>
            </div>
        </div>


            <div class="card">
                <div class="card-body">

                    <div class="row">

                        <div class="col-md-3">
                            <!-- Tabs nav -->
                            <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link mb-3 p-3 active" id="v-pills-ozone-tab" data-toggle="pill" href="#v-pills-ozone" role="tab" aria-controls="v-pills-ozone" aria-selected="true">
                                    <span class="font-weight-bold small text-uppercase">Ozón</span></a>
                                <a class="nav-link mb-3 p-3" id="v-pills-prod-card-tab" data-toggle="pill" href="#v-pills-prod-card" role="tab" aria-controls="v-pills-prod-card" aria-selected="false">
                                    <span class="font-weight-bold small text-uppercase">Sklad</span></a>
                                <a class="nav-link mb-3 p-3" id="v-pills-machine-tab" data-toggle="pill" href="#v-pills-machine" role="tab" aria-controls="v-pills-machine" aria-selected="false">
                                    <span class="font-weight-bold small text-uppercase">Aplikátory</span></a>
                                <a class="nav-link mb-3 p-3" id="v-pills-dddwork-tab" data-toggle="pill" href="#v-pills-dddwork" role="tab" aria-controls="v-pills-dddwork" aria-selected="false">
                                    <span class="font-weight-bold small text-uppercase">Druh práce</span></a>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <!-- Tabs content -->
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade rounded bg-white show active" id="v-pills-ozone" role="tabpanel" aria-labelledby="v-pills-ozone-tab">
                                    <form id="ozone-settings-form">
                                    <h4 class="mb-4">Všeobecné nastavenia</h4>
                                    <?php
                                    foreach ($ozone_settings as $item) {

                                        if (strtolower($item['field_category']) === 'general' && strtolower($item['field_type']) === 'text') {
                                            ?>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?php echo $item['field_label']; ?></label>
                                                    <input
                                                            type="text"
                                                            class="form-control"
                                                            name="OzoneData[<?php echo $item['field_name'];?>][value]"
                                                            value="<?php echo $item['field_value']; ?>"
                                                    >
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label">Poznámka</label>
                                                    <input
                                                            type="text"
                                                            class="form-control"
                                                            name="OzoneData[<?php echo $item['field_name'];?>][comment]"
                                                            value="<?php echo $item['field_comment']; ?>"
                                                    >
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <h4 class="mb-4">Cenník</h4>
                                    <?php
                                    foreach ($ozone_settings as $item) {

                                        if (strtolower($item['field_category']) === 'price' && strtolower($item['field_type']) === 'text') {
                                            ?>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?php echo $item['field_label']; ?></label>
                                                    <input
                                                            type="text"
                                                            class="form-control"
                                                            value="<?php echo $item['field_value']; ?>"
                                                            name="OzoneData[<?php echo $item['field_name'];?>][value]"
                                                    >
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label">Poznámka</label>
                                                    <input
                                                            type="text"
                                                            class="form-control"
                                                            name="OzoneData[<?php echo $item['field_name'];?>][comment]"
                                                            value="<?php echo $item['field_comment']; ?>"
                                                    >
                                                </div>
                                            </div>
                                            <?php
                                        }

                                    }
                                    ?>
                                    <input type="button" class="btn btn-success" id="btn-save-ozone" value="Uloziť">
                                    </form>
                                </div>

                                <div class="tab-pane fade rounded bg-white" id="v-pills-prod-card" role="tabpanel" aria-labelledby="v-pills-prod-card-tab">

                                    <button type="button" id="add-card" class="btn btn-success mb-4"> <i class="fas fa-plus-circle"></i>&nbsp;Pridať</button>
                                    <table id="tbl-stock-cards" class="table table-striped m-t-5 table-sm">
                                        <thead style="background-color: #2B81AF" class="text-white">
                                        <th>#</th>
                                        <th width="20%">Názov</th>
                                        <th width="20%">Výrobca</th>
                                        <th>Datasheet</th>
                                        <th>Na sklade</th>
                                        <th width="30%">Poznámka</th>
                                        <th>Akcie</th>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (count($materials) === 0) {
                                            echo "<tr><td colspan='7' align='center'>...No data...</td>";
                                        }else{
                                            foreach($materials as $material) {
                                                echo $this->render('setting-row', ['material'=> $material]);
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade rounded bg-white" id="v-pills-machine" role="tabpanel" aria-labelledby="v-pills-machine-tab">

                                </div>

                                <div class="tab-pane fade rounded bg-white" id="v-pills-dddwork" role="tabpanel" aria-labelledby="v-pills-dddwork-tab">

                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>

    </div>

    <div id="dialog-mat-card" title="Skladová karta" style="display: none">

        <div id="dfrm" style="overflow-scrolling: inherit;">
            <form enctype="multipart/form-data" id="frm-mat-card" method="post">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#material">Materiál</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#vseobecne">Technické</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#vyrobca">Výrobca</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#dodavatelia">Dodávatelia</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#interne">Interné záznamy</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">

                    <div id="material" class="container tab-pane active">

                    </div>


                    <div id="vseobecne" class="container tab-pane active">
                        <div class="row mt-1">
                            <div class="col-md-12 form-group">
                                <label class="control-label">Názov</label>
                                <input class="form-control" type="text" name="DlgData[nazov]">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-12 form-group">
                                <label class="control-label">Kód</label>
                                <input class="form-control" type="text" name="DlgData[kod]">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Vyrobené</label>
                                <input class="form-control" type="date" name="DlgData[vyrobene]">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Dátum expirácie</label>
                                <input class="form-control" type="date" name="DlgData[expiracia]">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Množstvo na sklade</label>
                                <input class="form-control" type="text" name="DlgData[na_sklade]">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Merná jednotka</label>
                                <select class="form-control dropdown" name="DlgData[merna_jednotka]">
                                    <option value="">Zvoľte mernú jednotku</option>
                                    <option value="ml">mililiter</option>
                                    <option value="g">gram</option>
                                    <option value="kg">kilogram</option>
                                    <option value="ks">kus</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Min. koncentrácia</label>
                                <input class="form-control" type="text" name="DlgData[min_koncentracia]">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Max. koncentrácia</label>
                                <input class="form-control" type="text" name="DlgData[max_koncentracia]">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Pomer riadenia voda</label>
                                <input class="form-control" type="text" name="DlgData[pomer_ried_voda]">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Pomer riadenia látka</label>
                                <input class="form-control" type="text" name="DlgData[pomer_ried_latka]">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Použiteľnosť</label>
                                <select class="form-control dropdown" name="DlgData[pouzitelnost]">
                                    <option value="0">Všade</option>
                                    <option value="1">Interne</option>
                                    <option value="2">Externe</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Status</label>
                                <select class="form-control dropdown" name="DlgData[status]">
                                    <option value="0">Vyradený</option>
                                    <option value="1">Dočasne nedostupný</option>
                                    <option value="2" selected>Dostupný</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="vyrobca" class="container tab-pane fade">
                        <div class="row mt-1">
                            <div class="col-md-12 form-group">
                                <label class="control-label">Výrobca</label>
                                <input class="form-control" type="text" name="DlgData[vyrobca]">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="control-label">URL</label>
                                <textarea class="form-control form-text" name="DlgData[vyrobca_url]"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="control-label">Poznámka</label>
                                <textarea class="form-control form-text" name="DlgData[vyrobca_poznamka]" style="height: 200px;"></textarea>
                            </div>
                        </div>
                    </div>
                    <div id="dodavatelia" class="container tab-pane fade">
                        <h6 style="margin-top:10px;margin-bottom:10px;width:100%;background-color: #F0F0F0; padding: 10px;font-weight:500">Dodávateľ 1</h6>
                        <div class="row mt-2">
                            <div class="col-md-12 form-group">
                                <label class="control-label">Názov</label>
                                <input class="form-control" type="text" name="DlgData[dodavatel1]">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Dodané</label>
                                <input class="form-control" type="date" name="DlgData[dodane1]">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Cena</label>
                                <input class="form-control" type="text" name="DlgData[cena1]">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="control-label">URL</label>
                                <textarea class="form-control form-text" name="DlgData[dodavatel1_url]"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="control-label">Poznámka</label>
                                <textarea class="form-control form-text" name="DlgData[dodavatel1_poznamka]"></textarea>
                            </div>
                        </div>
                        <h6 style="margin-top:10px;margin-bottom:10px;width:100%;background-color: #F0F0F0; padding: 10px;font-weight:500">Dodávateľ 2</h6>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="control-label">Názov</label>
                                <input class="form-control" type="text" name="DlgData[dodavatel2]">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Dodané</label>
                                <input class="form-control" type="date" name="DlgData[dodane2]">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Cena</label>
                                <input class="form-control" type="text" name="DlgData[cena2]">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="control-label">URL</label>
                                <textarea class="form-control form-text" name="DlgData[dodavatel2_url]"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="control-label">Poznámka</label>
                                <textarea class="form-control form-text" name="DlgData[dodavatel2_poznamka]"></textarea>
                            </div>
                        </div>
                        <h6 style="margin-top:10px;margin-bottom:10px;width:100%;background-color: #F0F0F0; padding: 10px;font-weight:500">Dodávateľ 3</h6>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="control-label">Názov</label>
                                <input class="form-control" type="text" name="DlgData[dodavatel3]">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Dodané</label>
                                <input class="form-control" type="date" name="DlgData[dodane3]">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Cena</label>
                                <input class="form-control" type="text" name="DlgData[cena3]">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="control-label">URL</label>
                                <textarea class="form-control form-text" name="DlgData[dodavatel3_url]"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="control-label">Poznámka</label>
                                <textarea class="form-control form-text" name="DlgData[dodavatel3_poznamka]"></textarea>
                            </div>
                        </div>
                    </div>
                    <div id="interne" class="container tab-pane fade">
                        <div class="row mt-1">
                            <div class="col-md-12 form-group">
                                <textarea class="form-control form-text" name="DlgData[interna_poznamka]" style="height: 300px;"></textarea>
                            </div>
                        </div>
                        <h6 style="margin-top:10px;margin-bottom:10px;width:100%;background-color: #F0F0F0; padding: 10px;font-weight:500">Datasheet</h6>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <input type="file" name="datasheet" class="form-control" id="datasheet">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php
$css = <<<CSS
.nav-pills .nav-link.active {
    background-color: #2B81AF;
}
.nav-pills .nav-link.active a {
    color: #2B81AF;
}
CSS;

$this->registerCSS($css);

$js = <<<JS

$('#btn-save-ozone').on('click',function(){
     var data = new FormData($('#ozone-settings-form')[0]);
     $.ajax({
        url : "/backoffice/ajax/save-ozone-settings",
        type : 'POST',
        data : data,
        cache: false,
        contentType : false,
        processData : false,
        success: function(resp) {
            
        }
    });
});

$('#add-card').on('click',function(){
    var dialog = $( "#dialog-mat-card").dialog({
            height: 700,
            width: 650,
            modal: true,
            buttons: [{
                    id: "btn-save-card",
                    text: "Uloziť",
                    click: function() {
                        uploadMaterialData();
                    }  
                },
                {
                    text: "Zrušiť",
                    id: "btn-cancel",
                    click: function() {
                        $(this).dialog("close");
                    }
            }]
        });
        return false;
});

uploadMaterialData = function(){
     var data = new FormData($('#frm-mat-card')[0]);
     $.ajax({
        url : "/backoffice/ajax/save-material",
        type : 'POST',
        data : data,
        cache: false,
        contentType : false,
        processData : false,
        success: function(resp) {
        }
    });
}

JS;

$this->registerJS($js);
