<?php
use Yii;
use yii\helpers\Url;
use backend\helpers\HelpersNum;
use common\models\search\BackendSearch;

$this->title = "Úlohy";
?>

<div class="animated fadeInRight container-fluid">
    <div class="row" style="margin-top: 20px" id="task-table">
        <div class="col-md" style="background-color: white; padding: 10px;margin-right: 10px;border-radius: 3px;">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>To-do</h3>
                    <p class="small"><i class="fa fa-hand-o-up"></i> Drag task between list</p>

                    <ul class="sortable-list connectList agile-list" id="todo">
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md" style="background-color: white; padding: 10px;margin-right: 10px;border-radius: 3px;">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>In Progress</h3>
                    <p class="small"><i class="fa fa-hand-o-up"></i> Drag task between list</p>
                    <ul class="sortable-list connectList agile-list" id="inprogress">

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md" style="background-color: white; padding: 10px;margin-right: 10px;border-radius: 3px;">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>In Test</h3>
                    <p class="small"><i class="fa fa-hand-o-up"></i> Drag task between list</p>
                    <ul class="sortable-list connectList agile-list" id="intest">

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md" style="background-color: white; padding: 10px;margin-right: 10px;border-radius: 3px;">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>Completed</h3>
                    <p class="small"><i class="fa fa-hand-o-up"></i> Drag task between list</p>
                    <ul class="sortable-list connectList agile-list" id="completed">
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md">
            <button id="add-column" data-toggle="modal" data-target="#exampleModal" class="btn btn-success"><i class="fas fa-plus-circle"></i></button>
        </div>
    </div>
</div>

<!-- Modal dialogs -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo Yii::t('app','Zavrieť') ?></button>
        <button type="button" class="btn btn-primary"><?php echo Yii::t('app','Uložiť') ?></button>
      </div>
    </div>
  </div>
</div>


<!-- end of modal dialogs -->



<?php
$js = <<<JS
     $(".sortable-item").sortable({
            connectWith: ".connectList",
            receive: function( event, ui ) {
                let status = -1, id = ui.item.data('id');
                switch (event.target.id) {
                    case 'inprogress':
                        status = 1;
                        break;
                    case 'todo':
                        status = 0;
                        break;
                    case 'completed':
                        status = 2;
                        break;
                }
            }
        }).disableSelection();
JS;
$this->registerJS($js);