<h2>Изменить тему</h2> <br/>
<form method="post" action="<?php echo CHtml::normalizeUrl(array('quest/savecat','id'=>$cats->id))?>">
	
	<table class="step-right">
		<tr>
			<td><strong>Название:</strong></td>
			<td><input class="input wide" name="name" type="text" required id="name" value="<?= $cats->name ?>"></td>
			<td></td>
		</tr>

		<tr>
			<td><strong>Эксперты:</strong></td>
			<td>
				<select name="experts[]" class='items'   multiple>
					<? foreach ($experts as $item): ?>
						<? if ($item->questionThemeExperts): ?>
							<? foreach($item->questionThemeExperts as $value): ?>
								<?  if($value->id_theme==$cats->id):?>
								<option value="<?= $item->id ?>" selected><?= $item->name ?></option>
								<? endif ?>
							<? endforeach ?>
						<? else: ?>

							<option value="<?= $item->id ?>"><?= $item->name ?></option>
						<? endif ?>
					<? endforeach ?>
				</select>
			</td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="Сохранить" class="btn-green save-btn" id="submit"></td>
		</tr>
	</table>

</form>
<script type="text/javascript">
	$(function() {
		$('.items').chosen();
	});
</script>