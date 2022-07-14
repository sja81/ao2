<?php
use backend\assets\RealAsset;
use yii\helpers\Url;

$this->title= Yii::t('app','Dokumenty');

$this->registerCSSFile('@web/assets/node_modules/toast-master/css/jquery.toast.css',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/dist/css/pages/other-pages.css',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/datatables/datatables.min.js',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/datatables/media/css/dataTables.bootstrap4.css',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/dist/css/pages/tab-page.css',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/toast-master/js/jquery.toast.js',['depends'=>RealAsset::class]);

$confirmRemoval = Yii::t('app','Naozaj chcete zmazať?');

?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-10 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>

    <div class="row">
        <div class="card rounded-5 card-shadow w-100">
            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12" style="overflow: auto">
                                        <form method="post" role="form" id="priv-form">
                                            <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">
                                            <table class="table table-sm table-striped">
                                                <thead>
                                                <tr>
                                                    <th><?= Yii::t('app','Funkcia') ?></th>
                                                        <?php foreach($groups as $group) {
                                                           ?>
                                                           <th>
                                                                <?= $group['name']; }?> 
                                                           </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                        <?php foreach($templates as $template){ 
                                                            if(empty($template['name'])){
                                                                continue;
                                                            }
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                 <?= $template['name']?> 
                                                            </td>

                                                        <?php
                                                            foreach($groups as $group) {
                                                            $checked = "";
                                                            if (in_array($template['id'], $privileges[$group['name']])) {
                                                                $checked = " checked";
                                                            }
                                                        ?>
                                                        <td>
                                                                <input
                                                                        type="checkbox"
                                                                        data-template="<?= $template['id']?>"
                                                                        data-group="<?= $group['name'] ?>"
                                                                        class="template"
                                                                        <?= $checked ?>
                                                                >
                                                            </td>
                                                                <?php
                                                            }
                                                            echo "</tr>";
                                                        }
                                                                ?>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

<?php

$js = <<<JS
    $(".template").on('click', function(){
        var g = $(this).data('group'),
            t = $(this).data('template'),
            c = $(this).is(':checked')?1:0;
        $.ajax({
                url: '/backoffice/template/change-privilege',
                dataType: 'json',
                method: 'post',
                data: {
                   group: g,
                   template: t,
                   status: c
                },
                success: function(r){
                    var msg = r.message, 
                        icon = '';
                    if (r.status == 'ok') {
                        icon = 'success';
                    }
                    if (r.status == 'error') {
                        icon = 'error';
                    }
                    $.toast({
                        //heading: 'Welcome to Material Pro admin',
                        text: msg,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: icon,
                        hideAfter: 2500, 
                        stack: 6
                    });
                }
            });
    });
JS;

$this->registerJS($js);

$css = <<<CSS
    .vtabs {
    width: 100%;
    }
    .tabs-vertical {
        width: 150px !important;
    }
    .rounded-5 {
        border-radius: .5em!important;
    }
    .card-shadow {
        box-shadow: lightgrey 3px 3px;
    }
CSS;
$this->registerCSS($css);
