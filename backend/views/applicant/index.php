<?php
use yii\helpers\Url;
use backend\assets\RealAsset;

$this->title = "Uchádzači";
$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css',['depends'=>RealAsset::className()]);
$this->registerJSFile('https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js',['depends'=>RealAsset::className()]);
?>

<div class="container-fluid">
    <div class="card m-t-20">
        <div class="card-body">

            <div class="row m-b-10">
                <div class="col-sm-3">
                    <label class="control-label"><?= \Yii::t('app','Meno') ?></label>
                    <input type="text" id="meno" class="form-control">
                    <small class="form-text text-muted">
                        Na vyhľadávanie treba zadať min. 3 znaky
                    </small>
                </div>
                <div class="col-sm-3">
                    <label class="control-label"><?= \Yii::t('app','Pozícia') ?></label>
                    <select class="form-control custom-select" id="pozicia">
                        <option value=""><?= \Yii::t('app','Zvoľte pozíciu') ?></option>
                        <?php
                        foreach ($jobs as $job) {
                        ?>
                             <option value="<?= $job['id']?>"><?= $job['title'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-3">
                    <label class="control-label"><?= \Yii::t('app','Status') ?></label>
                    <select class="form-control custom-select" id="status">
                       <option value=""><?= \Yii::t('app','Zvoľte status') ?></option>
                       <option value="pend"><?= \Yii::t('app','Čaká') ?></option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <label class="control-label"><?= \Yii::t('app','Vytvorené') ?></label>
                    <input type="date" id="vytvorene" class="form-control">
                </div>
            </div>
            <div class="row m-b-10">
                <div class="col-sm-12">
                    <button class="btn btn-danger" id="clear-filter"><i class="far fa-trash-alt m-r-5"></i> <?= \Yii::t('app','Zmazať filter') ?></button>
                </div>
            </div>

        </div>
    </div>

    <div class="card m-t-20">

        <div class="card-body">

            <table class="table table-striped m-t-5 table-sm">
                <thead style="background-color: #2B81AF" class="text-white">
                <th>Meno</th>
                <th>Adresa</th>
                <th>Kontakt</th>
                <th>Dátum narodenia</th>
                <th>Pozícia</th>
                <th>Status</th>
                <th>Vytvorené</th>
                <th>Zmenené</th>
                <th>Akcie</th>
                </thead>
                <tbody>
                <?php
                foreach ($applicants as $item) {
                    echo $this->render('applicant-row',[
                            'item'  => $item
                    ]);
                }
                ?>
                </tbody>
            </table>



        </div>

    </div>
</div>
<?php
$koniecPohovorUrl = Url::to(['/applicant/ajax-close-case']);
$hladacUrl = Url::to(['/applicant/ajax-search']);
$csrf = "'" . Yii::$app->request->csrfParam ."':'". Yii::$app->request->getCsrfToken() ."'";

$js = <<<JS

    applicantSearch = function(){
        
    }
    
    $('#clear-filter').on('click',function(){
        $('#meno').val('');
        $('#pozicia').prop('selectedIndex',0);
        $('#status').prop('selectedIndex',0);
        $('#vytvorene').val('');
        return false; 
    });

    $('#vytvorene').on('blur',function(){
       applicantSearch(); 
    });
    
    $("#meno").on('keyup',function(){
        var v = $(this).val();
        if (v.length < 3) {
            return false;
        }
        applicantSearch();
    });

    $('#pozicia').on('change',function(){
        applicantSearch();
    });
    
    $('#status').on('change',function(){
        applicantSearch();
    });

    $("#close-case").on('click',function(){
        $.confirm({
            title: 'Potvrdenie',
            icon: 'fa fa-question',
            theme: 'modern',
            closeIcon: true,
            animation: 'scale',
            type: 'orange',
            content: 'Naozaj chcete skončiť pohovor?',
            buttons: {
                ano: function () {
                    var app_id = $(this).data('id');
                    $.ajax({
                        url: "{$koniecPohovorUrl}",
                        dataType: "json",
                        data: { {$csrf}},
                        type: "post"
                    })
                    .done(function(res){
                       sessionStorage.setItem('applicant_id',res['applicant_id']);
                    })
                    .fail(function(){
                        
                    });
                },
                nie: function () {
                }
            }
        });
    });
JS;
$this->registerJs($js);