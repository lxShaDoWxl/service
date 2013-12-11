<?php $this->beginContent('//layouts/catalogMenu'); ?>
<?php $this->endContent(); ?>
<?php  $this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->bread,
    'htmlOptions'=>array('class'=>'breadcrumbs'),
    'tagName'=>'ul',
    'activeLinkTemplate'=>'<li><a href="{url}">{label}</a></li>',
    'inactiveLinkTemplate'=>'<li>{label}</li>',
    'homeLink'=>'<li><a href="'.Yii::app()->homeUrl.'">главная</a></li>',
    'separator'=>''
)); ?>
<h3><?=$info_name?></h3>
<?php if($infos){ ?>
    <ul class="catalog">
        <?foreach($infos as $info):?>

            <li style="display: block; width: initial;height: 90px;">
                <div class="title_info">
                    <a href="<?php echo CHtml::normalizeUrl(array('site/view','page'=>$info_action, 'id'=> $info->id))?>"  class="title"><?= $info->title; ?></a>
                    <span class="note" style="padding: 11px 0 0px;"><?php echo Yii::app()->dateFormatter->format('d MMMM yyyy', $info->date) ?></span>
                </div>
                <div>
<!--                    <img src="--><?//= $info->img(); ?><!--" alt="image description" width="150" height="150" align="left">-->
                    <?= $info->small_description; ?>
                </div>

            </li>
        <?endforeach?>

    </ul>
    <?$this->widget('CLinkPager', array(
        'header' => '', // пейджер без заголовка

        'firstPageLabel' => '>>',
        'prevPageLabel' => '<',
        'nextPageLabel' => '>',
        'lastPageLabel' => '<<',
        'cssFile'=> false,
        'pages' => $pages,
    ))?>
<?php } else{ ?>
    Информация отсутствует
<?php } ?>
</div>
</section>