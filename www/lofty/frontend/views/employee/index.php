<?php

use app\models\Position;
use frontend\models\EmployeeFilter;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

/**
 * @var $employees  array
 * @var $pagination Pagination
 * @var $filters     EmployeeFilter
 */

?>
<div>
    <h1>Сотрудники</h1>
    <br>
    <a href="<?= Url::to(['employee/create']) ?>">
        <button>Добавить нового</button>
    </a>
    <br>
    <br>
    <br>
    <?php

    $form = ActiveForm::begin(
        [
            'id' => 'filter-form',
            'options' => ['class' => 'search-form'],
            'method' => 'get'
        ]
    );

    ?>

    <div style="border: black 1px solid">

        <fieldset>

            <legend class="checkbox-filter">Фильтр по должностям</legend>
            <?php echo $form->field(
                $filters,
                'positions',
                [
                    'template' => '{input}',
                    'labelOptions' => ['class' => 'checkbox__legend']
                ]
            )->checkboxList(
                Position::getPositionsForm(),
                [
                    'item' => function ($index, $label, $name, $checked, $value) {
                        $chek = $checked ? 'checked' : '';
                        return "<label class=\"checkbox__legend\">
                                <input class=\"visually-hidden checkbox__input\" type=\"checkbox\" name=\"{$name}\" value=\"{$value}\" {$chek}>
                                <span>{$label}</span>
                            </label>";
                    },
                ]
            ) ?>

        </fieldset>

        <fieldset>
            <legend>Поиск по имени</legend>
            <?php

            echo $form->field(
                $filters,
                'search',
                [
                    'template' => '{label}{input}',
                    'options' => ['class' => ''],
                    'labelOptions' => ['class' => '']
                ]
            )
                ->input(
                    'search',
                    [
                        'class' => 'input-middle input',
                        'style' => 'width: 100%'
                    ]
                );

            echo Html::submitButton('Искать', ['class' => 'button']);

            ActiveForm::end();

            ?>
            <br>
            <br>
            <div class="user__search-link">
                <p>Сортировать по:</p>
                <ul class="user__search-list">
                    <li class="user__search-item user__search-item--current">
                        <span>Дате найма</span>
                        <a href="?sort=hiring_date&direction=asc" class="link-regular" style="border: #1b3f5f 1px solid; margin: 3px;">
                            ↑
                        </a>
                        <a href="?sort=hiring_date&direction=desc" class="link-regular" style="border: #1b3f5f 1px solid; margin: 3px; padding: 2px">
                            ↓
                        </a>
                    </li>
                    <li class="user__search-item">
                        <span>Возрасту</span>
                        <a href="?sort=birthday&direction=asc" class="link-regular" style="border: #1b3f5f 1px solid; margin: 3px;">
                            ↑
                        </a>
                        <a href="?sort=birthday&direction=desc" class="link-regular" style="border: #1b3f5f 1px solid; margin: 3px; padding: 2px">
                            ↓
                        </a>
                    </li>
                </ul>
            </div>

        </fieldset>
    </div>

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