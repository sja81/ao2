<?php

use backend\assets\RealAsset;
use common\models\PrivilegesTemplates;

$this->title = Yii::t('app', 'Dokumenty');

    $this->registerCSSFile('@web/assets/node_modules/toast-master/css/jquery.toast.css', ['depends' => RealAsset::class]);
    $this->registerCSSFile('@web/assets/dist/css/pages/other-pages.css', ['depends' => RealAsset::class]);
    $this->registerJSFile('@web/assets/node_modules/datatables/datatables.min.js', ['depends' => RealAsset::class]);
    $this->registerCSSFile('@web/assets/node_modules/datatables/media/css/dataTables.bootstrap4.css', ['depends' =>     RealAsset::class]);
    $this->registerCSSFile('@web/assets/dist/css/pages/tab-page.css', ['depends' => RealAsset::class]);
    $this->registerJSFile('@web/assets/node_modules/toast-master/js/jquery.toast.js', ['depends' => RealAsset::class]);

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
                        <select id="functions" class="form-control dropdown w-25 mb-2" aria-label="Default select example">
                            <option value="null"> Zvolte typ dochádzky</option>
                            <?php foreach ($userFunctions as $i => $function) {
                            ?>
                                <option value="<?= $i ?>" data-function="<?= PrivilegesTemplates::userFunctionText($i) ?>">
                                    <?= PrivilegesTemplates::userFunctionText($i) ?>
                                </option>
                            <?php } ?>
                        </select>
                        <form method="post" role="form" id="priv-form">
                            <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">
                            <table class="table table-sm table-striped" id="ip01">
                                <thead>
                                    <tr>
                                        <th><?= Yii::t('app', 'Funkcia') ?></th>
                                        <?php foreach ($groups as $group) {
                                        ?>
                                            <th>
                                            <?= $group['name'];
                                        } ?>
                                            </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    echo $this->render('tbody', [
                                        'groups'  =>  $groups,
                                        'templates' => $templates,
                                        'privileges' => $privileges
                                    ]);
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

<?php

$js = <<<JS
    $('#functions').on('change', function() {
        var selectedOption = $(this).find(":selected").val();
        $.ajax({
            url: "/backoffice/template/user-func",
            dataType: "json",
            data: { 
                data: selectedOption
                },
            type: "post"
        })
        .done(function(res){
            if (res.status == 'error') {
                alert(res.message);
            } 
            else {
                $('#ip01').find('tbody').empty().append(res.tbody);
            }
        });
    });
    $(".template").on('click', function(){
        var g = $(this).data('group'),
            t = $(this).data('template'),
            c = $(this).is(':checked') ? 1 : 0,
            f = $('#functions option:selected').val();
            console.log(f);
        $.ajax({
                url: '/backoffice/template/change-privilege',
                dataType: 'json',
                method: 'post',
                data: {
                   group: g,
                   template: t,
                   function: f,
                   status: c,
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
    .rounded-5 {
        border-radius: .5em!important;
    }
    .card-shadow {
        box-shadow: lightgrey 3px 3px;
    }
CSS;
$this->registerCSS($css);
