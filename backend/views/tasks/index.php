<?php
use backend\assets\RealAsset;
use yii\helpers\Url;

$this->title = Yii::t('app','Úlohy');
$this->registerCSSFile('@web/css/tasks.css?v=0.9',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/jqueryui/jquery-ui.js',['depends'=>RealAsset::class]);
?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-xs-12">
            <a class="btn btn-info text-white" href="<?= Url::to(['/tasks/add']) ?>">
                <i class="fas fa-plus-circle"></i>&nbsp;<?= Yii::t('app','Pridať úlohu'); ?>
            </a>
        </div>
    </div>

    <?php

    if (Yii::$app->getResponse()->getStatusCode() == 200) {
        $successText = Yii::$app->session->getFlash('success');
        if ($successText != '') {
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $successText ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php
        }
    }
    ?>
    <div class="row m-b-10">
        <?php
            foreach ($boardColumns as $column) {
                echo $this->render('task-column',[
                    'target' => $column['target'],
                    'title'  => $column['title'],
                    'tasks'  => $tasks
                ]);
            }
        ?>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <a  class="btn btn-secondary" href="<?= Url::to(['/tasks/add']) ?>"><i class="ti-plus"></i></a>
        </div>
    </div>
</div>

<?php
$csrf = "'" . Yii::$app->request->csrfParam ."':'". Yii::$app->request->getCsrfToken() ."'";
$js = <<<JS
    updateTicketStage = function(target, id) {
         $.ajax({
           url: "tasks/update-stage",
           dataType: "json",
           data: { stage: target, ticketid: id, {$csrf} },
           type: "post"
       })
       .done(function(res){
          if (res.status == 'error') {
             
          } else {
              let status = $('#stat-'+id);
              status.text(res.newStatus);
          }
       });
    }
    
    $('.task-col').sortable({
       connectWith: ".task-col",
       handle: ".ibox-header",
       receive: function(event, ui) {
           let target = $(event.target).data('target');
           let ticketId = $(ui.item).data('id');
           updateTicketStage(target, ticketId);
       }
    });
JS;
$this->registerJS($js);
?>
