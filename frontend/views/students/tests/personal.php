<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;

$this->registerCSSFile('@web/css/schools.css?v=1.09',['depends'=>AppAsset::class]);
$this->title = Yii::t('app','Test personality');

$errorCount = Yii::t('app','Treba odpovedať na všetky otázky!');

$pages = [
        0   => [
            Yii::t('app','1. Je pre vás ťažké predstaviť sa ostatným.'),
            Yii::t('app','2. Často sa vám stáva, že pri rozmýšľaní ignorujete alebo zabúdate na svoje okolie.'),
            Yii::t('app','3. Snažíte sa reagovať na e-maily čo najskôr a prekáža vám plná schránka nevybavených e-mailov.'),
            Yii::t('app','4. Je pre vás ľahké správať sa uvoľnene a sústredene, aj keď ste pod určitým tlakom?'),
            Yii::t('app','5. Obvykle nezačínate rozhovory.'),
            Yii::t('app','6. Len zriedka robíte niečo iba z čírej zvedavosti.'),
            Yii::t('app','7. Cítite sa nadradený/á voči ostatným ľuďom.'),
            Yii::t('app','8. Je pre vás dôležitejšie byť organizovaný/á ako prispôsobivý/á.'),
            Yii::t('app','9. Väčšinou máte veľa motivácie a energie.'),
            Yii::t('app','10. Mať pravdu pri rozhovore je pre vás menej dôležité ako snažiť sa nikoho nerozrušiť.')
        ],
        1   => [
            Yii::t('app','11. Často máte pocit, že svoje správanie musíte pred ostatnými obhájiť.'),
            Yii::t('app','12. Vaše domáce a pracovné prostredie je celkom upratané.'),
            Yii::t('app','13. Nevadí vám, keď ste v centre pozornosti.'),
            Yii::t('app','14. Považujete sa skôr za praktického ako kreatívneho človeka.'),
            Yii::t('app','15. Ľudia vás dokážu rozrušiť len zriedka.'),
            Yii::t('app','16. Vaše cestovné plány sú zvyčajne dobre premyslené.'),
            Yii::t('app','17. Často je pre vás ťažké pochopiť pocity iných ľudí.'),
            Yii::t('app','18. Vaša nálada sa môže veľmi rýchlo zmeniť.'),
            Yii::t('app','19. Pri rozhovore by mala byť pravda dôležitejšia ako pocity ľudí.'),
            Yii::t('app','20. Len zriedka sa obávate toho, ako vaše činy ovplyvnia ostatných.')
        ],
        2   => [
            Yii::t('app','21. Váš prístup k práci je skôr náhodný a energetický ako metodický a organizovaný.'),
            Yii::t('app','22. Často závidíte ostatným.'),
            Yii::t('app','23. Zaujímavá kniha alebo videohry sú často lepšie než spoločenské udalosti.'),
            Yii::t('app','24. Schopnosť vypracovať plán a držať sa ho je najdôležitejšou súčasťou každého projektu.'),
            Yii::t('app','25. Len zriedka sa nechávate unášať fantáziou a predstavami.'),
            Yii::t('app','26. Pri prechádzke v prírode sa často strácate v myšlienkach.'),
            Yii::t('app','27. Ak niekto rýchlo nezareaguje na váš e-mail, začnete si robiť starosti, že ste povedali niečo zlé.'),
            Yii::t('app','28. Ako rodič by ste chceli, aby vaše dieťa bolo skôr priateľské ako múdre.'),
            Yii::t('app','29. Nechcete, aby ostatní ovplyvňovali vaše činy.'),
            Yii::t('app','30. Vaše sny sa sústreďujú skôr na skutočný svet a jeho udalosti.'),
        ],
        3   => [
            Yii::t('app','31. Stačí vám málo času, aby ste sa zapojili do spoločenských aktivít na svojom novom pracovisku.'),
            Yii::t('app','32. Ste skôr prirodzený improvizátor než dôkladný plánovač.'),
            Yii::t('app','33. Svoje emócie vás ovládajú viac, než vy ich.'),
            Yii::t('app','34. Tešíte sa na spoločenské akcie, ktoré sa týkajú hrania sa na iných ľudí alebo vyžadujú kostýmy.'),
            Yii::t('app','35. Často trávite čas skúmaním nereálnych a nepraktických, ale napriek tomu zaujímavých nápadov.'),
            Yii::t('app','36. Radšej improvizujete ako trávite čas tvorbou podrobného plánu.'),
            Yii::t('app','37. Ste pomerne rezervovaný a tichý človek.'),
            Yii::t('app','38. Keby ste mali firmu, bolo by pre vás veľmi ťažké prepustiť lojálnych, ale nedostatočne výkonných zamestnancov.'),
            Yii::t('app','39. Často uvažujete nad dôvodmi ľudskej existencie.'),
            Yii::t('app','40. Keď ide o dôležité rozhodnutia, logika je zvyčajne oveľa dôležitejšia než srdce.'),
        ],
        4   => [
            Yii::t('app','41. Je pre vás oveľa dôležitejšie udržať si otvorené možnosti ako mať zoznam úloh.'),
            Yii::t('app','42. Ak je váš priateľ kvôli niečomu smutný, skôr mu ponúknete emocionálnu podporu než navrhnete spôsoby, ako sa vyrovnať s týmto problémom.'),
            Yii::t('app','43. Len zriedka sa cítite neisto.'),
            Yii::t('app','44. Nemáte problém vytvoriť si osobný časový rozvrh a držať sa ho.'),
            Yii::t('app','45. Pokiaľ ide o tímovú prácu, mať pravdu je oveľa dôležitejšie než byť tímový hráč.'),
            Yii::t('app','46. Myslíte si, že každého názory by mali byť rešpektované bez ohľadu na to, či sú alebo nie sú podložené faktami.'),
            Yii::t('app','47. Keď trávite čas so skupinou ľudí, cítite viac energie.'),
            Yii::t('app','48. Často neviete nájsť svoje veci.'),
            Yii::t('app','49. Vnímate sa ako veľmi emocionálne stabilný človek.'),
            Yii::t('app','50. Vaša myseľ je stále plná neprebádaných nápadov a plánov.'),
        ],
        5   => [
            Yii::t('app','51. Nenazvali by ste sa rojkom.'),
            Yii::t('app','52. Zvyčajne máte problém uvoľniť sa pri rozhovore v prítomnosti mnohých ľudí.'),
            Yii::t('app','53. Vo všeobecnosti sa viac spoliehate na skúsenosti než na fantáziu.'),
            Yii::t('app','54. Veľmi sa obávate toho, čo si myslia ostatní ľudia.'),
            Yii::t('app','55. V plnej miestnosti zostávate bližšie k stenám a vyhýbate sa stredu.'),
            Yii::t('app','56. Máte tendenciu veci odkladať, kým nie je na to všetko dostatok času.'),
            Yii::t('app','57. V stresových situáciách sa cítite veľmi nervózne.'),
            Yii::t('app','58. Veríte, že je oveľa prínosnejšie, keď vás ľudia majú radi, ako keby ste mali moc.'),
            Yii::t('app','59. Vždy vás zaujímali nekonvenčné a nejednoznačné veci, napr. v knihách, umení alebo vo filmoch.'),
            Yii::t('app','60. V spoločenských situáciách často preberáte iniciatívu.'),
        ],
];
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
            <div class="progress" style="margin-bottom: 20px;">
                <div
                        class="progress-bar"
                        role="progressbar"
                        style="width: 17%;"
                        aria-valuenow="17"
                        aria-valuemin="0"
                        aria-valuemax="100"
                        id="test-progress"
                >
                    17%
                </div>
            </div>
            <form method="post" id="personal-form">
                <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken() ?>">
                <input type="hidden" name="studentId" value="<?= $_GET['id']?>">
                <input type="hidden" name="result" value="" id="results">
                <?php
                    foreach($pages as $pageId => $questions)  {
                ?>
                    <section id="page-<?= $pageId+1 ?>" class="test-questions">
                <?php
                        foreach($questions as $questionId => $question) {
                ?>
                                <div class="question">
                                    <span class="statement"><?= $question ?></span>
                                    <div role="radiogroup" class="decision">
                                        <div class="caption agree"><?= Yii::t('app','Súhlasím'); ?></div>
                                        <div class="options">
                                            <div role="radio" data-index="0" class="option agree max" data-q="<?= $questionId + 1 ?>" data-p="<?= $pageId + 1 ?>"></div>
                                            <div role="radio" data-index="1" class="option agree med" data-q="<?= $questionId + 1 ?>" data-p="<?= $pageId + 1 ?>"></div>
                                            <div role="radio" data-index="2" class="option agree min" data-q="<?= $questionId + 1 ?>" data-p="<?= $pageId + 1 ?>"></div>
                                            <div role="radio" data-index="3" class="option neutral" data-q="<?= $questionId + 1 ?>" data-p="<?= $pageId + 1 ?>"></div>
                                            <div role="radio" data-index="4" class="option disagree min" data-q="<?= $questionId + 1 ?>" data-p="<?= $pageId + 1 ?>"></div>
                                            <div role="radio" data-index="5" class="option disagree med" data-q="<?= $questionId + 1 ?>" data-p="<?= $pageId + 1 ?>"></div>
                                            <div role="radio" data-index="6" class="option disagree max" data-q="<?= $questionId + 1 ?>" data-p="<?= $pageId + 1 ?>"></div>
                                        </div>
                                        <div class="caption disagree"><?= Yii::t('app','Nesúhlasím'); ?></div>
                                    </div>
                                </div>

                <?php
                        }
                ?>
                        <div class="section-footer">
                            <?php
                                $btnType = 'button';
                                if ($pageId + 1 == count($pages)) {
                                    $btnType='submit';
                                }
                            ?>
                            <button
                                    type="<?= $btnType ?>"
                                    class="btn-sm"
                                    id="next-page-<?= $pageId + 2 ?>"
                            >
                                <?= Yii::t('app','Ďalej'); ?>
                            </button>
                        </div>
                    </section>
                <?php
                    }
                ?>
            </form>
        </div>
    </div>
