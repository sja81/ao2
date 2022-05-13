<?php
use backend\assets\RealAsset;
use yii\helpers\Url;
use common\models\users\UserAttendance;


/** @var array $offices **/

$this->title=Yii::t('app','Dochádzka');

$this->registerJSFile('@web/assets/node_modules/datatables/datatables.min.js',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/datatables/media/css/dataTables.bootstrap4.css',['depends'=>RealAsset::class]);
?>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm dattable" >
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Dátum</th>
                                <th>Príchod</th>
                                <th>Odchod</th>
                                <th>Poznámka</th>
                                <th>uaType</th>
                                <th>uaAction</th>
                                <th>inIP</th>
                                <th>outIP</th>
                                <th>Timestamp</th>
                                <th>action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($attendanceList as $row) {?>
                         <tr>
                            <td><?php echo $row['id']?></td>
                            <td><?php echo $row['uaDate']?></td>
                            <td><?php echo $row['inTime']?></td>
                            <td><?php echo $row['outTime']?></td>
                            <td><?php echo $row['note']?></td>
                            <td><?php echo UserAttendance::workType( $row['uaType'])?></td>
                            <td><?php echo $row['uaAction']?></td>
                            <td><?php echo $row['inIP']?></td>
                            <td><?php echo $row['outIP']?></td>
                            <td><?php echo $row['ts']?></td>

                            <td>
                             
                            <a href="<?= Url::to(['edit','id'=>$row['id']]) ?>"><i class="fas fa-pencil-alt m-l-10" style="color: black"></i> </a>
                               
                            </td>
                            

                         </tr>   
                         <?php } ?>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="<?= Url::to(['index']) ?>" class="btn btn-danger text-white"><?php echo Yii::t('app', 'Späť');?></a>
        </div>
    </div>
</div>



