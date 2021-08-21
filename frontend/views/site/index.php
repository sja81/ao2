<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\models\Aoreal;

$this->title = 'Alpha - Omega Real & Consulting';

$aoreal = new Aoreal();
?>

<main>
    <h2 class="aios-starter-theme-hide-title">Main Content</h2>
    <!-- BEGIN: Slideshow -->
	<div id="alt-slideshow" class="d-block position-relative">
		<div class="cycloneslider cycloneslider-template-video cycloneslider-width-full" id="cycloneslider-homepage-1" >
            <div 
             class="cycloneslider-slides" 
             data-cycle-allow-wrap="true" 
             data-cycle-dynamic-height="off" 
             data-cycle-auto-height="1280:720" 
             data-cycle-auto-height-easing="null" 
             data-cycle-auto-height-speed="250" 
             data-cycle-delay="0" 
             data-cycle-easing="" 
             data-cycle-fx="fade" 
             data-cycle-hide-non-active="true" 
             data-cycle-log="false" 
             data-cycle-next="#cycloneslider-homepage-1 .cycloneslider-next" 
             data-cycle-pager="#cycloneslider-homepage-1 .cycloneslider-pager" 
             data-cycle-pause-on-hover="false" 
             data-cycle-prev="#cycloneslider-homepage-1 .cycloneslider-prev" 
             data-cycle-slides="&gt; div" 
             data-cycle-speed="1000" 
             data-cycle-swipe="1" 
             data-cycle-tile-count="7" 
             data-cycle-tile-delay="100" 
             data-cycle-tile-vertical="true" 
             data-cycle-timeout="4000"
            >
                <div class="cycloneslider-slide cycloneslider-slide-custom" >
                    <canvas width="1280" height="720"></canvas>
                    <video preload="none" data-video-blob="true" data-poster="/images/slider-cover.jpg">
                        <source src="/images/aoreal-promo1b-long.mp4" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
        <script>
            jQuery(document).ready( function() {
                var slider = jQuery("#cycloneslider-homepage-1"); slider.aiosCycloneSliderVideoSlideshow({ fx: "fade", speed: 1000, timeout: 4000 });
            });
        </script>
        <div class="alt-slideshow__overlay alt-icon-logo-mono text-white"></div>
		<div class="alt-arrow bounce ai-font-arrow-b-d"></div>
	</div>
	<!-- End: Slideshow -->
	<!-- BEGIN: About Us -->
	<div id="alt-about-us" class="d-block position-relative">
		<!-- BEGIN: Container -->
		<div class="container position-relative">
			<!-- BEGIN: Row -->
			<div class="row" data-aios-staggered-parent="true" data-aios-animation-offset="0.2" data-aios-animation-reset="false">
				<!-- BEGIN: Altman Brothers Image -->
				<img 
					src="/images/about-us-balazs-szabo_omega_full10.png" 
					alt="Mgr. Balázs Szabó" 
					class="alt-about-us__image img-responsive position-absolute d-inline-block" 
					data-aios-staggered-child="true" 
					data-aios-animation="fadeInUp" 
					data-aios-animation-delay="0.1s"
				>
                <div class="citation idezet2">
                    <blockquote>
                        Vitaj v mojom dome! Kľudne vstúpte. Dajte si pozor a nechajte tu kúsok toho šťastia, ktoré si so sebou nesiete.“
                    </blockquote>
                    <p>Bram Stoker 1847 - 1912</p>
                </div>
				<!-- END: Altman Brothers Image -->
				<!-- BEGIN: Column -->
				<div class="col-md-6 alt-about-us__text position-relative pb-6 text-center text-md-left">
					<div class="alt-about-us__text--before" data-aios-staggered-child="true" data-aios-animation="fadeInDown" data-aios-animation-delay="0s"></div>
					<div class="alt-heading-numerical pl-1" data-aios-staggered-child="true" data-aios-animation="fadeIn" data-aios-animation-delay="0.1s">
						<span class="alt-heading-numberical__number">01</span>
						<span class="alt-heading-numberical__line"></span>
						<?php echo Aoreal::trans('O nás'); ?>
                    </div>
                    <div class="citation idezet1">
                        <?php /*<blockquote>
                            Ha tudhatná a ház, ki érkezett belé,<br>
                            Maga a néma kő vigan köszöntené,<br>
                            A jó hir hallatára a lábához hajolna:<br>
                            Úgy lépj be, drága vendég, akár az otthonodba.
                        </blockquote>
                        <p>Az Ezeregyéjszaka meséi</p>*/ ?>
						<blockquote>
						Vzácneho hosťa celý dom vždy víta,<br>
						zem, po ktorej kráča, bozkom svätí chasa.<br>
						Sláva ti! Voláme v tej chvíli.<br>
						Vsút smelo medzi nás, hosť dobrý a milý!
						</blockquote>
                    </div>
					<div class="alt-about-us__text--title d-block mt-7" data-aios-staggered-child="true" data-aios-animation="fadeInDown" data-aios-animation-delay="0.2s">
						<h2 class="title-default title-default--break"><span class="alphafont"><strong>ALPHA-OMEGA REAL</strong> & CONSULTING s. r. o.</span></h2>
					</div>
					<div class="alt-about-us__text--content d-block mt-3" data-aios-staggered-child="true" data-aios-animation="fadeIn" data-aios-animation-delay="0.3s">
						<div class="text-justify">
                            <p>
Vitajte na webovej stránke</p><p> 
ALPHA-OMEGA REAL & CONSULTING s.r.o.</p><p> 
Naša spoločnosť je Vám k dispozícii s celou škálou ponúkaných nehnuteľností, finančných služieb a poradenstva, s vlastným tímom a tímom skúsených partnerov, s najrýchlejšími a najlepšími riešeniami v oblasti nehnuteľností a finančného poradenstva.</p><p>
Veríme, že tí, čo chcú byť najlepší, idú za najlepšími, preto našim klientom ponúkame naše kvalitné služby a silné partnerské  zázemie. Keďže neexistujú dvaja rovnakí klienti, naše služby prispôsobujeme potrebám a požiadavkám našich klientov. </p><p>
Je pre nás Flow-pocitom, keď môžeme byť nápomocnými našim klientom a získať pre nich najvhodnejšie riešenia. </p><p>
Zverte riešenie Vašich požiadaviek ohľadne nehnuteľností a ich financovania odborníkom z tejto oblasti, aby Ste sa vyhli zbytočným nepríjemnostiam a aby ste si mohli čo najskôr užívať výhody Vášho nového domova alebo podnikania.</p><p>

