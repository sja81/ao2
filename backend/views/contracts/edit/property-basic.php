<?php
use yii\helpers\Url;
use backend\assets\RealAsset;
use common\models\Nehnutelnost;
$this->title="Nová zákazka";

$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css',['depends'=>RealAsset::className()]);
$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css',['depends'=>RealAsset::className()]);
$this->registerJSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.full.min.js',['depends'=>RealAsset::className()]);
$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.1/jquery-confirm.min.css',['depends'=>RealAsset::className()]);
$this->registerJSFile('https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.1/jquery-confirm.min.js',['depends'=>RealAsset::className()]);

?>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title?></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <form action="<?=Url::to(['contracts/save-basics'])?>" method="post">
                <input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
                <input type="hidden" name="Data[contract_id]" value="<?=$_GET['id']?>">

                <?php
                if(in_array($kategoria,[Nehnutelnost::BYT,Nehnutelnost::DOM,Nehnutelnost::REKREACNE])) {
                ?>
                <div class="card">
                    <div class="card-header">
                        Miestnosti
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Počet izieb</label>
                                <select name="Data[pocet_spalna]" class="form-control select-drop">
                                    <?php
                                    for ($i = 0; $i < 11; $i++) {
                                        echo "<option value={$i}>{$i}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Počet kuchýň</label>
                                <select name="Data[pocet_kuchyna]" class="form-control select-drop">
                                    <?php
                                    for ($i = 0; $i < 11; $i++) {
                                        echo "<option value={$i}>{$i}</option>";
                                    }
                                    ?>
                                    <option value=20>kuchyňa spolu s obyvačkou</option>
                                    <option value=21>kuchyňa s jedálňou</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Počet kúpelní</label>
                                <select name="Data[pocet_kupelna]" class="form-control select-drop">
                                    <?php
                                    for ($i = 0; $i < 11; $i++) {
                                        echo "<option value={$i}>{$i}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Počet garáži</label>
                                <select name="Data[pocet_garaz]" class="form-control select-drop">
                                    <?php
                                    for ($i = 0; $i < 11; $i++) {
                                        echo "<option value={$i}>{$i}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Garážové státie</label>
                                <select name="Data[garazove_statie]" class="form-control select-drop">
                                    <?php
                                    for ($i = 0; $i < 11; $i++) {
                                        echo "<option value={$i}>{$i}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Parkovacie státie</label>
                                <select name="Data[parkovanie]" class="form-control select-drop">
                                    <?php
                                    for ($i = 0; $i < 11; $i++) {
                                        echo "<option value={$i}>{$i}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <?php
                            if (in_array($kategoria, [Nehnutelnost::DOM, Nehnutelnost::REKREACNE])) {
                                ?>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Počet podlaží (Dom)</label>
                                    <input type="text" class="form-control" name="Data[pocet_podlazi]">
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                        if (in_array($kategoria, [Nehnutelnost::BYT])) {
                            ?>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Počet poschodí (Byt)</label>
                                    <input type="text" class="form-control" name="Data[pocet_poschodi]">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Poschodie (Byt)</label>
                                    <input type="text" class="form-control" name="Data[poschodie]">
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                }
                ?>


                <div class="card">
                    <div class="card-header">
                        Technické parametere
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Vlastníctvo</label>
                                <select class="form-control select-drop" name="Data[vlastnictvo]">
                                    <option value="0">-- Vyberte typ vlastníctva --</option>
                                    <?php
                                    foreach($vlastnictvo as $item) {
                                        echo "<option value={$item['id']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <?php
                            if(in_array($kategoria,[Nehnutelnost::BYT,Nehnutelnost::DOM,Nehnutelnost::REKREACNE])) {
                                ?>
                                <div class="col-md-6 form-group">
                                    <label>Rok kolaudácie</label>
                                    <input type="text" class="form-control" name="Data[rok_kolaudacie]">
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                        if(in_array($kategoria,[Nehnutelnost::BYT,Nehnutelnost::DOM,Nehnutelnost::REKREACNE])) {
                            ?>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Stav</label>
                                <select class="form-control select-drop" name="Data[stav]">
                                    <option value="0">-- Všetky stavy --</option>
                                    <?php
                                    foreach ($prop_stav as $item) {
                                        echo "<option value={$item['id']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Energetický certifikát</label>
                                <select class="form-control select-drop" name="Data[certifikat]">
                                    <option value="0">-- Vyberte certifikát --</option>
                                    <option value="Z">Bez certifikátu</option>
                                    <?php
                                    foreach ($objekt_cert as $item) {
                                        echo "<option value='{$item['hodnota']}'>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Orientácia objektu</label>
                                <select name="Data[orientacia]" class="form-control select-drop">
                                    <?php
                                    foreach($orientacia as $item) {
                                        echo "<option value={$item['id']}>{$item['popis']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        <?php
                        if(in_array($kategoria,[Nehnutelnost::DOM,Nehnutelnost::REKREACNE])) {
                        ?>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Strecha - typ</label>
                                <select name="Data[strecha_typ][]" class="form-control select-drop" id="strecha-typ"
                                        multiple="multiple">
                                    <?php
                                    foreach ($typ_strecha as $typ) {
                                        ?>
                                        <option value='<?= $typ['id'] ?>'><?= $typ['nazov'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Strecha - materiál</label>
                                <select class="form-control select-drop" name="Data[strecha_material][]"
                                        multiple="multiple" id="strecha-material">
                                    <?php
                                    foreach ($material_strecha as $mat) {
                                        ?>
                                        <option value="<?= $mat['id'] ?>"><?= $mat['nazov'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Strecha - izolácia</label>
                                <select name="Data[strecha_izolacia][]" class="form-control select-drop"
                                        multiple="multiple" id="strecha-izol">
                                    <option value="0">bez izolácie</option>
                                    <?php
                                    foreach ($strecha_izolacia as $item) {
                                        echo "<option value={$item['id']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php
                        }
                        ?>

                        <?php
                        if(in_array($kategoria,[Nehnutelnost::BYT,Nehnutelnost::DOM,Nehnutelnost::REKREACNE])) {
                        ?>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Fasáda - materiál</label>
                                <select class="form-control select-drop" name="Data[fasada_material][]"
                                        multiple="multiple" id="fasada-material">
                                    <?php
                                    foreach ($material_fasada as $mat) {
                                        echo "<option value='{$mat['id']}'>{$mat['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Fasáda - zateplenie</label>
                                <select class="form-control select-drop" name="Data[fasada_izolacia][]"
                                        id="fasada-izol" multiple="multiple">
                                    <?php
                                    foreach ($zateplenie_fasada as $zatep) {
                                        echo "<option value={$zatep['id']}>{$zatep['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Stena</label>
                                <select class="form-control select-drop" name="Data[stena][]" multiple="multiple"
                                        id="stena">
                                    <?php
                                    foreach ($stena as $item) {
                                        echo "<option value={$item['id']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <?php
                            if (in_array($kategoria, [Nehnutelnost::DOM, Nehnutelnost::REKREACNE])) {
                                ?>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Plot</label>
                                    <select class="form-control select-drop" name="Data[plot][]" multiple="multiple"
                                            id="plot">
                                        <?php
                                        foreach ($plot as $item) {
                                            echo "<option value{$item['id']}>{$item['nazov']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Internet</label>
                                <select class="form-control select-drop" name="Data[internet]">
                                    <option value="0">Zvolte typ internetu</option>
                                    <?php
                                    foreach ($internet as $item) {
                                        echo "<option value={$item['id']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Bezpečnostný systém</label>
                                <select class="form-control select-drop" name="Data[bezp_system][]"
                                        multiple="multiple" id="bezp-sys">
                                    <?php
                                    foreach($bezpecnost as $item){
                                        echo "<option value={$item['id']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Ohrievanie vody</label>
                                <select class="form-control select-drop" name="Data[ohrev_voda][]"
                                        multiple="multiple" id="ohrev-vody">
                                    <?php
                                    foreach ($ohrev_vody as $item) {
                                        echo "<option value={$item['id']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Zariadenosť objektu</label>
                                <select class="form-control select-drop" name="Data[zariadenost]">
                                    <option value=0>Zvolte mieru zariadenosti</option>
                                    <?php
                                    foreach($zariadenost as $item) {
                                        echo "<option value={$item['id']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Kúrenie</label>
                                <select name="Data[kurenie]" class="form-control select-drop" id="kurenie" multiple>
                                    <?php
                                        foreach($kurenie as $item) {
                                            echo "<option value={$item['id']}>{$item['nazov']}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Vchodové dvere</label>
                                <select name="Data[vchodove_dvere]" class="form-control select-drop">
                                    <option value="0">Zvoľte typ vchodových dverí</option>
                                    <option value="1">Pôvodné</option>
                                    <option value="2">Bezpečnostné</option>
                                </select>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Okno</label>
                                <select name="Data[okno][]" class="form-control select-drop" multiple id="okno">
                                    <?php
                                    foreach ($okno as $item){
                                        echo "<option value={$item['id']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Financovanie</label>
                                <select name="Data[financovanie][]" class="form-control select-drop" id="financovanie" multiple="multiple">
                                    <option value="">bez info</option>
                                    <option value="hotovost">Hotovosť</option>
                                    <option value="hypo">aj HÚ / STSP</option>
                                </select>
                            </div>
                            <?php
                            if(in_array($kategoria,[Nehnutelnost::BYT,Nehnutelnost::DOM,Nehnutelnost::REKREACNE])) {
                            ?>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Podlaha</label>
                                    <select class="form-control select-drop" name="Data[podlaha][]" multiple="multiple"
                                            id="podlaha">
                                        <?php
                                        foreach ($podlaha as $item) {
                                            echo "<option value={$item['id']}>{$item['nazov']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        Plochy
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Celková [m<sup>2</sup>]</label>
                                <input type="text" class="form-control" name="Data[pozemok_cely]" value="0">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Zastavaná [m<sup>2</sup>]</label>
                                <input type="text" class="form-control" name="Data[plocha_zast]" value="0">
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Úžitková [m<sup>2</sup>]</label>
                                    <input type="text" class="form-control" value="0" name="Data[uzitkova_plocha]">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Pivnica [m<sup>2</sup>]</label>
                                    <input type="text" class="form-control" value="0" name="Data[pivnica]">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Terasa [m<sup>2</sup>]</label>
                                    <input type="text" class="form-control" value="0" name="Data[teras]">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Balkón [m<sup>2</sup>]</label>
                                    <input type="text" class="form-control" value="0" name="Data[balkon]">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Záhrada[m<sup>2</sup>]</label>
                                    <input type="text" class="form-control" name="Data[plocha_zahrada]" value="0">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Pozemok[m<sup>2</sup>]</label>
                                    <input type="text" class="form-control" name="Data[pozemok]" value="0">
                                </div>
                            </div>
                    </div>
                </div>

                <?php
                if(in_array($kategoria,[Nehnutelnost::BYT,Nehnutelnost::DOM,Nehnutelnost::REKREACNE])) {
                    ?>
                    <div class="card">
                        <div class="card-header">
                            Náklady
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Náklady (mes.) - plyn</label>
                                    <input type="text" class="form-control" name="Data[nakl_plyn]" value="0">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Náklady (mes.) - TÚV</label>
                                    <input type="text" class="form-control" name="Data[nakl_tuv]" value="0">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Náklady (mes.) - SÚV</label>
                                    <input type="text" class="form-control" name="Data[nakl_suv]" value="0">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Náklady (mes.) - elektrina</label>
                                    <input type="text" class="form-control" name="Data[nakl_elektrina]" value="0">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Náklady (mes.) - internet</label>
                                    <input type="text" class="form-control" name="Data[nakl_internet]" value="0">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Náklady (mes.) - televízia</label>
                                    <input type="text" class="form-control" name="Data[nakl_tv]" value="0">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Náklady (mes.) - poplatok pre správ. spol.</label>
                                    <input type="text" class="form-control" name="Data[nakl_popl_spravc]" value="0">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Náklady (mes.) - kúrenie</label>
                                    <input type="text" class="form-control" name="Data[nakl_kurenie]" value="0">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Náklady (mes.) - iné</label>
                                    <input type="text" class="form-control" name="Data[nakl_ine]" value="0">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Náklady (roč.) - poistenie</label>
                                    <input type="text" class="form-control" name="Data[nakl_poistenie]" value="0">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Náklady (roč.) - garážové státie</label>
                                    <input type="text" class="form-control" name="Data[nakl_garaz]" value="0">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Náklady (roč.) - dane spolu</label>
                                    <input type="text" class="form-control" name="Data[nakl_dane]" value="0">

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>

                <?php
                if(in_array($kategoria,[Nehnutelnost::BYT,Nehnutelnost::DOM,Nehnutelnost::REKREACNE])) {
                    ?>
                    <div class="card">
                        <div class="card-header">
                            Vybavenie nehnuteľnosti
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[bazen]" value="1">
                                    <label class="control-label">Bazén</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[jacuzzi]" value="1">
                                    <label class="control-label">Jacuzzi</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[sauna]" value="1">
                                    <label class="control-label">Sauna</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[solarium]" value="1">
                                    <label class="control-label">Solárium</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[letna_kuchyna]" value="1">&nbsp;
                                    <label class="control-label">Letná kuchyňa</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[altanok]" value="1">&nbsp;
                                    <label class="control-label">Altánok</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[zahrada]" value="1">&nbsp;
                                    <label class="control-label">Záhrada</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[video_vratnik]" value="1">&nbsp;
                                    <label class="control-label">Video vrátnik</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[recepcia]" value="1">&nbsp;
                                    <label class="control-label">Recepcia</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[zimna_zahrada]" value="1">&nbsp;
                                    <label class="control-label">Zimná záhrada</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[vinna_pivnica]" value="1">&nbsp;
                                    <label class="control-label">Vínna pivnica</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[dielna]" value="1">&nbsp;
                                    <label class="control-label">Dieľňa</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[studna]" value="1">&nbsp;
                                    <label class="control-label">Vlastná studňa</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[zumpa]" value="1">&nbsp;
                                    <label class="control-label">Žumpa</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[zavl_system]" value="1">&nbsp;
                                    <label class="control-label">Zavlažovací systém</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[stodola]" value="1">&nbsp;
                                    <label class="control-label">Stodola</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[rekuperacia]" value="1">&nbsp;
                                    <label class="control-label">Rekuperácia</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <input type="checkbox" name="Data[plyn]" value="1">&nbsp;
                                    <label class="control-label">Plyn</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[mest_voda]" value="1">&nbsp;
                                    <label class="control-label">Mestský vodovod</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[tatra_profil]" value="1">&nbsp;
                                    <label class="control-label">Tatranský profil</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[vytah]" value="1">&nbsp;
                                    <label class="control-label">Výťah</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[hromozvod]" value="1">&nbsp;
                                    <label class="control-label">Hromozvod</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[chodba]" value="1">&nbsp;
                                    <label class="control-label">Chodba</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[predsien]" value="1">&nbsp;
                                    <label class="control-label">Predsieň</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[klima]" value="1">&nbsp;
                                    <label class="control-label">Klimatizácia</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[kotolna]" value="1">&nbsp;
                                    <label class="control-label">Kotolňa</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[pracovna]" value="1">&nbsp;
                                    <label class="control-label">Práčovňa</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[ventilator]" value="1">&nbsp;
                                    <label class="control-label">Ventilátor</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[akvarium]" value="1">&nbsp;
                                    <label class="control-label">Akvárium (vstavaný)</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[komora]" value="1">&nbsp;
                                    <label class="control-label">Komora</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[bezbar_pristup]" value="1">&nbsp;
                                    <label class="control-label">Bezbarierový prístup</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[bar_pult]" value="1">&nbsp;
                                    <label class="control-label">Barový pult</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[domace_kino]" value="1">&nbsp;
                                    <label class="control-label">Domáce kino</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[herne_automaty]" value="1">&nbsp;
                                    <label class="control-label">Herné automaty</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[fitnes_miest]" value="1">&nbsp;
                                    <label class="control-label">Zariadený fitnes miestnosť</label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[biliard]" value="1">&nbsp;
                                    <label class="control-label">Biliardový stôl</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="checkbox" name="Data[elektrina_230_400]" value="1">&nbsp;
                                    <label class="control-label">Elektrina 230V/400V</label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <?php
                }
                ?>

                <div class="card">
                    <div class="card-header">
                        Občianska vybavenosť
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[mhd]" value="1">&nbsp;
                                <label class="control-label">MHD</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[nemocnica]" value="1">&nbsp;
                                <label class="control-label">Nemocnica</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[skolka]" value="1">&nbsp;
                                <label class="control-label">Škôlka</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[skola]" value="1">&nbsp;
                                <label>Škola</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[vlak_stanica]" value="1">&nbsp;
                                <label class="control-label">Železničná stanica</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[auto_stanica]" value="1">&nbsp;
                                <label class="control-label">Autobusová stanica</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[trh]" value="1">&nbsp;
                                <label class="control-label">Trh</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[obch_centrum]" value="1">&nbsp;
                                <label class="control-label">Obchody</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[restauracia]" value="1">&nbsp;
                                <label class="control-label">Reštaurácie</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[bank]" value="1">&nbsp;
                                <label class="control-label">Bank / bankomaty</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[cerp_stanica]" value="1">&nbsp;
                                <label class="control-label">Čerpacia stanica</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[fitness_centrum]" value="1">
                                <label class="control-label">Fitness centrum</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        Ostatné detaily
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="control-label">Ďalší popis nehnuteľnosti</label>
                                <textarea class="form-control" style="" name="Data[dalsi_popis]"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Prevod nehnuteľnosti je podmienený</label>
                                <select class="form-control select-drop" multiple id="podmienka-prevod" name="Data[podmienka_prevod][]">
                                    <?php
                                    foreach($predaj_podmienky as $item) {
                                        echo "<option value='{$item['nazov']}'>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Prenájom nehnuteľnosti je podmienený</label>
                                <select class="form-control select-drop" multiple id="podmienka-prenajom" name="Data[podmienka_prenajom][]">
                                    <?php
                                    foreach($prenajom_podmienky as $item) {
                                        echo "<option value='{$item['nazov']}'>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="card">
                    <div class="form-actions">
                        <div class="card-body">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-arrow-circle-right"></i>&nbsp;Pokračovať</button>
                            <button type="button" class="btn btn-dark" onclick="redirectTo('<?= Url::to(['/contracts'])?>')" ><i class="fa fa-times-circle"></i>&nbsp;Zrušiť</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

$js = <<<JS
    redirectTo = function(url)
    {
        $.confirm({
            title: 'Skončiť',
            content: 'Naozaj chcete skončiť?',
            buttons: {
                ano: function () {
                    window.location.replace(url);
                },
                nie: function () {
                }
            }
        });
    }
    $('#kurenie').select2({
        theme: "bootstrap",
        placeholder: "Vyberte typ kúrenia",
        tags: true
    });
    $('#okno').select2({
        theme: "bootstrap",
        placeholder: "Vyberte typ okna",
        tags: true
    });
    $('#podlaha').select2({
        theme: "bootstrap",
            placeholder: "Vyberte typ podlahy",
        tags: true
    });
    $('#podmienka-prevod').select2({
        theme: "bootstrap",
        placeholder: "Vyberte podmienku prevodu",
        tags: true
    });
    $('#podmienka-prenajom').select2({
        theme: "bootstrap",
        placeholder: "Vyberte podmienku prenájmu",
        tags: true
    });
    $('#strecha-typ').select2({
        theme: "bootstrap",
        placeholder: "Vyberte typ strechy"
    });
    $('#strecha-material').select2({
        theme: "bootstrap",
        placeholder: "Zvolte materiál"
    });
    $('#strecha-izol').select2({
        theme: "bootstrap",
        placeholder: "Zvolte typ izolacie"
    });
    $('#fasada-izol').select2({
        theme: "bootstrap",
        placeholder: "Zvolte typ izolacie"
    });
    $('#fasada-material').select2({
        theme: "bootstrap",
        placeholder: "Zvolte material"
    });
    $('#stena').select2({
        theme: "bootstrap",
        placeholder: "Zvolte material"
    });
    $('#plot').select2({
        theme: "bootstrap",
        placeholder: "Zvolte material"
    });
    $('#bezp-sys').select2({
        theme: "bootstrap",
        placeholder: "Zvolte typ bezp. systemu"
    });
     $('#ohrev-vody').select2({
        theme: "bootstrap",
        placeholder: "Zvolte typ ohrevu vody"
    });
     $('#financovanie').select2({
        theme: "bootstrap",
        placeholder: "Zvolte typ financovania"
    });
JS;

$this->registerJS($js);
?>
