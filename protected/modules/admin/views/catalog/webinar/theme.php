<h2>Тема Вебинаров</h2> <br/>
<form method="post" action="<?= CHtml::normalizeUrl(array('catalog/saveThemeWebinar','id'=>isset($theme)?$theme->id:'new'))?>">

	<table class="step-right">
		<tr>
			<td><strong>Название:</strong></td>
			<td><input class="input wide" name="theme[title]" type="text" required id="name" value="<?=(isset($theme))?$theme->title:''?>"></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><input type="submit" value="Сохранение" class="btn-green save-btn" id="submit"></td>
		</tr>
	</table>

</form>
