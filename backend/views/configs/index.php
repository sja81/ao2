<?php

use yii\helpers\Url;
use backend\assets\RealAsset;

$this->title="Konfigurácia";
$this->registerJSFile('@web/assets/node_modules/switchery/dist/switchery.min.js',['depends'=>RealAsset::className()]);
$this->registerCSSFile('@web/assets/node_modules/switchery/dist/switchery.min.css',['depends'=>RealAsset::className()]);
$this->registerJSFile('@web/assets/node_modules/jqueryui/jquery-ui.min.js',['depends'=>RealAsset::className()]);
$this->registerCSSFile('@web/assets/node_modules/jqueryui/jquery-ui.min.css',['depends'=>RealAsset::className()]);

?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-9 col-xlg-10 col-md-8">

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" id="1">Kancelárie</h4>
                    <table id="tbl-kancelarie" class="table table-striped m-t-20">
                        <thead style="background-color: #2B81AF" class="text-white">
                            <th>#</th>
                            <th>Adresa</th>
                            <th>Kontaktná osoba</th>
                            <th>Kontakt</th>
                            <th>Status</th>
                            <th>Akcie</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <button
                                            class="btn btn-info"
                                            onClick="return false;"
                                    >
                                        <i class="fas fa-plus-circle"></i>&nbsp;Pridať
                                    </button>
                                </td>
                            </tr>
                            <?php
                            foreach($kancelarie as $item) {
                                ?>
                                <tr>
                                    <td><?= $item['id'] ?></td>
                                    <td>
                                        <?= $item['address']?><br>
                                        <?= $item['town'] ?><br>
                                        <?= $item['zip'] ?><br>
                                        <?= $item['country'] ?>
                                    </td>
                                    <td><?= $item['contact_person']?></td>
                                    <td>
                                        <i class="fas fa-mobile-alt m-r-10"></i><?= \backend\helpers\HelpersNum::getPhoneFromStr($item['phone']) ?><br>
                                        <i class="fas fa-envelope m-r-10"></i><?= $item['email']?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($item['default_company'] == 0) {

                                        ?>
                                            <input
                                                type="checkbox"
                                                class="js-switch"
                                                data-color="#26c6da"
                                                data-secondary-color="#f62d51"
                                                data-size="small"
                                                onchange=""
                                            <?= $item['status'] == 1 ? " checked":""?>
                                        />
                                        <?php
                                        } else {
                                            echo "centrála";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <button
                                                class="btn btn-default"
                                                onClick="editConfig('kancelarie',<?= $item['id'] ?>)"
                                        ><i class="fas fa-eye"></i></button>
                                    </td>
                                </tr>
                             <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" id="22">Banky</h4>
                    <table id="tbl-banky" class="table table-striped m-t-20 table-hover">
                        <thead style="background-color: #2B81AF" class="text-white">
                            <th>#</th>
                            <th>Názov</th>
                            <th>Adresa/Mesto/PSČ/Štát</th>
                            <th>IČO</th>
                            <th>Status</th>
                            <th>Akcie</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <button
                                            class="btn btn-info"
                                            onClick="return false;"
                                    >
                                        <i class="fas fa-plus-circle"></i>&nbsp;Pridať
                                    </button>
                                </td>
                            </tr>
                            <?php
                            foreach($banky as $banka) {
                                ?>
                                <tr>
                                    <td><?= $banka['id'] ?></td>
                                    <td><?= $banka['name'] ?></td>
                                    <td>
                                        <?= $banka['address'] ?><br>
                                        <?= $banka['town'] ?><br>
                                        <?= $banka['zip'] ?><br>
                                        <?= $banka['country'] ?>
                                    </td>
                                    <td>
                                        <?= $banka['ico'] ?>
                                    </td>
                                    <td>
                                        <input
                                                type="checkbox"
                                                class="js-switch"
                                                data-color="#26c6da"
                                                data-secondary-color="#f62d51"
                                                data-size="small"
                                                onchange=""
                                            <?= $banka['status'] == 1 ? " checked":""?>
                                        />
                                    </td>
                                    <td>
                                        <button
                                                class="btn btn-default"
                                                onClick="alert('Edit firma')"
                                        ><i class="fas fa-eye"></i></button>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" id="3">Dodávatelia</h4>
                    <table id="tbl-dodavatelia" class="table table-striped m-t-20">
                        <thead style="background-color: #2B81AF" class="text-white">
                            <th>#</th>
                            <th>Názov</th>
                            <th>Kategória</th>
                            <th>Adresa/Mesto/PSČ/Štát</th>
                            <th>Status</th>
                            <th>Akcie</th>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="6">
                                <button
                                        class="btn btn-info"
                                        onClick="return false;"
                                >
                                    <i class="fas fa-plus-circle"></i>&nbsp;Pridať
                                </button>
                            </td>
                        </tr>
                        <?php
                        foreach($dodavatelia as $firma) {
                            ?>
                            <tr>
                                <td><?= $firma['id'] ?></td>
                                <td><?= $firma['name'] ?></td>
                                <td><?= $firma['category'] ?></td>
                                <td>
                                    <?= $firma['address'] ?><br>
                                    <?= $firma['town'] ?><br>
                                    <?= $firma['zip'] ?><br>
                                    <?= $firma['country'] ?>
                                </td>
                                <td>
                                    <input
                                            type="checkbox"
                                            class="js-switch"
                                            data-color="#26c6da"
                                            data-secondary-color="#f62d51"
                                            data-size="small"
                                            onchange=""
                                        <?= $firma['status'] == 1 ? " checked":""?>
                                    />
                                </td>
                                <td>
                                    <button
                                            class="btn btn-default"
                                            onClick="alert('Edit firma')"
                                    ><i class="fas fa-eye"></i></button>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" id="4">Jazyky</h4>
                    <table id="tbl-jazyk" class="table table-striped m-t-20">
                        <thead style="background-color: #2B81AF" class="text-white">
                            <th>#</th>
                            <th>Názov</th>
                            <th>Pôvodný názov</th>
                            <th>ISO</th>
                            <th>Zobraziť na webe</th>
                            <th>Použiť v admine</th>

                            <th>Status</th>
                            <th>Akcie</th>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="8">
                                <button
                                        class="btn btn-info"
                                        onClick="return false;"
                                >
                                    <i class="fas fa-plus-circle"></i>&nbsp;Pridať
                                </button>
                            </td>
                        </tr>
                        <?php
                        foreach($jazyky as $jazyk) {
                            ?>
                            <tr>
                                <td><?= $jazyk['id'] ?></td>
                                <td><?= $jazyk['name'] ?></td>
                                <td><?= $jazyk['original_name'] ?></td>
                                <td><?= $jazyk['iso'] ?></td>
                                <td>
                                    <input
                                            type="checkbox"
                                            class="js-switch"
                                            data-color="#26c6da"
                                            data-secondary-color="#f62d51"
                                            data-size="small"
                                            onchange=""
                                            <?= $jazyk['on_web'] == 1 ? " checked":""?>
                                    />
                                </td>
                                <td>
                                    <input
                                            type="checkbox"
                                            class="js-switch"
                                            data-color="#26c6da"
                                            data-secondary-color="#f62d51"
                                            data-size="small"
                                            onchange=""
                                            <?= $jazyk['on_page'] == 1 ? " checked":""?>
                                    />
                                </td>
                                <td>
                                    <input
                                            type="checkbox"
                                            class="js-switch"
                                            data-color="#26c6da"
                                            data-secondary-color="#f62d51"
                                            data-size="small"
                                            onchange=""
                                            <?= $jazyk['status'] == 1 ? " checked":""?>
                                    />
                                </td>
                                <td>
                                    <button
                                        class="btn btn-default"
                                        onClick="alert('Edit language')"
                                    ><i class="fas fa-eye"></i></button>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" id="5">Kraje</h4>
                    <table id="tbl-kraj" class="table table-striped m-t-20">
                        <thead style="background-color: #2B81AF" class="text-white">
                            <th>#</th>
                            <th>Názov</th>
                            <th>Krajina</th>
                            <th>Status</th>
                            <th>Akcie</th>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="5">
                                <button
                                        class="btn btn-info"
                                        onClick="return false;"
                                >
                                    <i class="fas fa-plus-circle"></i>&nbsp;Pridať
                                </button>
                            </td>
                        </tr>
                        <?php
                            foreach($kraje as $kraj) {
                                ?>
                                <tr>
                                    <td><?= $kraj['id'] ?></td>
                                    <td><?= $kraj['name'] ?></td>
                                    <td><?= $kraj['country_id'] ?></td>
                                    <td>
                                        <input
                                                type="checkbox"
                                                class="js-switch"
                                                data-color="#26c6da"
                                                data-secondary-color="#f62d51"
                                                data-size="small"
                                                onchange=""
                                            <?= $kraj['status'] == 1 ? " checked":""?>
                                        />
                                    </td>
                                    <td>
                                        <button
                                                class="btn btn-default"
                                                onClick="alert('Edit kraj')"
                                        ><i class="fas fa-eye"></i></button>
                                    </td>
                                </tr>
                                <?php
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" id="6">Okresy</h4>
                    <table id="tbl-okres" class="table table-striped m-t-20">
                        <thead style="background-color: #2B81AF" class="text-white">
                            <th>#</th>
                            <th>Názov</th>
                            <th>Kód</th>
                            <th>Kraj</th>
                            <th>Status</th>
                            <th>Akcie</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <button
                                            class="btn btn-info"
                                            onClick="return false;"
                                    >
                                        <i class="fas fa-plus-circle"></i>&nbsp;Pridať
                                    </button>
                                </td>
                            </tr>
                            <?php
                            foreach($okresy as $okres) {
                                ?>
                                <tr>
                                    <td><?= $okres['id'] ?></td>
                                    <td><?= $okres['name'] ?></td>
                                    <td><?= $okres['kod'] ?></td>
                                    <td></td>
                                    <td>
                                        <input
                                                type="checkbox"
                                                class="js-switch"
                                                data-color="#26c6da"
                                                data-secondary-color="#f62d51"
                                                data-size="small"
                                                onchange=""
                                            <?= $okres['status'] == 1 ? " checked":""?>
                                        />
                                    </td>
                                    <td>
                                        <button
                                                class="btn btn-default"
                                                onClick="alert('Edit kraj')"
                                        ><i class="fas fa-eye"></i></button>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" id="7">Štáty</h4>
                    <table id="tbl-stat" class="table table-striped m-t-20">
                        <thead style="background-color: #2B81AF" class="text-white">
                            <th>#</th>
                            <th>Názov</th>
                            <th>ISO kód</th>
                            <th>Predvoľba</th>
                            <th>Status</th>
                            <th>Akcie</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <button
                                            class="btn btn-info"
                                            onClick="return false;"
                                    >
                                        <i class="fas fa-plus-circle"></i>&nbsp;Pridať
                                    </button>
                                </td>
                            </tr>
                            <?php
                            foreach($staty as $stat) {
                                ?>
                                <tr>
                                    <td><?= $stat['id'] ?></td>
                                    <td>
                                        <?= $stat['name'] ?>
                                        <?php
                                        if (!is_null($stat['orig_name'])) {
                                        ?>
                                            <br>
                                            <i class="font-12">(orig: <?= $stat['orig_name']?>)</i>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td><?= $stat['iso_kod']?></td>
                                    <td><?= $stat['predvolba']?></td>
                                    <td>
                                        <input
                                                type="checkbox"
                                                class="js-switch"
                                                data-color="#26c6da"
                                                data-secondary-color="#f62d51"
                                                data-size="small"
                                                onchange=""
                                            <?= $stat['status'] == 1 ? " checked":""?>
                                        />
                                    </td>
                                    <td>
                                        <button
                                                class="btn btn-default"
                                                onClick="alert('Edit kraj')"
                                        ><i class="fas fa-eye"></i></button>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" id="8">Operátory</h4>
                    <table id="tbl-operator" class="table table-striped m-t-20">
                        <thead style="background-color: #2B81AF" class="text-white">
                            <th>#</th>
                            <th>Názov</th>
                            <th>Kód operátora</th>
                            <th>Štát</th>
                            <th>Status</th>
                            <th>Akcie</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <button
                                            class="btn btn-info"
                                            onClick="return false;"
                                    >
                                        <i class="fas fa-plus-circle"></i>&nbsp;Pridať
                                    </button>
                                </td>
                            </tr>
                            <?php
                            foreach($operatory as $ops) {
                                ?>
                                <tr>
                                    <td><?= $ops['id'] ?></td>
                                    <td>
                                        <?= $ops['nazov'] ?>
                                    </td>
                                    <td><?= $ops['operator_kod']?></td>
                                    <td><?= $ops['stat_id']?></td>
                                    <td>
                                        <input
                                                type="checkbox"
                                                class="js-switch"
                                                data-color="#26c6da"
                                                data-secondary-color="#f62d51"
                                                data-size="small"
                                                onchange=""
                                            <?= $ops['status'] == 1 ? " checked":""?>
                                        />
                                    </td>
                                    <td>
                                        <button
                                                class="btn btn-default"
                                                onClick="alert('Edit kraj')"
                                        ><i class="fas fa-eye"></i></button>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="col-lg-3 col-xlg-2 col-md-4">
            <div class="stickyside">
                <div class="list-group" id="top-menu">
                    <a href="#1" class="list-group-item">Kancelárie</a>
                    <a href="#22" class="list-group-item">Banky</a>
                    <a href="#3" class="list-group-item">Dodávatelia</a>
                    <a href="#4" class="list-group-item">Jazyky</a>
                    <a href="#5" class="list-group-item">Kraje</a>
                    <a href="#6" class="list-group-item">Okresy</a>
                    <a href="#7" class="list-group-item">Štáty</a>
                    <a href="#8" class="list-group-item">Operátory</a>
                </div>
            </div>
        </div>

    </div>
</div>

<div id="dialog-kancelarie" title="Kancelária" style="display: none">
    <div style="overflow-scrolling: inherit;">
        <h5 class="card-header font-weight-bold m-b-20" style="padding:10px">Kontaktné údaje</h5>

        <!-- kontaktna osoba -->
        <div class="row">
            <div class="col-md-12 form-group">
                <label class="control-label">Kontaktná osoba</label>
                <input type="text" class="form-control" id="kanc-contact-person">
            </div>
        </div>
        <!-- adresa -->
        <div class="row">
            <div class="col-md-12 form-group">
                <label class="control-label">Ulica a číslo</label>
                <input type="text" class="form-control" id="kanc-address">
            </div>
        </div>
        <!-- mesto -->
        <div class="row">
            <div class="col-md-6 form-group">
                <label class="control-label">Mesto</label>
                <input type="text" class="form-control" id="kanc-town">
            </div>
            <div class="col-md-6 form-group">
                <label class="control-label">PSČ</label>
                <input type="text" class="form-control" id="kanc-zip">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <label class="control-label">Štát</label>
                <input type="text" class="form-control" id="kanc-country">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                <label class="control-label">Email</label>
                <input type="text" class="form-control" id="kanc-email">
            </div>
            <div class="col-md-6 form-group">
                <label class="control-label">Telefón</label>
                <input type="text" class="form-control" id="kanc-phone">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <label class="control-label">Web</label>
                <input type="text" class="form-control" id="kanc-web">
            </div>
        </div>
        <h5 class="card-header font-weight-bold m-b-20" style="padding:10px">Bankové spojenie</h5>
        <div class="row">
            <div class="col-md-12 form-group">
                <label class="control-label">Banka</label>
                <select class="form-control dropdown" id="kanc-bank">
                    <option value="">Zvoľte banku</option>
                    <?php
                    foreach($banky as $banka) {
                        echo "<option value='{$banka['name']}'>{$banka['name']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <label class="control-label">IBAN</label>
                <input type="text" class="form-control" id="kanc-iban">
            </div>
        </div>
        <h5 class="card-header font-weight-bold m-b-20" style="padding:10px">Firemné údaje</h5>
        <div class="row">
            <div class="col-md-6 form-group">
                <label class="control-label">IČO</label>
                <input type="text" class="form-control" id="kanc-ico">
            </div>
            <div class="col-md-6 form-group">
                <label class="control-label">DIČ</label>
                <input type="text" class="form-control" id="kanc-dic">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <label class="control-label">IČ DPH</label>
                <input type="text" class="form-control" id="kanc-icdph">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <label class="control-label">Firma registrovaná</label>
                <textarea class="form-control" id="kanc-registered" style="height:200px;"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="kanc-vat-payer">
                    <label class="custom-control-label" for="kanc-vat-payer">Firma je platcom DPH</label>
                </div>
             </div>
            <div class="col-md-6 form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="kanc-default-comp">
                    <label class="custom-control-label" for="kanc-default-comp">Firma je centrála</label>
                </div>
            </div>
        </div>
    </div>
</div>


<?php

$kanclUrl = Url::to(['/ajax/get-office']);
$kancSaveUrl = Url::to(['/ajax/save-office']);

$js = <<<JS

    function splitIBAN(notSplittedIBAN) 
    {
      var iban = notSplittedIBAN.match(/.{1,4}(?=(.{4})+(?!.))|.{1,4}$/g);
      return iban.join(" ");
    }
    
    $('#kanc-iban').on('blur',function(){
       $(this).val(splitIBAN($(this).val())) 
    });

    ajaxCaller = function(url, data, callbackFunc) {
        $.ajax({
                url: url,
                dataType: "json",
                data: data,
                type: "post"
            }).done(function(data){
                callbackFunc(data);
            });
    }
    
    ajaxSaver = function(url, data) {
        return $.ajax({
                url: url,
                dataType: "json",
                data: data,
                type: "post"
            }).done(function(data){
                return true;
            }).fail(function(){
                return false;
            });
    }
    
    displayDialog = function(it, id, callbackFnc) {
        $('#dialog-' + it).dialog({
                height: 600,
                width: 750,
                modal: true,
                resizable: false,
                dialogClass: 'dialogWithDropShadow',
                buttons: [{
                        id: "btn-save",
                        text: "Uložiť",
                        click: function() {
                            if ( callbackFnc(id) ) {
                                $(this).dialog("close");
                            } else {
                                // error message
                                console.log("Error...");
                            }
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
    }
    loadConfigData = function(url, id, callbackFnc) {
        var data = {"id":id};
        ajaxCaller(url, data, callbackFnc);
     }
    fillConfigForm = function(resp) {
        for(const [key,value] of Object.entries( resp )) {
            if ($('#'+key).is('input:checkbox')) {
                if (value==1) {
                    $('#'+key).prop("checked",true);
                } else {
                    $('#'+key).prop("checked",false);
                }
                continue;
            }
            $('#'+key).val(value);
        }
    }
    
    saveKanclForm = function(id) {
        var saveData = {
            "id": id,
            "address" : $('#kanc-address').val(),
            "contact_person": $("#kanc-contact-person").val(),
            "town": $('#kanc-town').val(),
            "zip": $('#kanc-zip').val(),
            "country": $('#kanc-country').val(),
            "email": $('#kanc-email').val(),
            "phone": $('#kanc-phone').val(),
            "web": $("#kanc-web").val(),
            "bank": $('#kanc-bank option:selected').val(),
            "iban": $('#kanc-iban').val(),
            "ico": $('#kanc-ico').val(),
            "dic": $('#kanc-dic').val(),
            "icdph": $('#kanc-icdph').val(),
            "registered": $('#kanc-registered').val(),
            "vat_payer": $('#kanc-vat-payer').is(':checked') ? 1 : 0,
            "default_company": $('#kanc-default-comp').is(':checked') ? 1 : 0
        }
        console.log(saveData);
        return ajaxSaver('{$kancSaveUrl}',saveData);
    }
    
    editConfig = function(it,id) {
        var url = "";
        var callbackShow = fillConfigForm;
        var callbackSave = "";
        
        if (it == 'kancelarie') {
            url = '{$kanclUrl}';
            callbackSave = saveKanclForm;
        }
        
        if (url != "" && callbackShow != "" && callbackSave != "" ) {
            loadConfigData(url, id, callbackShow);
            displayDialog(it,id,callbackSave);
        }
    }   
     
   
 
    $(".stickyside").stick_in_parent({
        offset_top: 100
    });
    $('.stickyside a').click(function() {
        $('html, body').animate({
            scrollTop: $($(this).attr('href')).offset().top - 100
        }, 500);
        return false;
    });
    var lastId,
        topMenu = $(".stickyside"),
        topMenuHeight = topMenu.outerHeight(),
        // All list items
        menuItems = topMenu.find("a"),
        // Anchors corresponding to menu items
        scrollItems = menuItems.map(function() {
            var item = $($(this).attr("href"));
            if (item.length) {
                return item;
            }
        });
    $(window).scroll(function() {
        var fromTop = $(this).scrollTop() + topMenuHeight - 250;
        var cur = scrollItems.map(function() {
            if ($(this).offset().top < fromTop)
                return this;
        });
        cur = cur[cur.length - 1];
        var id = cur && cur.length ? cur[0].id : "";

    });
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    $('.js-switch').each(function () {
        new Switchery($(this)[0], $(this).data());
    });
JS;

$this->registerJS($js);

$css = <<<CSS
.dialogWithDropShadow
 {
     -webkit-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);  
     -moz-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); 
 }
.ui-widget-header {
    background-color: #2B81AF !important;
    color: white !important;
}
CSS;
$this->registerCSS($css);
