<?php
/**
 * @var array $privileges
 * @var array $myprivileges
 */

use backend\assets\RealAsset;
use yii\helpers\Url;
$this->title= Yii::t('app','Zmeniť užívateľa');
$this->registerCSSFile('@web/assets/dist/css/pages/tab-page.css',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/js/users.js',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/select2/dist/js/select2.full.min.js',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/bootstrap-select/bootstrap-select.min.js',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/select2/dist/css/select2.min.css',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/bootstrap-select/bootstrap-select.min.css',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/dist/css/style.min.css',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/toast-master/css/jquery.toast.css',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/dist/css/pages/other-pages.css',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/toast-master/js/jquery.toast.js',['depends'=>RealAsset::class]);

$errorUserNameNeeded = Yii::t('app','Vyplňte užívateľské meno. Minimálna dĺžka je 3 znaky!');
$errorTooShortPassword = Yii::t('app','Heslo je príliž krátke. Minimálna dĺžka je 5 znakov!');
$errorPasswordNotMatch = Yii::t('app','Heslá sa nezhodujú!');
$errorPhone = Yii::t('app','Neplatné telefónne číslo!');
$errorEmail = Yii::t('app','Neplatný email! ');

?>
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-12 col-xs-12 align-self-center">
                <h4 class="text-themecolor"><?= $this->title ?></h4>
            </div>
        </div>
        <form method="post" role="form" id="user-reg">
        <div class="card">
            <div class="card-body">

                    <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">
                    <div class="vtabs customvtab">
                        <ul class="nav nav-tabs tabs-vertical" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#userdetails" role="tab">
                                    <span class="hidden-sm-up"><i class="mdi mdi-account"></i></span>
                                    <span class="hidden-xs-down"><?= Yii::t('app','Základné údaje') ?></span>
                                    <span class="badge badge-xs badge-danger" id="bdg-details">0</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#accesses" role="tab">
                                    <span class="hidden-sm-up"><i class="ti-package"></i></span>
                                    <span class="hidden-xs-down"><?= Yii::t('app','Prístupy') ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#job" class="nav-link" data-toggle="tab" role="tab">
                                    <span class="hidden-sm-up"><i class="ti-alarm-clock"></i></span>
                                    <span class="hidden-xs-down"><?= Yii::t('app','Pracovný fond'); ?></span>
                                </a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="userdetails" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12 col-xs-12 form-group">
                                        <label class="control-label"><?= Yii::t('app','Používateľské meno') ?></label>
                                        <input
                                                type="text"
                                                class="form-control"
                                                name="User[username]"
                                                value="<?= $user->username ?>"
                                                id="inp-username" required
                                        >
                                        <small class="form-control-feedback"></small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-xs-6 form-group">
                                        <label for="pass" class="control-label"><?= Yii::t('app','Heslo') ?></label>
                                        <input type="password" name="User[password]" class="form-control" id="pass">
                                        <small class="form-control-feedback"></small>
                                    </div>
                                    <div class="col-md-6 col-xs-6 form-group">
                                        <label for="" class="control-label"><?= Yii::t('app','Zopakovat heslo') ?></label>
                                        <input type="password" name="User[password_control]" id="pass-test" class="form-control">
                                        <small class="form-control-feedback"></small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-xs-6 form-group">
                                        <label class="control-label"><?= Yii::t('app','Meno') ?></label>
                                        <input type="text" class="form-control" name="User[name_first]" value="<?= $agent[0]['name_first'] ?>">
                                    </div>
                                    <div class="col-md-6 col-xs-6 form-group">
                                        <label class="control-label"><?= Yii::t('app','Priezvisko') ?></label>
                                        <input type="text" name="User[name_last]" class="form-control" value="<?= $agent[0]['name_last'] ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-xs-6 form-group">
                                        <label class="control-label"><?= Yii::t('app','Telefón') ?></label>
                                        <input type="text" name="User[phone]" value="<?= $agent[0]['phone'] ?>" class="form-control" id="inp-phone" required>
                                        <small class="form-control-feedback"></small>
                                    </div>
                                    <div class="col-md-6 col-xs-6 form-group">
                                        <label class="control-label"><?= Yii::t('app','Email') ?></label>
                                        <input type="text" name="User[email]" value="<?= $agent[0]['email'] ?>" class="form-control" id="inp-email" required>
                                        <small class="form-control-feedback"></small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label class="control-label"><?= Yii::t('app','Grupa') ?></label>
                                        <select name="User[auth_assignment]" id="inp-group" class="form-control">
                                            <option value="">Vyberte si...</option>
                                            <?php
                                            foreach($usergroups as $group){
                                                $selected = $group['name'] == $mygroup ? " selected" : "";
                                                ?>
                                                <option value="<?= $group['name']?>"<?= $selected ?>><?= $group['name']?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" id="inp-commission">
                                    <div class="col-md-12">
                                        <label class="control-label m-t-10 m-b-10"><?= Yii::t('app','Provízia') ?></label>
                                        <table class="table-sm table-striped table-hover w-100 table-bordered">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?= Yii::t('app','Tržba od') ?></th>
                                                <th><?= Yii::t('app','Tržba do') ?></th>
                                                <th><?= Yii::t('app','Percento z predaja') ?></th>
                                                <th><?= Yii::t('app','Percento z kúpy') ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            foreach($commissions as $item) {
                                                ?>
                                                <tr>
                                                    <td><input type="radio" name="User[commission]" value="<?= $item['id'] ?>"></td>
                                                    <td><?= $item['trzba_od'] ?></td>
                                                    <td><?= $item['trzba_do'] ?></td>
                                                    <td><?= $item['predavajuci_percento'] ?></td>
                                                    <td><?= $item['kupujuci_percento'] ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php
                                    $myOffices = [];
                                    foreach($agent as $item) {
                                        $myOffices[] = $item->office_id;
                                    }
                                    ?>
                                    <div class="col-md-12 form-group">
                                        <label class="control-label"><?= Yii::t('app','Kancelárie') ?></label>
                                        <select name="User[office_id][]" class="select2 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Choose">
                                            <option value="">Vyberte si...</option>
                                            <?php
                                            foreach($offices as $office){
                                                $selected = in_array($office['id'],$myOffices) ? " selected" : "";
                                                ?>
                                                <option value="<?= $office['id']?>"<?= $selected?>><?= $office['name']?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="accesses" role="tabpanel">
                                <form method="post" role="form" id="priv-form">
                                    <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">
                                    <table class="table table-sm table-striped">
                                        <thead>
                                        <tr>
                                            <th><?= Yii::t('app','Funkcia') ?></th>
                                            <th><?= $mygroup ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach($privileges as $item){
                                            $checked = "";
                                            if (!empty($myprivileges) && in_array($item['id'],$myprivileges[$mygroup])) {
                                                $checked = " checked";
                                            }
                                        ?>
                                            <tr>
                                                <td><?= $item['name'] ?></td>
                                                <td>
                                                    <input
                                                            type="checkbox"
                                                            data-priv="<?= $item['id']?>"
                                                            data-usr="<?= $user->id ?>"
                                                            data-group="<?= $mygroup ?>"
                                                            class="priv"
                                                        <?= $checked ?>
                                                    >
                                                </td>
                                            </tr>

                                        <?php
                                        }?>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                            <div class="tab-pane" id="job" role="tabpanel">
                                <diw class="row">
                                    <div class="col-xs-12 form-group">
                                        <label class="control-label">
                                            <?= Yii::t('app','Forma zamestnania'); ?>
                                        </label>
                                        <select name="User[workType]" class="form-select form-control">
                                            <option value=""><?= Yii::t('app','Zvoľte formu zamestnania'); ?></option>
                                        </select>
                                    </div>
                                </diw>
                                <div class="row">
                                    <div class="col-xs-12 form-group">
                                        <label class="control-label">
                                            <?= Yii::t('app','Pracovné hodiny [hod]'); ?>
                                        </label>
                                        <input
                                                type="text"
                                                name="User[basicWorktime]"
                                                class="form-control"
                                                placeholder="0,00"
                                                value="<?php
                                                    echo !empty($user->workDetails->basicWorktime) ?
                                                            str_replace(".",",",$user->workDetails->basicWorktime) : "0,00"
                                                ?>"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="row m-t-30">
                    <div class="col-xs-12 col-md-9 offset-2">
                        <button type="submit" class="btn btn-success mr-1 text-white">
                            <i class="mdi mdi-content-save m-r-5"></i><?= Yii::t('app','Uložiť') ?>
                        </button>
                        <a class="btn btn-danger text-white" href="<?= Url::to(['/users']) ?>">
                            <i class="mdi mdi-step-backward m-r-5"></i><?= Yii::t('app','Späť') ?>
                        </a>
                    </div>
                </div>

            </div>
        </div>
        </form>

    </div>

<?php

$js = <<<JS
    $(".select2").select2();
    
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

    $('#inp-username').on('blur',function(){
        if ($(this).val().length>3) {
            removeErrorMessage($(this),$('#bdg-details'));
        } else {
            addErrorMessage($('#user-reg'),$(this),$('#bdg-details'),'{$errorUserNameNeeded}');
        }
    });
    
    $('#pass').on('blur',function(){
       if ($(this).val().length < 5) {
           addErrorMessage($('#user-reg'),$(this),$('#bdg-details'),'{$errorTooShortPassword}');
       } else {
           removeErrorMessage($(this),$('#bdg-details'));
       }
    });
    
    $('#pass-test').on('blur',function(){
        var pass_ok = $('#pass').val() === $(this).val();
        if ($(this).val().length < 5) {
            addErrorMessage($('#user-reg'),$(this),$('#bdg-details'),'{$errorTooShortPassword}');
        } else if ($(this).val().length >= 5 && pass_ok) {
            removeErrorMessage($(this),$('#bdg-details'));
        } else if (!pass_ok) {
            addErrorMessage($('#user-reg'),$(this),$('#bdg-details'),'{$errorPasswordNotMatch}');   
        }
    });
    
    $('#inp-phone').on('blur',function(){
        if ($(this).val().length < 5) {
            addErrorMessage($('#user-reg'),$(this),$('#bdg-details'),'{$errorPhone}');
        } else {
            removeErrorMessage($(this),$('#bdg-details'));
        }
    });
    
     $('#inp-email').on('blur',function(){
        if ($(this).val().length == 0) {
            addErrorMessage($('#user-reg'),$(this),$('#bdg-details'),'{$errorEmail}');
        } else {
            removeErrorMessage($(this),$('#bdg-details'));
        }
    });
     
    $('#inp-group').on('change',function(){
        if ($(this).val() == 'makler') {
            $('#inp-commission').show();
        } else {
            $('#inp-commission').hide();
        }
        
    });
JS;

$this->registerJS($js);

$css = <<<CSS
    .vtabs {
        width: 100%;
    }
    .tabs-vertical {
        width: 200px !important;
    }
    #inp-commission {
        display: none;
    }
    
CSS;
$this->registerCSS($css);