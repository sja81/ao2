<?php
use backend\assets\RealAsset;
use yii\helpers\Url;

$this->title= Yii::t('app','Užívatelia');

$this->registerCSSFile('@web/assets/node_modules/toast-master/css/jquery.toast.css',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/dist/css/pages/other-pages.css',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/datatables/datatables.min.js',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/datatables/media/css/dataTables.bootstrap4.css',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/dist/css/pages/tab-page.css',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/toast-master/js/jquery.toast.js',['depends'=>RealAsset::class]);

$confirmRemoval = Yii::t('app','Naozaj chcete zmazať?');
?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-4 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
        <div class="col-md-8 align-self-center text-right">
            <div class="btn-group">
                <button
                        type="button"
                        class="btn btn-info dropdown-toggle"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                    <i class="fas fa-plus-circle m-r-10"></i>Pridať
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="/backoffice/users/add">Užívateľa</a>
                    <a class="dropdown-item" href="/backoffice/users/add-group">Grupu</a>
                    <a class="dropdown-item" href="/backoffice/users/add-privilege">Funckiu</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="post">
                <div class="vtabs customvtab">
                    <ul class="nav nav-tabs tabs-vertical" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#userlist" role="tab">
                                <span class="hidden-sm-up"><i class="mdi mdi-account"></i></span>
                                <span class="hidden-xs-down"><?= Yii::t('app','Užívatelia') ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#usergroups" role="tab">
                                <span class="hidden-sm-up"><i class="mdi mdi-account-multiple"></i></span>
                                <span class="hidden-xs-down"><?= Yii::t('app','Groupy') ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#features" role="tab">
                                <span class="hidden-sm-up"><i class="ti-package"></i></span>
                                <span class="hidden-xs-down"><?= Yii::t('app','Funkcie') ?></span>
                            </a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="userlist" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-sm dattable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Username</th>
                                                    <th>Meno</th>
                                                    <th>Telefon</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th>Akcia</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            foreach ($userlist as $user):
                                            ?>
                                            <tr<?= $user['status'] == 0 ? " class='text-muted'" : "" ?>>
                                                <td><?= $user['id'] ?></td>
                                                <td><?= $user['username'] ?></td>
                                                <td><?= $user['name_first'].' '.$user['name_last'] ?></td>
                                                <td><?= $user['phone'] ?></td>
                                                <td><?= $user['email'] ?></td>
                                                <td>
                                                    <?php
                                                    if ($user['status'] == 10) {
                                                        echo Yii::t('app', 'aktívny');
                                                    } else {
                                                        echo Yii::t('app', 'zmazaný');
                                                    }
                                                    ?>
                                                <td>
                                                    <?php
                                                    if ($user['status'] != 0){
                                                    ?>
                                                    <a
                                                            href="<?= Url::to(['users/edit','uid'=>$user['id']]) ?>"
                                                            title="Edit"
                                                            style="color: black">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <?php
                                                    }
                                                    if ($user['status'] == 0) {
                                                    ?>
                                                        <a
                                                                href="<?= Url::to() ?>"
                                                                title="Restore"
                                                                style="color: black"
                                                        ><i class="mdi mdi-backup-restore"></i></a>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                            endforeach;
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="usergroups" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-sm dattable">
                                            <thead>
                                                <tr>
                                                    <th><?= Yii::t('app','Názov') ?></th>
                                                    <th width="50%"><?= Yii::t('app','Popis') ?></th>
                                                    <th><?= Yii::t('app','Vytvorené') ?></th>
                                                    <th><?= Yii::t('app','Akcie') ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                foreach ($usergroups as $group):
                                            ?>
                                                <tr>
                                                    <td><?= $group['name'] ?></td>
                                                    <td class="w-50"><?= $group['description'] ?></td>
                                                    <td><?= $group['created_at'] ?></td>
                                                    <td>
                                                        <a
                                                                href="<?= Url::to(['users/edit-group','name'=>$group['name']]) ?>"
                                                                title="Edit"
                                                                style="color: black">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php
                                                endforeach;
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="features" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12" style="overflow: auto">
                                    <form method="post" role="form" id="priv-form">
                                    <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">
                                    <table class="table table-sm table-striped">
                                        <thead>
                                            <tr>
                                                <th><?= Yii::t('app','Funkcia') ?></th>
                                                <?php
                                                foreach($usergroups as $group) {
                                                    echo "<th>{$group['name']}</th>";
                                                }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            foreach($privileges as $item){
                                        ?>
                                            <tr>
                                                <td>
                                                    <?= $item['name'] ?>
                                                    <a href="<?= Url::to(['edit-privilege','id'=>$item['id']]) ?>"><i class="fas fa-pencil-alt m-l-10" style="color: black"></i></a>
                                                    <!--<a href="#" onclick="removePrivilege(<?= $item['id'] ?>)"><i class="fas fa-trash-alt m-l-10" style="color: black"></i></a>-->
                                                </td>
                                                <?php

                                                foreach($usergroups as $group) {
                                                    $checked = "";
                                                    if (in_array($item['id'],$groupmatrix[$group['name']])) {
                                                        $checked = " checked";
                                                    }
                                                ?>
                                                    <td>
                                                        <input
                                                                type="checkbox"
                                                                data-priv="<?= $item['id']?>"
                                                                data-usr="0"
                                                                data-group="<?= $group['name'] ?>"
                                                                class="priv"
                                                                <?= $checked ?>
                                                        >
                                                    </td>
                                                <?php
                                                }
                                                ?>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                        </tbody>
                                    </table>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<?php

$js = <<<JS
    $(function() {
        $('.dattable').DataTable({
            order: []
        });
    });
    $(".priv").on('click',function(){
        var g = $(this).data('group'),
            p = $(this).data('priv'),
            u = $(this).data('usr'),
            c = $(this).is(':checked')?1:0;
        $.ajax({
                url: '/backoffice/users/ajax-change-privilege',
                dataType: 'json',
                method: 'post',
                data: {
                   group: g,
                   priv: p,
                   user: u,
                   status: c
                },
                success: function(r){
                    var msg = r.message, 
                        icon = '';
                    if (r.status == 'ok') {
                        icon = 'success';
                    }
                    if (r.status == 'error') {
                        icon = 'error';
                    }
                    $.toast({
                        //heading: 'Welcome to Material Pro admin',
                        text: msg,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: icon,
                        hideAfter: 2500, 
                        stack: 6
                    });
                }
            });
    });
    /*removePrivilege = function(i) {
        if (confirm('{$confirmRemoval}')) {
            $.ajax({
                url: '/backoffice/users/ajax-delete-privilege',
                dataType: 'json',
                method: 'post',
                data: {
                   
                },
                success: function(r){

                }
            });
        }
    }*/
JS;

$this->registerJS($js);

$css = <<<CSS
    .vtabs {
    width: 100%;
    }
    .tabs-vertical {
        width: 150px !important;
    }
    
CSS;
$this->registerCSS($css);
