<?php
$this->title = 'Klienti';

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
                    <label class="col-sm-1 col-md-1 col-form-label">Meno</label>
                    <div class="col-sm-5 col-md-5">
                        <input type="text" name="Client[name_first]" value="<?= $client->name_first?>" class="form-control">
                    </div>
                    <label class="col-sm-1 col-md-1 col-form-label">Priezvisko</label>
                    <div class="col-sm-5 col-md-5">
                        <input type="text" name="Client[name_last]" value="<?= $client->name_last?>" class="form-control">
                    </div>
                </div>

            <div class="form-group row">
                <label class="col-sm-2 col-md-2 col-form-label">SSN</label>
                    <div class="col-sm-10 col-md-10">
                        <input type="text" name="Client[ssn]" value="<?= $client->ssn?>" class="form-control">
                    </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-md-2 col-form-label">Mesto</label>
                    <div class="col-sm-10 col-md-10">
                        <input type="text" name="ClientContact[perm_town]" value="<?= $clientContact->perm_town?>" class="form-control">
                    </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-md-2 col-form-label">Ulica</label>
                    <div class="col-sm-10 col-md-10">
                        <input type="text" name="ClientContact[perm_street]" value="<?= $clientContact->perm_street?>" class="form-control">
                    </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-md-2 col-form-label">PSČ</label>
                    <div class="col-sm-10 col-md-10">
                        <input type="text" name="ClientContact[perm_zip]" value="<?= $clientContact->perm_zip?>" class="form-control">
                    </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-md-2 col-form-label">Email</label>
                    <div class="col-sm-10 col-md-10">
                        <input type="text" name="Client[email]" value="<?= $client->email?>" class="form-control">
                    </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-md-2 col-form-label">Tel.Číslo</label>
                    <div class="col-sm-10 col-md-10">
                        <input type="text" name="ClientContact[mobile]" value="<?= $clientContact->mobile?>" class="form-control">
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