<?php
use backend\assets\RealAsset;

$this->title= Yii::t('app','Účtovníctvo - Reporty');

$this->registerJSFile('@web/assets/node_modules/moment/moment.js',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/bootstrap-daterangepicker/daterangepicker.js',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/timepicker/bootstrap-timepicker.min.css',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/bootstrap-daterangepicker/daterangepicker.css',['depends'=>RealAsset::class]);

$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css',['depends'=>RealAsset::class]);
$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css',['depends'=>RealAsset::class]);
$this->registerJSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.full.min.js',['depends'=>RealAsset::class]);

$this->registerCSSFile('@web/assets/node_modules/morrisjs/morris.css',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/dist/css/style.min.css',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/raphael/raphael-min.js',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/morrisjs/morris.min.js',['depends'=>RealAsset::class]);

$this->registerCSSFile('@web/assets/dist/css/pages/dashboard1.css',['depends'=>RealAsset::class]);

?>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-xs-12">
                            <h6><?= Yii::t('app','Obdobie') ?></h6>
                            <div class='input-group mb-3'>
                                <input type='text' class="form-control" id="invoice-date-range">
                                <span class="input-group-text">
                                <span class="ti-calendar"></span>
                            </span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12">
                            <h6><?= Yii::t('app','Firma/y'); ?></h6>
                            <select class="select2 m-b-10 select2-multiple" style="width: 100%" multiple="multiple" id="invoice-company">

                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-12 col-xs-12">
                            <button type="button" class="btn btn-dark"><i class="fas fa-search m-r-10"></i>Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex m-b-40 align-items-center">
                        <h5 class="card-title">PROPERTIES STATS</h5>
                        <div class="ms-auto">
                            <ul class="list-inline font-12">
                                <li><i class="fa fa-circle text-cyan"></i> For Sale</li>
                                <li><i class="fa fa-circle text-primary"></i> For Rent</li>
                                <li><i class="fa fa-circle text-purple"></i> All</li>
                            </ul>
                        </div>
                    </div>
                    <div id="morris-bar-chart" style="height:352px;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    Fixne naklady <br><br>
                    Variabilne naklady<br><br>
                    Ide kiirni az adot:<br><br>
                    Ado: zisk * .15, ha Prijmy < 49790<br><br>
                    Ha Prijmy >= 49790 akkor ado
                    37981.94 eurbol 25% ado
                    es ez folott 19%<br>
                    49791 - 37981.94 = 11 809.06 -> 19% ado
                    37981.94-bol 25% ado<br>
                    <br>
                    Adokedvezmeny diakokra (ennyivel kell csokkenteni az adoalapot):
                    <br><br>
                    1. kozepfoku: 1600 eur x diak szama
                    <br>
                    2+ kozepfoku: 3200 eur x diak szama
                    <br><br>
                    Ebedjegyek:<br>
                    ebedjegyek erteke  * .55 => ezzel csokkentheto az adoalap
                    <br><br>
                    Cestaky, melyik autoval mennyit ment.
                    <br><br>
                    Utado:
                </div>
            </div>
        </div>
    </div>

    <dic class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="card m-b-15">
                        <div class="card-body">
                            <h5 class="card-title">Aoreal</h5>
                            <div class="row">
                                <div class="col-12 m-t-30">
                                    <h1 class="text-info">$64057</h1>
                                    <p class="text-muted">APRIL 2017</p> <b>(150 Sales)</b> </div>
                                Stravne listky
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="card m-b-15">
                        <div class="card-body">
                            <h5 class="card-title">Aosolution</h5>
                            <div class="row">
                                <div class="col-12 m-t-30">
                                    <h1 class="text-info">$64057</h1>
                                    <p class="text-muted">APRIL 2017</p> <b>(150 Sales)</b> </div>
                                Stravne listky
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="card m-b-15">
                        <div class="card-body">
                            <h5 class="card-title">backstage consulting</h5>
                            <div class="row">
                                <div class="col-12 m-t-30">
                                    <h1 class="text-info">$64057</h1>
                                    <p class="text-muted">APRIL 2017</p> <b>(150 Sales)</b> </div>
                                    Stravne listky
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-xs-12">
                    <div class="card m-b-15">
                        <div class="card-body">
                            <h5 class="card-title">Pokladna</h5>
                            <div class="row">
                                <div class="col-12 m-t-30">
                                    <h1 class="text-info">$64057</h1>
                                    <p class="text-muted">APRIL 2017</p> <b>(150 Sales)</b> </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<?php
$csrf = "'" . Yii::$app->request->csrfParam ."':'". Yii::$app->request->getCsrfToken() ."'";
$js = <<<JS
    $('#invoice-date-range').daterangepicker();
    $('#invoice-date-range').on('apply.daterangepicker', function(ev, picker) {
        console.log(picker.startDate.format('YYYY-MM-DD'));
        console.log(picker.endDate.format('YYYY-MM-DD'));
    });
    $(".select2").select2({
        //placeholder: '',
        tags: true,
        theme: 'bootstrap'
    });
    /*$("#inv-report h4 a").click(function(){
        event.preventDefault();
        let b = $("#inv-report h4 a>i");
        let s = b.attr("class");
        if (s.indexOf("up") > -1) {
            b.removeClass("fa-caret-up").addClass("fa-caret-down");
            $("#inv-report .card-body").slideUp();

        } else {
            b.removeClass("fa-caret-down").addClass("fa-caret-up");
            $("#inv-report .card-body").slideDown();
        }
    });*/
    
    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: 'A-O Real',
            Income: 25000,
            Expenses: 15900.50,
            Profit: 5700.75
        },
        {
            y: 'A-O Solutions',
            Income: 25000,
            Expenses: 15900.50,
            Profit: 5700.75
        },
        {
            y: 'Backstage Donsulting',
            Income: 25000,
            Expenses: 15900.50,
            Profit: 5700.75
        }
        ],
        xkey: 'y',
        ymax: 49790.00,  // kotelezo DPH 12 egymast koveto honapban (osszeadodnak a bevetelek)  
        // 
        ykeys: ['Income', 'Expenses', 'Profit'],
        labels: ['Prijmy', 'Vydavky', 'Zisk'],
        barColors: ['#b8edf0', '#b4c1d7', '#fcc9ba'],
        hideHover: 'auto',
        gridLineColor: '#eef0f2',
        resize: true,
        stacked: true
    });
JS;
$this->registerJS($js);


