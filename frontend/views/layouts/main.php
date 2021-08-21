<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
//use yii\bootstrap\Nav;
//use frontend\assets\Nav;
//use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\models\Aoreal;

AppAsset::register($this);

$aoreal = new Aoreal();

$menuItems = array(
    array('label' => 'O nás', 'url' => '#', 'submenu' => array(
        array('label' => 'Náš tím', 'url' => '/makler-szabo-balazs'),
        array('label' => 'Kariéra', 'url' => '/kariera'),
        array('label' => 'Referencie', 'url' => '/referencie'),
        array('label' => 'Partneri', 'url' => '/partneri'),
        array('label' => 'Media', 'url' => '/media'),
    )),
    
    array('label' => 'Nehnuteľnosti', 'url' => '#', 'submenu' => array(
        array('label' => 'Exkluzívne ponuky', 'url' => '/exkluzivne-ponuky'),
        array('label' => 'Najnovšie ponuky', 'url' => '/najnovsie-ponuky'),
        array('label' => 'Všetky ponuky', 'url' => '/nehnutelnosti'),
        //array('label' => 'Hľadám', 'url' => '/hladam'),
        array('label' => 'PONÚKNITE NÁM!', 'url' => '/ponukam')
    )),

    array('label' => 'Finančné poradenstvo', 'url' => '/financne-poradenstvo',
        'submenu'   => [
                ['label'=>'Finančný dotazník', 'url'=>'/financny-dotaznik']
        ]
    ),
    
    array('label' => 'All-inclusive service', 'url' => '/all-inclusive-service'),

    //array('label' => 'Obchodné podmienky', 'url' => '#', 'submenu' => array()),

    array('label' => 'Kontakt', 'url' => '/kontakt')
);

$footerMenuItems = array(
    array('label' => 'Reklamačný poriadok', 'url' => '/reklamacny-poriadok'),
    array('label' => 'Etický kódex', 'url' => '/eticky-kodex'),
    array('label' => 'GDPR', 'url' => '/ochrana-osobnych-udajov'),
    array('label' => 'Cenník', 'url' => '/cennik'),
)
//print_r(Yii::$app->request->cookies['pref_lang']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/images/favicon/favicon.png">
    <link rel="icon" sizes="57x57" href="/images/favicon/favicon-32x32.png">
    <link rel="icon" sizes="57x57" href="/images/favicon/favicon-57x57.png">
    <link rel="icon" sizes="72x72" href="/images/favicon/favicon-72x72.png">
    <link rel="icon" sizes="76x76" href="/images/favicon/favicon-76x76.png">
    <link rel="icon" sizes="114x114" href="/images/favicon/images/favicon/favicon-114x114.png">
    <link rel="icon" sizes="120x120" href="/images/favicon/favicon-120x120.png">
    <link rel="icon" sizes="144x144" href="/images/favicon/favicon-144x144.png">
    <link rel="icon" sizes="152x152" href="/images/favicon/favicon-152x152.png">
    <meta name="msapplication-TileColor" content="#FFFFFF">	
    <meta name="msapplication-TileImage" content="/images/favicon/favicon-144x144.png">
    <meta name="application-name" content="<?= Html::encode($this->title) ?>">
    <?php
    $this->head();
    ?>
    <link href="//fonts.googleapis.com/css?family=Barlow+Semi+Condensed:300,400,400i,500,600,600i,700,700i|Lato:400,700|Open+Sans:300,300i,400,400i,600,600i|Raleway:300,400,400i,500,700,700i&amp;subset=latin-ext" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Dancing+Script:400,700|Great+Vibes|Oswald:400,600|Raleway:500,700|Roboto+Condensed:400,700&display=swap&subset=latin-ext" rel="stylesheet">
    
    <style type="text/css">
    .ai-contact-wrap input.wpcf7-submit,
    .ai-default-cf7wrap input.wpcf7-submit,
    .ai-default-cf7wrap input.wpcf7-submit,
    .error-forms input.wpcf7-submit {
        background: #444444 !important;
        color: #ffffff !important;
    }

    .ai-contact-wrap input.wpcf7-submit:hover,
    .ai-default-cf7wrap input.wpcf7-submit:hover,
    .error-forms input.wpcf7-submit:hover {
        background: #444444 !important;
        color: #ffffff !important;
    }
    </style>
    <style id='addtoany-inline-css' type='text/css'>
    a.ext-link, a.ext-link:link{
        background-image:none !important;
    }
    .addtoany_header {
        float: left;
    }
    </style>
    
    <!--[if lt IE 9]>
    <script type='text/javascript' src="/js/tambr/placeholders.min.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
    <script type='text/javascript' src="/js/tambr/html5.js"></script>
    <![endif]-->
