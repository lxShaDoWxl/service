<h2 class="art_title" style="width: 100%;">Личный кабинет</h2>
<ul class="clearfix about" style="font-size: 13px">
	<li style="float: left;">
		<a href="<?= CHtml::normalizeUrl(array('user/lk')) ?>" <?=($index=='main')?'class="active"':''?>>Персональные данные</a>
	</li>
	<li style=" float: left;">
		<a href="<?= CHtml::normalizeUrl(array('user/lk', 'action'=>'password')) ?>" <?=($index=='password')?'class="active"':''?>>Смена пароля</a>
	</li>
	<li style="float: left;">
		<a href="<?= CHtml::normalizeUrl(array('user/lk',  'action'=>'favorits')) ?>"<?=($index=='favorits')?'class="active"':''?>>Избранное</a>
	</li>
	<li style="float: left;">
		<a href="<?= CHtml::normalizeUrl(array('user/lk',  'action'=>'comment')) ?>"<?=($index=='comment')?'class="active"':''?>>Комментарии</a>
	</li>
	<li style="float: left;">
		<a href="<?= CHtml::normalizeUrl(array('user/lk',  'action'=>'quest')) ?>"<?=($index=='quest')?'class="active"':''?>>Вопросы и ответы</a>
	</li>
</ul>
<div class="form_register" style="padding-top: 35px;">
	<? if ($index=='main'): ?>
	<form action="" class="lk" method="post" enctype="multipart/form-data">
		<fieldset>
			<div class="row">
				<label>Ваше Имя<span></span></label>
				<input type="text" class="text " name="user[name]" value="<?= $user->name ?>"/>
			</div>
			<div class="row">
				<label>Должность</label>
				<input type="text" class="text " name="user[position]" value="<?= $user->position ?>"/>
			</div>
			<div class="row">
				<label>Организация</label>
				<input type="text" class="text " name="user[company]" value="<?= $user->company ?>"/>
			</div>
			<div class="row">
				<label>Контактный телефон</label>
				<input type="text" class="text" name="user[phone]" value="<?= $user->phone ?>"/>
			</div>
			<div class="row">
				<label>E-mail (логин)</label>
				<input type="email" class="text" name="user[mail]" value="<?= $user->mail ?>"/>
			</div>
			<div class="row">
				<label>Фотография</label>
				<img width="108px" src="<?= $user->img() ?>"/>
				<input type="file" class="text" name="img"/>
			</div>
			<div style="padding: 2% 18%;">
				<input class="send" value="Сохранить" type="submit" class="savesubmit">
			</div>
		</fieldset>
	</form>
	<script type="text/javascript">

		$(function () {
			$('.savesubmit').click(function () {
				$('.lk').submit();
			});

		});
	</script>
<? endif ?>
	<? if ($index=='password'): ?>
	<form action="" class="lk" method="post" enctype="multipart/form-data">
		<fieldset>
			<div class="row">
				<label>Старый пароль<span></span></label>
				<input type="text" class="text " name="password" />
			</div>
			<div class="row">
				<label>Новый пароль<span></span></label>
				<input type="text" class="text " name="newpassword" />
			</div>
			<div style="padding: 2% 18%;">
				<input class="send" value="Сохранить" type="submit" class="savesubmit">
			</div>
		</fieldset>
	</form>
	<script type="text/javascript">

		$(function () {
			$('.savesubmit').click(function () {
				$('.lk').submit();
			});

		});
	</script>
	<? endif ?>
	<? if ($index=='favorits'): ?>
	<? if ($user->favorites): ?>
		<? foreach ($user->favorites as $value): ?>
			<div style="float: left;
width: 100%;
max-width: 708px;
font-family: 'PT Sans', sans-serif;
font-size: 12px;">
				<p style="float: left;font: 12px/20px Arial;"><?= Yii::app()->dateFormatter->format('d MMMM', $value->idArticle->date) ?></p>
				<a href="<?= CHtml::normalizeUrl(array('site/articles', 'cat'=>$value->idArticle->cid)) ?>" style="float: left;padding-right: 10px;padding-left: 10px;color: #c79533;"><?=$value->idArticle->c->title?></a>
				<? if ($value->idArticle->author0): ?>
					<span>Автор:<?= $value->idArticle->author0->name ?></span>
				<? endif ?>
				<a href="<?= CHtml::normalizeUrl(array('site/article', 'id'=>$value->idArticle->id)) ?>" style="color: #c79533;"><?=$value->idArticle->title?></a>
				<a href="" class="favorits_remove" data-id="<?=$value->id?>" style="float: right;color: #c79533;">Удалить</a>
				<span style="padding-top: 5px;
