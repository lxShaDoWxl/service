<div class="search">

    <a href="#" class="btn-green ajax-load" data-page=" <?php echo CHtml::normalizeUrl(array('settings/slider', 'action'=>'new'))?>">Добавить</a>

</div>


<table class="table">

    <thead>
    <tr>
        <td> Url </td>
        <td> Операции </td>
    </tr>
    </thead>

    <tbody id="items">
    <?php $i = 0; ?>
    <?php foreach ($slideritems as $s): ?>
        <tr id="tr-<?= ++$i ?>">
            <td><?= $s->img; ?></td>
            <td class="skip">
                <a class="btn btn-green icon ajax-load" href="#edit" data-page="<?php echo CHtml::normalizeUrl(array('settings/slider', 'action'=>'edit', 'id'=>$s->id))?>">i</a>
                <a class="btn btn-green icon confirm-delete" href="<?php echo CHtml::normalizeUrl(array('settings/slider', 'action'=>'deleted',  'id'=>$s->id))?>">g</a>
            </td>
        </tr>
    <?php endforeach ?>
</tbody>

</table>