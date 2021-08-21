<?php
use common\models\NehnutelnostDokumenty;
use backend\assets\RealAsset;
use yii\helpers\Url;

$this->title=Yii::t('app',"Dokumenty");

$this->registerJSFile('@web/assets/node_modules/jqueryui/jquery-ui.min.js',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/jqueryui/jquery-ui.min.css',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/css/documents.css',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/js/documents.js',['depends'=>RealAsset::class]);
$this->registerJSFile('https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js',['depends'=>RealAsset::class]);
?>

<div class="container-fluid">

    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?> - <?= Yii::t('app','zákazka č.') ?> <?= $contract->cislo ?></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                   <div class="row">
                       <div class="col-xs-4">
                            <label class="control-label"><?= Yii::t('app','Firmy') ?>:</label>
                            <select class="form-control dropdown" id="doc-company-id">
                            <?php
                            foreach($companies as $it) {
                            ?>
                                <option value="<?= $it->id ?>"><?= $it->name ?></option>
                            <?php
                            }
                            ?>
                            </select>
                       </div>
                       <div class="col-xs-2 m-l-10">
                           <button class="btn btn-info m-t-30" id="dalsie-udaje"><?= Yii::t('app','Ďalšie údaje') ?></button>
                       </div>
                       <div class="col-xs-2 m-l-10">
                           <button class="btn btn-success m-t-30 disabled" id="gendoc">Vygeneruj dokumenty</button>
                       </div>
                       <div class="col-xs-4 m-l-10">
                           <a href="/backoffice/contracts" class="btn btn-danger m-t-30"><i class="mdi mdi-rewind"></i> <?= Yii::t('app','Späť') ?></a>
                       </div>

                   </div>

                    <div class="row m-t-30">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <?php
                                $today = (new DateTime())->format("Y-m-d");
                                ?>

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th><?= Yii::t('app','Poradie') ?></th>
                                        <th><?= Yii::t('app','Názov dokumentu') ?></th>
                                        <th><?= Yii::t('app','Dátum') ?></th>
                                        <th><?= Yii::t('app','Miesto podpisu') ?></th>
                                        <th><?= Yii::t('app','Komentáre') ?></th>
                                        <th><?= Yii::t('app','Akcie') ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $c = count($dokumenty);
                                    $previousDoc = "";
                                    $k = 1;

                                    for ($i=0; $i < $c; $i++) {
                                        $item = $dokumenty[$i];
                                        if ($previousDoc != $item['code']) {
                                            $previousDoc = $item['code'];
                                            $k=1;
                                        } else {
                                            ++$k;
                                        }
                                        ?>
                                        <tr>
                                            <td>
                                            <?php
                                                if ($item['can_gen'] == 1) {
                                            ?>
                                                <input type="checkbox" class="doc-gen" id="<?= $item['code'] ?>-gen-<?= $k ?>" data-id="<?= $item['code'] ?>" data-poradie="<?= $k ?>">
                                            <?php
                                                }
                                            ?>
                                            </td>
                                            <td><?= $i + 1 ?></td>
                                            <td><?= $item['name'] ?></td>
                                            <td>
                                                <?php
                                                if ($item['date_field'] == 1) {
                                                    ?>
                                                    <input type="date" value="<?= $today ?>" id="<?= $item['code'] ?>-datum-<?= $k ?>" class="form-control">
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($item['sign_field'] == 1) {
                                                    ?>
                                                    <input type="text" id="<?= $item['code'] ?>-podpis-<?= $k ?>" class="form-control">
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                               <button class="btn btn-info" onclick="openCommentWindow()"><?= Yii::t('app','Pridať') ?></button>
                                            </td>
                                            <td>
                                                <a
                                                        href="<?= Yii::getAlias('@webroot')?>"
                                                        target="_blank"
                                                        class="btn btn-info" style="display: none"
                                                        id="url-<?= $item['code'] ?>-<?= $k ?>"
                                                >
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                    $c = count($chybajuce_dokumenty);
                                    $c1 = count($dokumenty);
                                    $previousDoc = "";
                                    $k = 1;
                                    for ($i=0; $i < $c; $i++) {
                                        $poradie = $c1 + 1 + $i;
                                        $item = $chybajuce_dokumenty[$i];
                                        if ($previousDoc != $item['code']) {
                                            $previousDoc = $item['code'];
                                            $k=1;
                                        } else {
                                            ++$k;
                                        }
                                        ?>
                                        <tr>
                                            <td>
                                                <?php
                                                    if ($item['can_gen'] == 1) {
                                                ?>
                                                <input
                                                        type="checkbox"
                                                        class="doc-gen"
                                                        id="<?= $item['code'] ?>-gen-<?= $k ?>"
                                                        data-id="<?= $item['code'] ?>"
                                                        data-poradie="<?= $k ?>"
                                                >
                                            <?php
                                                    }
                                            ?>
                                            </td>
                                            <td>
                                                <?= $poradie ?>
                                            </td>
                                            <td>
                                                <?= $item['name'] ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($item['date_field'] == 1) {
                                                    ?>
                                                    <input type="date" value="<?= $today ?>"
                                                           id="<?= $item['code'] ?>-datum-<?= $k ?>" class="form-control">
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($item['sign_field'] == 1) {
                                                    ?>
                                                    <input type="text" id="<?= $item['code'] ?>-podpis-<?= $k ?>" class="form-control">
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-info" onclick="openCommentWindow()"><?= Yii::t('app','Pridať') ?></button>
                                            </td>
                                            <td>
                                                <a
                                                        href="<?= Yii::getAlias('@webroot')?>"
                                                        target="_blank"
                                                        class="btn btn-info" style="display: none"
                                                        id="url-<?= $item['code'] ?>-<?= $k ?>"
                                                >
                                                    <i class="fa fa-download"></i>
                                                </a>
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


                    <div class="modal fade bs-example-modal-lg" id="otherDataModal" tabindex="-1" role="dialog" aria-labelledby="otherDataModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="otherDataModalLabel"><?= Yii::t('app','Ďalšie údaje') ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="odata-frm" enctype="multipart/form-data" method="post">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="nehnutelnost-tab" data-toggle="tab" href="#nehnutelnost" role="tab" aria-controls="nehnutelnost" aria-selected="false">
                                                <?= Yii::t('app','Nehnuteľnosť') ?> <sub class="small text-danger">(1)</sub>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="predavajuci-tab" data-toggle="tab" href="#predavajuci" role="tab" aria-controls="predavajuci" aria-selected="false">
                                                <?= Yii::t('app','Predávajúci') ?> <sub class="small text-danger">(1,3,4)</sub>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="kupujuci-tab" data-toggle="tab" href="#kupujuci" role="tab" aria-controls="kupujuci" aria-selected="false">
                                                <?= Yii::t('app','Kupujúci') ?> <sub class="small text-danger">(1,3,4)</sub>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="splnomocnenec-tab" data-toggle="tab" href="#splnomocnenec" role="tab" aria-controls="splnomocnenec" aria-selected="false">
                                                <?= Yii::t('app','Splnomocnenec') ?> <sub class="small text-danger">(2)</sub>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="dodavatelia-tab" data-toggle="tab" href="#dodavatelia" role="tab" aria-controls="dodavatelia" aria-selected="false">
                                                <?= Yii::t('app','Dodávatelia') ?> <sub class="small text-danger">(2)</sub>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="financovanie-tab" data-toggle="tab" href="#financovanie" role="tab" aria-controls="financovanie" aria-selected="false">
                                                <?= Yii::t('app','Financovanie') ?> <sub class="small text-danger">(4)</sub>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="podpisy-tab" data-toggle="tab" href="#podpisy" role="tab" aria-controls="podpisy" aria-selected="false">
                                                <?= Yii::t('app','Overenie podpisov') ?> <sub class="small text-danger"></sub>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">

                                        <div class="tab-pane fade show active m-l-10 m-r-10 m-b-10 m-t-20" id="nehnutelnost" role="tabpanel" aria-labelledby="nehnutelnost-tab">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <?= Yii::t('app','Tu môžete nahrať nové LV') ?>
                                                </div>
                                            </div>
                                            <div class="row m-b-30">
                                                <div class="col-md-10">
                                                    <input type="file" class="form-control">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-secondary"><i class="mdi mdi-upload"></i> <?= Yii::t('app','Nahrať') ?></button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Súpisné č.') ?></label>
                                                    <input type="text" class="form-control" name="Dt[neh][sup_cis]">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Evidovaná(é) na LV č.') ?></label>
                                                    <input type="text" class="form-control" name="Dt[neh][lv_cis]">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Orient.č.') ?></label>
                                                    <input type="text" class="form-control" name="Dt[neh][ori_cis]">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Č. bytu (nebyt. priestoru)') ?></label>
                                                    <input type="text" class="form-control" name="Dt[neh][byt_cis]">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Parc.č.') ?></label>
                                                    <input type="text" class="form-control" name="Dt[neh][parc_cis]">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Obec') ?></label>
                                                    <select class="js-data-example-ajax form-control"  name="Dt[neh][obec]">
                                                    </select>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Kód obce') ?></label>
                                                    <input type="text" class="form-control" name="Dt[neh][obec_kod]">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Ulica') ?></label>
                                                    <input type="text" class="form-control" name="Dt[neh][ulica]">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','PSČ') ?></label>
                                                    <select class="js-data-psc form-control" name="Dt[neh][psc]">
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Katastrálne územie') ?></label>
                                                    <input type="text" class="form-control" name="Dt[neh][kat_uz]">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Kód kat. územia') ?></label>
                                                    <input type="text" class="form-control" name="Dt[neh][kod_katuz]">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Okres') ?></label>
                                                    <input type="text" class="form-control" name="Dt[neh][okres]">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Kód okresu') ?></label>
                                                    <input type="text" class="form-control" name="Dt[neh][okr_kod]">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Krajina') ?></label>
                                                    <input type="text" class="form-control" name="Dt[neh][kod_krajina]">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Kraj') ?></label>
                                                    <input type="text" class="form-control" name="Dt[neh][kraj]">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','GPS - lat') ?></label>
                                                    <input type="text" class="form-control" name="Dt[neh][gps_la]">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','GPS - long') ?></label>
                                                    <input type="text" class="form-control" name="Dt[neh][gps_lo]">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade m-l-10 m-r-10 m-b-10 m-t-20" id="predavajuci" role="tabpanel" aria-labelledby="predavajuci-tab">
                                            <?php
                                            foreach($predajcovia as $i => $item) {
                                            ?>
                                            <h5 class="m-b-10"><?= Yii::t('app', 'Predávajúci č.') ?> <?= $i + 1 ?></h5>
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Typ majiteľa') ?></label>
                                                    <select class="form-control select-drop" name="Dt[pr][][typ]" onchange="changeSellerType(<?= $i + 1 ?>)" id="st-<?= $i + 1 ?>">
                                                        <option value="osoba" selected><?= Yii::t('app','Fyzická osoba') ?></option>
                                                        <option value="szco"><?= Yii::t('app','FO - SZČO') ?></option>
                                                        <option value="firma"><?= Yii::t('app','Firma') ?></option>
                                                    </select>
                                                </div>
                                            </div>

                                            <h5 class="sc-op-load-<?= $i+1 ?>">
                                                <?= Yii::t('app','Nahrajte občiansky preukaz predávajúceho') ?>
                                            </h5>
                                            <div class="row sc-op-load-<?= $i+1 ?> m-b-20">
                                                <div class="col-sm-6">
                                                    <label for="op-predna" class="form-control-label"><?= Yii::t('app','Predná strana') ?></label>
                                                    <input type="file" name="op_predna" id="op-predna" class="form-control">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="op-zadna" class="form-control-label"><?= Yii::t('app','Zadná strana') ?></label>
                                                    <input type="file" name="op_zadna" id="op-zadna" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row m-t-10 sc-op-load-<?= $i+1 ?> m-b-40">
                                                <div class="col-md-12">
                                                    <button type="button" class="btn btn-secondary" id="repr-op"><i class="mdi mdi-upload"></i> <?= Yii::t('app','Nahrať OP') ?></button>
                                                </div>
                                            </div>



                                            <div class="row sel-company" id="sc-om-<?= $i + 1 ?>">
                                                <div class="col-md-12 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Obchodné meno') ?></label>
                                                    <input type="text" class="form-control" name="Dt[pr][][obchm]">
                                                </div>
                                            </div>
                                            <div class="row sel-company" id="sc-tax-<?= $i + 1 ?>">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label">IČO</label>
                                                    <input type="text" class="form-control" name="Dt[pr][][ico]">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label">DIČ</label>
                                                    <input type="text" class="form-control" name="Dt[pr][][dic]">
                                                </div>
                                            </div>
                                            <div class="row sel-company" id="sc-icdph-<?= $i + 1 ?>">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label">IČ DPH</label>
                                                    <input type="text" class="form-control" name="Dt[pr][][icdph]">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label">Email</label>
                                                    <input type="text" class="form-control" name="Dt[pr][][email]">
                                                </div>
                                                <div class="col-md-1 form-group">
                                                    <label class="control-label">Telefón</label>
                                                    <select class="form-control select-drop" name="Dt[pr][][predv]">
                                                        <?php
                                                        foreach($predvolby as $item) {
                                                            echo "<option value={$item['predvolba']}>+{$item['predvolba']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-5 form-inline">
                                                    <span style="margin-left:-10px; margin-right: 5px;">(</span>
                                                    <select class="form-control select-drop col-lg-2" name="Dt[pr][][uto]">
                                                        <?php
                                                        foreach ($uto as $item) {
                                                            echo "<option value={$item['operator_kod']}>{$item['operator_kod']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <span style="margin-left: 5px; margin-right: 10px;">)</span>
                                                    <input type="text" class="form-control col-lg-9" name="Dt[pr][][tel]">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Titul pred menom') ?></label>
                                                    <select class="form-control select-drop" name="Dt[pr][][titp]">
                                                        <option value=""><?= Yii::t('app','Zvoľte titul') ?></option>
                                                        <?php
                                                        foreach($titul_pred as $item) {
                                                            echo "<option value='{$item['short_name']}'>{$item['short_name']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Titul za menom') ?></label>
                                                    <select class="form-control select-drop" name="Dt[pr][][titza]">
                                                        <option value=""><?= Yii::t('app','Zvoľte titul') ?></option>
                                                        <?php
                                                        foreach($titul_za as $item) {
                                                            echo "<option value='{$item['short_name']}'>{$item['short_name']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Priezvisko') ?></label>
                                                    <input type="text" class="form-control" name="Dt[pr][][priez]">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Meno') ?></label>
                                                    <input type="text" class="form-control" name="Dt[pr][][meno]">
                                                </div>
                                            </div>
                                            <div class="row" id="sp-rp-<?= $i + 1 ?>">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Rodné priezvisko') ?></label>
                                                    <input type="text" class="form-control" name="Dt[pr][][rodpriez]">
                                                </div>
                                                <div class="col-md-6 form-group"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <label class="control-label">Adresa</label>
                                                    <input type="text" class="form-control" name="Dt[pr][][adresa]">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label">Mesto</label>
                                                    <select class="form-control" name="Dt[pr][][mesto]">
                                                    </select>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label">PSČ</label>
                                                    <select class="form-control select-drop" name="Dt[pr][][psc]">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row" id="sp-gend-<?= $i + 1 ?>">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Pohlavie') ?></label>
                                                    <select class="form-control select-drop" name="Dt[pr][][pohl]">
                                                        <option>Zvoľte pohlavie</option>
                                                        <option value="1">Muž</option>
                                                        <option value="2">Žena</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row" id="sp-dat-<?= $i + 1 ?>">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label">Dátum narodenia</label>
                                                    <input type="date" class="form-control" name="Dt[pr][][datnarod]">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label">Rodné číslo (zadajte bez lomitka)</label>
                                                    <input type="text" class="form-control" name="Dt[pr][][ssn]">
                                                </div>
                                            </div>
                                            <div class="row" id="sp-op1-<?= $i + 1 ?>">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Číslo OP') ?></label>
                                                    <input type="text" class="form-control" name="Dt[pr][][cisop]">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','OP vydal') ?></label>
                                                    <input type="text" class="form-control" name="Dt[pr][][vydalop]">
                                                </div>
                                            </div>
                                            <div class="row" id="sp-op2-<?= $i + 1 ?>">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Dátum vydania') ?></label>
                                                    <input type="date" class="form-control" name="Dt[pr][][datvyd]">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Dátum platnosti') ?></label>
                                                    <input type="date" class="form-control" name="Dt[pr][][datplat]">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Podpis') ?></label>
                                                    <div class="wrapper">
                                                        <canvas id="seller-signature-pad-<?= $i + 1 ?>" class="signature-pad seller-pad" width=400 height=200></canvas>
                                                    </div>
                                                    <button id="seller-clear-<?= $i + 1 ?>" class="btn btn-secondary m-t-10" type="button">Clear</button>
                                                </div>
                                            </div>

                                                <?php
                                            }
                                                ?>
                                        </div>
                                        <div class="tab-pane fade m-l-10 m-r-10 m-b-10 m-t-20" id="kupujuci" role="tabpanel" aria-labelledby="kupujuci-tab">
                                            <h5 class="m-b-10"><?= Yii::t('app', 'Kupujúci č.') ?> 1</h5>
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Typ majiteľa') ?></label>
                                                    <select class="form-control select-drop" name="Dt[ku][][typ]" onchange="changeBuyerType(<?= $i + 1 ?>)" id="bt-<?= $i + 1 ?>">
                                                        <option value="osoba" selected><?= Yii::t('app','Fyzická osoba') ?></option>
                                                        <option value="szco"><?= Yii::t('app','FO - SZČO') ?></option>
                                                        <option value="firma"><?= Yii::t('app','Firma') ?></option>
                                                    </select>
                                                </div>
                                            </div>

                                            <h5 class="ku-op-load-<?= $i+1 ?>">
                                                <?= Yii::t('app','Nahrajte občiansky preukaz predávajúceho') ?>
                                            </h5>
                                            <div class="row ku-op-load-<?= $i+1 ?> m-b-20">
                                                <div class="col-sm-6">
                                                    <label for="op-predna" class="form-control-label"><?= Yii::t('app','Predná strana') ?></label>
                                                    <input type="file" name="op_predna" id="op-predna" class="form-control">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="op-zadna" class="form-control-label"><?= Yii::t('app','Zadná strana') ?></label>
                                                    <input type="file" name="op_zadna" id="op-zadna" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row m-t-10 ku-op-load-<?= $i+1 ?> m-b-40">
                                                <div class="col-md-12">
                                                    <button type="button" class="btn btn-secondary" id="repr-op"><i class="mdi mdi-upload"></i> <?= Yii::t('app','Nahrať OP') ?></button>
                                                </div>
                                            </div>

                                            <div class="row sel-company" id="bc-om-1">
                                                <div class="col-md-12 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Obchodné meno') ?></label>
                                                    <input type="text" class="form-control" name="Dt[ku][][obchm]">
                                                </div>
                                            </div>
                                            <div class="row sel-company" id="bc-tax-1">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label">IČO</label>
                                                    <input type="text" class="form-control" name="Dt[ku][][ico]">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label">DIČ</label>
                                                    <input type="text" class="form-control" name="Dt[ku][][dic]">
                                                </div>
                                            </div>
                                            <div class="row sel-company" id="sc-icdph-1">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label">IČ DPH</label>
                                                    <input type="text" class="form-control" name="Dt[ku][][icdph]">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label">Email</label>
                                                    <input type="text" class="form-control" name="Dt[ku][][email]">
                                                </div>
                                                <div class="col-md-1 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Telefón') ?></label>
                                                    <select class="form-control select-drop" name="Dt[ku][][predv]">
                                                        <?php
                                                        foreach($predvolby as $item) {
                                                            echo "<option value={$item['predvolba']}>+{$item['predvolba']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-5 form-inline">
                                                    <span style="margin-left:-10px; margin-right: 5px;">(</span>
                                                    <select class="form-control select-drop col-lg-2" name="Dt[ku][][uto]">
                                                        <?php
                                                        foreach ($uto as $item) {
                                                            echo "<option value={$item['operator_kod']}>{$item['operator_kod']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <span style="margin-left: 5px; margin-right: 10px;">)</span>
                                                    <input type="text" class="form-control col-lg-9" name="Dt[ku][][tel]">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Titul pred menom') ?></label>
                                                    <select class="form-control select-drop" name="Dt[ku][][titp]">
                                                        <option value=""><?= Yii::t('app','Zvoľte titul') ?></option>
                                                        <?php
                                                        foreach($titul_pred as $item) {
                                                            echo "<option value='{$item['short_name']}'>{$item['short_name']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Titul za menom') ?></label>
                                                    <select class="form-control select-drop" name="Dt[ku][][titza]">
                                                        <option value=""><?= Yii::t('app','Zvoľte titul') ?></option>
                                                        <?php
                                                        foreach($titul_za as $item) {
                                                            echo "<option value='{$item['short_name']}'>{$item['short_name']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Priezvisko') ?></label>
                                                    <input type="text" class="form-control" name="Dt[ku][][priez]">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Meno') ?></label>
                                                    <input type="text" class="form-control" name="Dt[ku][][meno]">
                                                </div>
                                            </div>
                                            <div class="row" id="bp-rp-1">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Rodné priezvisko') ?></label>
                                                    <input type="text" class="form-control" name="Dt[ku][][rodpriez]">
                                                </div>
                                                <div class="col-md-6 form-group"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <label class="control-label">Adresa</label>
                                                    <input type="text" class="form-control" name="Dt[ku][][adresa]">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label">Mesto</label>
                                                    <select class="form-control" name="Dt[ku][][mesto]">
                                                    </select>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','PSČ') ?></label>
                                                    <select class="form-control select-drop" name="Dt[ku][][psc]">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row" id="bp-gend-1">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Pohlavie') ?></label>
                                                    <select class="form-control select-drop" name="Dt[ku][][pohl]">
                                                        <option>Zvoľte pohlavie</option>
                                                        <option value="1">Muž</option>
                                                        <option value="2">Žena</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 form-group"></div>
                                            </div>
                                            <div class="row" id="bp-dat-1">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Dátum narodenia') ?></label>
                                                    <input type="date" class="form-control" name="Dt[ku][][datnarod]">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Rodné číslo (zadajte bez lomitka)') ?></label>
                                                    <input type="text" class="form-control" name="Dt[ku][][ssn]">
                                                </div>
                                            </div>
                                            <div class="row" id="bp-op1-1">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Číslo OP') ?></label>
                                                    <input type="text" class="form-control" name="Dt[ku][][cisop]">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','OP vydal') ?></label>
                                                    <input type="text" class="form-control" name="Dt[ku][][opvydal]">
                                                </div>
                                            </div>
                                            <div class="row" id="bp-op2-1">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Dátum vydania') ?></label>
                                                    <input type="date" class="form-control" name="Dt[ku][][datvyda]">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Dátum platnosti') ?></label>
                                                    <input type="date" class="form-control" name="Dt[ku][][datplat]">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Podpis') ?></label>
                                                    <div class="wrapper">
                                                            <canvas id="buyer-signature-pad-1" class="signature-pad" width=400 height=200></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade m-l-10 m-r-10 m-b-10 m-t-20" id="splnomocnenec" role="tabpanel" aria-labelledby="splnomocnenec-tab">

                                            <h5 class="card-title"><?= Yii::t('app','Nahrajte OP splnomocnenca') ?></h5>
                                            <div class="row m-t-10">
                                                <div class="col-sm-6">
                                                    <label for="op-predna" class="form-control-label"><?= Yii::t('app','Predná strana') ?></label>
                                                    <input type="file" name="op_predna" id="op-predna" class="form-control">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="op-zadna" class="form-control-label"><?= Yii::t('app','Zadná strana') ?></label>
                                                    <input type="file" name="op_zadna" id="op-zadna" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row m-t-10">
                                                <div class="col-md-12">
                                                    <button type="button" class="btn btn-secondary" id="repr-op"><i class="mdi mdi-upload"></i> <?= Yii::t('app','Nahrať OP') ?></button>
                                                </div>
                                            </div>
                                            <h5 class="card-title m-t-20"><?= Yii::t('app', 'Údaje splnomocnenca' ) ?></h5>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label">Email</label>
                                                    <input type="text" class="form-control" name="Dt[sp][email]">
                                                </div>
                                                <div class="col-md-1 form-group">
                                                    <label class="control-label">Telefón</label>
                                                    <select class="form-control select-drop" name="Dt[sp][predv]">
                                                        <?php
                                                        foreach($predvolby as $item) {
                                                            echo "<option value={$item['predvolba']}>+{$item['predvolba']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-5 form-inline">
                                                    <span style="margin-left:-10px; margin-right: 5px;">(</span>
                                                    <select class="form-control select-drop col-lg-2" name="Dt[sp][uto]">
                                                        <?php
                                                        foreach ($uto as $item) {
                                                            echo "<option value={$item['operator_kod']}>{$item['operator_kod']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <span style="margin-left: 5px; margin-right: 10px;">)</span>
                                                    <input type="text" class="form-control col-lg-9" name="Dt[sp][tel]">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Titul pred menom') ?></label>
                                                    <select class="form-control select-drop" name="Dt[sp][titp]">
                                                        <option value=""><?= Yii::t('app','Zvoľte titul') ?></option>
                                                        <?php
                                                        foreach($titul_pred as $item) {
                                                            echo "<option value='{$item['short_name']}'>{$item['short_name']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Titul za menom') ?></label>
                                                    <select class="form-control select-drop" name="Dt[sp][titza]">
                                                        <option value=""><?= Yii::t('app','Zvoľte titul') ?></option>
                                                        <?php
                                                        foreach($titul_za as $item) {
                                                            echo "<option value='{$item['short_name']}'>{$item['short_name']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Priezvisko') ?></label>
                                                    <input type="text" class="form-control" name="Dt[sp][priezv]">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Meno') ?></label>
                                                    <input type="text" class="form-control" name="Dt[sp][meno]">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Rodné priezvisko') ?></label>
                                                    <input type="text" class="form-control" name="Dt[sp][rodpriezv]">
                                                </div>
                                                <div class="col-md-6 form-group"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <label class="control-label">Adresa</label>
                                                    <input type="text" class="form-control" name="Dt[sp][adresa]">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label">Mesto</label>
                                                    <select class="form-control" name="Dt[sp][mesto]">
                                                    </select>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','PSČ') ?></label>
                                                    <select class="form-control select-drop" name="Dt[sp][psc]">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Pohlavie') ?></label>
                                                    <select class="form-control select-drop" name="Dt[sp][gend]">
                                                        <option>Zvoľte pohlavie</option>
                                                        <option value="1">Muž</option>
                                                        <option value="2">Žena</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Dátum narodenia') ?></label>
                                                    <input type="date" class="form-control" name="Dt[sp][datnarod]">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Rodné číslo (zadajte bez lomitka)') ?></label>
                                                    <input type="text" class="form-control" name="Dt[sp][ssn]">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Číslo OP') ?></label>
                                                    <input type="text" class="form-control" name="Dt[sp][opcis]">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','OP vydal') ?></label>
                                                    <input type="text" class="form-control" name="Dt[sp][opvydal]">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Dátum vydania') ?></label>
                                                    <input type="date" class="form-control" name="Dt[sp][datvyda]">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Dátum platnosti') ?></label>
                                                    <input type="date" class="form-control" name="Dt[sp][datplat]">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <label class="control-label"><?= Yii::t('app','Podpis') ?></label>
                                                    <div>
                                                        <div class="wrapper">
                                                            <canvas id="representative-signature-pad" class="signature-pad" width=400 height=200></canvas>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade m-l-10 m-r-10 m-b-10 m-t-20" id="dodavatelia" role="tabpanel" aria-labelledby="dodavatelia-tab">
                                            <table class="w-100 m-t-20">
                                                <tr class="col-md-12 form-group">
                                                    <td width="45%">Dodávateľ vody</td>
                                                    <td>
                                                        <select class="form-control dropdown" name="Dt[dod][voda]">
                                                            <option value="0">Vyberte dodávateľa</option>
                                                            <?php
                                                            foreach($dodavatel_vody as $item) {
                                                                echo "<option value={$item['id']}>{$item['name']}</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr class="col-md-12 form-group">
                                                    <td width="45%">Dodávateľ elektrickej energie</td>
                                                    <td>
                                                        <select class="form-control dropdown" name="Dt[dod][elek]">
                                                            <option value="0">Vyberte dodávateľa</option>
                                                            <?php
                                                            foreach($dodavatel_elektriny as $item) {
                                                                echo "<option value={$item['id']}>{$item['name']}</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr class="col-md-12 form-group">
                                                    <td width="45%">Dodávateľ plynu</td>
                                                    <td>
                                                        <select class="form-control dropdown" name="Dt[dod][plyn]">
                                                            <option value="0">Vyberte dodávateľa</option>
                                                            <?php
                                                            foreach($dodavatel_plynu as $item) {
                                                                echo "<option value={$item['id']}>{$item['name']}</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr class="col-md-12 form-group">
                                                    <td width="45%">Osoba uskutočňujúca odvoz a likvidáciu odpadu</td>
                                                    <td>
                                                        <select class="form-control dropdown" name="Dt[dod][olo]">
                                                            <option value="0">Vyberte dodávateľa</option>
                                                            <?php
                                                            foreach($olo as $item) {
                                                                echo "<option value={$item['id']}>{$item['name']}</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr class="col-md-12 form-group">
                                                    <td width="45%">Poskytovateľ káblového televízneho pripojenia</td>
                                                    <td>
                                                        <select class="form-control dropdown" name="Dt[dod][tvnet]">
                                                            <option value="0">Vyberte dodávateľa</option>
                                                            <?php
                                                            foreach($dodavatel_tv as $item) {
                                                                echo "<option value={$item['id']}>{$item['name']}</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr class="col-md-12 form-group">
                                                    <td width="45%">Poskytovateľ telefonického pripojenia</td>
                                                    <td>
                                                        <select class="form-control dropdown" name="Dt[dod][tel]">
                                                            <option value="0">Vyberte dodávateľa</option>
                                                            <?php
                                                            foreach($dodavatel_telefon as $item) {
                                                                echo "<option value={$item['id']}>{$item['name']}</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade m-l-10 m-r-10 m-b-10 m-t-20" id="financovanie" role="tabpanel" aria-labelledby="financovanie-tab">
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <label class="form-control-label"><?= Yii::t('app','Financovanie') ?></label>
                                                    <select class="form-control dropdown">
                                                        <option value=""><?= Yii::t('app','Vyberte typ financovania') ?></option>
                                                        <option value="hypo"><?= Yii::t('app','Hypotéka') ?></option>
                                                        <option value="cash"><?= Yii::t('app', 'Vlastné zdroje - hotovosť') ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <label for="" class="form-control-label"><?= Yii::t('app','Celková cena') ?></label>
                                                    <input type="text" name="" id="" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <label for="" class="form-control-label">
                                                        <?= Yii::t('app','Celková cena pozostáva z ') ?>
                                                    </label>
                                                    <select class="form-control dropdown">
                                                        <?php
                                                            for($i=1; $i <= 10; $i++) {
                                                                echo "<option value='{$i}'>{$i}</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade m-l-10 m-r-10 m-b-10 m-t-20" id="podpisy" role="tabpanel" aria-labelledby="podpisy-tab">
                                        </div>

                                    </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= Yii::t('app','Zrušiť') ?></button>
                                    <button type="button" class="btn btn-primary" id="save-other-data"><?= Yii::t('app','Uložiť') ?></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bs-example-modal-lg" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commentModalLabel"><?= Yii::t('app','Komentár') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <textarea cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= Yii::t('app','Zrušiť') ?></button>
                <button type="button" class="btn btn-primary" id="save-other-data"><?= Yii::t('app','Uložiť') ?></button>
            </div>
        </div>
    </div>
</div>


<?php
$js = <<< JS

    var sellerPads = new Array(); 
    $.each($('.seller-pad'),function(){
       sellerPads.push($(this)); 
    });
    
    resizeCanvas = function() {
        var ratio =  Math.max(window.devicePixelRatio || 1, 1);
        $.each(sellerPads,function(k,v){
            $(v).width = $(v).offsetWidth * ratio;
            $(v).height = $(v).offsetHeight * ratio;
            $(v).getContext("2d").scale(ratio,ratio);
        });
    }
    
    window.onresize = resizeCanvas;
    resizeCanvas();

    var gdoc = 0;
    $(".doc-gen").on('change',function(){
       if ($(this).is(':checked')) {
           gdoc += 1;
       } else {
           gdoc = gdoc == 0 ? 0 : gdoc-1;
       }
       if (gdoc > 0) {
           $('#gendoc').removeClass('disabled');
       } else {
           $('#gendoc').addClass('disabled');
       }
    });
   
    $('#gendoc').on('click',function(){
        var dokumenty = [];
        $(".doc-gen").each(function(){
            if( $(this).is(':checked')) {
                var code = $(this).data('id');
                var datum = "#" + code + "-datum-" + $(this).data("poradie");
                var podpis = "#" + code + "-podpis-" + $(this).data("poradie");
                var podpisData = $(podpis).val() == undefined ? "" : $(podpis).val();
                var ostatneData = window.sessionStorage.getItem('odata');
                var officeId = $('#doc-company-id').val();
                dokumenty.push({
                        "doc":code, 
                        "poradie":$(this).data("poradie"), 
                        "datum":$(datum).val(), 
                        "podpis":podpisData,
                        "ostatne":ostatneData,
                        "firma":officeId
                    });
            }
        });
        // make from array a JSON string
       dokumenty = JSON.stringify(dokumenty);
       $.ajax({
            url: "/backoffice/contracts/ajax-gen-docs",
            dataType: "json",
            data: {docs: dokumenty, num: '$contract->cislo'},
            type: "post"
        }).done(function(data){
            $.each(data.result,function(id,val){
                var len = val.length;
                if (len == 1) {
                    $("#url-"+id+"-1").attr("href",val[0]).show();
                } else {
                    $.each(val,function(k,v){
                        $("#url-"+id+"-"+(k+1)).attr("href",v).show();
                    });
                }
            });
        });
    });
    
JS;
$this->registerJS($js);
