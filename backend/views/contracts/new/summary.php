<?php
use yii\helpers\Url;
use backend\assets\RealAsset;

$this->title="Nová zákazka";

$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.1/jquery-confirm.min.css',['depends'=>RealAsset::className()]);
$this->registerJSFile('https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.1/jquery-confirm.min.js',['depends'=>RealAsset::className()]);

$this->registerCSSFile('@web/assets/node_modules/summernote/dist/summernote-bs4.css',['depends'=>RealAsset::className()]);
$this->registerJSFile('@web/assets/node_modules/summernote/dist/summernote-bs4.min.js',['depends'=>RealAsset::className()]);

?>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title?></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <form action="<?=Url::to(['contracts/save-summary'])?>" method="post">
                <input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
                <input type="hidden" name="Data[zmluva_id]" value="<?=$_GET['id']?>">

                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        Krátky popis
                                    </div>
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-md-9 form-group">
                                                <textarea name="Data[summary]" class="form-control summernote" style="height: 400px;">
                                                <?= $prime_text ?>
                                                </textarea>
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <select multiple class="form-control" id="kratky-multi" style="height: 400px;">
                                                    <?php
                                                    foreach ($texts as $item) {
                                                        echo "<option value='{$item['word']}'>{$item['word']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        Popis
                                    </div>
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-md-9 form-group">
                                                <textarea name="Data[description]" class="form-control summernote" style="height: 400px;" id="frm-dlhy">
                                                <?= $prime_text ?>
                                                </textarea>
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <select multiple class="form-control" id="dlhy-multi" style="height: 400px">
                                                    <?php
                                                    foreach ($texts as $item) {
                                                        echo "<option value='{$item['word']}'>{$item['word']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>


                <div class="card">
                    <div class="form-actions">
                        <div class="card-body">
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

$js = <<<JS
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
    
    $('#frm-dlhy').on('summernote.paste',function(e,ne){
         var toInsert = $('#dlhy-multi option:selected').val();
         $(this).summernote('insertText',toInsert);
    });
    
    $('#dlhy-multi').dblclick(function(){
        $('#frm-dlhy').trigger('summernote.paste');
    });
    
     $('.summernote').summernote({
            height: 350, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false // set focus to editable area after initializing summernote
        });
JS;

$this->registerJS($js);
?>
