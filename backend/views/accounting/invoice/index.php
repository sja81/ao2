<?php
use backend\assets\RealAsset;
use yii\helpers\Url;
use backend\helpers\HelpersNum;
use yii\helpers\Html;


$this->title="Účtovníctvo - Faktúry";

$this->registerJSFile('@web/assets/node_modules/datatables/datatables.min.js',['depends'=>RealAsset::class]);
$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css',['depends'=>RealAsset::class]);
$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css',['depends'=>RealAsset::class]);
$this->registerJSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.full.min.js',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/datatables/media/css/dataTables.bootstrap4.css',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/switchery/dist/switchery.min.js', ['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/switchery/dist/switchery.min.css',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/toast-master/js/jquery.toast.js',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/toast-master/css/jquery.toast.css',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/js/issue.js?v=0.1',['depends'=>RealAsset::class]);
?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-8 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
        <div class="col-md-4 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <a class="btn btn-info d-none d-lg-block" href="/backoffice/accounting/add-invoice">
                    <i class="fas fa-plus-circle"></i>&nbsp;Pridať
                </a>
            </div>
        </div>
    </div>

    <?php
    foreach($offices as $office):
    ?>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <?= $office['name'] ?>
            </h4>


            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm dattable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Číslo</th>
                        <th>Typ</th>
                        <th>Odberateľ</th>
                        <th>K úhrade</th>
                        <th>Záloha</th>
                        <th>Vystavené</th>
                        <th>Splatnosť</th>
                        <th>Status</th>
                        <th>Akcie</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($office['invoices'] as $invoice):?>
                    <tr>
                        <td><?= $invoice['id'] ?></td>
                        <td><?= $invoice['znak']?><?= $invoice['rok']?><?= $invoice['mesiac']?><?= $invoice['cislo']?></td>
                        <td>
                            <?php
                            switch($invoice['typ_faktury']){
                                case 0:
                                    echo Yii::t('app','faktúra');
                                    break;
                                case 1:
                                    echo Yii::t('app','zálohová faktúra');
                                    break;
                                default:
                                    echo Yii::t('app','neznáme');
                            }
                            ?>
                        </td>
                        <td><?php
                            if ($invoice['odberatel'] != '') {
                                echo $invoice['odberatel'];
                            } else {
                                echo $invoice['kontaktna_osoba'];
                            }
                            ?></td>
                        <td style="text-align: right">
                            <?= HelpersNum::moneyFormat($invoice['k_uhrade']) ?>
                        </td>
                        <td style="text-align: right">
                            <?= HelpersNum::moneyFormat($invoice['zaloha']) ?>
                        </td>
                        <td style="text-align: right">
                            <?= $invoice['datum_vystavenia'] ?>
                        </td>
                        <td style="text-align: right">
                            <?= $invoice['splatnost'] ?>
                        </td>
                        <td>
                            <input
                                    type="checkbox"
                                    class="js-switch"
                                    data-color="#26c6da"
                                    data-secondary-color="#f62d51"
                                    data-invoice="<?= $invoice['id'] ?>"
                                    <?= $invoice['status'] == 2 ? ' checked' : '' ?>
                            >
                        </td>
                        <td>
                            <?php
                            $invoiceCode = [
                                0 => 'FAK',
                                1 => 'ZAL',
                                2 => 'DOB',
                            ];

                            if ($invoice['typ_faktury'] == 1) {
                                ?>
                                <a
                                        href="<?= Url::to(['accounting/make-invoice','id'=>$invoice['id']]) ?>"
                                        style="color: black; margin-right: 5px;"
                                        title="<?= Yii::t('app','Vytvoriť faktúru') ?>"
                                >
                                    <i class="fas fa-file-medical"></i>
                                </a>
                                <?php
                            }
                            ?>
                            <a
                                    href="<?= Url::to(['accounting/print','t'=>$invoiceCode[$invoice['typ_faktury']],'id'=>$invoice['id']]) ?>"
                                    title="Print"
                                    style="color: black;margin-right: 5px;"
                            >
                                <i class="fas fa-print"></i>
                            </a>
                            <a href="<?= Url::to(['accounting/edit-invoice','id'=>$invoice['id']]) ?>" title="Edit" style="color: black"><i class="fas fa-pencil-alt"></i></a>
                        </td>
                    </tr>
                    <?php
                    endforeach;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        <?php
            endforeach;
        ?>

</div>
<?php
$csrf = "'" . Yii::$app->request->csrfParam ."':'". Yii::$app->request->getCsrfToken() ."'";
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
    
    $(function() {
        $('.dattable').DataTable({
            order: []
        });
    });
    
    $('.js-switch').each(function () {
        new Switchery($(this)[0], $(this).data());
    });
    $('.js-switch').change(function(){
        let c = $(this).is(':checked') ? 1 : 0;
        let i = $(this).data('invoice');
        $.ajax({
           url: "/backoffice/accounting/ajax-update-status",
           dataType: "json",
           data: { invoice: i, istatus: c , {$csrf} },
           type: "post"
       })
       .done(function(res){
          if (res.status == 'error') {
             console.log(res.message);
          } else {
             showMyToast(res, 'Stav faktúry bol úspešne zmenený!'); 
          }
       });
    });
JS;

$this->registerJS($js);