Chcete predať?</p><p>
Po obhliadke na mieste Vám garantujeme ocenenie trhovej hodnoty Vašej nehnuteľnosti do 24 hodín.</p><p>
V prípade núdze odkúpime Vašu nehnuteľnosť za 70% trhovej hodnoty.</p><p>
Prajeme Vám príjemné prehliadanie a strávenie času na našej webovej stránke.</p><p>
V prípade akýchkoľvek otázok nás neváhajte kontaktovať na ktoromkoľvek z nižšie uvedených kontaktných údajov.</p></div>
						<a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['/kontakt']); ?>" class="secondary-button mt-4 text-uppercase">
							<?php echo Aoreal::trans('Kontaktujte nás'); ?>
						</a>
					</div>
				</div>
				<!-- END: Column -->
			</div>
			<!-- END: Row -->
		</div>
		<!-- END: Container -->
	</div>
	<!-- END: About Us -->
	<!-- BEGIN: Exclusive Properties -->
	<div id="exclusive-properties">
		<!-- BEGIN: Container -->
		<div class="container">
			<!-- BEGIN: Row -->
			<div class="row" data-aios-staggered-parent="true" data-aios-animation-offset="0.2" data-aios-animation-reset="false">
				<!-- BEGIN: Column -->
				<div class="col-md-12 text-center">
					<div id="exclusive-real-estate-properties" class="alt-heading-numerical" data-aios-staggered-child="true" data-aios-animation="fadeIn" data-aios-animation-delay="0s">
						<span class="alt-heading-numberical__number">02</span>
						<span class="alt-heading-numberical__line"></span>
						TOP ponuky
					</div>
					<h2 class="title-default mt-4" data-aios-staggered-child="true" data-aios-animation="fadeInDown" data-aios-animation-delay="0.1s"><strong>Exkluzívne</strong> nehnuteľnosti</h2>
					<h5 class="mb-8" style="color: #a0a0a0;"><i>( Uvedené obrázky sú len ilustráciou!!! Zoznam nehnuteľností budeme aktualizovať postupne.)</i></h5>
				</div>
				<!-- END: Column -->
			</div>
			<!-- END: Row -->
		</div>
		<!-- END: Container -->
		<!-- BEGIN: Properties Container -->
		<div class="expro d-block position-relative">
		    <div id="expro-slider-upper" class="expro-slider expro-container" data-aios-animation="fadeInUp" data-aios-animation-delay="0s" data-aios-animation-reset="false" data-aios-animation-offset="0.2">
                <div class="expro-slide" 
					data-expro-parent="container"
					data-expro-src="/images/sample/sample-property1-large.jpeg"
					data-expro-street=""
					data-expro-city=""
					data-expro-price="">
					<canvas width="532" height="406" class="d-block w-100 bg-no-repeat-center-center-cover" data-seq-src="/images/sample/sample-property1-large.jpeg"></canvas>
					<div class="expro-slider__content">
						<div class="expro-slider__content--address">
							<div class="expro-slider__content--street"><!-- Append Street --></div>
							<div class="expro-slider__content--city"><!-- Append City --></div>
						</div>
						<div class="expro-slider__content--price mt-4"><!-- Append Price --></div>
					</div>
					<div class="expro-slider__overlay">
						<div class="expro-slider__overlay--logo alt-icon-logo-mono text-white"></div>
					<!--<a href="#" class="secondary-button mt-4 text-uppercase"><?php echo Aoreal::trans('Zobraziť detaily'); ?></a>-->
					</div>
					<a href="#" class="expro-link d-inline-block position-absolute pos-all z-index-100"></a>
				</div>
                <div class="expro-slide" 
					data-expro-parent="container"
					data-expro-src="/images/sample/sample-property2-large.jpeg"
					data-expro-street=""
					data-expro-city=""
					data-expro-price="">
					<canvas width="532" height="406" class="d-block w-100 bg-no-repeat-center-center-cover" data-seq-src="/images/sample/sample-property2-large.jpeg"></canvas>
					<div class="expro-slider__content">
						<div class="expro-slider__content--address">
							<div class="expro-slider__content--street"><!-- Append Street --></div>
							<div class="expro-slider__content--city"><!-- Append City --></div>
						</div>
						<div class="expro-slider__content--price mt-4"><!-- Append Price --></div>
					</div>
					<div class="expro-slider__overlay">
						<div class="expro-slider__overlay--logo alt-icon-logo-mono text-white"></div>
						<!--<a href="#" class="secondary-button mt-4 text-uppercase"><?php echo Aoreal::trans('Zobraziť detaily'); ?></a>-->
					</div>
					<a href="#" class="expro-link d-inline-block position-absolute pos-all z-index-100"></a>
				</div>
                <div class="expro-slide" 
					data-expro-parent="container"
					data-expro-src="/images/sample/sample-property3-large.jpeg"
					data-expro-street=""
					data-expro-city=""
					data-expro-price="">
					<canvas width="532" height="406" class="d-block w-100 bg-no-repeat-center-center-cover" data-seq-src="/images/sample/sample-property3-large.jpeg"></canvas>
					<div class="expro-slider__content">
						<div class="expro-slider__content--address">
							<div class="expro-slider__content--street"><!-- Append Street --></div>
							<div class="expro-slider__content--city"><!-- Append City --></div>
						</div>
						<div class="expro-slider__content--price mt-4"><!-- Append Price --></div>
					</div>
					<div class="expro-slider__overlay">
						<div class="expro-slider__overlay--logo alt-icon-logo-mono text-white"></div>
						<!--<a href="#" class="secondary-button mt-4 text-uppercase"><?php echo Aoreal::trans('Zobraziť detaily'); ?></a>-->
					</div>
					<a href="#" class="expro-link d-inline-block position-absolute pos-all z-index-100"></a>
				</div>
                <div class="expro-slide" 
					data-expro-parent="container"
					data-expro-src="/images/sample/sample-property4-large.jpeg"
					data-expro-street=""
					data-expro-city=""
					data-expro-price="">
					<canvas width="532" height="406" class="d-block w-100 bg-no-repeat-center-center-cover" data-seq-src="/images/sample/sample-property4-large.jpeg"></canvas>
					<div class="expro-slider__content">
						<div class="expro-slider__content--address">
							<div class="expro-slider__content--street"><!-- Append Street --></div>
							<div class="expro-slider__content--city"><!-- Append City --></div>
						</div>
						<div class="expro-slider__content--price mt-4"><!-- Append Price --></div>
					</div>
					<div class="expro-slider__overlay">
						<div class="expro-slider__overlay--logo alt-icon-logo-mono text-white"></div>
						<!--<a href="#" class="secondary-button mt-4 text-uppercase"><?php echo Aoreal::trans('Zobraziť detaily'); ?></a>-->
					</div>
					<a href="#" class="expro-link d-inline-block position-absolute pos-all z-index-100"></a>
				</div>
                <div class="expro-slide" 
					data-expro-parent="container"
					data-expro-src="/images/sample/sample-property5-large.jpeg"
					data-expro-street=""
					data-expro-city=""
					data-expro-price="">
					<canvas width="532" height="406" class="d-block w-100 bg-no-repeat-center-center-cover" data-seq-src="/images/sample/sample-property5-large.jpeg"></canvas>
					<div class="expro-slider__content">
						<div class="expro-slider__content--address">
							<div class="expro-slider__content--street"><!-- Append Street --></div>
							<div class="expro-slider__content--city"><!-- Append City --></div>
						</div>
						<div class="expro-slider__content--price mt-4"><!-- Append Price --></div>
					</div>
					<div class="expro-slider__overlay">
						<div class="expro-slider__overlay--logo alt-icon-logo-mono text-white"></div>
						<!--<a href="#" class="secondary-button mt-4 text-uppercase"><?php echo Aoreal::trans('Zobraziť detaily'); ?></a>-->
					</div>
					<a href="#" class="expro-link d-inline-block position-absolute pos-all z-index-100"></a>
				</div>
                <div class="expro-slide" 
					data-expro-parent="container"
					data-expro-src="/images/sample/sample-property6-large.jpeg"
					data-expro-street=""
					data-expro-city=""
					data-expro-price="">
					<canvas width="532" height="406" class="d-block w-100 bg-no-repeat-center-center-cover" data-seq-src="/images/sample/sample-property6-large.jpeg"></canvas>
					<div class="expro-slider__content">
						<div class="expro-slider__content--address">
							<div class="expro-slider__content--street"><!-- Append Street --></div>
							<div class="expro-slider__content--city"><!-- Append City --></div>
						</div>
						<div class="expro-slider__content--price mt-4"><!-- Append Price --></div>
					</div>
					<div class="expro-slider__overlay">
						<div class="expro-slider__overlay--logo alt-icon-logo-mono text-white"></div>
						<!--<a href="#" class="secondary-button mt-4 text-uppercase"><?php echo Aoreal::trans('Zobraziť detaily'); ?></a>-->
					</div>
					<a href="#" class="expro-link d-inline-block position-absolute pos-all z-index-100"></a>
				</div>
                <div class="expro-slide" 
					data-expro-parent="container"
					data-expro-src="/images/sample/sample-property1-large.jpeg"
					data-expro-street=""
					data-expro-city=""
					data-expro-price="">
					<canvas width="532" height="406" class="d-block w-100 bg-no-repeat-center-center-cover" data-seq-src="/images/sample/sample-property1-large.jpeg"></canvas>
					<div class="expro-slider__content">
						<div class="expro-slider__content--address">
							<div class="expro-slider__content--street"><!-- Append Street --></div>
							<div class="expro-slider__content--city"><!-- Append City --></div>
						</div>
						<div class="expro-slider__content--price mt-4"><!-- Append Price --></div>
					</div>
					<div class="expro-slider__overlay">
						<div class="expro-slider__overlay--logo alt-icon-logo-mono text-white"></div>
						<!--<a href="#" class="secondary-button mt-4 text-uppercase"><?php echo Aoreal::trans('Zobraziť detaily'); ?></a>-->
					</div>
					<a href="#" class="expro-link d-inline-block position-absolute pos-all z-index-100"></a>
				</div>
                <div class="expro-slide" 
					data-expro-parent="container"
					data-expro-src="/images/sample/sample-property2-large.jpeg"
					data-expro-street=""
					data-expro-city=""
					data-expro-price="">
					<canvas width="532" height="406" class="d-block w-100 bg-no-repeat-center-center-cover" data-seq-src="/images/sample/sample-property2-large.jpeg"></canvas>
					<div class="expro-slider__content">
						<div class="expro-slider__content--address">
							<div class="expro-slider__content--street"><!-- Append Street --></div>
							<div class="expro-slider__content--city"><!-- Append City --></div>
						</div>
						<div class="expro-slider__content--price mt-4"><!-- Append Price --></div>
					</div>
					<div class="expro-slider__overlay">
						<div class="expro-slider__overlay--logo alt-icon-logo-mono text-white"></div>
						<!--<a href="#" class="secondary-button mt-4 text-uppercase"><?php echo Aoreal::trans('Zobraziť detaily'); ?></a>-->
					</div>
					<a href="#" class="expro-link d-inline-block position-absolute pos-all z-index-100"></a>
				</div>
                <div class="expro-slide" 
					data-expro-parent="container"
					data-expro-src="/images/sample/sample-property3-large.jpeg"
					data-expro-street=""
					data-expro-city=""
					data-expro-price="">
					<canvas width="532" height="406" class="d-block w-100 bg-no-repeat-center-center-cover" data-seq-src="/images/sample/sample-property3-large.jpeg"></canvas>
					<div class="expro-slider__content">
						<div class="expro-slider__content--address">
							<div class="expro-slider__content--street"><!-- Append Street --></div>
							<div class="expro-slider__content--city"><!-- Append City --></div>
						</div>
						<div class="expro-slider__content--price mt-4"><!-- Append Price --></div>
					</div>
					<div class="expro-slider__overlay">
						<div class="expro-slider__overlay--logo alt-icon-logo-mono text-white"></div>
						<!--<a href="#" class="secondary-button mt-4 text-uppercase"><?php echo Aoreal::trans('Zobraziť detaily'); ?></a>-->
					</div>
					<a href="#" class="expro-link d-inline-block position-absolute pos-all z-index-100"></a>
				</div>
            </div>

            <div id="expro-slider-middle" class="expro-slider expro-container" data-aios-animation="fadeInUp" data-aios-animation-delay="0s" data-aios-animation-reset="false" data-aios-animation-offset="0.2">
                <div class="expro-slide" 
					data-expro-parent="container"
					data-expro-src="/images/sample/sample-property4-large.jpeg"
					data-expro-street=""
					data-expro-city=""
					data-expro-price="">
					<canvas width="532" height="406" class="d-block w-100 bg-no-repeat-center-center-cover" data-seq-src="/images/sample/sample-property4-large.jpeg"></canvas>
					<div class="expro-slider__content">
						<div class="expro-slider__content--address">
							<div class="expro-slider__content--street"><!-- Append Street --></div>
							<div class="expro-slider__content--city"><!-- Append City --></div>
						</div>
						<div class="expro-slider__content--price mt-4"><!-- Append Price --></div>
					</div>
					<div class="expro-slider__overlay">
						<div class="expro-slider__overlay--logo alt-icon-logo-mono text-white"></div>
						<!--<a href="#" class="secondary-button mt-4 text-uppercase"><?php echo Aoreal::trans('Zobraziť detaily'); ?></a>-->
					</div>
					<a href="#" class="expro-link d-inline-block position-absolute pos-all z-index-100"></a>
				</div>
                <div class="expro-slide" 
					data-expro-parent="container"
					data-expro-src="/images/sample/sample-property5-large.jpeg"
					data-expro-street=""
					data-expro-city=""
					data-expro-price="">
					<canvas width="532" height="406" class="d-block w-100 bg-no-repeat-center-center-cover" data-seq-src="/images/sample/sample-property5-large.jpeg"></canvas>
					<div class="expro-slider__content">
						<div class="expro-slider__content--address">
							<div class="expro-slider__content--street"><!-- Append Street --></div>
							<div class="expro-slider__content--city"><!-- Append City --></div>
						</div>
						<div class="expro-slider__content--price mt-4"><!-- Append Price --></div>
					</div>
					<div class="expro-slider__overlay">
						<div class="expro-slider__overlay--logo alt-icon-logo-mono text-white"></div>
						<!--<a href="#" class="secondary-button mt-4 text-uppercase"><?php echo Aoreal::trans('Zobraziť detaily'); ?></a>-->
					</div>
					<a href="#" class="expro-link d-inline-block position-absolute pos-all z-index-100"></a>
				</div>
                <div class="expro-slide" 
					data-expro-parent="container"
					data-expro-src="/images/sample/sample-property6-large.jpeg"
					data-expro-street=""
					data-expro-city=""
					data-expro-price="">
					<canvas width="532" height="406" class="d-block w-100 bg-no-repeat-center-center-cover" data-seq-src="/images/sample/sample-property6-large.jpeg"></canvas>
					<div class="expro-slider__content">
						<div class="expro-slider__content--address">
							<div class="expro-slider__content--street"><!-- Append Street --></div>
							<div class="expro-slider__content--city"><!-- Append City --></div>
						</div>
						<div class="expro-slider__content--price mt-4"><!-- Append Price --></div>
					</div>
					<div class="expro-slider__overlay">
						<div class="expro-slider__overlay--logo alt-icon-logo-mono text-white"></div>
						<!--<a href="#" class="secondary-button mt-4 text-uppercase"><?php echo Aoreal::trans('Zobraziť detaily'); ?></a>-->
					</div>
					<a href="#" class="expro-link d-inline-block position-absolute pos-all z-index-100"></a>
				</div>
                <div class="expro-slide" 
					data-expro-parent="container"
					data-expro-src="/images/sample/sample-property1-large.jpeg"
					data-expro-street=""
					data-expro-city=""
					data-expro-price="">
					<canvas width="532" height="406" class="d-block w-100 bg-no-repeat-center-center-cover" data-seq-src="/images/sample/sample-property1-large.jpeg"></canvas>
					<div class="expro-slider__content">
						<div class="expro-slider__content--address">
							<div class="expro-slider__content--street"><!-- Append Street --></div>
							<div class="expro-slider__content--city"><!-- Append City --></div>
						</div>
						<div class="expro-slider__content--price mt-4"><!-- Append Price --></div>
					</div>
					<div class="expro-slider__overlay">
						<div class="expro-slider__overlay--logo alt-icon-logo-mono text-white"></div>
						<!--<a href="#" class="secondary-button mt-4 text-uppercase"><?php echo Aoreal::trans('Zobraziť detaily'); ?></a>-->
					</div>
					<a href="#" class="expro-link d-inline-block position-absolute pos-all z-index-100"></a>
				</div>
                <div class="expro-slide" 
					data-expro-parent="container"
					data-expro-src="/images/sample/sample-property2-large.jpeg"
					data-expro-street=""
					data-expro-city=""
					data-expro-price="">
					<canvas width="532" height="406" class="d-block w-100 bg-no-repeat-center-center-cover" data-seq-src="/images/sample/sample-property2-large.jpeg"></canvas>
					<div class="expro-slider__content">
						<div class="expro-slider__content--address">
							<div class="expro-slider__content--street"><!-- Append Street --></div>
							<div class="expro-slider__content--city"><!-- Append City --></div>
						</div>
						<div class="expro-slider__content--price mt-4"><!-- Append Price --></div>
					</div>
					<div class="expro-slider__overlay">
						<div class="expro-slider__overlay--logo alt-icon-logo-mono text-white"></div>
						<!--<a href="#" class="secondary-button mt-4 text-uppercase"><?php echo Aoreal::trans('Zobraziť detaily'); ?></a>-->
					</div>
					<a href="#" class="expro-link d-inline-block position-absolute pos-all z-index-100"></a>
				</div>
                <div class="expro-slide" 
					data-expro-parent="container"
					data-expro-src="/images/sample/sample-property3-large.jpeg"
					data-expro-street=""
					data-expro-city=""
					data-expro-price="">
					<canvas width="532" height="406" class="d-block w-100 bg-no-repeat-center-center-cover" data-seq-src="/images/sample/sample-property3-large.jpeg"></canvas>
					<div class="expro-slider__content">
						<div class="expro-slider__content--address">
							<div class="expro-slider__content--street"><!-- Append Street --></div>
							<div class="expro-slider__content--city"><!-- Append City --></div>
						</div>
						<div class="expro-slider__content--price mt-4"><!-- Append Price --></div>
					</div>
					<div class="expro-slider__overlay">
						<div class="expro-slider__overlay--logo alt-icon-logo-mono text-white"></div>
						<!--<a href="#" class="secondary-button mt-4 text-uppercase"><?php echo Aoreal::trans('Zobraziť detaily'); ?></a>-->
					</div>
					<a href="#" class="expro-link d-inline-block position-absolute pos-all z-index-100"></a>
				</div>
                <div class="expro-slide" 
					data-expro-parent="container"
					data-expro-src="/images/sample/sample-property4-large.jpeg"
					data-expro-street=""
					data-expro-city=""
					data-expro-price="">
					<canvas width="532" height="406" class="d-block w-100 bg-no-repeat-center-center-cover" data-seq-src="/images/sample/sample-property4-large.jpeg"></canvas>
					<div class="expro-slider__content">
						<div class="expro-slider__content--address">
							<div class="expro-slider__content--street"><!-- Append Street --></div>
							<div class="expro-slider__content--city"><!-- Append City --></div>
						</div>
						<div class="expro-slider__content--price mt-4"><!-- Append Price --></div>
					</div>
					<div class="expro-slider__overlay">
						<div class="expro-slider__overlay--logo alt-icon-logo-mono text-white"></div>
						<!--<a href="#" class="secondary-button mt-4 text-uppercase"><?php echo Aoreal::trans('Zobraziť detaily'); ?></a>-->
					</div>
					<a href="#" class="expro-link d-inline-block position-absolute pos-all z-index-100"></a>
				</div>
                <div class="expro-slide" 
					data-expro-parent="container"
					data-expro-src="/images/sample/sample-property5-large.jpeg"
					data-expro-street=""
					data-expro-city=""
					data-expro-price="">
					<canvas width="532" height="406" class="d-block w-100 bg-no-repeat-center-center-cover" data-seq-src="/images/sample/sample-property5-large.jpeg"></canvas>
					<div class="expro-slider__content">
						<div class="expro-slider__content--address">
							<div class="expro-slider__content--street"><!-- Append Street --></div>
							<div class="expro-slider__content--city"><!-- Append City --></div>
						</div>
						<div class="expro-slider__content--price mt-4"><!-- Append Price --></div>
					</div>
					<div class="expro-slider__overlay">
						<div class="expro-slider__overlay--logo alt-icon-logo-mono text-white"></div>
						<!--<a href="#" class="secondary-button mt-4 text-uppercase"><?php echo Aoreal::trans('Zobraziť detaily'); ?></a>-->
					</div>
					<a href="#" class="expro-link d-inline-block position-absolute pos-all z-index-100"></a>
				</div>
                <div class="expro-slide" 
					data-expro-parent="container"
					data-expro-src="/images/sample/sample-property6-large.jpeg"
					data-expro-street=""
					data-expro-city=""
					data-expro-price="">
					<canvas width="532" height="406" class="d-block w-100 bg-no-repeat-center-center-cover" data-seq-src="/images/sample/sample-property6-large.jpeg"></canvas>
					<div class="expro-slider__content">
						<div class="expro-slider__content--address">
							<div class="expro-slider__content--street"><!-- Append Street --></div>
							<div class="expro-slider__content--city"><!-- Append City --></div>
						</div>
						<div class="expro-slider__content--price mt-4"><!-- Append Price --></div>
					</div>
					<div class="expro-slider__overlay">
						<div class="expro-slider__overlay--logo alt-icon-logo-mono text-white"></div>
						<!--<a href="#" class="secondary-button mt-4 text-uppercase"><?php echo Aoreal::trans('Zobraziť detaily'); ?></a>-->
					</div>
					<a href="#" class="expro-link d-inline-block position-absolute pos-all z-index-100"></a>
				</div>
            </div>

            <div id="expro-slider-lower" class="expro-slider expro-container" data-aios-animation="fadeInUp" data-aios-animation-delay="0s" data-aios-animation-reset="false" data-aios-animation-offset="0.2">
                <div class="expro-slide" 
					data-expro-parent="container"
					data-expro-src="/images/sample/sample-property1-large.jpeg"
					data-expro-street=""
					data-expro-city=""
					data-expro-price="">
					<canvas width="532" height="406" class="d-block w-100 bg-no-repeat-center-center-cover" data-seq-src="/images/sample/sample-property1-large.jpeg"></canvas>
					<div class="expro-slider__content">
						<div class="expro-slider__content--address">
							<div class="expro-slider__content--street"><!-- Append Street --></div>
							<div class="expro-slider__content--city"><!-- Append City --></div>
						</div>
						<div class="expro-slider__content--price mt-4"><!-- Append Price --></div>
					</div>
					<div class="expro-slider__overlay">
						<div class="expro-slider__overlay--logo alt-icon-logo-mono text-white"></div>
						<!--<a href="#" class="secondary-button mt-4 text-uppercase"><?php echo Aoreal::trans('Zobraziť detaily'); ?></a>-->
					</div>
					<a href="#" class="expro-link d-inline-block position-absolute pos-all z-index-100"></a>
				</div>
                <div class="expro-slide" 
					data-expro-parent="container"
					data-expro-src="/images/sample/sample-property2-large.jpeg"
					data-expro-street=""
					data-expro-city=""
					data-expro-price="">
					<canvas width="532" height="406" class="d-block w-100 bg-no-repeat-center-center-cover" data-seq-src="/images/sample/sample-property2-large.jpeg"></canvas>
					<div class="expro-slider__content">
						<div class="expro-slider__content--address">
							<div class="expro-slider__content--street"><!-- Append Street --></div>
							<div class="expro-slider__content--city"><!-- Append City --></div>
						</div>
						<div class="expro-slider__content--price mt-4"><!-- Append Price --></div>
					</div>
					<div class="expro-slider__overlay">
						<div class="expro-slider__overlay--logo alt-icon-logo-mono text-white"></div>
						<!--<a href="#" class="secondary-button mt-4 text-uppercase"><?php echo Aoreal::trans('Zobraziť detaily'); ?></a>-->
					</div>
					<a href="#" class="expro-link d-inline-block position-absolute pos-all z-index-100"></a>
				</div>
                <div class="expro-slide" 
					data-expro-parent="container"
					data-expro-src="/images/sample/sample-property3-large.jpeg"
					data-expro-street=""
					data-expro-city=""
					data-expro-price="">
					<canvas width="532" height="406" class="d-block w-100 bg-no-repeat-center-center-cover" data-seq-src="/images/sample/sample-property3-large.jpeg"></canvas>
					<div class="expro-slider__content">
						<div class="expro-slider__content--address">
							<div class="expro-slider__content--street"><!-- Append Street --></div>
							<div class="expro-slider__content--city"><!-- Append City --></div>
						</div>
						<div class="expro-slider__content--price mt-4"><!-- Append Price --></div>
					</div>
					<div class="expro-slider__overlay">
						<div class="expro-slider__overlay--logo alt-icon-logo-mono text-white"></div>
						<!--<a href="#" class="secondary-button mt-4 text-uppercase"><?php echo Aoreal::trans('Zobraziť detaily'); ?></a>-->
					</div>
					<a href="#" class="expro-link d-inline-block position-absolute pos-all z-index-100"></a>
				</div>
                <div class="expro-slide" 
					data-expro-parent="container"
					data-expro-src="/images/sample/sample-property4-large.jpeg"
					data-expro-street=""
					data-expro-city=""
					data-expro-price="">
					<canvas width="532" height="406" class="d-block w-100 bg-no-repeat-center-center-cover" data-seq-src="/images/sample/sample-property4-large.jpeg"></canvas>
					<div class="expro-slider__content">
						<div class="expro-slider__content--address">
							<div class="expro-slider__content--street"><!-- Append Street --></div>
							<div class="expro-slider__content--city"><!-- Append City --></div>
						</div>
						<div class="expro-slider__content--price mt-4"><!-- Append Price --></div>
					</div>
					<div class="expro-slider__overlay">
						<div class="expro-slider__overlay--logo alt-icon-logo-mono text-white"></div>
						<!--<a href="#" class="secondary-button mt-4 text-uppercase"><?php echo Aoreal::trans('Zobraziť detaily'); ?></a>-->
					</div>
					<a href="#" class="expro-link d-inline-block position-absolute pos-all z-index-100"></a>
				</div>
                <div class="expro-slide" 
					data-expro-parent="container"
					data-expro-src="/images/sample/sample-property5-large.jpeg"
					data-expro-street=""
					data-expro-city=""
					data-expro-price="">
					<canvas width="532" height="406" class="d-block w-100 bg-no-repeat-center-center-cover" data-seq-src="/images/sample/sample-property5-large.jpeg"></canvas>
					<div class="expro-slider__content">
						<div class="expro-slider__content--address">
							<div class="expro-slider__content--street"><!-- Append Street --></div>
							<div class="expro-slider__content--city"><!-- Append City --></div>
						</div>
						<div class="expro-slider__content--price mt-4"><!-- Append Price --></div>
					</div>
					<div class="expro-slider__overlay">
						<div class="expro-slider__overlay--logo alt-icon-logo-mono text-white"></div>
						<!--<a href="#" class="secondary-button mt-4 text-uppercase"><?php echo Aoreal::trans('Zobraziť detaily'); ?></a>-->
					</div>
					<a href="#" class="expro-link d-inline-block position-absolute pos-all z-index-100"></a>
				</div>
                <div class="expro-slide" 
					data-expro-parent="container"
					data-expro-src="/images/sample/sample-property6-large.jpeg"
					data-expro-street=""
					data-expro-city=""
					data-expro-price="">
					<canvas width="532" height="406" class="d-block w-100 bg-no-repeat-center-center-cover" data-seq-src="/images/sample/sample-property6-large.jpeg"></canvas>
					<div class="expro-slider__content">
						<div class="expro-slider__content--address">
							<div class="expro-slider__content--street"><!-- Append Street --></div>
							<div class="expro-slider__content--city"><!-- Append City --></div>
						</div>
						<div class="expro-slider__content--price mt-4"><!-- Append Price --></div>
					</div>
					<div class="expro-slider__overlay">
						<div class="expro-slider__overlay--logo alt-icon-logo-mono text-white"></div>
						<!--<a href="#" class="secondary-button mt-4 text-uppercase"><?php echo Aoreal::trans('Zobraziť detaily'); ?></a>-->
					</div>
					<a href="#" class="expro-link d-inline-block position-absolute pos-all z-index-100"></a>
				</div>
                <div class="expro-slide" 
					data-expro-parent="container"
					data-expro-src="/images/sample/sample-property1-large.jpeg"
					data-expro-street=""
					data-expro-city=""
					data-expro-price="">
					<canvas width="532" height="406" class="d-block w-100 bg-no-repeat-center-center-cover" data-seq-src="/images/sample/sample-property1-large.jpeg"></canvas>
					<div class="expro-slider__content">
						<div class="expro-slider__content--address">
							<div class="expro-slider__content--street"><!-- Append Street --></div>
							<div class="expro-slider__content--city"><!-- Append City --></div>
						</div>
						<div class="expro-slider__content--price mt-4"><!-- Append Price --></div>
					</div>
					<div class="expro-slider__overlay">
						<div class="expro-slider__overlay--logo alt-icon-logo-mono text-white"></div>
						<!--<a href="#" class="secondary-button mt-4 text-uppercase"><?php echo Aoreal::trans('Zobraziť detaily'); ?></a>-->
					</div>
					<a href="#" class="expro-link d-inline-block position-absolute pos-all z-index-100"></a>
				</div>
                <div class="expro-slide" 
					data-expro-parent="container"
					data-expro-src="/images/sample/sample-property2-large.jpeg"
					data-expro-street=""
					data-expro-city=""
					data-expro-price="">
					<canvas width="532" height="406" class="d-block w-100 bg-no-repeat-center-center-cover" data-seq-src="/images/sample/sample-property2-large.jpeg"></canvas>
					<div class="expro-slider__content">
						<div class="expro-slider__content--address">
							<div class="expro-slider__content--street"><!-- Append Street --></div>
							<div class="expro-slider__content--city"><!-- Append City --></div>
						</div>
						<div class="expro-slider__content--price mt-4"><!-- Append Price --></div>
					</div>
					<div class="expro-slider__overlay">
						<div class="expro-slider__overlay--logo alt-icon-logo-mono text-white"></div>
						<!--<a href="#" class="secondary-button mt-4 text-uppercase"><?php echo Aoreal::trans('Zobraziť detaily'); ?></a>-->
					</div>
					<a href="#" class="expro-link d-inline-block position-absolute pos-all z-index-100"></a>
				</div>
                <div class="expro-slide" 
					data-expro-parent="container"
					data-expro-src="/images/sample/sample-property3-large.jpeg"
					data-expro-street=""
					data-expro-city=""
					data-expro-price="">
					<canvas width="532" height="406" class="d-block w-100 bg-no-repeat-center-center-cover" data-seq-src="/images/sample/sample-property3-large.jpeg"></canvas>
					<div class="expro-slider__content">
						<div class="expro-slider__content--address">
							<div class="expro-slider__content--street"><!-- Append Street --></div>
							<div class="expro-slider__content--city"><!-- Append City --></div>
						</div>
						<div class="expro-slider__content--price mt-4"><!-- Append Price --></div>
					</div>
					<div class="expro-slider__overlay">
						<div class="expro-slider__overlay--logo alt-icon-logo-mono text-white"></div>
						<!--<a href="#" class="secondary-button mt-4 text-uppercase"><?php echo Aoreal::trans('Zobraziť detaily'); ?></a>-->
					</div>
					<a href="#" class="expro-link d-inline-block position-absolute pos-all z-index-100"></a>
				</div>
            </div>		
            <div class="overlay-property-offer">
                <img class="img-responsive" src="/images/img-offer-balazs-szabo1.png" alt="">
            </div>
        </div>
		<!-- END: Properties Container -->
	</div>
	<!-- END: Exclusive Properties -->

	

	

	
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                
            </div>
        </div>
    </div>
    
    <!-- BEGIN: Training + Speaking -->	
	<div id="training-speaking" class="d-block position-relative mx-auto" data-seq-src="/images/financne-poradenstvo-img-6.png">
		<span class="alt-icon-logo-mono"></span>
		<!-- BEGIN: Container -->
		<div class="container">
			<!-- BEGIN: Row -->
			<div class="row">
				<!-- BEGIN: Column -->
				<div class="col-sm-4 col-lg-7 heightenin float-sm-none d-none d-sm-inline-block align-bottom"></div>
				<!-- END: Column -->
				<!-- BEGIN: Column -->
				<div class="col-sm-12 col-lg-5 float-sm-none d-sm-inline-block align-bottom text-center text-sm-left text-lg-right" data-aios-staggered-parent="true" data-aios-animation-offset="0.2" data-aios-animation-reset="false">
					<div class="training-speaking__title d-lg-inline-block w-100 position-relative text-left">
						<span class="training-speaking__accent--top d-inline-block position-absolute" data-aios-staggered-child="true" data-aios-animation="fadeInDown" data-aios-animation-delay="0s"></span>
						<span class="training-speaking__accent--bottom d-inline-block position-absolute" data-aios-staggered-child="true" data-aios-animation="fadeInUp" data-aios-animation-delay="0s"></span>
						<div class="alt-heading-numerical" data-aios-staggered-child="true" data-aios-animation="fadeIn" data-aios-animation-delay="0s">
							<span class="alt-heading-numberical__number">03</span>
							<span class="alt-heading-numberical__line"></span>
							Finančné poradenstvo
						</div>
						<h2 class="title-default title-default--break" data-aios-staggered-child="true" data-aios-animation="fadeInUp" data-aios-animation-delay="0s"><strong>Finančné</strong> poradenstvo</h2>
					</div>
					<div class="training-speaking__description d-inline-block mt-10 mb-0 mt-md-10 text-center text-lg-right" data-aios-staggered-child="true" data-aios-animation="fadeInRight" data-aios-animation-delay="0s">
						<p class="font-weight-light">Vybavovanie úverov je bezplatnou službou pre našich klientov.</p> 
						Sme schopní vybaviť úvery vo všetkých finančných inštitúciách a vieme Vám ponúknuť tie najlepšie ponuky slovenského finančného trhu.</p>
                        <div class="video-player">
                            <!-- Youtube Video -->
							<iframe width="310" height="175" src="https://www.youtube.com/embed/_fystFKcmok" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
					</div>
				</div>
				<!-- END: Column -->
			</div>
			<!-- END: Row -->
			<!-- BEGIN: Row -->
			<div class="row mt-6">
				<!-- BEGIN: Column -->
				<div class="col-md-12 text-center text-lg-right" data-aios-staggered-parent="true" data-aios-animation-offset="0.2" data-aios-animation-reset="false">
					<a href="#" class="secondary-button secondary-button-big secondary-button-reverse text-uppercase" data-aios-staggered-child="true" data-aios-animation="fadeInUp" data-aios-animation-delay="0s">
						Hypokalkulačka
					</a>
					<a href="#" class="secondary-button secondary-button-big secondary-button-reverse text-uppercase mt-3 mt-sm-0 ml-sm-6" data-aios-staggered-child="true" data-aios-animation="fadeInRight" data-aios-animation-delay="0s">
						Rezervácia termínu
					</a>
				</div>
				<!-- END: Column -->
			</div>
			<!-- END: Row -->
		</div>
		<!-- END: Container -->
	</div>
	<!-- END: Training + Speaking -->
    
    <!-- BEGIN: Spotlight -->
