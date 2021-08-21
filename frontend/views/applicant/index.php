<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use yii\helpers\Url;

$this->title ="Poslať životopis";
$this->registerCSSFile('@web/css/req.css?v=0.33',['depends'=>AppAsset::class]);
$this->registerJSFile('@web/js/applicant.js?v=0.1',['depends'=>AppAsset::class]);

?>

<main class="site-applicant">
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
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="req">
        <div class="req-container">
            <section id="req-source">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <select class="form-control dropdown" id="application-source">
                            <option value="">Odkiaľ ste o nás dozvedeli?</option>
                            <option value="facebook">Facebook</option>
                            <option value="twitter">Twitter</option>
                            <option value="profesia">Profesia</option>
                            <option value="linkedin">Linkedin</option>
                            <option value="upsvar">Ústredie práce</option>
                            <option value="refcode">Od priateľa/známeho</option>
                            <option value="nodef">Iné</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row" id="other-src">
                    <div class="col-sm-12">
                        <input type="text" name="" id="" placeholder="Sem napíšte odkiaľ ste sa o náz dozvedeli">
                    </div>
                </div>
                <div class="form-group row" id="referal-code">
                    <div class="col-sm-12">
                        <input type="text" name="" id="" placeholder="Referal kód">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <select class="form-control dropdown">
                            <option value="">Zvoľte pozíciu na ktorú sa hlásite</option>
                            <?php
                            foreach ($jobs as $job) {
                                ?>
                                <option value="<?= $job['id'] ?>"><?= $job['title'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </section>

            <section id="perosinal-info">
                <header>Osobné údaje</header>
                <article>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <select class="form-control dropdown">
                                <option value="">Zvolte pohlavie</option>
                                <option value="m">Muž</option>
                                <option value="f">Žena</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <select class="form-control dropdown">
                                <option value="">Titul pred menom</option>
                                <?php
                                foreach ($titul_pred as $item) {
                                    echo"<option value='{$item['short_name']}'>{$item['short_name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <select class="form-control dropdown">
                                <option value="">Titul za menom</option>
                                <?php
                                foreach ($titul_za as $item) {
                                    echo"<option value='{$item['short_name']}'>{$item['short_name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row field">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="Meno" id="app-name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="Priezvisko">
                        </div>
                    </div>
                    <div class="form-group row mt-6">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" value="@">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Telefón</label>
                        <div class="col-xs-3">
                            <select name="" id="">
                                <?php
                                foreach ($staty as $stat) {
                                    ?>
                                    <option value="00<?= $stat->predvolba ?>"><?= $stat->iso_kod ?> (+<?= $stat->predvolba ?>)</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Dátum narodenia</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" data-item="born_date">
                        </div>
                    </div>
                </article>
                <footer>
                    <button type="button" class="btn-hoo">Pokračovať</button>
                </footer>
            </section>

            <section id="personal-address">
                <header>
                    Kontaktná adresa
                </header>
                <article>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <select class="form-control dropdown">
                                <option value="">Zvoľte štát</option>
                                <?php
                                foreach ($staty as $item){
                                    echo"<option value='{$item->name}'>{$item->name}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="PSČ">
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control dropdown">
                                <option value="">Mesto</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="Ulica, číslo">
                        </div>
                    </div>
                </article>
                <footer>
                    <button type="button" class="btn-hoo">Spat</button>
                    <button type="button" class="btn-hoo">Pokračovať</button>
                </footer>
            </section>

            <section id="education">
                <header>
                    Vzdelanie
                </header>
                <article>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <select class="form-control dropdown">
                                <option value="0">Vyberte najvyššie dosiahnuté vzdelanie</option>
                                <option value="1">základné vzdelanie</option>
                                <option value="2">študent strednej školy</option>
                                <option value="3">stredoškolské bez maturity</option>
                                <option value="4">stredoškolské s maturitou</option>
                                <option value="5">nadstavbové/vyššie odborné vzdelanie</option>
                                <option value="6">študent vysokej školy</option>
                                <option value="7">vysokoškolské I. stupňa</option>
                                <option value="8">vysokoškolské II. stupňa</option>
                                <option value="9">vysokoškolské III. stupňa</option>
                            </select>
                        </div>
                    </div>

                    <h5>Vysoka skola</h5>
                    <div class="vysoka" id="v-1">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="Škola/fakulta">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <select class="form-control dropdown">
                                    <option value="">Mesto</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="Odbor/špecializácia">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="Rok nástupu">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="Rok ukončenia">
                            </div>
                        </div>
                    </div>

                    <h5>Stredná škola</h5>
                    <div class="stredna" id="s-1">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="Škola">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <select class="form-control dropdown">
                                    <option value="">Mesto</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="Odbor/špecializácia">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="Rok nástupu">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="Rok ukončenia">
                            </div>
                        </div>
                    </div>

                    <h5>Kurzy a školenia</h5>
                    <div class="kurz" id="k-1">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="Názov kurzu/školenia">
                            </div>
                        </div>
                        <div class="form-group row">
                             <div class="col-sm-12  ">
                                <input type="text" class="form-control" placeholder="Názov certifikátu">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="Inštitúcia">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="Od">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="Do">
                            </div>
                        </div>
                    </div>
                    <h5>Doplňujúce informácie</h5>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <textarea class="form-control" rows="10" data-item="dpln_info"></textarea>
                        </div>
                    </div>
                </article>
                <footer>
                    <button type="button" class="btn-hoo">Spat</button>
                    <button type="button" class="btn-hoo">Pokračovať</button>
                </footer>
            </section>

            <section id="jobs">
                <header>
                    Pracovné skúsenosti
                </header>
                <article>
                    <small class="form-text text-muted">
                        Začnite posledným zamestnaním. Uveďte aj dobrovoľnícke aktivity, študentské stáže, prax atď.
                    </small>
                    <div class="praca mt-5" id="p-1">
                        <div class="form-group row">
                             <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="Pracovná pozícia">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="Zamestnávateľ/názov firmy">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="Od">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="Do">
                            </div>
                        </div>

                        <h5>Náplň práce</h5>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <textarea class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <h5>Doplňujúce informácie</h5>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <textarea class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                </article>
                <footer>
                    <button type="button" class="btn-hoo">Spat</button>
                    <button type="button" class="btn-hoo">Pokračovať</button>
                </footer>
            </section>

            <section id="other-info">
                <header>
                    Ďalšie informácie
                </header>
                <article>
                    <h5>Jazykové znalosti</h5>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <select class="custom-select jazyk-data">
                                <option value="0">Vyberte jazyk</option>
                                <?php
                                foreach ($jazyk as $item) {
                                    echo"<option value={$item['id']}>{$item['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <select class="custom-select jazyk-data">
                                <option value="0">Vyberte úroveň</option>
                                <option value="1">Úplný začiatočník (A1)</option>
                                <option value="2">Začiatočník (A2)</option>
                                <option value="3">Mierne pokročilý (B1)</option>
                                <option value="4">Stredne pokročilý (B2)</option>
                                <option value="5">Pokročilý (C1)</option>
                                <option value="6">Expert (C2)</option>
                                <option value="7">Materinský jazyk</option>
                            </select>
                        </div>
                    </div>
                    <h5>Ostatné znalosti</h5>
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
                    <?php
                    $vodicaky = ['A','B','C','D','E','T'];

                    foreach ($vodicaky as $id => $item) {
                        ?>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">
                                <?php
                                echo $id == 0 ? 'Vodičský preukaz' : '';
                                ?>
                            </label>
                            <div class="col-sm-1">
                                <div class="form-check">
                                    <input
                                            class="form-check-input"
                                            type="checkbox"
                                            onclick="af2('<?= $item?>')"
                                            id="vod-chck-<?= $item ?>"
                                    >
                                    <label class="form-check-label">
                                        <?= $item ?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <input
                                        type="text"
                                        placeholder="Počet najazdených kilometrov"
                                        data-default-txt="Počet najazdených kilometrov"
                                        class="form-control"
                                        id="vod-<?= $item ?>"
                                        disabled
                                >
                            </div>
                        </div>

                        <?php
                    }
                    ?>
                    <h5>Ďalšie znalosti, schopnosti a záujmy</h5>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <textarea class="form-control zaujmy" rows="10" data-item="zaujmy"></textarea>
                        </div>
                    </div>
                </article>
                <footer>
                    <button type="button" class="btn-hoo">Spat</button>
                    <button type="button" class="btn-hoo">Pokračovať</button>
                </footer>
            </section>

            <form enctype="multipart/form-data" method="post" action="<?= Url::to(['/applicant/uloz-foto-cv']) ?>">
                <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->getCsrfToken() ?>">
                <input type="hidden" name="applicant_id" value="" id="foto-cv-applicant">
                <section id="photo-cv">
                    <header>
                        Doplňujúce informácie
                    </header>
                    <article>
                        <div class="form-group row required" style="margin-top: 40px;">
                            <label class="col-sm-4 col-form-label">Fotografia</label>
                            <div class="col-sm-5">
                                <input type="file" class="form-control" name="photo" accept="image/jpg, image/png">
                                <small>Nahrajte fotku vo formáte JPG alebo PNG!</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Motivačný list</label>
                            <div class="col-sm-5">
                                <input type="file" class="form-control" name="motivationletter">
                                <small>Nahrajte motivačný list vo formáte PDF!</small>
                            </div>
                        </div>

                        <div class="form-group row mt-10" id="gdpr-win">
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
                                <input type="checkbox" data-item="gdpr" class="" checked>
                                Týmto dávam Zamestnávateľovi <a href="#" id="gdpr-consent">súhlas</a> na spracovanie mojich osobných údajov.
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="checkbox" data-item="video" class="" checked>&nbsp;
                                Týmto dávam súhlas Zamestnávateľovi na spracovanie údajov z videokamery môjho osobného počítača.
                            </div>
                        </div>
                </article>
                    <footer>
                        <button type="button" class="btn-hoo">Spat</button>
                        <button type="button" class="btn-hoo">Ulozit</button>
                    </footer>
                </section>
            </form>

        </div>
        <div class="clear"></div>
    </div>

</main>

<?php

$js = <<<JS

JS;
