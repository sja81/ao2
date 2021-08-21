<?php

use backend\assets\RealAsset;

$this->title="Pridať obhliadku";

$this->registerJSFile('@web/assets/node_modules/jqueryui/jquery-ui.min.js',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/jqueryui/jquery-ui.min.css',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/jqueryui/jquery-ui.theme.min.css',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/js/obhliadka.js?v=0.6',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/moment/moment.js',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/bootstrap/dist/js/bootstrap.min.js',['depends'=>RealAsset::class]);
$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css',['depends'=>RealAsset::class]);
$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css',['depends'=>RealAsset::class]);
$this->registerJSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.full.min.js',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/calendar/dist/fullcalendar.min.js',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/calendar/dist/cal-init.js',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/calendar/dist/fullcalendar.css',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/clockpicker/dist/bootstrap-clockpicker.min.js',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/clockpicker/dist/bootstrap-clockpicker.min.css',['depends'=>RealAsset::class]);
?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>
    <!-- calendar -->
    <form method="post" id="frm-visit" enctype="multipart/form-data">
        <input type="hidden" name="Visitor[calendar_id]" value="<?= $calendarId ?>">
        <input type="hidden" name="Visitor[prop_id]" value="<?= $_GET['id'] ?>">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?= Yii::t('app','Termín'); ?></h4>
                        <h6 class="card-subtitle"><?= Yii::t('app','Zvoľte si pre Vás nevhodnejší termín'); ?></h6>
                        <div id="calendar"></div>
                        <!-- modal window -->
                        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel"><?= Yii::t('app','Pridať termín obhliadky'); ?></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="vis-date" class="control-label"><?= Yii::t('app','Zvolený dátum'); ?>:</label>
                                            <input type="text" class="form-control" id="vis-date">
                                        </div>
                                        <div class="form-group">
                                            <label for="vis-time" class="control-label"></label>
                                            <div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                                <input type="text" class="form-control" value="13:14" id="vis-time">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"><?= Yii::t('app','Uložiť'); ?></button>
                                        <button type="button" class="btn btn-info waves-effect" data-dismiss="modal" id="modal-save"><?= Yii::t('app','Zavrieť'); ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end of modal window -->
                    </div>
                </div>
            </div>
        </div>
        <!-- company & agent -->
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?= Yii::t('app','Zastupujúca firma/maklér'); ?></h4>
                        <div class="row m-t-20">
                            <div class="col-md-12 form-group">
                                <label class="control-label">Firma</label>&nbsp;
                                <select class="form-control select-drop" id="obh-firma-id" name="Visitor[company][id]">
                                    <?php
                                    foreach ($companies as $company) {
                                        $default = '';
                                        if ($default_company['id'] === $company['id']) {
                                            $default = ' selected ';
                                        }
                                        ?>
                                        <option
                                                value="<?= $company['id'] ?>"
                                            <?= $default ?>
                                        >
                                            <?= $company['name'] ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app','Maklér') ?></label>
                                <?php
                                if (isset(Yii::$app->user->identity) && Yii::$app->user->identity->hasRole('admin')){
                                    ?>
                                    <select id="obh-makler" class="form-control select-drop" name="Visitor[agent_id]">
                                        <?php
                                        foreach ($agents as $agent) {
                                            $default = '';
                                            if (Yii::$app->user->id === (int)$agent['id']) {
                                                $default = ' selected ';
                                            }
                                            ?>
                                            <option value="<?= $agent['id']?>"<?= $default ?>><?= $agent['meno']?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <?php
                                } else {
                                    $agentName = Agent::getAgent(Yii::$app->user->identity->getId());
                                    ?>
                                    <input type="text" class="form-control" id="obh-makler" value="<?= $agentName ?>" name="Visitor[agent_id]">
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app','Ulica') ?></label>
                                <input class="form-control" id="obh-firma-ulica" value="<?= $default_company['address'] ?>" name="Visitor[company][address]">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app','PSČ') ?></label>
                                <input class="form-control" id="obh-firma-psc" value="<?= $default_company['zip'] ?>" name="Visitor[company][zip]">
                            </div>
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app','Mesto') ?></label>
                                <input class="form-control" id="obh-firma-mesto" value="<?= $default_company['town'] ?>" name="Visitor[company][town]">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app','IČO') ?></label>
                                <input class="form-control" id="obh-firma-ico" value="<?= $default_company['ico'] ?>" name="Visitor[company][ico]">
                            </div>
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app','DIČ') ?></label>
                                <input class="form-control" id="obh-firma-dic" value="<?= $default_company['dic'] ?>" name="Visitor[company][dic]">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app','Telefón') ?></label>
                                <input class="form-control" id="obh-firma-phone" value="<?= $default_company['phone'] ?>" name="Visitor[company][phone]">
                            </div>
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app','Email') ?></label>
                                <input class="form-control" id="obh-firma-email" value="<?= $default_company['email'] ?>" name="Visitor[company][email]">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- visitor -->
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?= Yii::t('app','Záujemca'); ?></h4>
                        <div class="row m-t-20">
                            <div class="col-md-12 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app','Vyberte záujemcu'); ?></label>&nbsp;
                                <select class="form-control select-drop" id="obh-zaujem-id">
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app','alebo nahrajte prednú a zadnú časť Občianskeho preukazu') ?></label>
                                <button type="button" class="btn btn-secondary m-l-20" id="nahrat-op"><i class=""></i> <?= Yii::t('app', 'Nahrať') ?></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-xs-12 form-group">
                                <label for="vis-custtype" class="control-label"><?= Yii::t('app','Typ zákazníka') ?></label>
                                <select name="Visitor[customer_type]" id="vis-custtype" class="form-control dropdown">
                                    <option value="osoba"><?= Yii::t('app','Súkromná osoba') ?></option>
                                    <option value="firma"><?= Yii::t('app','Firma') ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="row" id="firm-name">
                            <div class="col-md-12 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app','Názov firmy'); ?></label>
                                <input type="text" name="Visitor[company_name]" class="form-control">
                            </div>
                        </div>
                        <div class="row" id="firm-tax">
                            <div class="col-md-6 col-xs-6 form-group">
                                <label class="control-label"><?= Yii::t('app','IČO'); ?></label>
                                <input type="text" name="Visitor[ico]" class="form-control">
                            </div>
                            <div class="col-md-6 col-xs-6 form-group">
                                <label class="control-label"><?= Yii::t('app','DIČ'); ?></label>
                                <input type="text" name="Visitor[dic]" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-6 form-group">
                                <label for="vis-fname" class="control-label">Meno</label>
                                <input type="text" name="Visitor[fname]" id="vis-fname" class="form-control">
                            </div>
                            <div class="col-md-6 col-xs-6 form-group">
                                <label for="vis-lname" class="control-label">Priezvisko</label>
                                <input type="text" name="Visitor[lname]" id="vis-lname" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-6 form-group">
                                <label for="" class="control-label">Ulica a číslo</label>
                                <input type="text" class="form-control" id="vis-address" name="Visitor[address]">
                            </div>
                            <div class="col-md-6 col-xs-6 form-group">
                                <label for="vis-country" class="control-label">Štát</label>
                                <input type="text" name="Visitor[country]" id="vis-country" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-xs-6 form-group ui-widget">
                                <label for="vis-town" class="control-label"><?= Yii::t('app','Mesto') ?></label>
                                <input type="text" name="Visitor[town]" id="vis-town" class="form-control">
                            </div>
                            <div class="col-md-4 col-xs-6 form-group">
                                <label for="vis-zip" class="control-label"><?= Yii::t('app','PSČ') ?></label>
                                <input type="text" name="Visitor[zip]" id="vis-zip" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-6 form-group">
                                <label class="control-label"><?= Yii::t('app','Email'); ?></label>
                                <input type="email" name="Visitor[email]" id="" class="form-control">
                            </div>
                            <div class="col-md-6 col-xs-6 form-group">
                                <label class="control-label"><?= Yii::t('app','Telefón'); ?></label>
                                <input type="text" name="Visitor[phone]" id="" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label"><?= Yii::t('app','Dôvod obhliadky') ?></label>&nbsp;
                                <select class="form-control select-drop" id="obh-dovod">
                                    <option value="kupa"><?= Yii::t('app','Kúpa') ?></option>
                                    <option value="predaj"><?= Yii::t('app','Nájom') ?></option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label"><?= Yii::t('app','Bol záujemca spokojný, ako mu maklér predstavil nehnuteľnosť?') ?></label>&nbsp;
                                <select class="form-control select-drop" id="obh-spokojnost">
                                    <option value=""><?= Yii::t('app','Vyberte') ?></option>
                                    <option value="spokojny"><?= Yii::t('app','Spokojný') ?></option>
                                    <option value="nespokojny"><?= Yii::t('app','Nespokojný') ?></option>
                                    <option value="neviem"><?= Yii::t('app','Neviem posúdiť') ?></option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- filter for other offers -->
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?= Yii::t('app','Filter ďalších ponúk'); ?></h4>
                        <div class="row">
                            <div class="col-md-4 col-xs-12">
                                <label class="control-label">Typ</label>
                                <select
                                        class="form-control custom-select"
                                        name="Visitor[filter][types][]"
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
                            <div class="col-md-4 col-xs-12">
                                <label class="control-label">Druh</label>
                                <select
                                        class="form-control custom-select"
                                        name="Visitor[filter][props][]"
                                        id="frm-d"
                                        multiple
                                >
                                    <?= $druhy ?>
                                </select>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label class="control-label">Stav</label>
                                <select
                                        class="form-control custom-select"
                                        name="Visitor[filter][prop_stat][]"
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
                        <div class="row m-t-20">
                            <div class="col-md-4 col-xs-12">
                                <label class="control-label">Kraj</label>
                                <select
                                        class="form-control
                            custom-select"
                                        name="Visitor[filter][region][]"
                                        id="frm-kraj"
                                        multiple
                                >
                                    <?= $kraje ?>
                                </select>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label class="control-label">Okres</label>
                                <select
                                        class="form-control
                            custom-select"
                                        name="Visitor[filter][district][]"
                                        id="frm-okres"
                                        multiple
                                >
                                    <?= $okresy ?>
                                </select>
                            </div>
                            <div class="col-md-4 col-xs-12">
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-sm-2">
                                <label class="control-label">Cena od</label>
                                <input type="text" class="form-control" placeholder="0" name="Visitor[filter][price_from]">
                            </div>
                            <div class="col-sm-2">
                                <label class="control-label">do</label>
                                <input type="text" class="form-control" placeholder="0" name="Visitor[filter][price_to]">
                            </div>
                            <div class="col-sm-2">
                                <label class="control-label">Výmera od</label>
                                <input type="text" class="form-control" placeholder="0 m2" name="Visitor[filter][area_from]">
                            </div>
                            <div class="col-sm-2">
                                <label class="control-label">do</label>
                                <input type="text" class="form-control" placeholder="0 m2" name="Visitor[filter][area_to]">
                            </div>
                            <div class="col-sm-4">
                                <label class="control-label">Počet miestností</label>
                                <select
                                        class="form-control custom-select"
                                        name="Visitor[filter][room_count][]"
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
                    </div>
                </div>
            </div>
        </div>
        <!-- signature and signature date -->
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            <?= Yii::t('app','Miesto a dátum podpisu') ?>
                        </h4>
                        <div class="row m-t-20">
                            <div class="col-md-2 col-xs-12">
                                <label class="control-label"><?= Yii::t('app','Miesto') ?></label>
                                <input type="text" class="form-control" name="Visitor[sign_place]">
                            </div>
                            <div class="col-md-2 col-xs-12">
                                <label class="control-label"><?= Yii::t('app','Dátum') ?></label>
                                <input type="date" class="form-control" name="Visitor[sign_date]">
                            </div>
                            <div class="col-md-8 col-xs-12">
                                <label class="control-label"><?= Yii::t('app','Podpis') ?></label>
                                <canvas class="sign-canvas" id="custom-sign">
                                    Get a better browser, bro.
                                </canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <button class="btn btn-secondary" type="button" onclick="alert('Not implemented yet!')"><i class="mdi mdi-content-save"></i> <?= Yii::t('app','Uložiť') ?></button>
                        <a href="<?= \yii\helpers\Url::to(['/contracts/obhliadky', 'id'=> $_GET['id']]) ?>" class="btn btn-danger"><i class="mdi mdi-rewind"></i> <?= Yii::t('app','Späť') ?></a>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>

<div id="uploadOP" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="uploadOPLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="uploadOPLabel"><?= Yii::t('app','Nahrať dokument'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div id="spin" style="display:none; text-align: center" class="mt-2">
                    <div style="font-size: 2rem; font-weight: bold">Spracovávam nahraté dokumenty...</div>
                    <img src="<?= Yii::getAlias('@web')?>/assets/images/loader.gif?v=1" class="ml-auto; mt-4">
                </div>
                <div id="dfrm">
                    <form enctype="multipart/form-data" id="frm" method="post">
                        <div class="row">
                            <div class="col-sm-12 mb-3 mt-2">
                                <label for="op-predna" class="form-control-label">Predná strana</label>
                                <input type="file" name="op_predna" id="op-predna" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="op-zadna" class="form-control-label">Zadná strana</label>
                                <input type="file" name="op_zadna" id="op-zadna" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"><?= Yii::t('app','Uložiť'); ?></button>
                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal" id="modal-save"><?= Yii::t('app','Zavrieť'); ?></button>
            </div>
        </div>
    </div>
</div>

<?php
$agentId = Yii::$app->user->getId();

$css = <<<CSS
    .vtabs {
    width: 100%;
    }
    .tabs-vertical {
        width: 200px !important;
    }
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
    #firm-name, 
    #firm-tax {
        display: none;
    }
    .sign-canvas {
        width: 100%;
        height: 200px;
        border: 2px dotted #CCCCCC;
        border-radius: 15px;
        cursor: crosshair;
    }
    
CSS;
$this->registerCSS($css);

$js = <<<JS
    
    $('#vis-custtype').on('change',function(){
        if ($(this).val() == 'firma') {
            $('#firm-name').show();
            $('#firm-tax').show();
        } else {
            $('#firm-name').hide();
            $('#firm-tax').hide();
        }
    });
    
    $('.clockpicker').clockpicker({
        donetext: 'Done',
    }).find('input').change(function() {
    
    });

    $('#vis-town').autocomplete({
       source: function(request, response) {
           $.ajax({
                url: "/backoffice/contracts/ajax-get-town-data",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function(data) {
                    response(data);
                }
           });
       },
       minLenght: 3,
       select: function(event, ui) {
           // ui.item.value
           // ui.item.id
           console.log(ui);
       }
    });
    
    $('#nahrat-op').on('click',function(){
        $('#uploadOP').modal('show');
    });
    
   
    $('#modal-save').on('click',function(){
        
    });
    
    $("#frm-t").select2({
        theme: "bootstrap",
        placeholder: "Vyberte typ"
    });
    
    $("#frm-st").select2({
        theme: "bootstrap",
        placeholder: "Vyberte stav"
    });
    
    $("#frm-pocmiest").select2({
        theme: "bootstrap",
        placeholder: "Vyberte počet miestností"
    });
    
    $("#frm-d").select2({
        theme: "bootstrap",
        placeholder: "Vyberte druh/y",
        templateResult: formatSingleResult
    });
    
    $("#frm-kraj").select2({
        theme: "bootstrap",
        placeholder: "Vyberte kraj",
        templateResult: formatSingleResult
    });
    
    $("#frm-okres").select2({
        theme: "bootstrap",
        placeholder: "Vyberte okres",
        templateResult: formatSingleResult
    });
JS;

$this->registerJS($js);
