<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use frontend\models\Aoreal;

$this->title = 'Cenník';
$this->params['breadcrumbs'][] = $this->title;

?>
<main class="site-pricelist">
    <div class="page-banner d-block position-relative raleway">
        <canvas style="background-image:url(/images/contact-us-banner-2.jpg);" width="1600" height="400"></canvas>
        <div class="page-border container-default d-block position-absolute mx-auto">
            <div class="page_title_line_left d-inline-block position-absolute background-gold-before background-gold-after animated fadeIn visible" data-aios-reveal="true" data-aios-animation="fadeIn" data-aios-animation-delay="0.2s" data-aios-animation-reset="false" data-aios-animation-offset="0" style="animation-delay: 0.2s;"></div>
            <div class="page_title_line_right d-inline-block position-absolute background-gold-before background-gold-after animated fadeIn visible" data-aios-reveal="true" data-aios-animation="fadeIn" data-aios-animation-delay="0.2s" data-aios-animation-reset="false" data-aios-animation-offset="0" style="animation-delay: 0.2s;"></div>			
        </div>
        <div class="page-title container-default d-block position-absolute mx-auto">
            <div class="container-fluid">
                <div class="titlewrapper">
                    <h1 class="entry-title animated fadeInDown visible" data-aios-reveal="true" data-aios-animation="fadeInDown" data-aios-animation-delay="0.3s" data-aios-animation-reset="false" data-aios-animation-offset="0" style="animation-delay: 0.3s;">
                    <strong><?= Html::encode($this->title) ?></strong>				</h1>
                </div>
            </div>
        </div>
        <?= Alert::widget(); ?>
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
    <section class="section-wrapper">
        <div class="container">
            
            
            <h2 align="center"><strong>CENNÍK </strong><strong><br>realitných služieb spoločnosti</strong><br>ALPHA-OMEGA REAL &amp; CONSULTINING  s.r.o.</h2>
          <p align="center"><strong>Provízia za  sprostredkovane predaja nehnuteľnosti:</strong></p>
            <table class="table table-striped">
              <tr>
                <td width="294"><p><strong>CENA NEHNUTEĽNOSTI:</strong></p></td>
                <td width="309"><p><strong>VÝŠKA PROVÍZIE:</strong></p></td>
              </tr>
              <tr>
                <td width="294"><p><strong>do    49.999 EUR</strong><strong> </strong></p></td>
                <td width="309"><p><strong>5    %</strong><strong>  z&nbsp;kúpnej ceny (minimálne 2</strong><strong>.000 EUR</strong><strong>)</strong><strong> </strong></p></td>
              </tr>
              <tr>
                <td width="294"><p><strong>od    50.000 do&nbsp;299.999 EUR</strong><strong> </strong></p></td>
                <td width="309"><p><strong>4 %</strong><strong>  z&nbsp;kúpnej ceny (minimálne 2</strong><strong>.500 EUR</strong><strong>)</strong><strong> </strong></p></td>
              </tr>
              <tr>
                <td width="294"><p><strong>od    300.000 do 1.300.000&nbsp; EUR</strong><strong> </strong></p></td>
                <td width="309"><p><strong>3    %</strong><strong> z&nbsp;kúpnej    ceny</strong><strong> </strong></p></td>
              </tr>
              <tr>
                <td width="294"><p><strong>od    1.300.000 EUR</strong><strong> </strong></p></td>
                <td width="309"><p><strong>1 % </strong><strong>z&nbsp;kúpnej    ceny</strong><strong> </strong></p></td>
              </tr>
            </table>
            <p>tabuľka č.1<br>
              Výška provízie závisí od  predajnej ceny nehnuteľnosti a&nbsp;ovplyvňuje ju aj skutočnosť, či sa jedná  o&nbsp;výhradné sprostredkovanie predaj nehnuteľnosti (exkluzívna zmluva), čo  znamená, že klient realizuje predaj nehnuteľnosti výlučne prostredníctvom našej  kancelárie.</p>
            <h2>Provízia  za sprostredkovanie prenájmu nehnuteľnosti:</h2>
            <p>
          Nájomné za jeden  mesiac užívania nehnuteľnosti (bez cien energií)- pri prenájme na jeden rok. Účtuje sa od toho, kto o poskytnutie  služby požiadal (spravidla prenajímateľ nehnuteľnosti).<strong> Minimálna výška provízie </strong>za sprostredkovanie prenájmu je <strong>290 </strong><strong>EUR</strong>. </p>
            <p><strong>Individuálne  služby a&nbsp;úkony (ak nie sú zahrnuté v cene provízie)</strong><strong>:</strong><strong> </strong></p>
          <table class="table table-striped">
              <tr>
                <td width="234" colspan="4"><br>
                  <strong>ÚKON:</strong></td>
                <td width="75"><p><strong>NÁKLAD:</strong></p></td>
                <td><p><strong>BLIŽŠÍ POPIS:</strong></p></td>
              </tr>
              <tr>
                <td width="234" colspan="4"><p><strong>Nábor    nehnuteľnosti</strong></p></td>
                <td width="75"><p align="center"><strong>130    €</strong></p></td>
                <td><p>Náhrada    nákladov spojených s&nbsp;uskutočnením dokumentačnej obhliadky nehnuteľnosti,    vrátane vyhotovenia fotografií, zistenia parametrov nehnuteľnosti, rokovania    s&nbsp;klientom, prípravy cenovej analýzy za účelom určenia ponukovej ceny    nehnuteľnosti (jednorázová platba)- štandardná služba</p></td>
              </tr>
              <tr>
                <td width="234" colspan="4"></td>
                <td width="75"></td>
                <td><p>&nbsp;</p></td>
              </tr>
              <tr>
                <td width="2"><p>&nbsp;</td>
                <td width="177"><p>Ceny extra     služieb náboru nehnuteľnosti podľa    tabulky</p></td>
                <td width="47"></td>
                <td width="377" colspan="3"><p>&nbsp;</td>
              </tr>
            </table>
          <table class="table table-striped">
              <tr>
                <td width="141" valign="top"><p>30 €</p></td>
                <td width="151" valign="top"><p>40 €</p></td>
                <td width="142" valign="top"><p>300 €</p></td>
                <td width="142" valign="top"><p>1000 €</p></td>
              </tr>
              <tr>
                <td width="141" valign="top"><p>Návrh stratégie predaja a&nbsp;stanovenia predanej ceny (určenie    cieľovej skupiny, odporúčanie predajnej ceny formou komparatívnej metódy    podobných nehnuteľností)</p></td>
                <td width="151" valign="top"><p>Dokumentačná obhliadka Nehnuteľnosti (fyzická návšteva nehnuteľnosti    vrátane vlastnej dopravy, spísanie&nbsp; náborového listu)</p></td>
                <td width="142" valign="top"><p>Vyhotovenie pôdorysu    nehnuteľnosti a&nbsp;3D modelu nehnuteľnosti </p></td>
                <td width="142" valign="top"><p>Použitie video prezentácie bez predchádzajúceho súhlasu <br>
                  ALPHA-OMEGA <br>
                  REAL &amp; CONSULTINING </p></td>
              </tr>
              <tr>
                <td width="141" valign="top"><p>Vyhotovenie profesionálneho textu inzerátu do 1000    znakov&nbsp;&nbsp; </p></td>
                <td width="151" valign="top"><p>Fotodokumentácia    Nehnuteľnosti a&nbsp;min 10 fotografií (vrátane upravenia fotiek) </p></td>
                <td width="142" valign="top"><p>Natočenie video prezentácie bytu </p></td>
                <td width="142" valign="top"><p>&nbsp;</p></td>
              </tr>
              <tr>
                <td width="141" valign="top"><p>Spracovanie pôdorysu nehnuteľnosti </p></td>
                <td width="151" valign="top"><p>&nbsp;</p></td>
                <td width="142" valign="top"><p>Použitie textu alebo časti textu inzerátu ALPHA-OMEGA <br>
                  REAL &amp; CONSULTINING bez    predchádzajúceho súhlasu&nbsp;&nbsp; </p></td>
                <td width="142" valign="top"><p>&nbsp;</p></td>
              </tr>
              <tr>
                <td width="141" valign="top"><p>&nbsp;</p></td>
                <td width="151" valign="top"><p>&nbsp;</p></td>
                <td width="142" valign="top"><p>Použitie pôdorysu nehnuteľnosti bez    predchádzajúceho súhlasu <br>
                  ALPHA-OMEGA <br>
                  REAL &amp; CONSULTINING </p></td>
                <td width="142" valign="top"><p>&nbsp;</p></td>
              </tr>
            </table>
            <table class="table table-striped">
              <tr>
                <td><p><strong>Inzerovanie nehnuteľnosti</strong></p></td>
                <td><p align="center">&nbsp;<strong>5</strong><strong>&nbsp;</strong><strong>€</strong><strong>&nbsp;</strong><strong>/    deň</strong></p></td>
                <td><p>Realitný sprostredkovateľ je oprávnený    účtovať si náhradu nákladov spojených s&nbsp;inzerovaním nehnuteľnosti (na    internete, v&nbsp;tlačených médiách a&nbsp;pod.) najviac vo výške <strong>5 </strong><strong>€</strong> / deň.</p></td>
              </tr>
              <tr>
                <td><p><strong>Obhliadky</strong></p></td>
                <td><p align="center"><strong>180</strong><strong>&nbsp;</strong><strong>€</strong><strong>&nbsp;</strong><strong>/    mesačne&nbsp;</strong></p></td>
                <td><p>Nárok    na náhradu paušálneho mesačného poplatku vzniká realitnému    sprostredkovateľovi len vtedy, ak na nehnuteľnosti uskutoční najmenej 3    obhliadky v príslušný mesiac, vždy s potenciálnym záujemcom (záujemcami).</p></td>
              </tr>
              <tr>
                <td><p><strong>Osobná asistencia</strong></p></td>
                <td><p align="center">&nbsp;<strong>15 <strong>€</strong></strong><strong>&nbsp;</strong><strong>/    za každú začatú polhodinu</strong></p></td>
                <td><p>Ak je potrebné v&nbsp;prospech klienta&nbsp;niečo&nbsp;zabezpečiť alebo ak si klient    vyžiada osobnú prítomnosť / asistenciu realitného sprostredkovateľa pri    niektorom z&nbsp;úkonov, ktorý nie je ako úkon samostatne týmto cenníkom    paušálne spoplatnený, je klient povinný uhradiť realitnému    sprostredkovateľovi náhradu vo výške 15 € / za každú začatú    polhodinu.<br>
                  <em>Príklad:    Realitný sprostredkovateľ nie je oprávnený si osobitne účtovať náhradu času    za zabezpečenie listu vlastníctva, náhradu za čas spojený s&nbsp;obhliadkami    nehnuteľnosti, lebo tieto sú ako samostatne (paušálne) spoplatnené úkony    uvedené v&nbsp;tomto cenníku.</em></p></td>
              </tr>
                
                
            <tr>
                <td rowspan="2">Ekonomické poradenstvo</td>
                <td>nezmluvní klienti → 50 € / hod.</td>
                <td>osobne, mailom, telefonicky</td>
            </tr>
            <tr>
                <td>zmluvní klienti → 35 € / hod.</td>
                <td>osobne, mailom, telefonicky</td>
            </tr>
                
                
              <tr>
                <td><p><strong>Zabezpečenie dokumentu z&nbsp;úradu / inštitúcie</strong></p>
                  <p><strong>&nbsp;</strong></p>
                  <p><strong>&nbsp;</strong></p>
                  <p><strong>&nbsp;</strong></p>
                  <p><strong>&nbsp;</strong></p>
                  <p><strong>&nbsp;</strong></p></td>
                <td><p align="center"><strong>variabilné    »</strong></p>
                  <p align="center"><strong>&nbsp;</strong></p>
                  <p align="center"><strong>&nbsp;</strong></p>
                  <p align="center"><strong>&nbsp;</strong></p>
                  <p align="center"><strong>&nbsp;</strong></p>
                  <p align="center"><strong>&nbsp;</strong></p></td>
                <td><p>Ak je k&nbsp;sprostredkovaniu potrebné    zabezpečiť dokument (napr. výpis z&nbsp;listu vlastníctva, katastrálnu mapu,    kópiu kolaudačného rozhodnutia, potvrdenie správcu bytového domu    a&nbsp;pod.), je klient povinný uhradiť realitnému sprostredkovateľovi    náhradu nákladov, ktoré pozostávajú z:</p>
                  <ul>
                    <li>úradného (správneho) poplatku    (napr. 8&nbsp;€&nbsp;za LV) a</li>
                    <li>paušálnej sumy 20&nbsp;€&nbsp;ako    náhradu za strávený čas a</li>
                    <li>náhrady za pohonné hmoty vo    výške 0,80 € / km, ak vzdialenosť medzi nehnuteľnosťou    a&nbsp;úradom/inštitúciou, ktorý dokument vydáva, je viac ako 20 km.</li>
                  </ul>
                  <p>&nbsp;V&nbsp;prípade pochybností    o&nbsp;určení vzdialenosti je rozhodujúca vzdialenosť, ktorá bude určená    prostredníctvom stránky :&nbsp;<a href="http://www.google.com/maps">www.google.com/maps</a>&nbsp;-&ldquo;získať    trasu&ldquo;.&nbsp;<br>
                    <em>Príklad:</em> <br>
                    <em>Klient poverí    sprostredkovateľa, aby zabezpečil od správcu potvrdenie o&nbsp;nedoplatkoch.    Nehnuteľnosť je v&nbsp;centre Bratislavy, sídlo správcu je napr.    v&nbsp;centre Trnavy. Ak nedôjde k&nbsp;sprostredkovaniu predaja nehnuteľnosti,    klient sprostredkovateľovi zaplatí náhradu nákladov takto: 20</em><em> €</em><em> + poplatok, ktorý si za potvrdenie vyžiada správca + </em><em>45,6    € (57 km * 0,80 €)</em> <br>
                    V&nbsp;náhrade sú započítané náklady za    pohonné hmoty, amortizáciu a strávený čas a&nbsp;súvisiace poplatky, ktoré za    klienta sprostredkovateľ uhradil.</p></td>
              </tr>
              <tr>
                <td><p><strong>Zabezpečenie návrhu rezervačnej zmluvy (budúcej kúpnej alebo    budúcej nájomnej zmluvy)</strong></p></td>
                <td><p align="center">od 150<strong>&nbsp;</strong><strong>€</strong></p></td>
                <td><p>&nbsp;</p>
                  <p>Náhrada nákladov spojená s&nbsp;prípravou    zmluvnej dokumentácie (náhrada za strávený čas alebo náhrada za odmenu, ktorú    musel sprostredkovateľ uhradiť advokátskej kancelárii).&nbsp;</p></td>
              </tr>
              <tr>
                <td><p><strong>Zabezpečenie návrhu kúpnej zmluvy</strong></p></td>
                <td><p align="center">od 150<strong>&nbsp;</strong><strong>€</strong></p></td>
                <td><p>Náhrada nákladov spojená s&nbsp;prípravou    zmluvnej dokumentácie (náhrada za strávený čas alebo náhrada za odmenu, ktorú    musel sprostredkovateľ uhradiť advokátskej kancelárii).</p></td>
              </tr>
              <tr>
                <td><p><strong>Zabezpečenie    návrhu nájomnej zmluvy</strong></p></td>
                <td><p align="center">od 150<strong>&nbsp;</strong><strong>€</strong></p></td>
                <td><p>Náhrada    nákladov spojená s&nbsp;prípravou zmluvnej dokumentácie (náhrada za strávený    čas alebo náhrada za odmenu, ktorú musel sprostredkovateľ uhradiť advokátskej    kancelárii)</p></td>
              </tr>
              <tr>
                <td><p><strong>Znalecký posudok</strong></p></td>
                <td><p align="center">od 150 <strong>€</strong></p></td>
                <td><p>Cena    znaleckého posudku záleží od typu a&nbsp;hodnoty nehnuteľnosti.</p></td>
              </tr>
              <tr>
                <td><p><strong>Zastupovanie    pri kúpe nehnuteľnosti </strong></p></td>
                <td><p align="center">od 2000<strong>&nbsp;</strong><strong>€</strong></p></td>
                <td><p>% Z    celkovej kúpnej ceny ( podľa tabulky č.1)</p></td>
              </tr>
            </table>
            <h2 align="center">Služby  pre kupujúcich:</h2>
            <div class="row pricelist">
                <div class="col-lg-4 col-md-6">
                    <h4><strong>Balík MINI:</strong></h4>
                    <ul>
                        <li>Prieskum realitného trhu&nbsp;(rešerš) </li>
                        <li>Užší výber       a prehliadky nehnuteľností (3 prehliadky)</li>
                        <li>Vyjednanie       lepšej kúpnej ceny</li>
                        <li>Hypoasistencia&nbsp;(bezplatná bonusová       služba)</li>
                    </ul>
                    <hr>
                    <p class="price"><strong>spolu: 349&nbsp;EUR</strong><br>ušetríte: 151&nbsp;EUR</p>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4><strong>Balík KLASIK:</strong></h4>
                    <ul>
                      <li>Prieskum realitného trhu&nbsp;(rešerš) </li>
                      <li>Užší výber       a prehliadky nehnuteľností (6 prehliadok)</li>
                      <li>Vyjednávanie       lepšej kúpnej ceny</li>
                      <li>Hypoasistencia&nbsp;(bezplatná       bonusová služba)</li>
                      <li>Právna       asistencia pri zmluvnej dokumentácii</li>
                      <li>Asistencia       v deň prevodu vlastníctva</li>
                      <li>Asistencia pri protokolárnom prevzatí a       prepise médií a služieb</li>
                    </ul>
                    <hr>
                    <p class="price"><strong>spolu: 849&nbsp;EUR</strong><br>ušetríte: 236 EUR</p>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4><strong>Balík PREMIUM:</strong></h4>
                    <ul>
                      <li>Prieskum       realitného trhu&nbsp;(rešerš)</li>
                      <li>Užší výber       a prehliadky nehnuteľností (9 prehliadok)</li>
                      <li>Vyjednávanie       lepšej kúpnej ceny</li>
                      <li>Hypoasistencia       (bezplatná bonusová služba)</li>
                      <li>Právna asistencia       pri zmluvnej dokumentácii</li>
                      <li>Asistencia       v deň prevodu vlastníctva</li>
                      <li>Asistencia       pri protokolárnom prevzatí a prepise médií a služieb</li>
                      <li>Preskúmanie       technického stavu nehnuteľnosti</li>
                      <li>Asistencia pri vybavovaní znaleckého posudku</li>
                    </ul>
                    <hr>
                    <p class="price"><strong>spolu: 1449&nbsp;EUR</strong><br>ušetríte: 551&nbsp;EUR </p> 
                </div>
            </div>
            <p>&nbsp;</p>
            <p>(Ceny  sú orientačné a môžu sa líšiť v závislosti od veľkosti stavby, dostupnosti  projektovej dokumentácie, a pod., v&nbsp;špeciánych prípadoch o&nbsp;zľavách i  o&nbsp;cenách služieb, môže rozhodovať konateľ firmy.)</p>
            
            
        </div>
    </section>
</main>
