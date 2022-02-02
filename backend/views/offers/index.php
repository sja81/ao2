<?php

use yii\helpers\Url;
use backend\assets\RealAsset;
//use common\models\posta\slovensko\eph\xmlgenerator\EphInfo;
//use common\models\posta\slovensko\eph\xmlgenerator\EphShipment;

$this->title = Yii::t('app', 'Garáže');
$this->registerJSFile('@web/assets/node_modules/datatables/datatables.min.js', ['depends' => RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/datatables/media/css/dataTables.bootstrap4.css', ['depends' => RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js', ['depends' => RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css', ['depends' => RealAsset::class]);

?>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-10 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
        <div class="col-md-2 align-self-center text-right">
            <a class="btn btn-info d-none d-lg-block m-l-15 text-white" href="<?= Url::to(['/offers/import']) ?>">
                <i class="mdi mdi-cloud-upload m-r-5"></i>&nbsp;<?= Yii::t('app', 'Import dát'); ?>
            </a>
        </div>
    </div>

    <?= \common\widgets\AoAlerts::widget() ?>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <?php
                    //TODO: meg ellenorzeseket ide rakni
                    ?>
                    <form method="post" action="<?= Url::to(['generate-list'])?>">
                        <input type="hidden" name="Data[eph]" id="hidden-eph">
                        <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken() ?>">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label"><?= Yii::t('app','Odosielateľ'); ?></label>
                                    <select class="form-control form-select" id="SelectSender" name="Data[raw_data]">
                                        <option value=""><?= Yii::t('app','Zvoľte si odosielateľa'); ?></option>
                                        <?php
                                        foreach ($senders as $sender) {
                                        ?>
                                            <option value='<?= json_encode($sender) ?>'><?= $sender['name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                            $langs = ['HU', 'SK'];
                            foreach ($langs as $lang) {
                            ?>
                                <div class="col-md-4">
                                    <h4 class="card-title mb-2"><?= Yii::t('app', "Dáta pre {$lang} email"); ?></h4>
                                    <div class="form-group">
                                        <label class="form-label mt-2"><?= Yii::t('app', 'Telefón odosielateľa'); ?></label>
                                        <input type="text" name="Data[buyer_phone][<?= $lang ?>]" class="form-control buyer_phone">
                                        <label class="form-label mt-2"><?= Yii::t('app', 'Email odosielateľa'); ?></label>
                                        <input type="text" name="Data[buyer_email][<?= $lang ?>]" class="form-control buyer_email">
                                        <label class="form-label mt-2"><?= Yii::t('app', 'Meno odosielateľa'); ?></label>
                                        <input type="text" name="Data[buyer_name][<?= $lang ?>]" class="form-control buyer_name">
                                        <label class="form-label mt-2"><?= Yii::t('app', 'Miesto podpisu'); ?></label>
                                        <input type="text" name="Data[miesto_podpisu][<?= $lang ?>]" class="form-control miesto_podpisu">
                                        <label class="form-label mt-2"><?= Yii::t('app', 'Dátum podpisu'); ?></label>
                                        <input type="date" name="Data[datum_podpisu][<?= $lang ?>]" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <h5 class="card-title"><?= Yii::t('app', 'Príjemcovia'); ?></h5>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="Data[recips]" id="data_recips">
                                <span class="text-muted font-12"><?= Yii::t('app','Pr. 1-10,15,16,23-27'); ?></span>
                            </div>
                        </div>
                        <button class="btn btn-info text-white mt-3" type="submit"><?= Yii::t('app','Generovať'); ?></button>
                        <button class="btn btn-danger text-white mt-3" id="reset-form" type="button"><?= Yii::t('app','Reset'); ?></button>
                        <a class="btn btn-secondary mt-3" href="<?= Url::to(['gen-eph']) ?>"><?= Yii::t('app','Vygenerovať EPH'); ?></a>
                    </form>
                    <div class="table-responsive m-t-20">
                        <table class="table table-bordered table-striped table-sm dattable">
                            <thead>
                            <tr>
                                <th><?= Yii::t('app','Por. č.'); ?></th>
                                <th></th>
                                <th><?= Yii::t('app','Majiteľ'); ?></th>
                                <th><?= Yii::t('app','Dát. narod.'); ?></th>
                                <th><?= Yii::t('app','Ulica'); ?></th>
                                <th><?= Yii::t('app','Mesto'); ?></th>
                                <th><?= Yii::t('app','Spoluvl. pod.'); ?></th>
                                <th><?= Yii::t('app','Titul nadobud.'); ?></th>
                                <th><?= Yii::t('app','Ťarchy'); ?></th>
                                <th><?= Yii::t('app','Súp.č.'); ?></th>
                                <th><?= Yii::t('app','Č.parcely') ?></th>
                                <th><?= Yii::t('app','LV') ?></th>
                                <th><?= Yii::t('app','Miesto') ?></th>
                                <th><?= Yii::t('app','Akcie'); ?></th>
                            </tr>
                            </thead>
                            <tbody class="font-12">
                            <?php
                            foreach($offers as $offer) {
                                ?>
                                <tr>
                                    <td>
                                        <?= $offer['orderNumber'] ?>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="onum" data-onumber="<?= $offer['orderNumber'] ?>">
                                    </td>
                                    <td>
                                        <?php

                                        if ($offer['informed'] == 1) {
                                        ?>
                                            <td>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                                </svg>
                                            </td>
                                        <?php
                                        }

                                        ?>
                                        <?php
                                        if ($offer['informed'] == 0) {
                                        ?>
                                            <td>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                </svg>
                                            </td>
                                        <?php
                                        }
                                        ?>
                                        <td><?= $offer['birthDate'] ?></td>
                                        <td><?= $offer['ownerAddress'] ?></td>
                                        <td><?= $offer['ownerTown'] ?></td>
                                        <td><?= $offer['coOwnership'] ?></td>
                                        <td><?= $offer['acquisitionTitle'] ?></td>
                                        <td><?= $offer['encumbrance'] ?></td>
                                        <td><?= $offer['registerNumber'] ?></td>
                                        <td><?= $offer['parcelNumber'] ?></td>
                                        <td><?= $offer['ownershipDocumentNumber'] ?></td>
                                        <td><?= $offer['propertyAddress'] ?></td>
                                        <td>
                                            <a href="<?= Url::to(['edit', 'on' => $offer['orderNumber']]) ?>" title="<?= Yii::t('app', 'Upraviť'); ?>" style="color: black"><i class="fas fa-pencil-alt"></i></a>
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
        </div>
    </div>
</div>

<?php

$js = <<<JS
    var lis = new Array();

    $('.onum').click(function(){
        let d = $(this).data('onumber');
        if ($(this).is(':checked')) {
            lis.push(d);
        } else {
            if (lis.includes(d)) {
                lis.splice(lis.indexOf(d),1);
            }
        }
        
        $('#data_recips').empty().val(lis.join(','));
    });
    
    $('#SelectSender').change(function(){
        let s = $(this).val();
        if (s != '') {
            let x= JSON.parse($(this).val());
            $('.buyer_phone').val(x.phone);
            $('.miesto_podpisu').val(x.town);
            $('.buyer_email').val(x.email);
            console.log(x.SenderType);
            $('.buyer_name').val(x.SenderType=='private' ? x.name : x.contact_person);
        } else {
            $('.buyer_phone').val('');
            $('.miesto_podpisu').val('');
            $('.buyer_email').val('');
            $('.buyer_name').val('');
        }
        
         
        
    });
    
    $(function() {
        $('.dattable').DataTable({
            order: [],
            responsive: true
        });
    });
    
    
JS;
$this->registerJS($js);

