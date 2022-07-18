<?php
use common\models\users\UserAttendance;
use yii\helpers\Url;

/**
 * @var $list
 */

foreach($list as $item) {
    ?>
    <tr>
        <td><?= $item['user_groups'] ?></td>
        <td><?= $item['meno'] ?></td>
        <td><?= $item['uaDate'] ?></td>
        <td><?= $item['inTime'] ?></td>
        <td><?= $item['outTime'] ?? '-' ?></td>
        <td><?= $item['diffTime'] ?></td>
        <td><?= UserAttendance::workType($item['uaType'])  ?></td>
        <td>
            <a href="<?= Url::to(['edit','rid' => $item['id']]) ?>" title="Edit" style="color: black"><i class="fas fa-pencil-alt"></i></a>
        </td>
    </tr>
    <?php
}
?>
