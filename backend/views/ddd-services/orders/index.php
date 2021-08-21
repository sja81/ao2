<?php
use backend\assets\RealAsset;
use yii\helpers\Url;
use backend\helpers\HelpersNum;
use common\models\search\BackendSearch;
$this->title="DDD & Ozone - Objednávky";

$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css',['depends'=>RealAsset::className()]);
$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css',['depends'=>RealAsset::className()]);
$this->registerJSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.full.min.js',['depends'=>RealAsset::className()]);
?>
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-12 align-self-center">
                <h4 class="text-themecolor"><?= $this->title ?></h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="/backoffice/dddüservices/add-order">
                    <i class="fas fa-plus-circle"></i>&nbsp;Pridať
                </a>
            </div>
        </div>

        <form method="get">
            <div class="row m-t-20">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label class="form-control-label" for="rok">Rok</label><br>
                                    <select class="form-control dropdown" id="rok" name="rok">
                                        <option value="">Všetky roky</option>
                                        <?php
                                        $maxDate = (new DateTime('now'))->format('Y');

                                        for($i=$maxDate;$i>1990;$i--){
                                            $selected = '';
                                            if (isset($_GET['rok']) && $i === (int)$_GET['rok']) {
                                                $selected = ' selected';
                                            }
                                            echo "<option value='{$i}'{$selected}>{$i}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-control-label" for="status">Status</label><br>
                                    <select class="form-control dropdown" id="status" name="status">
                                        <option value="">Všetky statusy</option>
                                        <option value="1">Nesplatené</option>
                                        <option value="2">Splatené</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-control-label" for="fa-typ">Typ faktúry</label><br>
                                    <select class="form-control dropdown" id="fa-typ" name="fa-typ[]" multiple>
                                        <option value=""></option>
                                        <option value="0">Faktúra</option>
                                        <option value="1">Zálohová faktúra</option>
                                        <option value="2">Dobropis</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label class="form-control-label" for="odber">Odberatelia</label><br>
                                    <select class="form-control dropdown" id="odber" name="odber[]" multiple>
                                        <option value=""></option>
                                    </select>
                                </div>

                                <div class="col-sm-3">
                                    <label class="form-control-label" for="dodav">Dodávatelia</label><br>
                                    <select class="form-control dropdown" id="dodav" name="dodav[]" multiple>
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="row m-t-10">
                                <div class="col-lg-12">
                                    <input type="submit" value="Hladať" class="btn btn-success">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table id="tbl-stock-cards" class="table table-striped m-t-5 table-condensed">
                            <thead style="background-color: #2B81AF" class="text-white">
                            <th>#</th>
                            <th>Názov</th>
                            <th>Naskladnené</th>
                            <th>Expirácia</th>
                            <th>Na sklade</th>
                            <th>Výrobca</th>
                            <th>Akcie</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



    </div>
<?php

$js = <<<JS
    $('#rok').select2({
        theme: "bootstrap",
        tags: false
    });
    $('#status').select2({
        theme: "bootstrap",
        tags: false
    });
    $('#fa-typ').select2({
        theme: "bootstrap",
        tags: false
    });
    $('#odber').select2({
        theme: "bootstrap",
        tags: false
    });
    $('#dodav').select2({
        theme: "bootstrap",
        tags: false
    });
JS;

$this->registerJS($js);
