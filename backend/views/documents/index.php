<?php
use common\widgets\TemplateCategoryTreeWidget;
use common\widgets\TemplateTreeWidget;
use yii\helpers\Url;
$this->title="Šablóny dokumentov";
?>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-8 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
        <div class="col-md-4 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <a class="btn btn-success text-white" href="<?= Url::to(['documents/add-document']) ?>">
                    <i class="fas fa-plus-circle"></i>&nbsp;<?php echo Yii::t('app','Pridať dokument') ?>
                </a>
                <button class="btn btn-info text-white m-l-5" id="btnAddTemplateCategory">
                    <i class="fas fa-plus-circle"></i>&nbsp;<?php echo Yii::t('app','Pridať kategóriu') ?>
                </button>
            </div>
        </div>
    </div>

    <div class="row m-t-10">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <?= TemplateTreeWidget::widget(
                            [
                                'id'    => 'myList',
                                'class_id'  => 'dook'
                            ]
                    ); ?>

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <embed
                            src="#"
                            type="application/pdf"
                            style="width:100%; height: 600px; display: none"
                            id="pdfdocuview"
                    >
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="TemplateCategoryUpdateModal" tabindex="-1" role="dialog" aria-labelledby="TemplateCategoryUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TemplateCategoryUpdateModalLabel"><?= Yii::t('app','Editovať kategóriu') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" value="" id="cat-id">
                <div class="row">
                    <label class="col-2 col-form-label" for="old-name"><?php echo Yii::t('app','Starý názov') ?></label>
                    <div class="col-10">
                        <input type="text" id="old-name" class="form-control">
                    </div>
                </div>
                <div class="row" style="margin-top: 20px">
                    <label class="col-2 col-form-label" for="new-name"><?php echo Yii::t('app','Nový názov') ?></label>
                    <div class="col-10">
                        <input type="text" id="new-name" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= Yii::t('app','Zatvoriť') ?></button>
                <button type="button" class="btn btn-primary" id="btnTemplateCategoryUpdateSave"><?= Yii::t('app','Uložiť') ?></button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="TemplateCategoryAddModal" tabindex="-1" role="dialog" aria-labelledby="TemplateCategoryAddModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TemplateCategoryAddModalLabel"><?= Yii::t('app','Pridať kategóriu') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label class="col-2 col-form-label"><?= Yii::t('app','Kategórie')?></label>
                    <div class="col-10">
                        <?= TemplateCategoryTreeWidget::widget([
                            'id'    => 'myUL',
                            'class_id'  => 'dook'
                        ]); ?>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px">
                    <label class="col-2 col-form-label" for="category-name"><?php echo Yii::t('app','Názov') ?></label>
                    <div class="col-10">
                        <input type="text" id="category-name" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= Yii::t('app','Zatvoriť') ?></button>
                <button type="button" class="btn btn-primary" id="btnTemplateCategoryAddSave"><?= Yii::t('app','Uložiť') ?></button>
            </div>
        </div>
    </div>
</div>

<?php
$csrf = "'" . Yii::$app->request->csrfParam ."':'". Yii::$app->request->getCsrfToken() ."'";
$urlAddTemplateCategory = Url::to(['/documents/ajax-add-template-category']);
$urlGetTeamplateFullName = Url::to(['/documents/ajax-get-template-full-name']);
$urlSaveCategoryNameUpdate = Url::to(['/documents/ajax-save-category-name-update']);
$urlDeleteCatgory = Url::to(['/documents/ajax-delete-category']);

$js = <<<JS

    viewTemplate = (id) => {
        $.ajax({
            url: "{$urlGetTeamplateFullName}",
            dataType: "json",
            data: { template_id: id, {$csrf} },
            type: "POST"
        }).done(function(res){
            if (res.status == 'error') {
                console.log(res.message);
            } else {
                $('#pdfdocuview').attr('src',res.name);
                if ($('#pdfdocuview').is(':hidden')) {
                    $('#pdfdocuview').show();
                }
            }
        });
    }
    
    deleteTemplate = (id)=> {
        $.ajax({
            url: "{$urlSaveCategoryNameUpdate}",
            dataType: "json",
            data: { category_id: id, category_name: categoryName, {$csrf} },
            type: "POST"
        }).done(function(res){
            if (res.status == 'error') {
                console.log(res.message);
            } else {
                $('#TemplateCategoryUpdateModal').modal('hide');
            }
        });
    }
    
    editCategory = (id) => {
        var oldTxt = $('.item-'+id).data('txt');
        $('#old-name').val(oldTxt);
        $('#cat-id').val(id);
        $('#TemplateCategoryUpdateModal').modal('show');
    }

    $('#btnTemplateCategoryUpdateSave').on('click',()=>{
        var id = $('#cat-id').val();
        var categoryName = $('#new-name').val();
        $.ajax({
            url: "{$urlSaveCategoryNameUpdate}",
            dataType: "json",
            data: { category_id: id, category_name: categoryName, {$csrf} },
            type: "POST"
        }).done(function(res){
            if (res.status == 'error') {
                console.log(res.message);
            } else {
                $('#TemplateCategoryUpdateModal').modal('hide');
            }
        });
    });
    

    $('#btnAddTemplateCategory').on('click',function(){
        $('#TemplateCategoryAddModal').modal('show');
    });

    $('#btnTemplateCategoryAddSave').on('click',function(){
        var selectedCategory = [];
        $('.cat-item').each(function(){
            if ($(this).is(':checked')) {
                selectedCategory.push($(this).val());
            }
        });
        if (selectedCategory == 0) {
            alert('Nezvolili ste ziadnu kategoriu!');
            return;
        }
        var categoryName = $('#category-name').val();
        $.ajax({
                url: "{$urlAddTemplateCategory}",
                dataType: "json",
                data: { category_ids: JSON.stringify(selectedCategory), category_name: categoryName , {$csrf} },
                type: "POST"
            }).done(function(res){
                if (res.status == 'error') {
                    console.log(res.message);
                } else {
                    $('#TemplateCategoryAddModal').modal('hide');
                }
            });
    });
JS;
$this->registerJS($js);

$css = <<<CSS
ul#mainList {
  min-height: 610px;
}
CSS;
$this->registerCSS($css);