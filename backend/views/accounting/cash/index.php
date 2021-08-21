<?php
use common\models\search\BackendSearch;
use backend\assets\RealAsset;
use yii\helpers\Url;
use backend\helpers\HelpersNum;
$this->title="Účtovníctvo - Pokladničné doklady";
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
            <a class="btn btn-success" href="/backoffice/accounting/add-receipt">
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
                                <label class="form-control-label" for="rok">Typ dokumentu</label><br>
                                <select name="dt" class="form-control dropdown" id="dt">
                                    <option value="">Všetky typy</option>
                                    <option value="PPD"<?= isset($_GET['dt']) && $_GET['dt'] === 'PPD' ? ' selected' : '' ?>>Príjmový</option>
                                    <option value="VPD"<?= isset($_GET['dt']) && $_GET['dt'] === 'VPD' ? ' selected' : '' ?>>Výdavkový</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <label class="form-control-label" for="status">Status</label><br>
                                <select class="form-control dropdown" name="st" id="st">
                                    <option value="">Všetky statusy</option>
                                    <option value="0"<?= isset($_GET['st']) && $_GET['st'] !=='' && (int)$_GET['st'] === 0 ? ' selected' : '' ?>>Nesplatené</option>
                                    <option value="1"<?= isset($_GET['st']) && $_GET['st'] !=='' && (int)$_GET['st'] === 1 ? ' selected' : '' ?>>Splatené</option>
                                    <option value="2"<?= isset($_GET['st']) && $_GET['st'] !=='' && (int)$_GET['st'] === 2 ? ' selected' : '' ?>>Zmazané</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label class="form-control-label" for="odber">Odberatelia</label><br>
                                <select class="form-control dropdown" id="odber" name="odber[]" multiple>
                                    <?php
                                    foreach($clients as $it) {
                                        $nazov = $it->kontaktna_osoba;
                                        if ($it->nazov != '') {
                                            $nazov = $it->nazov;
                                        }
                                        $selected = '';
                                        if (isset($_GET['odber']) && in_array($nazov, $_GET['odber'])) {
                                            $selected = ' selected';
                                        }
                                        echo "<option value='{$nazov}'{$selected}>{$nazov}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-sm-3">
                                <label class="form-control-label" for="dodav">Dodávatelia</label><br>
                                <select class="form-control dropdown" id="dodav" name="dodav[]" multiple>
                                    <?php
                                    foreach($office as $it) {
                                        $selected = '';
                                        if (isset($_GET['dodav']) && in_array($it->nazov, $_GET['dodav'])) {
                                            $selected = ' selected';
                                        }
                                        echo "<option value='{$it->nazov}'{$selected}>{$it->nazov}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row m-t-10">
                            <div class="col-lg-12">
                                <input type="submit" value="Hladať" class="btn btn-success">
                                <a href="<?= Url::to(['/accounting/cash-receipt']) ?>" class="btn btn-danger">Reset</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <?php
                    $pocet_stran = HelpersNum::getPageNumber($pocet,BackendSearch::PAGE_LIMIT);
                    $disableLeft = $disableRight = " disabled";
                    if ($pocet_stran > 1 && $akt_strana > 1) {
                        $disableLeft = "";
                    }
                    if ($akt_strana < $pocet_stran && $pocet_stran >1) {
                        $disableRight = "";
                    }

                    echo $this->render('index-paging',[
                        'disableLeft'   => $disableLeft,
                        'disableRight'  => $disableRight,
                        'pocet_stran'   => $pocet_stran,
                        'akt_strana'    => $akt_strana
                    ]);
                    ?>

                    <table id="tbl-invoices" class="table table-striped m-t-5">
                        <thead style="background-color: #2B81AF" class="text-white">
                        <th>#</th>
                        <th>Č. dokladu</th>
                        <th>Typ dokladu</th>
                        <th>Dodávateľ</th>
                        <th>Odberateľ</th>
                        <th>Suma</th>
                        <th>Status</th>
                        <th>Akcie</th>
                        </thead>
                        <tbody>
                        <?php
                            if (empty($doklady)) {
                                echo "<tr><td colspan='8' align='center'>No data...</td></tr>";
                            } else {
                                foreach($doklady as $it){
                        ?>
                                    <tr>
                                        <td><?= $it->id ?></td>
                                        <td><?= $it->cislo ?></td>
                                        <td><?= $it->pp_typ ?></td>
                                        <td><?= $it->dodavatel->nazov ?></td>
                                        <td><?php
                                            if (isset($it->odberatel->nazov) &&  $it->odberatel->nazov != '') {
                                                echo $it->odberatel->nazov;
                                            } elseif(isset($it->odberatel->kontaktna_osoba) &&  $it->odberatel->kontaktna_osoba != '') {
                                                echo $it->odberatel->kontaktna_osoba;
                                            } else {
                                                echo "";
                                            }
                                            ?></td>
                                        <td><?= $it->suma ?></td>
                                        <td><?= $it->getStatusText() ?></td>
                                        <td>
                                            <a
                                                    href="<?= Url::to(['accounting/print','t'=>$it->pp_typ,'id'=>$it->id]) ?>"
                                                    title="Print"
                                                    style="color: black"
                                            >
                                                <i class="fas fa-print"></i>
                                            </a>
                                            <a
                                                    href="<?= Url::to(['accounting/edit-cash-receipt','id'=>$it->id]) ?>"
                                                    title="Edit"
                                                    style="color: black">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                        <?php
                                }
                            }
                        ?>
                        </tbody>
                    </table>

                    <?php
                    echo $this->render('index-paging',[
                        'disableLeft'   => $disableLeft,
                        'disableRight'  => $disableRight,
                        'pocet_stran'   => $pocet_stran,
                        'akt_strana'    => $akt_strana
                    ]);
                    ?>
                </div>
            </div>

        </div>

    </div>

</div>

<?php

$js = <<<JS
    $('#rok').select2({
        theme: 'bootstrap',
        tags: false
    });
    $('#dt').select2({
        theme: 'bootstrap',
        tags: false
    });
    $('#st').select2({
        theme: 'bootstrap',
        tags: false
    });
    $('#odber').select2({
        theme: 'bootstrap',
        tags: false
    });
    $('#dodav').select2({
        theme: 'bootstrap',
        tags: false
    });
JS;

$this->registerJS($js);