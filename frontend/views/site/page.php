<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use frontend\models\Aoreal;

//$this->title = 'Cenník';
//$this->params['breadcrumbs'][] = $this->title;

$aoreal = new Aoreal();
$page_view = Yii::$app->request->get('view');
$page_file = dirname(__FILE__).'/../../pages/sk/'.$page_view.'.php';

switch ($page_view)
{
    case 'cennik':
    case 'reklamacny-poriadok':
    case 'ochrana-osobnych-udajov':
    case 'referencie':
        $page_layout = 'layout-simple';
        $canvas_class = 'anim-top';
        $canvas_banner = 'financne-poradenstvo-banner-3.jpg';
        $bottom_image = '';
    break;
    default:
        if (file_exists($page_file))
            include($page_file);        
}
if (!file_exists($page_file) || ($page_layout != 'layout-simple' && (!isset($section1_text) && !isset($section2_text) && !isset($section3_text) && !isset($section4_text) && !isset($section5_text))))
{
    $page_not_found = true;
    $canvas_class = 'anim-top';
    $canvas_banner = 'financne-poradenstvo-banner-3.jpg';
    $bottom_image = '';
}
?>
<main class="site-page <?php echo $page_layout; ?> view-<?php echo $page_view.(!$bottom_image || empty($bottom_image) ? ' no-bottom-image' : ''); ?> clearfix">
    <div class="page-banner d-block position-relative raleway">
        <canvas<?php echo (!empty($canvas_class) ? ' class="'.$canvas_class.'"' : ''); ?> style="background-image:url(/images/<?php echo $canvas_banner; ?>);" width="1600" height="400"></canvas>
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

    <?php       
    if ($page_not_found === true)
    {
        echo '
        <section class="section-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="alert alert-info">'.Aoreal::trans('Ľutujeme, ale táto stránka je momentálne vo výstavbe.').'</p>
                    </div>
                </div>
            </div>
        </section>';
    }
    elseif($page_layout == 'layout-simple')
    {
        echo '
        <section class="section-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">';
        include($page_file);
        echo '
                    </div>
                </div>
            </div>
        </section>';
    }
    else
    {
        if ($section1_text && !empty($section1_text))
        {
        ?>
        <section id="section-one-about" data-aios-staggered-parent="true" data-aios-animation-offset="0" data-aios-animation-reset="true">
            <div class="section_two_overlay--top bg_color--blue"<?php echo ($section1_overlay && !empty($section1_overlay) ? ' style="background-image:url(/images/overlays/'.$section1_overlay.')"' : ''); ?>></div>
            <div class="alt-icon"><span class="alt-icon-logo-mono-large"></span></div>
            <div class="sec-one-about-content">
                <?php
                if ($section1_title && !empty($section1_title))
                    echo '<h2 class="text-transform-normal" data-aios-staggered-child="true" data-aios-animation="fadeInDown" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">'.$section1_title.'</h2>';
                
                echo '<div data-aios-staggered-child="true" data-aios-animation="fadeInUp" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">'.$section1_text.'</div>';

                if ($section1_quote && !empty($section1_quote))
                    echo '<div class="citation">'.$section1_quote.'</div>';
                ?>
            </div>
            <div class="about-section-img" data-aios-staggered-child="true" data-aios-animation="fadeInUp" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">
                <?php
                if ($section1_image && !empty($section1_image))
                    echo '<img src="/images/'.$section1_image.'" alt="" width="'.($section1_image_width && !empty($section1_image_width) ? $section1_image_width.'px' : '').'">';
                ?>
            </div>
            <div class="clear"></div>			
        </section>
        <?php
        }

        if ($section2_text && !empty($section2_text)) {
        ?>
        <section id="section-two-about" data-aios-staggered-parent="true" data-aios-animation-offset="0.5" data-aios-animation-reset="true">
            <div class="section_two_overlay--bottom bg_color--gold"<?php echo ($section2_overlay && !empty($section2_overlay) ? ' style="background-image:url(/images/overlays/'.$section2_overlay.')"' : ''); ?>></div>
            <div class="about-section-img" data-aios-staggered-child="true" data-aios-animation="fadeInLeft" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">
                <?php
                if ($section2_image && !empty($section2_image))
                    echo '<img src="/images/'.$section2_image.'" alt="" width="'.($section2_image_width && !empty($section2_image_width) ? $section2_image_width.'px' : '').'">';
                ?>
            </div>
            <div class="sec-two-about-content">
                <?php
                if ($section2_title && !empty($section2_title))
                    echo '<h2 data-aios-staggered-child="true" data-aios-animation="fadeInDown" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">'.$section2_title.'</h2>';

                echo '<div data-aios-staggered-child="true" data-aios-animation="fadeInUp" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">'.$section2_text.'</div>';

                if ($section2_quote && !empty($section2_quote))
                    echo '<div class="citation">'.$section2_quote.'</div>';
                ?>
            </div>
            <div class="clear"></div>
        </section>
        <?php
        }

        if ($section3_text && !empty($section3_text)) {
        ?>
        <section id="section-four-about"  data-aios-staggered-parent="true" data-aios-animation-offset="0.5" data-aios-animation-reset="true"> 
            <div class="section_four_overlay--top bg_color--gold"></div>
            <div class="section_four_overlay--bottom bg_color--blue"<?php echo ($section3_overlay && !empty($section3_overlay) ? ' style="background-image:url(/images/overlays/'.$section3_overlay.')"' : ''); ?>></div>
            <div class="alt-icon"><span class="alt-icon-logo-mono-large"></span></div>
            <div class="sec-four-about-content">
                <?php
                if ($section3_text && !empty($section3_text))
                    echo '<h2  data-aios-staggered-child="true" data-aios-animation="fadeInUp" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">'.$section3_title.'</h2>';

                echo '<div data-aios-staggered-child="true" data-aios-animation="fadeInDown" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">'.$section3_text.'</div>';

                if ($section3_quote && !empty($section3_quote))
                    echo '<div class="citation">'.$section3_quote.'</div>';
                ?>
            </div>
            <div class="about-section-img" data-aios-staggered-child="true" data-aios-animation="fadeInRight" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">
                <?php
                if ($section3_image && !empty($section3_image))
                    echo '<img src="/images/'.$section3_image.'" alt="" width="'.($section3_image_width && !empty($section3_image_width) ? $section3_image_width.'px' : '').'">';
                ?>
            </div>
            <div class="clear"></div>
        </section>
        <?php
        }

        if ($section4_text && !empty($section4_text)) {
        ?>
        <section id="section-two-about" data-aios-staggered-parent="true" data-aios-animation-offset="0.5" data-aios-animation-reset="true">
            <div class="section_two_overlay--bottom bg_color--gold"<?php echo ($section4_overlay && !empty($section4_overlay) ? ' style="background-image:url(/images/overlays/'.$section4_overlay.')"' : ''); ?>></div>
            <div class="about-section-img" data-aios-staggered-child="true" data-aios-animation="fadeInLeft" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">
                <?php
                if ($section4_image && !empty($section4_image))
                    echo '<img src="/images/'.$section4_image.'" alt="" width="'.($section4_image_width && !empty($section4_image_width) ? $section4_image_width.'px' : '').'">';
                ?>
            </div>
            <div class="sec-two-about-content">
                <?php
                if ($section4_title && !empty($section4_title))
                    echo '<h2 data-aios-staggered-child="true" data-aios-animation="fadeInDown" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">'.$section4_title.'</h2>';

                echo '<div data-aios-staggered-child="true" data-aios-animation="fadeInUp" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">'.$section4_text.'</div>';

                if ($section4_quote && !empty($section4_quote))
                    echo '<div class="citation">'.$section4_quote.'</div>';
                ?>
            </div>
            <div class="clear"></div>
        </section>
        <?php
        }

        if ($section5_text && !empty($section5_text)) {
        ?>
        <section id="section-four-about"  data-aios-staggered-parent="true" data-aios-animation-offset="0.5" data-aios-animation-reset="true"> 
            <div class="section_four_overlay--top bg_color--gold"></div>
            <div class="section_four_overlay--bottom bg_color--blue"<?php echo ($section5_overlay && !empty($section5_overlay) ? ' style="background-image:url(/images/overlays/'.$section5_overlay.')"' : ''); ?>></div>
            <div class="alt-icon"><span class="alt-icon-logo-mono-large"></span></div>
            <div class="sec-four-about-content">
                <?php
                if ($section5_text && !empty($section5_text))
                    echo '<h2  data-aios-staggered-child="true" data-aios-animation="fadeInUp" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">'.$section5_title.'</h2>';

                echo '<div data-aios-staggered-child="true" data-aios-animation="fadeInDown" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">'.$section5_text.'</div>';

                if ($section5_quote && !empty($section5_quote))
                    echo '<div class="citation">'.$section5_quote.'</div>';
                ?>
            </div>
            <div class="about-section-img" data-aios-staggered-child="true" data-aios-animation="fadeInRight" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">
                <?php
                if ($section5_image && !empty($section5_image))
                    echo '<img src="/images/'.$section5_image.'" alt="" width="'.($section5_image_width && !empty($section5_image_width) ? $section5_image_width.'px' : '').'">';
                ?>
            </div>
            <div class="clear"></div>
        </section>
        <?php
        }
    }

    if ($page_view == 'makler-szabo-balazs')
    {
        echo '
        <section id="section-bottom" data-aios-staggered-child="true" data-aios-animation="fadeInLeft" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">
            <div class="contact-info">
                <div class="cinfo">
                    <div class="cphone">
                        <i class="ai-font-phone"></i><a class="mobile-phone" data-filter="off" href="tel:'.$aoreal->phone_link.'">'.$aoreal->phone.'</a>
                    </div>
                    <div class="cemail">
                        <i class="ai-font-envelope-f"></i><a class="asis-mailto-obfuscated-email-hidden asis-mailto-obfuscated-email " data-value="'.$aoreal->email.'">'.$aoreal->email.'</a>
                    </div>
                    <div class="caddress">
                        <i class="ai-font-location-c"></i><p>'.$aoreal->address.'<br>'.$aoreal->postcode.' '.$aoreal->city.'</p>
                    </div>
                    <div class="cmedia">
                        <div class="were-social__boxes--smi p-0">
                            <i></i>';                   

                            if ($aoreal->facebook)
                                echo '<a href="'.$aoreal->facebook.'" target="_blank" class="ai-font-facebook d-inline-block mr-2 text-decoration-none align-middle"></a>';
                            if ($aoreal->twitter)
                                echo '<a href="'.$aoreal->twitter.'" target="_blank" class="ai-font-twitter d-inline-block mx-2 text-decoration-none align-middle"></a>';
                            if ($aoreal->instagram)
                                echo '<a href="'.$aoreal->instagram.'" target="_blank" class="ai-font-instagram d-inline-block mx-2 text-decoration-none align-middle"></a>';
                            if ($aoreal->linkedin)
                                echo '<a href="'.$aoreal->linkedin.'" target="_blank" class="ai-font-linkedin d-inline-block mx-2 text-decoration-none align-middle"></a>';

            echo '
                        </div>
                    </div>			
                </div>
            </div>
        </section>';
    }
    elseif (!empty($bottom_video))
    {
        echo '
        <section id="section-bottom" data-aios-staggered-child="true" data-aios-animation="fadeInLeft" data-aios-animation-delay="0.2s" style="animation-delay: 0.2s;">
            <div class="bottom-video">
                <div class="video-player">
                    <iframe width="640" height="360" src="https://www.youtube.com/embed/'.$bottom_video.'?autoplay=0&controls=0&disablekb=1&loop=1&color=white&iv_load_policy=3&rel=0&hl=sk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </section>';
    }

    if (isset($bottom_image) && !empty($bottom_image))
        echo '<div class="bottom-page-image"><img class="img-responsive" src="/images/'.$bottom_image.'" alt=""></div>';
    ?>
</main>
