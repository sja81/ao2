<?php 
use backend\assets\RealAsset;
use yii\helpers\Url;
?>



<?php foreach($students as $student) {?>
    <tr>
    <td><?php echo $student['item_name']?></td>
    <td><?php echo $student['meno']?></td>
    <td><?php echo $student['email']?></td>
    <td><?php echo $student['phone']?></td>
    <td>
        
    <a href="<?= Url::to(['edit','id'=>$student['user_id']]) ?>"><i class="fas fa-pencil-alt m-l-10" style="color: black"></i> </a>
        <a href="<?= Url::to(['files','id'=>$student['user_id']]) ?>" style="color:black;"><i class="fas fa-clipboard-list"></i></a>
    </td>
    

    </tr>   
    <?php } ?>
                        