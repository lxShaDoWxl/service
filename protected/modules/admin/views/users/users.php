<div class="search">
	<input class="input manti-clearer" placeholder="Поиск" id="search-input">
	<div class="input-clear" id="search-input">&times;</div>
	<? if (isset($this->categories['experts']['active'])): ?>
		<a href="" class="btn-green ajax-load" data-page="<?= CHtml::normalizeUrl(array('users/create')) ?>"> +
			Добавить эксперта</a>
	<? endif ?>
</div>


<table class="table">
	<thead>
	<tr>
		<td> Имя </td>
		<td> E-Mail </td>
		<td> Операции </td>
	</tr>
	</thead>

	<tbody id="items">
	<?php $i = 0; ?>
	<?php foreach ($users as $s): ?>
		<tr id="tr-<?= ++$i ?>">
			<td><?= $s->name; ?></td>
			<td><?= $s->mail; ?></td>
			<td class="skip">
				<a class="btn btn-green icon ajax-load" href="#edit" data-page="<?php echo CHtml::normalizeUrl(array('users/edit', 'id'=>$s->id))?>">i</a>
				<a class="btn btn-green icon confirm-delete" href="<?php echo CHtml::normalizeUrl(array('users/deleted', 'id'=>$s->id))?> ">g</a>
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