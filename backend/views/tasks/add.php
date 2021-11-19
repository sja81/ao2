<?php
use backend\assets\RealAsset;
use common\models\tasks\TasksPriority;
use yii\helpers\Html;

$this->title = Yii::t('app','Pridať úlohu');
$this->registerCSSFile('@web/css/tasks.css?v=0.9',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/moment/moment.js',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/tinymce/tinymce.min.js',['depends'=>RealAsset::class]);
$emptyTaskTitle = Yii::t('app','Názov úlohy nemože byť prázdny');
$emptyProject = Yii::t('app','Zvoľte si projekt');

?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>

    <?= common\widgets\Alert::widget() ?>

    <div class="card">
        <div class="card-body">
            <form method="post" role="form" id="task-frm">
                <input type="hidden" name="<?php echo Yii::$app->request->csrfParam ?>" value="<?php echo Yii::$app->request->getCsrfToken()?>">

                <div class="form-group row has-danger">
                    <label class="col-2 col-form-label text-right"><?= Yii::t('app','Projekt') ?><sup style="color:red">*</sup></label>
                    <div class="col-5">
                        <select id="i1" class="form-control form-control-danger form-select req" name="Task[project]" data-item="project">
                            <option value=""><?php echo Yii::t('app','Zvoľte projekt') ?></option>
                            <?php
                            foreach($boardProjects as $project) {
                                echo "<option value='{$project['code']}'>{$project['name']}</option>";
                            }
                            ?>
                        </select>
                        <div id="project-error" class="invalid-feedback">
                            <?php echo $emptyProject ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 col-form-label text-right"><?php echo Yii::t('app','Priorita') ?><sup style="color:red">*</sup></label>
                    <div class="col-5">
                        <select class="form-control dropdown req" name="Task[priority]">
                            <?php
                            foreach(TasksPriority::getPriorities() as $key => $prio) {
                                echo "<option value='{$key}'>{$prio}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row <?= isset($postData['title']) && $postData['title'] != '' ? '' : 'has-danger'?>">
                    <label class="col-2 col-form-label text-right"><?php echo Yii::t('app','Názov') ?><sup style="color:red">*</sup></label>
                    <div class="col-8">
                        <input
                                id="i2"
                                type="text"
                                class="form-control form-control-danger"
                                name="Task[title]"
                                data-item="title"
                                value="<?= isset($postData['title']) ? $postData['title'] : '' ?>"
                        >
                        <div id="title-error" class="invalid-feedback">
                            <?php echo $emptyTaskTitle ?>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 col-form-label text-right"><?php echo Yii::t('app','Priradiť osobe') ?></label>
                    <div class="col-5">
                        <select class="form-control dropdown" name="Task[assignee]">
                            <option value="unassigned">unassigned</option>
                            <?php
                            foreach($users as $user){
                                echo "<option value='{$user['username']}'>{$user['username']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 col-form-label text-right"><?php echo Yii::t('app','Priradiť skupine') ?></label>
                    <div class="col-5">
                        <select class="form-control dropdown" name="Task[assigneeGroup]">
                            <option value="unassigned">unassigned</option>
                            <?php
                            foreach($groups as $group){
                                echo "<option value='{$group['name']}'>{$group['name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 col-form-label text-right"><?php echo Yii::t('app','Popis') ?></label>
                    <div class="col-8">
                        <textarea
                                class="form-control"
                                rows="8"
                                name="Task[summary]"
                                id="summary"><?= isset($postData['summary']) ? $postData['summary'] : '' ?></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 col-form-label text-right"><?php echo Yii::t('app','Dátum dodania') ?></label>
                    <div class="col-5">
                        <input
                                type="text"
                                id="date-format"
                                class="form-control"
                                name="Task[dueDate]"
                                value="<?= isset($postData['dueDate']) ? $postData['dueDate'] : '' ?>"
                        >
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-10 offset-2">
                        <button class="btn btn-secondary"><i class="mdi mdi-content-save"></i>
                            <?php echo Yii::t('app','Uložiť'); ?>
                        </button>
                        <?php echo Html::a(Yii::t('app','Zrušiť'),['/tasks'],['class'=>'btn btn-danger']); ?>
                    </div>
                </div>


            </form>
        </div>
    </div>

</div>

<?php
$cantBeSubmitted = Yii::t('app','Nie sú všetky povinné políčka vyplnené!');
$js = <<<JS
    $('#task-frm').on('submit',function(){
       let canSubmit = true;
       $.each($('.req'),function(k,v){
           if ($(v).val() == '') {
               canSubmit &= false;
           }
       });
       if (!canSubmit) {
           alert('{$cantBeSubmitted}');
           return false;
       }
    });
    
    $('#date-format').bootstrapMaterialDatePicker({ format: 'YYYY-MM-DD HH:mm' });

    displayError = function(e) {
       let x = e.data('item');
       if (e.val() !== '') {
           e.removeClass('form-control-danger').parent().parent().removeClass('has-danger');
           $('#'+x+'-error').hide();
           return false;
       } 
       e.addClass('form-control-danger').parent().parent().addClass('has-danger');
       $('#'+x+'-error').show();
    }
    
    $('#i1').change(function(){
       displayError($(this));
    });
    
    $('#i2').keyup(function(){
       displayError($(this)); 
    });
    
    tinymce.init({
        selector: "textarea#summary",
        theme: "modern",
        height: 300,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",

    });
    
JS;
$this->registerJS($js);
