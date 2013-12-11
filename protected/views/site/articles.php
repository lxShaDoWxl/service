
    <div class="grid_m_left"> <!-- LEFT COLUMN -->

        <div class="grid_m_left_left">
            <h2 class="art_title">Статьи</h2>

            <div class="discussion_box clearfix"><!-- START DISCUSSINS -->
				<?$i=0;?>
				<ul class="article_item">
                <? foreach($articles as $article): ?>
						<li class="item_catalog" >
							<div ><a href="<?= CHtml::normalizeUrl(array('site/article', 'id'=>$article->id));?>"><img src="<?= $article->img() ?>" width="100%"></a>
								<h3 style="padding-top: 3%;">
									<a class="article_theme" href="<?= CHtml::normalizeUrl(array('site/articles', 'cat'=>$article->c->id));?>"><?=$article->c->title?></a>
									<a href="<?= CHtml::normalizeUrl(array('site/article', 'id'=>$article->id));?>" style="font-size: 90%;"><?= $article->title ?></a></h3>
								<p><?= $article->small_description ?> </p>
								<a class="widget" >X<span style="padding: 0px 10px 0 5px;"><?= $article->view?></span></a>
								<a class="widget">s<span><?=count($article->commentCatalogs)?></span></a>
							</div>
						</li>


                <? $i++; endforeach ?>
				</ul>
				<? $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
					'contentSelector' => '.article_item',
					'itemSelector' => '.item_catalog',
					'loadingText' => 'Loading...',
					'donetext' => '',
					'pages' => $pages,
				)); ?>
            </div><!-- END DISCUSSINS -->

        </div>

        <div class="grid_m_left_right">
            <h2 class="art_title" style="font-size: 13px;padding-bottom: 9px;">Темы</h2>

            <ul class="article_box"><!-- START ACTUAL -->
            <? foreach($category as $cat): ?>
                <li><a href="<?= CHtml::normalizeUrl(array('site/articles', 'cat'=>$cat->id));?>" class="<?=($art_cat==$cat->id)?'actual_box_active':''?>"><?=$cat->title ?></a></li>
            <? endforeach ?>
            </ul><!-- END ACTUAL -->

        </div>
        <div class="grid_m_left_center">

            <div class="horizontal_bunner"><!-- START HORIZONTAL BUNNER -->
				<? $banner_header= Banner::model()->findAllByAttributes(array('position'=>'620x130'), '`date_end`>=:date_e AND `date_start`<=:date_s', array(':date_e'=>date('Y-m-d'), ':date_s'=>date('Y-m-d')));
				?>
				<? if ($banner_header): ?>
					<?$number_ban = mt_rand(0, count($banner_header) - 1);?>
					<? if ($banner_header[$number_ban]->exist()!='swf'): ?>
						<a href="<?= CHtml::normalizeUrl(array('site/banner', 'id' => $banner_header[$number_ban]->id)) ?>" target="_blank">
							<img style="display: inline;"  src="<?= $banner_header[$number_ban]->img ?>"/></a>
					<? endif ?>
					<? if ($banner_header[$number_ban]->exist()=='swf'): ?>
						<div class="banner" data-id="<?=$banner_header[$number_ban]->id?>">
							<object type="application/x-shockwave-flash" width="100%" height="130px">
								<param name="movie" value="<?= $banner_header[$number_ban]->img ?>"></param>
								<param name="wmode" value="opaque"></param>
							</object>
						</div>
					<? endif ?>
				<? endif ?>
            </div><!-- END HORIZONTAL BUNNER -->
            <div class="popular_box"><!-- START POPULAR -->
                <h2 class="art_title">Популярное</h2>
                <ul class="clearfix">
					<? $populars=Catalog::model()->findAll('isVisible=1 ORDER BY view DESC LIMIT 3')?>
					<? foreach($populars as $popular): ?>
						<li>
							<div class="pop_b_img"><a href="<?= CHtml::normalizeUrl(array('site/article', 'id' => $popular->id)); ?>"><img src="<?=$popular->img()?>"></a></div>
							<div class="pop_b_inf">
								<span><?=$popular->c->title?></span>
								<h3><a href="<?= CHtml::normalizeUrl(array('site/article', 'id' => $popular->id)); ?>"><?=$popular->title?></a></h3>
								<p><?=$popular->small_description?></p>
							</div>
						</li>
					<? endforeach ?>
                </ul>
            </div><!-- END POPULAR -->

        </div>
    </div>
    <?php $this->beginContent('//layouts/columnRight'); ?>
    <?php $this->endContent(); ?>