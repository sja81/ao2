<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use yii\helpers\Url;
use common\models\settings\Settings;

$this->title = "Financial questionnaire";

$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css',['depends'=>AppAsset::class]);
$this->registerCSSFile('@web/css/req.css?v=1.06',['depends'=>AppAsset::class]);
$this->registerJSFile('@web/js/app-request.js?v=0.4',['depends'=>AppAsset::class]);
$this->registerJSFile('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/i18n/jquery-ui-i18n.min.js',['depends'=>AppAsset::class]);
$this->registerJSFile('@web/js/tambr/ui/datepicker_langs.js')
?>

<main class="site-applicant">
    <input type="hidden" id="client_id" value="0">
    <input type="hidden" id="client_reference" value="">
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
            <p id="p-1">I want to...</p>
            <?php
            $reqs = Settings::getFinancialQuestionaryRequests(5);
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
                            <option value="">How did you hear about us?</option>
                            <option value="facebook">Facebook</option>
                            <option value="twitter">Twitter</option>
                            <option value="linkedin">Linkedin</option>
                            <option value="refcode">From a friend / acquaintance</option>
                            <option value="nodef">Other</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row" id="other-src">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" placeholder="Write here where you hear about us" class="form-control contact" data-item="other_src">
                    </div>
                </div>
                <div class="form-group row" id="referal-code">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" placeholder="Referal code" class="form-control contact" data-item="referal_code">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 col-xs-6">
                        <select class="form-control dropdown contact" id="call-type" data-item="call_type">
                            <option value="">Preferred method of contact</option>
                            <option value="cont-vid">Video call</option>
                            <option value="cont-phone">Phone</option>
                            <option value="written">Written</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <select class="form-control dropdown contact" id="call-source" data-item="call_src">
                        </select>
                    </div>
                </div>
             </section>
            <section id="client-contact">
                <h4>Contact details</h4>
                <div class="form-group row">
                    <label class="col-md-3 col-xs-2 col-form-label">Email:</label>
                    <div class="col-md-9 col-xs-10">
                        <input type="email" class="form-control contact" value="@" data-item="client_email" id="ema-1">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-xs-2 col-form-label">Mobile:</label>
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
                    <label class="col-md-3 col-xs-2 col-form-label">Landline:</label>
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
                            I am interested in receiving news by e-mail
                        </label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <label class="form-label">
                            <input type="checkbox" id="cl-consent">
                            &nbsp;
                            I agree to the use of personal data for marketing purposes
                        </label>
                        <p class="consent-note mt-1 text-justify">
                            By pressing "Submit" I confirm that I have read the General
                            I have read and understood the company's terms and conditions
                            content and I fully agree with them.
                        </p>
                        <p class="consent-note text-justify">
                            By providing your personal data and / or Third Party data to the Company Provider
                            <span class = "aoreal"> ALPHA-OMEGA REAL & CONSULTING s. r. o. </span>, <strong> with its registered office at Černyševského 10, 851 01 Bratislava - Petržalka district </strong>,
                            Company ID: 51 81 7594, registered in the Commercial Register of the District Court Bratislava I, section: Sro, file no. 129875 / B (Provider),
                            hereby as a User / Customer and / or as a legal representative
                            I give my free, serious and voluntary consent to a third party authorized to provide them
                            with their processing by the Provider in accordance with and under the conditions set out in the Processing Principles
                            personal data of the Provider.
                        </p>
                        <p class="consent-note text-justify">
                            At the same time, I hereby declare that all personal data provided by me is true, complete and correct.
                        </p>
                        <p class="consent-note text-justify">
                            This consent to the processing of personal data processed on the basis of consent is possible
                            appeal at any time electronically by sending an email to
                            <a href="mailto:gdpr@aoreal.sk?subject=Withdrawal of consent to the processing of personal data">gdpr@aoreal.sk</a>.
                        </p>
                    </div>
                </div>
                <div class="section-footer">
                    <button type="button" class="btn-sm btn-hoo" id="save-contact">Next</button>
                </div>
            </section>
            <section id="client-papers">
                <h4>Documents</h4>
                <p>If you do not want to upload your documents, press to continue button "Next".</p>
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
                        <label class="col-md-3 col-xs-4 col-form-label">Front</label>
                        <div class="col-md-9 col-xs-8">
                            <input type="file" name="op_predna" id="op-predna">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-xs-4 col-form-label">Back</label>
                        <div class="col-md-9 col-xs-8">
                            <input type="file" name="op_zadna" id="op-zadna">
                        </div>
                    </div>
                </form>
                <div class="section-footer">
                    <button type="button" class="btn-sm" id="docup">Upload</button>
                    <button type="button" class="btn-sm btn-default" id="cl-pap-back">Back</button>
                    <button type="button" class="btn-sm" id="cl-pap-next">Next</button>
                </div>
            </section>
            <section id="client-basic-data">
                <h4>Personal and family data</h4>
                <div class="form-group row">
                    <div class="col-md-6 col-xs-6">
                        <select class="form-control dropdown client-data" data-item="adegree_before">
                            <option value="">Academic degree before name</option>
                            <?php
                            foreach ($titul_pred as $item) {
                                echo"<option value='{$item['short_name']}'>{$item['short_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <select class="form-control dropdown client-data" data-item="adegree_after">
                            <option value="">Academic degree after name/option>
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
                        <input type="text" class="form-control client-data c-name" placeholder="Name" data-item="first_name">
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <input type="text" class="form-control client-data c-givenname" placeholder="Last name" data-item="last_name">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 col-xs-6">
                        <input type="text" class="form-control client-data c-maidenname" placeholder="Birth name" data-item="maiden_name">
                    </div>
                    <div class="col-md-6 col-xs-6">
                    </div>
                </div>
                <div class="section-footer">
                    <button type="button" class="btn-sm btn-default" id="cl-bas-data-back">Back</button>
                    <button type="button" class="btn-sm" id="save-client-data">Next</button>
                </div>
            </section>
            <section id="client-address">
                <h4>Address</h4>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <select class="form-control dropdown client-address c-country" data-item="perm_country">
                            <option value="">Chose country...</option>
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
                        <input type="text" class="form-control client-address" id="addr-zip" placeholder="Postcode" data-item="perm_zip">
                    </div>
                    <div class="col-md-7 col-xs-9">
                        <input type="text" id="add-town" placeholder="Town" class="form-control client-address" data-item="perm_town">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-9 col-xs-8">
                        <input type="text" class="form-control client-address c-permaddress" placeholder="Street and Nr." data-item="perm_street">
                    </div>
                    <div class="col-md-3 col-xs-4">
                        <input type="text" class="form-control doc-cal client-address" placeholder="From" data-item="perm_from">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-xs-5 col-form-label">Mailing address:</label>
                    <div class="col-md-8 col-xs-7">
                            <span class="radio-holder">
                                <input type="radio" name="D[]" id="perm-addr1"> Identical to permanent residence
                            </span>
                        <span class="radio-holder">
                                <input type="radio" name="D[]" id="perm-addr2"> Different to permanent residence
                            </span>
                    </div>
                </div>
                <div class="form-group row client-other-addr">
                    <div class="col-md-12 col-xs-12">
                        <select class="form-control dropdown client-address" data-item="temp_country">
                            <option value="">Chose country...</option>
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
                        <input type="text" class="form-control client-address" id="addr-other-zip" placeholder="Postcode" data-item="temp_zip">
                    </div>
                    <div class="col-md-7 col-xs-8">
                        <input type="text" class="form-control client-address" placeholder="Town" data-item="temp_town">
                    </div>
                </div>
                <div class="form-group row client-other-addr">
                    <div class="col-md-9 col-xs-8">
                        <input type="text" class="form-control client-address" placeholder="Street and Nr." data-item="temp_street">
                    </div>
                    <div class="col-md-3 col-xs-4">
                        <input type="text" class="form-control doc-cal client-address" placeholder="From" data-item="temp_from">
                    </div>
                </div>
                <div class="section-footer">
                    <button type="button" class="btn-sm btn-default" id="cl-addr-back">Back</button>
                    <button type="button" class="btn-sm" id="save-client-address">Next</button>
                </div>
            </section>
            <section id="client-personal-data">
                <h4>Other personal data</h4>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <select class="form-control dropdown other-personal o-country" data-item="citizenship">
                            <option value="">Citizenship...</option>
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
                            <option value="">Chose gender</option>
                            <option value="m">Male</option>
                            <option value="f">Female</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input
                                type="text"
                                class="form-control other-personal"
                                placeholder="Personal identification number (SSN)"
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
                                placeholder="Date of birth"
                                data-item="birth_date"
                                id="c-birth"
                        >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control other-personal" placeholder="Place of birth" id="born-place" data-item="birth_place">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <select class="form-control other-personal" data-item="education">
                            <option value="">Chose education...</option>
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
                    <button type="button" class="btn-sm btn-default" id="cl-persdat-back">Back</button>
                    <button type="button" class="btn-sm" id="save-other-personal-data">Next</button>
                </div>
            </section>
            <section id="client-docs">
                <h4>Identification card details</h4>
                <div class="doc" data-order="1">
                    <h5>Document nr.1</h5>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <select class="form-control dropdown client-docs" data-item="doc_type" data-order="1">
                                <option value="">Document type</option>
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
                            <input type="text" class="form-control client-docs" placeholder="Document Number" data-item="doc_number" data-order="1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <select class="form-control dropdown client-docs" data-item="doc_country" data-order="1">
                                <option value="">State of issue</option>
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
                            <input type="text" class="form-control client-docs" placeholder="Issued By" data-item="doc_issuer" data-order="1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 col-xs-6">
                            <input type="text" class="form-control doc-cal client-docs" placeholder="Date of Issue" data-item="issue_date" data-order="1">
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <input type="text" class="form-control doc-cal client-docs" placeholder="Date of Expiry" data-item="validity_date" data-order="1">
                        </div>
                    </div>
                </div>
                <div class="section-footer">
                    <button type="button" class="btn-sm" id="add-document">Add</button>
                    <button type="button" class="btn-sm btn-default" id="cust-docs-back">Back</button>
                    <button type="button" class="btn-sm" id="save-client-docs">Next</button>
                </div>
            </section>
            <section id="family-data">
                <h4>Family details</h4>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <select class="form-control fam-data" data-item="marital_status">
                            <option value="">Marital status</option>
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
                            <option value="">Way of living</option>
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
                            <option value="">Type of real estate of permanent residence</option>
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
                                placeholder="From what year do you live at this address?"
                                data-item="living_from"
                        >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <select class="form-control dropdown fam-data" data-item="shared_household">
                            <option value="">Living in a shared household</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <select class="form-control dropdown fam-data" data-item="bsm">
                            <option value="">Unshared co - ownership of spouses</option>
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                            <option value="2">Narrowed</option>
                            <option value="3">Canceled</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-6 col-xs-7 col-form-label">Number of adults in the family:</label>
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
                    <label class="col-md-6 col-xs-7 col-form-label">Number of dependent children:</label>
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
                    <label class="col-md-6 col-xs-7 col-form-label">Number of adults in the household:</label>
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
                            <option value="">Maintenance obligation of other persons:</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row vyzivne">
                    <div class="col-md-12 col-xs-12">
                        <input
                                type="text"
                                class="form-control fam-data"
                                placeholder="Alimony determined by the court"
                                data-item="alimony_by_court"
                        >
                    </div>
                </div>
                <div class="form-group row vyzivne">
                    <label class="col-md-6 col-xs-7 col-form-label">Number of adults with alimony:</label>
                    <div class="col-md-6 col-xs-5">
                        <input type="number" class="form-control fam-data" min="0" value="0" data-item="cnt_nourished_adult">
                    </div>
                </div>
                <div class="form-group row vyzivne">
                    <label class="col-md-6 col-xs-7 col-form-label">Number of children with alimony:</label>
                    <div class="col-md-6 col-xs-5">
                        <input type="number" class="form-control fam-data" min="0" value="0" data-item="cnt_nourished_child">
                    </div>
                </div>
                <div class="section-footer">
                    <button type="button" class="btn-sm btn-default" id="cl-famdata-back">Back</button>
                    <button type="button" class="btn-sm" id="client-save-family-data">Next</button>
                </div>
            </section>
            <section id="income-src">
                <h4>What are your sources of income?</h4>
                <div class="form-group row mb-1">
                    <label  class="col-md-12 col-xs-12 col-form-label">
                        I am...
                    </label>
                </div>
                <div class="form-group row mb-1">
                    <div class="col-md-1 col-md-offset-2 col-xs-1 col-xs-offset-2">
                        <input type="checkbox" id="perm-work">
                    </div>
                    <div class="col-md-7 col-xs-6">
                        <label  class="col-form-label">employee</label>
                    </div>
                    <div class="col-md-2 col-xs-3">
                        <input type="number" id="perm-work-cnt" class="form-control" min="0" value="0">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <div class="col-md-1 col-md-offset-2 col-xs-1 col-xs-offset-2">
                        <input type="checkbox" id="self-emp">
                    </div>
                    <div class="col-md-7 col-xs-6">
                        <label  class="col-form-label">self employed</label>
                    </div>
                    <div class="col-md-2 col-xs-3"></div>
                </div>
                <div class="form-group row">
                    <div class="col-md-1 col-md-offset-2 col-xs-1 col-xs-offset-2">
                        <input type="checkbox" id="bus-owner">
                    </div>
                    <div class="col-md-7 col-xs-6">
                        <label  class="col-form-label">owner of Ltd.</label>
                    </div>
                    <div class="col-md-2 col-xs-3">
                        <input type="number" id="bus-owner-cnt" class="form-control" min="0" value="0">
                    </div>
                </div>
                <div class="section-footer">
                    <button class="btn-sm btn-default" type="button">Back</button>
                    <button class="btn-sm" type="button" id="save-income-src">Next</button>
                </div>
            </section>
            <section id="client-jobs">
                <h4>Employment</h4>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <select id="soc-sec-sickleave" class="form-control social-data" data-item="sick_leave">
                            <option value="">When was the last time you were on sick leave?</option>
                            <option value="1">I was...</option>
                            <option value="2">It currently lasts...</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row sickleave-row">
                    <div class="col-md-6 col-xs-6">
                        <input
                                type="text"
                                class="form-control doc-cal social-data"
                                placeholder="From"
                                data-item="sick_leave_from"
                        >
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <input
                                type="text"
                                class="form-control doc-cal sickleave social-data"
                                placeholder="To"
                                data-item="sick_leave_to"
                        >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <select class="form-control social-data" id="maternity" data-item="maternity">
                            <option value="">Have you been to maternity leave?</option>
                            <option value="1">I was...</option>
                            <option value="2">I will be...</option>
                            <option value="3">It currently lasts...</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row maternity-row">
                    <div class="col-md-6 col-xs-6">
                        <input
                                type="text"
                                class="form-control doc-cal social-data"
                                placeholder="From"
                                data-item="maternity_from"
                        >
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <input
                                type="text"
                                class="form-control doc-cal maternity-leave social-data"
                                placeholder="To"
                                data-item="maternity_to"
                        >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <select class="form-control dropdown social-data" id="pension" data-item="pension">
                            <option value="">Are you retired?</option>
                            <option value="1">I will be...</option>
                            <option value="2">It currently lasts....</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row pension-row">
                    <div class="col-md-6 col-xs-6">
                        <input type="text" class="form-control doc-cal social-data" placeholder="From" data-item="pension_from">
                    </div>
                    <div class="col-md-6 col-xs-6">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <select class="form-control dropdown social-data" id="inv-pension" data-item="invalidity_pension">
                            <option value="">Are you on a disability pension?</option>
                            <option value="1">I will be...</option>
                            <option value="2">It currently lasts....</option>
                            <option value="3">I was...</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row inv-pension-row">
                    <div class="col-md-6 col-xs-6">
                        <input type="text" class="form-control doc-cal social-data" placeholder="From" data-item="invalidity_pension_from">
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <input type="text" class="form-control doc-cal inv-pension-to social-data" placeholder="To" data-item="invalidity_pension_to">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <!-- eddig ledolgozott evek szama -->
                        <input
                                type="text"
                                class="form-control social-data"
                                placeholder="Total length of employment (YY / MM)"
                                data-item="total_employment"
                        >
                    </div>
                </div>
                <div class="employer" data-order="1">
                    <h5 class="mb-4">Employer Nr.1</h5>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <select class="form-control jobs" data-order="1" data-item="profession">
                                <option value="">Profession</option>
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
                                <option value="">Type of employment</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-xs-5 col-form-label">Method of receiving income:</label>
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
                                > In cash
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
                                > To account
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
                                <option value="">Bank name</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-xs-5 col-form-label">Duration of current employment:</label>
                        <div class="col-md-8 col-xs-7">
                            <span class="radio-holder">
                                <input type="radio" class="jobs" name="workterm" data-order="1" data-item="work_term" data-default-value="permanent"> For an unknown period of time
                            </span>
                            <span class="radio-holder">
                                <input type="radio" class="jobs" name="workterm" data-order="1" data-item="work_term" data-default-value="fixed"> Fixed-term
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 col-xs-6">
                            <input type="text" class="form-control doc-cal jobs" placeholder="From" data-order="1" data-item="work_from">
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <input type="text" class="form-control doc-cal jobs" placeholder="To" data-order="1" data-item="work_to">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input
                                    type="text"
                                    class="form-control doc-cal jobs"
                                    placeholder="Period of employment in the current field (RR / MM)"
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
                                    placeholder="Employer name"
                                    data-order="1"
                                    data-item="employer_name"
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <select class="form-control dropdown jobs" data-order="1" data-item="country">
                                <option value="">Chose country...</option>
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
                            <input type="text" class="form-control jobs" placeholder="Postcode" data-order="1" data-item="zip">
                        </div>
                        <div class="col-md-7 col-xs-8">
                            <input type="text" placeholder="Town" class="form-control jobs" data-order="1" data-item="town">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input type="text" class="form-control jobs" placeholder="Street and Nr." data-order="1" data-item="address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 col-xs-6">
                            <input type="text" class="form-control jobs" placeholder="Company ID" data-order="1" data-item="company_id">
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <input type="text" class="form-control jobs" placeholder="VAT ID" data-order="1" data-item="tax_id">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <select class="form-control dropdown jobs" data-order="1" data-item="legal_form">
                                <option value="">Legal form</option>
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
                                <option value="">Bank name</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input
                                    type="text"
                                    class="form-control jobs"
                                    placeholder="Controlled / owned by the entity"
                                    data-order="1"
                                    data-item="owned_controlled_by"
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <select class="form-control dropdown jobs" data-order="1" data-item="industry">
                                <option value="">Industry</option>
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
                                    placeholder="Period of existence"
                                    data-order="1"
                                    data-item="time_of_existence"
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-xs-2 col-form-label">Mobile:</label>
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
                            <input type="text" class="form-control jobs" placeholder="Ex. 9xx xxx xxx" data-order="1" data-item="mobile">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-xs-2 col-form-label">Landline:</label>
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
                            <input type="text" class="form-control jobs" placeholder="Contact person" data-order="1" data-item="contact_person">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input type="text" class="form-control jobs" value="https://" data-order="1" data-item="web">
                        </div>
                    </div>
                    <h6>Net monthly income from dependent activity for the last 12 months</h6>
                    <?php
                    for ($i=0; $i < 12; $i++) {
                        ?>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label"><?= $i+1 ?>. month:</label>
                            <div class="col-md-8">
                                <input
                                        type="text"
                                        class="form-control jobs calc-avg-wage"
                                        data-order="1"
                                        data-item="netwage_<?= $i+1 ?>"
                                        value="0"
                                >
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <h6>Average net monthly income from dependent activity for the last</h6>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">4 months</label>
                        <div class="col-md-9">
                            <input
                                    type="text"
                                    class="form-control jobs"
                                    id="avg-4m-wage"
                                    data-order="1"
                                    data-item="avg_4month_netwage">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">6 months</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control jobs" id="avg-6m-wage" data-order="1" data-item="avg_6month_netwage">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">12 months</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control jobs" id="avg-12m-wage" data-order="1" data-item="avg_12month_netwage">
                        </div>
                    </div>
                    <h6>Average gross monthly income from dependent activity for the last</h6>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">12 months</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control jobs" data-order="1" data-item="avg_12month_grosswage">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input
                                    type="text"
                                    class="form-control jobs"
                                    placeholder="Aggregate amount of ancillary monthly income"
                                    data-order="1"
                                    data-item="sum_of_extra_income"
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input
                                    type="text"
                                    class="form-control jobs"
                                    placeholder="13. and/or 14. wage"
                                    data-order="1"
                                    data-item="extra_wage"
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 col-xs-6">
                            <select class="form-control dropdown jobs" data-order="1" data-item="bonus_freq">
                                <option value="">Frequency of bonuses</option>
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
                                    type="text"
                                    class="form-control jobs"
                                    placeholder="Sum of Bonuses"
                                    data-order="1"
                                    data-item="sum_of_bonuses">
                        </div>
                        <div class="col-md-6 col-xs-6"></div>
                    </div>
                </div>
                <div class="section-footer">
                    <button class="btn-sm btn-default" type="button">Back</button>
                    <button class="btn-sm" type="button" id="save-client-jobs">Next</button>
                </div>
            </section>
            <section id="client-business">
                <h4>Business</h4>
                <div class="business" data-order="1">
                    <h5 class="mb-4">Business Nr.1</h5>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input type="text" class="form-control biz" placeholder="Name" data-item="name" data-order="1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <select class="form-control dropdown biz" data-item="country" data-order="1">
                                <option value="">Chose country...</option>
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
                            <input type="text" class="form-control biz" placeholder="Postcode" data-item="zip" data-order="1">
                        </div>
                        <div class="col-md-7">
                            <input type="text" placeholder="Town" class="form-control biz" data-item="town" data-order="1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input type="text" class="form-control biz" placeholder="Street and Nr." data-item="address" data-order="1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 col-xs-6">
                            <input type="text" class="form-control biz" placeholder="Company ID" data-item="company_id" data-order="1">
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <input type="text" class="form-control biz" placeholder="VAT ID" data-item="tax_id" data-order="1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <select class="form-control dropdown biz" data-item="legal_form" data-order="1">
                                <option value="">Legal form</option>
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
                                <option value="">Bank name</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input
                                    type="text"
                                    class="form-control biz"
                                    placeholder="Controlled / owned by the entity"
                                    data-order="1"
                                    data-item="owned_controlled_by"
                            >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input type="text" class="form-control biz" placeholder="Length of business - in months">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <select class="form-control biz">
                                <option value="">Industry</option>
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
                        <label class="col-md-3 col-form-label">Mobile:</label>
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
                        <label class="col-md-3 col-form-label">Landline:</label>
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
                            <input type="text" class="form-control biz" placeholder="Contact person" data-item="contact_person" data-order="1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <input type="text" class="form-control biz" value="https://" data-item="web" data-order="1">
                        </div>
                    </div>
                </div>
                <h6>Business income</h6>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control biz" placeholder="Total annual revenue" data-order="1" data-item="total_yearly_income">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control biz" placeholder="Tax base (income - expenses)" data-item="tax_base" data-order="1">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control biz" placeholder="Tax" data-item="tax" data-order="1">
                    </div>
                </div>
                <div class="section-footer">
                    <button class="btn-sm btn-default" id="client-business-back" type="button">Back</button>
                    <button class="btn-sm" type="button" id="save-client-business">Next</button>
                </div>
            </section>

            <section id="client-cashflow">
                <h4>Other income and expenses</h4>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control o-income" placeholder="IBAN of the current account from which you plan to repay the loan" data-item="iban_for_loan_repay">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" id="bank-12" class="form-control o-income" data-item="bank_for_loan_repay" placeholder="Bank name">
                    </div>
                </div>
                <h5>Long - term social benefits</h5>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control o-income" placeholder="Old-age pension" data-item="pension_amt">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control o-income" placeholder="Disability pension" data-item="invalidity_pension_amt">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control o-income" placeholder="Retirement pension" data-item="retirement_pension">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control o-income" placeholder="Widow's pension" data-item="widow_pension">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control o-income" placeholder="Parental allowance / child allowance" data-item="parental_allowance">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control o-income" placeholder="Nutritious" data-item="nutritious">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control o-income" placeholder="Orphan's pension" data-item="orphan_pension">
                    </div>
                </div>
                <h5>Other monthly incomes</h5>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control o-income" placeholder="Lease" data-item="rent">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control o-income" placeholder="Diets" data-item="diets">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control o-income" placeholder="Dividends" data-item="dividends">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control o-income" placeholder="Other monthly incomes" data-item="other_monthly_income">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input type="text" class="form-control o-income" placeholder="Rent" data-item="annuity">
                    </div>
                </div>
                <h5>Expenses</h5>
                <h6>The amount of monthly installments of previously granted loans</h6>
                <div class="loan-1 card" data-order="1">
                    <div class="card-block">
                        <div class="form-group row">
                            <div class="col-md-12 col-xs-12">
                                <select class="form-control dropdown p-loan-1" data-order="1" data-item="loan_owner">
                                    <option value="">Institution</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <input type="text"  class="form-control p-loan-1" placeholder="Installment amount" data-order="1" data-item="loan_payment">
                            </div>
                            <div class="col-md-4">
                                <input type="text"  class="form-control p-loan-1" placeholder="Original drawdown" data-order="1" data-item="loan_amount">
                            </div>
                            <div class="col-md-4">
                                <input type="text"  class="form-control p-loan-1" placeholder="Balance" data-order="1" data-item="loan_balance">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn-sm add-loan" type="button">Add</button>
                    </div>
                </div>

                <h6>The amount of the allowed overdraft limit on the account</h6>
                <div class="limit-1" data-order="1">
                    <div class="card-block">
                        <div class="form-group row">
                            <div class="col-md-12 col-xs-12">
                                <select class="form-control dropdown p-limit-1" data-order="1" data-item="limit_owner">
                                    <option value="">Institution</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <input type="text" class="form-control p-limit-1" placeholder="Installment amount" data-order="1" data-item="limit_payment">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control p-limit-1" placeholder="Allowed limit" data-order="1" data-item="limit_amount">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control p-limit-1" placeholder="Exhausted limit" data-order="1" data-item="limit_balance">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn-sm add-limit" type="button">Add</button>
                    </div>
                </div>

                <h6>Credit card limit amount </h6>
                <div class="ccredit-1" data-order="1">
                    <div class="card-block">
                        <div class="form-group row">
                            <div class="col-md-6 col-xs-6">
                                <select class="form-control dropdown c-credit-1" data-order="1" data-item="credit_owner">
                                    <option value="">Institution</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <input type="text" class="form-control c-credit-1" placeholder="Installment amount" data-order="1" data-item="credit_payment">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 col-xs-6">
                                <input type="text" class="form-control c-credit-1" placeholder="Allowed limit" data-order="1" data-item="credit_amount">
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <input type="text" class="form-control c-credit-1" placeholder="Exhausted limit" data-order="1" data-item="credit_balance">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn-sm add-credit" type="button">Add</button>
                    </div>
                </div>

                <h6>Amount of monthly lease payments </h6>
                <div class="leasing-1" data-order="1">
                    <div class="card-block">
                        <div class="form-group row">
                            <div class="col-md-6 col-xs-6">
                                <select class="form-control dropdown" data-order="1" data-item="leasing_owner">
                                    <option value="">Institution</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <input type="text"  class="form-control" placeholder="Installment amount" data-order="1" data-item="leasing_payment">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 col-xs-6">
                                <input type="text"  class="form-control" placeholder="Original amount" data-order="1" data-item="leasing_amount">
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <input type="text"  class="form-control" placeholder="Balance of Liabilities" data-order="1" data-item="leasing_balance">
                            </div>
                        </div>
                    </div>
                </div>

                <h6>The amount of monthly installments of goods in installments </h6>
                <div class="installments-1" data-order="1">
                    <div class="card-block">
                        <div class="form-group row">
                            <div class="col-md-6 col-xs-6">
                                <select class="form-control dropdown inst-1" data-order="1" data-item="installments_owner">
                                    <option value="">Institution</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <input type="text"  class="form-control inst-1" placeholder="Installment amount" data-order="1" data-item="installments_payment">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 col-xs-6">
                                <input type="text"  class="form-control inst-1" placeholder="Original drawdown" data-order="1" data-item="orignal_drawdown">
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <input type="text"  class="form-control inst-1" placeholder="Balance of Liabilities" data-order="1" data-item="installments_balance">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn-sm add-installment" type="button">Add</button>
                    </div>
                </div>

                <h6>Other expenses</h6>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input
                                type="text"
                                class="form-control o-exp"
                                placeholder="Amount of other regular monthly expenses in € (excluding housing expenses)"
                                data-item="regular_mothly_expenses"
                        >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input
                                type="text"
                                class="form-control o-exp"
                                placeholder="Monthly maintenance payment"
                                data-item="mothly_nutritious"
                        >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input
                                type="text"
                                class="form-control o-exp"
                                placeholder="Total amount of executions"
                                data-item="execution_total_sum"
                        >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-xs-12">
                        <input
                                type="text"
                                class="form-control o-exp"
                                placeholder="Household costs"
                                data-item="household_expenses"
                        >

                    </div>
                </div>
                <div class="section-footer">
                    <button class="btn-sm btn-default" id="" type="button">Back</button>
                    <button type="button" class="btn-sm">Next</button>
                </div>
            </section>

        </div>
        <div class="clear"></div>
    </div>

</main>

<?php
$csrf = "'" . Yii::$app->request->csrfParam ."':'". Yii::$app->request->getCsrfToken() ."'";

$js = <<<JS
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
    
    function getDataItems(elm) {
        var dat = new Array();
        $.each($(elm), function(k,v){
            var ke=$(v).data('item');
            var va=$(v).val();
            dat.push({item:ke,val:va});
        });
        return dat;
    }
    
    function getDataItemsWithOrder(elm) {
        var dat =  new Array();
        $.each($(elm), function(k,v){
            var ke=$(v).data('item');
            var va=$(v).val();
            var or=$(v).data('order');
            dat.push({item:ke,val:va,order:or});
        });
        return dat;
    }
    
    function getDataItemsWithOrderAndTypeCheck(elm) {
        var dat =  new Array();
        $.each($(elm), function(k,v){
            if ($(v).is(':radio')) {
                if ($(v).is(':checked')) {
                    var va = $(v).data('default-value');
                } else {
                    return true;
                }
            } else {
                var va=$(v).val();
            }
            var ke=$(v).data('item');
            var or=$(v).data('order');
            
            dat.push({item:ke,val:va,order:or});
        });
        return dat;
    }
    
    $('#save-client-business').on('click',function(){
        var bizData = getDataItemsWithOrder('.biz');
        $.ajax({
           url: "/app-request/ajax-save-client-businesses",
           dataType: "json",
           data: { 
               bizdata: bizData,
               client_id: $('#client_id').val(), 
               client_reference: $('#client_reference').val(),
               {$csrf} 
           },
           type: "post"
       })
       .done(function(res){
          if (res.status == 'error') {
             alert(res.message);
          } else {
              $('#client_id').val(res.client_id);
              $('#client_reference').val(res.client_request_reference);
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
               client_reference: $('#client_reference').val(),
               {$csrf} 
           },
           type: "post"
       })
       .done(function(res){
          if (res.status == 'error') {
             alert(res.message);
          } else {
              $('#client_id').val(res.client_id);
              $('#client_reference').val(res.client_request_reference);
              // hide and show divs
              var win = window.sessionStorage;
              if (
                  win.getItem('self-emp') == '1' || 
                  win.sessionStorage.getItem('bus-owner') == '1'
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
               client_reference: $('#client_reference').val(),
               {$csrf} 
           },
           type: "post"
       })
       .done(function(res){
          if (res.status == 'error') {
             alert(res.message);
          } else {
              $('#client_id').val(res.client_id);
              $('#client_reference').val(res.client_request_reference);
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
               client_reference: $('#client_reference').val(), 
               {$csrf} 
           },
           type: "post"
       })
       .done(function(res){
          if (res.status == 'error') {
             alert(res.message);
          } else {
              $('#client_id').val(res.client_id);
              $('#client_reference').val(res.client_request_reference);
              // hide and show divs
              $('#client-docs').hide();
              $('#family-data').show();
          }
       });
    });
    
    $('#save-contact').on('click',function (){
        var dat = getDataItems('.contact');
        var req = new Map();
        $.each($('.creq'),function(k,v){
            var ke = $(v).data('item');
            var va = $(v).is(':checked') ? 1 : 0;
            req.set(ke,va );         
        });
        $.ajax({
           url: "/app-request/ajax-save-client",
           dataType: "json",
           data: { 
               client_data: dat, 
               client_id: $('#client_id').val(), 
               client_reference: $('#client_reference').val(), 
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
              $('#client_reference').val(res.client_request_reference);
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
           data: { client_data: dat, client_id: $('#client_id').val(), client_reference: $('#client_reference').val(), {$csrf} },
           type: "post"
       })
       .done(function(res){
          if (res.status == 'error') {
             alert(res.message);
          } else {
              $('#client_id').val(res.client_id);
              $('#client_reference').val(res.client_request_reference);
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
           data: { client_data: dat, client_id: $('#client_id').val(), client_reference: $('#client_reference').val(), {$csrf} },
           type: "post"
       })
       .done(function(res){
          if (res.status == 'error') {
             alert(res.message);
          } else {
              $('#client_id').val(res.client_id);
              $('#client_reference').val(res.client_request_reference);
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
           data: { client_data: dat, client_id: $('#client_id').val(), client_reference: $('#client_reference').val(), {$csrf} },
           type: "post"
       })
       .done(function(res){
          if (res.status == 'error') {
              alert(res.message);
          } else {
              $('#client_id').val(res.client_id);
              $('#client_reference').val(res.client_request_reference);
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
        data.append('client_reference',$('#client_reference').val());
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