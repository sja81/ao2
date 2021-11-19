<?php
use backend\assets\RealAsset;

$this->title = Yii::t('app','Editácia úlohy');

$this->registerCSSFile('@web/css/issue.css?v=0.5',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/js/issue.js?v=0.1',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/toast-master/css/jquery.toast.css',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/html5-editor/bootstrap-wysihtml5.css',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/toast-master/js/jquery.toast.js',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/tinymce/tinymce.min.js',['depends'=>RealAsset::class]);
?>

<main class="bg-white p-20">
    <div class="row m-b-20">
        <div class="col-md-12">
            <ol class="breadcrumb font-14 m-0 p-0">
                <li class="breadcrumb-item"><a href="/backoffice/tasks"><?php echo Yii::t('app','Úlohy') ?></a></li>
                <li class="breadcrumb-item active"><?php echo $task->ticketNumber . ' ' . $task->title ?></li>
            </ol>
        </div>
    </div>
    <div class="row m-b-20">
        <div class="col-md-9">
            <h4 class="card-title m-b-15 editable"><?php echo $task->title ?></h4>
            <button type="button" class="btn btn-sm btn-dark m-b-15" id="title-save"><i class="mdi mdi-content-save"></i> Save</button>
            <button type="button" class="btn btn-sm btn-secondary m-b-15" id="title-cancel"><i class="mdi mdi-close"></i> Cancel</button>

            <section class="m-b-40">
                <a class="btn btn-sm btn-secondary" href="#attachments"><i class="mdi mdi-attachment"></i> <?php echo Yii::t('app','Attachment')?></a>
                <button class="btn btn-sm btn-secondary" type="button"><i class="mdi mdi-link-variant"></i> <?php echo Yii::t('app','Link')?></button>
                <button class="btn btn-sm btn-secondary" type="button" id="log-time"><i class="mdi mdi-clock"></i> Log Time</button>
            </section>

            <h5>Description</h5>
            <section class="m-b-40">
                <form method="post">
                    <textarea id="issue-desc" cols="30" rows="10" class="form-control"><?php echo $task->summary?></textarea>
                    <button class="btn btn-sm btn-dark m-t-20" type="button" id="cnt-save"><i class="mdi mdi-content-save"></i> Save</button>
                </form>
            </section>

            <h5>Issue Links</h5>
            <ul class="m-b-15" id="issue-links">

            </ul>

            <h5>Attachments</h5>
            <ul class="m-b-15" id="attachments">
            </ul>

            <h5><?php echo Yii::t('app','Worklog'); ?></h5>
            <div class="m-b-15" id="worklogs">
                <?php
                if (count($worklogs) == 0) {
                    ?>
                    <p class="m-t-20 w-100 text-center">
                        No Work Logs are available...
                    </p>
                    <?php
                } else {
                ?>

                <?php
                }
                ?>
            </div>

            <h5>Activities</h5>

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-comments-tab" data-toggle="tab" href="#nav-comments" role="tab" aria-controls="nav-comments" aria-selected="true">Comments</a>
                    <a class="nav-item nav-link" id="nav-history-tab" data-toggle="tab" href="#nav-history" role="tab" aria-controls="nav-history" aria-selected="false">History</a>
                </div>
            </nav>
            <div class="tab-content m-b-40" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-comments" role="tabpanel" aria-labelledby="nav-comments-tab">
                    <?php
                    if (count($comments) == 0) {
                        ?>
                        <p class="m-t-20 w-100 text-center">
                            No Comments are available...
                        </p>
                        <?php
                    } else {
                        foreach ($comments as $comment) {
                        ?>
                        <div>
                            <?= $comment['summary'] ?>
                        </div>

                        <?php
                        }
                    }
                    ?>
                </div>
                <div class="tab-pane fade" id="nav-history" role="tabpanel" aria-labelledby="nav-history-tab">
                    <?php
                    if (count($history) == 0) {
                    ?>
                        <p class="m-t-20 w-100 text-center">
                            No History is available...
                        </p>
                    <?php
                    } else {
                    ?>
                    <table class="table table-sm m-t-20 table-borderless w-100 xt123">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>User</th>
                            <th>Field</th>
                            <th>Old Value</th>
                            <th>New Value</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($history as $item) {
                                ?>
                                    <tr>
                                        <td><?php echo $item['createdAt'] ?></td>
                                        <td><?php echo $item['updatedBy'] ?></td>
                                        <td><?php echo $item['field'] ?></td>
                                        <td><?php echo $item['oldValue'] ?></td>
                                        <td><?php echo $item['newValue'] ?></td>
                                    </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                        <?php
                    }
                        ?>
                </div>
            </div>
            <div id="addcomment" class="w-100 m-b-30">
                <form method="post" id="comment-form">
                    <textarea id="mymce" cols="30" rows="10" class="form-control"></textarea>
                    <button type="button" class="btn btn-sm btn-dark m-t-10" id="savecomment">Save</button>
                </form>
            </div>
            <button class="btn btn-sm btn-secondary" type="button" id="add-comment"><i class="mdi mdi-comment-outline"></i> Add comment</button>
        </div>
        <div class="col-md-3">
            <!--<h5>SLA</h5>
            <p class="m-b-15">

            </p>-->

            <h5>Stage</h5>
            <section class="m-b-15">
                <select class="form-control" id="s1">
                    <?php
                    foreach ($stages as $stage=>$title) {
                        $selected = $stage === $task->stage ? ' selected' : '';
                        echo "<option value='{$stage}'{$selected}>{$title}</option>";
                    }
                    ?>
                </select>
            </section>
            
            <h5>Priority</h5>
            <section class="m-b-15">
                <select id="s2" class="form-control dropdown">
                    <?php
                    foreach ($priorities as $priority=>$title) {
                        $selected = $priority === $task->priority ? ' selected':'';
                        echo "<option value='{$priority}'{$selected}>{$title}</option>";
                    }
                    ?>
                </select>
            </section>

            <h5>Assignee</h5>
            <section class="m-b-15">
                <select class="form-control dropdown" id="s3">
                    <?php
                    foreach ($users as $user) {
                        $selected = $user['username'] === $task->assignee ? ' selected':'';
                        echo "<option value='{$user['username']}'{$selected}>{$user['username']}</option>";
                    }
                    ?>
                </select>
            </section>

            <h5>Reporter</h5>
            <p class="m-b-15">
                <?php echo $task->reporter ?>
            </p>

            <h5>Created</h5>
            <p class="m-b-15"><?php echo $task->createdAt ?></p>
            <h5>Due Date</h5>
            <p class="m-b-15">
                <?php
                if (is_null($task->dueDate)) {
                    $hideP = " style='display: none'";
                ?>
                    <input type="datetime-local" id="dueDateSelector" class="form-control">
                <?php
                } else {
                    $hideP = '';
                }
                ?>
            <p id="p1"<?php echo $hideP ?>>
                <?php echo $task->dueDate ?>
            </p>
            </p>

            
        </div>
    </div>
</main>

<!-- worklog modal window -->
    <div class="modal fade" id="worklogModal" tabindex="-1" role="dialog" aria-labelledby="worklogModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="worklogModalLabel"><?php echo Yii::t('app','Work Log') ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="worklog-form">
                        <div id="errors">

                        </div>
                        <div class="form-group m-b-10">
                            <label for="" class="form-control-label"><?php echo Yii::t('app','Description') ?></label>
                            <textarea class="form-control lt" style="height: 150px" data-item="note"></textarea>
                        </div>
                        <div class="form-check m-b-10">
                            <input type="checkbox" class="form-check-input" id="lt-period" value="check">
                            <label class="form-check-label" for="lt-period"><?php echo Yii::t('app','Period') ?></label>
                        </div>
                        <div class="form-group m-b-10" id="lt-from">
                            <label for="" class="form-control-label"><?php echo Yii::t('app','From') ?></label>
                            <input type="datetime-local" id="" class="form-control lt" data-item="loggedDateFrom">
                        </div>
                        <div class="form-group m-b-10">
                            <label for="" class="form-control-label">
                                <?php echo Yii::t('app','Date') ?><sup style="color: red">*</sup>
                            </label>
                            <input type="datetime-local" class="form-control lt" required aria-required="true" data-label="Date" data-item="loggedDateTo">
                        </div>
                        <div class="form-group m-b-10">
                            <label for="" class="form-control-label">
                                <?php echo Yii::t('app','Worked Hours') ?><sup style="color: red">*</sup>
                            </label>
                            <input type="text" class="form-control lt" required aria-required="true" data-label="Worked Hours" data-item="workedHours">
                            <div class="small text-muted">Ex. 1h 35m, 15m,...etc.</div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo Yii::t('app','Close') ?></button>
                    <button type="button" class="btn btn-primary" id="logtime-save"><?php echo Yii::t('app','Save') ?></button>
                </div>
            </div>
        </div>
    </div>


<!-- end of worklog modal window -->

<?php

$csrf = "'" . Yii::$app->request->csrfParam ."':'". Yii::$app->request->getCsrfToken() ."'";
$js = <<<JS
    $('#add-comment').click(function(){
       $('#addcomment').show();
       $(this).hide();
    });
    
    $('#worklogModal').on('hidden.bs.modal', function (e) {
        $('#lt-period').prop('checked',false);
        $.each($('.lt'),function(k,v){
         $(v).val(''); 
        });
    });

    $('#logtime-save').click(function(){
        let hasError = false;
        let er = []; 
        let x = [];
        
        $.each($('.lt'),function(k,v){
           if ($(v).attr('required') !== undefined && $(v).val() === '') {
               hasError = true;
               let y = $(v).data('label');
               er.push(
                  '<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                  '<strong>'+y+'</strong> cannot be empty!!! <button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                  '<span aria-hidden="true">&times;</span></button></div>'  
               );
           } else {
               x.push({
                    item: $(v).data('item'), value:$(v).val()
               })
           }
        });
        if (hasError) {
            $('#errors').empty();
            $.each(er,function(k,v){
                $('#errors').append(v);
            });
            return false;
        } else {
            $.ajax({
               url: "/backoffice/tasks/log-time",
               dataType: "json",
               data: { timedata: x, ticketid: {$_GET['id']}, {$csrf} },
               type: "post"
           })
           .done(function(res){
              showMyToast(res, 'Time was written');
              $('#worklogModal').modal('hide');
           });
        }
    });
    $('#lt-period').on('click',function(){
        let x = $('#lt-from').is(':visible');
        if (x) {
            $('#lt-from').hide();
        } else {
            $('#lt-from').show();
        }
    });
    $('#log-time').click(function(){
        $('#worklogModal').modal('show');
    });
    $('#s1').change(function(){
        let x = $(this).val();
         $.ajax({
           url: "/backoffice/tasks/update-stage",
           dataType: "json",
           data: { stage: x, ticketid: {$_GET['id']}, {$csrf} },
           type: "post"
       })
       .done(function(res){
          showMyToast(res, 'Stage update done');
       });
    });

    $('#s2').change(function(){
        let x = $(this).val();
         $.ajax({
           url: "/backoffice/tasks/update-priority",
           dataType: "json",
           data: { priority: x, ticketid: {$_GET['id']}, {$csrf} },
           type: "post"
       })
       .done(function(res){
         showMyToast(res, 'Priority update done');
       });
    });
    
    $('#s3').change(function(){
        let x = $(this).val();
         $.ajax({
           url: "/backoffice/tasks/update-assignee",
           dataType: "json",
           data: { assignee: x, ticketid: {$_GET['id']}, {$csrf} },
           type: "post"
       })
       .done(function(res){
          showMyToast(res, 'Assignee update done');
       });
    });
    $('#dueDateSelector').change(function(){
       let x = $(this).val();
       $.ajax({
           url: "/backoffice/tasks/update-due-date",
           dataType: "json",
           data: { duedate: x, ticketid: {$_GET['id']}, {$csrf} },
           type: "post"
       })
       .done(function(res){
          if (res.status == 'ok') {
              // notify about the successful update
              icon = 'success';
              $('#dueDateSelector').hide();
              $('#p1').html(res.newDueDate).show();
          }
          showMyToast(res, 'Due Date update done');            
       });
    });
    $('#issue-desc').keypress(function(){
       $('#cnt-save').show(); 
    });
    $('#cnt-save').click(function(){
        let x = tinymce.activeEditor.getContent();
       $.ajax({
           url: "/backoffice/tasks/update-description",
           dataType: "json",
           data: { descr: x, ticketid: {$_GET['id']}, {$csrf} },
           type: "post"
       })
       .done(function(res){
          if (res.status == 'ok') {
              $('#cnt-save').hide();
          } 
          showMyToast(res, 'Description update done');            
       });
    });
    $('.card-title').click(function(){
       $(this).attr('contenteditable',true).addClass('contedit').removeClass('editable').removeClass('m-b-15'); 
       $('#title-save').show();
       $('#title-cancel').show();
    });
    $('#title-cancel').click(function(){
        $('.card-title').attr('contenteditable',false).removeClass('contedit');
        $('#title-save').hide();
        $(this).hide();
    });
    $('#title-save').click(function(){
        let x = $('.card-title').text();
        $.ajax({
           url: "/backoffice/tasks/update-title",
           dataType: "json",
           data: { title: x, ticketid: {$_GET['id']}, {$csrf} },
           type: "post"
       })
       .done(function(res){
          if (res.status == 'ok') {
              $('.card-title').attr('contenteditable',false).removeClass('contedit');
          } 
          showMyToast(res, 'Description update done');
          $('#title-save').hide();
          $('#title-cancel').hide();
       });
        
    });
    
    if ($("#mymce").length > 0) {
        tinymce.init({
            selector: "textarea#mymce",
            theme: "modern",
            height: 300,
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",

        });
    }
    tinymce.init({
        selector: "textarea#issue-desc",
        theme: "modern",
        height: 300,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
    });
    $('#savecomment').click(function(){
        let x = tinymce.activeEditor.getContent();
         $.ajax({
           url: "/backoffice/tasks/save-comment",
           dataType: "json",
           data: { comment: x, ticketid: {$_GET['id']}, {$csrf} },
           type: "post"
       })
       .done(function(res){
          if (res.status == 'ok') {
              $('#cnt-save').hide();
          } 
          showMyToast(res, 'Description update done');
          
       });
    });
JS;
$this->registerJS($js);