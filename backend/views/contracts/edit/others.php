<?php

use common\models\ZmluvaUcel;
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

    <div class="form-row">
        <div class="col-lg-12">
            <form action="<?=Url::to(['contracts/save-others'])?>" method="post">
                <input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
                <input type="hidden" name="Data[zmluva_id]" value="<?=$_GET['id']?>">

                <div class="card">
                    <div class="card-body">

                        <div class="form-row">
                            <!--
                                standard = nevyhradny - neurcita, urcita
                                exclusive = vyhradny - urcita
                                ki kell tolteni a honapo
                            -->
                            <div class="col-md-4 form-group">
                                <label class="control-label">Typ zmluvy</label>
                                <select class="form-control select-drop" name="Data[zmluva_typ]" id="contract-type">
                                    <option value="">-- Zvoľte typ zmluvy --</option>
                                    <option value="standard">Štandardná</option>
                                    <option value="exclusive">Exkluzívna</option>
                                </select>
                            </div>

                            <div class="col-md-4 form-group">
                                <label class="control-label">Doba</label>
                                <select class="form-control select-drop" name="Data[zmluva_platnost]" id="contract-time">
                                    <option value="">-- Zvoľte typ zmluvy --</option>
                                    <option value="1">Neurčitá</option>
                                    <option value="2">Určitá</option>
                                </select>
                            </div>

                            <div class="col-md-2 form-group">
                                <label class="control-label">Platnosť od</label>
                                <?php
                                    $datumOd = (new DateTimeImmutable('now'))->format("Y-m-d");
                                ?>
                                <input type="date" class="form-control" name="Data[platnost_od]" id="platnost-mesiace-od" value="<?= $datumOd?>">
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">Platnosť do</label>
                                <input type="date" class="form-control" name="Data[platnost_do]" disabled id="platnost-mesiace-do">
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="col-md-4 form-group">
                                <label class="control-label">Zdielať</label>
                                <select class="form-control select-drop" name="Data[social_media][]" multiple="multiple" id="social-media-share">
                                    <option value="0">Na všetkých soc. sieťach</option>
                                    <?php
                                        foreach ($socialne_siete as $item) {
                                            echo "<option value={$item['id']}>{$item['nazov']}</option>";
                                        }
                                    ?>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-3 form-group">
                                <input type="checkbox" name="Data[zobr_na_web]" value="1" checked>&nbsp;
                                <label>Zobraziť na webe</label>
                            </div>

                            <div class="col-md-3 form-group">
                                <input type="checkbox" name="Data[prioritne]" value="1">&nbsp;
                                <label>Prioritna na webe</label>
                            </div>

                            <div class="col-md-3 form-group">
                                <input type="checkbox" name="Data[top_ponuka]" value="1">&nbsp;
                                <label>Top ponuka</label>
                            </div>

                        </div>

                            <div class="form-row">
                                <div class="col-md-3 form-group">
                                    <input type="checkbox" name="Data[pravne_sluzby]" value="1" checked>
                                    <label class="control-label">Právne služby</label>
                                    <?php
                                    if (Yii::$app->user->identity->hasRole('admin')) {
                                        ?>
                                        <br>
                                        <label class="control-label">Cena za právne služby</label>
                                        <input type="text" name="Data[pravne_sluzby_cena]" class="form-control"
                                               value="0">
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-md-3 form-group">
                                    <input type="checkbox" name="Data[reklama]" value="1" checked>
                                    <label class="control-label">Reklama</label>
                                    <?php
                                    if (Yii::$app->user->identity->hasRole('admin')) {
                                    ?>
                                    <br>
                                    <label class="control-label">Náklady na reklamu</label>
                                    <input type="text" name="Data[reklama_cena]" class="form-control" value="0">
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-md-3 form-group">
                                    <input type="checkbox" name="Data[cestovne]" value="1" checked>&nbsp;
                                    <label class="control-label">Cestovné na obhliadky</label>
                                    <?php
                                    if (Yii::$app->user->identity->hasRole('admin')) {
                                    ?>
                                    <br>
                                    <label class="control-label">Výška cestovného</label>
                                    <input type="text" name="Data[cestovne_cena]" class="form-control" value="0">
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-md-3 form-group">
                                    <input type="checkbox" name="Data[spravne_popl]" value="1" checked>&nbsp;
                                    <label class="control-label">Správne poplatky</label>
                                    <?php
                                    if (Yii::$app->user->identity->hasRole('admin')) {
                                    ?>
                                    <br>
                                    <label class="control-label">Výška poplatkov</label>
                                    <input type="text" name="Data[spravne_popl_cena]" class="form-control" value="0">
                                        <?php
                                    }
                                    ?>
                                </div>

                            </div>
                        <div class="form-row">
                            <div class="col-md-1 form-group">
                                <input type="checkbox" name="Data[sluzby_ine]" value="1" id="ine-check">&nbsp;
                                <label class="control-label">Iné</label>
                            </div>
                            <div class="col-md-11 form-group">
                                <input type="text" id="ine-popis" name="Data[sluzby_ine_popis]" class="form-control" disabled placeholder="popis oddeľte čiarkami">
                            </div>
                        </div>

                        <?php
                        if (Yii::$app->user->identity->hasRole('admin')) {
                            ?>
                            <div class="form-row">
                                <div class="col-md-6 form-group">
                                    <label class="control-label">Náklady na iné položky</label>
                                    <input type="text" name="Data[sluzby_ine_cena]" class="form-control" value="0">
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                </div>

                <div class="card">
                    <div class="card-body">

                        <div class="form-row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Účel</label>
                                <select class="form-control select-drop" name="Data[ucel][]" multiple="multiple" id="ucel">
                                    <?php
                                    foreach($contract_type as $type) {
                                        echo "<option value={$type['id']}>{$type['name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row" id="prevod-podm" style="display:none">
                                <div class="col-md-12 form-group">
                                    <label class="control-label">Prevod nehnuteľnosti je podmienený</label>
                                    <select class="form-control select-drop" multiple id="podmienka-prevod" name="Data[podmienka_prevod][]">
                                        <?php
                                        foreach($predaj_podmienky as $item) {
                                            echo "<option value='{$item['nazov']}'>{$item['nazov']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                        </div>

                        <div class="row" id="prevod" style="display: none">
                            <div class="col-md-4 form-group">
                                <label class="control-label">Orientačná kúpna cena nehnutelnosti</label>
                                <input type="text" class="form-control" name="Data[kupna_cena]" value="0" id="kupna-cena">
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">Typ provízie z predaja</label>
                                <select name="Data[predaj_provizia_typ]" class="form-control select-drop" id="predaj-provizia-typ">
                                    <option value="">-- Zvolte typ provizie --</option>
                                    <option value="percento">Percento</option>
                                    <option value="pausal">Paušálne</option>
                                </select>
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">Hodnota provizie</label>
                                <input type="text" class="form-control" name="Data[predaj_percento]" value="" id="predaj-provizia-percento">
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">Provizia</label>
                                <input type="text" class="form-control" name="Data[predaj_provizia]" value="0" id="predaj-provizia">
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">Zľava z ceny predaja (%)</label>
                                <input type="text" class="form-control" name="Data[predaj_zlava]" id="predaj-zlava">
                                <span style="color: #0b67cd; display: none" id="predaj-zlava-suma">Orientacna cena: 100 000 eur</span>
                            </div>
                        </div>

                        <div class="row" id="prenaj-podm" style="display: none">
                            <div class="col-md-12 form-group">
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

                        <div class="row" id="prenaj" style="display: none">
                            <div class="col-md-4 form-group">
                                <label class="control-label">Orientačná výška nájomného</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        name="Data[prenajom_cena]"
                                        value="0"
                                        id="prenajom-cena"
                                        data-proviperc = "<?= $prenajom_provizia['provizia_percento'] ?>"
                                        data-minprovi = "<?= $prenajom_provizia['min_provizia'] ?>"
                                >
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="control-label">Provizia</label>
                                <input type="text" class="form-control" name="Data[prenajom_provizia]" value="0" id="prenajom-provizia">
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="control-label">Zľava z ceny prenajmu (%)</label>
                                <input type="text" class="form-control" name="Data[prenajom_zlava]" id="prenaj-zlava">
                                <span style="color: #0b67cd; display: none" id="prenaj-zlava-suma"></span>
                            </div>

                        </div>

                        <div class="row" id="ine" style="display: none">
                            <div class="col-md-2 form-group">
                                <label class="control-label">Iné - text</label>
                                <input type="text" class="form-control" name="Data[c_text]" value="">
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">Iné - cena</label>
                                <input type="text" class="form-control" name="Data[ine_cena]" value="0" id="ine-cena">
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">Typ provízie z iné</label>
                                <select name="Data[ine_provizia_typ]" class="form-control select-drop" id="ine-provizia-typ">
                                    <option value="percento">Percento</option>
                                    <option value="pausal">Paušálne</option>
                                </select>
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">Hodnota provizie</label>
                                <select class="form-control select-drop" name="Data[ine_percento]" id="ine-provizia-percento" >
                                    <option value="0">-- Zvolte percento --</option>
                                    <?php
                                    for($i=3; $i<11; $i++) {
                                        echo "<option value={$i}>{$i}%</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="control-label">Hodnota</label>
                                <input type="text" class="form-control" name="Data[ine_provizia]" value="0" id="ine-provizia">
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

$predajProvivizia = json_encode($predaj_provizia);

$js = <<<JS
    
    var predaj_provizia = {$predajProvivizia};

    $("#prenaj-zlava").on('blur',function(){
       var zlava = $(this).val();
       var cena = $('#prenajom-cena').val();
       
       $('#prenaj-zlava-suma').html('Orient. cena: ' + (cena*(100-zlava)/100) + ' eur').show();
    });
    
    $("#predaj-zlava").on('blur',function(){
       var zlava = $(this).val();
       var cena = $('#kupna-cena').val();
       $('#predaj-zlava-suma').html('Orient. cena: ' + (cena*(100-zlava)/100) + ' eur').show();
    });

    hideAllComissionFields = function()
    {
        $('#prevod-podm').hide();
        $('#prevod').hide();
        $('#prenaj-podm').hide();
        $('#prenaj').hide();
        $('#ine').hide();
    }

    $('#ucel').on('select2:select',function(){
        var ucel = $(this).val();
        if (ucel.length == 0) {
            hideAllComissionFields();
            return false;
        }
        ucel.forEach(function(val,key){
            if (val == 1) {
                // zapni predaj
                $('#prevod-podm').show();
                $('#prevod').show();
            }
            if (val == 2) {
                // zapni prenajom
                $('#prenaj-podm').show();
                $('#prenaj').show();
            }
        });
        $('#ine').show();
    });

    $('#ucel').on('select2:unselect',function(){
        var ucel = $(this).val();
        if (ucel.length == 0) {
            hideAllComissionFields();
            return false;
        }
        if(ucel.includes('1') == false) {
             $('#prevod-podm').hide();
             $('#prevod').hide();
        }
        if(ucel.includes('2') == false) {
             $('#prenaj-podm').hide();
             $('#prenaj').hide();
        }
    });

    $('#ucel').select2({
        theme: "bootstrap",
        placeholder: "Zvoľte účel zákazky"
    });
    
    $('#podmienka-prevod').select2({
        theme: "bootstrap",
        //placeholder: "Vyberte podmienku prevodu",
        tags: true
    });
    
    $('#podmienka-prenajom').select2({
        theme: "bootstrap",
        //placeholder: "Vyberte podmienku prenájmu",
        tags: true
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
    
    $('#social-media-share').select2({
        theme: "bootstrap",
        placeholder: "Zvolte sociálne média"
    });

    // predaj

    getIndexForSalesComission = function(amt)
    {
        for(i=0;i<predaj_provizia.length;i++) {
            var cena_od = parseFloat(predaj_provizia[i]['cena_od']);
            var cena_do = parseFloat(predaj_provizia[i]['cena_do']);
            if ( 
                (isNaN(cena_od) && amt <= cena_do) || 
                (cena_od <= amt && cena_do >= amt) ||
                (isNaN(cena_do) && cena_od <= amt)
            ) {
                return i;
            }
        }
    }

    $('#predaj-provizia-typ').on('change',function () {
       var provizia_typ = $(this).val();
       var cena = $('#kupna-cena').val();
       
       if (provizia_typ == 'percento') {
           $('#predaj-provizia-percento').prop('disabled', false);
           var idx = getIndexForSalesComission(cena);
           var percento = predaj_provizia[idx]['provizia'];
           $('#predaj-provizia-percento').val(percento);
           var provizia = cena * percento / 100;
           if (provizia < predaj_provizia[idx]['min_provizia']) {
               $('#predaj-provizia-typ [value="provizia"]').attr('selected',true);
               $('#predaj-provizia').val(predaj_provizia[idx]['min_provizia']);
           } else {
               $('#predaj-provizia').val(provizia);
           }
       } else {
           $('#predaj-provizia-percento').prop('disabled', true);
       }
    });

    $('#predaj-provizia-percento').on('change',function () {
        
        var cena = $('#kupna-cena').val();
        var percento = $(this).val();
        
        var provizia = spocitajProviziu(cena, percento);
        $('#predaj-provizia').val(provizia);
    });

    $('#kupna-cena').on('blur',function(){
        var cena = $(this).val();
        if (cena == '') {
            $(this).val(0);
        }
        $('#predaj-provizia-typ').trigger('change');
    });
    
    $("#kupna-cena").on('click',function(){
       $(this).val(''); 
    });

    // prenajom

    $('#prenajom-cena').on('blur',function(){
        var cena = $(this).val();
        if (cena == '') {
            $(this).val(0);
        }
        var percento = $(this).data('proviperc');
        var min_provizia = $(this).data('minprovi');
        var provizia = cena * (percento/100);
        
        $('#prenajom-provizia').val((provizia<min_provizia)?min_provizia:provizia);
        if ($('#prenaj-zlava').val() != '') {
            $("#prenaj-zlava").trigger('blur');
        }
    });

    // ine * vypocet provizie
    
    spocitajProviziu = function(cena, percento) {
        var hasComma = cena.includes(",");
        if (!hasComma) {
            cena = cena.trim().replace(" ", "");
            return cena * percento / 100;    
        } else {
            var res = cena.split(",");
            var provizie = "";
            var i=0;
            $.each(res,function(k,v){
                provizie += ((i>0) ? ", " : "") + parseFloat(v.trim().replace(" ",""))*percento/100;
                i++;
            });
            return provizie;
        }
    }

    $('#ine-provizia-typ').on('change',function () {
        var provizia = $(this).val();
        if (provizia == 'pausal') {
            $('#ine-provizia-percento').prop('disabled', true);
        } else {
            $('#ine-provizia-percento').prop('disabled', false);
        }
    });

    $('#ine-provizia-percento').on('change',function () {
        var cena = $('#ine-cena').val();
        var percento = $(this).val();
        var provizia = spocitajProviziu(cena, percento);
        $('#ine-provizia').val(provizia);
    });

    $('#ine-cena').on('blur',function(){
        var cena = $(this).val();
        if (cena == '') {
            $(this).val(0);
        }
        var percento = $('#ine-provizia-percento').val();
        var provizia = spocitajProviziu(cena, percento);
        $('#ine-provizia').val(provizia);
    });
    
    $("#ine-cena").on('click',function(){
       $(this).val(''); 
    });
    
    $('#ine-check').on('click', function(){
        if( $('#ine-popis').attr("disabled") ) {
            $('#ine-popis').attr("disabled",false);
            $('#ine-popis').attr("placeholder","");
        } else {
            $('#ine-popis').attr("disabled",true);
            $('#ine-popis').attr("placeholder", "popis oddeľte čiarkami");
        }
    });

    $("#contract-type").on('change',function(){
        var contractType = $(this).find('option:selected').val();

        if (contractType == 'standard') {
            $('#contract-time option[value="1"]').prop("selected","selected");
            $('#platnost-mesiace-do').prop('disabled',true);
            $('#platnost-mesiace-do').val('');

            if ($("#contract-time option[value='1']").length == 0) {
               $('#contract-time')
                    .empty()
                    .append('<option value="">-- Zvoľte typ zmluvy --</option>')
                    .append('<option value="1">Neurčitá</option>')
                    .append('<option value="2">Určitá</option>');
            }
        } else if (contractType == 'exclusive') {
            $('#platnost-mesiace-do').prop("disabled",false);
            $('#contract-time option[value="2"]').prop("selected","selected");
            $('#contract-time option[value="1"]').remove();
            $('#contract-time option[value=""]').remove();
        } else {
             $('#contract-time')
                    .empty()
                    .append('<option value="">-- Zvoľte typ zmluvy --</option>')
                    .append('<option value="1">Neurčitá</option>')
                    .append('<option value="2">Určitá</option>');
        }
    });

    $('#contract-time').on('change',function(){
        var option = $('#contract-time option:selected').val();
        if (option == 2) {
            $('#platnost-mesiace-do').prop("disabled",false);
        } else {
            $('#platnost-mesiace-do').prop("disabled",true);
        }
    });
JS;

$this->registerJS($js);
?>
