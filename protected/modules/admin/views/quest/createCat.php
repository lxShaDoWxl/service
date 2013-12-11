<h2>Добавить тему</h2> <br/>
<form method="post" action="<?= CHtml::normalizeUrl(array('quest/savecat','id'=>'new'))?>">
	
	<table class="step-right">
		<tr>
			<td><strong>Название:</strong></td>
			<td><input class="input wide" name="name" type="text" required id="name"></td>
			<td></td>
		</tr>
		<tr>
			<td><strong>Эксперты:</strong></td>
			<td>
				<select name="experts[]" class='items'   multiple>

					<? foreach ($experts as $item): ?>
						<option value="<?= $item->id ?>"><?= $item->name ?></option>
					<? endforeach ?>
				</select>
			</td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><input type="submit" value="Создать" class="btn-green save-btn" id="submit"></td>
		</tr>
	</table>

</form>
<script type="text/javascript">
	$(function() {
		$('.items').chosen();
	});
</script>