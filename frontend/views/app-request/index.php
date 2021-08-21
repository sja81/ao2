<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use yii\helpers\Url;
use common\models\settings\Settings;

$this->title = "Finančný dotazník";

$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css',['depends'=>AppAsset::class]);
$this->registerCSSFile('@web/css/req.css?v=1.06',['depends'=>AppAsset::class]);
$this->registerJSFile('@web/js/app-request.js?v=0.6',['depends'=>AppAsset::class]);
$this->registerJSFile('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/i18n/jquery-ui-i18n.min.js',['depends'=>AppAsset::class]);
$this->registerJSFile('@web/js/tambr/ui/datepicker_langs.js');
$this->registerCSSFile('@web/css/nouislider.min.css?v=0.5',['depends'=>AppAsset::class]);
$this->registerJSFile('@web/js/nouislider.min.js?v=0.5',['depends'=>AppAsset::class]);
?>

<main class="site-applicant">
    <input type="hidden" id="client_id" value="0">
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
                    <div class="col-md-12 col-xs-12">
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
    <div id="req" class="container-fluid">
        <div class="req-container">

            <div class="ao-time-line">

            </div>

            <p id="p-1">Chcem...</p>
            <?php
            $reqs = Settings::getFinancialQuestionaryRequests();
            ?>
            <ul id="client-req">
                <?php
                foreach ($reqs as $item) {
                ?>
                    <li><input type="checkbox" class="creq" data-item="<?= $item['field_name'] ?>"><?= $item['field_value'] ?></li>
                <?php
                }
                ?>
            </ul>
            <section id="referal">
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <select class="form-control dropdown contact" id="application-source" data-item="app_src">
                            <option value="">Odkiaľ ste o nás dozvedeli?</option>
                            <option value="facebook">Facebook</option>
                            <option value="twitter">Twitter</option>
                            <option value="linkedin">Linkedin</option>
                            <option value="refcode">Od priateľa/známeho</option>
                            <option value="nodef">Iné</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row" id="other-src">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" placeholder="Sem napíšte odkiaľ ste sa o náz dozvedeli" class="form-control contact" data-item="other_src">
                    </div>
                </div>
                <div class="form-group row" id="referal-code">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" placeholder="Referal kód" class="form-control contact" data-item="referal_code">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 col-xs-6">
                        <select class="form-control dropdown contact" id="call-type" data-item="call_type">
                            <option value="">Preferovaný spôsob kontaktu</option>
                            <option value="cont-vid">Video hovor</option>
                            <option value="cont-phone">Telefon</option>
                            <option value="written">Pisomne</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <select class="form-control dropdown contact" id="call-source" data-item="call_src">
                        </select>
                    </div>
                </div>
             </section>
            <section id="client-contact">
                <h4>Kontaktné údaje</h4>
                <div class="form-group row">
                    <label class="col-md-3 col-xs-2 col-form-label">Email:</label>
                    <div class="col-md-9 col-xs-10">
                        <input type="email" class="form-control contact" value="@" data-item="client_email" id="ema-1">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-xs-2 col-form-label">Mobil:</label>
                    <div class="col-md-3 col-xs-4">
                        <select class="form-control dropdown contact" data-item="client_mobile_area">
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
                        <input type="tel" class="form-control contact" placeholder="9XXXXXXXX" data-item="client_mobile">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-xs-2 col-form-label">Pevná linka:</label>
                    <div class="col-md-3 col-xs-4">
                        <select class="form-control dropdown contact" data-item="client_landline_area">
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
                        <input type="tel" class="form-control contact" data-item="client_landline">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-xs-2 col-form-label">Fax:</label>
                    <div class="col-md-3 col-xs-4">
                        <select class="form-control dropdown contact" data-item="client_fax_area">
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
                        <input type="tel" class="form-control contact" data-item="client_fax">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12 mt-3">
                        <label for="cl-news" class="form-label">
                            <input type="checkbox" id="cl-news" checked>
                            &nbsp;
                            Mám záujem o zasielanie noviniek e-mailom
                        </label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <label class="form-label">
                            <input type="checkbox" id="cl-consent">
                            &nbsp;
                            <?= Yii::t('app','Súhlasím s použitím osobných údajov na marketingové účely') ?>
                            Súhlasím s použitím osobných údajov na marketingové účely
                        </label>
                        <p class="consent-note mt-1 text-justify">
                            Stlačením „Odoslať“ potvrdzujem, že som sa oboznámil(a) so Všeobecnými
                            obchodnými podmienkami spoločnosti, prečítal(a) som ich a porozumel(a) ich
                            obsahu a v celom rozsahu s nimi súhlasím.
                        </p>
                        <p class="consent-note text-justify">
                            Poskytnutím svojich osobných údajov a/alebo údajov Tretej osoby Poskytovateľovi spoločnosti
                            <span class="aoreal">ALPHA-OMEGA REAL & CONSULTING s. r. o.</span>, <strong>so sídlom Černyševského 10, 851 01 Bratislava - mestská časť Petržalka</strong>,
                            IČO: 51 81 7594, zapísaná v Obchodnom registri Okresného súdu Bratislava I, oddiel: Sro, vložka č. 129875/B (Poskutovateľ),
                            týmto ako Užívateľ/Zákazník a/alebo ako zákonný zástupca
                            Tretej osoby oprávnený na ich poskytnutie, vyjadrujem slobodný, vážny a dobrovoľný súhlas
                            s ich spracúvaním Poskytovateľom a to v súlade a za podmienok stanovených Zásadami spracúvania
                            osobných údajov Poskytovateľa.
                        </p>
                        <p class="consent-note text-justify">
                            Zároveň týmto vyhlasujem, že všetky mnou poskytnuté osobné údaje sú pravdivé, úplné a správne.
                        </p>
                        <p class="consent-note text-justify">
                            Tento súhlas so spracovaním osobných údajov spracúvaných na základe súhlasu je možné
                            kedykoľvek odvolať elektronicky zaslaním e-mailu na
                            <a href="mailto:gdpr@aoreal.sk?subject=Odvolanie súhlasu na spracovanie osobných údajov">gdpr@aoreal.sk</a>.
                        </p>
                    </div>
                </div>
                <div class="section-footer">
                    <button type="button" class="btn-sm btn-hoo" id="save-contact">Pokračovať</button>
                </div>
            </section>
            <section id="client-papers">
                <h4>Doklady</h4>
                <p>Ak nechcete nahrať svoje dokumenty, pokračujte ďalej stlačením tlačítka "Pokračovať".</p>
                <form enctype="multipart/form-data" id="cdoc" method="post">
                    <div class="form-group row mt-5">
                        <div class="col-md-12 col-xs-12">
                            <select class="form-control dropdown" id="cdoc-type">
                                <?php
                                foreach($cust_docs as $item) {
                                    ?>
                                    <option value="<?= $item['id']?>"><?= $item['internal_text'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mt-10">
                        <label class="col-md-3 col-xs-4 col-form-label">Predná strana</label>
                        <div class="col-md-9 col-xs-8">
                            <input type="file" name="op_predna" id="op-predna">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-xs-4 col-form-label">Zadná strana</label>
                        <div class="col-md-9 col-xs-8">
                            <input type="file" name="op_zadna" id="op-zadna">
                        </div>
                    </div>
                </form>
                <div class="section-footer">
                    <button type="button" class="btn-sm" id="docup">Nahrať</button>
                    <button type="button" class="btn-sm btn-default" id="cl-pap-back">Späť</button>
                    <button type="button" class="btn-sm" id="cl-pap-next">Pokračovať</button>
                </div>
            </section>
            <section id="client-basic-data">
                <h4>Osobné a rodinné údaje</h4>
                <div class="form-group row">
                    <div class="col-md-6 col-xs-6">
                        <select class="form-control dropdown client-data" data-item="adegree_before">
                            <option value="">Titul pred menom</option>
                            <?php
                            foreach ($titul_pred as $item) {
                                echo"<option value='{$item['short_name']}'>{$item['short_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <select class="form-control dropdown client-data" data-item="adegree_after">
                            <option value="">Titul za menom</option>
                            <?php
                            foreach ($titul_za as $item) {
                                echo"<option value='{$item['short_name']}'>{$item['short_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 col-xs-6">
                        <input type="text" class="form-control client-data c-name" placeholder="Meno" data-item="first_name">
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <input type="text" class="form-control client-data c-givenname" placeholder="Priezvisko" data-item="last_name">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 col-xs-6">
                        <input type="text" class="form-control client-data c-maidenname" placeholder="Rodné priezvisko" data-item="maiden_name">
                    </div>
                    <div class="col-md-6 col-xs-6">
                    </div>
                </div>
                <div class="section-footer">
                    <button type="button" class="btn-sm btn-default" id="cl-bas-data-back">Späť</button>
                    <button type="button" class="btn-sm" id="save-client-data">Pokračovať</button>
                </div>
            </section>
            <section id="client-address">
                <h4>Adresa</h4>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <select class="form-control dropdown client-address c-country" data-item="perm_country">
                            <option value="">Zvoľte si krajinu...</option>
                            <?php
                            foreach ($staty as $stat) {
                                ?>
                                <option value="<?= $stat->id ?>"><?=  $stat->name ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-5 col-xs-3">
                        <input type="text" class="form-control client-address" id="addr-zip" placeholder="PSČ" data-item="perm_zip">
                    </div>
                    <div class="col-md-7 col-xs-9">
                        <input type="text" id="add-town" placeholder="Mesto" class="form-control client-address" data-item="perm_town">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-9 col-xs-8">
                        <input type="text" class="form-control client-address c-permaddress" placeholder="Ulica a číslo" data-item="perm_street">
                    </div>
                    <div class="col-md-3 col-xs-4">
                        <input type="text" class="form-control doc-cal client-address" placeholder="Od roku" data-item="perm_from">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-xs-5 col-form-label">Korešpondenčná adresa:</label>
                    <div class="col-md-8 col-xs-7">
                            <span class="radio-holder">
                                <input type="radio" name="D[]" id="perm-addr1"> Zhodná s trvalým bydliskom
                            </span>
                        <span class="radio-holder">
                                <input type="radio" name="D[]" id="perm-addr2"> Iná ako trvalé bydlisko
                            </span>
                    </div>
                </div>
                <div class="form-group row client-other-addr">
                    <div class="col-md-12 col-xs-12">
                        <select class="form-control dropdown client-address" data-item="temp_country">
                            <option value="">Zvoľte si krajinu...</option>
                            <?php
                            foreach ($staty as $stat) {
                                ?>
                                <option value="<?= $stat->id ?>"><?=  $stat->name ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row client-other-addr">
                    <div class="col-md-5 col-xs-4">
                        <input type="text" class="form-control client-address" id="addr-other-zip" placeholder="PSČ" data-item="temp_zip">
                    </div>
                    <div class="col-md-7 col-xs-8">
                        <input type="text" class="form-control client-address" placeholder="Mesto" data-item="temp_town">
                    </div>
                </div>
                <div class="form-group row client-other-addr">
                    <div class="col-md-9 col-xs-8">
                        <input type="text" class="form-control client-address" placeholder="Ulica a číslo" data-item="temp_street">
                    </div>
                    <div class="col-md-3 col-xs-4">
                        <input type="text" class="form-control doc-cal client-address" placeholder="Od roku" data-item="temp_from">
                    </div>
                </div>
                <div class="section-footer">
                    <button type="button" class="btn-sm btn-default" id="cl-addr-back">Späť</button>
                    <button type="button" class="btn-sm" id="save-client-address">Pokračovať</button>
                </div>
            </section>
            <section id="client-personal-data">
                <h4>Ostatné osobné údaje</h4>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <select class="form-control dropdown other-personal o-country" data-item="citizenship">
                            <option value="">Štátne občianstvo...</option>
                            <?php
                            foreach ($staty as $stat) {
                                ?>
                                <option value="<?= $stat->id ?>"><?=  $stat->name ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <select
                                class="form-control dropdown other-personal"
                                data-item="gender"
                                id="c-gend"
                        >
                            <option value="">Zvolte pohlavie</option>
                            <option value="m">Muž</option>
                            <option value="f">Žena</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input
                                type="text"
                                class="form-control other-personal"
                                placeholder="Rodné číslo"
                                data-item="ssn"
                                id="c-ssn"
                        >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input
                                type="text"
                                class="form-control doc-cal other-personal"
                                placeholder="Dátum narodenia"
                                data-item="birth_date"
                                id="c-birth"
                        >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control other-personal" placeholder="Miesto narodenia" id="born-place" data-item="birth_place">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <select class="form-control other-personal" data-item="education">
                            <option value="">Vyberte vzdelanie</option>
                            <?php
                            foreach ($educations as $edu) {
                                ?>
                                <option value="<?= $edu['id'] ?>"><?= $edu['internal_text'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="section-footer">
                    <button type="button" class="btn-sm btn-default" id="cl-persdat-back">Späť</button>
                    <button type="button" class="btn-sm" id="save-other-personal-data">Pokračovať</button>
                </div>
            </section>
            <section id="client-docs">
                <h4>Údaje o identifikačnom preukaze</h4>
                <div class="doc" data-order="1">
                    <h5>Doklad č.1</h5>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <select class="form-control dropdown client-docs" data-item="doc_type" data-order="1">
                                <option value="">Typ dokladu</option>
                                <?php
                                foreach($cust_docs as $item) {
                                    ?>
                                    <option value="<?= $item['id']?>"><?= $item['internal_text'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input type="text" class="form-control client-docs" placeholder="Číslo dokladu" data-item="doc_number" data-order="1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <select class="form-control dropdown client-docs" data-item="doc_country" data-order="1">
                                <option value="">Štát vydania dokladu</option>
                                <?php
                                foreach ($staty as $stat) {
                                    ?>
                                    <option value="<?= $stat->id ?>"><?=  $stat->name ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input type="text" class="form-control client-docs" placeholder="Doklad vydal" data-item="doc_issuer" data-order="1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 col-xs-6">
                            <input type="text" class="form-control doc-cal client-docs" placeholder="Dátum vydania" data-item="issue_date" data-order="1">
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <input type="text" class="form-control doc-cal client-docs" placeholder="Dátum platnosti" data-item="validity_date" data-order="1">
                        </div>
                    </div>
                </div>
                <div class="section-footer">
                    <button type="button" class="btn-sm" id="add-document">Pridať</button>
                    <button type="button" class="btn-sm btn-default" id="cust-docs-back">Späť</button>
                    <button type="button" class="btn-sm" id="save-client-docs">Pokračovať</button>
                </div>
            </section>
            <section id="family-data">
                <h4>Rodinné údaje</h4>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <select class="form-control fam-data" data-item="marital_status">
                            <option value="">Rodinný stav</option>
                            <?php
                            foreach ($marital_status as $item) {
                                ?>
                                <option value="<?= $item['id'] ?>"><?= $item['internal_text'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <select class="form-control fam-data" data-item="way_of_living">
                            <option value="">Spôsob bývania</option>
                            <?php
                            foreach ($living as $item) {

                                ?>
                                <option value="<?= $item['id'] ?>"><?= $item['internal_text'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <select class="form-control dropdown fam-data" data-item="residence_type">
                            <option value="">Druh nehnuteľnosti trvalého bydliska</option>
                            <?php
                            foreach ($property_type as $item) {
                                ?>
                                <option value="<?= $item['id'] ?>"><?= $item['nazov'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input
                                type="text"
                                class="form-control doc-cal fam-data"
                                placeholder="Od ktorého roku bývate na tejto adrese?"
                                data-item="living_from"
                        >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <select class="form-control dropdown fam-data" data-item="shared_household">
                            <option value="">Bývanie v spoločnej domácnosti</option>
                            <option value="1">Áno</option>
                            <option value="0">Nie</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <select class="form-control dropdown fam-data" data-item="bsm">
                            <option value="">Bezpodielové spoluvlastníctvo manželov BSM</option>
                            <option value="0">Nie</option>
                            <option value="1">Áno</option>
                            <option value="2">Zúžené BSM</option>
                            <option value="3">Zrušené BSM</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-6 col-xs-7 col-form-label">Počet dospelých v rodine:</label>
                    <div class="col-md-6 col-xs-5">
                        <input
                                type="number"
                                class="form-control fam-data"
                                min="0"
                                value="0"
                                data-item="cnt_adults_in_family"
                        >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-6 col-xs-7 col-form-label">Počet nezaopatrených detí:</label>
                    <div class="col-md-6 col-xs-5">
                        <input
                                type="number"
                                class="form-control fam-data"
                                min="0"
                                value="0"
                                data-item="cnt_nourished_child"
                        >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-6 col-xs-7 col-form-label">Počet plnoletých osôb v domácnosti:</label>
                    <div class="col-md-6 col-xs-5">
                        <input
                                type="number"
                                class="form-control fam-data"
                                min="0"
                                value="0"
                                data-item="cnt_adults_in_household"
                        >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <select
                                class="form-control dropdown fam-data"
                                id="nourishing"
                                data-item="maint_obligation"
                        >
                            <option value="">Vyživovacia povinnosť iných osôb</option>
                            <option value="1">Áno</option>
                            <option value="0">Nie</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row vyzivne">
                    <div class="col-md-12 col-xs-12">
                        <input
                                type="text"
                                class="form-control fam-data"
                                placeholder="Výživné určené súdom"
                                data-item="alimony_by_court"
                        >
                    </div>
                </div>
                <div class="form-group row vyzivne">
                    <label class="col-md-6 col-xs-7 col-form-label">Počet dospelých s výživným:</label>
                    <div class="col-md-6 col-xs-5">
                        <input type="number" class="form-control fam-data" min="0" value="0" data-item="cnt_nourished_adult">
                    </div>
                </div>
                <div class="form-group row vyzivne">
                    <label class="col-md-6 col-xs-7 col-form-label">Počet detí s výživným:</label>
                    <div class="col-md-6 col-xs-5">
                        <input type="number" class="form-control fam-data" min="0" value="0" data-item="cnt_nourished_child">
                    </div>
                </div>
                <div class="section-footer">
                    <button type="button" class="btn-sm btn-default" id="cl-famdata-back">Späť</button>
                    <button type="button" class="btn-sm" id="client-save-family-data">Pokračovať</button>
                </div>
            </section>
            <section id="income-src">
                <h4>Aké sú Vaše zdroje príjmu?</h4>
                <p>Tu si zvoľte zdroje Vášho mesačné/ročného príjmu. Napr. ak ste zamestnaný/á na trvalý pracovný pomer,
                    zaškrtnite <strong>"Zamestnanie"</strong> a zadajte, koľko máte takýchto zamestananí. </p>
                <p>
                    Ak ste napr. súčasne aj majiteľom nejakej s.r.o. a ste aj zamestnaný, zaškrtnite aj <strong>"Zamestnanie"</strong> aj
                    <strong>"som majiteľom s.r.o/a.s."</strong>.
                </p>
                <div class="form-group row mb-5 mt-10 pl-5 pr-5">
                    <div class="col-md-1 col-xs-2">
                        <input type="checkbox" id="perm-work">
                    </div>
                    <div class="col-md-9 col-xs-7">
                        <label  class="col-form-label">Zamestnanie</label>
                    </div>
                    <div class="col-md-2 col-xs-3">
                        <input type="number" id="perm-work-cnt" class="form-control" min="0" value="0">
                    </div>
                </div>
                <div class="form-group row mb-5 pl-5 pr-5">
                    <div class="col-md-1 col-xs-2 ">
                        <input type="checkbox" id="self-emp">
                    </div>
                    <div class="col-md-9 col-xs-7">
                        <label  class="col-form-label">Samostane zárobkovo činná osoba - SZČO</label>
                    </div>
                    <div class="col-md-2 col-xs-3"></div>
                </div>
                <div class="form-group row pl-5 pr-5">
                    <div class="col-md-1 col-xs-1">
                        <input type="checkbox" id="bus-owner">
                    </div>
                    <div class="col-md-9 col-xs-6">
                        <label  class="col-form-label">som majiteľom s.r.o/a.s</label>
                    </div>
                    <div class="col-md-2 col-xs-3">
                        <input type="number" id="bus-owner-cnt" class="form-control" min="0" value="0">
                    </div>
                </div>
                <div class="section-footer">
                    <button class="btn-sm btn-default" type="button">Späť</button>
                    <button class="btn-sm" type="button" id="save-income-src">Pokračovať</button>
                </div>
            </section>
            <section id="client-jobs">
                <h4>Zamestnanie</h4>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <select id="soc-sec-sickleave" class="form-control social-data" data-item="sick_leave">
                            <option value="">Kedy ste boli naposledy na PN?</option>
                            <option value="1">Bol som (pred viac ako 6. mesiacmi)</option>
                            <option value="2">Bol som (pred menej ako 6. mesiacmi)</option>
                            <option value="3">Aktuálne trvá...</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row sickleave-row">
                    <div class="col-md-6 col-xs-6">
                        <input
                                type="text"
                                class="form-control doc-cal social-data"
                                placeholder="Od"
                                data-item="sick_leave_from"
                        >
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <input
                                type="text"
                                class="form-control doc-cal sickleave social-data"
                                placeholder="Do"
                                data-item="sick_leave_to"
                        >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <select class="form-control social-data" id="maternity" data-item="maternity">
                            <option value="">Boli ste na materskej?</option>
                            <option value="1">Bol som...</option>
                            <option value="2">Budem...</option>
                            <option value="3">Aktuálne trvá...</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row maternity-row">
                    <div class="col-md-6 col-xs-6">
                        <input
                                type="text"
                                class="form-control doc-cal social-data"
                                placeholder="Od"
                                data-item="maternity_from"
                        >
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <input
                                type="text"
                                class="form-control doc-cal maternity-leave social-data"
                                placeholder="Do"
                                data-item="maternity_to"
                        >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <select class="form-control dropdown social-data" id="pension" data-item="pension">
                            <option value="">Ste na dôchodku?</option>
                            <option value="1">Budem...</option>
                            <option value="2">Aktuálne som...</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row pension-row">
                    <div class="col-md-6 col-xs-6">
                        <input type="text" class="form-control doc-cal social-data" placeholder="Od" data-item="pension_from">
                    </div>
                    <div class="col-md-6 col-xs-6">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <select class="form-control dropdown social-data" id="inv-pension" data-item="invalidity_pension">
                            <option value="">Ste na invalidnom dôchodku?</option>
                            <option value="1">Budem...</option>
                            <option value="2">Aktualne som...</option>
                            <option value="3">Bol som...</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row inv-pension-row">
                    <div class="col-md-6 col-xs-6">
                        <input type="text" class="form-control doc-cal social-data" placeholder="Od" data-item="invalidity_pension_from">
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <input type="text" class="form-control doc-cal inv-pension-to social-data" placeholder="Do" data-item="invalidity_pension_to">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <!-- eddig ledolgozott evek szama -->
                        <input
                                type="text"
                                class="form-control social-data"
                                placeholder="Celková doba zamestnania (RR/MM)"
                                data-item="total_employment"
                        >
                    </div>
                </div>
                <div class="employer" data-order="1">
                    <h5 class="mb-4">Zamestnávateľ č.1</h5>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <select class="form-control jobs" data-order="1" data-item="profession">
                                <option value="">Profesia</option>
                                <?php
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
                        <div class="col-md-12 col-xs-12">
                            <select class="form-control jobs" data-order="1" data-item="employment_type">
                                <option value="">Druh zamestnania</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-xs-5 col-form-label">Spôsob poberania príjmu:</label>
                        <div class="col-md-8 col-xs-7">
                            <span class="radio-holder">
                                <input
                                        type="radio"
                                        name="payroll"
                                        id="pay-cash"
                                        data-order="1"
                                        data-item="payroll_payout"
                                        class="jobs"
                                        data-default-value="cash"
                                > V hotovosti
                            </span>
                            <span class="radio-holder">
                                <input
                                        type="radio"
                                        name="payroll"
                                        id="pay-acc"
                                        data-order="1"
                                        data-item="payroll_payout"
                                        data-default-value="account"
                                        class="jobs"
                                > Na účet
                            </span>
                        </div>
                    </div>
                    <div class="form-group row payroll">
                        <div class="col-md-12 col-xs-12">
                            <input
                                    type="text"
                                    class="form-control jobs"
                                    placeholder="IBAN"
                                    data-order="1"
                                    data-item="payroll_iban"
                            >
                        </div>
                    </div>
                    <div class="form-group row payroll">
                        <div class="col-md-12 col-xs-12">
                            <select
                                    class="form-control dropdown jobs"
                                    data-order="1"
                                    data-item="payroll_bank"
                            >
                                <option value="">Názov banky</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-xs-5 col-form-label">Doba aktuálneho pracovného pomeru:</label>
                        <div class="col-md-8 col-xs-7">
                            <span class="radio-holder">
                                <input type="radio" class="jobs" name="workterm" data-order="1" data-item="work_term" data-default-value="permanent"> Na dobu neurčitú
                            </span>
                            <span class="radio-holder">
                                <input type="radio" class="jobs" name="workterm" data-order="1" data-item="work_term" data-default-value="fixed"> Na dobu určitú
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 col-xs-6">
                            <input type="text" class="form-control doc-cal jobs" placeholder="Od" data-order="1" data-item="work_from">
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <input type="text" class="form-control doc-cal jobs" placeholder="Do" data-order="1" data-item="work_to">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input
                                    type="text"
                                    class="form-control jobs"
                                    placeholder="Doba zamestnania v terajšom odbore (RR/MM)"
                                    data-order="1"
                                    data-item="worktime_in_profession"
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input
                                    type="text"
                                    class="form-control jobs"
                                    placeholder="Názov zamestnvateľa"
                                    data-order="1"
                                    data-item="employer_name"
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <select class="form-control dropdown jobs" data-order="1" data-item="country">
                                <option value="">Zvoľte si krajinu...</option>
                                <?php
                                foreach ($staty as $stat) {
                                    ?>
                                    <option value="<?= $stat->id ?>"><?=  $stat->name ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-5 col-xs-4">
                            <input type="text" class="form-control jobs" placeholder="PSČ" data-order="1" data-item="zip">
                        </div>
                        <div class="col-md-7 col-xs-8">
                            <input type="text" placeholder="Mesto" class="form-control jobs" data-order="1" data-item="town">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input type="text" class="form-control jobs" placeholder="Ulica, číslo" data-order="1" data-item="address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 col-xs-6">
                            <input type="text" class="form-control jobs" placeholder="IČO" data-order="1" data-item="company_id">
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <input type="text" class="form-control jobs" placeholder="DIČ" data-order="1" data-item="tax_id">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <select class="form-control dropdown jobs" data-order="1" data-item="legal_form">
                                <option value="">Právna forma</option>
                                <?php
                                foreach ($legal_form as $item) {
                                    ?>
                                    <option value="<?= $item['id'] ?>"><?= $item['internal_text'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input type="text" class="form-control jobs" placeholder="IBAN" data-order="1" data-item="iban">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <select class="form-control dropdown jobs" data-order="1" data-item="bank_name">
                                <option value="">Názov banky</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input
                                    type="text"
                                    class="form-control jobs"
                                    placeholder="Ovládaný/vlastnený subjektom"
                                    data-order="1"
                                    data-item="owned_controlled_by"
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <select class="form-control dropdown jobs" data-order="1" data-item="industry">
                                <option value="">Odvetvie</option>
                                <?php
                                foreach($industry as $item) {
                                ?>
                                    <option value="<?= $item['id'] ?>"><?= $item['internal_text'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input
                                    type="text"
                                    class="form-control jobs"
                                    placeholder="Doba existencie"
                                    data-order="1"
                                    data-item="time_of_existence"
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-xs-2 col-form-label">Mobil:</label>
                        <div class="col-md-3 col-xs-4">
                            <select class="form-control dropdown jobs" data-order="1" data-item="mobile_area">
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
                            <input type="text" class="form-control jobs" placeholder="Napr. 9xx xxx xxx" data-order="1" data-item="mobile">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-xs-2 col-form-label">Pevná linka:</label>
                        <div class="col-md-3 col-xs-4">
                            <select class="form-control dropdown jobs" data-order="1" data-item="landline-area">
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
                            <input type="text" class="form-control jobs" data-order="1" data-item="landline">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-xs-2 col-form-label">Fax:</label>
                        <div class="col-md-3 col-xs-4">
                            <select class="form-control dropdown jobs" data-order="1" data-item="fax_area">
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
                            <input type="text" class="form-control jobs" data-order="1" data-item="fax">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-xs-2 col-form-label">E-mail:</label>
                        <div class="col-md-9 col-xs-10">
                            <input type="email" class="form-control jobs" value="@" data-order="1" data-item="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input type="text" class="form-control jobs" placeholder="Kontaktná osoba" data-order="1" data-item="contact_person">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input type="text" class="form-control jobs" value="https://" data-order="1" data-item="web">
                        </div>
                    </div>
                    <h6>Čistý mesačný príjem zo závislej činnosti za posledných 12 mesiacov</h6>
                    <?php
                    for ($i=0; $i < 12; $i++) {
                        ?>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label"><?= $i+1 ?>. mesiac:</label>
                            <div class="col-md-8">
                                <input
                                        type="number"
                                        class="form-control jobs calc-avg-wage"
                                        data-order="1"
                                        data-item="netwage_<?= $i+1 ?>"
                                        min="0" value="0"
                                >
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <h6>Priemerný čistý mesačný príjem zo závislej činnosti za posledných</h6>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">4 mesiacov</label>
                        <div class="col-md-9">
                            <input
                                    type="number"
                                    class="form-control jobs"
                                    id="avg-4m-wage"
                                    data-order="1"
                                    data-item="avg_4month_netwage"
                                    min="0" value="0"
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">6 mesiacov</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control jobs" id="avg-6m-wage" data-order="1" data-item="avg_6month_netwage" min="0" value="0" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">12 mesiacov</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control jobs" id="avg-12m-wage" data-order="1" data-item="avg_12month_netwage" min="0" value="0" >
                        </div>
                    </div>
                    <h6>Priemerný hrubý mesačný príjem zo závislej činnosti za posledných</h6>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">12 mesiacov</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control jobs" data-order="1" data-item="avg_12month_grosswage" min="0" value="0">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input
                                    type="number"
                                    class="form-control jobs"
                                    placeholder="Súhrnná suma vedľajších mesačných príjmov"
                                    data-order="1"
                                    data-item="sum_of_extra_income"
                                    min="0"
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input
                                    type="number"
                                    class="form-control jobs"
                                    placeholder="13. a/alebo 14. plat"
                                    data-order="1"
                                    data-item="extra_wage"
                                    min="0"
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 col-xs-6">
                            <select class="form-control dropdown jobs" data-order="1" data-item="bonus_freq">
                                <option value="">Frekvencia bonusov</option>
                                <?php
                                foreach ($bonus_freq as $item){
                                    ?>
                                    <option value="<?= $item['id'] ?>"><?= $item['internal_text'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <input
                                    type="number"
                                    class="form-control jobs"
                                    placeholder="Suma bonusov"
                                    data-order="1"
                                    data-item="sum_of_bonuses"
                                    min="0"
                            >
                        </div>
                        <div class="col-md-6 col-xs-6"></div>
                    </div>
                </div>
                <div class="section-footer">
                    <button class="btn-sm btn-default" type="button">Späť</button>
                    <button class="btn-sm" type="button" id="save-client-jobs">Pokračovať</button>
                </div>
            </section>
            <section id="client-business">
                <h4>Podnikanie</h4>
                <div class="business" data-order="1">
                    <h5 class="mb-4">Podnikanie č.1</h5>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input type="text" class="form-control biz" placeholder="Názov" data-item="name" data-order="1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <select class="form-control dropdown biz" data-item="country" data-order="1">
                                <option value="">Zvoľte si krajinu...</option>
                                <?php
                                foreach ($staty as $stat) {
                                    ?>
                                    <option value="<?= $stat->id ?>"><?=  $stat->name ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-5">
                            <input type="text" class="form-control biz" placeholder="PSČ" data-item="zip" data-order="1">
                        </div>
                        <div class="col-md-7">
                            <input type="text" placeholder="Mesto" class="form-control biz" data-item="town" data-order="1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input type="text" class="form-control biz" placeholder="Ulica, číslo" data-item="address" data-order="1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 col-xs-6">
                            <input type="text" class="form-control biz" placeholder="IČO" data-item="company_id" data-order="1">
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <input type="text" class="form-control biz" placeholder="DIČ" data-item="tax_id" data-order="1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <select class="form-control dropdown biz" data-item="legal_form" data-order="1">
                                <option value="">Právna forma</option>
                                <?php
                                foreach ($legal_form as $item) {
                                    ?>
                                    <option value="<?= $item['id'] ?>"><?= $item['internal_text'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input type="text" class="form-control biz" placeholder="IBAN" data-item="iban" data-order="1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <select class="form-control biz" data-item="bank_name" data-order="1">
                                <option value="">Názov banky</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input
                                    type="text"
                                    class="form-control biz"
                                    placeholder="Ovládaný/vlastnený subjektom"
                                    data-order="1"
                                    data-item="owned_controlled_by"
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input type="text" class="form-control biz" placeholder="Dĺžka podnikania – v mesiacoch">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <select class="form-control biz">
                                <option value="">Odvetvie</option>
                                <?php
                                foreach($industry as $item) {
                                    ?>
                                    <option value="<?= $item['id'] ?>"><?= $item['internal_text'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Mobil:</label>
                        <div class="col-md-3">
                            <select class="form-control dropdown biz" data-item="mobile_area_code" data-order="1">
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
                            <input type="text" class="form-control biz" data-item="mobile" data-order="1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Pevná linka:</label>
                        <div class="col-md-3">
                            <select class="form-control dropdown biz" data-item="landline_area_code" data-order="1">
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
                            <input type="text" class="form-control biz" data-item="landline" data-order="1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Fax:</label>
                        <div class="col-md-3">
                            <select class="form-control dropdown biz" data-item="fax_area_code" data-order="1">
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
                            <input type="text" class="form-control biz" data-item="fax" data-order="1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">E-mail:</label>
                        <div class="col-md-9">
                            <input type="email" class="form-control biz" value="@" data-item="email" data-order="1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input type="text" class="form-control biz" placeholder="Kontaktná osoba" data-item="contact_person" data-order="1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input type="text" class="form-control biz" value="https://" data-item="web" data-order="1">
                        </div>
                    </div>
                </div>
                <h6>Príjmy z podnikania</h6>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control biz" placeholder="Celkové ročné príjmy" data-order="1" data-item="total_yearly_income">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control biz" placeholder="Základ dane (príjmy – výdavky)" data-item="tax_base" data-order="1">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control biz" placeholder="Daň" data-item="tax" data-order="1">
                    </div>
                </div>
                <div class="section-footer">
                    <button class="btn-sm btn-default" id="client-business-back" type="button">Späť</button>
                    <button class="btn-sm" type="button" id="save-client-business">Pokračovať</button>
                </div>
            </section>
            <section id="client-cashflow">
                <h4>Ostatné príjmy a výdavky</h4>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control o-income" placeholder="IBAN bežného účtu z ktorého plánujete splácať úver" data-item="iban_for_loan_repay">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" id="bank-12" class="form-control o-income" data-item="bank_for_loan_repay" placeholder="Názov banky">
                    </div>
                </div>
                <h5>Sociálne dávky dlhodobého charakteru</h5>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control o-income" placeholder="Starobný dôchodok" data-item="old_age_pension">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control o-income" placeholder="Invalidný dôchodok" data-item="disability_pension">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control o-income" placeholder="Výsluhový dôchodok" data-item="retirement_pension">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control o-income" placeholder="Vdovský dôchodok" data-item="widow_pension">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control o-income" placeholder="Rodičovský príspevok/prídavok na dieťa" data-item="parental_allowance">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control o-income" placeholder="Výživné" data-item="nutritious">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control o-income" placeholder="Sirotský dôchodok" data-item="orphan_pension">
                    </div>
                </div>
                <h5>Ostatné mesačné príjmy</h5>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control o-income" placeholder="Prenájom" data-item="lease">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control o-income" placeholder="Diéty" data-item="diets">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control o-income" placeholder="Dividendy" data-item="dividends">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control o-income" placeholder="Ostatné mesačné príjmy" data-item="other_monthly_income">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control o-income" placeholder="Renty" data-item="rent">
                    </div>
                </div>
                <h5>Výdavky</h5>
                <div class="form-group row">
                    <div class="col-md-10 col-xs-10">
                        <select class="form-control dropdown" id="product-list">
                            <option value="">Zvoľte produkt</option>
                            <option value="LOANS">Výška mesačných splátok skôr poskytnutých úverov</option>
                            <option value="CREDITLIMIT">Výška limitu povoleného prečerpania na účte</option>
                            <option value="CREDITCARD">Výška limitu kreditnej karty</option>
                            <option value="LEASING">Výška mesačných splátok leasingu</option>
                            <option value="INSTALLMENT">Výška mesačných splátok tovaru na splátky</option>
                        </select>
                    </div>
                    <div class="col-md-2 col-xs-2">
                        <button type="button" class="btn-sm" id="add-product">Pridať</button>
                    </div>
                </div>
                <!-- template -->
                <div class="card template" style="display: none">
                    <input type="hidden" value="" data-order="1" data-item="exp_type" class="pp-list">
                    <div class="card-block">
                        <div class="form-group row">
                            <div class="col-md-6 col-xs-6">
                                <select class="form-control dropdown pp-list" data-order="1" data-item="owner">
                                    <option value="">Inštitúcia</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <input
                                        type="text"
                                        class="form-control pp-list"
                                        placeholder="Výška splátky"
                                        data-order="1"
                                        data-item="payment"
                                >
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 col-xs-6">
                                <input
                                        type="text"
                                        class="form-control pp-list"
                                        placeholder="Pôvodné čerpanie/Povolený limit"
                                        data-order="1"
                                        data-item="amount"
                                >
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <input
                                        type="text"
                                        class="form-control pp-list"
                                        placeholder="Zostatok záväzkov"
                                        data-order="1"
                                        data-item="balance"
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of template -->
                <div class="prev-prods-list">
                </div>
                <h6>Ostatné výdavky</h6>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input
                                type="text"
                                class="form-control o-exp"
                                placeholder="Výška iných pravidelných mesačných výdavkov v € (mimo výdavkov na bývanie)"
                                data-item="regular_mothly_expenses"
                        >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input
                                type="text"
                                class="form-control o-exp"
                                placeholder="Mesačná platba výživného"
                                data-item="mothly_nutritious"
                        >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input
                                type="text"
                                class="form-control o-exp"
                                placeholder="Celková suma exekúcií"
                                data-item="total_sum_of_exec"
                        >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input
                                type="text"
                                class="form-control o-exp"
                                placeholder="Náklady na domácnosť"
                                data-item="household_costs"
                        >
                    </div>
                </div>
                <div class="section-footer">
                    <button class="btn-sm btn-default" id="" type="button">Späť</button>
                    <button type="button" class="btn-sm" id="save-client-cashflow">Pokračovať</button>
                    <button type="button" id="_fs01" class="btn-sm">Uložiť</button>
                </div>
            </section>
            <section id="mortgage-calculator">
                <?php
                $limits = Settings::getFinancialQuestionaryCalcLimits();
                ?>
                <h4>Hypotéka</h4>
                <!-- pozadovana vyska hypoteky -->
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <label class="form-control-label">Požadovaná výška hypotéky</label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2 col-xs-2"></div>
                    <div class="col-md-1 col-xs-1"><label class="form-control-label">Od</label></div>
                    <div class="col-md-4 col-xs-4"><input type="number" id="mortgage-amount-min" min="0" value="<?= $limits['mortgage_amount_start1'] ?>"></div>
                    <div class="col-md-1 col-xs-1"><label class="form-control-label">Do</label></div>
                    <div class="col-md-4 col-xs-4"><input type="number" id="mortgage-amount-max" min="0" value="<?= $limits['mortgage_amount_start2'] ?>"></div>
                </div>
                <div class="form-group row mt-5">
                    <div class="col-md-12 col-xs-12">
                        <div id="mortage-calc-amount"></div>
                    </div>
                </div>
                <!-- pozadovane obdobie -->
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <label class="form-control-label">Na požadované obdobie</label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2 col-xs-2"></div>
                    <div class="col-md-1 col-xs-1"><label class="form-control-label">Od</label></div>
                    <div class="col-md-4 col-xs-4"><input type="number" id="mortgage-season-min" min="0" value="<?= $limits['mortgage_season_start1'] ?>"></div>
                    <div class="col-md-1 col-xs-1"><label class="form-control-label">Do</label></div>
                    <div class="col-md-4 col-xs-4"><input type="number" id="mortgage-season-max" min="0" value="<?= $limits['mortgage_season_start2'] ?>"></div>
                </div>
                <div class="form-group row mt-5">
                    <div class="col-md-12 col-xs-12">
                        <div id="mortage-calc-season"></div>
                    </div>
                </div>
                <!-- fixacia -->
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <label class="form-control-label">S fixáciou</label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2 col-xs-2"></div>
                    <div class="col-md-1 col-xs-1"><label class="form-control-label">Od</label></div>
                    <div class="col-md-4 col-xs-4"><input type="number" id="mortgage-fixation-min" min="0" value="<?= $limits['mortgage_fixation_start1'] ?>"></div>
                    <div class="col-md-1 col-xs-1"><label class="form-control-label">Do</label></div>
                    <div class="col-md-4 col-xs-4"><input type="number" id="mortgage-fixation-max" min="0" value="<?= $limits['mortgage_fixation_start1'] ?>"></div>
                </div>
                <div class="form-group row mt-5">
                    <div class="col-md-12 col-xs-12">
                        <div id="mortage-calc-fixation"></div>
                    </div>
                </div>
                <div class="section-footer">
                    <button class="btn-sm btn-default" id="_mtgoback" type="button">Späť</button>
                    <button type="button" id="_mtnext" class="btn-sm">Pokračovať</button>
                    <button type="button" id="_fs02" class="btn-sm">Uložiť</button>
                </div>
            </section>
            <section id="loan-calculator">
                <h4>Spotrebný úver</h4>
                <!-- loan amount -->
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <label class="form-control-label">Požadovaná výška úveru</label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2 col-xs-2"></div>
                    <div class="col-md-1 col-xs-1"><label class="form-control-label">Od</label></div>
                    <div class="col-md-4 col-xs-4"><input type="number" id="loan-amount-min" min="0" value="60000"></div>
                    <div class="col-md-1 col-xs-1"><label class="form-control-label">Do</label></div>
                    <div class="col-md-4 col-xs-4"><input type="number" id="loan-amount-max" min="0" value="150000"></div>
                </div>
                <div class="form-group row mt-5">
                    <div class="col-md-12 col-xs-12">
                        <div id="loan-calc-amount"></div>
                    </div>
                </div>
                <!-- loan season -->
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <label class="form-control-label">Na obdobie</label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2 col-xs-2"></div>
                    <div class="col-md-1 col-xs-1"><label class="form-control-label">Od</label></div>
                    <div class="col-md-4 col-xs-4"><input type="number" id="loan-season-min" min="0" value="60000"></div>
                    <div class="col-md-1 col-xs-1"><label class="form-control-label">Do</label></div>
                    <div class="col-md-4 col-xs-4"><input type="number" id="loan-season-max" min="0" value="150000"></div>
                </div>
                <div class="form-group row mt-5">
                    <div class="col-md-12 col-xs-12">
                        <div id="loan-calc-season"></div>
                    </div>
                </div>
                <div class="section-footer">
                    <button class="btn-sm btn-default" id="_loanback" type="button">Späť</button>
                    <button type="button" id="_loannext" class="btn-sm">Pokračovať</button>
                    <button type="button" id="_fs03" class="btn-sm">Uložiť</button>
                </div>
            </section>
            <section id="refinance-calculator">
                <h4>Refinancovanie hypotéky</h4>
                <!-- refinance amount -->
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <label class="form-control-label">Požadovaná výška hypotéky</label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2 col-xs-2"></div>
                    <div class="col-md-1 col-xs-1"><label class="form-control-label">Od</label></div>
                    <div class="col-md-4 col-xs-4"><input type="number" id="refinance-amount-min" min="0" value="60000"></div>
                    <div class="col-md-1 col-xs-1"><label class="form-control-label">Do</label></div>
                    <div class="col-md-4 col-xs-4"><input type="number" id="refinance-amount-max" min="0" value="150000"></div>
                </div>
                <div class="form-group row mt-5">
                    <div class="col-md-12 col-xs-12">
                        <div id="refinance-calc-amount"></div>
                    </div>
                </div>
                <!-- refinance season -->
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <label class="form-control-label">Na požadované obdobie</label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2 col-xs-2"></div>
                    <div class="col-md-1 col-xs-1"><label class="form-control-label">Od</label></div>
                    <div class="col-md-4 col-xs-4"><input type="number" id="refinance-season-min" min="0" value="1"></div>
                    <div class="col-md-1 col-xs-1"><label class="form-control-label">Do</label></div>
                    <div class="col-md-4 col-xs-4"><input type="number" id="refinance-season-max" min="0" value="30"></div>
                </div>
                <div class="form-group row mt-5">
                    <div class="col-md-12 col-xs-12">
                        <div id="refinance-calc-season"></div>
                    </div>
                </div>
                <!-- refinance fixation -->
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <label class="form-control-label">S fixáciou</label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2 col-xs-2"></div>
                    <div class="col-md-1 col-xs-1"><label class="form-control-label">Od</label></div>
                    <div class="col-md-4 col-xs-4"><input type="number" id="refinance-fixation-min" min="0" value="3"></div>
                    <div class="col-md-1 col-xs-1"><label class="form-control-label">Do</label></div>
                    <div class="col-md-4 col-xs-4"><input type="number" id="refinance-fixation-max" min="0" value="10"></div>
                </div>
                <div class="form-group row mt-5">
                    <div class="col-md-12 col-xs-12">
                        <div id="refinance-calc-fixation"></div>
                    </div>
                </div>
                <div class="section-footer">
                    <button class="btn-sm btn-default" id="_refinback" type="button">Späť</button>
                    <button type="button" id="_fs04" class="btn-sm">Uložiť</button>
                </div>
            </section>
        </div>
        <div class="clear"></div>
    </div>
</main>

<?php
$csrf = "'" . Yii::$app->request->csrfParam ."':'". Yii::$app->request->getCsrfToken() ."'";
$banky = json_encode($finantial_institutions);

$js = <<<JS

    // mortgage calc amount
    var hypoCalcAmount = document.getElementById('mortage-calc-amount');
    noUiSlider.create(hypoCalcAmount, {
        connect: true,
        behaviour: 'tap',
        start: [{$limits['mortgage_amount_start1']}, 150000],
        range: {
            'min': [7000,100],
            'max': [300000]
        }
    });
    var nodesAmount = [
        document.getElementById('mortgage-amount-min'), // 0
        document.getElementById('mortgage-amount-max')  // 1
    ];
    hypoCalcAmount.noUiSlider.on('update', function (values, handle, unencoded, isTap, positions) {
        nodesAmount[handle].value = values[handle];
    });
    // mortgage calc season
    var hypoCalcSeason = document.getElementById('mortage-calc-season');
    noUiSlider.create(hypoCalcSeason, {
        connect: true,
        behaviour: 'tap',
        start: [1, 30],
        range: {
            'min': [1,1],
            'max': [40]
        }
    });
    var nodesSeason = [
        document.getElementById('mortgage-season-min'),
        document.getElementById('mortgage-season-max') 
    ];
    hypoCalcSeason.noUiSlider.on('update', function (values, handle, unencoded, isTap, positions) {
        nodesSeason[handle].value = values[handle];
    });
    // mortgage calc fixation
    var hypoCalcFixation = document.getElementById('mortage-calc-fixation');
    noUiSlider.create(hypoCalcFixation, {
        connect: true,
        behaviour: 'tap',
        start: [3,10],
        snap:true,
        range: {
            'min': 1,
            '15%': 3,
            '30%': 5,
            '55%': 10,
            'max': 15
        }
    });
    var nodesFixation = [
        document.getElementById('mortgage-fixation-min'), // 0
        document.getElementById('mortgage-fixation-max')  // 1
    ];
    hypoCalcFixation.noUiSlider.on('update', function (values, handle, unencoded, isTap, positions) {
        nodesFixation[handle].value = values[handle];
    });
    // Refinance
    var refinanceCalcAmount = document.getElementById('refinance-calc-amount');
    noUiSlider.create(refinanceCalcAmount, {
        connect: true,
        behaviour: 'tap',
        start: [60000, 150000],
        range: {
            'min': [7000,100],
            'max': [300000]
        }
    });
    var nodesRefinanceAmount = [
        document.getElementById('refinance-amount-min'), // 0
        document.getElementById('refinance-amount-max')  // 1
    ];
    refinanceCalcAmount.noUiSlider.on('update', function (values, handle, unencoded, isTap, positions) {
        nodesRefinanceAmount[handle].value = values[handle];
    });
    var refinanceCalcSeason = document.getElementById('refinance-calc-season');
    noUiSlider.create(refinanceCalcSeason, {
        connect: true,
        behaviour: 'tap',
        start: [1, 30],
        range: {
            'min': [1,1],
            'max': [40]
        }
    });
    var nodesRefinanceSeason = [
        document.getElementById('refinance-season-min'), // 0
        document.getElementById('refinance-season-max')  // 1
    ];
    refinanceCalcSeason.noUiSlider.on('update', function (values, handle, unencoded, isTap, positions) {
        nodesRefinanceSeason[handle].value = values[handle];
    });
    var refinanceCalcFixation = document.getElementById('refinance-calc-fixation');
    noUiSlider.create(refinanceCalcFixation, {
        connect: true,
        behaviour: 'tap',
        start: [3,10],
        snap:true,
        range: {
            'min': 1,
            '15%': 3,
            '30%': 5,
            '55%': 10,
            'max': 15
        }
    });
    var nodesRefinanceFixation = [
        document.getElementById('refinance-fixation-min'), // 0
        document.getElementById('refinance-fixation-max')  // 1
    ];
    refinanceCalcFixation.noUiSlider.on('update', function (values, handle, unencoded, isTap, positions) {
        nodesRefinanceFixation[handle].value = values[handle];
    });
    // Loan amount
    var loanCalcAmount = document.getElementById('loan-calc-amount');
    noUiSlider.create(loanCalcAmount, {
        connect: true,
        behaviour: 'tap',
        start: [300, 35000],
        range: {
            'min': [500,100],
            'max': [35000]
        }
    });
    var nodesLoanAmount = [
        document.getElementById('loan-amount-min'), // 0
        document.getElementById('loan-amount-max')  // 1
    ];
    loanCalcAmount.noUiSlider.on('update', function (values, handle, unencoded, isTap, positions) {
        nodesLoanAmount[handle].value = values[handle];
    });
    var loanCalcSeason = document.getElementById('loan-calc-season');
    noUiSlider.create(loanCalcSeason, {
        connect: true,
        behaviour: 'tap',
        start: [300, 35000],
        range: {
            'min': [500,100],
            'max': [35000]
        }
    });
    var nodesLoanSeason = [
        document.getElementById('loan-season-min'), // 0
        document.getElementById('loan-season-max')  // 1
    ];
    loanCalcSeason.noUiSlider.on('update', function (values, handle, unencoded, isTap, positions) {
        nodesLoanSeason[handle].value = values[handle];
    });
    
    $(document).ready(function(){
        if (!window.sessionStorage.getItem('fin_inst')) {
            window.sessionStorage.setItem('fin_inst','{$banky}');
        }
    });

    $('#add-product').on('click',function(e){
        var product = $('#product-list').val();
        var template = $('div.template');
        var main = $('div.prev-prods-list');
        var lastOne = $(main).find('div.card:last');
        var templateClone = template.clone(true);
        var lastOrderId = lastOne.length + 1;
        var toUpdate = $(templateClone).find('.pp-list');
        var institutions = $(templateClone).find('select');
         $(templateClone).find('input[type=hidden]').val(product);
        $.each(toUpdate, function(k,v){
            $(v).attr('data-order', lastOrderId);
        });
        var fin_inst = JSON.parse(window.sessionStorage.getItem('fin_inst'));
        $.each(fin_inst,function(k,v){
            $(institutions).append($('<option>',{value: v.id, text: v.name}));
        });
        $(templateClone).removeClass('template');
        templateClone.attr('data-order',lastOrderId);
        templateClone.css('display','block');
        main.append(templateClone); 
    });

    $.datepicker.setDefaults($.datepicker.regional['sk']);
    $('.doc-cal').datepicker({
            dateFormat: "dd.mm.yy",
            showOtherMonths: true,
            selectOtherMonths: true,
            showButtonPanel: true,
            changeMonth: true,
            changeYear: true,
            yearRange: '1920:2100',
            minDate: new Date(1920,1-1,1),
            autoclose: false
        }
    );
    
    $('#save-client-cashflow').on('click',function(){
        var other_income = getDataItems('.o-income');
        var expenses = getDataItemsWithOrder('.pp-list');
        var other_expenses = getDataItems('.o-exp');
         $.ajax({
           url: "/app-request/ajax-save-client-cashflow",
           dataType: "json",
           data: { 
               other_income: other_income,
               expenses: expenses,
               other_expenses: other_expenses,
               client_id: $('#client_id').val(), 
               {$csrf} 
           },
           type: "post"
       })
       .done(function(res){
          if (res.status == 'error') {
             alert(res.message);
          } else {
              $('#client_id').val(res.client_id);
              $('#client-cashflow').hide();
              var _x = JSON.parse(window.sessionStorage.getItem('product-request'));
              if (_x['mortgage'] == '1') {
                  $('#mortgage-calculator').show();
              }
              if (_x['refin_mortgage'] == '1') {
                  $('#refinance-calculator').show();
              } 
              if (_x['loan'] == '1') {
                  $('#loan-calculator').show();
              }
          }
       });
    });
    
    $('#_fs01').on('click',function(){
        
    });
    
    $('#save-client-business').on('click',function(){
        var bizData = getDataItemsWithOrder('.biz');
        $.ajax({
           url: "/app-request/ajax-save-client-businesses",
           dataType: "json",
           data: { 
               bizdata: bizData,
               client_id: $('#client_id').val(), 
               {$csrf} 
           },
           type: "post"
       })
       .done(function(res){
          if (res.status == 'error') {
             alert(res.message);
          } else {
              $('#client_id').val(res.client_id);
              // hide and show divs
              $('#client-business').hide();
              $('#client-cashflow').show();
          }
       });
    });
    
    $('#save-client-jobs').on('click',function SaveClientJobsAndSocialData(){
        var socialData = getDataItems('.social-data');
        var jobs = getDataItemsWithOrderAndTypeCheck('.jobs');
        $.ajax({
           url: "/app-request/ajax-save-client-jobs",
           dataType: "json",
           data: { 
               socialdata: socialData,
               jobs: jobs, 
               client_id: $('#client_id').val(), 
               {$csrf} 
           },
           type: "post"
       })
       .done(function(res){
          if (res.status == 'error') {
             alert(res.message);
          } else {
              $('#client_id').val(res.client_id);
              // hide and show divs
              var win = window.sessionStorage;
              if (
                  win.getItem('self-emp') == '1' || 
                  win.getItem('bus-owner') == '1'
              ) {
                  $('#income-src').hide();
                  $('#client-jobs').hide();
                  var toRepeat = parseInt(win.getItem('bus-owner-cnt'));
                  toRepeat += win.getItem('self-emp') == '1' ? 1 : 0;
                  if (toRepeat > 1) {
                      for(var i=0; i < toRepeat-1; i++) {
                            var lastOne = $('.business:last');
                            var lastClone = lastOne.clone(true);
                            var lastOneOrder = i + 2;
                            var h5 = $(lastClone).find("h5");
                            var h5Title = h5.html().split('.');
                            h5.html(h5Title[0] + '.' + lastOneOrder);
                            var toUpdate = $(lastClone).find(".biz");
                            $.each(toUpdate,function(k,v){
                                $(v).attr('data-order',lastOneOrder);
                            });
                            lastClone.attr('data-order',lastOneOrder);
                            lastOne.after(lastClone);
                      }
                  }
                  $('#client-business').show();
              } else {
                  $('#client-jobs').hide();
                  $('#client-business').hide();
                  $('#income-src').hide();
                  $('#client-cashflow').show();
              }
          }
       });
    });
    
    $('#save-income-src').on('click',function(){
        window.sessionStorage.setItem('perm-work', $('#perm-work').is(':checked') ? '1': '0');
        window.sessionStorage.setItem('perm-work-cnt',$('#perm-work-cnt').val());
        window.sessionStorage.setItem('self-emp',$('#self-emp').is(':checked') ? '1' : '0');
        window.sessionStorage.setItem('bus-owner',$('#bus-owner').is(':checked') ? '1':'0');
        window.sessionStorage.setItem('bus-owner-cnt',$('#bus-owner-cnt').val());
        if (window.sessionStorage.getItem('perm-work') == '1') {
            $('#income-src').hide();
            var toRepeat = parseInt(window.sessionStorage.getItem('perm-work-cnt'));
            if ( toRepeat>1) {
                for(var i=0; i < toRepeat-1; i++) {
                    var lastOne = $('.employer:last');
                    var lastClone = lastOne.clone(true);
                    var lastOneOrder = i + 2;
                    var h5 = $(lastClone).find("h5");
                    var h5Title = h5.html().split('.');
                    h5.html(h5Title[0] + '.' + lastOneOrder);
                    var toUpdate = $(lastClone).find(".jobs");
                    $.each(toUpdate,function(k,v){
                        $(v).attr('data-order',lastOneOrder);
                    });
                    lastClone.attr('data-order',lastOneOrder);
                    lastOne.after(lastClone);
                }
            }
            
            $('#client-jobs').show();
            
        }
    });
    
    $('#client-save-family-data').on('click',function(){
        var dat = getDataItems('.fam-data');
        $.ajax({
           url: "/app-request/ajax-save-family-data",
           dataType: "json",
           data: { 
               client_data: dat, 
               client_id: $('#client_id').val(), 
               {$csrf} 
           },
           type: "post"
       })
       .done(function(res){
          if (res.status == 'error') {
             alert(res.message);
          } else {
              $('#client_id').val(res.client_id);
              // hide and show divs
              $('#family-data').hide();
              $('#income-src').show();
          }
       });
    });
    
    $('#save-client-docs').on('click',function (){
        var dat =  getDataItemsWithOrder('.client-docs');
        $.ajax({
           url: "/app-request/ajax-save-client-docs",
           dataType: "json",
           data: { 
               client_data: dat, 
               client_id: $('#client_id').val(), 
               {$csrf} 
           },
           type: "post"
       })
       .done(function(res){
          if (res.status == 'error') {
             alert(res.message);
          } else {
              $('#client_id').val(res.client_id);
              // hide and show divs
              $('#client-docs').hide();
              $('#family-data').show();
          }
       });
    });
    
    $('#save-contact').on('click',function (){
        var dat = getDataItems('.contact');
        var _x = new Map();
        var req = new Map();
        $.each($('.creq'),function(k,v){
            var ke = $(v).data('item');
            var va = $(v).is(':checked') ? 1 : 0;
            req.set(ke,va );
            _x[ke] = va;
        });
        window.sessionStorage.setItem('product-request', JSON.stringify(_x));
        $.ajax({
           url: "/app-request/ajax-save-client",
           dataType: "json",
           data: { 
               client_data: dat, 
               client_id: $('#client_id').val(), 
               reqs: Object.fromEntries(req), 
               clnews: $('#cl-news').is(':checked') ? 1 : 0,
               clconsent: $('#cl-consent').is(':checked') ? 1 : 0,
               {$csrf} 
           },
           type: "post"
       })
       .done(function(res){
          if (res.status == 'error') {
              alert(res.message);
          } else {
              $('#client_id').val(res.client_id);
              // hide and show divs
              $('#p-1').hide();
              $('#client-req').hide();
              $('#referal').hide();
              $('#client-contact').hide();
              $('#client-papers').show();
          }
       });
    });
  
    $('#save-client-data').on('click',function (){
        var dat = getDataItems('.client-data');
        $.ajax({
           url: "/app-request/ajax-save-client-data",
           dataType: "json",
           data: { client_data: dat, client_id: $('#client_id').val(), {$csrf} },
           type: "post"
       })
       .done(function(res){
          if (res.status == 'error') {
             alert(res.message);
          } else {
              $('#client_id').val(res.client_id);
              // hide and show divs
              $('#client-basic-data').hide();
              $('#client-address').show();
          }
       });
    });
   
    $('#save-client-address').on('click',function (){
        var dat = getDataItems('.client-address');
        $.ajax({
           url: "/app-request/ajax-save-client-address",
           dataType: "json",
           data: { client_data: dat, client_id: $('#client_id').val(), {$csrf} },
           type: "post"
       })
       .done(function(res){
          if (res.status == 'error') {
             alert(res.message);
          } else {
              $('#client_id').val(res.client_id);
              // hide and show divs
              $('#client-address').hide();
              $('#client-personal-data').show();
          }
       });
    });
   
    $('#save-other-personal-data').on('click',function (){
        var dat = getDataItems('.other-personal');
        $.ajax({
           url: "/app-request/ajax-save-client-other-personal-data",
           dataType: "json",
           data: { client_data: dat, client_id: $('#client_id').val(), {$csrf} },
           type: "post"
       })
       .done(function(res){
          if (res.status == 'error') {
              alert(res.message);
          } else {
              $('#client_id').val(res.client_id);
              // hide and show divs
              $('#client-personal-data').hide();
              $('#client-docs').show();
          }
       });
    });
    
    $('#docup').on('click',function(){
        var data = new FormData();
        data.append("op-predna",$("#op-predna")[0].files[0]);
        data.append("op-zadna",$("#op-zadna")[0].files[0]);
        data.append('order', 1);
        data.append('client_id', $('#client_id').val());
        data.append('country',1);
        data.append('doc_type',$('#cdoc-type').val());
        // hide form and display spinner!!!       
        $.ajax({
                url : "/app-request/ajax-upload-doc",
                type : 'POST',
                data : data,
                contentType : false,
                processData : false
        })
        .done(function(resp){
            if (resp.status === 'error') {
                alert(resp.message);
                return false;
            } 
           $('.c-name').val(resp.result.name_first);
           $('.c-givenname').val(resp.result.name_last);
           $('.c-maidenname').val(resp.result.maiden_name);
           $('#add-town').val(resp.result.perm_town);
           $('.c-permaddress').val(resp.result.perm_address);
           $('.c-country').val(resp.result.nationality);
           $('.o-country').val(resp.result.nationality);
           $('#c-gend').val(resp.result.gender);
           $('#c-ssn').val(resp.result.ssn);
           $('#c-birth').val(resp.result.birth_date);
           $('#born-place').val(resp.result.birth_place );
           
           $.each($('.client-docs'),function(k,v){
              if ($(v).data('item') == 'doc_type') {
                  $(v).val(resp.result.doc_type);
              } 
              if ($(v).data('item') == 'doc_number') {
                  $(v).val(resp.result.doc_number);
              } 
              if ($(v).data('item') == 'doc_country') {
                  $(v).val(resp.result.nationality);
              }
              if ($(v).data('item') == 'doc_issuer') {
                  $(v).val(resp.result.doc_issuer);
              }
              if ($(v).data('item') == 'issue_date') {
                  $(v).val(resp.result.issue_date);
              }
              if ($(v).data('item') == 'validity_date') {
                  $(v).val(resp.result.validity_date);
              }
           }); 
           
           alert('Váš dokument bol spracovaný');
        });
    });
    
JS;

$this->registerJS($js);