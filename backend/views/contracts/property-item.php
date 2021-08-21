<?php
use common\models\Zmluva;
use yii\helpers\Url;
use backend\helpers\HelpersNum;
?>
<div class="col-lg-3 col-md-6">
    <div class="card">
        <img class="card-img-top" src="<?= Yii::getAlias('@web')?>/assets/images/property/prop1.jpeg" alt="Card image cap">
        <div class="card-img-overlay set-height-70">
            <div style="float:left">
                <?php
                foreach($contract['ucel'] as $item) {
                    echo "<span class='badge badge-dark badge-pill'>{$item['name']}</span>";
                    if (count($contract['ucel'])>1) echo "<br>";
                }
                ?>
            </div>
            <div style="float:left">
                <?php
                $badgeClass = "danger";
                $badgeText = Yii::t('app',"Čaká na schválenie...");
                if ($contract['status'] == Zmluva::ACTIVE) {
                    $badgeClass = 'success';
                    $badgeText = Yii::t('app',"Aktívny...");
                }
                if ($contract['status'] == Zmluva::APPROVED) {
                    $badgeClass = 'danger';
                    $badgeText = Yii::t('app',"Čaká na aktiváciu...");
                }
                ?>
                <span class="badge badge-<?= $badgeClass ?> badge-pill"><?= $badgeText ?></span>
            </div>
        </div>
        <div class="card-body bg-light">
            <!--<h6 class="card-title">ID:&nbsp;<?= $contract['cislo'] ?></h6>-->
            <h6 class="card-title">
                <?= $contract['ulica'] != '' ? "{$contract['ulica']}, " : '' ?> <?= $contract['mesto'] ?>
            </h6>
            <?php
            foreacH($contract['cena'] as $it) {
            ?>
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <span class="text-primary"><?= HelpersNum::moneyFormat($it['cena']) ?> &euro;</span>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="card-body border-top">
            <div class="d-flex no-block align-items-center">
                <span><img src="<?= Yii::getAlias('@web')?>/assets/images/property/pro-bath.png"></span>
                <span class="p-10 text-muted">Počet kúpelní</span>
                <span class="ml-auto badge badge-pill badge-secondary pull-right"><?= $contract['pocet_kupelna'] ?></span>
            </div>
            <div class="d-flex no-block align-items-center">
                <span><img src="<?= Yii::getAlias('@web')?>/assets/images/property/pro-bed.png"></span>
                <span class="p-10 text-muted">Počet izieb</span>
                <span class="ml-auto badge badge-pill badge-secondary pull-right">
                    <?= $contract['pocet_miestnosti'] ?>
                </span>
            </div>
            <?php
            if ($contract['pocet_garaz'] > 0) {
                ?>
                <div class="d-flex no-block align-items-center">
                    <span><img src="<?= Yii::getAlias('@web') ?>/assets/images/property/pro-garage.png"></span>
                    <span class="p-10 text-muted">Počet garáži</span>
                    <span class="ml-auto badge badge-pill badge-secondary pull-right">
                        <?= $contract['pocet_garaz'] ?>
                    </span>
                </div>
                <?php
            }
            ?>
            <?php
            if ($contract['garazove_statie'] > 0) {
                ?>
                <div class="d-flex no-block align-items-center">
                    <span><img src="<?= Yii::getAlias('@web') ?>/assets/images/property/pro-garage.png"></span>
                    <span class="p-10 text-muted">Počet garážových státi</span>
                    <span class="ml-auto badge badge-pill badge-secondary pull-right">
                        <?= $contract['garazove_statie'] ?>
                    </span>
                </div>
                <?php
            }
            ?>
            <?php
            if ($contract['parkovanie'] > 0) {
                ?>
                <div class="d-flex no-block align-items-center">
                    <span><img src="<?= Yii::getAlias('@web') ?>/assets/images/property/pro-garage.png"></span>
                    <span class="p-10 text-muted">Počet parkovacích miest</span>
                    <span class="ml-auto badge badge-pill badge-secondary pull-right">
                        <?= $contract['parkovanie'] ?>
                    </span>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="card-body border-top">
            <div class="d-flex no-block align-items-center">
                <a href="javascript:void(0) " class="m-r-15"><img alt="img " class="thumb-md img-circle " src="<?= Yii::getAlias('@web')?>/assets/images/users/agent2.jpg "></a>
                <div>
                    <h5 class="card-title m-b-0"><?= $contract['agent_name'] ?></h5>
                </div>
            </div>
        </div>
        <div class="card-body border-top">
                <?php
                if ($vyhladavanie):
                ?>
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <button class="btn btn-success" onclick="view_it(<?= $contract['id'] ?>)"><i class="fa fa-eye"></i></button>
                    </div>
                </div>
                <?php
                else:
                    $showApprove = true;
                    $showOnOff = false;
                    if($contract['status'] == Zmluva::PENDING) {
                        $showApprove = false;
                        $showOnOff = true;
                    }
                ?>
                <div class="row">
                    <div class="col-md-3 col-xs-3 text-center">
                        <button class="btn btn-secondary" onclick="view_it(<?= $contract['id'] ?>)">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                    <div class="col-md-3 col-xs-3 text-center">
                        <button
                                class="btn btn-secondary<?= $showApprove ? ' hide' : '' ?>"
                                id="btn-approve-<?= $contract['id'] ?>"
                                title="Potvrď"
                                onclick="approve_it(<?= $contract['id'] ?>)"><i class="fas fa-thumbs-up"></i></button>
                    </div>

                    <div class="col-md-3 col-xs-3 text-center">
                        <button class="btn btn-secondary" onclick="edit_it(<?= $contract['id'] ?>)">
                            <i class="fa fa-pencil-alt"></i></button>
                    </div>
                    <div class="col-md-3 col-xs-3 text-center">
                        <button class="btn btn-secondary"><i class="far fa-trash-alt"></i></button>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-6 col-xs-6">
                        <div class="btn-group w-100">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?= Yii::t('app','Média'); ?>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#"><?= Yii::t('app','Obrázky'); ?></a>
                                <a class="dropdown-item" href="#"><?= Yii::t('app','Videá'); ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="btn-group w-100">
                            <button
                                    type="button"
                                    class="btn btn-secondary dropdown-toggle"
                                    data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"
                                    style="font-size: 0.84rem"
                            >
                                <?= Yii::t('app','Dokumenty'); ?>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?= Url::to(['/contracts/edit-documents','id'=>$contract['id']]) ?>"><?= Yii::t('app','Zoznam'); ?></a>
                                <a class="dropdown-item" href="<?= Url::to(['/contracts/obhliadky','id'=>$contract['id']])?>"><?= Yii::t('app','Obhliadky'); ?></a>
                                <!--<a class="dropdown-item" href="<?= Url::to(['/contracts/accept-protocol','id'=>$contract['id']])?>"><?= Yii::t('app','Preberací protokol'); ?></a>-->
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                endif;
                ?>





        </div>
    </div>
</div>
<?php



?>
