<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use frontend\models\Aoreal;


$aoreal = new Aoreal();
?>
<main class="site-page clearfix">
    <div class="page-banner d-block position-relative raleway">
        <canvas style="background-image:url(/images/contact-us-banner-3.jpg);" width="1600" height="400"></canvas>
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

    <section id="section-one-about" data-aios-staggered-parent="true" data-aios-animation-offset="0" data-aios-animation-reset="true">
        <div class="section_two_overlay--top bg_color--blue"></div>
        <div class="alt-icon"><span class="alt-icon-logo-mono-large"></span></div>
        <div class="sec-one-about-content">
            <h2 class="text-transform-normal" data-aios-staggered-child="true" data-aios-animation="fadeInDown" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">Mgr. BALÁZS SZABÓ</h2>
            <p data-aios-staggered-child="true" data-aios-animation="fadeInUp" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">
            Miért is kezdtem az ingatlan businessbe? 
<br><br>
Mert végzettségemböl kifolyólag manager/közgazdász vagyok és mindig is a számok foglalkoztattak, és ez által végezhetem a pénzügyi tanácsadást is professzionális szinten, ami egy nagyon jó (kereseti lehtöséget) megélhetést biztosít számomra.


            <br>
            <br>
            Mert szeretek mozgásban lenni és megoldásokat találni.
Mert ez az a dolog, amire mindenkinek szüksége van és sok esetben egész életére szóló dötést hoz.
Mert szeretném minden kedves ügyfelünknek megtalálni az Ö személyes történetét és hozzásegíteni a számára legmegfelelöbb megoldáshoz. </p>
            <div class="citation">
                <blockquote>Kto pracuje pre peniaze, ubíja svoju dušu. Pracuj pre prácu samotnú a všetko ostatné dostaneš.</blockquote>
                <p>Napoleon Bonaparte francúzsky panovník, vojenský a politický vodca 1769 - 1821</p>
            </div>
            
        </div>
        <div class="about-section-img" data-aios-staggered-child="true" data-aios-animation="fadeInUp" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">
            <img src="/images/about-us-balazs-szabo.png" alt="Mgr. Balázs Szabó">
        </div>
        <div class="clear"></div>			
    </section>
    <section id="section-two-about" data-aios-staggered-parent="true" data-aios-animation-offset="0.5" data-aios-animation-reset="true">
        <div class="section_two_overlay--bottom bg_color--gold"></div>
        <div class="about-section-img" data-aios-staggered-child="true" data-aios-animation="fadeInDown" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">
            <img src="/images/img-balazs-szabo-barber-1.png" alt="Mgr. Balázs Szabó">
        </div>
        <div class="sec-two-about-content">
            <h2 data-aios-staggered-child="true" data-aios-animation="fadeInDown" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">Továbbá ebben a szakmában nagyon sok minden megtalálható, ami izgalmassá teszi, és ez számomra elöidézi a FLOW érzést-<br>üzlet, tudás, érzelem-ami mindennek az alapja.</h2>
            <p data-aios-staggered-child="true" data-aios-animation="fadeInUp" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">   
