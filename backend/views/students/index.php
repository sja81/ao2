<?php
use backend\assets\RealAsset;
use yii\helpers\Url;

$this->title = Yii::t('app', "Študenti");
$this->registerCSSFile('@web/assets/node_modules/toast-master/css/jquery.toast.css',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/dist/css/pages/other-pages.css',['depends'=>RealAsset::class]);
$this->registerJSFile('@web/assets/node_modules/datatables/datatables.min.js',['depends'=>RealAsset::class]);
$this->registerCSSFile('@web/assets/node_modules/datatables/media/css/dataTables.bootstrap4.css',['depends'=>RealAsset::class]);
?>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-4 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
        <div class="col-md-8 align-self-center text-right">
            <div class="btn-group">
                <button
                        type="button"
                        class="btn btn-info dropdown-toggle"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                    <i class="fas fa-plus-circle m-r-10"></i><?php echo Yii::t('app','Akcie') ?>
                </button>
                <!--
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="/backoffice/students/reports"><?php echo Yii::t('app','Výkazy') ?></a>
                </div>-->
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm dattable">
                            <thead>
                                <tr>
                                    <!--<th class="w5p">#</th>
                                    <th><?= Yii::t('app','Foto'); ?></th>-->
                                    <th>ID</th>
                                    <th><?= Yii::t('app','Meno/Priezvisko'); ?></th>
                                    <th><?= Yii::t('app','Kontakt'); ?></th>
                                    <th><?= Yii::t('app','Adresa'); ?></th>
                                    <th><?= Yii::t('app','Jazyk'); ?></th>
                                    <th><?= Yii::t('app','Testy'); ?></th>
                                    <th><?= Yii::t('app','Dokončené vzdelanie'); ?></th>
                                    <th><?= Yii::t('app','Kurzy') ?></th>
                                    <th><?= Yii::t('app','Škola/odbor'); ?></th>
                                    <th><?= Yii::t('app','Motivačný list'); ?></th>
                                    <th><?= Yii::t('app','Video'); ?></th>
                                    <th>Status</th>
                                    <th>Akcia</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($students as $student) {
                            ?>
                                 <tr>
                                     <!--<td><input type="checkbox" name="" id=""></td>
                                     <td><?php echo $student['photo'] ?></td>-->
                                     <td><?= $student['id'] ?></td>
                                     <td><?= $student['studentName'] ?></td>
                                     <td>
                                         <p class="m-b-0">
                                             <i class="mdi mdi-phone"></i>
                                             <a href="tel:<?php echo $student['phone'] ?>">
                                                 <?php echo $student['phone'] ?>
                                             </a>
                                         </p>
                                         <p>
                                             <i class="mdi mdi-email"></i>
                                             <a href="mailto:<?php echo $student['email'] ?>">
                                                 <?php echo $student['email'] ?>
                                             </a>
                                         </p>
                                         <?php
                                         if (isset($student['parentName'])) {
                                         ?>
                                             <p class="m-t-20 m-b-0">
                                                 <strong>
                                                     <?php echo Yii::t('app','Meno zákonného zástupcu:'); ?>
                                                 </strong>
                                                 <br>
                                                 <?php
                                                    echo $student['parentName']
                                                 ?>
                                             </p>
                                             <p class="m-b-0">
                                                 <i class="mdi mdi-phone"></i>
                                                 <a href="tel:<?php echo $student['parentPhone'] ?>">
                                                     <?php echo $student['parentPhone'] ?>
                                                 </a>
                                             </p>
                                             <p>
                                                 <i class="mdi mdi-email"></i>
                                                 <a href="mailto:<?php echo $student['parentEmail'] ?>">
                                                     <?php echo $student['parentEmail'] ?>
                                                 </a>
                                             </p>
                                         <?php
                                         }

                                         if (is_null($student['iban'])) {
                                         ?>
                                              <button class="btn btn-sm btn-info mb-2 cd-<?= $student['id'] ?>" type="button" onclick="addIban(<?= $student['id'] ?>)">IBAN</button>
                                         <?php
                                         } else {
                                         ?>
                                             <p><i class="mdi mdi-bank"></i>&nbsp;<?= $student['iban'] ?></p>
                                         <?php
                                         }
                                         ?>

                                     </td>
                                     <td>
                                         <?= $student['town'] ?>
                                         <br><br>
                                         <?= $student['fullAddress'] ?>
                                     </td>
                                     <td>
                                         <p class="m-b-0"><b><?= Yii::t('app','Materinský jazyk:'); ?></b></p>
                                         <p><?php echo isset($student['matjaz']) ? $student['matjaz'] : "-" ?></p>
                                         <p class="m-t-10 m-b-0"><b><?= Yii::t('app','Iné jazyky:'); ?></b></p>
                                         <?php
                                         foreach ($student['otherLang'] as $langs) {
                                             echo "<p class='m-b-0'>{$langs['code3']} - {$langs['level']}</p>";
                                         }
                                         ?>
                                     </td>
                                     <td>
                                         <p class="m-b-0">
                                            <b><?php echo Yii::t('app','Persona'); ?>:</b>
                                         </p>
                                         <p>
                                            <?php echo isset($student['personaResult']) ? $student['personaResult'] :  "-" ?>
                                         </p>
                                         <p class="m-b-0 m-t-10">
                                             <b><?php echo Yii::t('app','IQ'); ?>:</b>
                                         </p>
                                         <p>
                                             <?php echo isset($student['iqResult']) ?: "-" ?>
                                         </p>
                                     </td>
                                     <td>
                                         <?= $student['primarySchoolTown'] ?>
                                         <p style="margin-top:10px"><?= $student['primarySchoolName'] ?></p>
                                     </td>
                                     <td></td>
                                     <td>
                                         <?= $student['description'] ?>
                                         <p style="margin-top:10px"><?= $student['odbor'] ?></p>
                                     </td>
                                     <td></td>
                                     <td>
                                         <?php
                                         if (is_null($student['video'])) {
                                             echo Yii::t('app','Bez videa');
                                         } else {
                                             echo $student['video'];
                                         }
                                         ?>
                                     </td>
                                     <td></td>
                                     <td>
                                         <a href="<?= Url::to(['edit','id'=>$student['id']]) ?>"><i class="fas fa-pencil-alt m-l-10" style="color: black"></i></a>
                                     </td>
                                 </tr>
                            <?php
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php

$css = <<<CSS
    .w5p{
        width: 5%;
    }
    
CSS;

$this->registerCSS($css);


$js = <<<JS
    $(function() {
        $('.dattable').DataTable({
            order: []
        });
    });
    addIban = function(i) {
        $('#sid').val(i);
        $('#exampleModalCenter').modal('show');
    }
    $('#save-iban').on('click',function(){
        var xdata = $('#iban-frm').serialize();
        $.ajax({
            url: '/backoffice/students/update-iban',
            dataType: 'json',
            method: 'post',
            data: xdata
        }).done(function(res){
            if (res.status == 'error') {
             
            } else {
                
            }
        });
    });
JS;

$this->registerJS($js);
?>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?= Yii::t('app','Pridať IBAN'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" id="iban-frm">
                    <input type="hidden" name="Student[id]" id="sid">
                    <div class="form-group row">
                        <label class="col-2 col-form-label text-right">IBAN</label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="Student[iban]" placeholder="SK75 0100 ...">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= Yii::t('app','Zrušiť'); ?></button>
                <button type="button" class="btn btn-info" id="save-iban"><?= Yii::t('app','Uložiť'); ?></button>
            </div>
        </div>
    </div>
</div>