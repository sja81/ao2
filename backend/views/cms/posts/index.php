<?php
use yii\helpers\Url;
use backend\assets\RealAsset;

$this->title="Stránky";

$this->registerJSFile('https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js',['depends'=>RealAsset::className()]);
$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css',['depends'=>RealAsset::className()]);
?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="/backoffice/cms/add-post">
                <i class="fas fa-plus-circle"></i>&nbsp;Pridať novú
            </a>
        </div>
    </div>

    <div class="row m-t-20">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <table id="tbl-posts" class="table table-striped m-t-5" cellspacing="0" cellpadding="0">
                        <thead style="background-color: #2B81AF; text-align: left;" class="text-white">
                            <th style="width: 60%; padding: 0.5rem !important;">Názov</th>
                            <th style="width:15%; padding: 0.5rem !important;">Autor</th>
                            <th style="width:15%; padding: 0.5rem !important;">Dátum</th>
                            <th style="padding: 0.5rem !important;">Akcie</th>
                        </thead>
                        <tbody>
                        <?php
                            if (empty($posts)) {
                            ?>
                            <tr>
                                <td colspan="4" style="text-align: center; padding: 0.5rem !important;">No data...</td>
                            </tr>
                        <?php
                            } else {
                                foreach($posts as $post) {
                                    ?>
                                <tr>
                                    <td><?= $post->post_title ?></td>
                                    <td><?= $post->getAuthorName() ?></td>
                                    <td>
                                        <?= $post->getStatus() ?><br>
                                        <?= $post->post_modified ?>
                                    </td>
                                    <td>
                                        <a href="<?= Url::to(['cms/edit-post','id'=>$post->id]) ?>" class="edit-menu">Upraviť</a>
                                        |
                                        <a href="#" class="edit-menu" onclick="deletePost(<?= $post->id ?>)">Zmazat</a>
                                    </td>
                                </tr>
                        <?php
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<?php

$js = <<<JS
    deletePost = function(id) {
        $.confirm({
            theme: 'material',
            closeIcon: true,
            animation: 'scale',
            type: 'red',
            title: '',
            content: 'Naozaj chcete zmazať stránku?',
             buttons: {
                confirm: {
                    text: 'Ano',
                    btnClass: 'btn-red',
                    action: function(confirmButton){
                        $.alert('Confirmed!');
                    }
                },
                cancel: {
                    text: 'Nie',
                    btnClass: 'btn-default',
                    action : function(cancelButton) {
                        
                    }
                }
            }
        });
    }
JS;

$this->registerJS($js);
