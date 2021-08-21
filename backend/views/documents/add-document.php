<?php

use backend\assets\RealAsset;
use yii\helpers\Url;
use common\widgets\TemplateCategoryTreeWidget;

$this->registerCSSFile('@web/assets/summernote/summernote.css',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/summernote/summernote.js',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/summernote/summernote-bs4.css',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/summernote/summernote-bs4.js',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/bootstrap-notify/bootstrap-notify.min.js',['depends'=>RealAsset::class]);

$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css',['depends'=>RealAsset::class]);
$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css',['depends'=>RealAsset::class]);
$this->registerJSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js',['depends'=>RealAsset::class]);

$this->registerJSFile('@web/js/cleanTemplateTexts.js?v=0.95',['depends'=>RealAsset::class]);

$this->title="Pridať šablónu";
?>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>
    <div class="card">
        <div class="card-body">

            <form method="post" id="frm-add-document">
                <input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
                <div class="form-row" id="new-template-form">
                    <div class="col-md-12 form-group">
                        <label class="control-label"><?= Yii::t('app','Kategórie')?></label>
                        <?= TemplateCategoryTreeWidget::widget([
                            'id'    => 'myUL',
                            'name'  => 'Dook'
                        ]); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 form-group">
                        <label class="control-label"><?= Yii::t('app','Názov') ?></label>
                        <input type="text" name="Dook[name]" class="form-control">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 form-group">
                        <label class="control-label"><?= Yii::t('app','Verzia') ?></label>
                        <input type="text" name="Dook[version]" class="form-control" value="1.0">
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="control-label"><?= Yii::t('app','Typ') ?></label>
                        <select class="form-control select-drop" name="Dook[template_type]">
                            <option value="pdf">PDF dokument</option>
                            <option value="link">Link</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-8 form-group">
                        <textarea name="Dook[content]" class="form-control summernote" style="height: 400px;" id="dook-content"></textarea>
                    </div>

                    <div class="col-md-4 form-group">

                        <section id="SearchDoc" class="m-b-20">
                            <input type="text" class="form-control m-b-10" id="STerm" placeholder="Nájsť">
                            <input type="text" class="form-control m-b-10" id="RTerm" placeholder="Nahradiť">
                            <button type="button" class="btn btn-secondary" id="ButtonSearch">Vyhľadať</button>
                            <button type="button" class="btn btn-secondary" id="ButtonReplace">Nahradiť</button>
                        </section>

                        <ul id="SearchResult">

                        </ul>

                        <section id="TemplateVariables">
                            <h5><?= Yii::t('app','Premenné šablon') ?></h5>
                            <select class="form-control select-drop" id="doc-items">
                                <option value=""><?php echo Yii::t('app','Zvoľte premennú') ?></option>
                                <?php
                                foreach ($tpl_vars as $item) {
                                    ?>
                                    <option value="<?php echo $item->code; ?>"><?php echo $item->desc; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <footer>
                                <button type="button" class="btn btn-secondary" id="btnTemplateVariableInsert">
                                    <?php echo Yii::t('app','Vložiť') ?>
                                </button>
                                <button type="button" class="btn btn-secondary" id="btnTemplateVariableUpdate">
                                    <?php echo Yii::t('app','Zmeniť') ?>
                                </button>
                                <button type="button" class="btn btn-secondary" id="btnTemplateVariableAdd">
                                    <?php echo Yii::t('app','Pridať') ?>
                                </button>
                                <button type="button" class="btn btn-secondary" id="btnTemplateVariableDelete">
                                    <?php echo Yii::t('app','Zmazať') ?>
                                </button>
                            </footer>
                        </section>
                        <section id="TemplateBlocks">
                            <h5><?= Yii::t('app','Preddefinované bloky') ?></h5>
                            <select class="form-control select-drop" id="block-items">
                                <option value=""><?php echo Yii::t('app','Zvoľte blok') ?></option>
                                <?php
                                foreach ($tpl_vars as $item) {
                                    if ($item->templ_type == 'var') {
                                        continue;
                                    }
                                    ?>
                                    <option value="<?php echo $item->code; ?>"><?php echo $item->desc; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <footer class="m-t-5">
                                <button type="button" class="btn btn-secondary" id="btnTemplateBlockInsert">
                                    <?php echo Yii::t('app','Vložiť') ?>
                                </button>
                                <button type="button" class="btn btn-secondary" id="btnTemplateBlockUpdate">
                                    <?php echo Yii::t('app','Zmeniť') ?>
                                </button>
                                <button type="button" class="btn btn-secondary" id="btnTemplateBlockAdd">
                                    <?php echo Yii::t('app','Pridať') ?>
                                </button>
                                <button type="button" class="btn btn-secondary" id="btnTemplateBlockDelete">
                                    <?php echo Yii::t('app','Zmazať') ?>
                                </button>
                            </footer>
                        </section>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 form-group">
                        <input type="submit" value="<?= Yii::t('app','Uložiť') ?>" class="btn btn-info">
                        <a href="<?php echo \yii\helpers\Url::to(['/'.$this->context->id]) ?>" class="btn btn-danger"><?php echo Yii::t('app','Zrušiť') ?></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="TemplateVariableUpdateModal" tabindex="-1" role="dialog" aria-labelledby="TemplateVariableUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TemplateVariableUpdateModalLabel"><?= Yii::t('app','Zmeniť premennú') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-3 col-form-label"><?= Yii::t('app','Starý popis') ?></label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="old-txt">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label"><?= Yii::t('app','Starý kód') ?></label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="old-code">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label"><?= Yii::t('app','Nový popis') ?></label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="new-txt">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label"><?= Yii::t('app','Nový kód') ?></label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="new-code">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= Yii::t('app','Zatvoriť') ?></button>
                <button type="button" class="btn btn-primary" id="btnTemplateVariableUpdateSave"><?= Yii::t('app','Uložiť') ?></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="TemplateVariableAddModal" tabindex="-1" role="dialog" aria-labelledby="TemplateVariableAddModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TemplateVariableAddModalLabel"><?= Yii::t('app','Pridať premennú') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-2 col-form-label"><?= Yii::t('app','Popis') ?></label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="add-new-desc">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label"><?= Yii::t('app','Kód') ?></label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="add-new-code">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= Yii::t('app','Zatvoriť') ?></button>
                <button type="button" class="btn btn-primary" id="btnTemplateVariableAddSave"><?= Yii::t('app','Uložiť') ?></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="TemplateVariableDeleteModal" tabindex="-1" role="dialog" aria-labelledby="TemplateVariableDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TemplateVariableDeleteModalLabel"><?= Yii::t('app','Naozaj zmazať?') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Tieto prvky budú zmazané bez možnosti návratu. Chcete zmazať?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= Yii::t('app','Zatvoriť') ?></button>
                <button type="button" class="btn btn-primary" id="btnTemplateVariableDeleteSave"><?= Yii::t('app','Uložiť') ?></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="TemplateBlockDeleteModal" tabindex="-1" role="dialog" aria-labelledby="TemplateBlockDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TemplateBlockDeleteModalLabel"><?= Yii::t('app','Naozaj zmazať?') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Tieto prvky budú zmazané bez možnosti návratu. Chcete zmazať?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= Yii::t('app','Zatvoriť') ?></button>
                <button type="button" class="btn btn-primary" id="btnTemplateBlockDeleteSave"><?= Yii::t('app','Uložiť') ?></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="TemplateBlockUpdateModal" tabindex="-1" role="dialog" aria-labelledby="TemplateBlockUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TemplateBlockUpdateModalLabel"><?= Yii::t('app','Zmeniť blok') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-2 col-form-label"><?= Yii::t('app','Starý popis') ?></label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="old-txt-block">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label"><?= Yii::t('app','Starý kód') ?></label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="old-code-block">
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-2 col-form-label"><?= Yii::t('app','Nový popis') ?></label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="new-txt-block">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label"><?= Yii::t('app','Nový kód') ?></label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="new-code-block">
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-2 col-form-label"><?= Yii::t('app','Blok kódu') ?></label>
                    <div class="col-10">
                        <textarea class="form-control" style="height: 200px;" id="block-content"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= Yii::t('app','Zatvoriť') ?></button>
                <button type="button" class="btn btn-primary" id="btnTemplateBlockUpdateSave"><?= Yii::t('app','Uložiť') ?></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="TemplateBlockAddModal" tabindex="-1" role="dialog" aria-labelledby="TemplateBlockAddModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TemplateBlockAddModalLabel"><?= Yii::t('app','Pridať blok') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-2 col-form-label"><?= Yii::t('app','Popis') ?></label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="add-new-block-desc">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label"><?= Yii::t('app','Kód') ?></label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="add-new-block-code" value="block.">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label"><?= Yii::t('app','Obsah') ?></label>
                    <div class="col-10">
                        <textarea class="form-control" id="add-new-block-content" rows="10"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= Yii::t('app','Zatvoriť') ?></button>
                <button type="button" class="btn btn-primary" id="btnTemplateBlockAddSave"><?= Yii::t('app','Uložiť') ?></button>
            </div>
        </div>
    </div>
</div>

<?php

$csrf = "'" . Yii::$app->request->csrfParam ."':'". Yii::$app->request->getCsrfToken() ."'";

$urlDeleteTemplateVar = Url::to(['/documents/ajax-delete-template-variable']);
$urlUpdateTemplateVar = Url::to(['/documents/ajax-update-template-variable']);
$urlAddTemplateVar = Url::to(['/documents/ajax-add-template-variable']);

$urlAddTemplateBlock = Url::to(['/documents/ajax-add-template-block']);
$urlDeleteTemplateBlock = Url::to(['/documents/ajax-delete-template-block']);
$urlUpdateTemplateBlock = Url::to(['/documents/ajax-update-template-block']);
$urlGetBlockDetails = Url::to(['/documents/ajax-get-block-details']);
$urlAutoSaveDocument = Url::to(['/documents/ajax-auto-save-document']);
$urlUploadImage = Url::to(['/ajax/image-uploader']);
$urlSearchDocument = Url::to(["/documents/ajax-search-documents"]);
$urlViewDocumentWithResult = Url::to(['/documents/edit']);

$js = <<<JS

    $('#ButtonSearch').on('click',function(){
        $.ajax({
                url: "{$urlSearchDocument}",
                dataType: "json",
                data: { 
                    search_data: {
                        sterm: $('#STerm').val()
                    }, 
                    {$csrf} 
                },
                type: "POST"
        }).done(function(res){
                if (res.status == 'error') {
                    console.log(res.message);
                } else {    
                    console.log(res.items);
                    $("#SearchResult").empty();
                    for(i=0;res.items.length;i++){
                        var title_name = res.items[i].name == '' ? 'no title' : res.items[i].name;
                        var href= "{$urlViewDocumentWithResult}?id=" + res.items[i].id + "&sterm=" + res.sterm;
                        $("#SearchResult").append('<li><input type="checkbox" class="form-check-input"><a target="_blank" href="' + href + '">' + title_name + '</a></li>');
                    }
                }
        });
    });

    // autosave part
    
    documentAutosave = function() {
        var templateId = window.localStorage.getItem('templateId') !== undefined ? window.localStorage.getItem('templateId') : 0;
        var categoryId = 0;
        $('.cat-item').each(function(k,v){
            if ($(v).is(':checked')) {
                categoryId = $(v).val();
            }
        });
        var data = {
            name: $('input[name="Dook[name]"]').val(),
            category_id: categoryId,
            template_id: templateId,
            version: $('input[name="Dook[version]"]').val(),
            template_type: $('select[name="Dook[template_type]"]').val(),
            content: btoa($('textarea[name="Dook[content]"]').val())
        };
        $.ajax({
                url: "{$urlAutoSaveDocument}",
                dataType: "json",
                data: { template_data: data, {$csrf} },
                type: "POST"
        }).done(function(res){
                if (res.status == 'error') {
                    console.log(res.message);
                } else {
                   window.localStorage.setItem('templateId',res.template_id);
                   $.notify({
                        message: 'Saved!'   
                   },{
                        type: 'success',
                        animate: {
                            enter: 'animated fadeInRight',
		                    exit: 'animated fadeOut'
	                    },
	                    newest_on_top: true     
                   });
                }
        });
    }
    
    //setInterval(documentAutosave,300000);

    $('#btnTemplateVariableUpdate').on('click', function () {
        if ($('#doc-items :selected').val() == '') {
            alert('Zvoľte položku na úpravu!');
        } else {
            $('#old-txt').val($.trim($('#doc-items :selected').text()));
            $('#old-code').val($.trim($('#doc-items :selected').val()));
            $('#new-txt').val($.trim($('#doc-items :selected').text()));
            $('#new-code').val($.trim($('#doc-items :selected').val()));
            $('#TemplateVariableUpdateModal').modal('show');
        }
    });
    $('#btnTemplateBlockUpdate').on('click', function () {
        if ($('#block-items :selected').val() == '') {
            alert('Zvoľte položku na úpravu!');
        } else {
            var blockCode = $.trim($('#block-items :selected').val());
            $.ajax({
                url: "{$urlGetBlockDetails}",
                dataType: "json",
                data: { block_code: blockCode, {$csrf} },
                type: "POST"
            }).done(function(res){
                if (res.status == 'error') {
                    console.log(res.message);
                } else {
                    $('#old-txt-block').val($.trim($('#block-items :selected').text()));
                    $('#old-code-block').val(blockCode);
                    $('#new-txt-block').val($.trim($('#block-items :selected').text()));
                    $('#new-code-block').val($.trim($('#block-items :selected').val()));
                    // TODO: haha
                    $('#block-content').summernote('code',res.block_content);
                    $('#TemplateBlockUpdateModal').modal('show');
                }
            });
        }
    });
    $('#btnTemplateVariableAdd').on('click', function () {
        $('#TemplateVariableAddModal').modal('show');
    });
    $('#btnTemplateVariableDelete').on('click', function () {
        if ($('#doc-items :selected').val() == '') {
            alert('Zvoľte položku na úpravu!');
        } else {
            $('#TemplateVariableDeleteModal').modal('show');
        }
    });
    $('#btnTemplateBlockDelete').on('click', function () {
        if ($('#block-items option:selected').val() == '') {
            alert('Zvoľte položku na úpravu!');
        } else {
            $('#TemplateBlockDeleteModal').modal('show');
        }
    });
    $('#btnTemplateBlockAdd').on('click',function(){
       $('#TemplateBlockAddModal').modal('show');
    });
    
    refreshTemplateVariables = function(items) {
        $('#doc-items').empty().append($('<option></option>',{value: '', text: 'Vyberte premennú'}));
        items.forEach(function(v){
            if (v.templ_type == 'var') {
                $('#doc-items').append($('<option></option>',{value: v.code, text: v.desc}));
            }
        });
    }
    refreshBlockVariables = function(items) {
        $('#block-items').empty().append($('<option></option>',{value: '', text: 'Vyberte blok'}));
        items.forEach(function(v){
            
            if (v.templ_type == 'blk') {
                $('#block-items').append($('<option></option>',{value: v.code, text: v.desc}));
            }
        });
    }
   
    $('#doc-items').select2({
        theme: "bootstrap",
        placeholder: "Vyberte premennu",
        tags: false
    });
    $('#block-items').select2({
        theme: "bootstrap",
        placeholder: "Vyberte blok",
        tags: false
    });
    
    var HelloButton = function (context) {
        var ui = $.summernote.ui;
        var button = ui.button({
            contents: '<i class="fas fa-tint"></i> Clean HTML',
            tooltip: 'Clean HTML',
            click: function () {
                // invoke insertText method with 'hello' on editor module.
                //context.invoke('editor.insertText', 'hello');
                let s = $('#dook-content').summernote('code');
                s = templateCleaner(s);
                $('#dook-content').summernote('code',s);
                alert('Cleaning done! Please check if all code was removed!');
            }
        });
        return button.render();   // return button as jquery object
    }

    $('#dook-content').summernote({
        height: 350,
         toolbar: [
            // [groupName, [list of button]]
            ['style', ['style']],
            ['font', ['bold', 'italic','strikethrough', 'superscript', 'subscript', 'underline', 'clear']],
            ['fontname', ['fontname','fontsize']],
            ['color', ['color', 'backcolor']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table',['table']],
            ['height', ['height']],
            ['insert',['picture','link','hr']],
            ['view', ['codeview', 'help']],
            ['misc',['undo','redo']],
            ['mybutton', ['hello']],
        ],
        buttons: {
            hello: HelloButton
        },
        callbacks:{
            onImageUpload:function(files, editor, welEditable){
                for(i=0;i<files.length;i++) {
                    sendFile(files[i],this);
                }
            }
        }
    });
    sendFile = function(file, el) {
        var form_data = new FormData();
        form_data.append('file', file);
        $.ajax({
            data: form_data,
            type: "POST",
            url: '{$urlUploadImage}',
            cache: false,
            contentType: false,
            processData: false,
            success: function(res) {
                $(el).summernote('editor.insertImage', res.url);
            }
        });
    }
    $('#add-new-block-content').summernote({
        height: 200
    });
    $('#block-content').summernote({
        height: 200
    });
    $('#dook-content').on('summernote.paste',function(e,ne){
       
        var docItem = $('#doc-items option:selected').val();
        var blockItem = $('#block-items option:selected').val();
        var toInsert = '';
        if (docItem != '') {
            toInsert = "[" + docItem + "]";
            $('#doc-items').val('').trigger('change');
        }
        if (blockItem != '') {
            toInsert += '[' + blockItem + ']';
            $('#block-items option:selected').val('').trigger('change');
        }
        $(this).summernote('insertText',toInsert);
    });
    $('#btnTemplateVariableInsert').on('click', function(){
        $('#dook-content').trigger('summernote.paste');
        return false;
    });
    $('#btnTemplateBlockInsert').on('click', function(){
        $('#dook-content').trigger('summernote.paste');
        return false;
    });

    $('#btnTemplateVariableDeleteSave').on('click',function(){
        var item_to_delete = $('#doc-items').val();
        $.ajax({
            url: "{$urlDeleteTemplateVar}",
            dataType: "json",
            data: { templvar: item_to_delete, {$csrf} },
            type: "POST"
        }).done(function(res){
            if (res.status == 'error') {
                console.log(res.message);
            } else {
                refreshTemplateVariables(res.details);
                $('#TemplateVariableDeleteModal').modal('hide');
            }
        });
    });
    $('#btnTemplateVariableAddSave').on('click', function(){
        var code = $('#add-new-code').val();
        var descr = $('#add-new-desc').val();
        $.ajax({
            url: "{$urlAddTemplateVar}",
            dataType: "json",
            data: { 
                code: code, 
                descr: descr,    
                {$csrf} 
            },
            type: "POST"
        }).done(function(res){
            if (res.status == 'error') {
                console.log(res.message);
            } else {
                refreshTemplateVariables(res.details);
                $('#TemplateVariableAddModal').modal('hide');
            }
        });
    });
    $('#btnTemplateVariableUpdateSave').on('click', function(){
        var old_code = $('#old-code').val();
        var old_text = $('#old-txt').val();
        var new_text = $('#new-txt').val();
        var new_code = $('#new-code').val();
        $.ajax({
            url: "{$urlUpdateTemplateVar}",
            dataType: "json",
            data: { 
                oldcode: old_code,
                oldtxt: old_text,
                newcode: new_code,
                newtxt: new_text, 
                {$csrf} 
            },
            type: "POST"
        }).done(function(res){
            if (res.status == 'error') {
                console.log(res.message);
            } else {
                refreshTemplateVariables(res.details);
                $('#TemplateVariableUpdateModal').modal('hide');
            }
        }); 
    });
    
    $('#btnTemplateBlockDeleteSave').on('click',function(){
        var item_to_delete = $('#block-items').val();
        $.ajax({
            url: "{$urlDeleteTemplateBlock}",
            dataType: "json",
            data: { templblk: item_to_delete, {$csrf} },
            type: "POST"
        }).done(function(res){
            if (res.status == 'error') {
                console.log(res.message);
            } else {
                refreshBlockVariables(res.details);
                $('#TemplateBlockDeleteModal').modal('hide');
            }
        }); 
    });
    $('#btnTemplateBlockUpdateSave').on('click',function(){
        var old_code = $('#old-code-block').val();
            var old_text = $('#old-txt-block').val();
            var new_text = $('#new-txt-block').val();
            var new_code = $('#new-code-block').val();
            var content = $('#block-content').summernote('code');
            $.ajax({
                url: "{$urlUpdateTemplateBlock}",
                dataType: "json",
                data: { 
                    oldcode: old_code,
                    oldtxt: old_text,
                    newcode: new_code,
                    newtxt: new_text, 
                    blockcontent: content,
                    {$csrf} 
                },
                type: "POST"
            }).done(function(res){
                if (res.status == 'error') {
                    console.log(res.message);
                } else {
                    refreshBlockVariables(res.details);
                    $('#TemplateBlockUpdateModal').modal('hide');
                }
            });
    });
    $('#btnTemplateBlockAddSave').on('click',function(){
            var code = $('#add-new-block-code').val();
            var descr = $('#add-new-block-desc').val();
            var content = $('#add-new-block-content').summernote('code');
            $.ajax({
                url: "{$urlAddTemplateBlock}",
                dataType: "json",
                data: { 
                    code: code, 
                    descr: descr,  
                    content: content,  
                    {$csrf} 
                },
                type: "POST"
            }).done(function(res){
                if (res.status == 'error') {
                    console.log(res.message);
                } else {
                    refreshBlockVariables(res.details);
                    $('#add-new-block-desc').val('');
                    $('#add-new-block-code').val('block.');
                    $('#add-new-block-content').summernote('code','');
                    $('#TemplateBlockAddModal').modal('hide');
                }
            });
    });
    $('#frm-add-document').on('submit',function(){
        $("<input />").attr("type", "hidden")
          .attr("name", "Dook[template_id]")
          .attr("value", window.localStorage.getItem('templateId'))
          .appendTo(this); 
        
        window.localStorage.removeItem('templateId');
        return true;
    });
    
    
JS;
$this->registerJS($js);

$css = <<<CSS
#SearchResult {
    margin: 0px 0px 20px 20px;
    padding:0;
}
#SearchResult > li > a {
    color: black;
    padding-left: 5px;
}

#SearchResult > li > a:hover {
    width: 100%;
    color: #fff;
    background-color: darkgrey;
    display: inline-block;
}

CSS;

$this->registerCss($css);
