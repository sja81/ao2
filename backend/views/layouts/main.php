<?php

use backend\assets\RealAsset;
use yii\helpers\Html;
use yii\helpers\Url;

RealAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <?php $this->head() ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="skin-blue fixed-layout">
    <?php $this->beginBody() ?>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">

        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="/backoffice/" style="font-size:0.8375rem !important">
                        <b><img src="<?= Yii::getAlias('@web') ?>/assets/images/logo-light-icon.png" alt="homepage" class="light-logo" /></b>
                        <span class="hidden-xs">Alpha-Omega&nbsp;Reality</span>
                    </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)">
                                <i class="ti-menu"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)">
                                <i class="icon-menu"></i>
                            </a>
                        </li>

                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown u-pro">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="<?= Yii::getAlias('@web') ?>/assets/images/users/1.jpg" alt="user" class="">
                                <span class="hidden-md-down">
                                    <?= !isset(\Yii::$app->user->identity->username) ? "Guest" : \Yii::$app->user->identity->username ?> &nbsp;
                                    <i class="fa fa-angle-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                <a href="javascript:void(0)" class="dropdown-item"><i class="ti-user"></i> <?php echo Yii::t('app', 'Môj profil'); ?></a>
                                <a href="/backoffice/site/logout" class="dropdown-item" data-method="post"><i class="fa fa-power-off"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <?php
                        if (isset(Yii::$app->user->identity) && Yii::$app->user->identity->hasRole('admin')) {
                        ?>
                            <li class="user-pro">
                                <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                    <img src="<?= Yii::getAlias('@web') ?>/assets/images/users/1.jpg" alt="user" class="img-circle">
                                    <span class="hide-menu">
                                        <?php echo !isset(\Yii::$app->user->identity->username) ? "Guest" : \Yii::$app->user->identity->username ?>
                                    </span>
                                </a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="javascript:void(0)"><i class="ti-user"></i> <?php echo Yii::t('app', 'Môj profil'); ?></a></li>
                                    <!--<li><a href="javascript:void(0)"><i class="ti-wallet"></i> My Balance</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-email"></i> Inbox</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-settings"></i> Account Setting</a></li>-->
                                    <li><a href="/backoffice/site/logout" class="dropdown-item" data-method="post"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php
                        if (isset(Yii::$app->user->identity) && Yii::$app->user->identity->hasRole('admin')) {
                        ?>
                            <li><a class="waves-effect waves-dark" href="#"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard</span></a>
                            <?php
                        }
                            ?>
                            <li> <a class="waves-effect waves-dark" href="/backoffice"><i class="icon-calender"></i><span class="hide-menu">Kalendár</span></a></li>
                            <?php
                            $active = (strpos($_SERVER['REQUEST_URI'], 'tasks')) ? ' active' : '';
                            ?>
                            <li><a href="/backoffice/tasks" class="waves-effect waves-dark<?php echo $active ?>"><i class="fas fa-tasks"></i><span class="hide-menu"><?= Yii::t('app', 'Úlohy'); ?></span></a></li>
                            <li> <a class="waves-effect waves-dark" href="/backoffice/contracts"><i class="icon-home"></i><span class="hide-menu">Nehnuteľnosti</span></a></li>
                            <li> <a class="waves-effect waves-dark" href="/backoffice/customers"><i class="ti-user"></i><span class="hide-menu">Zákaznící</span></a></li>
                            <!--<li> <a class="waves-effect waves-dark" href="/backoffice/clients"><i class="ti-user"></i><span class="hide-menu">Klienti</span></a></li>-->
                            <!--<li> <a class="waves-effect waves-dark" href="/backoffice/tasks"><i class="fas fa-tasks"></i><span class="hide-menu">Úlohy</span></a></li>-->
                            <li> <a class="waves-effect waves-dark" href="/backoffice/documents"><i class="far fa-folder"></i><span class="hide-menu">Dokumenty</span></a></li>
                            <?php
                            if (isset(Yii::$app->user->identity) && Yii::$app->user->identity->hasRole('admin')) {
                            ?>
                                <li>
                                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                        <i class="fas fa-users"></i><span class="hide-menu">Užívatelia</span>
                                    </a>
                                    <ul aria-expanded="false" class="collapse">
                                        <!-- <li><a href="/backoffice/applicant">Uchádzači</a></li> -->
                                        <!-- <li><a href="/backoffice/users">Spolupracovníci</a></li> -->
                                        <li><a href="/backoffice/students">Študenti</a></li>
                                    </ul>
                                </li>
                                <!--<li> <a class="waves-effect waves-dark" href="/backoffice/calculator"><i class="fas fa-calculator"></i><span class="hide-menu">Kalkulačky</span></a></li>-->
                            <?php
                            }
                            ?>
                            <?php
                            if (isset(Yii::$app->user->identity) && Yii::$app->user->identity->hasRole('admin')) {
                            ?>
                                <!--<li> <a class="waves-effect waves-dark" href="/backoffice/calls"><i class="ti-announcement"></i><span class="hide-menu">Marketing</span></a></li>-->
                                <!--<li>
                        <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="ti-layout"></i><span class="hide-menu">CMS</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="/backoffice/cms/menu">Menu</a></li>
                            <li><a href="/backoffice/cms/posts">Stránky</a></li>
                            <li><a href="/backoffice/cms/counter">Počítadlo</a></li>
                        </ul>
                    </li>-->
                                <li>
                                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                        <i class="fas fa-balance-scale"></i><span class="hide-menu">Účtovníctvo</span>
                                    </a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a href="/backoffice/orders"><?= Yii::t('app', 'Objednávky') ?></a></li>
                                        <li><a href="/backoffice/invoices"><?= Yii::t('app', 'Faktúry2') ?></a></li>
                                        <li><a href="/backoffice/accounting/invoice"><?= Yii::t('app', 'Faktúry') ?></a></li>
                                        <li><a href="/backoffice/accounting/cash-receipt">Pokladničné dokl.</a></li>
                                        <!-- <li><a href="/backoffice/business-trip">Cestovný príkaz</a></li> -->
                                    </ul>
                                </li>
                                <!--<li>
                        <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="fas fa-bug"></i><span class="hide-menu">DDD & Ozon</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="<?php echo Url::to(['/ddd-services/settings']) ?>">Nastavenia</a></li>
                            <li><a href="<?php echo Url::to(['/ddd-services/orders']) ?>">Objednávky</a></li>
                        </ul>
                    </li>-->
                                <li>
                                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                        <i class="ti-settings"></i></i><span class="hide-menu"><?= Yii::t('app', 'Nastavenia') ?></span>
                                    </a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a href="/backoffice/users"><?= Yii::t('app', 'Užívatelia') ?></a></li>
                                        <li><a href="/backoffice/task-manager"><?php echo Yii::t('app', 'Manažér úloh') ?></a></li>
                                        <li><a href="/backoffice/calendar/settings"><?php echo Yii::t('app', 'Nastevenie kalendára') ?></a></li>
                                    </ul>
                                </li>

                            <?php } ?>
                            <li><a class="" href="/backoffice/user-attendance"><i class="icon-clock"></i><span class="hide-menu">Dochádzka</span></a> </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="page-wrapper">
            <?= $content ?>
        </div>
        <footer class="footer">
            © 2019 ALPHA-OMEGA Real & Consulting s.r.o.
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>