</main>

<?php

$css = <<<CSS
    
    .test-questions .question .statement {
    color: #576071;
    font-weight: 600;
    text-align: center;
    font-size: 1.3em;
    }
    .test-questions .question {
        padding: 35px 0 20px;
        transition: opacity .5s ease-in-out;
        width: 100%;
    }
    .test-questions .question .caption.agree {
        text-align: right;
    }
    .test-questions .question .decision .caption.agree {
        color: #56ac8a;
    }
    .test-questions .question .decision .caption.disagree {
        color: #5f394d;
    }
    .test-questions .question .decision .caption {
        font-size: 1.1em;
    }
    .test-questions .question .decision {
        margin: 30px 0 20px;
        align-items: center;
        display: flex;
        justify-content: center;
    }
    .test-questions .question .decision .options {
        margin: 0 30px;
        align-items: center;
        display: flex;
        flex: 0 0 100%;
        justify-content: space-between;
    }
    
    .test-questions .question .decision .options .option {
        align-items: center;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        justify-content: center;
        transition: all .1s ease-in-out;
    }

    .test-questions .question .decision .options .option.agree {
        border: 2px solid #56ac8a;
    }
    .test-questions .question .decision .options .option.agree.active, 
    .test-questions .question .decision .options .option.agree:hover {
        background-color: #56ac8a;
    }
    .test-questions .question .decision .options .option.max {
        flex: 0 0 55px;
        height: 55px;
        max-width: 55px;
    }
    .test-questions .question .decision .options .option.med {
        flex: 0 0 45px;
        height: 45px;
        max-width: 45px;
    }
    .test-questions .question .decision .options .option.min {
        flex: 0 0 35px;
        height: 35px;
        max-width: 35px;
    }
    .test-questions .question .decision .options .option.neutral.active, 
    .test-questions .question .decision .options .option.neutral:hover {
        background-color: #9b9faa;
    }
    
    .test-questions .question .decision .options .option.neutral {
        flex: 0 0 30px;
        height: 30px;
        max-width: 30px;
        border: 2px solid #9b9faa;
    }
    .test-questions .question .decision .options .option.disagree {
        border: 2px solid #5f394d;
    }
    .test-questions .question .decision .options .option.disagree.active, 
    .test-questions .question .decision .options .option.disagree:hover {
        background-color: #5f394d;
    }
    #page-2,
    #page-3,
    #page-4,
    #page-5,
    #page-6 {
        display: none;
    }
