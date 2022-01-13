<?php
foreach ($rows as $row) {
?>
    <tr>
        <td>
            <?php
            echo ($row->id)
            ?>
        </td>
        <td>
            <?php
            echo ($row->userId)
            ?>
        </td>
        <td>
            <?php
            echo ($row->cTime)
            ?>
        </td>
        <td>
            <?php
            echo ($row->status)
            ?>
        </td>
        <td>

        </td>
    </tr>
<?php } ?>