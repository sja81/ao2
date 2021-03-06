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
            <h2 class="text-transform-normal" data-aios-staggered-child="true" data-aios-animation="fadeInDown" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">Mgr. BAL??ZS SZAB??</h2>
            <p data-aios-staggered-child="true" data-aios-animation="fadeInUp" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">
            Mi??rt is kezdtem az ingatlan businessbe? 
<br><br>
Mert v??gzetts??gemb??l kifoly??lag manager/k??zgazd??sz vagyok ??s mindig is a sz??mok foglalkoztattak, ??s ez ??ltal v??gezhetem a p??nz??gyi tan??csad??st is professzion??lis szinten, ami egy nagyon j?? (kereseti leht??s??get) meg??lhet??st biztos??t sz??momra.


            <br>
            <br>
            Mert szeretek mozg??sban lenni ??s megold??sokat tal??lni.
Mert ez az a dolog, amire mindenkinek sz??ks??ge van ??s sok esetben eg??sz ??let??re sz??l?? d??t??st hoz.
Mert szeretn??m minden kedves ??gyfel??nknek megtal??lni az ?? szem??lyes t??rt??net??t ??s hozz??seg??teni a sz??m??ra legmegfelel??bb megold??shoz. </p>
            <div class="citation">
                <blockquote>Kto pracuje pre peniaze, ub??ja svoju du??u. Pracuj pre pr??cu samotn?? a v??etko ostatn?? dostane??.</blockquote>
                <p>Napoleon Bonaparte franc??zsky panovn??k, vojensk?? a politick?? vodca 1769 - 1821</p>
            </div>
            
        </div>
        <div class="about-section-img" data-aios-staggered-child="true" data-aios-animation="fadeInUp" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">
            <img src="/images/about-us-balazs-szabo.png" alt="Mgr. Bal??zs Szab??">
        </div>
        <div class="clear"></div>			
    </section>
    <section id="section-two-about" data-aios-staggered-parent="true" data-aios-animation-offset="0.5" data-aios-animation-reset="true">
        <div class="section_two_overlay--bottom bg_color--gold"></div>
        <div class="about-section-img" data-aios-staggered-child="true" data-aios-animation="fadeInDown" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">
            <img src="/images/img-balazs-szabo-barber-1.png" alt="Mgr. Bal??zs Szab??">
        </div>
        <div class="sec-two-about-content">
            <h2 data-aios-staggered-child="true" data-aios-animation="fadeInDown" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">Tov??bb?? ebben a szakm??ban nagyon sok minden megtal??lhat??, ami izgalmass?? teszi, ??s ez sz??momra el??id??zi a FLOW ??rz??st-<br>??zlet, tud??s, ??rzelem-ami mindennek az alapja.</h2>
            <p data-aios-staggered-child="true" data-aios-animation="fadeInUp" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">   
<strong>??zlet:</strong><br>P??nz??gyileg j?? d??nt??st kell hozni- az igatlan minden esetben egy hossz??t??v?? befektet??s, m??g b??rlet eset??n is, ugyanis ha valaki ezt a form??t v??lasztja, val??sz??n??leg ??rdemesebb b??relnie, mint v??s??rolnia.
            </p>
            <p data-aios-staggered-child="true" data-aios-animation="fadeInUp" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">
                <strong>Tud??s:</strong><br>Rentgeteg szaktud??sra van sz??ks??g, mint pl. Technikai Tervez??, mesterek, ??gyv??dek, p??nz??gyi szakemberek ezt a k??v??l?? csapatmunk??val is el??re mozd??tjuk.
            </p>
            <p data-aios-staggered-child="true" data-aios-animation="fadeInUp" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">
                <strong>??rzelem:</strong><br>Ahhoz, hogy valaki j??l ??rezze mag??t az otthon??ban ??rzelmileg is k??t??dnie kell hozz??, hogy a mag????nak ??rezhesse ??s ne csak a dokumetumokon szerepeljen a neve. Ezek mind szerves r??sz??t k??pezik a mi munk??nknak ??s ez igaz??b??l csak a j??ghegy cs??csa, de a legfontosabbnak mindenk??ppen azt tartom, hogy az ??gyfelek a saj??t ??let??kkel foglalkozhassanak az ingatlanokkal felmer??l?? probl??m??ikra, pedig megfelel?? megold??sokat tal??lunk. Ehhez mindenk??ppen k??lcs??n??sen bizalmi kapcsolatra van sz??ks??g.
            </p>
            <div class="citation">
                <blockquote>Podnik, ktor?? neprin????a ni?? viac ako peniaze, je ??boh?? podnik.</blockquote>
                <p>Henry Ford americk?? priemyseln??k 1863 - 1947</p>
            </div>
        </div>
        <div class="clear"></div>
    </section>

    <section id="section-four-about"  data-aios-staggered-parent="true" data-aios-animation-offset="0.5" data-aios-animation-reset="true"> 
        <div class="section_four_overlay--top bg_color--gold"></div>
        <div class="section_four_overlay--bottom bg_color--blue"></div>
        <div class="alt-icon"><span class="alt-icon-logo-mono-large"></span></div>
            <div class="about-section-img">
                <img src="/images/balazs-szabo-car1.png" alt="Mgr. Bal??zs Szab??"  data-aios-staggered-child="true" data-aios-animation="fadeInLeft" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;"> 
            </div>
        <div class="sec-four-about-content">
            <h2  data-aios-staggered-child="true" data-aios-animation="fadeInUp" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">Lorem dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</h2> 
            <p  data-aios-staggered-child="true" data-aios-animation="fadeInDown" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">Lorem dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Rutrum quisque non tellus orci. Dui accumsan sit amet nulla facilisi morbi. Elementum sagittis vitae et leo duis ut diam quam. Risus at ultrices mi tempus imperdiet nulla malesuada. Pellentesque elit eget gravida cum. Bibendum ut tristique et egestas quis. Eget mi proin sed libero enim sed faucibus turpis. Commodo ullamcorper a lacus vestibulum sed arcu. Urna id volutpat lacus laoreet non curabitur. Scelerisque mauris pellentesque pulvinar pellentesque habitant morbi. Nec feugiat in fermentum posuere urna nec tincidunt. Accumsan sit amet nulla facilisi morbi tempus iaculis urna. Aenean euismod elementum nisi quis eleifend.
            </p>
            <div class="citation">
                <blockquote>Obchod, v ktorom nez??skame ni?? viac ako peniaze, nie je ??iadny obchod.</blockquote>
                <p>Henry Ford americk?? priemyseln??k 1863 - 1947</p>
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
