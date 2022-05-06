<?php
use yii\helpers\Url;
use backend\helpers\HelpersNum;
?>

<div class="card rounded-5 card-shadow">
    <div class="card-body">
        <h4 class="card-title"><?php echo $office['name'] ?></h4>
        <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm dattable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo Yii::t('app','Číslo'); ?></th>
                            <th><?php echo Yii::t('app','Typ'); ?></th>
                            <th><?php echo Yii::t('app','Partner'); ?></th>
                            <th><?php echo Yii::t('app','K úhrade'); ?></th>
                            <th><?php echo Yii::t('app','Záloha'); ?></th>
                            <th><?php echo Yii::t('app','Vystavené'); ?></th>
                            <th><?php echo Yii::t('app','Splatnosť'); ?></th>
                            <th><?php echo Yii::t('app','Status'); ?></th>
                            <th><?php echo Yii::t('app','Akcie'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($office['invoices'] as $invoice):?>
                    <tr>
                        <td class="text-center"><?php
                            $icon = $invoice['bookedIn'] == 'odfa' ?
                                'mdi mdi-arrow-left-bold text-success' :
                                'mdi mdi-arrow-right-bold text-danger';
                            ?>
                            <i class="<?= $icon ?>"></i>
                        </td>
                        <td>
                            <?= $invoice['znak']?><?= $invoice['rok']?><?= $invoice['mesiac']?><?= $invoice['cislo']?>
                            <br>
                            <span class="font-10 text-muted">(ID: <?php echo $invoice['id'] ?>)</span>
                        </td>
                        <td>
                            <?php


                            if ($invoice['typ_faktury'] == 0) {
                                $typ = Yii::t('app','FA');
                                $typPopis = Yii::t('app',"Faktúra");
                            } else if ($invoice['typ_faktury'] == 1) {
                                $typ = Yii::t('app','ZAFA');
                                $typPopis = Yii::t('app',"Zálohová faktúra");
                            } else {
                                $typ = Yii::t('app','NEID');
                                $typPopis = Yii::t('app',"Neidentifikované");
                            }
                            ?>
                            <span title="<?php echo $typPopis ?>" style="cursor: pointer;">
                                <?php echo Yii::t('app',$typ) ?>
                            </span>
                        </td>
                        <td><?php
                            if ($invoice['odberatel'] != '') {
                                echo $invoice['odberatel'];
                            } else {
                                echo $invoice['kontaktna_osoba'];
                            }
                            ?></td>
                        <td style="text-align: right">
                            <?= HelpersNum::moneyFormat($invoice['k_uhrade']) ?>
                        </td>
                        <td style="text-align: right">
                            <?= HelpersNum::moneyFormat($invoice['zaloha']) ?>
                        </td>
                        <td style="text-align: right">
                            <?= $invoice['datum_vystavenia'] ?>
                        </td>
                        <td style="text-align: right">
                            <?= $invoice['splatnost'] ?>
                        </td>
                        <td>
                            <input
                                    type="checkbox"
                                    class="js-switch"
                                    data-color="#26c6da"
                                    data-secondary-color="#f62d51"
                                    data-invoice="<?= $invoice['id'] ?>"
                                    <?= $invoice['status'] == 2 ? ' checked' : '' ?>
                            >
                        </td>
                        <td>
                            <?php
                            $invoiceCode = [
                                0 => 'FAK',
                                1 => 'ZAL',
                                2 => 'DOB',
                            ];

                            if ($invoice['typ_faktury'] == 1) {
                                ?>
                                <a
                                        href="<?= Url::to(['accounting/make-invoice','id'=>$invoice['id']]) ?>"
                                        style="color: black; margin-right: 5px;"
                                        title="<?= Yii::t('app','Vytvoriť faktúru') ?>"
                                >
                                    <i class="fas fa-file-medical"></i>
                                </a>
                                <?php
                            }
                            ?>
                            <?php
                            if ($invoice['bookedIn'] == 'odfa') {
                            ?>
                            <a
                                    href="<?= Url::to(['accounting/print','t'=>$invoiceCode[$invoice['typ_faktury']],'id'=>$invoice['id']]) ?>"
                                    title="Print"
                                    style="color: black;margin-right: 5px;"
                            >
                                <i class="fas fa-print"></i>
                            </a>
                            <?php
                            }
                            ?>
                            <a href="<?= Url::to(['accounting/edit-invoice','id'=>$invoice['id']]) ?>" title="Edit" style="color: black"><i class="fas fa-pencil-alt"></i></a>
                        </td>
                    </tr>
                    <?php
                    endforeach;
                    ?>
                    </tbody>
                </table>
            </div>
    </div>
</div>
