<tr>
    <td><?= $item->getFullName() ?></td>
    <td><?= $item->getFullAddress() ?></td>
    <td>
        <?= $item->email ?><br>
        <a href="tel:<?= $item->phone?>"><?= $item->phone ?></a>
    </td>
    <td><?= $item->born_date ?></td>
    <td><?= $item->pozicia->info->title?></td>
    <td><?= $item->pozicia->status ?></td>
    <td><?= $item->created_at ?></td>
    <td><?= !is_null($item->updated_at) ? $item->updated_at : "--" ?></td>
    <td>
        <a href="<?= yii\helpers\Url::to(['applicant/view','id'=>$item->id]) ?>" title="Zobraziť" style="color:black">
            <i class="fas fa-eye"></i>
        </a>
        <a href="#" title="Uzavrieť" style="color:black" data-id="<?= $item->id ?>" id="close-case">
            <i class="fas fa-pencil-alt"></i>
        </a>

    </td>
</tr>
