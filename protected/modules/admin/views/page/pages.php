<table class="table">
	<div class="search">
		<a href="" class="btn-green ajax-load" data-page="<?php echo CHtml::normalizeUrl(array('page/createPage'))?>"> + Добавить страницу</a>
	</div>
	<thead>
		<td>ID</td>
		<td>Заголовок</td>
		<td>URL в адресной строке</td>
		<td>Операции</td>
	</thead>
	<tbody>
		<?php foreach ($pages as $page): ?>
			<tr>
				<td><?= $page->id ?></td>
				<td><?= $page->title ?></td>
				<td><a href="<?= $this->baseUrl ?>/admin//<?= $page->url ?>">/<?= $page->url ?></a></td>
				<td>
					<div class="btn-group">
						<a class="btn btn-green icon ajax-load" href="#edit" data-page="<?php echo CHtml::normalizeUrl(array('page/editpage', 'id'=>$page->id))?>">i</a>
						<a class="btn btn-green icon confirm-delete" href="<?php echo CHtml::normalizeUrl(array('page/deletepage', 'id'=>$page->id))?> ">g</a>
					</div>
				</td>	
			</tr>
		<?php endforeach ?>
	</tbody>
</table>