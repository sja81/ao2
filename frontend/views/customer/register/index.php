<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\RegistrationAsset;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var array $titul_pred */
/* @var array $prefixes */
/* @var array $countries */

RegistrationAsset::register($this);
$this->registerCSSFile('@web/css/customer/registration.css?v=0.1',['depends'=>RegistrationAsset::class]);
$this->registerCSSFile("https://fonts.googleapis.com/icon?family=Material+Icons",['depends'=>RegistrationAsset::class]);


$this->title = Yii::t('expat','Registrácia');
?>
<main class="site-registration">
    <div class="page-banner d-block position-relative raleway">
        <canvas style="background-image:url('/images/contact-us-banner-1.jpg');" width="1600" height="400"></canvas>
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
                            'links' => $this->params['breadcrumbs'] ?? [],
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="registration">
        <div class="registration-container wizard-content">
            <form
                    id="registration-form"
                    class="needs-validation tab-wizard wizard-circle wizard"
                    enctype="multipart/form-data"
                    action="<?= Url::to(['customer/save-it']) ?>"
                    method="post"
            >
                <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken() ?>">
                <h1><?= Yii::t('expat','Dokumenty'); ?></h1>
                <section>
                    <h4><?= Yii::t('expat','Občiansky preukaz'); ?></h4>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="button" class="btn-hoo" id="load-idcard">
                                <?= Yii::t('expat','Nahrať'); ?>
                            </button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="legal-idnum" class="col-sm-3 col-form-label"><?= Yii::t('expat','Číslo OP'); ?></label>
                        <div class="col-sm-9">
                            <input
                                    type="text"
                                    id="legal-idnum"
                                    class="form-control"
                                    name="Registration[idcard][number]"
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="legal-authority" class="col-sm-3 col-form-label"><?= Yii::t('expat','Vydal'); ?></label>
                        <div class="col-sm-9">
                            <input
                                    type="text"
                                    id="legal-authority"
                                    class="form-control"
                                    name="Registration[idcard][authority]"
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Vydané dňa'); ?></label>
                        <div class="col-sm-9">
                            <input type="date" id="legal-issued" class="form-control" name="Registration[idcard][issued]">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Platnosť'); ?></label>
                        <div class="col-sm-9">
                            <input type="date" id="legal-validto" class="form-control" name="Registration[idcard][valid]">
                        </div>
                    </div>
                    <h4><?php echo Yii::t('expat','Cestovný pas'); ?></h4>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="button" class="btn-hoo" id="load-passport">
                                <?= Yii::t('expat','Nahrať'); ?>
                            </button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Vydal'); ?></label>
                        <div class="col-sm-9">
                            <input type="text"
                                   id="passp-authority"
                                   class="form-control"
                                   name="Registration[passport][authority]"
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Vydané dňa'); ?></label>
                        <div class="col-sm-9">
                            <input type="date" id="passp-issued" class="form-control" name="Registration[passport][issued]">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Platnosť'); ?></label>
                        <div class="col-sm-9">
                            <input type="date" id="passp-validto" class="form-control" name="Registration[passport][valid]">
                        </div>
                    </div>
                    <h4><?= Yii::t('expat','Vodičský preukaz'); ?></h4>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="button" class="btn-hoo" id="load-drivelic">
                                <?= Yii::t('expat','Nahrať'); ?>
                            </button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Vydal'); ?></label>
                        <div class="col-sm-9">
                            <input type="text"
                                   id="drivelic-authority"
                                   class="form-control"
                                   name="Registration[drivinglicence][authority]"
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Vydané dňa'); ?></label>
                        <div class="col-sm-9">
                            <input type="date" id="drivelic-issued" class="form-control" name="Registration[drivinglicence][issued]">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Platnosť'); ?></label>
                        <div class="col-sm-9">
                            <input type="date" id="drivelic-validto" class="form-control" name="Registration[drivinglicence][valid]">
                        </div>
                    </div>
                </section>
                <h1><?= Yii::t('expat','Osobné údaje') ?></h1>
                <section>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Pohlavie'); ?></label>
                        <div class="col-sm-9">
                            <select name="Registration[sex]" class="form-control dropdown">
                                <option value=""><?= Yii::t('expat','Zvoľte si pohlavie') ?></option>
                                <option value="1"><?= Yii::t('expat','Muž') ?></option>
                                <option value="2"><?= Yii::t('expat','Žena') ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Dátum narodenia') ?></label>
                        <div class="col-sm-9">
                            <input type="date" name="Registration[birthDate]" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Rodné číslo') ?></label>
                        <div class="col-sm-9">
                            <input type="text" name="Registration[ssn]" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Miesto narodenia') ?></label>
                        <div class="col-sm-9">
                            <input type="text" name="Registration[birthPlace]" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Akademický titul') ?></label>
                        <div class="col-sm-9">
                            <select name="Registration[academicDegree]" class="form-control dropdown">
                                <option value=""><?= Yii::t('expat','Zvoľte titul') ?></option>
                                <?php
                                foreach($titul_pred as $titul) {
                                    echo "<option value='{$titul['short_name']}'>{$titul['short_name']} - {$titul['description']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Rodné priezvisko'); ?></label>
                        <div class="col-sm-9">
                            <input type="text" name="Registration[maidenNamePatronymic]" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Meno') ?></label>
                        <div class="col-sm-9">
                            <input type="text" name="Registration[firstName]" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Priezvisko') ?></label>
                        <div class="col-sm-9">
                            <input type="text" name="Registration[lastName]" class="form-control">
                        </div>
                    </div>
                </section>
                <!-- Step 2 -->
                <h1><?= Yii::t('expat','Kontaktné údaje') ?></h1>
                <section>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Email'); ?></label>
                        <div class="col-sm-9">
                            <input type="email" name="Registration[email]" class="form-control" placeholder="example@mail.com">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Telefón'); ?></label>
                        <div class="col-sm-3">
                            <select name="Registration[phone][countryCode]" class="form-control dropdown">
                                <?php
                                foreach($prefixes as $prefix) {
                                    echo "<option value='{$prefix['predvolba']}'>{$prefix['iso_kod']} (+{$prefix['predvolba']})</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <input type="tel" name="Registration[phone][number]" class="form-control">
                        </div>
                    </div>
                    <h4><?= Yii::t('expat','Trvalé bydlisko'); ?></h4>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Krajina') ?></label>
                        <div class="col-sm-9">
                            <select name="Registration[permanent_address][country]" class="form-control dropdown">
                                <option value=""><?= Yii::t('expat','Zvoľte krajinu') ?></option>
                                <?php
                                foreach($countries as $country) {
                                    echo "<option value='{$country['id']}'>{$country['international_name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?= Yii::t('expat','PSČ') ?></label>
                        <div class="col-sm-2">
                            <input type="text" name="Registration[permanent_address][zip]" class="form-control">
                        </div>
                        <label class="col-sm-2 col-form-label"><?= Yii::t('expat','Mesto') ?></label>
                        <div class="col-sm-5">
                            <input type="text" name="Registration[permanent_address][town]" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Adresa 1') ?></label>
                        <div class="col-sm-9">
                            <input type="text" name="Registration[permanent_address][address1]" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Adresa 2 (voliteľné)') ?></label>
                        <div class="col-sm-9">
                            <input type="text" name="Registration[permanent_address][address2]" class="form-control">
                        </div>
                    </div>

                    <h4><?= Yii::t('expat','Kontaktná adresa/prechodné bydlisko'); ?></h4>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Krajina') ?></label>
                        <div class="col-sm-9">
                            <select name="Registration[temp_address][country]" class="form-control dropdown">
                                <option value=""><?= Yii::t('expat','Zvoľte krajinu') ?></option>
                                <?php
                                foreach($countries as $country) {
                                    echo "<option value='{$country['id']}'>{$country['international_name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?= Yii::t('expat','PSČ') ?></label>
                        <div class="col-sm-2">
                            <input type="text" name="Registration[temp_address][zip]" class="form-control">
                        </div>
                        <label class="col-sm-2 col-form-label"><?= Yii::t('expat','Mesto') ?></label>
                        <div class="col-sm-5">
                            <input type="text" name="Registration[temp_address][town]" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Adresa 1') ?></label>
                        <div class="col-sm-9">
                            <input type="text" name="Registration[temp_address][address1]" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Adresa 2 (voliteľné)') ?></label>
                        <div class="col-sm-9">
                            <input type="text" name="Registration[temp_address][address2]" class="form-control">
                        </div>
                    </div>
                </section>
                <!-- Step 3 -->
                <h1><?= Yii::t('expat','Vzdelanie'); ?></h1>
                <section>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <select name="Registration[education][highestDegree]" class="form-control dropdown">
                                <option value=""><?=  Yii::t('expat','Najvyššie dosiahnuté vzdelanie'); ?></option>
                                <option value="1"><?= Yii::t('expat','základné vzdelanie') ?></option>
                                <option value="2"><?= Yii::t('expat','študent strednej školy') ?></option>
                                <option value="3"><?= Yii::t('expat','stredoškolské bez maturity') ?></option>
                                <option value="4"><?= Yii::t('expat','stredoškolské s maturitou') ?></option>
                                <option value="5"><?= Yii::t('expat','nadstavbové/vyššie odborné vzdelanie') ?></option>
                                <option value="6"><?= Yii::t('expat','študent vysokej školy') ?></option>
                                <option value="7"><?= Yii::t('expat','vysokoškolské I. stupňa') ?></option>
                                <option value="8"><?= Yii::t('expat','vysokoškolské II. stupňa') ?></option>
                                <option value="9"><?= Yii::t('expat','vysokoškolské III. stupňa') ?></option>
                            </select>
                        </div>
                    </div>
                    <h4><?= Yii::t('expat','Školy a kurzy'); ?></h4>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button class="btn-hoo" type="button" id="btn-add-highschool">
                                <?= Yii::t('expat','Pridať strednú školu'); ?>
                            </button>
                            <button class="btn-hoo ml-3" type="button" id="btn-add-univ">
                                <?= Yii::t('expat','Pridať vysokú školu'); ?>
                            </button>
                            <button class="btn-hoo ml-3" type="button" id="btn-add-course">
                                <?= Yii::t('expat','Pridať kurz'); ?>
                            </button>
                        </div>
                    </div>
                    <div id="edu">

                    </div>
                    <h4><?= Yii::t('expat','Doplňujúce informácie') ?></h4>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <textarea name="Registration[education][additionalInfo]" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                </section>
                <!-- Step 4 -->
                <h1><?= Yii::t('expat','Pracovné skúsenosti'); ?></h1>
                <section>
                    <h4><?= Yii::t('expat','Pracovné skúsenosti'); ?></h4>
                    <p class="text-muted">
                        <?= Yii::t('expat','Začnite posledným zamestnaním. Uveďte aj dobrovoľnícke aktivity, študentské stáže, prax atď.'); ?>
                    </p>
                    <div id="work">
                        <div class="job j-temp" data-id="1">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Profesia') ?></label>
                                <div class="col-sm-9">
                                    <select class="form-control jobs" name="Registration[jobs][][profession]">
                                        <option value="">Profesia</option>
                                        <?php
                                        /**
                                         * @var $professions
                                         */
                                        foreach($professions as $item) {
                                            ?>
                                            <option value="<?= $item['id'] ?>"><?= $item['title'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Zamestnávateľ') ?></label>
                                <div class="col-sm-9">
                                    <input type="text" name="Registration[jobs][][employer][name]" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Krajina') ?></label>
                                <div class="col-sm-9">
                                    <select name="Registration[jobs][][employer][country]" class="form-control dropdown">
                                        <option value=""><?= Yii::t('expat','Zvoľte krajinu') ?></option>
                                        <?php
                                        foreach($countries as $country) {
                                            echo "<option value='{$country['id']}'>{$country['international_name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Zamestnaný od') ?></label>
                                <div class="col-sm-3">
                                    <input type="text" name="Registration[jobs][][employer][from]" class="form-control">
                                </div>
                                <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Zamestnaný do') ?></label>
                                <div class="col-sm-3">
                                    <input type="text" name="Registration[jobs][][employer][to]" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?= Yii::t('expat','PSČ') ?></label>
                                <div class="col-sm-2">
                                    <input type="text" name="Registration[jobs][][employer][zip]" class="form-control">
                                </div>
                                <label class="col-sm-2 col-form-label"><?= Yii::t('expat','Mesto') ?></label>
                                <div class="col-sm-5">
                                    <input type="text" name="Registration[jobs][][employer][town]" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Adresa') ?></label>
                                <div class="col-sm-9">
                                    <input type="text" name="Registration[jobs][][employer][address1]" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Adresa 2 (voliteľné)') ?></label>
                                <div class="col-sm-9">
                                    <input type="text" name="Registration[jobs][][employer][address2]" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">
                                    <?= Yii::t('expat','Popis práce (nepovinné)'); ?>
                                </label>
                                <div class="col-sm-9">
                                    <textarea name="Registration[jobs][][employer][note]" id="" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <a href="#" title="<?= Yii::t('expat','Zmazať'); ?>" class="delete-emp" data-id="1"><span class="material-icons">delete_forever</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="button" id="add-work-exp" class="btn-hoo">
                                <?= Yii::t('expat','Pridať pracovnú pozíciu'); ?>
                            </button>
                        </div>
                    </div>
                    <h4><?= Yii::t('expat','Doplňujúce informácie') ?></h4>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <textarea name="Registration[work][additionalInfo]" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                </section>
                <h1><?= Yii::t('expat','Ďalšie informácie'); ?></h1>
                <section>
                    <h4><?= Yii::t('expat','Jazykové znalosti'); ?></h4>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <select class="form-control dropdown" name="Registration[customlangs][][lang]">

                            </select>
                        </div>
                        <div class="col-sm-5">
                            <select name="Registration[customlangs][][level]" id="" class="form-control dropdown">
                                <option value="0"><?= Yii::t('expat','Vyberte úroveň'); ?></option>
                                <option value="1"><?= Yii::t('expat','Úplný začiatočník (A1)'); ?></option>
                                <option value="2"><?= Yii::t('expat','Začiatočník (A2)'); ?></option>
                                <option value="3"><?= Yii::t('expat','Mierne pokročilý (B1)'); ?></option>
                                <option value="4"><?= Yii::t('expat','Stredne pokročilý (B2)'); ?></option>
                                <option value="5"><?= Yii::t('expat','Pokročilý (C1)'); ?></option>
                                <option value="6"><?= Yii::t('expat','Expert (C2)'); ?></option>
                                <option value="7"><?= Yii::t('expat','Materinský jazyk'); ?></option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <a href="#" id="add-langs"><span class="material-icons aoreal">add_box</span></a>
                        </div>
                    </div>
                    <div id="langs"></div>
                    <h4><?php echo Yii::t('expat','Ostatné znalosti'); ?></h4>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <select class="form-control dropdown" name="Registration[knowbee][][know]">

                            </select>
                        </div>
                        <div class="col-sm-5">
                            <select name="Registration[knowbee][][level]" id="" class="form-control dropdown">
                                <option value="0"><?= Yii::t('expat','Vyberte úroveň'); ?></option>
                                <option value="1"><?= Yii::t('expat','Úplný začiatočník (A1)'); ?></option>
                                <option value="2"><?= Yii::t('expat','Začiatočník (A2)'); ?></option>
                                <option value="3"><?= Yii::t('expat','Mierne pokročilý (B1)'); ?></option>
                                <option value="4"><?= Yii::t('expat','Stredne pokročilý (B2)'); ?></option>
                                <option value="5"><?= Yii::t('expat','Pokročilý (C1)'); ?></option>
                                <option value="6"><?= Yii::t('expat','Expert (C2)'); ?></option>
                                <option value="7"><?= Yii::t('expat','Materinský jazyk'); ?></option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <a href="#" id="add-knowbee"><span class="material-icons aoreal">add_box</span></a>
                        </div>
                    </div>
                    <div id="knowbees"></div>
                    <h4><?= Yii::t('expat','Ďalšie schopnosti a znalosti'); ?></h4>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <textarea name="Registration[otherskills]" rows="20" class="form-control"></textarea>
                        </div>
                    </div>
                    <h4><?= Yii::t('expat','Fotografia'); ?></h4>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="file" name="Registration[profilepic]" id="" class="form-control">
                        </div>
                    </div>
                    <h4><?= Yii::t('expat','Heslo'); ?></h4>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Heslo'); ?></label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="Registration[pass]">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?= Yii::t('expat','Zopkovať heslo'); ?></label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="Registration[repass]">
                        </div>
                    </div>

                </section>
                <h1><?= Yii::t('expat','Služby'); ?></h1>
                <section></section>
            </form>
        </div>
        <div class="clear"></div>
    </div>

</main>

<?php
$translation['finish'] = Yii::t('expat','Nahrať');
$translation['next'] = Yii::t('expat','Ďalej');
$translation['previous'] = Yii::t('expat','Späť');

$js = <<<JS
    $(".tab-wizard").steps({
       headerTag: "h1",
       bodyTag: "section",
       transitionEffect: "fade",
       titleTemplate: '<span class="step">#index#</span> #title#',
       labels: {
           finish: "{$translation['finish']}",
           next: "{$translation['next']}",
           previous: "{$translation['previous']}"
       },
       onFinished: function (event, currentIndex) {
           $('#registration-form').submit();
       }
    });
    $('#load-idcard').click(function(){
        $('#dialog-idcard').modal('show');
    });
    $('#load-passport').click(function(){
        $('#dialog-passp').modal('show');
    });
    $('#load-drivelic').click(function(){
        $('#dialog-driver').modal('show');
    });
    $('#add-langs').click(function(){
        event.preventDefault();
    });
    $('#add-knowbee').click(function(){
        event.preventDefault();
    });
    $('.delete-emp').click(function(){
        event.preventDefault();
        let id=$(this).data('id');
    });
    $('#add-work-exp').click(function(){
       let x = $('.j-temp').clone();
       let c = $('#work > div.job').length+1;
       
       $(x).removeClass('j-temp')
           .attr('data-id',c)
           .find("input:text")
           .val("")
           .end()
           .find("a.delete-emp")
           .attr('data-id',c)
           .end()
           .appendTo('#work:last');
       
    });
JS;
$this->registerJs($js);
?>


<div class="modal fade" id="dialog-idcard" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel"><?= Yii::t('expat','Občiansky preukaz'); ?></h4>
            </div>
            <div class="modal-body">
                <div id="spin-idcard" style="display:none; text-align: center" class="mt-2">
                    <div style="font-size: 2rem; font-weight: bold">
                        <?= Yii::t('expat','Spracovávam nahraté dokumenty...'); ?>
                    </div>
                    <!--<img src="<?= Yii::getAlias('@web')?>/assets/images/loader.gif?v=1" class="ml-auto; mt-4">-->
                </div>
                <div id="dfrm-idcard">
                    <form enctype="multipart/form-data" id="frm-idcard" method="post">
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="" class="form-control-label">
                                    <?= Yii::t('expat','Krajina'); ?>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <select class="form-control dropdown" name="op_krajina">
                                    <option value=""><?= Yii::t('expat','Zvoľte krajinu'); ?></option>
                                    <?php
                                    foreach($countries as $country) {
                                        echo "<option value='{$country['id']}'>{$country['international_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="op-predna" class="form-control-label"><?= Yii::t('expat','Predná strana'); ?></label>
                            </div>
                            <div class="col-sm-9">
                                <input type="file" name="op_predna" id="op-predna" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="op-zadna" class="form-control-label"><?= Yii::t('expat','Zadná strana'); ?></label>
                            </div>
                            <div class="col-sm-9">
                                <input type="file" name="op_zadna" id="op-zadna" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-hoo" data-dismiss="modal"><?= Yii::t('expat','Zrušiť') ?></button>
                <button type="button" class="btn-hoo"><?= Yii::t('expat','Nahrať') ?></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="dialog-passp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel"><?= Yii::t('expat','Cestovný pas'); ?></h4>
            </div>
            <div class="modal-body">
                <div id="spin-passp" style="display:none; text-align: center" class="mt-2">
                    <div style="font-size: 2rem; font-weight: bold">
                        <?= Yii::t('expat','Spracovávam nahraté dokumenty...'); ?>
                    </div>
                    <!--<img src="<?= Yii::getAlias('@web')?>/assets/images/loader.gif?v=1" class="ml-auto; mt-4">-->
                </div>
                <div id="dfrm-passp">
                    <form enctype="multipart/form-data" id="frm-passp" method="post">
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="" class="form-control-label">
                                    <?= Yii::t('expat','Krajina'); ?>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <select class="form-control dropdown" name="op_krajina">
                                    <option value=""><?= Yii::t('expat','Zvoľte krajinu'); ?></option>
                                    <?php
                                    foreach($countries as $country) {
                                        echo "<option value='{$country['id']}'>{$country['international_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label class="form-control-label"><?= Yii::t('expat','Predná strana'); ?></label>
                            </div>
                            <div class="col-sm-9">
                                <input type="file" name="pp-predna" id="pp-predna" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-hoo" data-dismiss="modal"><?= Yii::t('expat','Zrušiť') ?></button>
                <button type="button" class="btn-hoo"><?= Yii::t('expat','Nahrať') ?></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="dialog-driver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel"><?= Yii::t('expat','Vodičský preukaz'); ?></h4>
            </div>
            <div class="modal-body">
                <div id="spin-driver" style="display:none; text-align: center" class="mt-2">
                    <div style="font-size: 2rem; font-weight: bold">
                        <?= Yii::t('expat','Spracovávam nahraté dokumenty...'); ?>
                    </div>
                    <!--<img src="<?= Yii::getAlias('@web')?>/assets/images/loader.gif?v=1" class="ml-auto; mt-4">-->
                </div>
                <div id="dfrm-driver">
                    <form enctype="multipart/form-data" id="frm-driver" method="post">
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label for="" class="form-control-label">
                                    <?= Yii::t('expat','Krajina'); ?>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <select class="form-control dropdown" name="driver_krajina">
                                    <option value=""><?= Yii::t('expat','Zvoľte krajinu'); ?></option>
                                    <?php
                                    foreach($countries as $country) {
                                        echo "<option value='{$country['id']}'>{$country['international_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label><?= Yii::t('expat','Predná strana'); ?></label>
                            </div>
                            <div class="col-sm-9">
                                <input type="file" name="dl-predna" id="dl-predna" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label><?= Yii::t('expat','Zadná strana'); ?></label>
                            </div>
                            <div class="col-sm-9">
                                <input type="file" name="dl_zadna" id="op-zadna" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-hoo" data-dismiss="modal"><?= Yii::t('expat','Zrušiť') ?></button>
                <button type="button" class="btn-hoo"><?= Yii::t('expat','Nahrať') ?></button>
            </div>
        </div>
    </div>
</div>










