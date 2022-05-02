<?php

use yii\helpers\Url;
use backend\assets\RealAsset;
$this->title = 'Zákazníci';

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
                            <th>RČ/IČO</th>
                            <th>Adresa</th>
                            <th>PSČ</th>
                            <th>Email</th>
                            <th>Telefón</th>
                            <th>Vytvorené</th>
                            <th>Akcie</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($customers as $customer) {
                        ?>
                            <tr>
                                <td>
                                    <?php
                                    if (!$customer['meno'] == '') {
                                        echo $customer['meno'];
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?= $customer['ssnico'] ?>
                                </td>
                                <td>
                                    <?= $customer['adresa']  ?> 
                                    <br>
                                    <?= $customer['town']  ?>
                                </td>
                                <td>
                                    <?= $customer['zip'] ?>
                                </td>
                                <td>
                                    <?= $customer['email'] ?>
                                </td>
                                <td>
                                    <?= $customer['phone'] ?>
                                </td>
                                <td>
                                    <?= $customer['created_at'] ?>
                                </td>
                                <td>
                                    <a href="<?= Url::to(['customers/edit', 'id' => $customer['id']]) ?>" title="Edit" style="color: black"><i class="fas fa-pencil-alt"></i></a>
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