<?php

use yii\data\Pagination;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/**
 * @var $employees  array
 * @var $pagination Pagination
 */

?>
<div>
    <h1>Сотрудники</h1>
    <br>
    <a href="<?= Url::to(['employee/create']) ?>">
        <button>Добавить нового</button>
    </a>
    <br>
    <div class="wrapper wrapper-employee">
        <div>Имя</div>
        <div>Возраст</div>
        <div>Дата найма</div>
        <div>Должность</div>
        <div>Показать</div>
        <div>Изменить</div>
        <div>Удалить</div>
        <?php foreach ($employees as $employee) { ?>
            <div><?= $employee->name ?></div>
            <div><?= date_diff(new DateTime(), new DateTime($employee->birthday))->y ?></div>
            <div><?= date('d.M.y', strtotime($employee->hiring_date)) ?></div>
            <div><?= $employee->position->name ?></div>
            <div>
                <a href="<?= Url::to(['employee/view', 'id' => $employee->id]) ?>">
                    <button>👁</button>
                </a>
            </div>
            <div>
                <a href="<?= Url::to(['employee/edit', 'id' => $employee->id]) ?>">
                    <button>✎</button>
                </a>
            </div>
            <div>
                <a href="<?= Url::to(['employee/delete', 'id' => $employee->id]) ?>">
                    <button>❌</button>
                </a>
            </div>
        <?php } ?>
    </div>

    <div class="new-task__pagination">

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