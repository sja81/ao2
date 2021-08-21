<?php
use backend\assets\RealAsset;
use yii\helpers\Url;

$this->title="Nová zákazka";

$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css',['depends'=>RealAsset::className()]);
$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css',['depends'=>RealAsset::className()]);
$this->registerJSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.full.min.js',['depends'=>RealAsset::className()]);
$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.1/jquery-confirm.min.css',['depends'=>RealAsset::className()]);
$this->registerJSFile('https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.1/jquery-confirm.min.js',['depends'=>RealAsset::className()]);
$this->registerJSFile('@web/js/common.js',['depends'=>RealAsset::className()]);
$this->registerJSFile('@web/js/aoreal-storage.js?v=0.1',['depends'=>RealAsset::className()]);

$this->registerJSFile('@web/assets/fine-uploader/fine-uploader.min.js',['depends'=>RealAsset::className()]);
$this->registerCSSFile('@web/assets/fine-uploader/fine-uploader.min.css',['depends'=>RealAsset::className()]);
$this->registerCSSFile('@web/assets/fine-uploader/fine-uploader-gallery.min.css',['depends'=>RealAsset::className()]);
$this->registerCSSFile('@web/assets/fine-uploader/fine-uploader-new.min.css',['depends'=>RealAsset::className()]);


?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title?></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <form action="<?=Url::to(['contracts/save-room'])?>" method="post">
                <input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
                <input type="hidden" name="Data[zmluva_id]" value="<?=$_GET['id']?>">

                <?php
                for($i=1; $i<= $basic_info->pocet_miestnosti; $i++) {
                    echo $this->render('room-item',[
                        'i'             => $i,
                        'podlaha'       => $podlaha,
                        'kurenie'       => $kurenie,
                        'okno'          => $okno,
                        'basic_info'    => $basic_info,
                        'nazov_izieb'   => $nazov_izieb,
                        'nabytok'       => $nabytok,
                        'stena'         => $stena,
                        'osvetlenie'    => $osvetlenie,
                        'povrch_steny'  => $povrch_steny
                    ]);
                }
                ?>

                <div class="card">
                    <div class="form-actions">
                        <div class="card-body">
                            <button type="button" class="btn btn-info" onclick="returnBack('form-rooms','<?= Url::to(['/contracts/new-property','id'=>$_GET['id']])?>')"><i class="fa fa-arrow-circle-left"></i> Späť</button>
                            <button type="submit" class="btn btn-success"> <i class="fa fa-arrow-circle-right"></i>&nbsp;Pokračovať</button>
                            <button type="button" class="btn btn-dark" onclick="redirectTo('<?= Url::to(['/contracts'])?>')" ><i class="fa fa-times-circle"></i>&nbsp;Zrušiť</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$js = <<< JS
    
    $(document).ready(function(){
        restoreFormData('form-rooms');  
    });
    
    remove_color = function(ix, poc){
        $('#item-' + ix + '-' + poc).remove();
        return false;
    }
    
    add_color = function(i) 
    {
        var poc = $('#col-'+i+' div.color-pal').length + 1;
        var color_field = "<div class='form-row color-pal mt-3' id='item-" + i +"-" + poc +"'>"+
            "<div class='col'><input type='color' class='form-control' name='Data[izba][" + i +"][stena_farba][]'></div><div class='col'>"+
            "<button class='btn btn-danger' onclick='return remove_color("+ i +"," + poc +");' id='btn-minus'><i class='fas fa-minus'></i></button></div></div>";
        $('#col-' + i).append(color_field);
        return false;
    }

    redirectTo = function(url)
    {
        $.confirm({
            title: 'Skončiť',
            content: 'Naozaj chcete skončiť?',
            buttons: {
                ano: function () {
                    window.location.replace(url);
                },
                nie: function () {
                }
            }
        });
    }
JS;

$this->registerJS($js);

$css = <<< CSS
    .upload-trigger {
        color: white;
        background-color: #00ABC7;
        font-size: 14px;
        padding: 7px 20px;
        background-image: none;
    }

    .fine-uploader-manual-trigger .qq-upload-button {
        margin-right: 15px;
    }

    .fine-uploader-manual-trigger .buttons {
        width: 36%;
    }

    .fine-uploader-manual-trigger .qq-uploader .qq-total-progress-bar-container {
        width: 60%;
    }

    a.upload-reset {
        color: white !important;
        font-weight: 500;
        
    }
CSS;

$this->registerCSS($css);



?>