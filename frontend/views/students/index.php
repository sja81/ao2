<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;

$this->title = Yii::t('app','Prihláška študenta');
$this->registerCSSFile('@web/css/schools.css?v=1.09',['depends'=>AppAsset::class]);
$this->registerJSFile('@web/js/schools.js?v=1.05',['depends'=>AppAsset::class]);

$errormsg = Yii::t('app','Táto položka je povinná!');
$wrongemail = Yii::t('app','Zlý formát emailovej adresy!');
$wrongphone = Yii::t('app','Zlý formát telefónneho čísla!');

?>

<main class="site-student">
    <div class="page-banner d-block position-relative raleway">
        <canvas style="background-image:url('/images/header-bg1.jpg');" width="1600" height="400"></canvas>
        <div class="page-border container-default d-block position-absolute mx-auto">
            <div class="page_title_line_left d-inline-block position-absolute background-gold-before background-gold-after animated fadeIn visible" data-aios-reveal="true" data-aios-animation="fadeIn" data-aios-animation-delay="0.2s" data-aios-animation-reset="false" data-aios-animation-offset="0" style="animation-delay: 0.2s;"></div>
            <div class="page_title_line_right d-inline-block position-absolute background-gold-before background-gold-after animated fadeIn visible" data-aios-reveal="true" data-aios-animation="fadeIn" data-aios-animation-delay="0.2s" data-aios-animation-reset="false" data-aios-animation-offset="0" style="animation-delay: 0.2s;"></div>
        </div>
        <div class="page-title container-default d-block position-absolute mx-auto">
            <div class="container-fluid">
                <div class="titlewrapper">
                    <h1 class="entry-title animated fadeInDown visible" data-aios-reveal="true" data-aios-animation="fadeInDown" data-aios-animation-delay="0.3s" data-aios-animation-reset="false" data-aios-animation-offset="0" style="animation-delay: 0.3s;">
                        <strong><?= Html::encode($this->title) ?></strong></h1>
                </div>
            </div>
        </div>
        <div class="breadcrumbs-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <?=
                        Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="students" class="container-fluid">
        <div class="students-container">
            <input type="hidden" value="<?= $studentId ?>" id="studentId">
            <!-- school & studyfield -->
            <section id="skola_odbor">
                <h4><?= Yii::t('app','Škola a odbor') ?></h4>
                <div class="form-group row">
                    <div class="col-xs-12">
                        <label for="school-origin" class="form-control-label">
                            <?= Yii::t('app','Škola kde študujete'); ?>
                        </label>
                        <span class="required">*</span>
                        <select id="school-origin" class="form-control dropdown student-data req-val" data-item="schoolId" data-cx="0">
                            <option value=""><?= Yii::t('app','Vyberte si školu') ?></option>
                            <?php
                            foreach($schools as $item) {
                                echo "<option value='{$item['id']}'>{$item['description']} - {$item['town']}</option>";
                            }
                            ?>
                        </select>
                        <div class="schoolId-error-0 errormsg"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-xs-12">
                        <label class="form-control-label"><?= Yii::t('app','Odbor, ktorý študujete'); ?></label>
                        <span class="required">*</span>
                        <select id="study-field" class="form-control dropdown student-data req-val" data-item="studyFieldId" data-cx="0">
                            <option value=""><?= Yii::t('app','Vyberte si odbor') ?></option>
                        </select>
                        <div class="studyFieldId-error-0 errormsg"></div>
                    </div>
                </div>
            </section>
            <!-- students data like name, idcard, phone, email, ...etc. -->
            <section id="kontakt">
                <h4><?= Yii::t('app','Osobné údaje a kontakt') ?></h4>
                <h5><?= Yii::t('app','Občiansky preukaz'); ?></h5>
                <form enctype="multipart/form-data" method="post" id="stud-form">
                    <div id="spin-stud" style="display:none; text-align: center" class="mt-2">
                        <div style="font-size: 2rem; font-weight: bold"><?= Yii::t('app','Spracovávam nahraté dokumenty...'); ?></div>
                        <img src="<?= Yii::getAlias('@web')?>/images/loader.gif?v=1" class="ml-auto; mt-4">
                    </div>
                    <div class="form-group row stud">
                        <label class="col-md-3 col-xs-4 col-form-label"><?= Yii::t('app','Predná strana') ?></label>
                        <div class="col-md-9 col-xs-8">
                            <input type="file" name="op_predna" id="op-predna-stud">
                        </div>
                    </div>
                    <div class="form-group row stud">
                        <label class="col-md-3 col-xs-4 col-form-label"><?= Yii::t('app','Zadná strana') ?></label>
                        <div class="col-md-9 col-xs-8">
                            <input type="file" name="op_zadna" id="op-zadna-stud">
                        </div>
                    </div>
                </form>
                <div class="section-footer stud">
                    <button type="button" class="btn-sm" id="op-upload-stud"><?= Yii::t('app','Nahrať') ?></button>
                </div>
                <div class="form-group row" style="margin-top: 30px">
                    <div class="col-sm-12">
                        <label class="form-control-label"><?= Yii::t('app','Pohlavie'); ?></label>
                        <select class="form-control dropdown student-data" data-item="gender">
                            <option value=""><?= Yii::t('app','Vyberte...'); ?></option>
                            <option value="m"><?= Yii::t('app','Muž'); ?></option>
                            <option value="f"><?= Yii::t('app','Žena'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 col-xs-6">
                        <label for="stud-surname" class="form-control-label">
                            <?= Yii::t('app','Meno'); ?>
                        </label>
                        <span class="required">*</span>
                        <input type="text" class="form-control student-data req-val" id="stud-surname" data-item="firstName" data-cx="0">
                        <div class="firstName-error-0 errormsg"></div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <label class="form-control-label"><?= Yii::t('app','Priezvisko'); ?></label>
                        <span class="required">*</span>
                        <input type="text" class="form-control student-data req-val" id="stud-name" data-item="lastName" data-cx="0">
                        <div class="lastName-error-0 errormsg"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 col-xs-6">
                        <label class="form-control-label"><?= Yii::t('app','Dátum narodenia'); ?></label>
                        <span class="required">*</span>
                        <input type="date" id="stud-birthdate" class="form-control req-val student-data" data-item="birthDate" data-cx="0">
                        <div class="birthDate-error-0 errormsg"></div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <label class="form-control-label"><?= Yii::t('app','Rodné číslo'); ?></label>
                        <input type="text" id="stud-ssn" class="form-control student-data" data-item="ssn">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 col-xs-6">
                        <label class="form-control-label">
                            <?= Yii::t('app','Miesto narodenia'); ?>
                        </label>
                        <input type="text" id="stud-birthplace" class="form-control student-data" data-item="birthPlace">
                    </div>
                    <div class="col-md-6 col-xs-6"></div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <label for="stud-address" class="form-control-label"><?= Yii::t('app','Ulica a číslo'); ?></label>
                        <span class="required">*</span>
                        <input type="text" class="form-control student-data req-val" id="stud-address" data-item="fullAddress" data-cx="0">
                        <div class="fullAddress-error-0 errormsg"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-5 col-xs-3">
                        <label class="form-control-label"><?= Yii::t('app','PSČ'); ?></label>
                        <span class="required">*</span>
                        <input type="text" class="form-control student-data req-val" data-item="zip" id="stud-zip" data-cx="0">
                        <div class="zip-error-0 errormsg"></div>
                    </div>
                    <div class="col-md-7 col-xs-9">
                        <label class="form-control-label"><?= Yii::t('app','Mesto'); ?></label>
                        <span class="required">*</span>
                        <input type="text" class="form-control student-data req-val" id="stud-town" data-item="town" data-cx="0">
                        <div class="town-error-0 errormsg"></div>
                    </div>
                </div>
                <div class="form-group row" style="margin-top: 30px">
                    <label class="col-md-3 col-xs-2 col-form-label">Email: <span class="required">*</span></label>

                    <div class="col-md-9 col-xs-10">
                        <input type="email" class="form-control student-data req-val" value="@" data-item="email" id="stud-email" data-cx="0">
                        <div class="email-error-0 errormsg"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-xs-2 col-form-label"><?= Yii::t('app','Mobil'); ?>:<span class="required">*</span></label>
                    <div class="col-md-3 col-xs-4">
                        <select class="form-control dropdown student-data req-val" data-item="phoneCountry">
                            <?php
                            foreach ($staty as $stat) {
                                ?>
                                <option value="00<?= $stat->predvolba ?>"><?= $stat->iso_kod ?> (+<?= $stat->predvolba ?>)</option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <input type="tel" class="form-control student-data req-val" placeholder="9XXXXXXXX" data-item="phoneNumber" id="stud-phoneNumber" data-cx="0">
                        <div class="phoneNumber-error-0 errormsg"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 col-xs-6">
                        <label for="stud-idnum" class="form-control-label">
                            <?= Yii::t('app','Číslo OP'); ?>
                        </label>
                        <input type="text" id="stud-idnum" class="form-control student-data" data-item="idCardNumber">
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <label class="form-control-label">
                            <?= Yii::t('app','Vydal'); ?>
                        </label>
                        <input type="text" id="stud-issuer" class="form-control student-data" data-item="idCardIssuer">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 col-xs-6">
                        <label for="stud-issued" class="form-control-label">
                            <?= Yii::t('app','Vydané dňa'); ?>
                        </label>
                        <input type="date" id="stud-issued" class="form-control student-data" data-item="idCardIssuedAt">
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <label for="stud-validto" class="form-control-label">
                            <?= Yii::t('app','Platnosť'); ?>
                        </label>
                        <input type="date" id="stud-validto" class="form-control student-data" data-item="idCardValidTo">
                    </div>
                </div>
            </section>
            <section id="kontakt-rodic">
                <h4><?= Yii::t('app','Osobné údaje a kontakt na zákonného zástupcu') ?></h4>
                <h5><?= Yii::t('app','Občiansky preukaz'); ?></h5>
                <form enctype="multipart/form-data" method="post" id="legal-form">
                    <div id="spin-legal" style="display:none; text-align: center" class="mt-2">
                        <div style="font-size: 2rem; font-weight: bold"><?= Yii::t('app','Spracovávam nahraté dokumenty...'); ?></div>
                        <img src="<?= Yii::getAlias('@web')?>/images/loader.gif?v=1" class="ml-auto; mt-4">
                    </div>
                    <div class="form-group row legal">
                        <label class="col-md-3 col-xs-4 col-form-label"><?= Yii::t('app','Predná strana') ?></label>
                        <div class="col-md-9 col-xs-8">
                            <input type="file" name="op_predna" id="op-predna-legal">
                        </div>
                    </div>
                    <div class="form-group row legal">
                        <label class="col-md-3 col-xs-4 col-form-label"><?= Yii::t('app','Zadná strana') ?></label>
                        <div class="col-md-9 col-xs-8">
                            <input type="file" name="op_zadna" id="op-zadna-legal">
                        </div>
                    </div>
                </form>
                <div class="section-footer legal">
                    <button type="button" class="btn-sm" id="op-upload-legal"><?= Yii::t('app','Nahrať') ?></button>
                </div>
                <div class="form-group row" style="margin-top: 30px">
                    <div class="col-md-6 col-xs-6">
                        <label for="legal-name" class="form-control-label"><?= Yii::t('app','Meno'); ?></label>
                        <span class="required">*</span>
                        <input type="text" class="form-control representative-data req-val" id="legal-name" data-item="firstName" data-cx="1">
                        <div class="firstName-error-1 errormsg"></div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <label class="form-control-label"><?= Yii::t('app','Priezvisko'); ?></label>
                        <span class="required">*</span>
                        <input type="text" class="form-control representative-data req-val" id="legal-surname" data-item="lastName" data-cx="1">
                        <div class="lastName-error-1 errormsg"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 col-xs-6">
                        <label class="form-control-label"><?= Yii::t('app','Dátum narodenia'); ?></label>
                        <span class="required">*</span>
                        <input type="date" id="legal-birthdate" class="form-control representative-data req-val" data-item="birthDate" data-cx="1">
                        <div class="birthDate-error-1 errormsg"></div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <label class="form-control-label"><?= Yii::t('app','Rodné číslo'); ?></label>
                        <input type="text" id="legal-ssn" class="form-control representative-data" data-item="ssn">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 col-xs-6">
                        <label for="legal-birthplace" class="form-control-label">
                            <?= Yii::t('app','Miesto narodenia'); ?>
                        </label>
                        <input type="text" id="legal-birthplace" class="form-control representative-data" data-item="birthPlace">
                    </div>
                    <div class="col-md-6 col-xs-6"></div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <label class="form-control-label"><?= Yii::t('app','Ulica a číslo'); ?></label>
                        <span class="required">*</span>
                        <input type="text" class="form-control representative-data req-val" id="legal-address" data-item="fullAddress" data-cx="1">
                        <div class="fullAddress-error-1 errormsg"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-5 col-xs-3">
                        <label class="form-control-label"><?= Yii::t('app','PSČ'); ?></label>
                        <span class="required">*</span>
                        <input type="text" class="form-control representative-data req-val" data-item="zip" data-cx="1" id="legal-zip">
                        <div class="zip-error-1 errormsg"></div>
                    </div>
                    <div class="col-md-7 col-xs-9">
                        <label class="form-control-label"><?= Yii::t('app','Mesto'); ?></label>
                        <span class="required">*</span>
                        <input type="text" class="form-control representative-data req-val" id="legal-town" data-item="town" data-cx="1">
                        <div class="town-error-1 errormsg"></div>
                    </div>
                </div>
                <div class="form-group row" style="margin-top: 30px">
                    <label class="col-md-3 col-xs-2 col-form-label">Email:<span class="required">*</span></label>
                    <div class="col-md-9 col-xs-10">
                        <input type="email" class="form-control representative-data req-val" value="@" data-item="email" data-cx="1" id="legal-email">
                        <div class="email-error-1 errormsg"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-xs-2 col-form-label"><?= Yii::t('app','Mobil'); ?>:<span class="required">*</span></label>
                    <div class="col-md-3 col-xs-4">
                        <select class="form-control dropdown representative-data" data-item="phoneCountry">
                            <?php
                            foreach ($staty as $stat) {
                                ?>
                                <option value="00<?= $stat->predvolba ?>"><?= $stat->iso_kod ?> (+<?= $stat->predvolba ?>)</option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <input type="tel" id="legal-phone" class="form-control representative-data req-val" placeholder="9XXXXXXXX" data-item="phoneNumber" data-cx="1">
                        <div class="phoneNumber-error-1 errormsg"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 col-xs-6">
                        <label class="form-control-label">
                            <?= Yii::t('app','Číslo OP'); ?>
                        </label>
                        <input type="text" id="legal-idnum" class="form-control representative-data" data-item="idCardNumber">
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <label class="form-control-label">
                            <?= Yii::t('app','Vydal'); ?>
                        </label>
                        <input type="text" id="legal-issuer" class="form-control representative-data" data-item="idCardIssuer">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 col-xs-6">
                        <label class="form-control-label">
                            <?= Yii::t('app','Vydané dňa'); ?>
                        </label>
                        <input type="date" id="legal-issued" class="form-control representative-data" data-item="idCardIssuedAt">
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <label class="form-control-label">
                            <?= Yii::t('app','Platnosť'); ?>
                        </label>
                        <input type="date" id="legal-validto" class="form-control representative-data" data-item="idCardValidTo">
                    </div>
                </div>
                <div class="section-footer">
                    <button type="button" class="btn-sm" id="btn-dalej"><?= Yii::t('app','Ďalej'); ?></button>
                </div>
            </section>

            <form enctype="multipart/form-data" method="post" id="cv-form">
                <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken() ?>">
                <input type="hidden" name="sid" value="<?= $studentId ?>">
                <section id="vzdelanie">
                    <h4><?= Yii::t('app','Dokončené vzdelanie a kurzy') ?></h4>
                    <h5><?= Yii::t('app','Základná škola'); ?></h5>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="form-control-label"><?= Yii::t('app','Škola'); ?></label>
                            <input type="text" class="form-control" name="primarySchoolName">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="form-control-label"><?= Yii::t('app','Mesto'); ?></label>
                            <input type="text" class="form-control" name="primarySchoolTown">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="form-control-label"><?= Yii::t('app','Rok nástupu'); ?></label>
                            <input type="number" class="form-control" name="primarySchoolFrom">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-control-label"><?= Yii::t('app','Rok ukončenia'); ?></label>
                            <input type="number" class="form-control" name="primarySchoolTo">
                        </div>
                    </div>
                    <h6><?= Yii::t('app','Vysvedčenie zo základnej školy'); ?></h6>
                    <!-- school report -->
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>
                                            <?= Yii::t('app','Ročník'); ?>
                                        </th>
                                        <th><?= Yii::t('app','Slov. j.'); ?></th>
                                        <th><?= Yii::t('app','Maď. j.'); ?></th>
                                        <th><?= Yii::t('app','Angl. j.'); ?></th>
                                        <th><?= Yii::t('app','Nem. j.'); ?></th>
                                        <th><?= Yii::t('app','Franc. j.'); ?></th>
                                        <th><?= Yii::t('app','Špan. j.'); ?></th>
                                        <th><?= Yii::t('app','Mat.'); ?></th>
                                        <th><?= Yii::t('app','Fyz.'); ?></th>
                                        <th><?= Yii::t('app','Chém.'); ?></th>
                                        <th><?= Yii::t('app','Geogr.');?></th>
                                        <th><?= Yii::t('app','Správanie'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    for($i=5; $i < 10; $i++) {
                                ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><input type="number" min="0" max="5" class="form-control" name="Report[<?= $i ?>][slovjaz][grade]"></td>
                                        <td><input type="number" min="0" max="5" class="form-control" name="Report[<?= $i ?>][madjaz][grade]"></td>
                                        <td><input type="number" min="0" max="5" class="form-control" name="Report[<?= $i ?>][angjaz][grade]"></td>
                                        <td><input type="number" min="0" max="5" class="form-control" name="Report[<?= $i ?>][nemjaz][grade]"></td>
                                        <td><input type="number" min="0" max="5" class="form-control" name="Report[<?= $i ?>][francjaz][grade]"></td>
                                        <td><input type="number" min="0" max="5" class="form-control" name="Report[<?= $i ?>][spanjaz][grade]"></td>
                                        <td><input type="number" min="0" max="5" class="form-control" name="Report[<?= $i ?>][mat][grade]"></td>
                                        <td><input type="number" min="0" max="5" class="form-control" name="Report[<?= $i ?>][fyz][grade]"></td>
                                        <td><input type="number" min="0" max="5" class="form-control" name="Report[<?= $i ?>][chem][grade]"></td>
                                        <td><input type="number" min="0" max="5" class="form-control" name="Report[<?= $i ?>][geogr][grade]"></td>
                                        <td><input type="number" min="0" max="5" class="form-control" name="Report[<?= $i ?>][sprav][grade]"></td>
                                    </tr>
                                <?php
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <h5><?= Yii::t('app','Kurzy a školenia'); ?></h5>

                    <div class="kurz" data-order="1">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="form-control-label"><?= Yii::t('app','Názov kurzu/školenia'); ?></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 ">
                                <label class="form-control-label"><?= Yii::t('app','Názov certifikátu'); ?></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="form-control-label"><?= Yii::t('app','Inštitúcia'); ?></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label class="form-control-label"><?= Yii::t('app','Od'); ?></label>
                                <input type="number" class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-control-label"><?= Yii::t('app','Do'); ?></label>
                                <input type="number" class="form-control">
                            </div>
                        </div>
                    </div>
                    <h5><?= Yii::t('app','Doplňujúce informácie'); ?></h5>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <textarea class="form-control" rows="10" name="additionalStudy"></textarea>
                        </div>
                    </div>
                </section>
                <section id="dalsie-info">
                <h4><?= Yii::t('app','Ďaľšie informácie'); ?></h4>
                <h5><?= Yii::t('app','Jazykové znalosti');?></h5>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <label class="form-control-label">
                            <?= Yii::t('app','Materinský jazyk'); ?>
                        </label>
                        <select class="form-control dropdown" name="motherLanguage">
                            <option value=""><?= Yii::t('app','Vyberte jazyk'); ?></option>
                            <?php
                            foreach ($jazyk as $item) {
                                echo"<option value={$item['id']}>{$item['name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <h6><?= Yii::t('app','Ďalšie jazyky'); ?></h6>



                <h5><?= Yii::t('app','Ostatné znalosti'); ?></h5>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-sm-6">
                        <select class="custom-select">
                            <option value="0">Vyberte úroveň</option>
                            <option value="1">Úplný začiatočník (A1)</option>
                            <option value="2">Začiatočník (A2)</option>
                            <option value="3">Mierne pokročilý (B1)</option>
                            <option value="4">Stredne pokročilý (B2)</option>
                            <option value="5">Pokročilý (C1)</option>
                            <option value="6">Expert (C2)</option>
                        </select>
                    </div>
                </div>
                <h5><?= Yii::t('app','Ďalšie znalosti, schopnosti a záujmy'); ?></h5>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <textarea class="form-control" rows="10" name="otherKnowledges"></textarea>
                    </div>
                </div>
                <div class="form-group row" style="margin-top: 40px;">
                    <label class="col-sm-4 col-form-label"><?= Yii::t('app','Fotografia'); ?></label>
                    <div class="col-sm-5">
                        <input type="file" name="photo" accept="image/jpg, image/png" id="photo">
                        <small class="note-text"><?= Yii::t('app','Nahrajte fotku vo formáte JPG alebo PNG!'); ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label"><?= Yii::t('app','Motivačný list'); ?></label>
                    <div class="col-sm-5">
                        <input type="file" name="motivationletter" id="letter">
                        <small class="note-text"><?= Yii::t('app','Nahrajte motivačný list vo formáte PDF!'); ?></small>
                    </div>
                </div>
                <div class="form-group row mt-10">
                    <div class="col-sm-12">
                        <article id="gdpr-text">
                            <h3>SÚHLAS SO SPRACOVANÍM OSOBNÝCH ÚDAJOV</h3>
                            <p>
                                Udeľujete týmto súhlas so spracúvaním všetkých Vašich osobných údajov podľa zákona č. 18/2018 Z. z. o
                                ochrane osobných údajov a o zmene a doplnení niektorých zákonov a Nariadenia európskeho parlamentu a
                                rady (EÚ) 2016/679 z 27. apríla 2016 o ochrane fyzických osôb pri spracúvaní osobných údajov a o voľnom
                                pohybe takýchto údajov, ktorým sa zrušuje smernica 95/46/ES (všeobecné nariadenie o ochrane údajov),
                                Zamestnávateľovi ALPHA-OMEGA Real & Consulting s.r.o (IČO: 51817594) na účely ich zaradenia do databázy
                                a na ich využívanie na procesy súvisiace s analýzou pracovného potenciálu. Tento súhlas je dobrovoľný
                                a je udelený na dobu 3 rokov. Tento súhlas je možné kedykoľvek písomne odvolať. V rámci vyššie uvedených
                                procesov sa spracovávajú tieto osobné údaje:
                            </p>

                            <ul>
                                <li>titul, meno a priezvisko</li>
                                <li>e-mail</li>
                                <li>telefónne číslo</li>
                                <li>rok narodenia</li>
                                <li>bydlisko</li>
                                <li>fotografia</li>
                                <li>školské vzdelanie</li>
                                <li>prax</li>
                            </ul>

                            <p>Vyššie uvedené Osobné údaje je nutné spracovať s cieľom:</p>

                            <ul>
                                <li>zaradenia do databázy,</li>
                                <li>analýzy pracovného potenciálu pre uchádzačov o prácu,</li>
                                <li>zabezpečovanie prevádzky, údržby, podpory a správy (t.j. činnosti administrátora).</li>
                            </ul>

                            <p>
                                Tieto údaje budú Zamestnávateľom spracované v priebehu 3 rokov od udelenia súhlasu.
                                Ak však v tejto dobe vznikne aktivita používateľa, bude doba predĺžená o ďalšie 3 roky.
                            </p>
                            <p>
                                S vyššie uvedeným spracovaním udeľujete svoj výslovný súhlas. Súhlas je možné kedykoľvek odvolať, a to
                                napríklad zaslaním e-mailu na adresu: info@aoreal.sk alebo listom na sídlo spoločnosti ALPHA-OMEGA Real
                                & Consulting spol. s.r.o, Černyševského 10, 851 01 Bratislava.
                            </p>

                            <p>
                                Udelením súhlasu vyhlasujem, že som si vedomý/á a bol/a som poučená Sprostredkovateľom o svojich právach
                                týkajúcich sa Osobných údajov:
                            </p>

                            <ul>
                                <li>vziať súhlas kedykoľvek späť,</li>
                                <li>požadovať informáciu, aké osobné údaje sa spracovávajú,</li>
                                <li>požadovať vysvetlenie týkajúce sa spracovania osobných údajov,</li>
                                <li>vyžiadať si u nás prístup k týmto údajom a tieto údaje nechať aktualizovať alebo opraviť,</li>
                                <li>požadovať vymazanie týchto osobných údajov,</li>
                                <li>
                                    v prípade pochybností o dodržiavaní povinností súvisiacich so spracovaním osobných údajov obrátiť sa na
                                    nás alebo na Úrad na ochranu osobných údajov.
                                </li>
                            </ul>
                            <p>
                                Subjekt údajov vyhlasuje, že bol Zamestnávateľom riadne poučený o spracovaní a ochrane osobných údajov*,
                                že vyššie uvedené osobné údaje sú presné a pravdivé a sú Zamestnávateľovi poskytované dobrovoľne. Subjekt
                                údajov vyššie uvedenému rozumie, súhlasí a schvaľuje udelenie súhlasu.
                            </p>

                            <p><b>*Poučenie Subjektu údajov</b></p>
                            <p>
                                Zamestnávateľ týmto v súlade s ustanovením čl. 13 Nariadenie Európskeho parlamentu a Rady (EÚ)
                                č. 2016/679 zo dňa 27. apríla 2016, všeobecného nariadenia o ochrane osobných údajov, informuje, že:
                            </p>
                            <ul>
                                <li>
                                    osobné údaje Subjektu údajov budú spracované na základe jeho slobodného súhlasu, a to za vyššie
                                    uvedených podmienok, </li>
                                <li>dôvodom poskytnutia osobných údajov Subjektu údajov je záujem Subjektu údajov o
                                    zaradenia do databázy uchádzačov, čo by bez poskytnutia týchto údajov nebolo možné,</li>
                                <li>
                                    Zamestnávateľ nemá v úmysle odovzdať osobné údaje Subjektu údajov do tretej krajiny, medzinárodnej
                                    organizácii alebo iným organizáciám.
                                </li>
                            </ul>
                        </article>
                    </div>
                </div>
                <div class="form-group row mt-5">
                    <div class="col-sm-12">
                        <input type="checkbox" checked name="noConsent">
                        Týmto dávam Zamestnávateľovi <a href="#" id="gdpr-consent">súhlas</a> na spracovanie mojich osobných údajov.
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="checkbox" checked name="noVideo">&nbsp;
                        Týmto dávam súhlas Zamestnávateľovi na spracovanie údajov z videokamery môjho osobného počítača.
                    </div>
                </div>
                <div class="section-footer">
                    <button type="submit" class="btn-sm"><?= Yii::t('app','Uložiť'); ?></button>
                </div>
            </section>
            </form>
        </div>
    </div>
</main>

<?php
$csrf = "'" . Yii::$app->request->csrfParam ."':'". Yii::$app->request->getCsrfToken() ."'";
$csrfName = Yii::$app->request->csrfParam;
$csrfToken = Yii::$app->request->getCsrfToken();
$js = <<<JS

    uploadIdCard = function(i) {
        $('.'+i).fadeOut();
        $('#spin-'+i).fadeIn();
        var data = new FormData();
        data.append("op-predna",$("#op-predna-"+i)[0].files[0]);
        data.append("op-zadna",$("#op-zadna-"+i)[0].files[0]);
        data.append("studentid",{$studentId});
        data.append("{$csrfName}","{$csrfToken}");
        $.ajax({
            url : "/students/upload-card",
            type : 'POST',
            data : data,
            contentType : false,
            processData : false,
            success: function(resp) {
                $('#spin-'+i).fadeOut();
                $('.'+i).fadeIn();
                $('#'+i+'-form').trigger("reset");
                let r = resp.items;
                $('#' + i + '-name').val(r.name_first);
                $('#' + i + '-surname').val(r.name_last);
                $('#'+ i + '-address').val(r.perm_address);
                if (r.hasOwnProperty('perm_town')) {
                    $('#' + i + '-town').val(r.perm_town);
                } 
                if (r.hasOwnProperty('ssn')) {
                    $('#' + i + '-ssn').val(r.ssn);
                }
                if (r.hasOwnProperty('birth_date')) {
                    $('#' + i + '-birthdate').val(r.birth_date);
                }
                if (r.hasOwnProperty('validity_date')) {
                    $('#' + i + '-validto').val(r.validity_date);
                }
                if (r.hasOwnProperty('birth_place')) {
                    $('#' + i + '-birthplace').val(r.birth_place);
                }
                if (r.hasOwnProperty('doc_issuer')) {
                    $('#' + i + '-issuer').val(r.doc_issuer);
                }
                if (r.hasOwnProperty('issue_date')) {
                    $('#' + i + '-issued').val(r.issue_date);
                }
            }
        });
    }

    $('#school-origin').on('change',function(){
        let v = $(this).val();
         $.ajax({
           url: "/students/ajax-api",
           dataType: "json",
           data: { 
               method: "GetStudyFields",
               params: {
                   schoolid: v
               },
               {$csrf} 
           },
           type: "post"
       })
       .done(function(res){
          if (res.status == 'error') {
             alert(res.message);
          } else {
              $('#study-field').empty();
             $.each(res.result,function(k,v){
                $('#study-field').append($('<option />',{'value':v.id,'text':v.code + ' - ' + v.name}));
             });
          }
       });
    });
    
    $('#btn-dalej').on('click',function(){
        var hasErrors = false;
        $.each($('.req-val'),function(k,v){
            let x = $.trim($(v).val());
            if(x.length == 0) {
                hasErrors = true;
                displayErrorMessage($(v),'$errormsg',$(v).data('cx'));
            }
            if ($(v).is('input') && $(v).attr('type') == 'email') {
                let z = (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($(v).val()));
                if (!z) {
                    displayErrorMessage($(v),'$wrongemail',$(v).data('cx'));
                }
            }
        });
        if (!hasErrors) {
            // all fine
            // get all student data
            var studentData = new Array();
            $.each($('.student-data'),function(k,v){
                studentData.push({'key': $(v).data('item'), 'value': $(v).val()});
            });
            var representativeData = new Array();
            $.each($('.representative-data'),function(k,v){
                representativeData.push({'key': $(v).data('item'), 'value': $(v).val()});
            });
            $.ajax({
               url: "/students/ajax-api",
               dataType: "json",
               data: { 
                   method: "StoreStudentData",
                   params: {
                       student: studentData,
                       legalrep: representativeData,
                       studentid: $('#studentId').val()
                   },
                   {$csrf} 
               },
               type: "post"
               })
               .done(function(res){
                  if (res.status == 'error') {
                     alert(res.message);
                  } else {
                      $('#skola_odbor').fadeOut();
                      $('#kontakt').fadeOut();
                      $('#kontakt-rodic').fadeOut();
                      $('#vzdelanie').fadeIn();
                      $('#dalsie-info').fadeIn();
                  }
                });
        } else {
            $('html, body').animate({scrollTop:200},'5');
        }
    });
    
    checkRequiredElement = function(e,i) {
        let v = $.trim(e.val());
        if (v != '') {
            hideErrorMessage(e,i);
        }
        if (v.length == 0) {
            displayErrorMessage(e,'$errormsg',i);
        }
        // validate email
        if(e.is('input') && e.attr('type') == 'email') {
             let z = (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(e.val())); 
             if (!z) {
                 displayErrorMessage(e,'$wrongemail',i);
             } else {
                 hideErrorMessage(e,i);
             }
        }
        if(e.is('input') && e.attr('type') == 'tel') {
            let z = (/^[\d\s]{1,}$/.test(e.val()));
            if (!z) {
                 displayErrorMessage(e,'$wrongphone',i);
             } else {
                 hideErrorMessage(e,i);
             }
        }
    }

JS;
$this->registerJS($js);