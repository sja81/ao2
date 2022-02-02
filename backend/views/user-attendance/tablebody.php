<?php
foreach ($rows as $row) {
?>
    <tr>
        <td> <?php echo $row['meno'] ?>
            <br>
            <span class="text-muted font-10">(ID: <?php echo $row['id'] ?>)</span>
        </td>
        <td> <?php echo $row['cTime'] ?> </td>
        <td> <?php echo $row['status']  ?> </td>
        <td></td>
    </tr>
<?php } ?>