</head>

<body data-rsssl=1 class="<?php echo (isset($this->params['class_body']) ? $this->params['class_body'] : 'home blog home-container'); ?>">
    <?php $this->beginBody(); ?>
	<div id="main-wrapper">
        <!-- BEGIN: Menu Overlay -->
        <div class="menu-panel position-fixed menu-overlay animated" data-seq-src="/images/menu-panel-bg.jpg">
            <!-- BEGIN: Content -->
            <div class="menu-panel__content">
                <!-- BEGIN: container -->
                <div class="container-fluid">
                    <!-- BEGIN: floating panel -->
                    <div class="menu-panel__floating d-block position-absolute mx-auto w-100 text-right return-no-close">
                        <div class="menu-panel__floating-number d-inline-block align-middle text-white">
                            <a class="mobile-phone" href="tel:<?php echo $aoreal->phone_link; ?>"><?php echo $aoreal->phone; ?></a>
                        </div>
                        <div class="menu-panel__floating-social d-inline-block align-middle ml-3">
                            <?php 
                            if (!empty($aoreal->facebook))
                                echo '<a href="'.$aoreal->facebook.'" target="_blank" class="ai-font-facebook d-inline-block mr-2 text-decoration-none align-middle text-white text-hover-gold"></a>';
                            if (!empty($aoreal->twitter))
                                echo '<a href="'.$aoreal->twitter.'" target="_blank" class="ai-font-twitter d-inline-block mx-2 text-decoration-none align-middle text-white text-hover-gold"></a>';
                            if (!empty($aoreal->instagram))
                                echo '<a href="'.$aoreal->instagram.'" target="_blank" class="ai-font-instagram d-inline-block mx-2 text-decoration-none align-middle text-white text-hover-gold"></a>';
                            if (!empty($aoreal->linkedin))
                                echo '<a href="'.$aoreal->linkedin.'" target="_blank" class="ai-font-linkedin d-inline-block mx-2 text-decoration-none align-middle text-white text-hover-gold"></a>';
                            if (!empty($aoreal->email))
                                echo '<a href="mailto:'.$aoreal->encode_email($aoreal->email).'" class="ai-font-envelope-f d-inline-block ml-2 text-decoration-none align-middle text-white text-hover-gold"></a>';
                            ?>
                        </div>
                    </div>
                    <!-- END: floating panel -->
                    <!-- BEGIN: left panel -->
                    <div class="menu-panel__left d-inline-block position-absolute">
                        <div class="menu-panel__close d-inline-block position-absolute alt-icon-close text-white cursor-pointer"></div>
                        <div class="menu-panel__logo d-inline-block position-absolute">
                            <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['/']); ?>" class=" alt-icon-logo-mono text-white text-hover-gold text-decoration-none"></a>
                        </div>
                    </div>
                    <!-- END: left panel -->
                    <!-- BEGIN: right panel -->
                    
                    <div class="menu-panel__right d-inline-block align-middle w-100 position-absolute pr-3 pr-md-10 text-center">
                        <div class="menu-popup-menu-container return-no-close">
                            <?php echo $aoreal->getMainMenu($menuItems, 'menu-panel'); ?>
                        </div>
                    </div><!-- END: right panel -->
                </div><!-- END: container -->
            </div><!-- END: Content -->
        </div><!-- END: Menu Overlay -->
        <header class="header w-100 position-absolute py-3 py-md-6 ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-9 col-md-3 header__logo float-md-none d-md-inline-block align-middle">
                        <!--					<a href="<?//=esc_url( home_url() )?>" class="header__logo--link altman-font d-inline-block position-relative"><span class="hide"><?php echo $aoreal->company_name; ?></span></a>-->
                        <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['/']); ?>"><img src="/images/logo-web-aoreal_white.png" class="img-responsive" /></a>
                    </div>
                    <div class="col-md-6 header__nav float-md-none d-none d-lg-inline-block align-middle" >
                        <nav class="text-center">
                            <div class="menu-inner-pages-main-menu-container">
                                <?php echo $aoreal->getMainMenu($menuItems, 'navigation'); ?>
                            </div>
                        </nav>
                    </div>
                    <div class="header__details float-md-none d-none align-middle text-right">
                        <div class="header__details--number d-inline-block align-middle text-white">
                            <a class="mobile-phone" href="tel:<?php echo $aoreal->phone_link; ?>"><?php echo str_replace('+421 ','+421<span class="clear"></span>',$aoreal->phone); ?></a>
                        </div>
                        <div class="header__details--social d-inline-block align-middle ml-3">
                            <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['/kontakt']); ?>" class="ai-font-envelope-f d-inline-block text-decoration-none align-middle text-white text-hover-gold"></a>
                        </div>
                    </div>
                    <div class="col-xs-3 col-md-3 header__menu float-md-none d-md-inline-block align-middle text-right">
                        <div class="de-logo">
                            <a href="#" target="_blank">
                                <img src="/images/logo-clen-realitnej-unie.png" class="header-normal" />
                                <img src="/images/logo-clen-realitnej-unie.png" class="header-fixed" />
                            </a>
                        </div>
                        <div class="menu-panel__button d-inline-block position-relative raleway text-uppercase text-white">
                            <span class="d-inline-block position-absolute"></span> Menu
                        </div>
                    </div>
                </div>
                <div class="row visible-onscroll">
                    <div class="col-lg-12">
                        <ul class="exclusive-menu">
                            <li>
                                <button class="btn btn-outline btn-estate-buy" type="button" data-filter-type="buy"><?php echo Aoreal::trans('Hľadám'); ?></button>
                            </li>
                            <li>
                                <button class="btn btn-primary btn-estate-offer" type="button" data-filter-type="offer"><a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['/ponukam']); ?>"><?php echo Aoreal::trans('Ponúkam'); ?></a></button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        
        <?= $content ?>
		
		<!-- BEGIN: Footer -->
		<footer class="footer d-block position-relative text-center text-md-left">
			<!-- BEGIN: Overlay -->
			<div class="footer__overlay position-absolute d-inline-block alt-icon-logo-mono text-white"></div>
			<!-- END: Overlay -->
			<!-- BEGIN: Content -->
			<div class="container footer__details position-relative">
				<!-- BEGIN: Line Accent -->
				<div class="footer__line-accent-left d-inline-block position-absolute" data-aios-reveal="true" data-aios-animation="fadeIn" data-aios-animation-delay="0s" data-aios-animation-reset="false" data-aios-animation-offset="0.4"></div>
				<div class="footer__line-accent-right d-inline-block position-absolute" data-aios-reveal="true" data-aios-animation="fadeIn" data-aios-animation-delay="0s" data-aios-animation-reset="false" data-aios-animation-offset="0.2"></div>
				<!-- END: Line Accent -->
				<!-- BEGIN: row -->
				<div class="row py-3 py-md-6 d-none d-md-block">
					<!-- BEGIN: column -->
					<div class="col-md-12 text-right" data-aios-reveal="true" data-aios-animation="fadeIn" data-aios-animation-delay="0.2s" data-aios-animation-reset="false" data-aios-animation-offset="0.65">
						<a href="" class="back-to-top d-inline-block position-relative py-2 px-3 raleway text-center text-uppercase">
							<span class="back-to-top__text d-inline-block position-relative"><?php echo Aoreal::trans('Späť na začiatok'); ?> <em class="ai-font-arrow-b-u d-inline-block text-white"></em></span>
						</a>
					</div>
					<!-- END: column -->
				</div>
				<!-- END: row -->
				<!-- BEGIN: row -->
				<div class="row pt-5">
					<!-- BEGIN: column -->
					<div class="col-md-5 footer__logo text-right" data-aios-reveal="true" data-aios-animation="fadeInUp" data-aios-animation-delay="0s" data-aios-animation-reset="false" data-aios-animation-offset="0.2">
