<?php

use yii\data\Pagination;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/**
 * @var $positions  array
 * @var $pagination Pagination
 */

?>
<div>
    <h1>Должности</h1>
    <br>
    <a href="<?= Url::to(['position/create']) ?>">
        <button>Добавить новую</button>
    </a>
    <br>
    <div class="wrapper">
        <div>Название должности</div>
        <div>Заработная плата</div>
        <div>Показать</div>
        <div>Изменить</div>
        <div>Удалить</div>
        <?php foreach ($positions as $position) { ?>
            <div><?= $position->name ?></div>
            <div><?= round($position->salary, 2) ?></div>
            <div><a href="<?= Url::to(['position/view', 'id' => $position->id]) ?>">
                    <button>👁</button>
                </a></div>
            <div>
                <a href="<?= Url::to(['position/edit', 'id' => $position->id]) ?>">
                    <button>✎</button>
                </a>
            </div>
            <div>
                <a href="<?= Url::to(['position/delete', 'id' => $position->id]) ?>">
                    <button>❌</button>
                </a>
            </div>
        <?php } ?>
    </div>

    <div>

        <?= LinkPager::widget(
            [
                'pagination' => $pagination,
                'options' => [
                    'class' => 'pagination-list',
                ],
                'activePageCssClass' => 'pagination__item--current',
                'pageCssClass' => 'pagination__item',
                'prevPageCssClass' => 'pagination__item',
                'nextPageCssClass' => 'pagination__item',
                'nextPageLabel' => 'next',
                'prevPageLabel' => 'prev',
                'hideOnSinglePage' => true
            ]
        ) ?>

    </div>

</div>