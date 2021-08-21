<?php
use common\models\Konfiguracia;
use common\models\NehnutelnostDruhy;

$this->title="Výsledok vyhľadávania";
?>
<div class="container-fluid">

    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor">ID: #<?= $id_zmluva ?> - <?= $nehnutelnost['ulica'] ?>, <?= $nehnutelnost['okres'] ?></h4>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators2" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators2" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators2" data-slide-to="2"></li>

                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <img class="img-responsive" src="../assets/images/property/prop6.jpg" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="img-responsive" src="../assets/images/property/prop7.jpg" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="img-responsive" src="../assets/images/property/prop8.jpg" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <p class="text-dark p-t-20 pro-desc">
                        <?= $sumar ?>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Vybavenie</h5>
                            <hr class="m-0 p-10">

                            <?php
                            if ($zakladne_info['bazen'] == 1):
                            ?>
                            <div class="d-flex fa fa-check-circle text-success p-b-5">
                                <h6 class="m-l-10 text-dark">Bazén</h6>
                            </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['studna'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Studňa</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['krb'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Krb</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['zumpa'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Žumpa</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['vytah'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Výťah</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['hromozvod'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Hromozvod</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['bezbar_pristup'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Bezbariérový prístup</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['biliard'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Biliardový stôl</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['video_vratnik'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Video vrátnik</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['recepcia'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Recepcia</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['jacuzzi'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Jacuzzi</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['sauna'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Sauna</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['solarium'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Solárium</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['plyn'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Plyn</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['mest_voda'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Mestský vodovod</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['pevna_linka'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Pevná linka</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['satelit'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Satelit</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['internet'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Internet</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['kablova_televizia'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Káblová televízia</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['kurenie'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Kúrenie</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['fitnes_miest'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Fitness miestnosť</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['herne_automaty'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Herné automaty</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['klima'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Klíma</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['akvarium'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Akvárium</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['ventilator'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Ventilátor</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['domace_kino'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Domáce kino</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['bar_pult'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Barový pult</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['pracovna'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Práčovňa</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['komora'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Komora</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['pivnicna_kobka'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Pivničná kôbka</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['vinna_pivnica'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Vínna pivnica</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['pivnica'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Pivnica</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['kotolna'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Kotolňa</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['predsien'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Predsieň</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['chodba'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Chodba</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['balkon'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Balkón</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['ohrev_voda'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Ohrev vody</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['vykurovanie'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Vykurovanie</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['teras'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Terasa</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                            <?php
                            if ($zakladne_info['loggia'] == 1):
                                ?>
                                <div class="d-flex fa fa-check-circle text-success p-b-5">
                                    <h6 class="m-l-10 text-dark">Loggia</h6>
                                </div>
                            <?php
                            endif;
                            ?>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Rozmery izieb</h5>
                            <div class="table-responsive p-t-10 border-top">
                                <table class="table no-border">
                                    <tbody class="text-dark">

                                    <?php
                                    foreach ($miestnosti as $item) {
                                        $rozmer = "???";
                                        if ($item['sirka'] != 0 && $item['dlzka'] != 0) {
                                            $rozmer = $item['dlzka'] . " m x " . $item['sirka'] . " m";
                                        } elseif ($item['plocha'] != 0) {
                                            $rozmer = "{$item['plocha']}<sup>2</sup>";
                                        }
                                    ?>
                                        <tr>
                                            <td><?= $item['nazov'] ?></td>
                                            <td><?= $rozmer ?></td>
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

            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

            <div class="card">
                <div class="card-body text-center">
                    <a href="javascript:void(0)"><img alt="img" class="thumb-lg img-circle" src="<?= Yii::getAlias('@web')?>/assets/images/users/agent.jpg"></a>
                    <h4><?= $meno_maklera ?></h4>
                    <h6>Zodpovedný maklér</h6>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Základné informácie</h5>
                    <div class="table-responsive">
                        <table class="table no-border">
                            <tbody class="text-dark">
                            <tr>
                                <td>Typ</td>
                                <td><?= $ucel ?></td>
                            </tr>
                            <tr>
                                <td>Cena</td>
                                <td><?= $cena ?></td>
                            </tr>
                            <tr>
                                <td>Počet izieb</td>
                                <td><?= $zakladne_info['pocet_miestnosti'] ?></td>
                            </tr>
                            <tr>
                                <td>Počet kúpelní</td>
                                <td><?= $zakladne_info['pocet_kupelna'] ?></td>
                            </tr>
                            <tr>
                                <td>Počet kuchýň</td>
                                <td><?= $zakladne_info['pocet_kuchyna'] ?></td>
                            </tr>

                            <?php
                                if (!is_null($zakladne_info['pocet_garaz'])):
                            ?>
                                <tr>
                                    <td>Počet garáží</td>
                                    <td><?= $zakladne_info['pocet_garaz'] ?></td>
                                </tr>
                            <?php
                            endif;
                            ?>

                            <?php
                            if (!is_null($zakladne_info['garazove_statie'])):
                                ?>
                                <tr>
                                    <td>Počet garážových státí</td>
                                    <td><?= $zakladne_info['garazove_statie'] ?></td>
                                </tr>
                            <?php
                            endif;
                            ?>

                            <?php
                            if (!is_null($zakladne_info['parkovanie'])):
                                ?>
                                <tr>
                                    <td>Parkovanie</td>
                                    <td><?= $zakladne_info['parkovanie'] ?></td>
                                </tr>
                            <?php
                            endif;
                            ?>

                            <?php
                            if (!is_null($zakladne_info['pocet_poschodi'])):
                            ?>
                            <tr>
                                <td>Počet poschodí</td>
                                <td><?= $zakladne_info['pocet_poschodi'] ?></td>
                            </tr>
                            <?php
                            endif;
                            ?>

                            <?php
                            if (!is_null($zakladne_info['poschodie'])):
                                ?>
                                <tr>
                                    <td>Poschodie</td>
                                    <td><?= $zakladne_info['poschodie'] ?></td>
                                </tr>
                            <?php
                            endif;
                            ?>

                            <?php
                            if (!is_null($zakladne_info['pocet_podlazi'])):
                            ?>
                            <tr>
                                <td>Počet podlaží</td>
                                <td><?= $zakladne_info['pocet_podlazi'] ?></td>
                            </tr>
                            <?php
                            endif;
                            ?>

                            <tr>
                                <td>Celková plocha (m<sup>2</sup>)</td>
                                <td><?= $zakladne_info['plocha_celkova'] ?></td>
                            </tr>
                            <tr>
                                <td>Úžitková plocha (m<sup>2</sup>)</td>
                                <td><?= $zakladne_info['plocha_uzitkova'] ?></td>
                            </tr>
                            <tr>
                                <td>Rok kolaudácie</td>
                                <td><?= $zakladne_info['rok_kolaudacie'] ?></td>
                            </tr>
                            <tr>
                                <td>Stav</td>
                                <td><?= Konfiguracia::vratNazov($zakladne_info['stav']) ?></td>
                            </tr>
                            <tr>
                                <td>Kategória</td>
                                <td><?= NehnutelnostDruhy::vratNazov($nehnutelnost['druh_nehnut']) ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
