<?php

use backend\assets\RealAsset;

$this->registerCSSFile('@web/assets/node_modules/multiselect/css/multi-select.css', ['depends' => RealAsset::class]);

$this->title = 'Dokumenty';
?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>

    <div class="card rounded-5 card-shadow w-100">
        <div class="card-body">
            <div class="col-3 mb-4">
                <h5 class="box-title">Group Name</h5>
                <select class="form-control dropdown">
                    <?php
                    foreach ($privileges as $privilage) {
                    ?>
                        <option value='<?= $privilage->id ?>'><?= $privilage->group_name ?></option>

                    <?php } ?>
                </select>

            </div>
            <div class="col-12">
                <h5 class="box-title">Students</h5>
                <select id='students' multiple='multiple'>
                    <?php
                    foreach ($students as $student) {
                    ?>
                        <option value='<?= $student->id ?>'><?= $student->firstName . ' ' . $student->lastName ?></option>

                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
</div>

<script defer src="/backend/web/js/multiselect.js" type="text/javascript"></script>
<?php
$css = <<<CSS
    .rounded-5 {
        border-radius: .5em!important;
    }
    .card-shadow {
        box-shadow: lightgrey 3px 3px;
    }
CSS;
$this->registerCSS($css);
