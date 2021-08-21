<?php
use yii\helpers\Url;
use backend\assets\RealAsset;

$this->title="Nová zákazka";

$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css',['depends'=>RealAsset::className()]);
$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css',['depends'=>RealAsset::className()]);
$this->registerJSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.full.min.js',['depends'=>RealAsset::className()]);
$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.1/jquery-confirm.min.css',['depends'=>RealAsset::className()]);
$this->registerJSFile('https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.1/jquery-confirm.min.js',['depends'=>RealAsset::className()]);
$this->registerJSFile('@web/js/aoreal-storage.js?v=0.1',['depends'=>RealAsset::className()]);

?>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title?></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <form action="<?=Url::to(['contracts/save-basics'])?>" method="post" id="form-byt">
                <input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
                <input type="hidden" name="Data[zmluva_id]" value="<?=$_GET['id']?>">

                <!-- Technicke parametre -->
                <div class="card">
                    <div class="card-header">
                        Technické parametere
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Vlastníctvo</label>
                                <select class="form-control select-drop to-store" name="Data[vlastnictvo]" id="vlastnictvo">
                                    <option value="0">-- Vyberte typ vlastníctva --</option>
                                    <?php
                                    $pocetMajitelov = count($byt['MAJITEL']);
                                    foreach($vlastnictvo as $item) {
                                        $selected = "";
                                        if ($pocetMajitelov == 1 && $item['hodnota'] == '1/1') {
                                            $selected = " selected";
                                        }
                                        if ($pocetMajitelov == 2 && $item['hodnota'] == 'bsm' && $byt['MAJITEL'][0]['BSM'] == 'A') {
                                            $selected = " selected";
                                        }
                                        if ($pocetMajitelov > 1 && $item['hodnota'] == '1/n' && $byt['MAJITEL'][0]['BSM'] == 'N') {
                                            $selected = " selected";
                                        }
                                        echo "<option value={$item['id']}{$selected}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Rok kolaudácie</label>
                                <select class="form-control select-drop to-store" name="Data[rok_kolaudacie]" id="rok-kolaudacia">
                                    <?php
                                    $thisYear = (new DateTimeImmutable('now'))->format('Y');
                                    for ($i=$thisYear; $i>= 0; $i--) {
                                        echo "<option value={$i}>{$i}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Stav</label>
                                <select class="form-control select-drop to-store" name="Data[stav]" id="stav">
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
                                <select class="form-control select-drop to-store" name="Data[certifikat]" id="certifikat">
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
                                <select name="Data[orientacia]" class="form-control select-drop to-store" id="orientacia">
                                    <?php
                                    foreach($orientacia as $item) {
                                        echo "<option value={$item['id']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Financovanie</label>
                                <select name="Data[financovanie][]" class="form-control select-drop to-store" id="financovanie" multiple="multiple">
                                    <option value="">bez info</option>
                                    <?php
                                    foreach($financovanie as $item) {
                                        echo "<option value={$item['id']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Počet podlaží</label>
                                <select name="Data[pocet_podlazi]" class="form-control select-drop to-store" id="pocet-podlazi">
                                    <?php
                                    for ($i = 0; $i < 11; $i++) {
                                        echo "<option value={$i}>{$i}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Plochy -->
                <div class="card">
                    <div class="card-header">
                        Plochy
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Celková [m<sup>2</sup>]</label>
                                <?php
                                $celkovaPlocha = $cislo_byt != -1 ? $byt['CELKOVA_PLOCHA'] : 0;
                                if ($celkovaPlocha > 1000) {
                                    $celkovaPlocha /= 100.00;
                                }
                                ?>
                                <input
                                        type="text"
                                        class="form-control to-store"
                                        name="Data[plocha_celkova]"
                                        value="<?=  $celkovaPlocha ?>"
                                        id="celkova-plocha"
                                >
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Úžitková [m<sup>2</sup>]</label>
                                <input type="text" class="form-control to-store" value="0" name="Data[plocha_uzitkova]" id="uzitkova-plocha">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Záhrada [m<sup>2</sup>]</label>
                                <input type="text" class="form-control to-store" value="0" name="Data[plocha_zahrada]" id="plocha-zahrada">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Pozemok [m<sup>2</sup>]</label>
                                <input type="text" class="form-control to-store" value="0" name="Data[pozemok]" id="pozemok">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- miestnosti -->
                <div class="card">
                    <div class="card-header">
                        Miestnosti
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Počet obytných miestností</label>
                                <select name="Data[pocet_miestnosti]" class="form-control select-drop to-store" id="pocet-miestnosti">
                                    <?php
                                    for ($i = 0; $i < 11; $i++) {
                                        echo "<option value={$i}>{$i}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Počet kuchýň</label>
                                <select name="Data[pocet_kuchyna]" class="form-control select-drop to-store" id="pocet-kuchyn">
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
                                <select name="Data[pocet_kupelna]" class="form-control select-drop to-store" id="pocet-kupelni">
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
                                <select name="Data[pocet_garaz]" class="form-control select-drop to-store" id="pocet-garaz">
                                    <?php
                                    for ($i = 0; $i < 11; $i++) {
                                        echo "<option value={$i}>{$i}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Garážové státie</label>
                                <select name="Data[garazove_statie]" class="form-control select-drop to-store" id="garazove-statie">
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
                                <label class="control-label">Parkovacie miesto</label>
                                <select name="Data[parkovanie]" class="form-control select-drop to-store" id="parkovanie">
                                    <?php
                                    for ($i = 0; $i < 11; $i++) {
                                        echo "<option value={$i}>{$i}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Parkovanie - mesačné náklady</label>
                                <input type="text" class="form-control to-store" name="Data[naklady][garaz]" value="0" id="naklady-garaz">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sirsie okolie nehnutelnosti -->
                <div class="card">
                    <div class="card-header">
                        Občianska vybavenosť
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[mhd]" value="1" id="mhd" class="to-store">&nbsp;
                                <label class="control-label">MHD</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[nemocnica]" value="1" id="nemocnica" class="to-store">
                                <label class="control-label">Nemocnica</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[skolka]" value="1" id="skolka" class="to-store">&nbsp;
                                <label class="control-label">Škôlka</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[skola]" value="1" id="skola" class="to-store">&nbsp;
                                <label>Škola</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[vlak_stanica]" value="1" class="to-store" id="vlak-stanica">&nbsp;
                                <label class="control-label">Železničná stanica</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[auto_stanica]" value="1" class="to-store" id="autbus-stanica">&nbsp;
                                <label class="control-label">Autobusová stanica</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[trh]" value="1" id="trh" class="to-store">
                                <label class="control-label">Trh</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[obch_centrum]" value="1" id="obch-centrum" class="to-store">&nbsp;
                                <label class="control-label">Obchody</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[restauracia]" value="1" id="restauracia" class="to-store">&nbsp;
                                <label class="control-label">Reštaurácie</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[bank]" value="1" id="bank" class="to-store">&nbsp;
                                <label class="control-label">Bank / bankomaty</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[cerp_stanica]" value="1" id="cerp-stanica" class="to-store">&nbsp;
                                <label class="control-label">Čerpacia stanica</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[fitness_centrum]" value="1" class="to-store" id="fitness-centrum">
                                <label class="control-label">&nbsp;Fitness centrum</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[kino]" value="1" id="kino" class="to-store">&nbsp;
                                <label class="control-label">Kino</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[divadlo]" value="1" id="divadlo" class="to-store">
                                <label class="control-label">&nbsp;Divadlo</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[ihrisko]" value="1" id="ihrisko" class="to-store">&nbsp;
                                <label class="control-label">Ihrisko</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[stadion]" value="1" id="stadion" class="to-store">&nbsp;
                                <label class="control-label">Štadión</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- vybavenost nehnutelnosti zvonka -->
                <div class="card">
                    <div class="card-header">
                        Vonkajšia vybavenosť
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Strecha - typ</label>
                                <select name="Data[strecha_typ][]" class="form-control select-drop to-store" id="strecha-typ"
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
                                <select class="form-control select-drop to-store" name="Data[strecha_material][]"
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
                                <select name="Data[strecha_izolacia][]" class="form-control select-drop to-store"
                                        multiple="multiple" id="strecha-izol">
                                    <option value="0">bez izolácie</option>
                                    <?php
                                    foreach ($strecha_izolacia as $item) {
                                        echo "<option value={$item['id']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Plot</label>
                                <select class="form-control select-drop to-store" name="Data[plot][]" multiple="multiple"
                                        id="plot">
                                    <?php
                                    foreach ($plot as $item) {
                                        echo "<option value{$item['id']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Fasáda - materiál</label>
                                <select class="form-control select-drop to-store" name="Data[fasada_material][]"
                                        multiple="multiple" id="fasada-material">
                                    <?php
                                    foreach ($material_fasada as $mat) {
                                        echo "<option value='{$mat['id']}'>{$mat['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Okno</label>
                                <select name="Data[okno][]" class="form-control select-drop to-store" multiple id="okno">
                                    <?php
                                    foreach ($okno as $item){
                                        echo "<option value={$item['id']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label class="control-label">Fasáda - zateplenie</label>
                                <select class="form-control select-drop to-store" name="Data[fasada_izolacia][]"
                                        id="fasada-izol" multiple="multiple">
                                    <?php
                                    foreach ($zateplenie_fasada as $zatep) {
                                        echo "<option value={$zatep['id']}>{$zatep['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Hrúbka zateplenia v cm</label>
                                <input type="text" name="Data[fasada_hrubka]" class="form-control to-store" id="fasada-hrubka">
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Stena</label>
                                <select class="form-control select-drop to-store" name="Data[stena][]" multiple="multiple"
                                        id="stena">
                                    <?php
                                    foreach ($stena as $item) {
                                        echo "<option value={$item['id']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Hrúbka steny v cm</label>
                                <input type="text" name="Data[stena_hrubka]" class="form-control to-store" id="stena-hrubka">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Značka materiálu (stena)</label>
                                <select class="form-control select-drop to-store" name="Data[stena_znacka][]" multiple="multiple"
                                        id="stena-znacka">
                                    <?php
                                    foreach($znacka_stena as $item) {
                                        echo "<option value={$item['nazov']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[bezbar_pristup]" value="1" class="to-store" id="bezbar-pristup">&nbsp;
                                <label class="control-label">Bezbarierový prístup</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[hromozvod]" value="1" class="to-store" id="hromozvod">&nbsp;
                                <label class="control-label">Hromozvod</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[septik]" value="1" class="to-store" id="septik">&nbsp;
                                <label class="control-label">Septik</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[stodola]" value="1" class="to-store" id="stodola">&nbsp;
                                <label class="control-label">Stodola</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[zavl_system]" value="1" class="to-store" id="zavl-system">&nbsp;
                                <label class="control-label">Zavlažovací systém</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[studna]" value="1" class="to-store" id="studna">&nbsp;
                                <label class="control-label">Vlastná studňa</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[zumpa]" value="1" class="to-store" id="zumpa">&nbsp;
                                <label class="control-label">Žumpa</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[dielna]" value="1" class="to-store" id="dielna">&nbsp;
                                <label class="control-label">Dieľňa</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[letna_kuchyna]" value="1" class="to-store" id="letna-kuchyna">&nbsp;
                                <label class="control-label">Letná kuchyňa</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[altanok]" value="1" class="to-store" id="altanok">&nbsp;
                                <label class="control-label">Altánok</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[sauna]" value="1" class="to-store" id="sauna">
                                <label class="control-label">Sauna</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[solarium]" value="1" class="to-store" id="solarium">
                                <label class="control-label">Solárium</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[bazen]" value="1" class="to-store" id="bazen">
                                <label class="control-label">Bazén</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[zimna_zahrada]" value="1" class="to-store" id="zimna-zahrada">&nbsp;
                                <label class="control-label">Zimná záhrada</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Vybavenie nehnutelnosti -->
                <div class="card">
                    <div class="card-header">
                        Vybavenosť nehnuteľnosti
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label class="control-label">Vchodové dvere</label>
                                <select name="Data[vchodove_dvere]" class="form-control select-drop to-store" id="vchodove-dvere">
                                    <option value="0">Zvoľte typ vchodových dverí</option>
                                    <?php
                                    foreach($vchodove_dvere as $item) {
                                        echo "<option value={$item['id']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Značka</label>
                                <select
                                        name="Data[dvere_znacka][]"
                                        class="form-control select-drop to-store"
                                        id="frm-dvere-znacka"
                                        multiple
                                >
                                    <?php
                                    foreach ($znacka_dvere as $item) {
                                        echo "<option value={$item['nazov']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Podlaha</label>
                                <select class="form-control select-drop to-store" name="Data[podlaha][]" multiple="multiple" id="podlaha">
                                    <?php
                                    foreach ($podlaha as $item) {
                                        echo "<option value={$item['id']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Bezpečnostný systém</label>
                                <select class="form-control select-drop to-store" name="Data[bezp_system][]"
                                        multiple="multiple" id="bezp-sys">
                                    <?php
                                    foreach($bezpecnost as $item){
                                        echo "<option value={$item['id']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Zariadenosť objektu</label>
                                <select class="form-control select-drop to-store" name="Data[zariadenost]" id="zariadenost">
                                    <option value=0>Zvolte mieru zariadenosti</option>
                                    <?php
                                    foreach($zariadenost as $item) {
                                        echo "<option value={$item['id']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row height30">
                            <div class="col-md-12 form-group">
                                <input type="checkbox" name="Data[plyn]" value="1" id="dat-plyn" class="to-store">&nbsp;
                                <label class="control-label">Plyn</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Mesačné náklady na plyn</label>
                                <input
                                        type="text"
                                        class="form-control to-store"
                                        name="Data[naklady][plyn]"
                                        value="0"
                                        id="frm-plyn"
                                        disabled
                                >
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Dodávateľ</label>
                                <select
                                        class="form-control select-drop to-store"
                                        id="frm-plyn-znacka"
                                        name="Data[plyn_znacka][]"
                                        multiple
                                        disabled
                                >
                                    <?php
                                    foreach ($znacka_plyn as $item) {
                                        echo "<option value={$item['nazov']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row height30">
                            <div class="col-md-12 form-group">
                                <input
                                        type="checkbox"
                                        name="Data[elektrina_230_400]"
                                        value="1"
                                        id="dat-elektrina"
                                        class="to-store"
                                        checked
                                >&nbsp;
                                <label class="control-label">Elektrina 230V/400V</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Náklady (mes.) - elektrina</label>
                                <input
                                        type="text"
                                        class="form-control to-store"
                                        name="Data[naklady][elektrina]"
                                        value="0"
                                        id="frm-elektrina"
                                >
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Dodávateľ</label>
                                <select
                                        class="form-control select-drop to-store"
                                        name="Data[elektrina_znacka][]"
                                        id="frm-elektrina-znacka"
                                        multiple
                                >
                                    <?php
                                    foreach ($znacka_elektrina as $item) {
                                        echo "<option value={$item['nazov']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Ohrievanie vody</label>
                                <select class="form-control select-drop to-store" name="Data[ohrev_voda][]"
                                        multiple="multiple" id="ohrev-vody">
                                    <?php
                                    foreach ($ohrev_vody as $item) {
                                        echo "<option value={$item['id']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Vykurovanie</label>
                                <select class="form-control select-drop to-store" name="Data[vykurovanie][]"
                                        multiple="multiple" id="vykurovanie">
                                    <?php
                                    foreach ($vykurovanie as $item) {
                                        echo "<option value={$item['id']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Kúrenie</label>
                                <select name="Data[kurenie][]" class="form-control select-drop to-store" id="kurenie" multiple>
                                    <?php
                                    foreach($kurenie as $item) {
                                        echo "<option value={$item['id']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Mesačné náklady na kúrenie</label>
                                <input type="text" class="form-control to-store" name="Data[naklady][kurenie]" value="0" id="kurenie-nakl">
                            </div>
                        </div>

                        <div class="row height30">
                            <div class="col-md-12 form-group">
                                <input
                                        type="checkbox"
                                        name="Data[mest_voda]"
                                        value="1"
                                        class="to-store"
                                        id="dat-mestvoda"
                                        checked
                                >&nbsp;
                                <label class="control-label">Mestský vodovod</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Mesačné náklady na TÚV</label>
                                <input
                                        type="text"
                                        class="form-control to-store"
                                        name="Data[naklady][tuv]"
                                        value="0"
                                        id="frm-tuv"
                                >
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Mesačné náklady na SÚV</label>
                                <input
                                        type="text"
                                        class="form-control to-store"
                                        name="Data[naklady][suv]"
                                        value="0"
                                        id="frm-suv"
                                >
                            </div>
                        </div>

                        <div class="row height30">
                            <div class="col-md-6 form-group">
                                <input
                                        type="checkbox"
                                        name="Data[pevna_linka]"
                                        value="1"
                                        class="to-store"
                                        id="dat-pevnalinka"
                                >&nbsp;
                                <label class="control-label">Pevná linka</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input
                                        type="checkbox"
                                        name="Data[satelit]"
                                        value="1"
                                        class="to-store"
                                        id="dat-satelit"
                                >&nbsp;
                                <label class="control-label">Satelit</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label class="control-label">Mesačné nákl.</label>
                                <input
                                        type="text"
                                        class="form-control to-store"
                                        name="Data[naklady][pevna_linka]"
                                        value="0"
                                        id="frm-pevnalinka"
                                        disabled
                                >
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Dodávateľ</label>
                                <select
                                        class="form-control select-drop to-store"
                                        name="Data[pevna_linka_znacka][]"
                                        id="frm-pevnalinka-znacka"
                                        multiple
                                        disabled
                                >
                                    <?php
                                    foreach ($znacka_pevna_linka as $item) {
                                        echo "<option value={$item['nazov']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Mesačné nákl.</label>
                                <input
                                        type="text"
                                        class="form-control to-store"
                                        name="Data[naklady][satelit]"
                                        value="0"
                                        id="frm-satelit"
                                        disabled
                                >
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Dodávateľ</label>
                                <select
                                        class="form-control select-drop to-store"
                                        name="Data[satelit_znacka][]"
                                        id="frm-satelit-znacka"
                                        multiple
                                        disabled
                                >
                                    <?php
                                    foreach ($znacka_satelit as $item) {
                                        echo "<option value={$item['nazov']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row height30">
                            <div class="col-md-12 form-group">
                                <input
                                        type="checkbox"
                                        name="Data[kablova_televizia]"
                                        value="1"
                                        class="to-store"
                                        id="dat-tv"
                                >&nbsp;
                                <label class="control-label">Káblová televízia</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Mesačné náklady na káblovú televíziu</label>
                                <input
                                        type="text"
                                        class="form-control to-store"
                                        name="Data[naklady][tv]"
                                        value="0"
                                        id="frm-tv"
                                        disabled
                                >
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Dodávateľ</label>
                                <select
                                        class="form-control select-drop to-store"
                                        name="Data[znacka_tv][]"
                                        id="frm-tv-znacka"
                                        multiple
                                        disabled
                                >
                                    <?php
                                    foreach ($znacka_tv as $item) {
                                        echo "<option value={$item['nazov']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label class="control-label">Internet</label>
                                <select class="form-control select-drop to-store" name="Data[internet]" id="internet">
                                    <option value="">Zvoľte typ internetu</option>
                                    <?php
                                    foreach ($internet as $item) {
                                        echo "<option value={$item['id']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-1 form-group">
                                <label class="control-label">Rýchlosť (<i class="fas fa-arrow-down"></i>)</label>
                                <select class="form-control select-drop to-store" name="Data[inetspeed_down]" id="speed-down">
                                    <?php
                                    for($i=1;$i<=500;$i++) {
                                        echo "<option value={$i}>{$i}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-1 form-group">
                                <label class="control-label">Rýchlosť (<i class="fas fa-arrow-up"></i>)</label>
                                <select class="form-control select-drop to-store" name="Data[inetspeed_up]" id="speed-up">
                                    <?php
                                    for($i=1;$i<=50;$i++) {
                                        echo "<option value={$i}>{$i}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Mesačné náklady na internet</label>
                                <input type="text" class="form-control to-store" name="Data[naklady][internet]" value="0" id="net-nakl">
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="control-label">Dodávateľ</label>
                                <select class="form-control select-drop to-store" name="Data[internet_znacka][]" id="frm-internet-znacka">
                                    <option value="">Zvoľte alebo zadajte dodávateľa</option>
                                    <?php
                                    foreach ($znacka_internet as $item) {
                                        echo "<option value={$item['nazov']}>{$item['nazov']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <input
                                        type="checkbox"
                                        name="Data[jacuzzi]"
                                        value="1"
                                        id="dat-jacuzzi"
                                        class="to-store"
                                >
                                <label class="control-label">Jacuzzi</label>
                                <br>
                                <label class="control-label">Počet osôb</label>
                                <select
                                        name="Data[jacuzzi_pocet_osob]"
                                        class="form-control select-drop to-store"
                                        id="frm-jacuzzi"
                                        disabled
                                >
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
                                <label class="control-label">Terasa [m<sup>2</sup>]</label>
                                <input type="text" class="form-control to-store" value="0" name="Data[teras]" id="frm-terasa">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Balkón [m<sup>2</sup>]</label>
                                <input type="text" class="form-control to-store" value="0" name="Data[balkon]" id="frm-balkon">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Loggia [m<sup>2</sup>]</label>
                                <input type="text" class="form-control to-store" value="0" name="Data[loggia]" id="frm-loggia">
                            </div>
                            <div class="col-md-6 form-group">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Pivnica [m<sup>2</sup>]</label>
                                <input type="text" class="form-control to-store" value="0" name="Data[pivnica]" id="frm-pivnica">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Vínna pivnica [m<sup>2</sup>]</label>
                                <input type="text" class="form-control to-store" value="0" name="Data[vinna_pivnica]" id="frm-vinna-piv">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Chodba [m<sup>2</sup>]</label>
                                <input type="text" class="form-control to-store" value="0" name="Data[chodba]" id="frm-chodba">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Predsieň [m<sup>2</sup>]</label>
                                <input type="text" class="form-control to-store" value="0" name="Data[predsien]" id="frm-predsien">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Pivničná kôbka [m<sup>2</sup>]</label>
                                <input type="text" class="form-control to-store" value="0" name="Data[pivnicna_kobka]" id="frm-kobka">
                            </div>
                            <div class="col-md-6 form-group">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Kotolňa [m<sup>2</sup>]</label>
                                <input type="text" class="form-control to-store" value="0"  name="Data[kotolna]" id="frm-kotolna">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Komora [m<sup>2</sup>]</label>
                                <input type="text" class="form-control to-store" value="0"  name="Data[komora]" id="frm-komora">&nbsp;
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Práčovňa [m<sup>2</sup>]</label>
                                <input type="text" class="form-control to-store" value="0"  name="Data[pracovna]" id="frm-pracovna">&nbsp;
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[ventilator]" value="1" class="to-store" id="ventilator">&nbsp;
                                <label class="control-label">Ventilátor</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[klima]" value="1" id="klimatizacia" class="to-store">&nbsp;
                                <label class="control-label">Klimatizácia</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[akvarium]" value="1" id="akvarium" class="to-store">&nbsp;
                                <label class="control-label">Akvárium (vstavaný)</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[bar_pult]" value="1" id="bar-pult" class="to-store">
                                <label class="control-label">Barový pult</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[domace_kino]" value="1" class="to-store" id="domace-kino">&nbsp;
                                <label class="control-label">Domáce kino</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[fitnes_miest]" value="1" id="fitnes-miestnost" class="to-store">&nbsp;
                                <label class="control-label">Zariadený fitnes miestnosť</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[herne_automaty]" value="1" id="herne-automaty" class="to-store">&nbsp;
                                <label class="control-label">Herné automaty</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[biliard]" value="1" id="biliard" class="to-store">&nbsp;
                                <label class="control-label">Biliardový stôl</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[krb]" value="1" id="krb" class="to-store">&nbsp;
                                <label class="control-label">Krb</label>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[rekuperacia]" value="1" class="to-store" id="rekuperacia">&nbsp;
                                <label class="control-label">Rekuperácia</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="checkbox" name="Data[vytah]" value="1" class="to-store" id="vytah">
                                <label class="control-label">Výťah</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Naklady -->
                <div class="card">
                    <div class="card-header">
                        Iné náklady
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Náklady (roč.) - poistenie</label>
                                <input type="text" class="form-control to-store" name="Data[naklady][poistenie]" value="0" id="nakl-poist">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="control-label">Náklady (roč.) - dane spolu</label>
                                <input type="text" class="form-control to-store" name="Data[naklady][dane]" value="0" id="nakl-dan">
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
                                <textarea class="form-control to-store" name="Data[dalsi_popis]" id="dalsi-popis"></textarea>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="card">
                    <div class="form-actions">
                        <div class="card-body">
                            <button type="button" class="btn btn-info" onclick="returnBack('form-property-basic','<?= Url::to(['/contracts/new-majitelia','id'=>$_GET['id']])?>')"><i class="fa fa-arrow-circle-left"></i> Späť</button>
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
    $(document).ready(function(){
        restoreFormData('form-property-basic');  
    });
    
    $('#form-byt').submit(function(){
        var pocet_miest = $('#pocet-miestnosti').val();
        var pocet_kuchyn = $('#pocet-kuchyn').val();
        var pocet_kupelni = $('#pocet-kupelni').val();
        var return_val = true;
        
        if (pocet_miest == 0) {
            return_val = false;
            $('#pocet-miestnosti').addClass('is-invalid');
        }
        
        if (pocet_kuchyn == 0) {
            return_val = false;
            $('#pocet-kuchyn').addClass('is-invalid');
        }
        
        if (pocet_kupelni == 0) {
            return_val = false;
            $('#pocet-kupelni').addClass('is-invalid');
        }
        
        if (!return_val) {
            $.confirm({
                    title: 'Chyba',
                    content: 'Formulár obsahuje chyby!',
                    type:'red',
                    typeAnimated: true,
                    buttons: {
                        close: function () {
                        }
                    }
                });
        }
        
        return return_val;
    });

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
    $('#dat-plyn').on('click',function(){
        $('#frm-plyn').prop("disabled", !this.checked);
        $('#frm-plyn-znacka').prop("disabled", !this.checked);
    });
    $('#dat-elektrina').on('click',function(){
        $('#frm-elektrina').prop("disabled", !this.checked);
        $('#frm-elektrina-znacka').prop("disabled", !this.checked);
    });
    $('#dat-mestvoda').on('click',function(){
        $('#frm-tuv').prop("disabled", !this.checked);
        $('#frm-suv').prop("disabled", !this.checked);
    });
    $('#dat-jacuzzi').on('click',function(){
        $('#frm-jacuzzi').prop("disabled", !this.checked);
    });

    $('#dat-pevnalinka').on('click',function(){
        $('#frm-pevnalinka').prop("disabled", !this.checked);
        $('#frm-pevnalinka-znacka').prop("disabled", !this.checked);
    });
    
    $('#dat-satelit').on('click',function(){
        $('#frm-satelit').prop("disabled", !this.checked);
        $('#frm-satelit-znacka').prop("disabled", !this.checked);
    });

    $('#dat-tv').on('click',function(){
        $('#frm-tv').prop("disabled", !this.checked);
        $('#frm-tv-znacka').prop("disabled", !this.checked);
    });
    
    $('#strecha-typ').select2({
        theme: "bootstrap",
        placeholder: "Zvoľte typ strechy",
        tags: true
    });
    $('#strecha-material').select2({
        theme: "bootstrap",
        placeholder: "Zvoľte material strechy",
        tags: true
    });
    $('#strecha-izol').select2({
        theme: "bootstrap",
        placeholder: "Zvoľte izolaciu strechy",
        tags: true
    });
    $('#plot').select2({
        theme: "bootstrap",
        placeholder: "Zvoľte typ plotu",
        tags: true
    });
    $('#rok-kolaudacia').select2({
        theme: "bootstrap",
        placeholder: "Zvoľte rok kolaudácie",
        tags: true
    });
    
    $('#frm-plyn-znacka').select2({
        theme: "bootstrap",
        placeholder: "Zvoľte alebo zadajte dodávateľa plynu",
        tags: true
    });
    $('#stena-znacka').select2({
        theme: "bootstrap",
        placeholder: "Vyberte materiál steny",
        tags: true
    });
    $('#kurenie').select2({
        theme: "bootstrap",
        placeholder: "Vyberte typ kúrenia",
        tags: true
    });
    $('#frm-dvere-znacka').select2({
        theme: "bootstrap",
        placeholder: "Zvoľte značku vchodových dverí",
        tags: true
    });
    $('#vykurovanie').select2({
        theme: "bootstrap",
        placeholder: "Vyberte typ vykurovania",
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
    $("#frm-elektrina-znacka").select2({
        theme: "bootstrap",
        placeholder: "Zvoľte alebo zadajte dodávateľa elektriny",
        tags: true
    });
    $("#frm-pevnalinka-znacka").select2({
        theme: "bootstrap",
        placeholder: "Zvoľte alebo zadajte dodávateľa",
        tags: true
    });
    $("#frm-satelit-znacka").select2({
        theme: "bootstrap",
        placeholder: "Zvoľte alebo zadajte dodávateľa",
        tags: true
    });
    $("#frm-tv-znacka").select2({
        theme: "bootstrap",
        placeholder: "Zvoľte alebo zadajte dodávateľa",
        tags: true
    });
    $("#frm-internet-znacka").select2({
        theme: "bootstrap",
        tags: true
    });
     
    $("#frm-elektrina").on('click',function(){
       $(this).val(''); 
    }).on('blur',function(){
        var val = $(this).val();
        if (val == 0 || val == '') {
            $(this).val(0);
        }
    });
    
    $("#frm-plyn").on('click',function(){
       $(this).val(''); 
    }).on('blur',function(){
        var val = $(this).val();
        if (val == 0 || val == '') {
            $(this).val(0);
        }
    });
    
    $("#kurenie-nakl").on('click',function(){
       $(this).val(''); 
    }).on('blur',function(){
        var val = $(this).val();
        if (val == 0 || val == '') {
            $(this).val(0);
        }
    });
    
    $("#frm-tuv").on('click',function(){
       $(this).val(''); 
    }).on('blur',function(){
        var val = $(this).val();
        if (val == 0 || val == '') {
            $(this).val(0);
        }
    });
    
    $("#frm-suv").on('click',function(){
       $(this).val(''); 
    }).on('blur',function(){
        var val = $(this).val();
        if (val == 0 || val == '') {
            $(this).val(0);
        }
    });
    
    $("#frm-pevnalinka").on('click',function(){
       $(this).val(''); 
    }).on('blur',function(){
        var val = $(this).val();
        if (val == 0 || val == '') {
            $(this).val(0);
        }
    });
    
    $("#frm-satelit").on('click',function(){
       $(this).val(''); 
    }).on('blur',function(){
        var val = $(this).val();
        if (val == 0 || val == '') {
            $(this).val(0);
        }
    });
    
    $("#frm-tv").on('click',function(){
       $(this).val(''); 
    }).on('blur',function(){
        var val = $(this).val();
        if (val == 0 || val == '') {
            $(this).val(0);
        }
    });
   
    $("#net-nakl").on('click',function(){
       $(this).val(''); 
    }).on('blur',function(){
        var val = $(this).val();
        if (val == 0 || val == '') {
            $(this).val(0);
        }
    });
    
    $("#frm-terasa").on('click',function(){
       $(this).val(''); 
    }).on('blur',function(){
        var val = $(this).val();
        if (val == 0 || val == '') {
            $(this).val(0);
        }
    });
    
    $("#frm-balkon").on('click',function(){
       $(this).val(''); 
    }).on('blur',function(){
        var val = $(this).val();
        if (val == 0 || val == '') {
            $(this).val(0);
        }
    });
    $("#frm-pivnica").on('click',function(){
       $(this).val(''); 
    }).on('blur',function(){
        var val = $(this).val();
        if (val == 0 || val == '') {
            $(this).val(0);
        }
    });
    $("#frm-vinna-piv").on('click',function(){
       $(this).val(''); 
    }).on('blur',function(){
        var val = $(this).val();
        if (val == 0 || val == '') {
            $(this).val(0);
        }
    });
    $("#frm-chodba").on('click',function(){
       $(this).val(''); 
    }).on('blur',function(){
        var val = $(this).val();
        if (val == 0 || val == '') {
            $(this).val(0);
        }
    });
    $("#frm-predsien").on('click',function(){
       $(this).val(''); 
    }).on('blur',function(){
        var val = $(this).val();
        if (val == 0 || val == '') {
            $(this).val(0);
        }
    });
    $("#frm-kobka").on('click',function(){
       $(this).val(''); 
    }).on('blur',function(){
        var val = $(this).val();
        if (val == 0 || val == '') {
            $(this).val(0);
        }
    });
    $("#frm-kotolna").on('click',function(){
       $(this).val(''); 
    }).on('blur',function(){
        var val = $(this).val();
        if (val == 0 || val == '') {
            $(this).val(0);
        }
    });
    $("#frm-komora").on('click',function(){
       $(this).val(''); 
    }).on('blur',function(){
        var val = $(this).val();
        if (val == 0 || val == '') {
            $(this).val(0);
        }
    });
    $("#frm-pracovna").on('click',function(){
       $(this).val(''); 
    }).on('blur',function(){
        var val = $(this).val();
        if (val == 0 || val == '') {
            $(this).val(0);
        }
    });
    $("#nakl-poist").on('click',function(){
       $(this).val(''); 
    }).on('blur',function(){
        var val = $(this).val();
        if (val == 0 || val == '') {
            $(this).val(0);
        }
    });
    $("#nakl-dan").on('click',function(){
       $(this).val(''); 
    }).on('blur',function(){
        var val = $(this).val();
        if (val == 0 || val == '') {
            $(this).val(0);
        }
    });
    $("#frm-loggia").on('click',function(){
       $(this).val(''); 
    }).on('blur',function(){
        var val = $(this).val();
        if (val == 0 || val == '') {
            $(this).val(0);
        }
    });
    
JS;

$this->registerJS($js);
?>