<!--
						<a href="" class="footer__logo--altman altman-font d-inline-block position-relative my-0 my-md-8 mr-md-5 text-decoration-none">
							<span class="hide"><?php echo $aoreal->company_name; ?></span>
						</a>
-->
                        <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['/']); ?>"><img class="img-responsive" src="/images/logo-web-aoreal_white.png" /><span class="hide"><?php echo $aoreal->company_name; ?></span></a>
						<div class="d-block hidden-md hidden-lg"></div>
                        <div class="block-facebook">
                            <!--FB Page plugin START -->
                            <div id="fb-root"></div>
                            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/sk_SK/sdk.js#xfbml=1&version=v3.2&appId=320438301889552&autoLogAppEvents=1"></script>
                            <div class="fb-page" data-href="https://www.facebook.com/Aoreal-335956663895256/" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Aoreal-335956663895256/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Aoreal-335956663895256/">Aoreal</a></blockquote></div>
                            <!--FB Page plugin END -->
                        </div>
					</div>
					<!-- END: column -->
					<!-- BEGIN: column -->
					<div class="col-md-4 footer__list mt-5 mt-md-0" data-aios-reveal="true" data-aios-animation="fadeInUp" data-aios-animation-delay="0.1s" data-aios-animation-reset="false" data-aios-animation-offset="0.2">
						<h3><strong>SPROSTREDKOVANIE NEHNUTEĽNOSTÍ</strong> <br>Vybavovanie od začiatku až do konca</h3>

						<ul class="footer__list--menu text-uppercase row">
							<li class="col-md-12 col-lg-6">Nehnuteľnosti</li>
                            <li class="col-md-12 col-lg-6">Hypo-úvery</li>
                            <li class="col-md-12 col-lg-6">Sprostredkovanie</li>
                            <li class="col-md-12 col-lg-6">Poradenstvo</li>
						</ul>
						<ul class="footer__list--communities d-block">
                            <li>
								<a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['/exkluzivne-ponuky']); ?>">Exkluzívne ponuky</a>
							</li>
                            <li>
								<a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['/najnovsie-ponuky']); ?>">Najnovšie ponuky</a>
							</li>
                            <li>
								<a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['/nehnutelnosti']); ?>">Všetky ponuky</a>
							</li>
                            <?php
                            foreach ($footerMenuItems as $footerMenuItem)
                                echo '
                                <li>
								    <a href="'.Yii::$app->urlManager->createAbsoluteUrl([$footerMenuItem['url']]).'">'.$footerMenuItem['label'].'</a>
                                </li>';
                            ?>
						</ul>
					</div>
					<!-- END: column -->
					<!-- BEGIN: column -->
					<div class="col-md-3 footer__secondary pt-4 pt-md-0" data-aios-reveal="true" data-aios-animation="fadeInUp" data-aios-animation-delay="0.2s" data-aios-animation-reset="false" data-aios-animation-offset="0.2">
                        <a class="qrcode" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['/kontakt']); ?>"><img src="/images/qrcode-aoreal.png" class="img-responsive" alt="<?php echo $aoreal->company_name; ?>"></a>
                    </div>
					<!-- END: column -->
				</div>
				<!-- END: row -->
			</div>
			<!-- END: Content -->
			<!-- BEGIN: Copyright -->
			<div class="footer_copyright container position-relative py-6 text-white">
				<div class="row">
					<div class="col-md-5 text-left">
						Webstránku vytvorila firma <a href="<?php echo $aoreal->copyright['url']; ?>" target="_blank" class="text-white text-hover-gold text-decoration-none"><strong><?php echo $aoreal->copyright['name']; ?></strong></a>
					</div>
					<div class="col-md-7 text-right">&copy; <?php echo (date('Y') > 2019 ? '2019-'.date('Y') : '2019').' '.$aoreal->company_name; ?> | Všetky práva vyhradené.</div>
				</div>
			</div>
			<!-- END: Copyright -->
			<!-- BEGIN: Mobile Back to Top -->
			<div class="container">
				<!-- BEGIN: row -->
				<div class="row py-3 py-md-6 d-block d-md-none">
					<!-- BEGIN: column -->
					<div class="col-md-12 text-right">
						<a href="" class="back-to-top d-inline-block position-relative py-2 px-3 raleway text-center text-uppercase">
							<span class="back-to-top__text d-inline-block position-relative">Späť na začiatok <em class="ai-font-arrow-b-u d-inline-block text-white"></em></span>
						</a>
					</div>
					<!-- END: column -->
				</div>
				<!-- END: row -->
			</div>
			<!-- END: Mobile Back to Top -->
		</footer>
		<!-- END: Footer -->
	</div><!-- end of #main-wrapper -->