CSS;
$this->registerCSS($css);

$js = <<<JS
    var answers = [];
    var ac = 0;

    $('.option').on('click',function(){
        let q = $(this).data('q'),
            p = $(this).data('p');
        answers[(q-1)+(p-1)*10] = $(this).data('index');
        $(this).addClass('active');
        window.sessionStorage.setItem('answers',answers);
        ++ac;
    });
        
    $('#next-page-2').on('click',function(){
        if (ac < 10) {
            alert("{$errorCount}");
            return false;
        }
        ac = 0;
        $('#page-1').fadeOut();
        $('#page-2').fadeIn();
        $('#test-progress').css('width','34%').attr('aria-valuenow','34').html("34%");
    });
    $('#next-page-3').on('click',function(){
        if (ac < 10) {
            alert("{$errorCount}");
            return false;
        }
        ac = 0;
        $('#page-2').fadeOut();
        $('#page-3').fadeIn();
        $('#test-progress').css('width','51%').attr('aria-valuenow','51').html("51%");
    });
    $('#next-page-4').on('click',function(){
        if (ac < 10) {
            alert("{$errorCount}");
            return false;
        }
        ac = 0;
        $('#page-3').fadeOut();
        $('#page-4').fadeIn();
        $('#test-progress').css('width','68%').attr('aria-valuenow','68').html("68%");
    });
    $('#next-page-5').on('click',function(){
        if (ac < 10) {
            alert("{$errorCount}");
            return false;
        }
        ac = 0;
        $('#page-4').fadeOut();
        $('#page-5').fadeIn();
        $('#test-progress').css('width','85%').attr('aria-valuenow','85').html("85%");
    });
    $('#next-page-6').on('click',function(){
        if (ac < 10) {
            alert("{$errorCount}");
            return false;
        }
        ac = 0;
        $('#page-5').fadeOut();
        $('#page-6').fadeIn();
        $('#test-progress').css('width','100%').attr('aria-valuenow','100').html("100%");
    });
    $('#personal-form').on('submit',function(){
        let c = window.sessionStorage.getItem('answers');
        $('#results').val(JSON.stringify(c));
        window.sessionStorage.removeItem('answers');
        return true;
    });
JS;
$this->registerJS($js);
