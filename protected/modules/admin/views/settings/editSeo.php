<h2>Настройки SEO</h2><br/>
<div class="scrollable">

    <div class="tabulation" data-id="tabs-1">
        <a class="element active" data-id="tab-1">Основное</a>
        <a class="element" data-id="tab-2">Статьи</a>
        <a class="element" data-id="tab-3">Дискусии</a>
        <a class="element" data-id="tab-4">Мероприятия</a>
    </div>

    <div class="tabs" id="tabs-1">

        <div class="tab active" id="tab-1">
            <form action="<?= CHtml::normalizeUrl(array('settings/SaveSeo'))?>" method="POST">
                <? foreach($main as $m): ?>
                    <input type="hidden" name="seo[<?= $m->id ?>][id]" value="<?= $m->id ?>"/>
                <table>
                    <caption><b>
							<?
                            switch($m->page){
                                case 'index':
                                    echo 'Главная';
                                    break;
                                case 'debats':
                                    echo 'Дискусии';
                                    break;
                                case 'events':
                                    echo 'Мероприятия';
                                    break;
                                case 'articles':
                                    echo 'Статьи';
                                    break;
                            }?>
						</b>
					</caption>
                    <tbody>
                    <tr >
                     <td colspan="3">
                       Title :<br>
                        <textarea name="seo[<?= $m->id ?>][title]" class="input" style="width: 350px;"><?= isset($m->title)?$m->title:'' ?></textarea>
                     </td>
                     <td colspan="3">
                       Description:<br>
                        <textarea name="seo[<?= $m->id ?>][description]" class="input" style="width: 350px;"><?= isset($m->description)?$m->description:'' ?></textarea>
                      </td>
                      <td colspan="3">
                       Keywords:<br>
                            <textarea name="seo[<?= $m->id ?>][keywords]" class="input" style="width: 350px;"><?= isset($m->keywords)?$m->keywords:'' ?></textarea>
                       </td>
                    </tr>
                    </tbody>
                </table>
                <? endforeach; ?>
                <input type="submit" class="btn-green" value="Сохранить"/>
            </form>
        </div>
        <div class="tab" id="tab-2">
            <form action="<?php echo CHtml::normalizeUrl(array('settings/SaveSeo'))?>" method="POST">
                <? foreach($articles as $s): ?>
					<? if($s->seo):?>
						<input type="hidden" name="seo[<?= $s->id ?>][id]" value="<?= $s->seo->id ?>"/>
					<? endif; ?>
                    <input type="hidden" name="seo[<?= $s->id ?>][id_article]" value="<?= $s->id ?>"/>
                    <table>
                        <caption><b><?= $s->title?></b></caption>
                        <tbody>
                        <tr >
                            <td colspan="3">
                                Title :<br>
                                <textarea name="seo[<?= $s->id ?>][title]" class="input" style="width: 350px;"><?=isset($s->seo->title)? $s->seo->title:'' ?></textarea>
                            </td>
                            <td colspan="3">
                                Description:<br>
                                <textarea name="seo[<?= $s->id ?>][description]" class="input" style="width: 350px;"><?= isset($s->seo->description)? $s->seo->description:'' ?></textarea>
                            </td>
                            <td colspan="3">
                                Keywords:<br>
                                <textarea name="seo[<?= $s->id ?>][keywords]" class="input" style="width: 350px;"><?= isset($s->seo->keywords)? $s->seo->keywords:'' ?></textarea>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                <? endforeach; ?>
                <input type="submit" class="btn-green" value="Сохранить"/>
            </form>
        </div>

        <div class="tab" id="tab-3">
            <form action="<?= CHtml::normalizeUrl(array('settings/SaveSeo'))?>" method="POST">
                <? foreach($debats as $s):?>
					<? if($s->seo):?>
						<input type="hidden" name="seo[<?= $s->id ?>][id]" value="<?= $s->seo->id ?>"/>
					<? endif; ?>
                        <input type="hidden" name="seo[<?= $s->id ?>][id_debats]" value="<?= $s->id ?>"/>
                        <table>
                            <caption><b><?= $s->title?></b></caption>
                            <tbody>
                            <tr >
                                <td colspan="3">
                                    Title :<br>
                                    <textarea name="seo[<?= $s->id ?>][title]" class="input" style="width: 350px;"><?= isset($s->seo->title)?$s->seo->title:'' ?></textarea>
                                </td>
                                <td colspan="3">
                                    Description:<br>
                                    <textarea name="seo[<?= $s->id ?>][description]" class="input" style="width: 350px;"><?= isset($s->seo->description)?$s->seo->description:'' ?></textarea>
                                </td>
                                <td colspan="3">
                                    Keywords:<br>
                                    <textarea name="seo[<?= $s->id ?>][keywords]" class="input" style="width: 350px;"><?= isset($s->seo->keywords)?$s->seo->keywords:'' ?></textarea>
                                </td>
                            </tr>
                            </tbody>
                        </table>

             <? endforeach;?>
                <input type="submit" class="btn-green" value="Сохранить"/>
            </form>
        </div>
        <div class="tab" id="tab-4">
            <form action="<?= CHtml::normalizeUrl(array('settings/SaveSeo'))?>" method="POST">
                <? foreach($events as $s): ?>
							<? if($s->seo):?>
							<input type="hidden" name="seo[<?= $s->id ?>][id]" value="<?= $s->seo->id ?>"/>
							<? endif; ?>
                            <input type="hidden" name="seo[<?= $s->id ?>][id_events]" value="<?= $s->id ?>"/>
                            <table>
                                <caption><b><?= $s->title?></b></caption>
                                <tbody>
                                <tr >
                                    <td colspan="3">
                                        Title :<br>
                                        <textarea name="seo[<?= $s->id ?>][title]" class="input" style="width: 350px;"><?= isset($s->seo->title)? $s->seo->title:'' ?></textarea>
                                    </td>
                                    <td colspan="3">
                                        Description:<br>
                                        <textarea name="seo[<?= $s->id ?>][description]" class="input" style="width: 350px;"><?= isset($s->seo->description)? $s->seo->description:'' ?></textarea>
                                    </td>
                                    <td colspan="3">
                                        Keywords:<br>
                                        <textarea name="seo[<?= $s->id ?>][keywords]" class="input" style="width: 350px;"><?= isset($s->seo->keywords)?$s->seo->keywords:'' ?></textarea>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
				<? endforeach;?>
                <input type="submit" class="btn-green" value="Сохранить"/>
            </form>
        </div>
    </div>

</div>
<script>
    $('.tabulation .element').click(function() {
        $('.tabulation .element').removeClass('active');
        $(this).addClass('active');
        $('#' + $(this).parent().data('id') + ' > .tab').hide();
        $('#' + $(this).data('id')).show();

    });

</script>
