<?php
use yii\helpers\Url;
use backend\helpers\HelpersNum;
use common\models\search\BackendSearch;

    $this->title="Klienti";
?>
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>

    <!--<div class="card">
        <div class="card-body">
            <form method="get" action="<?= \yii\helpers\Url::to(['/customers/search'])?>">
                <div class="row">
                    <div class="col-sm-2">
                        <input
                                type="text"
                                class="form-control"
                                name="Ser[meno]"
                                placeholder="Meno a/alebo priezvisko"
                        >
                    </div>
                    <div class="col-sm-2">
                        <input
                                type="text"
                                class="form-control"
                                name="Ser[rcico]"
                                placeholder="RČ/IČO"
                        >
                    </div>
                    <div class="col-sm-2">
                        <input
                                type="text"
                                class="form-control"
                                name="Ser[em]"
                                placeholder="Email"
                        >
                    </div>
                    <div class="col-sm-2">
                        <input
                                type="text"
                                class="form-control"
                                name="Ser[tel]"
                                placeholder="Telefón"
                        >
                    </div>
                    <div class="col-sm-2">
                        <select class="form-control dropdown" name="Ser[ag]">
                            <option value="">Vyberte agenta</option>
                            <?php
                            foreach($agents as $item) {
                                echo "<option value={$item['id']}>{$item['meno']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <input type="submit" class="btn btn-success" value="Filtruj">
                    </div>
                </div>
            </form>
        </div>
    </div>
    -->

    <div class="card">
        <div class="card-body">


            <?php

            $pocet_stran = HelpersNum::getPageNumber($customersCount,BackendSearch::PAGE_LIMIT);

            echo $this->render('index-paging',[
            'disableLeft'   => '',
            'disableRight'  => '',
            'pocet_stran'   => $pocet_stran,
            'akt_strana'    => 1
            ]);

            ?>

        <table class="table table-striped table-hover" style="margin:0; padding:0;line-height: 17px;">
                <thead style="background-color: #2B81AF" class="text-white">
                    <th>Meno a priezvisko</th>
                    <th>RČ/IČO</th>
                    <th>Mesto</th>
                    <th>Email</th>
                    <th>Telefón</th>
                    <th>Spravuje</th>
                    <th>Vytvorené</th>
                    <th>Akcie</th>
                </thead>
                <tbody>
                <?php
                if (count($customers) == 0) {
                    ?>
                    <tr>
                        <td colspan="8" class="text-center">No data...</td>
                    </tr>
                <?php
                } else {
                    foreach($customers as $customer) {
                    ?>
                    <tr>
                        <td>
                            <?php
                            $meno = '';
                            if ($customer->customer_type == 'osoba') {
                                if (
                                    (isset($customer->name_first) && $customer->name_first != '') &&
                                    (isset($customer->name_last) && $customer->name_last != '')
                                ) {
                                    $meno = implode(' ', [$customer->name_first,$customer->name_last]);

                                } elseif(
                                    (isset($customer->lv_name_first) && $customer->lv_name_first != '') &&
                                    (isset($customer->lv_name_last) && $customer->lv_name_last != '')
                                ) {
                                    $meno = implode(' ', [$customer->lv_name_first,$customer->lv_name_last]);
                                }

                            } elseif ($customer->customer_type == 'firma') {
                                $meno = $customer->company->obchodne_meno;
                            }
                            echo $meno;
                            ?>
                        </td>
                        <td>
                            <?php
                            $ssn = '';
                            if ($customer->customer_type == 'osoba') {
                                $ssn = isset($customer->ssn) && $customer->ssn != '' ? $customer->ssn : '-';
                            } elseif ($customer->customer_type == 'firma') {
                                $ssn = $customer->company->ico;
                            }
                            echo $ssn;
                            ?>
                        </td>
                        <td>
                            <?php
                            $town = '';
                            if ($customer->customer_type == 'osoba') {
                                if (
                                    (isset($customer->town) && $customer->town != '')
                                ) {
                                    $town = $customer->town;

                                } elseif(
                                    (isset($customer->lv_town) && $customer->lv_town != '')
                                ) {
                                    $town = $customer->lv_town;
                                }
                            } elseif ($customer->customer_type == 'firma') {
                                $town = $customer->company->mesto;
                            }
                            echo $town;
                            ?>
                        </td>
                        <td>
                            <?php
                            $email = '';
                            if ($customer->customer_type == 'osoba') {
                                $email = $customer->email != '' ? $customer->email : '-';
                            } elseif ($customer->customer_type == 'firma') {
                                $email = $customer->company->email;
                            }
                            echo $email;
                            ?>
                        </td>
                        <td>
                            <?php
                            $phone = '';
                            if ($customer->customer_type == 'osoba') {
                                $phone = HelpersNum::getPhoneFromStr($customer->phone);
                            } elseif ($customer->customer_type == 'firma') {
                                $phone = HelpersNum::getPhoneFromStr($customer->company->telefon);
                            }
                            echo "+{$phone}";
                            ?>
                        </td>
                        <td>Szabo Balazs</td>
                        <td><?= $customer->created_at ?></td>
                        <td>

                            <!--<a
                                    href="<?= Url::to(['/customers/open','id'=>$customer['id']])?>"
                                    class="btn btn-sm btn-default"
                                    title="Otvoriť klienta">
                                <i class="fas fa-eye"></i>
                            </a>-->
                        </td>
                    </tr>
                    <?php
                    }
                }
                ?>
                </tbody>
            </table>

            <?php

            echo $this->render('index-paging',[
            'disableLeft'   => '',
            'disableRight'  => '',
            'pocet_stran'   => $pocet_stran,
            'akt_strana'    => 1
            ]);

            ?>

        </div>
    </div>
</div>