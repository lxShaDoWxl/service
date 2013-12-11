
<div class="search">
	<input class="input manti-clearer" placeholder="Поиск" id="search-input">
	<div class="input-clear" id="search-input">&times;</div>
	<a href="" class="btn-green ajax-load" data-page="<?= CHtml::normalizeUrl(array('catalog/createDebat'))?>"> + Добавить дискусию</a>
</div>


<table class="table">
	<thead>
	<tr>
		<td> Название </td>
		<td> Дата начала </td>
		<td> Дата конца </td>
		<td> Операции </td>
	</tr>
	</thead>

	<tbody id="items">
	<?php $i = 0; ?>
	<?php foreach ($debats as $s): ?>
		<tr id="tr-<?= ++$i ?>">
			<td><?= $s->title; ?></td>
			<td><?= $s->date_start; ?></td>
			<td><?= $s->date_end; ?></td>
			<td class="skip">
				<a class="btn btn-green icon ajax-load" href="#edit" data-page="<?=CHtml::normalizeUrl(array('catalog/editDebat', 'id'=>$s->id))?>">i</a>
				<a class="btn btn-green icon confirm-delete" href="<?= CHtml::normalizeUrl(array('catalog/deletedDebat', 'id'=>$s->id))?>">g</a>
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