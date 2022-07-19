<?php
use backend\assets\RealAsset;
use yii\helpers\Url;
use common\models\users\UserAttendance;

/**
 * @var $title
 * @var $item
 */
$this->title = $title;

$this->registerCSSFile('@web/assets/node_modules/Magnific-Popup-master/dist/magnific-popup.css', ['depends' => RealAsset::class]);
$this->registerCSSFile('@web/css/user-card.css', ['depends' => RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup.min.js', ['depends' => RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup-init.js', ['depends' => RealAsset::class]);
?>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-12 m-b-15">
            <a href="<?= Url::to(['index']) ?>" class="btn btn-danger text-white">
                <i class="fas fa-arrow-alt-circle-left"></i> <?= Yii::t('app','Späť') ?>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><?= $item['meno'] ?></h4>
                    <h6 class="card-subtitle">(<?= $item['user_group'] ?>)</h6>
                    <form method="post" role="form" class="form p-t-20">
                        <input type="hidden" id="uaid" value="<?= $item['id'] ?>">
                        <div class="form-group row">
                            <label class="form-label text-end col-sm-3"><?= Yii::t('app','Dátum'); ?></label>
                            <div class="col-sm-9">
                                <input type="date" id="uadate" class="form-control" value="<?= $item['uaDate'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="form-label text-end col-sm-3"><?= Yii::t('app','Príchod'); ?></label>
                            <div class="col-sm-4">
                                <input type="time" id="intime" class="form-control" value="<?= $item['inTime'] ?>">
                            </div>
                            <label class="form-label text-end col-sm-1"><?= Yii::t('app','IP'); ?></label>
                            <div class="col-sm-4">
                                <input type="text" id="inip" class="form-control" value="<?= $item['inIP'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="form-label text-end col-sm-3"><?= Yii::t('app','Odchod'); ?></label>
                            <div class="col-sm-4">
                                <input type="time" id="outtime" class="form-control" value="<?= $item['outTime'] ?>">
                            </div>
                            <label class="form-label text-end col-sm-1"><?= Yii::t('app','IP'); ?></label>
                            <div class="col-sm-4">
                                <input type="text" id="outip" class="form-control" value="<?= $item['outIP'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="form-label text-end col-sm-3"><?= Yii::t('app','Odpracované'); ?></label>
                            <div class="col-sm-4">
                                <input type="text" id="difftime" class="form-control" value="<?= $item['diffTime'] ?>">
                            </div>
                            <div class="col-sm-5"></div>
                        </div>
                        <div class="form-group row">
                            <label class="form-label text-end col-sm-3">
                                <?= Yii::t('app','Typ'); ?>
                            </label>
                            <div class="col-sm-9">
                                <select class="form-control form-select" id="uatype">
                                    <option value=""><?= Yii::t('app','Zvoľte typ dochádzky'); ?></option>
                                    <?php
                                   for($i=0; $i<5; $i++) {
                                       $selected = ((int)$item['uaType'] === ($i+1)) ? ' selected': '';
                                       echo "<option value='{".($i+1)."}'{$selected}>".UserAttendance::workType($i+1)."</option>";
                                   }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="form-label text-end col-sm-3"><?= Yii::t('app','Poznámky'); ?></label>
                            <div class="col-sm-9">
                                <textarea id="uanote" cols="30" rows="10" class="form-control"><?= $item['note'] ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <button class="btn btn-success text-white" type="button" id="svatt">
                                    <?= Yii::t('app','Uložiť'); ?>
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><?= Yii::t('app','Fotky'); ?></h4>

                    <div class="row el-element-overlay m-t-25">

                        <?php
                        /**
                         * @var array $files
                         */
                        if (0 === count($files)) {
                            echo 'No files in this day';
                        } else {
                            foreach($files as $file) {
                                echo $this->render('userfiles',['fileinfo'=>$file]);
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<?php
$csrf = "'" . Yii::$app->request->csrfParam ."':'". Yii::$app->request->getCsrfToken() ."'";

$js = <<<JS
removeImage = function() {
    console.log(12);
}

updateDiffTime = function() {
    
}

$('#intime').change(function(){
   updateDiffTime();
});

$('#outtime').change(function(){
   updateDiffTime(); 
});

$('#svatt').click(()=>{
    $.ajax({
            url: "/backoffice/user-attendance-admin/update-attendance",
            dataType: "json",
            data: { 
                uid: $('#uaid').val(), 
                uadate: $('#uadate').val(),
                uatype: $('#uatype').val(),
                intime: $('#intime').val(),
                inip: $('#inip').val(),
                outtime: $('#outtime').val(),
                outip: $('#outip').val(),
                uanote: $('#uanote').val(),
                {$csrf} 
            },
            type: "post"
        })
        .done(function(res){
            if (res.status == 'error') {
                alert(res.message);
            } 
            else {
                alert('Saved...');
            }
        });
});
JS;
$this->registerJS($js);