<div class="mdl-spotlight mt-7 clearfix"> 
  
  <!-- BEGIN: Content -->
  <div class="mdl-spotlight--right float-left position-relative"> 
    <!-- BEGIN: Blank Box -->
    <canvas width="206" height="179" class="floating-blue float-left" data-aios-reveal="true" data-aios-animation="fadeIn" data-aios-animation-delay="0s" data-aios-animation-reset="false" data-aios-animation-offset="0.5"></canvas>
    <!-- ENd: Blank Box --> 
    <!-- BEGIN: Main Container -->
    <div class="mdl-spotlight__container float-left position-relative w-100 pt-8 pl-4"> 
      <!-- BEGIN: Background -->
      <canvas class="floating-grayscale float-right position-absolute" data-seq-src="/images/img-all-inclusive-home1.jpg"></canvas>
      <!-- END: Background --> 
      <!-- BEGIN: Title -->
      <div class="alt-heading-numerical ml-6 position-relative" data-aios-reveal="true" data-aios-animation="fadeIn" data-aios-animation-delay="0s" data-aios-animation-reset="false" data-aios-animation-offset="0.2"> <span class="alt-heading-numberical__number text-white">04</span> <span class="alt-heading-numberical__line"></span> All-Inclusive Service </div>
      <h2 class="title-default mt-4 ml-6 mb-8 text-white position-relative"  data-aios-reveal="true" data-aios-animation="fadeUp" data-aios-animation-delay="0.1s" data-aios-animation-reset="false" data-aios-animation-offset="0."><strong>All-Inclusive</strong> Service</h2>
      <!-- END: Title --> 
      <!-- BEGIN: Slider -->
      <div class="mdl-spotlight__slider pr-3 pr-sm-10"> 
        <!-- BEGIN: Slide -->
        <div class="mdl-spotlight__slide">
            <div class="mdl-spotlight__slide--logo"><a href="#"  class="test" target="_blank">
                <canvas width="212" height="212" class="d-block w-100 ai-lazy media-bg-white"></canvas>
                <img src="/images/clear.png" data-seq-src="/images/all-inclusive/img-all-inclusive-1-small-min.jpg" alt=""></a>
            </div>
            <div class="mdl-spotlight__slide--logo"><a href="#"  class="test" target="_blank">
                <canvas width="212" height="212" class="d-block w-100 ai-lazy media-bg-gold"></canvas>
                <img src="/images/clear.png" data-seq-src="/images/all-inclusive/img-all-inclusive-2-small-min.jpg" alt=""></a>
            </div>
            <div class="mdl-spotlight__slide--logo"><a href="#"  class="test" target="_blank">
                <canvas width="212" height="212" class="d-block w-100 ai-lazy media-bg-gray"></canvas>
                <img src="/images/clear.png" data-seq-src="/images/all-inclusive/img-all-inclusive-3-small-min.jpg" alt=""></a>
            </div>
            <div class="mdl-spotlight__slide--logo"><a href="#"  class="test" target="_blank">
                <canvas width="212" height="212" class="d-block w-100 ai-lazy media-bg-blue"></canvas>
                <img src="/images/clear.png" data-seq-src="/images/all-inclusive/img-all-inclusive-4-small-min.jpg" alt=""></a>
            </div>
            <div class="mdl-spotlight__slide--logo"><a href="#"  class="test" target="_blank">
                <canvas width="212" height="212" class="d-block w-100 ai-lazy media-bg-gray"></canvas>
                <img src="/images/clear.png" data-seq-src="/images/all-inclusive/img-all-inclusive-5-small-min.jpg" alt=""></a>
            </div>
            <div class="mdl-spotlight__slide--logo"><a href="#"  class="test" target="_blank">
                <canvas width="212" height="212" class="d-block w-100 ai-lazy media-bg-white"></canvas>
                <img src="/images/clear.png" data-seq-src="/images/all-inclusive/img-all-inclusive-6-small-min.jpg" alt=""></a>
            </div>
        </div>
        <div class="mdl-spotlight__slide">
            <div class="mdl-spotlight__slide--logo"><a href="#"  class="test" target="_blank">
                <canvas width="212" height="212" class="d-block w-100 ai-lazy media-bg-gold"></canvas>
                <img src="/images/clear.png" data-seq-src="/images/all-inclusive/img-all-inclusive-7-small-min.jpg" alt=""></a>
            </div>
            <div class="mdl-spotlight__slide--logo"><a href="#"  class="test" target="_blank">
                <canvas width="212" height="212" class="d-block w-100 ai-lazy media-bg-gold"></canvas>
                <img src="/images/clear.png" data-seq-src="/images/all-inclusive/img-all-inclusive-8-small-min.jpg" alt=""></a>
            </div>
            <div class="mdl-spotlight__slide--logo"><a href="#"  class="test" target="_blank">
                <canvas width="212" height="212" class="d-block w-100 ai-lazy media-bg-blue"></canvas>
                <img src="/images/clear.png" data-seq-src="/images/all-inclusive/img-all-inclusive-9-small-min.jpg" alt=""></a>
            </div>
            <div class="mdl-spotlight__slide--logo"><a href="#"  class="test" target="_blank">
                <canvas width="212" height="212" class="d-block w-100 ai-lazy media-bg-white"></canvas>
                <img src="/images/clear.png" data-seq-src="/images/all-inclusive/img-all-inclusive-10-small-min.jpg" alt=""></a>
            </div>
            <div class="mdl-spotlight__slide--logo"><a href="#"  class="test" target="_blank">
                <canvas width="212" height="212" class="d-block w-100 ai-lazy media-bg-gray"></canvas>
                <img src="/images/clear.png" data-seq-src="/images/all-inclusive/img-all-inclusive-11-small-min.jpg" alt=""></a>
            </div>
            <div class="mdl-spotlight__slide--logo"><a href="#"  class="test" target="_blank">
                <canvas width="212" height="212" class="d-block w-100 ai-lazy media-bg-white"></canvas>
                <img src="/images/clear.png" data-seq-src="/images/all-inclusive/img-all-inclusive-12-small-min.jpg" alt=""></a>
            </div>
        </div>
        <div class="mdl-spotlight__slide">
            <div class="mdl-spotlight__slide--logo"><a href="#"  class="test" target="_blank">
                <canvas width="212" height="212" class="d-block w-100 ai-lazy media-bg-gold"></canvas>
                <img src="/images/clear.png" data-seq-src="/images/all-inclusive/img-all-inclusive-13-small-min.jpg" alt=""></a>
            </div>
            <div class="mdl-spotlight__slide--logo"><a href="#"  class="test" target="_blank">
                <canvas width="212" height="212" class="d-block w-100 ai-lazy media-bg-white"></canvas>
                <img src="/images/clear.png" data-seq-src="/images/all-inclusive/img-all-inclusive-14-small-min.jpg" alt=""></a>
            </div>
            <div class="mdl-spotlight__slide--logo"><a href="#"  class="test" target="_blank">
                <canvas width="212" height="212" class="d-block w-100 ai-lazy media-bg-blue"></canvas>
                <img src="/images/clear.png" data-seq-src="/images/all-inclusive/img-all-inclusive-15-small-min.jpg" alt=""></a>
            </div>
        </div>
        <!-- END: Slide --> 
      </div>
      <!-- END: Slider --> 
    </div>
    <!-- END: Main Container --> 
  </div>
  <!-- END: Content --> 
  <!-- BEGIN: Main Image -->
    <div class="mdl-spotlight--left float-left position-relative"> <img 
        src="/images/clear.png" 
        data-seq-src="/images/img-balazs-szabo-call1.jpg" 
        class="d-block w-100" 
        alt="Altmans on Spotlight"
    > </div>
  <!-- END: Main Image --> 
