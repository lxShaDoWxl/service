<li>
	<div  class="comment"  style=" padding: 10px; border-bottom: 1px solid #E3E3E3;<?=($value_c->author->connectDebats(array('id_debat'=>$debat)))?'background-color: #F9F4E8;':''?>">
	<div class="author_com">
			<div class="author_img"><img width="54px" height="54px" src="<?= CHtml::normalizeUrl(array('image/resize', 'w'=> '54', 'h'=>'54', 'img_url'=>$value_c->author->img())); ?>">
			</div>
			<h4><?=$value_c->author->name?></h4>
			<p class="position"><?= isset($value_c->author->position)?$value_c->author->position:'' ?></p>
			<p class="date"><?= Yii::app()->dateFormatter->format('d MMMM в HH:mm', $value_c->date) ?></p>
		</div>
		<div style="float: left;width: 69%;"><p style="margin:4px;float: left" <?=(Yii::app()->user->checkAccess('100'))?'class="editable" data-model="CommentsDebat" data-pk="'.$value_c->id.'" data-field="comment"':''?>><?=$value_c->comment?></p>
			<?=(Yii::app()->user->checkAccess('100'))?'<div class="edit"><span class="action-edit">?</span> <span class="action-del">Í</span></div>':''?></div>
		<? if (!Yii::app()->user->isGuest && !($value_c->author->id==Yii::app()->user->getId())): ?>
			<div class="send_comment"><a href="#" data-id="<?= $value_c->id ?>"
										 class="answer_comment">Ответить</a></div>
		<? endif ?>
		<div id="answer_comment-<?=$value_c->id?>" class="comment-block js-comment-form js-dynamic-form" style="float: right; display: none;width: 69%;">

			<form method="post" enctype="multipart/form-data" action="<?= CHtml::normalizeUrl(array('site/DebCommentAnswer', 'id'=>$value_c->id)) ?>" class="add-comments-container" id="add-comments-<?=$value_c->id?>">
				<div class="add-comments-field">
					<div class="add-comments-field-inner">
						<textarea cols="30" rows="10" placeholder="Ваш ответ..." name="answer" class="js-text"></textarea>
					</div>
				</div>
				<div class="add-comments-buttons" style="width: 85%;">
					<input type="button" value="Ответить" class="js-send" data-id="<?=$value_c->id?>">
					<a href="#" class="js-close" data-id="<?=$value_c->id?>">Отмена</a>
				</div>
			</form>
		</div>
		<div style="width: 100%; height: 0px; clear: both">
		</div>
	</div>
		<div id="answer-<?=$value_c->id?>">
			<? if ($value_c->answerCommentDebats): ?>
				<? foreach($value_c->answerCommentDebats as $value): ?>
					<div class="author_answer" id="comment_answer-<?= $value->id?>">
						<div class="author_com" style="padding-top: 1%; overflow: hidden;">
							<div class="author_img"><img width="54px" height="54px"  src="<?= CHtml::normalizeUrl(array('image/resize', 'w'=> '54', 'h'=>'54', 'img_url'=>$value->author->img())); ?>"> </div>
							<h4><?= $value->author->name ?></h4>

							<p class="position"><?= isset($value->author->position) ? $value->author->position : '' ?></p>

							<p class="date"><?= Yii::app()->dateFormatter->format('d MMMM в HH:mm', $value->date) ?></p>
						</div>
						<div style="float: left;"><p style="margin:4px;float: left" <?=(Yii::app()->user->checkAccess('100'))?'class="editable" data-model="AnswerCommentDebat" data-pk="'.$value->id.'" data-field="answer"':''?>><?= $value->answer ?></p>
							<?=(Yii::app()->user->checkAccess('100'))?'<div class="edit"><span class="action-edit">?</span> <span class="action-del">Í</span></div>':''?></div>
					</div>
				<? endforeach ?>
			<? endif ?>
		</div>
</li>