<div class="search">
	<input class="input manti-clearer" placeholder="Поиск" id="search-input">
	<div class="input-clear" id="search-input">&times;</div>
	<a href="" class="btn-green ajax-load" data-page="<?= CHtml::normalizeUrl(array('archive/create'))?>"> + Добавить Издание</a>
	<select id="god">
		<option value="0" >Все</option>
		<?for($i=$number_old ; $i>=$number_one; $i--): ?>
			<option value="<?=$i?>" ><?=$i?></option>
		<? endfor;?>
	</select>
	<select id="publication">
		<option value="" >Все</option>
		<option value="бизнес & власть" >Бизнес & Власть</option>
		<option value="рбк" >РБК</option>
	</select>
</div>
<table class="table">
	<thead>
	<tr>
		<td> Издание </td>
		<td> Номер </td>
		<td> Название </td>
		<td> Дата </td>
		<td> Операции </td>
	</tr>
	</thead>
	<tbody id="items">
	<?php $i = 0; ?>
<?php foreach ($archives as $s): ?>
	<tr id="tr-<?= ++$i ?>">
		<td class="publication"> <?=$s->stats()?> </td>
		<td><?= $s->number; ?></td>
		<td><?= $s->title; ?></td>
		<td class="god"><?= $s->date; ?></td>
		<td class="skip">
			<a class="btn btn-green icon ajax-load" href="#edit" data-page="<?=CHtml::normalizeUrl(array('archive/edit', 'id'=>$s->id))?>">i</a>
			<a class="btn btn-green icon confirm-delete" href="<?= CHtml::normalizeUrl(array('archive/deleted', 'id'=>$s->id))?>">g</a>
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
					if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)
						b = true;
				});
				if(!b) tr.hide(100);
				else tr.show(100);
			});
		});
		$('.search > #god, .search > #publication').change(function() {
			god = $('.search > #god').val();
			publication =  $('.search > #publication').val();
			window.console.log((publication!='' )+' -'+ god);
			$('#items > tr').each(function() {
				tr = $(this);
				b = false;
				b2 = false;
				$('td.god', tr).each(function() {
					if($(this).text().toLowerCase().indexOf(god.toLowerCase()) >= 0)
						b = true;
				});
				$('td.publication', tr).each(function() {
					if($(this).text().toLowerCase().indexOf(publication.toLowerCase()) >= 0)
						b2 = true;
				});
				if(!b){
						tr.hide(100);
				}
				else{
					if(b2){
						tr.show(100);
					}else{
						tr.hide(100);
					}
				}


			});
		});
//		$('.search > #publication').change(function() {
//			value = $(this).val();
//			$('#items > tr').each(function() {
//				tr = $(this);
//				b = false;
//				$('td.publication', tr).each(function() {
//					if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)
//						b = true;
//				});
//				if(!b) tr.hide(100);
//				else tr.show(100);
//			});
//		});
	});
</script>