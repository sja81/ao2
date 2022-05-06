<?php

use yii\helpers\Url;
use backend\assets\RealAsset;
$this->title = 'Klienti';

$this->registerJSFile('@web/assets/node_modules/datatables/datatables.min.js',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/datatables/media/css/dataTables.bootstrap4.css',['depends'=>RealAsset::class]);
?>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-8 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm dattable">
                    <thead>
                        <tr>
                            <th>Meno a priezvisko</th>
                            <th>SSN</th>
                            <th>Adresa</th>
                            <th>Email</th>
                            <th>Telefón</th>
                            <th>Vytvorené</th>
                            <th>Akcie</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($clients as $client) {
                        ?>
                            <tr>
                                <td>
                                    <?= $client['meno'] ?>
                                </td>
                                <td>
                                    <?= $client['ssn'] ?>
                                </td>
                                <td>
                                    <?= $client['adresa'] ?>
                                </td>
                                <td>
                                    <?= $client['email']; ?>
                                </td>
                                <td>
                                 <?= $client['mobile'] ?>
                                </td>
                                <td>
                                    <?= $client['created_at'] ?>
                                </td>
                                <td>
                                    <a href="<?= Url::to(['clients/edit', 'id' => $client['id']]) ?>" title="Edit" style="color: black"><i class="fas fa-pencil-alt"></i></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php 

$js =  <<<JS

$(function() {
    $('.dattable').DataTable({
        order: []
    });
});

JS;
$this->registerJS($js);