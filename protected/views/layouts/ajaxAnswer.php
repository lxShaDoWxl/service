<div class="author_answer" id="comment_answer-<?= $value->id?>"  style="padding-top: 1%; overflow: hidden;<?=($value->author->connectDebats(array('id_debat'=>$debat)))?'background-color: #F9F4E8;':''?>" >
	<div class="author_com">
		<div class="author_img"><img width="54px" height="54px"  src="<?= CHtml::normalizeUrl(array('image/resize', 'w'=> '54', 'h'=>'54', 'img_url'=>$value->author->img())); ?>"> </div>
		<h4><?= $value->author->name ?></h4>

		<p class="position"><?= isset($value->author->position) ? $value->author->position : '' ?></p>

		<p class="date"><?= Yii::app()->dateFormatter->format('d MMMM в HH:mm', $value->date) ?></p>
	</div>
	<div style="float: left;"><p style="margin:4px;float: left" <?=(Yii::app()->user->checkAccess('100'))?'class="editable" data-model="AnswerCommentDebat" data-pk="'.$value->id.'" data-field="answer"':''?>><?= $value->answer ?></p>
		<?=(Yii::app()->user->checkAccess('100'))?'<div class="edit"><span class="action-edit">?</span> <span class="action-del">Í</span></div>':''?></div>
</div>