</div>
		<!-- END: Spotlight -->
    
    <!-- BEGIN: We're Social -->
	<div id="were-social" class="position-relative">
		<span class="alt-icon-logo-mono"></span>
		<!-- BEGIN: Main Image -->
		<div class="were-social--left float-left position-relative">
			<img src="/images/clear.png" class="d-block w-100" data-seq-src="/images/were-social-plane-handshake.jpg" data-offset="0" alt="We're on Social Media">
		</div>
		<!-- END: Main Image -->
		<!-- BEGIN: Overlay -->
		<div class="were-social--overlay float-left position-absolute">
			<img src="/images/clear.png" class="d-block w-100" data-seq-src="/images/were-social-car1.jpg" data-offset="0" alt="We're on Social Media overlay">
		</div>
		<!-- END: Overlay -->
		<!-- BEGIN: Content -->
		<div class="were-social--right float-left position-relative">
			<!-- BEGIN: Blank Box -->
			<canvas width="206" height="179" class="floating-transparent float-left" data-aios-reveal="true" data-aios-animation="fadeIn" data-aios-animation-delay="0s" data-aios-animation-reset="false" data-aios-animation-offset="0.5"></canvas>
			<!-- END: Blank Box -->
			<!-- BEGIN: Main Container -->
			<div class="were-social__container float-left position-relative w-100 pt-8 pl-4 pl-md-10 pr-3 pr-md-0">
				<!-- BEGIN: Background -->
				<!-- <img src="/images/clear.png" class="floating-grayscale float-right position-absolute ai-lazy" data-src="/images/were-social-airport-handshake.jpg" data-offset="0"> -->
				<canvas class="floating-grayscale float-right position-absolute ai-lazy" data-src="/images/were-social-airport-handshake.jpg" data-class="custom-class-1" data-animation="fadeInUp" data-offset="0"></canvas>
				<!-- END: Background -->
				<div data-aios-staggered-parent="true" data-aios-animation-offset="0.2" data-aios-animation-reset="false">
					<!-- BEGIN: Title & Description -->
					<div class="alt-heading-numerical ml-6 position-relative" data-aios-staggered-child="true" data-aios-animation="fadeIn" data-aios-animation-delay="0s">
						<span class="alt-heading-numberical__number text-white">05</span>
						<span class="alt-heading-numberical__line"></span>
						Makléri
					</div>
					<h2 class="title-default mt-4 ml-6 mb-4 text-white position-relative" data-aios-staggered-child="true" data-aios-animation="fadeInUp" data-aios-animation-delay="0s"><strong>Keby ste ma</strong> potrebovali</h2>
					<p class="were-social__container--description ml-6 mb-4 text-gray position-relative" data-aios-staggered-child="true" data-aios-animation="fadeIn" data-aios-animation-delay="0.1s">
