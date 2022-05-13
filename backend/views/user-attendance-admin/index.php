<?php
use backend\assets\RealAsset;
use yii\helpers\Url;


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
            <div class="form-group row">
                <div class="col-sm-3">
                    <select name="" id="groupSelect" class="form-control dropdown">
                        <option value="">Zvoľte si skupinu</option>
                        <?php foreach($groups as $group){ ?>
                            <option value="<?php echo $group['name'] ?>"><?php echo "{$group['name']} - {$group['description']}" ?> </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm dattable" id="attendanceTable">
                        <thead>
                            <tr>
                                <th>Skupina</th>
                                <th>Meno</th>
                                <th>Email</th>
                                <th>Tel. číslo</th>
                                <th>Akcia</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                                <?php
                            
                                echo $this->render('group',[
                                    'students' => $students
                                ]);
                            
                            ?>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>

<?php 
    $csrf = "'" . Yii::$app->request->csrfParam ."':'". Yii::$app->request->getCsrfToken() ."'";
    $js = <<<JS
    $(function() {
        $('.dattable').DataTable({
            order: []
        });
    });
    $("#groupSelect").change(function(){
        let v=$(this).val();
        $.ajax({
            url: "/backoffice/user-attendance-admin/list-students",
            dataType: "json",
            data: { group: v, {$csrf} },
            type: "post"
        })
        .done(function(res){
            if (res.status == 'error') {
                 alert(res.message);
            } 
            else {
                $("#attendanceTable > tbody").empty().html(r.response);
             }
        });

    });
    JS;
    $this->registerJS($js);
?>