<div class="sidebars-left">
    <button class="btn-search" title="<?php echo Aoreal::trans('Vyhľadávanie'); ?>" data-filter-type="none">
        <i class="fa fa-search"></i>
        <span><?php echo Aoreal::trans('Vyhľadávanie'); ?></span>
    </button>
    <div class="filter-block position-fixed animated" style="display: none;">
        <div class="filter-panel__left d-inline-block align-middle w-100 position-absolute pr-3 pr-md-10 text-center">
            <div class="filter-popup-container animated fadeInLeft" style="display: none;">
            <?php
            if (!isset($this->params['class_body']) || (isset($this->params['class_body']) && $this->params['class_body'] != 'property-details'))
            {
                echo Aoreal::htmlSearchBlock();
            }
            ?>
            </div>
            <div class="citation">
                <blockquote>Találd meg az otthonodat (...). Lehet, hogy nem a múltban találod meg, de találd meg, és akkor soha többé nem leszel elveszett.</blockquote>
                <p>Pierce Brown</p>
            </div>
        </div>
        <div class="filter-panel__right d-inline-block position-absolute">
            <div class="filter-panel__close d-inline-block position-absolute alt-icon-close text-white cursor-pointer"></div>
            <div class="filter-panel__logo d-inline-block position-absolute">
                <a href="https://www.aoreal.sk/" class=" alt-icon-logo-mono text-white text-hover-gold text-decoration-none"></a>
            </div>
        </div>
    </div>
