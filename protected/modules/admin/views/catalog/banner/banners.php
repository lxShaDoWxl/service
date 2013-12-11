
<div class="search">
	<input class="input manti-clearer" placeholder="Поиск" id="search-input">
	<div class="input-clear" id="search-input">&times;</div>
	<a href="" class="btn-green ajax-load" data-page="<?= CHtml::normalizeUrl(array('catalog/createBanner'))?>"> + Добавить баннер</a>
</div>


<table class="table">
	<thead>
	<tr>
		<td> Дата начала </td>
		<td> Дата конца </td>
		<td> Вид банера </td>
		<td> Переходов за всё время </td>
		<td> Операции </td>
	</tr>
	</thead>

	<tbody id="items">
	<?php $i = 0; ?>
	<?php foreach ($banners as $s): ?>
		<tr id="tr-<?= ++$i ?>">
			<td><?= Yii::app()->dateFormatter->format('d MMMM yyyy', $s->date_start); ?></td>
			<td><?= Yii::app()->dateFormatter->format('d MMMM yyyy', $s->date_end); ?></td>
			<td><?= $s->post()?></td>
			<td align="center"><?= count($s->bannerStats)?></td>
			<td class="skip">
				<a class="btn btn-green icon ajax-load" href="#edit" data-page="<?=CHtml::normalizeUrl(array('catalog/editBanner', 'id'=>$s->id))?>">i</a>
				<a class="btn btn-green icon confirm-delete" href="<?= CHtml::normalizeUrl(array('catalog/deletedBanner', 'id'=>$s->id))?>">g</a>
			</td>
		</tr>
	<?php endforeach ?>

	</tbody>

</table>

<script type="text/javascript">
	$(function() {
		$('.search > .input#search-input').keyup(function() { $(this).change(); });
		$('.search > .input#search-input').change(function() {
			value = $(this).val();
			$('#items > tr').each(function() {
				tr = $(this);
				b = false;
				$('td:not(.skip)', tr).each(function() {
					if($(this).text().toLowerCase().indexOf(value) >= 0)
						b = true;
				});
				if(!b) tr.hide(100);
				else tr.show(100);
			});
		});
	});
</script>