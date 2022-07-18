<?php
foreach ($templates as $template) {
    if (empty($template['name'])) {
        continue;
    }
?>
    <tr>
        <td>
            <?= $template['name'] ?>
        </td>
        <?php
        foreach ($groups as $group) {
            $checked = "";
            if (in_array($template['id'], $privileges[$group['name']])) {
                $checked = " checked";
            }
        ?>
            <td>
                <input type="checkbox" data-template="<?= $template['id'] ?>" data-group="<?= $group['name'] ?>" class="template" <?= $checked ?>>
            </td>

    <?php
        }
        echo "</tr>";
    }
    ?>