<strong>Üzlet:</strong><br>Pénzügyileg jó döntést kell hozni- az igatlan minden esetben egy hosszútávú befektetés, még bérlet esetén is, ugyanis ha valaki ezt a formát választja, valószínüleg érdemesebb bérelnie, mint vásárolnia.
            </p>
            <p data-aios-staggered-child="true" data-aios-animation="fadeInUp" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">
                <strong>Tudás:</strong><br>Rentgeteg szaktudásra van szükség, mint pl. Technikai Tervezö, mesterek, ügyvédek, pénzügyi szakemberek ezt a kíváló csapatmunkával is elöre mozdítjuk.
            </p>
            <p data-aios-staggered-child="true" data-aios-animation="fadeInUp" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">
                <strong>Érzelem:</strong><br>Ahhoz, hogy valaki jól érezze magát az otthonában érzelmileg is kötödnie kell hozzá, hogy a magáénak érezhesse és ne csak a dokumetumokon szerepeljen a neve. Ezek mind szerves részét képezik a mi munkánknak és ez igazából csak a jéghegy csúcsa, de a legfontosabbnak mindenképpen azt tartom, hogy az ügyfelek a saját életükkel foglalkozhassanak az ingatlanokkal felmerülö problémáikra, pedig megfelelö megoldásokat találunk. Ehhez mindenképpen kölcsönösen bizalmi kapcsolatra van szükség.
            </p>
            <div class="citation">
                <blockquote>Podnik, ktorý neprináša nič viac ako peniaze, je úbohý podnik.</blockquote>
                <p>Henry Ford americký priemyselník 1863 - 1947</p>
            </div>
        </div>
        <div class="clear"></div>
    </section>

    <section id="section-four-about"  data-aios-staggered-parent="true" data-aios-animation-offset="0.5" data-aios-animation-reset="true"> 
        <div class="section_four_overlay--top bg_color--gold"></div>
        <div class="section_four_overlay--bottom bg_color--blue"></div>
        <div class="alt-icon"><span class="alt-icon-logo-mono-large"></span></div>
            <div class="about-section-img">
                <img src="/images/balazs-szabo-car1.png" alt="Mgr. Balázs Szabó"  data-aios-staggered-child="true" data-aios-animation="fadeInLeft" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;"> 
            </div>
        <div class="sec-four-about-content">
            <h2  data-aios-staggered-child="true" data-aios-animation="fadeInUp" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">Lorem dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</h2> 
            <p  data-aios-staggered-child="true" data-aios-animation="fadeInDown" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">Lorem dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Rutrum quisque non tellus orci. Dui accumsan sit amet nulla facilisi morbi. Elementum sagittis vitae et leo duis ut diam quam. Risus at ultrices mi tempus imperdiet nulla malesuada. Pellentesque elit eget gravida cum. Bibendum ut tristique et egestas quis. Eget mi proin sed libero enim sed faucibus turpis. Commodo ullamcorper a lacus vestibulum sed arcu. Urna id volutpat lacus laoreet non curabitur. Scelerisque mauris pellentesque pulvinar pellentesque habitant morbi. Nec feugiat in fermentum posuere urna nec tincidunt. Accumsan sit amet nulla facilisi morbi tempus iaculis urna. Aenean euismod elementum nisi quis eleifend.
            </p>
            <div class="citation">
                <blockquote>Obchod, v ktorom nezískame nič viac ako peniaze, nie je žiadny obchod.</blockquote>
                <p>Henry Ford americký priemyselník 1863 - 1947</p>
            </div>
            <div class="contact-info"  data-aios-staggered-child="true" data-aios-animation="fadeInLeft" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">
                <div class="cinfo">
                    <div class="cphone">
                        <i class="ai-font-phone"></i><a class="mobile-phone" data-filter="off" href="tel:<?php echo $aoreal->phone_link; ?>"><?php echo $aoreal->phone; ?></a>
                    </div>
                    <div class="cemail">
                        <i class="ai-font-envelope-f"></i><a class="asis-mailto-obfuscated-email-hidden asis-mailto-obfuscated-email " data-value="<?php echo $aoreal->email; ?>"><?php echo $aoreal->email; ?></a>
                    </div>
                    <div class="caddress">
                        <i class="ai-font-location-c"></i><p><?php echo $aoreal->address.'<br>'.$aoreal->postcode.' '.$aoreal->city; ?></p>
                    </div>
                    <div class="cmedia">
                        <div class="were-social__boxes--smi p-0">
                            <i></i>                    
                            <?php
                            if ($aoreal->facebook)
                                echo '<a href="'.$aoreal->facebook.'" target="_blank" class="ai-font-facebook d-inline-block mr-2 text-decoration-none align-middle"></a>';
                            if ($aoreal->twitter)
                                echo '<a href="'.$aoreal->twitter.'" target="_blank" class="ai-font-twitter d-inline-block mx-2 text-decoration-none align-middle"></a>';
                            if ($aoreal->instagram)
                                echo '<a href="'.$aoreal->instagram.'" target="_blank" class="ai-font-instagram d-inline-block mx-2 text-decoration-none align-middle"></a>';
                            if ($aoreal->linkedin)
                                echo '<a href="'.$aoreal->linkedin.'" target="_blank" class="ai-font-linkedin d-inline-block mx-2 text-decoration-none align-middle"></a>';
                            ?>
                        </div>
                    </div>			
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </section>
    <div class="bottom-golf"><img class="img-responsive" src="/images/img-golf1.png" alt=""></div>
</main>
