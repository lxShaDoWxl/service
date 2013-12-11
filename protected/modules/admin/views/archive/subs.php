<div class="search">
	<input class="input manti-clearer" placeholder="Поиск" id="search-input">
	<div class="input-clear" id="search-input">&times;</div>
	<a href="/userfiles/subs.csv" class="btn-green"> Скачать</a>
</div>
<table class="table">
	<thead>
	<tr>
		<td> Имя </td>
		<td> Почта </td>
		<td> Операции </td>
	</tr>
	</thead>
	<tbody id="items">
	<?php $i = 0; ?>
	<?php foreach ($subs as $s): ?>
		<tr id="tr-<?= ++$i ?>">
			<td><?= $s->name; ?></td>
			<td><?= $s->mail; ?></td>
			<td class="skip">
				<a class="btn btn-green icon confirm-delete" href="<?= CHtml::normalizeUrl(array('archive/deleted_sub', 'id'=>$s->id))?>">g</a>
			</td>
			<?file_put_contents('userfiles/subs.csv',$s->name.';'.$s->mail."\n", FILE_APPEND);?>
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