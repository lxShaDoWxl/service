<?php foreach ($items as $item): ?>
	<tr>
		<td> <a class="ajax-load" href="#edit" data-page="<?= CHtml::normalizeUrl(array('catalog/Webinar','id'=>$item->id))?>"><?= $item->title ?></a> </td>
		<td><?= Yii::app()->dateFormatter->format('d MMMM yyyy',$item->date_start)?> </td>
		<td><?=Yii::app()->dateFormatter->format('d MMMM yyyy', $item->date_end)?> </td>
		<td class="skip" style="text-align: center;">
			<select class="ajax-switch isVisibli" data-id="<?= $item->id ?>">
				<option value="1"<?= ($item->isVisible)?" selected":"" ?>></option>
				<option value="0"<?= (!$item->isVisible)?" selected":"" ?>></option>
			</select>
		</td>
		<td class="skip">
			<div class="btn-group">
				<a class="btn btn-green icon ajax-load" href="#edit" data-page="<?= CHtml::normalizeUrl(array('catalog/Webinar','id'=>$item->id))?>">i</a>
				<a class="btn btn-green icon confirm-delete" href="<?= CHtml::normalizeUrl(array('catalog/deletedWebinar','id'=>$item->id))?>">g</a>
			</div>
		</td>
	</tr>
<?php endforeach ?>
<tr><td id="itemcount" style="display:none"><?= $itemCount ?></td></tr>

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
		$('.ajax-load').unbind('click');
		$('.ajax-load').click(function(event) {
			event.stopPropagation();
			$.ajax($(this).data('page')).done(function(data) {
				popup(data);
			});
			return false;
		});
		$('.confirm-delete').unbind('click');
		$('.confirm-delete').click(function() {
			var isConfirmed = confirm('Вы уверены?');
			if (isConfirmed) return true;
			else return false;
		});

		var ajaxSwitchIDisVisi = 0;
		$('.ajax-switch.isVisibli').each(function() {
			$(this).attr('data-sid', ajaxSwitchIDisVisi);
			temp = "";
			leftSpace = "";
			if ($(this).val() == 1) {
				temp = " true";
				leftSpace = "style='left: 1em;'"
			};
			$(this).after("<div class='ajax-switcher"+temp+" isVisibli' data-sid='"+ajaxSwitchIDisVisi+"' data-state='1'><div class='toggle' "+leftSpace+"></div></div>");
			$(this).hide();

			ajaxSwitchIDisVisi++;
		});
		var ajaxSwitchID = 0;
		$('.ajax-switch.isRec').each(function() {
			$(this).attr('data-sid', ajaxSwitchID);
			temp = "";
			leftSpace = "";
			if ($(this).val() == 1) {
				temp = " true";
				leftSpace = "style='left: 1em;'"
			};
			$(this).after("<div class='ajax-switcher"+temp+" isRec' data-sid='"+ajaxSwitchID+"' data-state='1'><div class='toggle' "+leftSpace+"></div></div>");
			$(this).hide();

			ajaxSwitchID++;
		});
		$('.ajax-switcher.isVisibli').click(function() {
			$(this).toggleClass('true');

			var thisSwitch = $('.ajax-switch[data-sid="'+$(this).data('sid')+'"]');
			if($(this).hasClass('true')) {
				$('.toggle', $(this)).animate({'left' : '1em'}, 200);
				thisSwitch.val(1);
			} else {
				$('.toggle', $(this)).animate({'left': '0em'}, 200);
				thisSwitch.val(0);
			}
			console.log(thisSwitch.data('id') + " " + thisSwitch.val());
<!--			$.get('--><?//= $this->baseUrl ?><!--/admin/catalog/ChangeItemVisibility/id/' + thisSwitch.data('id') + '/status/' + thisSwitch.val());-->
			$.get('<?=CHtml::normalizeUrl(array('catalog/WebinarVisible'))?>',{id:thisSwitch.data('id'), status:thisSwitch.val()}).done(humane.log('Изменено'));
		});
		$('.ajax-switcher.isRec').click(function() {
			$(this).toggleClass('true');

			var thisSwitch = $('.ajax-switch[data-sid="'+$(this).data('sid')+'"]');
			if($(this).hasClass('true')) {
				$('.toggle', $(this)).animate({'left' : '1em'}, 200);
				thisSwitch.val(1);
			} else {
				$('.toggle', $(this)).animate({'left': '0em'}, 200);
				thisSwitch.val(0);
			}
			console.log(thisSwitch.data('id') + " " + thisSwitch.val());
			$.get('<?= $this->baseUrl ?>/admin/catalog/ChangeItemRec/id/' + thisSwitch.data('id') + '/status/' + thisSwitch.val());
		});
	})
</script>