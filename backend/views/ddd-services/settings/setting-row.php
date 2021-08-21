<tr>
    <td><?php echo $material->id ?></td>
    <td><?php echo $material->nazov ?></td>
    <td>
        <?php
            echo $material->vyrobca;
            echo "<br>";
            echo $material->adresa;
            echo "<br>";
            echo "{$material->psc} {$material->mesto}<br>";
            echo $material->krajina;

        ?>
    </td>
    <td><?php echo $material->datasheet; ?></td>
    <td></td>
    <td><?php echo $material->poznamka; ?></td>
    <td></td>
</tr>
<tr>
    <td colspan="7">
    <?php
    $rows = $material->stock;
    if (count($rows) === 0) {
    ?>
           ...No data...
    <?php
    } else {
    ?>
    <table class="table table-hover table-sm" >
        <thead class="thead-dark">
            <th>Kod materialu</th>
            <th>Dodávateľ</th>
            <th>Vyrobene</th>
            <th>Expiracia</th>
            <th>Dodane</th>
            <th>Mnozstvo</th>
            <th>M.j.</th>
            <th>Cena za j.</th>
            <th>Cena</th>
            <th>Status</th>
            <th>Akcie</th>
        </thead>
        <tbody>
    <?php
        foreach($rows as $item) {
    ?>
        <tr>
                <td><?= $item->kod ?></td>
            <td>
                <div class="row">
                    <div class="col-md-6">
                        <?= $item->dodavatel->nazov ?>
                        <br>
                        <?= $item->dodavatel->adresa ?>
                        <br>
                        <?= $item->dodavatel->psc . ' ' . $item->dodavatel->mesto ?>
                        <br>
                        <?= $item->dodavatel->stat ?>
                    </div>
                    <div class="col-md-6">
                        <?php if (isset($item->dodavatel->url)) { ?>
                        <a href="<?= $item->dodavatel->url?>" target="_blank"><?= $item->dodavatel->url?></a>
                        <?php } ?>
                        <?php if (isset($item->dodavatel->kontakt)) { ?>
                        <br>
                        Kontakt: <?= $item->dodavatel->kontakt ?>
                        <?php } ?>
                        <?php if (isset($item->dodavatel->telefon)) { ?>
                        <br>
                        Tel.: <?= $item->dodavatel->telefon ?>
                        <?php } ?>
                        <?php if (isset($item->dodavatel->email)) { ?>
                        <br>
                        Email: <?= $item->dodavatel->email ?>
                        <?php } ?>
                    </div>
                </div>
            </td>
            <td><?= $item->vyrobene ?></td>
            <td><?= $item->expiracia ?></td>
            <td><?= $item->dodane ?></td>
            <td><?= $item->mnozstvo ?></td>
            <td><?= $item->mernaJednotkaText() ?></td>
            <td><?= $item->cena_za_jednotku ?></td>
            <td><?= $item->cena ?></td>
            <td><?= $item->status ?></td>
            <td></td>
        </tr>

    <?php
            }
    }
    ?>
        </tbody>
    </table>
    </td>
</tr>

