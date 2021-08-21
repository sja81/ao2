<tbody>
    <tr>
        <td>
            <input type="radio" name="Data[majitel]" value="-1" checked>
        </td>
        <td>

        </td>
        <td>
            Neidentifikované, nahrám ručne
        </td>
    </tr>
    <?php
        foreach($majitelia['BYTY'] as $id=>$byty) {
    ?>
        <tr>
            <td>
                <input type="radio" name="Data[majitel]" value="<?= $id ?>">
            </td>
            <td align="center">
                <?= $byty['VCHOD'] ?> / <?= $byty['CISLO_BYT'] ?>
            </td>
            <td>
                <?php
                foreach ($byty['MAJITEL'] as $item) {
                    echo $item['POPIS'];
                    echo "<br>";
                }
                ?>
            </td>
        </tr>

    <?php
        }
    ?>
</tbody>
