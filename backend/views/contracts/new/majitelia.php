<?php
use yii\helpers\Url;
use backend\assets\RealAsset;
$this->title="Nová zákazka";

$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css',['depends'=>RealAsset::className()]);
$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css',['depends'=>RealAsset::className()]);
$this->registerJSFile('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.full.min.js',['depends'=>RealAsset::className()]);
$this->registerCSSFile('https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.1/jquery-confirm.min.css',['depends'=>RealAsset::className()]);
$this->registerJSFile('https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.1/jquery-confirm.min.js',['depends'=>RealAsset::className()]);
$this->registerJSFile('@web/assets/node_modules/jqueryui/jquery-ui.min.js',['depends'=>RealAsset::className()]);
$this->registerCSSFile('@web/assets/node_modules/jqueryui/jquery-ui.min.css',['depends'=>RealAsset::className()]);
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
            <form action="<?=Url::to(['contracts/save-majitelia'])?>" method="post" id="form-majitelia">
                <input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
                <input type="hidden" name="Data[zmluva_id]" value="<?=$_GET['id']?>">

                <?php
                    if ($cislo_byt != -1) {
                        $pocetMajitelov = count($byt['MAJITEL']);
                    }
                    $zobraz = false;
                    for($i=1; $i<= 30; $i++) {

                        if ($cislo_byt == -1 && $i == 1) {
                            $zobraz = true;
                        } elseif ($cislo_byt <> -1 && $i <= $pocetMajitelov) {
                            $zobraz = true;
                        } else {
                            $zobraz = false;
                        }

                        echo $this->render('majitel-item',[
                            'titul_pred'    => $titul_pred,
                            'titul_za'      => $titul_za,
                            'i'             => $i,
                            'zobraz'        => $zobraz,
                            'majitel'       => $zobraz ? $byt['MAJITEL'][$i-1] : [],
							'predvolby'		=> $predvolby,
                            'pocet_majitelov' => $pocetMajitelov,
                            'uto'           => $uto
                        ]);
                    }
                ?>

                <div class="card">
                    <div class="form-actions">
                        <div class="card-body">
                            <button type="button" class="btn btn-info" onclick="returnBack('form-majitel','<?= Url::to(['/contracts/property-info','id'=>$_GET['id']])?>')"><i class="fa fa-arrow-circle-left"></i> Späť</button>
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

