<h2>Заказ номер <?= $order->id ?></h2>
<br/>
<div class="scrollable">
	<div class="tabulation" data-id="tabs-1">
		<a class="element active" data-id="tab-1">Товары</a>
		<a class="element " data-id="tab-2">Информация</a>
	</div>
	<div class="tabs" id="tabs-1">
		
		<div class="tab active" id="tab-1">
			<form method="POST" action="<?= CHtml::normalizeUrl(array('orders/SaveOrder', 'id'=>$order->id))?>">
				<table class="table">
					<thead>
						<tr>

							<td> Код товара </td>
                            <td> Название</td>
							<td> Количество </td>
							<td> Цена за единицу</td>
							<td> Цена </td>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($order->ordersItems as $item): ?>
						<tr>
							<td> <?= $item->idItem->id ?> </td>
							<td> <?= $item->idItem->title ?> </td>
							<td> <?= $item->count ?></td>
							<td> <?= $item->price ?></td>
							<td><?= $item->price*$item->count ?> </td>
						</tr>
						<?php endforeach ?>
					</tbody>	
				</table>
				<input type="submit" class="btn-green" value="Сохранить"/>
			</form>
		</div>
		<div class="tab" id="tab-2">
		<form method="POST" action="<?= CHtml::normalizeUrl(array('orders/SaveOrder', 'id'=>$order->id))?>">
			<table>
				<tbody>
					<tr>
						<td><strong>Номер заказа</strong></td><td><input type="text" class="input" value="<?= $order->id ?>" name="id"></td>
					</tr>
					<tr>
						<td><strong> Имя клиента </strong></td><td><input type="text" class="input" value="<?= $order->name ?>" name="name"></td>
					</tr>
					<tr>
						<td> <strong>Телефон клиента</strong> </td><td><input type="text" class="input" value="<?= $order->phone ?>" name="phone"></td>
					</tr>
					<tr>	
						<td> <strong>Электронный адрес клиента </strong></td>
						<td> <input type="text" class="input" value="<?= $order->email; ?>" name="email"> </td>

					</tr>
					<tr>
						<td><strong> Сумма заказа </strong></td><td><input type="text" class="input" value="<?= $order->full_price ?>" name="full_price"></td>
					</tr>
					<tr>
						<td> <strong>Дата и время поступления заказа</strong> </td><td><input type="text" class="input" value="<?= $order->date ?>" name="date"></td>
					</tr>
					<tr>
						<td> <strong>Статус заказа</strong> </td>
						<td>
							<select class="input" name="status">
								<option value="Доставлен" <?= $order->status == "Доставлен"?"selected":"" ?>>Доставлен</option>
								<option value="В обработке" <?= $order->status == "В обработке"?"selected":"" ?>>В обработке</option>
								<option value="Отмененный" <?= $order->status == "Отмененный"?"selected":"" ?>>Отмененный</option>
							</select>
						</td>
					</tr>
					<tr>
						<td> <strong>Адрес доставки</strong> </td><td><input type="text" class="input" value="<?= $order->address ?>" name="address"></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" class="btn-green" value="Сохранить"></td>
					
					</tr>
				</tbody>
			</table>
		</form>
		</div>

	</div>
</div>

<script type="text/javascript">
	$(function(){
		$('.tabulation .element').click(function() {
			$('.tabulation .element').removeClass('active');
			$(this).addClass('active');
			$('#' + $(this).parent().data('id') + ' > .tab').hide();

			$('#' + $(this).data('id')).show();
		});
		
	});
</script>