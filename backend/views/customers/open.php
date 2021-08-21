<div class="container-fluid m-t-20">
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-md-12">
                    <h3 class="float-left"><?= $customer['name_first']?> <?= $customer['name_last'] ?></h3>
                    <a
                            href="<?=  \yii\helpers\Url::to(['/customers']) ?>"
                            class="btn btn-danger float-right"
                    >
                        <i class="fas fa-arrow-alt-circle-left"></i>&nbsp;Späť na zoznam</a>
                </div>
            </div>

            <div class="row m-t-20">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#udaje-klienta">Údaje klienta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#firmy">Firmy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#dokumenty">Dokumenty</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#obhliadky">Obhliadky</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#zmluvy">Zmluvy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#poznamky">Poznámky</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="udaje-klienta" class="container tab-pane active m-t-20">
                            Udaje klientafsdfsd<br>
                            fsd<br>
                            fsd<br>
                            fsd<br>
                            fs<br>
                            dfs<br>
                            dfs<br>
                            dfsd<br>
                            fsd<br>
                            fsd<br>
                        </div>
                        <div id="firmy" class="container tab-pane m-t-20">
                            Firmy
                        </div>
                        <div id="dokumenty" class="container tab-pane m-t-20">
                            Dokumenty
                        </div>
                        <div id="obhliadky" class="container tab-pane m-t-20">
                            Obhliadky
                        </div>
                        <div id="zmluvy" class="container tab-pane m-t-20">
                            Zmluvy
                        </div>
                        <div id="poznamky" class="container tab-pane m-t-20">
                            Poznamky
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>