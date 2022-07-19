<?php
use backend\assets\RealAsset;


/**
 * @var string $title
 * @var $groups
 * @var $list
 */

$this->title = $title;

$this->registerJSFile('@web/assets/node_modules/datatables/datatables.min.js',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/moment/moment.js',['depends'=>RealAsset::class]);

$this->registerJSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.full.min.js',['depends'=>RealAsset::class]);
$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css',['depends'=>RealAsset::class]);
$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css',['depends'=>RealAsset::class]);

$this->registerJSFile('@web/assets/node_modules/bootstrap-daterangepicker/daterangepicker.js',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/datatables/media/css/dataTables.bootstrap4.css',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/bootstrap-daterangepicker/daterangepicker.css',['depends'=>RealAsset::class]);


?>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <button class="btn btn-success text-white" type="button" id="addatt">
                <i class="fas fa-plus-circle"></i> <?= Yii::t('app','Pridať dochádzku') ?>
            </button>
            <a href="/backoffice/user-attendance-admin/documents">
                <button class="btn btn-info text-white" type="button">
                        <?= Yii::t('app','Dokumenty') ?>
                </button>
            </a>
        </div>
    </div>



    <div class="row m-t-15">
        <div class="col-12">
            <div class="card rounded-5 card-shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <label class="control-label"><?= Yii::t('app','Skupiny') ?></label>
                            <select id="groupSelect" class="form-select">
                                <option value=""><?= Yii::t('app','Zvoľte si skupinu'); ?></option>
                                <?php foreach($groups as $group){ ?>
                                    <option value="<?php echo $group['name'] ?>"><?php echo "{$group['name']} - {$group['description']}" ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label class="control-label"><?= Yii::t('app','Obdobie') ?></label>
                            <div class='input-group'>
                                <input type='text' class="form-control daterange" id="dateSelect"/>
                                <span class="input-group-text">
                                    <span class="ti-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card rounded-5 card-shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm dattable" id="ip01">
                            <thead>
                            <tr>
                                <th><?= Yii::t('app','Skupina'); ?></th>
                                <th><?= Yii::t('app','Meno'); ?></th>
                                <th><?= Yii::t('app','Dátum'); ?></th>
                                <th><?= Yii::t('app','Príchod'); ?></th>
                                <th><?= Yii::t('app','Odchod'); ?></th>
                                <th><?= Yii::t('app','Odpracované'); ?></th>
                                <th><?= Yii::t('app','Typ'); ?></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?=
                                $this->render('tablebody', ['list'=>$list])
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= Yii::t('app','Nová dochádzka'); ?></h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="control-label"><?= Yii::t('app','Meno'); ?></label>
                            <select id="uaid" class="form-control js-item">
                                <option value=""><?= Yii::t('app','Zvoľte meno'); ?></option>
                                <?php
                                /**
                                 * @var $modal_users
                                 */
                                foreach($modal_users as $item){
                                    echo "<option value='{$item['id']}'>{$item['meno']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="control-label"><?= Yii::t('app','Dátum'); ?></label>
                            <input type="date" id="uadate" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="control-label"><?= Yii::t('app','Typ'); ?></label>
                            <select id="uatype" class="form-select">
                                <option value=""><?= Yii::t('app','Zvoľte typ dochádzky'); ?></option>
                                <?php
                                for($i=1; $i <= 5; $i++) {
                                    ?>
                                    <option value="<?= $i ?>"><?= \common\models\users\UserAttendance::workType($i) ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="control-label"><?= Yii::t('app','Čas príchodu'); ?></label>
                            <input type="time" id="intime" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="control-label"><?= Yii::t('app','Čas odchodu'); ?></label>
                            <input type="time" id="outtime" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label"><?= Yii::t('app','Poznámka'); ?></label>
                            <textarea id="uanote" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= Yii::t('app','Zatvoriť'); ?></button>
                <button type="button" class="btn btn-primary text-white" id="uasave"><?= Yii::t('app','Uložiť'); ?></button>
            </div>
        </div>
    </div>
</div>

<?php 
$csrf = "'" . Yii::$app->request->csrfParam ."':'". Yii::$app->request->getCsrfToken() ."'";

$js = <<<JS
    $('.js-item').select2({
        theme: "bootstrap",
        dropdownParent: $('#exampleModal .modal-body')
    });

    $('#addatt').click(function(){
        $('#exampleModal').modal('show');
    });
    
    $('#uasave').click(function(){
         let uaid = $('#uaid').val();
         let uadate = $('#uadate').val();
         let uatype = $('#uatype').val();
         let intime = $('#intime').val();
         let outtime = $('#outtime').val();
         let uanote = $('#uanote').val();
         $.ajax({
            url: "/backoffice/user-attendance-admin/save-attendance",
            dataType: "json",
            data: { 
                uid: uaid, 
                uadate: uadate,
                uatype: uatype,
                intime: intime,
                outtime: outtime, 
                uanote: uanote,
                {$csrf} 
            },
            type: "post"
        })
        .done(function(res){
            if (res.status == 'error') {
                 alert(res.message);
            } 
            else {
                $('#ip01').DataTable().destroy();
                $('#ip01').find('tbody').empty().append(res.tbody);
                $('#ip01').DataTable().draw();
                $('#exampleModal').modal('hide');
                $('#uaid').val('');
                $('#uadate').val('');
                $('#uatype').val('');
                $('#intime').val('');
                $('#outtime').val('');
                $('#uanote').val('');
                $('.js-item').val('').trigger('change');
             }
        });
    });

    $('.dattable').DataTable({ order: [] });
    $('.daterange').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });
    $('.daterange').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY.MM.DD') + ' - ' + picker.endDate.format('YYYY.MM.DD'));
    });
    $('.daterange').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
    
    reloadTableata = function(g,sd,ed) {
        $.ajax({
            url: "/backoffice/user-attendance-admin/list-users",
            dataType: "json",
            data: { group: g, sdate: sd, edate: ed, {$csrf} },
            type: "post"
        })
        .done(function(res){
            if (res.status == 'error') {
                 alert(res.message);
            } 
            else {
                $('#ip01').DataTable().destroy();
                $('#ip01').find('tbody').empty().append(res.tbody);
                $('#ip01').DataTable().draw();
             }
        });
    }
    
    $('#dateSelect').on('apply.daterangepicker',function(ev,picker){
        let g = $('#groupSelect').val();
        let sd = picker.startDate.format('YYYY-MM-DD');
        let ed = picker.endDate.format('YYYY-MM-DD')
        reloadTableata(g,sd,ed);
    });

    $("#groupSelect").change(function(){
        let g = $(this).val();
        let d = $('#dateSelect').val().split(" - ");
        let sd = '';
        let ed = '';
        if (2 == d.length) {
            sd = d[0].replace(".","-");
            ed = d[1].replace(".","-");
        }
        reloadTableata(g, sd, ed);
    });
JS;
$this->registerJS($js);

$css = <<<CSS
.rounded-5 {
    border-radius: .5em!important;
}
.card-shadow {
    box-shadow: lightgrey 3px 3px;
}
CSS;
$this->registerCSS($css);



