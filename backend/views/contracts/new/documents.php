<?php
use yii\helpers\Url;
use common\models\NehnutelnostDokumenty;
use common\models\documents\DocType;
use common\models\NehnutKategoria;

$this->title="Dokumenty";
?>
    <div class="container-fluid">

        <div class="row page-titles">
            <div class="col-md-12 align-self-center">
                <h4 class="text-themecolor"><?= $this->title ?> - zákazka č. <?= $contract->cislo?></h4>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <button class="btn btn-success" id="doc-gen-all">Vygeneruj dokumenty</button>
                        <a href="<?= Url::to(['/contracts/contract-done']) ?>" class="btn btn-dark">Dokončiť</a>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <?php
                                $today = (new DateTime())->format("Y-m-d");
                            ?>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="5%">Poradie</th>
                                        <th width="50%">Názov dokumentu</th>
                                        <th width="10%">Dátum</th>
                                        <th width="10%">Miesto podpisu</th>
                                        <th>Akcie</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            Pracovný list / Náborový list
                                            <?php
                                                $nabor = "";
                                                if ($kategoria == NehnutKategoria::BYT) {
                                                    $nabor = DocType::NABOR_BYT;
                                                } else if ($kategoria == NehnutKategoria::DOM) {
                                                    $nabor = DocType::NABOR_DOM;
                                                }
                                            ?>
                                            <input type="hidden" class="doc-gen" data-id="<?= $nabor ?>" data-poradie="1">
                                        </td>
                                        <td><input type="date" value="<?= $today ?>" id="<?= $nabor ?>-datum-1"></td>
                                        <td></td>
                                        <td>
                                            <?php
                                                $exists = NehnutelnostDokumenty::exists($contract->cislo,DocType::NABOR_BYT) || NehnutelnostDokumenty::exists($contract->cislo,DocType::NABOR_DOM);
                                            ?>
                                            <a href="#" target="_blank" class="btn btn-info" id="url-<?= $nabor ?>-1"<?= !$exists ? ' style="display:none"' : ""?>><i class="fa fa-download"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>
                                            Zmluva o sprostredkovaní
                                            <?php
                                            $predZmluva = "";
                                            if ($kategoria == NehnutKategoria::BYT) {
                                                $predZmluva = DocType::PREDZMLUVA_BYT;
                                            } else if ($kategoria == NehnutKategoria::DOM) {
                                                $predZmluva = DocType::PREDZMLUVA_DOM;
                                            }
                                            ?>
                                            <input type="hidden" class="doc-gen" data-id="<?= $predZmluva ?>" data-poradie="1">
                                        </td>
                                        <td><input type="date" value="<?= $today ?>" id="<?= $predZmluva ?>-datum-1"></td>
                                        <td><input type="text" id="<?= $predZmluva ?>-podpis-1"></td>
                                        <td>
                                            <?php
                                            $exists = NehnutelnostDokumenty::exists($contract->cislo,DocType::PREDZMLUVA_BYT) || NehnutelnostDokumenty::exists($contract->cislo,DocType::PREDZMLUVA_DOM);
                                            ?>
                                            <a href="#" target="_blank" class="btn btn-info" id="url-<?= $predZmluva ?>-1"<?= !$exists ? ' style="display:none"' : ""?>><i class="fa fa-download"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                    for ($i=0; $i < $pocet_zakaznikov; $i++) {
                                        ?>
                                        <tr>
                                            <td><?= $i+3 ?></td>
                                            <td>
                                                Súhlas so spracovanim osobných údajov
                                                <input
                                                        type="hidden"
                                                        class="doc-gen"
                                                        data-id="<?= DocType::SUHLAS_OSOBNE_UDAJE ?>"
                                                        data-poradie="<?= $i+1 ?>"
                                                >
                                            </td>
                                            <td><input type="date" value="<?= $today ?>" id="<?= DocType::SUHLAS_OSOBNE_UDAJE ?>-datum-<?= $i+1 ?>"></td>
                                            <td><input type="text" id="<?= DocType::SUHLAS_OSOBNE_UDAJE ?>-podpis-<?= $i+1 ?>"></td>
                                            <td>
                                                <?php
                                                $exists = NehnutelnostDokumenty::exists($contract->cislo, DocType::SUHLAS_OSOBNE_UDAJE);
                                                ?>
                                                <a
                                                        href="#"
                                                        target="_blank"
                                                        class="btn btn-info"<?= $exists == false ? ' style="display:none"' : ""?>
                                                        id="url-<?= DocType::SUHLAS_OSOBNE_UDAJE ?>-<?= $i+1 ?>"
                                                >
                                                    <i class="fa fa-download"></i>
                                                </a>
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
        </div>
    </div>
<?php
$url = Url::to(['/contracts/ajax-gen-docs']);
$num = $contract->cislo;

$js = '
    $("#doc-gen-all").on("click",function(){   
       var dokumenty = [];
      
       $(".doc-gen").each(function(){
            var datum = "#" + $(this).data("id") + "-datum-" + $(this).data("poradie");
            var podpis = "#" + $(this).data("id") + "-podpis-" + $(this).data("poradie");
            var podpisData = $(podpis).val() == undefined ? "" : $(podpis).val();
            dokumenty.push({"doc":$(this).data("id"),"poradie":$(this).data("poradie"),"datum":$(datum).val(),"podpis":podpisData});
       });
       
       // make from array a JSON string
       dokumenty = JSON.stringify(dokumenty);
       
       $.ajax({
            url: "'.$url.'",
            dataType: "json",
            data: {docs: dokumenty, num: '.$num.'},
            type: "post"
        }).done(function(data){
            $.each(data.result,function(id,val){
                var len = val.length;
                if (len == 1) {
                    $("#url-"+id+"-1").attr("href",val[0]).show();
                } else {
                    $.each(val,function(k,v){
                        $("#url-"+id+"-"+(k+1)).attr("href",v).show();
                    });
                }
            });
        });
    });
';

$this->registerJS($js);

?>