Sledujte nás na sociálnych médiách a získajte najexkluzívnejšie správy o nehnuteľnostiach a fotografie z našich úžasných záznamov.</p>
					<!-- END: Title & Description -->
					<!-- BEGIN: Social Media Boxes -->
					<div class="were-social__boxes d-block" data-aios-staggered-child="true" data-aios-animation="fadeInUp" data-aios-animation-delay="0.2s">
						<!-- BEGIN: Row -->
						<div class="were-social__boxes--row">
							<!-- BEGIN: Column -->
							<div class="were-social__boxes--col">
								<div class="were-social__boxes--content position-relative text-right">
									<canvas width="250" height="250" class="d-block w-100"></canvas>
									<div class="were-social__boxes--arrow"></div>
									<div class="were-social__boxes--name d-block position-absolute w-100 px-3 px-sm-5 raleway">
										<h4 class="mb-3">Mgr. BALÁZS <strong>SZABÓ</strong></h4>
										<div class="were-social__boxes--smi">
											<?php
                                            if ($aoreal->facebook)
                                                echo '<a href="'.$aoreal->facebook.'" target="_blank" class="ai-font-facebook d-inline-block mr-1 text-decoration-none align-middle"></a>';
                                            if ($aoreal->twitter)
                                                echo '<a href="'.$aoreal->twitter.'" target="_blank" class="ai-font-twitter d-inline-block mx-1 text-decoration-none align-middle"></a>';
                                            if ($aoreal->instagram)
								                echo '<a href="'.$aoreal->instagram.'" target="_blank" class="ai-font-instagram d-inline-block mx-1 text-decoration-none align-middle"></a>';
                                            if ($aoreal->linkedin)
				                                echo '<a href="'.$aoreal->linkedin.'" target="_blank" class="ai-font-linkedin d-inline-block mx-1 text-decoration-none align-middle"></a>';

								            echo '<a href="'.Yii::$app->urlManager->createAbsoluteUrl(['/kontakt']).'" class="ai-font-envelope-f d-inline-block ml-1 text-decoration-none align-middle"></a>';
                                            ?>
										</div>
									</div>
								</div>
							</div>
							<!-- END: Column -->
							<!-- BEGIN: Column -->
							<div class="were-social__boxes--col">
								<div class="were-social__boxes--content">
									<canvas width="250" height="250" class="bg-no-repeat-center-center-cover" data-seq-src="/images/social-balazs-szabo2.jpg"></canvas>
								</div>
							</div>
							<!-- END: Column -->
						</div>
						<!-- END: Row -->
                        <?php /*
						<!-- BEGIN: Row -->
						<div class="were-social__boxes--row">
							<!-- BEGIN: Column -->
							<div class="were-social__boxes--col">
								<div class="were-social__boxes--content">
									<canvas width="250" height="250" class="bg-no-repeat-center-center-cover" data-seq-src="//www.thealtmanbrothers.com/wp-content/themes/thealtmanbrothers/assets/frontend/images/social-matthew.jpg"></canvas>
								</div>
							</div>
							<!-- END: Column -->
							<!-- BEGIN: Column -->
							<div class="were-social__boxes--col">
								<div class="were-social__boxes--content position-relative">
									<canvas width="250" height="250" class="d-block w-100"></canvas>
									<div class="were-social__boxes--arrow"></div>
									<div class="were-social__boxes--name d-block position-absolute w-100 px-3 px-sm-5 raleway">
										<h4 class="text-uppercase mb-3"><strong>Matthew</strong> Altman</h4>
										<div class="were-social__boxes--smi">
											<a href="//www.facebook.com/MattoftheAltmanBrothers" target="_blank" class="ai-font-facebook d-inline-block mr-1 text-decoration-none align-middle"></a>
											<a href="//twitter.com/themattaltman" target="_blank" class="ai-font-twitter d-inline-block mx-1 text-decoration-none align-middle"></a>
											<a href="//instagram.com/themattaltman" target="_blank" class="ai-font-instagram d-inline-block mx-1 text-decoration-none align-middle"></a>
											<a href="//www.linkedin.com/in/mattaltman" target="_blank" class="ai-font-linkedin d-inline-block mx-1 text-decoration-none align-middle"></a>
											<a href="#" class="ai-font-envelope-f d-inline-block ml-1 text-decoration-none align-middle"></a>
										</div>
									</div>
								</div>
							</div>
							<!-- END: Column -->
						</div>
						<!-- END: Row -->
						*/ ?>
					</div>
					<!-- END: Social Media Boxes -->
				</div>
			</div>
			<!-- END: Main Container -->
		</div>
		<!-- END: Content -->
		<!-- Clear both --><div class="clearfix"></div>
	</div>


    <section id="fact-counter-section">
        <div class="container">
            <div class="fact-counter">
                <div class="clearfix">
                
                    <!--Column-->
                    <div class="col-md-3 col-sm-6 col-xs-12 column counter-column animated wow fadeIn" data-wow-duration="0ms">
                    	<div class="inner">
                        	<div class="icon-box"><span class="flaticon-trophy"></span></div>
                            <div class="count-outer"><span class="count-text" data-speed="5000" data-stop="570">0</span></div>
                            <h4 class="counter-title">Zákazkov</h4>
                       	</div>
                    </div>
                    
                    <!--Column-->
                    <div class="col-md-3 col-sm-6 col-xs-12 column counter-column animated wow fadeIn" data-wow-duration="0ms">
                    	<div class="inner">
                        	<div class="icon-box"><span class="flaticon-libra"></span></div>
                            <div class="count-outer"><span class="count-text" data-speed="5000" data-stop="48">0</span></div>
                            <h4 class="counter-title">Maklérov</h4>
                       	</div>
                    </div>
                    
                    <!--Column-->
                    <div class="col-md-3 col-sm-6 col-xs-12 column counter-column animated wow fadeIn" data-wow-duration="0ms">
                    	<div class="inner">
                        	<div class="icon-box"><span class="flaticon-boy-broad-smile"></span></div>
                            <div class="count-outer"><span class="count-text" data-speed="5000" data-stop="2310">0</span></div>
                            <h4 class="counter-title">Zákazníkov</h4>
                       	</div>
                    </div>
                    
                    <!--Column-->
                    <div class="col-md-3 col-sm-6 col-xs-12 column counter-column animated wow fadeIn" data-wow-duration="0ms">
                    	<div class="inner">
                        	<div class="icon-box"><span class="flaticon-law-office"></span></div>
                            <div class="count-outer"><span class="count-text" data-speed="5000" data-stop="2500">0</span>+</div>
                            <h4 class="counter-title">Nehnuteľností</h4>
                       	</div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </section>

            
    <!-- BEGIN: Get in Touch -->
	<div id="get-in-touch" class="get-in-touch pb-6">
		<div class="container">

				<!-- BEGIN: Title -->
				<div id="get-in-touch-with-us" class="d-block pt-8 text-center" data-aios-staggered-parent="true" data-aios-animation-offset="0.4" data-aios-animation-reset="false">
					<div class="alt-heading-numerical ml-6 position-relative" data-aios-staggered-child="true" data-aios-animation="fadeIn" data-aios-animation-delay="0s">
						<span class="alt-heading-numberical__number">06</span>
						<span class="alt-heading-numberical__line"></span>
						<?php echo Aoreal::trans('Kontakt'); ?>
					</div>
					<h2 class="title-default mt-4 mx-3 mr-md-0 ml-md-6 mb-4 position-relative" data-aios-staggered-child="true" data-aios-animation="fadeInUp" data-aios-animation-delay="0s"><strong>Kontaktujte</strong> nás</h2>
				</div>
				<!-- END: Title -->
						<!-- BEGIN: Contact Form -->
			<div class="container mt-0 mt-md-6">
				<div class="row">
					<div class="col-md-8 col-md-offset-2" data-aios-staggered-parent="true" data-aios-animation="fadeInUp" data-aios-animation-delay="0s" data-aios-animation-reset="false" data-aios-animation-offset="0.4">
						<div role="form" class="wpcf7" id="wpcf7-f82-o1" lang="en-US" dir="ltr">
