<?php
use yii\grid\GridView;

$this->title=Yii::t('app',"Účtovníctvo - Faktúry");
?>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-8 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
        <div class="col-md-4 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <a class="btn btn-info d-none d-lg-block" href="/backoffice/invoices/add">
                    <i class="fas fa-plus-circle"></i>&nbsp;Pridať
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Faktury</h4>

            <div class="row">
                <div class="col-md-12">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'showFooter' => true,
                        'columns' => [
                            'id',
                            'invoicingYear',
                            'invoicingMonth',
                            'status'
                        ],
                    ]);
                    ?>
                </div>
            </div>

        </div>
    </div>

</div>