</div>

<!-- Start of sidebar markup code -->
<div class="super-sidebar">
    <ul class="sb-bar">
        <li class="sb-sub sb-social">
            <div class="sb-icon fa fa-share-alt"></div>
            <ul>
                <li class="sb-facebook">
                    <a data-share="facebook">
                        <div class="sb-icon fa fa-facebook"></div>
                        <div class="sb-label"><?php echo Aoreal::trans('Zdieľať na Facebooku'); ?></div>
                    </a>
                </li>
                <li class="sb-twitter">
                    <a data-share="twitter">
                        <div class="sb-icon fa fa-twitter"></div>
                        <div class="sb-label"><?php echo Aoreal::trans('Zdieľať na Twittere'); ?></div>
                    </a>
                </li>
                <li class="sb-google-plus">
                    <a data-share="google-plus">
                        <div class="sb-icon fa fa-google-plus"></div>
                        <div class="sb-label"><?php echo Aoreal::trans('Zdieľať na Google+'); ?></div>
                    </a>
                </li>
                <li class="sb-linkedin">
                    <a data-share="linkedin">
                        <div class="sb-icon fa fa-linkedin"></div>
                        <div class="sb-label"><?php echo Aoreal::trans('Zdieľať na LinkedIn'); ?></div>
                    </a>
                </li>
                <li class="sb-pinterest">
                    <a data-share="pinterest">
                        <div class="sb-icon fa fa-pinterest"></div>
                        <div class="sb-label"><?php echo Aoreal::trans('Zdieľať na Pinterest'); ?></div>
                    </a>
                </li><?php /*
                <li class="sb-reddit">
                    <a data-share="reddit">
                        <div class="sb-icon fa fa-reddit"></div>
                        <div class="sb-label"><?php echo Aoreal::trans('Zdieľať na Reddit'); ?></div>
                    </a>
                </li>
                <li class="sb-tumblr">
                    <a data-share="tumblr">
                        <div class="sb-icon fa fa-tumblr"></div>
                        <div class="sb-label"><?php echo Aoreal::trans('Zdieľať na Tumblr'); ?></div>
                    </a>
                </li>*/ ?>
            </ul>
        </li>
		<li class="sb-sub sb-info visible-xs">
			<div class="sb-icon fa fa-info"></div>
			<ul>
				<li class="sb-about sb-space">
					<a href="#sidebar-about" target="_self">
						<div class="sb-icon fa fa-id-card"></div>
						<div class="sb-label"><?php echo Aoreal::trans('O nás'); ?></div>
					</a>
				</li>
				<li class="sb-contact">
					<a href="#sidebar-contact" target="_self">
						<div class="sb-icon fa fa-envelope"></div>
						<div class="sb-label"><?php echo Aoreal::trans('Kontaktujte nás'); ?></div>
					</a>
				</li>
				<li class="sb-newsletter">
					<a href="#sidebar-newsletter" target="_self">
						<div class="sb-icon fa fa-newspaper-o"></div>
						<div class="sb-label"><?php echo Aoreal::trans('Odber noviniek'); ?></div>
					</a>
				</li>
				<?php if ($aoreal->facebook) { ?>
				<li class="sb-facebook sb-space">
					<a href="<?php echo $aoreal->facebook; ?>" target="_blank">
						<div class="sb-icon fa fa-facebook"></div>
						<div class="sb-label"><?php echo Aoreal::trans('Facebook'); ?></div>
					</a>
				</li>
				<?php } ?>
				<?php if ($aoreal->instagram) { ?>
				<li class="sb-instagram">
					<a href="<?php echo $aoreal->instagram; ?>" target="_blank">
						<div class="sb-icon fa fa-instagram"></div>
						<div class="sb-label"><?php echo Aoreal::trans('Instagram'); ?></div>
					</a>
				</li>
				<?php } ?>
				<?php if ($aoreal->linkedin) { ?>
				<li class="sb-linkedin">
					<a href="<?php echo $aoreal->linkedin; ?>" target="_blank">
						<div class="sb-icon fa fa-linkedin"></div>
						<div class="sb-label"><?php echo Aoreal::trans('LinkedIn'); ?></div>
					</a>
				</li>
				<?php } ?>
				<?php if ($aoreal->twitter) { ?>
				<li class="sb-linkedin">
					<a href="<?php echo $aoreal->twitter; ?>" target="_blank">
						<div class="sb-icon fa fa-twitter"></div>
						<div class="sb-label"><?php echo Aoreal::trans('Twitter'); ?></div>
					</a>
				</li>
				<?php } ?>
			</ul>
		</li>

        <li class="sb-about sb-space hidden-xs">
            <a href="#sidebar-about" target="_self">
                <div class="sb-icon fa fa-id-card"></div>
                <div class="sb-label"><?php echo Aoreal::trans('O nás'); ?></div>
            </a>
        </li>
        <li class="sb-contact hidden-xs">
            <a href="#sidebar-contact" target="_self">
                <div class="sb-icon fa fa-envelope"></div>
                <div class="sb-label"><?php echo Aoreal::trans('Kontaktujte nás'); ?></div>
            </a>
        </li>
        <li class="sb-newsletter hidden-xs">
            <a href="#sidebar-newsletter" target="_self">
                <div class="sb-icon fa fa-newspaper-o"></div>
                <div class="sb-label"><?php echo Aoreal::trans('Odber noviniek'); ?></div>
            </a>
        </li>
        <?php if ($aoreal->facebook) { ?>
        <li class="sb-facebook sb-space hidden-xs">
            <a href="<?php echo $aoreal->facebook; ?>" target="_blank">
                <div class="sb-icon fa fa-facebook"></div>
                <div class="sb-label"><?php echo Aoreal::trans('Facebook'); ?></div>
            </a>
        </li>
        <?php } ?>
        <?php if ($aoreal->instagram) { ?>
        <li class="sb-instagram hidden-xs">
            <a href="<?php echo $aoreal->instagram; ?>" target="_blank">
                <div class="sb-icon fa fa-instagram"></div>
                <div class="sb-label"><?php echo Aoreal::trans('Instagram'); ?></div>
            </a>
        </li>
        <?php } ?>
        <?php if ($aoreal->linkedin) { ?>
        <li class="sb-linkedin hidden-xs">
            <a href="<?php echo $aoreal->linkedin; ?>" target="_blank">
                <div class="sb-icon fa fa-linkedin"></div>
                <div class="sb-label"><?php echo Aoreal::trans('LinkedIn'); ?></div>
            </a>
        </li>
        <?php } ?>
        <?php if ($aoreal->twitter) { ?>
        <li class="sb-linkedin hidden-xs">
            <a href="<?php echo $aoreal->twitter; ?>" target="_blank">
                <div class="sb-icon fa fa-twitter"></div>
                <div class="sb-label"><?php echo Aoreal::trans('Twitter'); ?></div>
            </a>
        </li>
        <?php } ?>
    </ul>
    <div class="sb-window">
        <div class="sb-shadow"></div>

        <div id="sidebar-about" class="sb-panel">
            <div class="sb-head">
                <div class="sb-title"><?php echo Aoreal::trans('Pár slov o nás'); ?></div>
                <div class="sb-close"></div>
            </div>
            <div class="sb-body">
                <div class="sb-clearfix">
                    <div class="sb-about-logo">
                        <img src="/images/logo-web-aoreal_brown_small.png" alt="<?php echo $aoreal->company_name; ?>" class="img-responsive">
                    </div>
                    <div class="sb-about-desc">
                        <p>ALPHA-OMEGA REAL & CONSULTING  S.R.O. VZNIKLA S CIEĽOM POSKYTOVAŤ KOMPLEXNÉ SLUŽBY NA TRHU S NEHNUTEĽNOSŤAMI A KVALITNÉ FINANČNÉ PORADENSTVO PRE VŠETKÝCH SVOJICH KLIENTOV.</p>
                        <p><i>„Inovácie nezávisia od množstva peňazí, ktoré máte vo vývoji a výskume. Keď Apple prišiel s počítačom Mac, firma IBM mala stokrát viac peňazí, ale v tých to nie je. Inovácie sú o vašich ľuďoch, ako ich vediete a nakoľko vidíte do problému.“ —  Steve Jobs, americký podnikateľ a spoluzakladateľ spoločnosti Apple Inc. 1955 - 2011 O ľuďoch, O problémoch</i></p>
                    </div>
                </div>
                <div class="sb-sep"></div>
                <table class="sb-about-info">
                    <tbody>
                        <tr>
                            <td><label><?php echo Aoreal::trans('Telefón'); ?>:</label></td>
                            <td><?php echo $aoreal->phone; ?></td>
                        </tr>
                        <tr>
                            <td><label><?php echo Aoreal::trans('E-mail'); ?>:</label></td>
                            <td><?php echo $aoreal->email; ?></td>
                        </tr>
                        <tr>
                            <td><label><?php echo Aoreal::trans('Adresa'); ?>:</label></td>
                            <td><?php echo $aoreal->address.'<br>'.$aoreal->postcode.' '.$aoreal->city; ?></td>
                        </tr>
                        <?php /*if ($aoreal->facebook) { ?>
                        <tr>
                            <td><label><?php echo Aoreal::trans('Facebook'); ?>:</label></td>
                            <td><?php echo '<a href="'.$aoreal->facebook.'" target="_blank" class="icon-facebook"></a>'; ?></td>
                        </tr>
                        <?php }*/ ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="sidebar-contact" class="sb-panel">
            <div class="sb-head">
                <div class="sb-title"><?php echo Aoreal::trans('KONTAKTUJTE NÁS'); ?></div>
                <div class="sb-close"></div>
            </div>
            <div class="sb-body">
                <p><i>Máte otázky alebo nejaký nápad? Použite nižšie uvedený formulár a my sa Vám ozveme.</i></p>
                <form class="sb-form" action="super-sidebar/php/contact.php" data-id="contact">
                    <label><?php echo Aoreal::trans('Celé meno'); ?>:</label>
                    <input type="text" name="name" required>
                    <label><?php echo Aoreal::trans('E-mailová adresa'); ?>:</label>
                    <input type="text" name="email" required>
                    <label><?php echo Aoreal::trans('Správa'); ?>:</label>
                    <textarea name="message" required></textarea>
                    <div class="contactform_allowpt">
                        <label for="contactform_allowpt"><input type="checkbox" id="contactform_allowpt" required> 
                        <?php echo Aoreal::trans('Súhlasím so správou, spracovaním a uchovaním mojich osobných údajov.'); ?></label>
                    </div>
                    <div class="sb-submit"><?php echo Aoreal::trans('Odosielať'); ?></div>
                    <div class="sb-status"></div>
                </form>
            </div>
        </div>

        <div id="sidebar-newsletter" class="sb-panel">
            <div class="sb-head">
                <div class="sb-title"><?php echo Aoreal::trans('ODBER NOVINIEK'); ?></div>
                <div class="sb-close"></div>
            </div>
            <div class="sb-body">
                <p><i><?php echo Aoreal::trans('Prihláste sa k odberu noviniek, ak chcete byť e-mailom vždy informovaný o výhodných ponukách. Pre zrušenie kontaktujte nás.'); ?></i></p>
                <form class="sb-form" action="super-sidebar/php/newsletter.php" data-id="newsletter">
                    <div class="sb-form-group">
                        <div><label><?php echo Aoreal::trans('Váš e-mail'); ?>:</label></div>
                        <div><input type="text" name="email" required></div>
                        <div><div class="sb-submit"><?php echo Aoreal::trans('Prihlásiť'); ?></div></div>
                    </div>
                    <div class="sb-form-group">
                        <div class="newsletter_allowpt">
                            <label for="newsletter_allowpt"><input type="checkbox" id="newsletter_allowpt" required> 
                            <?php echo Aoreal::trans('Súhlasím so správou, spracovaním a uchovaním mojich osobných údajov.'); ?></label>
                        </div>
                    </div>
                    <div class="sb-status"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of sidebar markup code -->

