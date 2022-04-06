<?php
$this->title = Yii::t('app','Môj profil');
$csrfParam = Yii::$app->request->csrfParam;
$csrfToken = Yii::$app->request->getCsrfToken();
?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>

    <?= \common\widgets\AoAlerts::widget() ?>

   <div class="row">
       <div class="col-lg-4 col-xlg-3 col-md-5">
           <div class="card">
               <div class="card-body">
                   <div class="row m-t-30">
                       <div class="col-md-12 text-center">
                           <?php
                           $pic = $user->identity->getProfilePicture();
                           ?>
                           <img
                                   src="<?= $pic ?> "
                                   class="img-circle"
                                   width="150">
                           <h4 class="card-title m-t-30"><?= $agent->getFullName() ?></h4>
                           <h6 class="card-subtitle">-</h6>
                       </div>
                   </div>
               </div>
               <hr>
               <div class="card-body"> <small class="text-muted"><?= Yii::t('app','Email'); ?></small>
                   <h6><?= $agent->email ?></h6>
                   <small class="text-muted p-t-30 db"><?= Yii::t('app','Telefón') ?></small>
                   <h6><?= $agent->phone ?></h6>
                   <small class="text-muted p-t-30 db"><?= Yii::t('app','Adresa') ?></small>
                   <h6><?= $agent->getFullAddress() ?></h6>
                   <p class="text-muted p-t-30 db small"><?= Yii::t('app','Sociálne siete') ?></p>

                   <?php
                   if ($userDetails && $userDetails->facebook != '') {
                   ?>
                   <a class="btn btn-circle btn-secondary" href="<?= $userDetails->facebook?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                   <?php
                   }
                   if ($userDetails && $userDetails->linkedin != '') {
                   ?>
                   <a class="btn btn-circle btn-secondary" href="#"><i class="fab fa-linkedin"></i></a>
                   <?php
                   }
                   if ($userDetails && $userDetails->twitter != '') {
                   ?>
                   <a class="btn btn-circle btn-secondary" href="#"><i class="fab fa-twitter"></i></a>
                   <?php
                   }
                   if ($userDetails && $userDetails->youtube != '') {
                   ?>
                   <a class="btn btn-circle btn-secondary" href="#"><i class="fab fa-youtube"></i></a>
                   <?php
                   }
                   if ($userDetails && $userDetails->youtube != '') {
                   ?>
                   <a class="btn btn-circle btn-secondary" href="#"><i class="fab fa-instagram"></i></a>
                   <?php
                   }
                   ?>
               </div>
           </div>
       </div>
       <div class="col-lg-8 col-xlg-9 col-md-7">
           <div class="card">
               <!-- Nav tabs -->
               <ul class="nav nav-tabs profile-tab" role="tablist">
                   <!--<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#bio" role="tab">Bio</a> </li>
                   <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#skills" role="tab"><?= Yii::t('app','Zručnosti') ?></a> </li>-->
                   <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#settings" role="tab"><?= Yii::t('app','Nastavenia') ?></a> </li>
               </ul>
               <div class="tab-content">
                   <!--<div class="tab-pane active" id="bio" role="tabpanel">
                       <div class="card-body">
                           <p class="m-t-30">BIO</p>
                       </div>
                   </div>-->
                   <!--<div class="tab-pane" id="skills" role="tabpanel">
                       <div class="card-body">...</div>
                   </div>-->
                   <div class="tab-pane active" id="settings" role="tabpanel">
                       <div class="card-body">
                           <form class="form-horizontal" method="post">
                               <input type="hidden" name="<?= $csrfParam ?>" value="<?= $csrfToken ?>">
                               <input type="hidden" name="toupdate" value="profile">
                               <input type="hidden" name="userid" value="<?= $userId?>">
                               <h4 class="m-t-20 m-b-20 card-title"><?= Yii::t('app','Kontakt'); ?></h4>
                               <div class="form-group">
                                   <label class="form-label"><?= Yii::t('app','Meno') ?></label>
                                   <div class="input-group">
                                       <span class="input-group-text"><i class="ti-user"></i></span>
                                       <input type="text" class="form-control" value="<?= $agent->name_first ?>" name="name_first">
                                   </div>
                               </div>
                               <div class="form-group">
                                   <label class="form-label"><?= Yii::t('app','Priezvisko') ?></label>
                                   <div class="input-group">
                                       <span class="input-group-text"><i class="ti-user"></i></span>
                                       <input type="text" class="form-control" value="<?= $agent->name_last ?>" name="name_last">
                                   </div>
                               </div>
                               <div class="form-group">
                                   <label class="form-label"><?= Yii::t('app','Email') ?></label>
                                   <div class="input-group">
                                       <span class="input-group-text"><i class="ti-email"></i></span>
                                       <input type="email" class="form-control" name="email" value="<?= $agent->email ?>">
                                   </div>
                               </div>
                               <div class="form-group">
                                   <label class="form-label"><?= Yii::t('app','Mobil') ?></label>
                                   <div class="input-group">
                                       <span class="input-group-text"><i class="ti-mobile"></i></span>
                                       <input type="text" class="form-control" name="phone" value="<?= $agent->phone?>">
                                   </div>
                               </div>
                               <h4 class="m-t-40 m-b-20 card-title"><?= Yii::t('app','Sociálne siete'); ?></h4>
                               <div class="form-group">
                                   <label class="form-label"><?= Yii::t('app','Facebook') ?></label>
                                   <div class="input-group">
                                       <span class="input-group-text"><i class="ti-facebook"></i></span>
                                       <input type="text" name="facebook" class="form-control" value="<?= !is_null($userDetails) ? $userDetails->facebook : '' ?>">
                                   </div>
                               </div>
                               <div class="form-group">
                                   <label class="form-label"><?= Yii::t('app','Linkedin') ?></label>
                                   <div class="input-group">
                                       <span class="input-group-text"><i class="ti-linkedin"></i></span>
                                       <input type="text" class="form-control" name="linkedin" value="<?= !is_null($userDetails) ? $userDetails->linkedin : '' ?>">
                                   </div>
                               </div>
                               <div class="form-group">
                                   <label class="form-label"><?= Yii::t('app','Twitter') ?></label>
                                   <div class="input-group">
                                       <span class="input-group-text"><i class="ti-twitter"></i></span>
                                       <input type="text" class="form-control" name="twitter" value="<?= !is_null($userDetails) ? $userDetails->twitter : '' ?>">
                                   </div>
                               </div>
                               <div class="form-group">
                                   <label class="form-label"><?= Yii::t('app','Youtube') ?></label>
                                   <div class="input-group">
                                       <span class="input-group-text"><i class="ti-youtube"></i></span>
                                       <input type="text" class="form-control" name="youtube" value="<?= !is_null($userDetails) ? $userDetails->youtube : '' ?>">
                                   </div>
                               </div>
                               <div class="form-group">
                                   <label class="form-label"><?= Yii::t('app','Instagram') ?></label>
                                   <div class="input-group">
                                       <span class="input-group-text"><i class="ti-instagram"></i></span>
                                       <input type="text" class="form-control" name="instagram" value="<?= !is_null($userDetails) ? $userDetails->instagram : '' ?>">
                                   </div>
                               </div>
                               <div class="form-group">
                                   <button class="btn btn-dark text-white"><i class="ti-save m-r-10"></i><?= Yii::t('app','Uložiť profil') ?></button>
                               </div>
                           </form>
                           <form class="form-horizontal m-t-40" method="post" id="pass-form">
                               <input type="hidden" name="<?= $csrfParam ?>" value="<?= $csrfToken ?>">
                               <input type="hidden" name="toupdate" value="password">
                               <input type="hidden" name="userid" value="<?= $userId?>">
                               <h4 class="m-t-40 m-b-20 card-title"><?= Yii::t('app','Nastavenie hesla'); ?></h4>
                               <div class="form-group">
                                   <label class="form-label"><?= Yii::t('app','Heslo') ?></label>
                                   <div class="input-group" id="show_hide_password_1">
                                       <span class="input-group-text"><i class="ti-lock"></i></span>
                                       <input type="password" class="form-control" name="password">
                                       <span class="input-group-text">
                                           <a href="#"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                       </span>
                                   </div>
                               </div>
                               <div class="form-group">
                                   <label class="form-label"><?= Yii::t('app','Potvrdiť heslo') ?></label>
                                   <div class="input-group" id="show_hide_password_2">
                                       <span class="input-group-text"><i class="ti-lock"></i></span>
                                       <input type="password" class="form-control" name="repassword">
                                       <span class="input-group-text">
                                           <a href="#"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                       </span>
                                   </div>
                               </div>
                               <div class="form-group">
                                   <button class="btn btn-dark text-white"><i class="ti-save m-r-10"></i><?= Yii::t('app','Uložiť heslo') ?></button>
                               </div>
                           </form>
                           <form class="form-horizontal m-t-40" method="post" enctype="multipart/form-data">
                               <input type="hidden" name="<?= $csrfParam ?>" value="<?= $csrfToken ?>">
                               <input type="hidden" name="toupdate" value="pic">
                               <input type="hidden" name="userid" value="<?= $userId?>">
                               <h4 class="m-t-40 m-b-20 card-title"><?= Yii::t('app','Nastavenie profilovej fotky'); ?></h4>
                               <div class="form-group">
                                   <label class="form-label"><?= Yii::t('app','Profilová fotka') ?></label>
                                   <div class="input-group">
                                       <input type="file" name="profilePic" class="form-control">
                                   </div>
                               </div>
                               <div class="form-group">
                                   <button class="btn btn-dark text-white"><i class="ti-save m-r-10"></i><?= Yii::t('app','Uložiť fotku') ?></button>
                               </div>
                           </form>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>

</div>

<?php

$js = <<<JS

    showHidePassword = function (e) {
        if($(e + ' input').attr("type") == "text"){
            $(e + ' input').attr('type', 'password');
            $(e + ' i').addClass( "fa-eye-slash" );
            $(e + ' i').removeClass( "fa-eye" );
        }else if($(e + ' input').attr("type") == "password"){
            $(e + ' input').attr('type', 'text');
            $(e + ' i').removeClass( "fa-eye-slash" );
            $(e + ' i').addClass( "fa-eye" );
        }
    }  

    $("#show_hide_password_1 a").on('click', function(event) {
        event.preventDefault();
        showHidePassword('#show_hide_password_1');
    });

    $("#show_hide_password_2 a").on('click', function(event) {
        event.preventDefault();
        showHidePassword('#show_hide_password_2');
    });
JS;

$this->registerJS($js);