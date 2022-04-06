<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
$this->title = Yii::t('app','Zmeniť údaje');

/** @var array $offers */
/** @var array $countries */

?>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 col-xs-12 col-lg-3 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>
    <?php
    $form = ActiveForm::begin();
    foreach ($offers as $id => $offer) { ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="card rounded-5 card-shadow">
                    <div class="card-body">
                        <h4 class="card-title mb-4"><?= Yii::t('app','Majiteľ č.'); ?> <?= $id + 1 ?></h4>
                        <h6 class="card-subtitle mt-2"><?= Yii::t('app','Osobné údaje'); ?></h6>
                        <hr class="m-b-30">
                        <div class="row">
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Meno') ?></label>
                                <input type="text" class="form-control" name="Data[<?= $offer['id']; ?>][name]" value="<?= $offer['name'] ?>">
                            </div>
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Priezvisko') ?></label>
                                <input type="text" class="form-control" name="Data[<?= $offer['id']; ?>][lastName]" value="<?= $offer['lastName'] ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app','Meno za slobodna'); ?></label>
                                <input type="text" class="form-control" name="Data[<?= $offer['id'] ?>][maidenName]" value="<?= $offer['maidenName'] ?>">
                            </div>
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Dátum narodenia') ?></label>
                                <input type="date" class="form-control" name="Data[<?= $offer['id']; ?>][birthDate]" value="<?= $offer['birthDate'] ?>">
                            </div>
                        </div>
                        <h6 class="card-subtitle mt-3"><?= Yii::t('app','Kontaktné údaje'); ?></h6>
                        <hr class="m-b-30">
                        <div class="row mt-4">
                            <div class="col-md-12 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Ulica') ?></label>
                                <input type="text" class="form-control" name="Data[<?= $offer['id']; ?>][ownerAddress]" value=" <?= $offer['ownerAddress'] ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Mesto') ?></label>
                                <input type="text" class="form-control" name="Data[<?= $offer['id']; ?>][ownerTown]" value="<?= $offer['ownerTown'] ?>">
                            </div>
                            <div class="col-md-4 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app','PSČ'); ?></label>
                                <input type="text" class="form-control" name="Data[<?= $offer['id'] ?>][ownerZip]" value="<?= $offer['ownerZip'] ?>">
                            </div>
                            <div class="col-md-4 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app','Krajina'); ?></label>
                                <select name="Data[<?= $offer['id'] ?>][ownerCountry]" class="form-control form-select">
                                    <option value=""><?= Yii::t('app','Zvoľte si krajinu'); ?></option>
                                    <?php
                                    foreach($countries as $country) {
                                        $selected = $offer['ownerCountry'] == $country->international_name ? " selected" : "";
                                        echo "<option value='{$country->international_name}'{$selected}>{$country->name}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <h6 class="card-subtitle mt-2"><?= Yii::t('app','Údaje z katastra'); ?></h6>
                        <hr class="m-b-30">
                        <div class="row">
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Číslo LV') ?></label>
                                <input type="text" class="form-control" name="Data[<?= $offer['id']; ?>][ownershipDocumentNumber]" value="<?= $offer['ownershipDocumentNumber'] ?>">
                            </div>
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Č.parcely') ?></label>
                                <input type="text" class="form-control" name="Data[<?= $offer['id']; ?>][parcelNumber]" value="<?= $offer['parcelNumber'] ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Súp.č.') ?></label>
                                <input type="text" class="form-control" name="Data[<?= $offer['id']; ?>][registerNumber]" value="<?= $offer['registerNumber'] ?>">
                            </div>
                            <div class="col-md-6 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Miesto') ?></label>
                                <input type="text" class="form-control" name="Data[<?= $offer['id']; ?>][propertyAddress]" value="<?= $offer['propertyAddress'] ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Spoluvlastnícky podiel') ?></label>
                                <input type="text" class="form-control" name="Data[<?= $offer['id']; ?>][coOwnership]" value=" <?= $offer['coOwnership'] ?>">
                            </div>
                            <div class="col-md-10 col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Titul nadobudnutia') ?></label>
                                <input type="text" class="form-control" name="Data[<?= $offer['id']; ?>][acquisitionTitle]" value=" <?= $offer['acquisitionTitle'] ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 form-group">
                                <label class="control-label"><?= Yii::t('app', 'Ťarchy') ?></label>
                                <input type="text" class="form-control" name="Data[<?= $offer['id']; ?>][encumbrance]" value="<?= $offer['encumbrance'] ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="row m-b-10">
        <div class="col-xs-12">
            <div class="card rounded-5 card-shadow">
                <div class="card-body">
                    <button type="submit" class="btn btn-success mr-1 text-white">
                        <i class="mdi mdi-content-save m-r-5"></i><?= Yii::t('app', 'Uložiť') ?>
                    </button>
                    <a class="btn btn-danger text-white" href="<?= Url::to(['/offers']) ?>">
                        <i class="mdi mdi-step-backward m-r-5"></i><?= Yii::t('app', 'Späť') ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
$css = <<<CSS
.rounded-5 {
    border-radius: .5em!important;
}
.card-shadow {
    box-shadow: lightgrey 3px 3px;
}
CSS;
$this->registerCSS($css);