<script type="text/javascript">
var recaptchaWidgets = [];
var recaptchaCallback = function() {
	var forms = document.getElementsByTagName( 'form' );
	var pattern = /(^|\s)g-recaptcha(\s|$)/;

	for ( var i = 0; i < forms.length; i++ ) {
		var divs = forms[ i ].getElementsByTagName( 'div' );

		for ( var j = 0; j < divs.length; j++ ) {
			var sitekey = divs[ j ].getAttribute( 'data-sitekey' );

			if ( divs[ j ].className && divs[ j ].className.match( pattern ) && sitekey ) {
				var params = {
					'sitekey': sitekey,
					'type': divs[ j ].getAttribute( 'data-type' ),
					'size': divs[ j ].getAttribute( 'data-size' ),
					'theme': divs[ j ].getAttribute( 'data-theme' ),
					'badge': divs[ j ].getAttribute( 'data-badge' ),
					'tabindex': divs[ j ].getAttribute( 'data-tabindex' )
				};

				var callback = divs[ j ].getAttribute( 'data-callback' );

				if ( callback && 'function' == typeof window[ callback ] ) {
					params[ 'callback' ] = window[ callback ];
				}

				var expired_callback = divs[ j ].getAttribute( 'data-expired-callback' );

				if ( expired_callback && 'function' == typeof window[ expired_callback ] ) {
					params[ 'expired-callback' ] = window[ expired_callback ];
				}

				var widget_id = grecaptcha.render( divs[ j ], params );
				recaptchaWidgets.push( widget_id );
				break;
			}
		}
	}
};