<div class="screen-reader-response"></div>
<form action="/#wpcf7-f82-o1" method="post" class="wpcf7-form use-floating-validation-tip" novalidate="novalidate">
<div style="display: none;">
<input type="hidden" name="_wpcf7" value="82" />
<input type="hidden" name="_wpcf7_version" value="5.0.5" />
<input type="hidden" name="_wpcf7_locale" value="en_US" />
<input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f82-o1" />
<input type="hidden" name="_wpcf7_container_post" value="0" />
</div>
<div class="container-fluid">
	<div class="row git-basic-details">
		<div class="col-sm-6 col-md-3 mt-1 mt-0">
			<label for="your-first-name"><?php echo Aoreal::trans('Meno'); ?></label>
			<span class="wpcf7-form-control-wrap your-first-name"><input type="text" name="your-first-name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" id="your-first-name" aria-required="true" aria-invalid="false" /></span>
		</div>
		<div class="col-sm-6 col-md-3 mt-1 mt-0">
			<label for="your-last-name"><?php echo Aoreal::trans('Priezvisko'); ?></label>
			<span class="wpcf7-form-control-wrap your-last-name"><input type="text" name="your-last-name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" id="your-last-name" aria-required="true" aria-invalid="false" /></span>
		</div>
		<div class="col-sm-6 col-md-3 mt-1 mt-0">
			<label for="your-phone"><?php echo Aoreal::trans('Telefónne číslo'); ?></label>
			<span class="wpcf7-form-control-wrap your-phone"><input type="tel" name="your-phone" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel" id="your-phone" aria-required="true" aria-invalid="false" /></span>
		</div>
		<div class="col-sm-6 col-md-3 mt-1 mt-0">
			<label for="your-email"><?php echo Aoreal::trans('E-mailová adresa'); ?></label>
			<span class="wpcf7-form-control-wrap your-email"><input type="email" name="your-email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" id="your-email" aria-required="true" aria-invalid="false" /></span>
		</div>
	</div>
	<div class="row git-message mt-1 mt-md-7">
		<div class="col-md-12">
			<label for="your-message"><?php echo Aoreal::trans('Správa'); ?></label>
			<span class="wpcf7-form-control-wrap your-message"><textarea name="your-message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" id="your-message" aria-invalid="false"></textarea></span>
		</div>
	</div>
	<?php /*
    <div class="row git-captcha mt-7 text-center">
		<div class="col-md-12">
			<div class="custom-captcha"><div class="wpcf7-form-control-wrap"><div data-sitekey="6Lew_2kUAAAAALN0WfHKLUN4NByRWxoRVCQVr8ik" class="wpcf7-form-control g-recaptcha wpcf7-recaptcha d-inline-block"></div>
<noscript>
	<div style="width: 302px; height: 422px;">
		<div style="width: 302px; height: 422px; position: relative;">
			<div style="width: 302px; height: 422px; position: absolute;">
				<iframe src="//www.google.com/recaptcha/api/fallback?k=6Lew_2kUAAAAALN0WfHKLUN4NByRWxoRVCQVr8ik" frameborder="0" scrolling="no" style="width: 302px; height:422px; border-style: none;">
				</iframe>
			</div>
			<div style="width: 300px; height: 60px; border-style: none; bottom: 12px; left: 25px; margin: 0px; padding: 0px; right: 25px; background: #f9f9f9; border: 1px solid #c1c1c1; border-radius: 3px;">
				<textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid #c1c1c1; margin: 10px 25px; padding: 0px; resize: none;">
				</textarea>
			</div>
		</div>
	</div>
</noscript>
</div></div>
			<span class="custom-captcha-robot">I'm Not a Robot</span>
		</div>
	</div>
    */ ?>
	<div class="row git-send mt-5">
		<div class="col-md-12">
            <?= Html::submitButton(Aoreal::trans('Odoslať'), ['class' => 'btn btn-primary d-block mx-auto text-uppercase', 'name' => 'contact-button']) ?>
		</div>
	</div>
</div><div class="wpcf7-response-output wpcf7-display-none"></div></form></div>					</div>
				</div>
			</div>
			<!-- END: Contact Form -->
		</div>
	</div>
		<!-- ENSD: Get in Touch -->

	<!-- END: We're Social -->
    <div class="bottom-index-image">
        <div class="citation">
            <blockquote>Nikdy v živote nezabudnite na tieto tri veci. Že domov nie je miesto, ale pocit. Že čas sa nemeria hodinami, ale okamihmi. A že tlkot srdca sa nedá počuť, ale cítiť a zdieľať.</blockquote>
            <p>Neznámy</p>
        </div>
        <img class="img-responsive" src="/images/img-car1.jpg" alt="">
    </div>
    
	</main>

