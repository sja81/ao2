<?php

$this->title = 'Zákazníci';

?>

<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-8 align-self-center">
            <h4 class="text-themecolor"><?= $this->title ?></h4>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
           <form method="post">
            <input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
                <div class="form-group row">
                    <?php 
                        if(!$customer->name_first == '') {
                    ?>
                    <label class="col-sm-1 col-md-1 col-form-label">Meno</label>
                    <div class="col-sm-5 col-md-5">
                        <input type="text" name="Customer[name_first]" value="<?= $customer->name_first?>" class="form-control">
                    </div>
                    <label class="col-sm-1 col-md-1 col-form-label">Priezvisko</label>
                    <div class="col-sm-5 col-md-5">
                        <input type="text" name="Customer[name_last]" value="<?= $customer->name_last?>" class="form-control">
                    </div>
                    <?php  } elseif($customerCompany && !$customerCompany->obchodne_meno == 0) {
                        ?>
                    <label class="col-sm-2 col-md-2 col-form-label">Obchodne meno</label>
                    <div class="col-sm-10 col-md-10">
                        <input type="text" name="CustomerCompany[obchodne_meno]" value="<?= $customerCompany->obchodne_meno?>" class="form-control">
                    </div>
                   <?php 
                    } 
                   ?>  
                </div>

                <div class="form-group row">
                    <?php 
                        if(!$customer->ssn == '') {

                    ?>
                    <label class="col-sm-2 col-md-2 col-form-label">RČ/IČO</label>
                    <div class="col-sm-10 col-md-10">
                        <input type="text" name="Customer[ssn]" value="<?= $customer->ssn?>" class="form-control">
                    </div>
                    <?php 
                        } elseif($customerCompany && !$customerCompany->ico == '') {
                    ?>
                    <label class="col-sm-2 col-md-2 col-form-label">RČ/IČO</label>
                    <div class="col-sm-10 col-md-10">
                        <input type="text" name="CustomerCompany[ico]" value="<?= $customerCompany->ico ?>" class="form-control">
                    </div>
                    <?php 
                        }
                    ?>
                </div>
                <div class="form-group row">
                        <label class="col-sm-2 col-md-2 col-form-label">Mesto</label>
                        <div class="col-sm-10 col-md-10">
                       <?php if(!$customer->town == '') {
                        ?>
                        <input type="text" name="Customer[town]" class="form-control" value="<?= $customer->town ?>">
                        <?php 
                       }elseif($customerCompany && !$customerCompany->mesto == '') {
                        ?>
                        <input type="text" name="CustomerCompany[mesto]" class="form-control" value="<?= $customerCompany->mesto ?>">
                        <?php 
                       }
                        ?>
                        </div>
                </div>

                <div class="form-group row">
                        <label class="col-sm-2 col-md-2 col-form-label">PSČ</label>
                        <div class="col-sm-10 col-md-10">
                       <?php if(!$customer->zip == '') {
                        ?>
                        <input type="text" name="Customer[zip]" class="form-control" value="<?= $customer->zip ?>">
                        <?php 
                       }elseif($customerCompany && !$customerCompany->psc == '') {
                        ?>
                        <input type="text" name="CustomerCompany[psc]" class="form-control" value="<?= $customerCompany->psc ?>">
                        <?php 
                       }
                        ?>
                        </div>
                </div>
                                 
                <div class="form-group row">
                    <?php 
                        if(!$customer->address == '') {
                         ?>
                    <label class="col-sm-2 col-md-2 col-form-label">Ulica</label>
                    <div class="col-sm-10 col-md-10">
                        <input type="text" name="Customer[address]" value="<?= $customer->address?>" class="form-control">
                    </div>
                        <?php
                        } 
                        elseif($customerCompany && !$customerCompany->adresa == '') {
                        ?>
                    <label class="col-sm-2 col-md-2 col-form-label">Ulica</label>
                    <div class="col-sm-10 col-md-10">
                        <input type="text" name="CustomerCompany[adresa]" value="<?= $customerCompany->adresa?>" class="form-control">
                    </div>
                     <?php  }?>
                </div>


                <div class="form-group row">
                    <label class="col-sm-2 col-md-2 col-form-label">Email</label>
                    <div class="col-sm-10 col-md-10">
                        <input type="text" name="Customer[email]" value="<?= $customer->email ?>" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-md-2 col-form-label">Telefon</label>
                    <div class="col-sm-10 col-md-10">
                        <input type="text" name="Customer[phone]" value="<?= $customer->phone ?>" class="form-control">
                    </div>
                </div>

                <div class="row m-b-20 pt-3">
                    <div class="col-lg-12">
                        <input type="submit" class="btn btn-success" value="Uložiť">
                    </div>
                </div>
           </form>
        </div>
    </div>
</div>
<?php 
$csrf = "'" . Yii::$app->request->csrfParam . "':'" . Yii::$app->request->getCsrfToken() . "'";