<?php
use backend\assets\RealAsset;
use yii\helpers\Url;
use backend\helpers\HelpersNum;
use common\models\search\BackendSearch;

$this->title=Yii::t('app','Nehnuteľnosti');;
$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css',['depends'=>RealAsset::className()]);
$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css',['depends'=>RealAsset::className()]);
$this->registerJSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.full.min.js',['depends'=>RealAsset::className()]);

?>
<div class="container-fluid">

    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php
            echo $this->render('search-box',[
                    'typy'      => $typy,
                    'staty'     => $staty,
                    'stav'      => $stav,
                    'druhy'     => $druhy,
                    'kraje'     => $kraje,
                    'okresy'    => $okresy
                ]);
            ?>
        </div>
    </div>

    <div class="row">

        <?php
            $pocet_stran = HelpersNum::getPageNumber($pocet_zmluv,BackendSearch::PAGE_LIMIT);
            $disableLeft = $disableRight = " disabled";
            if ($pocet_stran > 1 && $akt_strana > 1) {
                $disableLeft = "";
            }
            if ($akt_strana < $pocet_stran && $pocet_stran >1) {
                $disableRight = "";
            }

            echo $this->render('index-paging',[
                    'disableLeft'   => $disableLeft,
                    'disableRight'  => $disableRight,
                    'pocet_stran'   => $pocet_stran,
                    'akt_strana'    => $akt_strana
            ]);

            for($i=0; $i< count($contracts);$i++) {
                echo $this->render('property-item',[
                        'contract'  => $contracts[$i],
                        'vyhladavanie'  => $vyhladavanie
                ]);
            }

            echo $this->render('index-paging',[
                'disableLeft'   => $disableLeft,
                'disableRight'  => $disableRight,
                'pocet_stran'   => $pocet_stran,
                'akt_strana'    => $akt_strana
            ]);
        ?>

    </div>
</div>

<?php

$url = Url::to(['/contracts/new']);

$js = <<< JS
    redirect_it = function(){
        window.location.replace('{$url}');
    }
JS;

$this->registerJS($js);


$urlApprove = Url::to(['/contracts/ajax-approve']);
$urlChangeStatus = Url::to(['/contracts/ajax-change-status']);
$urlEdit = Url::to(['/contracts/edit']);
$urlDocs = Url::to(['/contracts/documents']);
$urlView = Url::to(['contracts/view-property']);

$js = <<< JS
    approve_it = function(id) {
         var csrfToken = $('meta[name="csrf-token"]').attr("content");
         var data = {to_approve: id};
         $.ajaxSetup(csrfToken);
    
        $.ajax({
            url: '{$urlApprove}',
            type: 'GET',
            data: data,
            dataType: "json",
            success: function(response) {
                $("#btn-approve-" + id).hide();
                $("#btn-on-off-" + id).show();
            }
        }); 
    }
    
    change_status = function(id) {
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
         var data = {to_change: id};
         $.ajaxSetup(csrfToken);
    
        $.ajax({
            url: '{$urlChangeStatus}',
            type: 'POST',
            data: data,
            dataType: "json",
            success: function(response) {
                
            }
        }); 
    }
    
    edit_it = function(id) {
        window.location.replace('{$urlEdit}?id=' + id);
    }
    
    doc_it = function(id) {
        window.location.replace('{$urlDocs}?id=' + id);
    }
    
    view_it = function(id) {
        window.open('{$urlView}?id='+id,'_blank');
    }
JS;

$this->registerJS($js);

$css = <<< CSS
.set-height-70 {
    height: 70px;
}
CSS;

$this->registerCSS($css);
?>