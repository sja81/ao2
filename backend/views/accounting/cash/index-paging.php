<?php
use yii\helpers\Url;
?>
<div class="col-md-12 m-t-30 m-b-30">
    <ul class="pagination justify-content-center">
        <li class="page-item<?= $disableLeft ?>">
            <a class="page-link" href="<?= Url::current(['p'=> $akt_strana-1]) ?>" tabindex="-1"><i class="fa fa-angle-left"></i></a>
        </li>
        <?php
        for($i=1; $i <= $pocet_stran;$i++) {
            if ($akt_strana == $i) {
                echo "<li class='page-item active'>";
                echo "<a class='page-link' href='".Url::current(['p' => $i])."'>{$i}<span class='sr-only'>(current)</span></a>";
                echo "</li>";
            } else {
                echo "<li class='page-item'><a class='page-link' href='".Url::current(['p'=>$i])."'>{$i}</a></li>";
            }
        }
        ?>
        <li class="page-item<?= $disableRight?>">
            <a class="page-link" href="<?= Url::current(['p'=> $akt_strana+1]) ?>"><i class="fa fa-angle-right"></i></a>
        </li>
    </ul>
</div>
