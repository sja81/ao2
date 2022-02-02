<?php
use backend\assets\RealAsset;

$this->title = $pageTitle;

$this->registerCSSFile('@web/assets/node_modules/toast-master/css/jquery.toast.css', ['depends' => RealAsset::class]);
$this->registerCSSFile('@web/assets/dist/css/pages/other-pages.css', ['depends' => RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/datatables/datatables.min.js', ['depends' => RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/datatables/media/css/dataTables.bootstrap4.css', ['depends' => RealAsset::class]);
?>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card rounded-5 card-shadow">
                <div class="card-body">
                    <form method="post">
                        <input type="hidden" id="userId" value="<?= $userId ?>">
                        <button type="button" class="btn btn-success text-white" id="prichod">Prichod</button>
                        <button type="button" class="btn btn-danger text-white" id="odchod">Odchod</button>
                        <!--<button type="button" class="btn btn-primary" id="prestavka">Prestavka</button>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Prerusenie</option>
                            <option value="1">Navsteva lekara</option>
                            <option value="2">Pracovna cesta</option>
                            <option value="3">Dovolenka</option>
                        </select>-->
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card rounded-5 card-shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm dattable" id="att-01">
                                    <thead>
                                    <tr>
                                        <th><?= Yii::t('app', 'Meno a priezvisko'); ?></th>
                                        <th><?= Yii::t('app', 'Čas'); ?></th>
                                        <th><?= Yii::t('app', 'Status'); ?></th>
                                        <th>Akcia</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    echo $this->render('tablebody',[
                                            'rows'  =>  $attendance
                                    ]);
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

<?php
$csrf = "'" . Yii::$app->request->csrfParam . "':'" . Yii::$app->request->getCsrfToken() . "'";
$js = <<<JS
$(function() { $('.dattable').DataTable({ order: [] }); });

$('#prichod').click(function(){
    $.ajax({
                url: "/backoffice/user-attendance/arrival",
                dataType: "json",
                data: { 
                    userId:$('#userId').val(),
                    {$csrf} 
                },
                type: "POST"
        }).done(function(res){
            if (res.status == 'error') {
                    console.log(res.message);
                } else {    
                    $('#att-01 tbody').empty().append(res.rows);
                }
        });
});

$('#odchod').click(function(){
    $.ajax({
                url: "/backoffice/user-attendance/departure",
                dataType: "json",
                data: { 
                    userId:$('#userId').val(),
                    {$csrf} 
                },
                type: "POST"
        }).done(function(res){
            if (res.status == 'error') {
                    console.log(res.message);
                } else {    
                    $('#att-01 tbody').empty().append(res.rows);
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