$js = <<< JS

    $(document).ready(function(){
        restoreFormData('form-majitel');  
    });
    
    $("#form-majitelia").submit(function(){
        var return_val = true;
        $('.customers').each(function(i, obj) {
            if ($(obj).css('display') != 'none'){
                var id = $(obj).data('id');
                var telefon = $('#telefon-'+id).val();
                if (telefon == '') {
                    $('#telefon-'+id).addClass("is-invalid");
                    return_val = false;
                }
            }
        });
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
    
    var dialog, form;

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
    
    pridat_op = function(id) {
        dialog = $( "#dialog-" + id ).dialog({
            height: 300,
            width: 400,
            modal: true,
            buttons: [{
                    id: "btn-"+id,
                    text: "Nahrať",
                    click: function() {
                        uploadOPFiles(id)
                    }  
                },
                {
                    text: "Zrušiť",
                    id: "btn-cancel-"+id,
                    click: function() {
                        $(this).dialog("close");
                    }
            }]
        });
        return false;
    }
    
    uploadOPFiles = function(id){
        
        $("#dfrm-"+id).hide();
        $("#spin-"+id).show();
        dialog.dialog('widget').find('.ui-dialog-buttonpane').hide();
        
        var data = new FormData();
        
        data.append("op-predna",$("#op-predna-"+id)[0].files[0]);
        data.append("op-zadna",$("#op-zadna-"+id)[0].files[0]);
        data.append("poradie",id);
        data.append("zmluva_id",{$_GET['id']});
       
        $.ajax({
                url : "/backoffice/ajax/nahraj-op",
                type : 'POST',
                data : data,
                contentType : false,
                processData : false,
                success: function(resp) {
                    $("#dfrm-"+id).show();
                    $("#spin-"+id).hide();
                    dialog.dialog('widget').find('.ui-dialog-buttonpane').show();
                    dialog.dialog('close');
                    $("#meno-zakaznika-"+id).val(resp.items.meno);
                    $("#rodne-priezvisko-"+id).val(resp.items.rodne_priezvisko);
                    $("#op-ulica-"+id).val(resp.items.ulica);
                    $("#rodne-cislo-"+id).val(resp.items.rodne_cislo);
                    $("#datum-narodenia-"+id).val(resp.items.datum_narodenia);
                    $("#priezvisko-"+id).empty().append($('<option></option>',{value:resp.items.priezvisko, text:resp.items.priezvisko}));
                    if (resp.items.titul_pred_id != 0) {
                        $("#deg-before-"+id).empty().append($('<option></option>',{value:resp.items.titul_pred_id, text:resp.items.titul_pred}));
                    }
                    if (resp.items.titul_za_id != 0) {
                        $("#deg-after-"+id).empty().append($('<option></option>',{value:resp.items.titul_za_id, text:resp.items.titul_za}));
                    }
                    
                    $("#gender-"+id+" option:eq("+resp.items.sex+")").prop("selected",true);
                    $("#gender-"+id+" option[value="+resp.items.sex+"]").attr("selected","selected");
                    $("#obec-"+id).empty().append($('<option></option>',{value:resp.items.mesto, text:resp.items.mesto}));
                    $("#zip-"+id).empty().append($('<option></option>',{value:resp.items.psc, text:resp.items.psc}));
                    $("#op-note-"+ id).val(resp.items[0].note);
                }
            });
    }
    
    zmen_zakaznika = function(j)
    {
        var typ = $("#zmen-zakaznika-"+j+" :selected").val();
        if (typ == 'firma' || typ == 'szco') {
            $("#rc-osoba-"+j).hide();
            $("#rc-osoba-gender-"+j).hide();
            $("#obch-meno-"+j).show();
            $("#ico-box-"+j).show();
            $("#dph-box-"+j).show();
        } else {
            $("#rc-osoba-"+j).show();
            $("#rc-osoba-gender-"+j).hide();
            $("#obch-meno-"+j).hide();
            $("#ico-box-"+j).hide();
            $("#dph-box-"+j).hide();
        }
    }

    rodne_cislo= function(i)
    {
        let rodnecislo = $('#rodne-cislo-'+i).val();
        let dlzka_rc = rodnecislo.length;
        let datum = $('#datum-narodenia-'+i).val();
       
       if(dlzka_rc >= 9 && datum == '') {
           var datum_narodenia = ((rodnecislo[0] == 0 && dlzka_rc > 9) ? "20" : "19");
           var rok = rodnecislo.substring(0,2);
           var mesiac = rodnecislo.substring(2,4);
           var den = rodnecislo.substring(4,6);
           
           if (mesiac>50) {
               mesiac -= 50;
           }
           
           mesiac = String(mesiac);
           den = String(den);
           
           datum_narodenia += rok + "-" + (mesiac.length == 1 ? ("0"+mesiac) : mesiac ) + "-" + (den.length == 1 ? ("0"+den) : den);
           
           $('#datum-narodenia-'+i).val(datum_narodenia);
       }
    }
    
    displayCustomer=function(j)
    {
        $("#customer-"+j).show();
    }
JS;

$this->registerJS($js);

?>

<?php
for($i=1; $i <= 20; $i++):
?>
<div id="dialog-<?= $i ?>" title="Občiansky preukaz majiteľa č. <?= $i ?>" style="display: none">

    <div id="spin-<?= $i ?>" style="display:none; text-align: center" class="mt-2">
        <div style="font-size: 2rem; font-weight: bold">Spracovávam nahraté dokumenty...</div>
        <img src="<?= Yii::getAlias('@web')?>/assets/images/loader.gif?v=1" class="ml-auto; mt-4">
    </div>

    <div id="dfrm-<?= $i ?>">
        <form enctype="multipart/form-data" id="frm-<?= $i ?>" method="post">
            <div class="row">
                <div class="col-sm-12 mb-3 mt-2">
                    <label for="op-predna" class="form-control-label">Predná strana</label>
                    <input type="file" name="op_predna" id="op-predna-<?= $i ?>" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <label for="op-zadna" class="form-control-label">Zadná strana</label>
                    <input type="file" name="op_zadna" id="op-zadna-<?= $i ?>" class="form-control">
                </div>
            </div>
        </form>
    </div>
</div>
<?php
endfor;
?>


