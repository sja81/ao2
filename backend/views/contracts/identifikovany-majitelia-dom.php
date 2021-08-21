<thead>
    <tr>
        <th width="5%">#</th>
        <th>Meno</th>
    </tr>
</thead>
<tbody>
    <?php
        foreach($majitelia['BYTY'] as $id=>$byty) {
    ?>
        <tr>
            <td>
                <input type="radio" name="Data[majitel]" value="<?= $id ?>">
            </td>
            <td align="center">
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
