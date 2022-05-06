<?php
use backend\assets\RealAsset;
use yii\helpers\Url;

/** @var array $offices **/

$this->title=Yii::t('app','Faktúry');


$this->registerJSFile('@web/assets/node_modules/datatables/datatables.min.js',['depends'=>RealAsset::class]);
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
                <a href="#" class="btn btn-success d-none d-lg-block m-l-15 text-white">
                    <i class="fas fa-plus-circle"></i>&nbsp;<?php echo Yii::t('app','Pridať PFA') ?>
                </a>
                <a class="btn btn-info d-none d-lg-block m-l-15 text-white" href="<?= Url::to(['/accounting/add-invoice']) ?>">
                    <i class="fas fa-plus-circle"></i>&nbsp;<?= Yii::t('app','Pridať VFA'); ?>
                </a>
            <a href="/backoffice/accounting/invoice-export" class="btn btn-success px-2">Export</a>
            </div>
        </div>
    </div>


    <?php
    foreach($offices as $office){
        echo $this->render('invoice-company',[
           'office'         =>  $office
        ]);
    }
    ?>
</div>
<?php
$csrf = "'" . Yii::$app->request->csrfParam ."':'". Yii::$app->request->getCsrfToken() ."'";
$js = <<<JS
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

$css = <<<CSS
    .rounded-5 {
        border-radius: .5em!important;
    }
    .card-shadow {
        box-shadow: lightgrey 3px 3px;
    }
CSS;
$this->registerCSS($css);
