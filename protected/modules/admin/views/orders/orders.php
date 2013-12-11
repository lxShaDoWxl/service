<div class="search">
	<input class="input manti-clearer" placeholder="Поиск" id="search-input">
	<div class="input-clear" id="search-input">&times;</div>
</div>

<table class="table">
<thead>
	<tr>
		<td> Номер заказа </td>
		<td> Имя клиента </td>
		<td> Телефон клиента </td>
		<td> Электронный адрес клиента </td>
		<td> Сумма заказа </td>
		<td> Статус заказа </td>
		<td> Дата и время поступления заказа </td>
		<td> Операции </td>
	</tr>
</thead>

<tbody id="items">
	
	<?php $i = 0; ?>
	<?php foreach ($orders as $order): ?>
	<tr id="tr-<?= ++$i ?>" >
		<td> <?= $order->id ?> </td>
		<td> <?= $order->name ?> </td>
		<td> <?= $order->phone ?> </td>
		<td> <?= $order->email; ?> </td>
		<td> <?= $order->full_price ?> </td>
		<td> <?= $order->status ?> </td>
		<td><?=$order->date?></td>

		<td class="skip"> 
			<div class="btn-group">
				<a class="btn btn-green icon ajax-load" href="#" data-page="<?= CHtml::normalizeUrl(array('orders/view','id'=>$order->id))?>">i</a>
				<a class="btn btn-green icon" href="<?= $this->baseUrl ?>/admin/orders/printCheck/id/<?= $order->id ?>">f</a>
				<a class="btn btn-green icon confirm-delete" href="<?= CHtml::normalizeUrl(array('orders/delete','id'=>$order->id))?>">g</a>
			</div>
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
					if($(this).text().indexOf(value) >= 0)
						b = true;
				});
				if(!b) tr.hide(100);
				else tr.show(100);
			});
		});
	});
</script>