float: left;
margin-bottom: 20px;
padding-bottom: 10px;
padding-right: 8%;
border-bottom: 1px solid #dddddd;"><?=$value->idArticle->small_description?> </span>
			</div>
		<? endforeach ?>
			<script type="application/javascript">
				$(document).ready(function() {
					$('.favorits_remove').click(function(e){
						e.preventDefault();
						jQuery.ajax({
							'type':'POST',
							'data':{'id':$(this).data("id")},
							'success':function(){
								location.reload();
							},
							'url':'<?= CHtml::normalizeUrl(array('user/DelFavorit')) ?>','cache':false
						});
					});
				});
			</script>
	<? endif ?>
	<? endif ?>
	<? if ($index=='quest'): ?>
		<? if (Yii::app()->user->checkAccess('77')): ?>
			<ul class="clearfix about" style="font-size: 13px">
				<li style="float: left;">
					<a href="<?= CHtml::normalizeUrl(array('user/lk', 'action' => 'quest', 'sub_q' => 'quests')) ?>" <?= ($index_sub == 'quests') ? 'class="active"' : '' ?>>Новые</a>
				</li>
				<li style=" float: left;">
					<a href="<?= CHtml::normalizeUrl(array('user/lk', 'action' => 'quest', 'sub_q' => 'answer')) ?>" <?= ($index_sub == 'answer') ? 'class="active"' : '' ?>>Отвеченные</a>
				</li>
			</ul>
		<? endif ?>
		<div class="quest-section" style="padding-top: 2%;">
			<ul>
				<? if ($quests): ?>
					<? foreach ($quests as $value): ?>
						<li>
							<a href="<?= CHtml::normalizeUrl(array('site/experts', 'cat' => $value->id_theme)); ?>"><?= $value->idTheme->name ?></a>

							<div style="padding: 1% 0%;font: 14px/18px 'Times New Roman';"><?= $value->body ?> </div>
							<div style="color: #a6a6a6;"><?= $value->user_name?:$value->idUser->name ?>
								, <?= Yii::app()->dateFormatter->format('d MMMM, HH:mm', $value->date); ?></div>
							<? if ($value->answer): ?>
								<div class="answer-expert" id="answer-expert-<?= $value->id ?>">
									<div class="db_speaker">
										<div class="db_s_img"><img src="<?= $value->idExpert->img() ?>" width="54px"
																   height="54px"></div>
										<div class="db_s_inf">
											<h4><?= $value->idExpert->name ?></h4>

											<p><?= $value->idExpert->position ?></p>
										</div>
									</div>
									<div style="padding: 4% 4% 0;"> <?= $value->answer ?></div>
								</div>
								<a class="expert" href="#" data-id="<?= $value->id ?>">Ответ эксперта</a>
							<? else:?>
								<? if(Yii::app()->user->checkAccess('77')): ?>
								<div class="answer-expert" id="answer-expert-<?= $value->id ?>">
									<form method="post" enctype="multipart/form-data" action="<?= CHtml::normalizeUrl(array('user/SendAnswer')) ?>" class="add-comments-container">
										<div class="add-comments-field">
											<div class="add-comments-field-inner">
												<input type="hidden" name="id" value="<?=$value->id?>">
												<textarea cols="30" rows="10" placeholder="Ваш ответ..." name="answer" class="js-text" style="max-width: 80%"></textarea>
											</div>
										</div>
											<input type="submit" value="Ответить" class="js-send" style="margin-bottom: 0;">
									</form>
								</div>
								<a href="#" data-id="<?= $value->id ?>" class="expert">Ответить</a>

							<? endif; ?>

							<? endif;?>
						</li>
					<? endforeach ?>
				<? endif ?>
			</ul>
		</div>
		<div style="padding: 16px;">
			<?$this->widget('CLinkPager', array(
				'header' => '', // пейджер без заголовка
				'firstPageLabel' => '>>',
				'prevPageLabel' => '<',
				'nextPageLabel' => '>',
				'lastPageLabel' => '<<',
				'pages' => $pages,
			))?>
		</div>
	<? endif ?>
	<? if ($index=='comment'): ?>
		<? if ($articles): ?>
			<? foreach ($articles as $value): ?>
			<div style="float: left;width: 100%;max-width: 708px;font-family: 'PT Sans', sans-serif;font-size: 12px;">
				<p style="float: left;font: 12px/20px Arial;">
					<?=$value->comment?></p>

<!--				<a href="" class="commet_remove" data-id="--><?//=$value->id?><!--" style="float: right;color: #c79533;">Удалить</a>-->
				<span style="padding-top: 5px;float: left;margin-bottom: 20px;padding-bottom: 10px;padding-right: 8%;border-bottom: 1px solid #dddddd;padding-left: 8%;">
				<div>
					<div style="color: #a6a6a6;"><?= Yii::app()->dateFormatter->format('d MMMM, HH:mm', $value->date); ?> к статье</div>
					<a href="<?= CHtml::normalizeUrl(array('site/article', 'id'=>$value->catalog->id)) ?>" style="color: #c79533;"><?=$value->catalog->title?></a>
				</div>
					<?=$value->catalog->small_description?> </span>
			</div>
		<? endforeach ?>
			<script type="application/javascript">
				$(document).ready(function() {
					$('.favorits_remove').click(function(e){
						e.preventDefault();
						jQuery.ajax({
							'type':'POST',
							'data':{'id':$(this).data("id")},
							'success':function(){
								location.reload();
							},
							'url':'<?= CHtml::normalizeUrl(array('user/DelFavorit')) ?>','cache':false
						});
					});
				});
			</script>
		<? endif ?>
	<? endif ?>

</div>