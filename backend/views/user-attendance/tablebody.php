<?php
use yii\helpers\Html;
use common\models\users\UserAttendance;
use yii\helpers\Url;

/**
 * @var array $rows
 */

foreach ($rows as $row) {
?>
    <tr>
        <td><?php echo $row['meno'] ?></td>
        <td><?php echo $row['uaDate'] ?></td>
        <td>
            <?php echo $row['inTime'] ?>
        </td>
        <td>
            <?php echo $row['outTime'] ?>
        </td>
        <td>
            <?= $row['diffTime'] ?>
        </td>
        <td> <?php echo UserAttendance::workType($row['uaType'])  ?> </td>
        <td> <?php echo Html::decode($row['note']) ?></td>
        <td>
            <!--<a href="<?= Url::to(['edit','rid'=>$row['id'],'uid'=>Yii::$app->request->get('uid')]) ?>" title="Edit" style="color: black"><i class="fas fa-pencil-alt"></i></a>-->
        </td>
    </tr>
<?php } ?>