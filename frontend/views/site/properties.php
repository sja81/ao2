<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use frontend\models\Aoreal;

//$this->title = 'Nehnuteľnosti';
$this->registerJsFile('//maps.google.com/maps/api/js?key=AIzaSyCQ0VxubqDu7tC48X0ktN_k0vF76DsTLFw', ['depends' => [yii\web\JqueryAsset::className()], 'position' => \yii\web\View::POS_HEAD]);
$this->registerJsFile('js/markerwithlabel.js', ['depends' => [yii\web\JqueryAsset::className()], 'position' => \yii\web\View::POS_HEAD]);
$this->params['breadcrumbs'][] = $this->title;

?>
<main class="site-properties">
    <div class="page-banner d-block position-relative raleway">
        <canvas style="background-image:url(/images/header-bg1.jpg);" width="1600" height="400"></canvas>
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
        <!-- MAP teszt -->
        <div class="container-fluid">
            
        </div>
        <!-- /MAP teszt-->
        <div class="container">
            <div class="row">
                <div id="PropertiesMap" style="height: 500px;<?php echo (in_array($_SERVER['REMOTE_ADDR'], array('188.167.122.113', '46.229.225.90', '46.229.225.89', '91.127.194.238', '90.64.79.191', '95.103.216.204')) ? '' : 'display:none'); ?>"></div>
                <script type="text/javascript">
                    var map = '';
                    var markers = [];
                    var infoWindow = '';
                    var gmap_latitude = '48.6688582';
                    var gmap_longitude = '18.5785466';
                </script>
            <?php
                //echo count($properties);
            if ($properties && sizeof($properties))
            {
                echo '
                <div id="properties-grid">';

                foreach ($properties as $property)
                {
                    if ($property['prop_type_id'] == 2)
                        $propTypeClass = 'for-rent';
                    else
                        $propTypeClass = 'for-sale';

                        //print_r($property);
                    $property_url = $property['rewrite_url'];
                    $property_price = Aoreal::displayPrice($property['price']);

                    echo '
                    <div class="col-md-3 col-sm-4 col-xs-12 property-details '.$propTypeClass.'">
                        <a href="'.Yii::$app->urlManager->createAbsoluteUrl(['/nehnutelnost']).'/'.$property_url.'" class="property-image-wrapper">
                            <img src="'.Aoreal::displayImage($property['cover']).'" alt="'.$property['title'].'">
                            '.($property_price ? '<span class="property-price">'.$property_price.'</span>':'').'
                            <span class="dark-overlay"></span>
                            <span class="item-link"></span>
                        </a>
                        <div class="property-descr">
                            <h3>'.($property['street'] ? $property['street'] : '').'<br>'.$property['psc'].' '.$property['mesto'].'<span>'.$property['prop_type_name'].'</span></h3>
                            <p>'.$property['title'].'</p>
                            <hr>
                            <ul class="property-features">
                                <li class="property-space">348<sup>2</sup></li>
                                <li class="property-bathrooms">'.($property['features'] ? $property['features']['pocet_kupelna'] : '').'</li>
                                <li class="property-bedrooms">'.($property['features'] ? $property['features']['pocet_kuchyna'] : '').'</li>
                            </ul>
                        </div>
                    </div>';
                }

                echo '
                </div>';
            }
            ?>
            </div>
        </div>
    </section>
    <div class="overlay-property-offer">
        <img class="img-responsive" src="/images/img-offer-balazs-szabo1.png" alt="">
    </div>
</main>