document.addEventListener( 'wpcf7submit', function( event ) {
	switch ( event.detail.status ) {
		case 'spam':
		case 'mail_sent':
		case 'mail_failed':
			for ( var i = 0; i < recaptchaWidgets.length; i++ ) {
				grecaptcha.reset( recaptchaWidgets[ i ] );
			}
	}
}, false );

jQuery(document).ready(function(jQuery){
    jQuery.datepicker.setDefaults({
        "closeText":"Close",
        "currentText":"Today",
        "monthNames":["January","February","March","April","May","June","July","August","September","October","November","December"],
        "monthNamesShort":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
        "nextText":"Next",
        "prevText":"Previous",
        "dayNames":["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
        "dayNamesShort":["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],
        "dayNamesMin":["S","M","T","W","T","F","S"],
        "dateFormat":"MM d, yy",
        "firstDay":1,
        "isRTL":false
    });
});
</script>
<!-- Start of sidebar build code -->
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery(".super-sidebar").superSidebar({
            // Main
            position: ["right", "center"],
            offset: [0, 0],
            buttonShape: "square",
            buttonColor: "white",
            buttonOverColor: "custom",
            iconColor: "custom",
            iconOverColor: "white",
            labelColor: "match",
            labelTextColor: "match",
            labelEffect: "slide-out-fade",
            labelAnimate: [400, "easeOutQuad"],
            labelConnected: false,
            labelsOn: true,
            sideSpace: false,
            buttonSpace: true,
            labelSpace: false,
            // Subbar
            subPosition: ($(window).width() <= 767 ? ["circular",100,-90,90] : "side"),
            subEffect: "slide",
            subAnimate: [400, "easeOutQuad"],
            subSpace: true,
            subOpen: "mouseover",
            // Window
            windowPosition: ["center", "18%"],
            windowOffset: [0, 0],
            windowCorners: "match",
            windowColor: "match",
            windowShadow: true,
            // Other
            showAfterPosition: false,
            barAnimate: [250, "easeOutQuad"],
            hideUnderWidth: false,
            shareTarget: "default",
            // Forms
            formData: {
                "contact": {
                    status: {
                        empty: "<?php echo Aoreal::trans('Vyplňte prosím všetky povinné polia.'); ?>",
                        badEmail: "<?php echo Aoreal::trans('Formát e-mailu je nesprávny.'); ?>",
                        working: "<?php echo Aoreal::trans('Posiela sa správa, čakajte prosím ...'); ?>",
                        success: "<?php echo Aoreal::trans('Správa bola úspešne odoslaná!'); ?>",
                        error: "<?php echo Aoreal::trans('Vyskytla sa chyba! Správa nebola odoslaná.'); ?>"
                    }
                },
                "newsletter": {
                    status: {
                        empty: "<?php echo Aoreal::trans('Zadajte prosím Vašu e-mailovú adresu.'); ?>",
                        badEmail: "<?php echo Aoreal::trans('Formát e-mailu je nesprávny.'); ?>",
                        working: "<?php echo Aoreal::trans('Prebieha registrácia, čakajte prosím ...'); ?>",
                        success: "<?php echo Aoreal::trans('Vaša registrácia bola úspešná!'); ?>",
                        error: "<?php echo Aoreal::trans('Vyskytla sa chyba! Prosím skúste to znova.'); ?>",
                        consent: "<?php echo Aoreal::trans('Musíte súhlasiť so spracovaním a uchovávaním Vašich osobných údajov!'); ?>"
                    }
                }
            }
        });

    });
</script>
<!-- End of sidebar build code -->

<?php /*    
<div class="wrap">
    
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
*/ ?>
<?php
/*
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
*/ ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
