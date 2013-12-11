<div class="left-pane">

	<ul>

		<div class="sort-cat">
			<?php foreach ($cats as $category): ?>
				<div class="category ajax-filter-category" data-id="<?= $category->id ?>" data-type="category">
					<li class="shower" data-show=".cat-<?= $category->id ?>">
						<a class="title"> <?= $category->name ?> </a>
						<a class="icon pull-right font-small pad5 confirm-delete" href="<?php echo CHtml::normalizeUrl(array('quest/deletecat','id'=>$category->id))?>">g</a>
						<a class="icon pull-right font-small pad5 ajax-load" data-page="<?php echo CHtml::normalizeUrl(array('quest/editcat','id'=>$category->id))?>" href="#i">i</a>
					</li>
				</div>
			<?php endforeach ?>
		</div>

		<li class="create"><a class="ajax-load"  href="#create" data-page=" <?php echo CHtml::normalizeUrl(array('quest/createcat'))?>"> + Добавить</a></li>
	</ul>

</div>

<div class="right-pane">

	<div class="search">
		<input class="input manti-clearer" placeholder="Поиск" id="search-input">
		<div class="input-clear" id="search-input">&times;</div>


	</div>

	<table class="table" style="width: 100%">

		<thead>
		<tr>
			<td> Вопрос </td>
			<td> Видимость </td>
			<td> Операции </td>
		</tr>
		</thead>

		<tbody id="items">



		</tbody>

	</table>

	<div class="btn-group" id="pagination">

	</div>
</div>

<script type="text/javascript">
	var filter = {};
	var limit;
	var offset;
	var itemcount = 0;
	$(function() {
		limit = 20;
		offset = 0;
		filter['limit'] = limit;
		// filter['category'] = "<?= $category->id ?>";
		filter['offset'] = 0;
		composeFilter();


		$(".ajax-filter-category").click(function(e) {
			if (filter[$(this).data('type')] == $(this).data('id')) {
				delete filter['category'];
			} else {
				delete filter['subcategory'];
				filter['category'] = $(this).data('id');
			}
			composeFilter();
		});
		function composeFilter() {
			var newHash = "";
			for (var i in filter) {
				if (filter.hasOwnProperty(i)) {
					newHash += i + "=" + filter[i] + "&";
				};
			};
			window.location.hash = '#'+newHash;
			$("#items").html('<tr> <td colspan="7" style="text-align: center;padding: 20px;"> <img src="<?= $this->baseUrl ?>/img/loader.gif"> </td> </tr>');
			$.post('',{filter:newHash},function(data){
				$("#items").html(data);
				if (data == ""){
					$('.more-products').remove();
				}
				if (offset == 0) {
					$('.catalog').html(data);
				} else {
					$('.catalog').append(data);
				}
				// ajaxInception();
				itemcount = $('#itemcount').text();
				$("#pagination").html('<a class="btn btn-green prev-page"> < </a>');
				for (var i = 1; i <= Math.ceil(itemcount / limit); i++) {
					$("#pagination").append("<a class='btn btn-green to-page'>" + i + "</a>");
				}
				$("#pagination").append('<a class="btn btn-green next-page"> > </a>');
				$(".next-page").unbind("click");
				$(".prev-page").unbind("click");
				$(".to-page").unbind("click");
				$('.next-page').click(function() {
					console.log((parseInt(filter['offset']) + parseInt(limit)) + " " + parseInt(itemcount));
					if (parseInt(itemcount) - (parseInt(filter['offset']) + parseInt(limit)) > 0) {
						filter['offset'] += limit;
						composeFilter();
					};
				});
				$('.prev-page').click(function() {
					if (filter['offset'] > 0) {
						filter['offset'] -= limit;
						composeFilter();
					};
				});
				$('.to-page').click(function() {
					filter['offset'] = (limit) * (parseInt($(this).html()) - 1);
					composeFilter();
				});
			});
		}

		$('.content').css('min-height',Math.max($('.left-pane').height(), $('.right-pane').height()) * 2);
	});
</script>