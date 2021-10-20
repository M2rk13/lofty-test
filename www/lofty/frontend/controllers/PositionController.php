<?php

namespace frontend\controllers;

use app\models\Position;
use frontend\models\PositionForm;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class PositionController extends Controller
{
    /**
     * Exception message not found Position
     */
    public const NOT_FOUND_POSITION_EXCEPTION = 'Должность не найдена, проверьте правильность введенных данных';

    /**
     * Default quantity of positions to view per page
     */
    private const DEFAULT_POSITIONS_PAGINATION = 10;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'edit', 'delete', 'create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'view', 'edit', 'delete', 'create'],
                        'allow' => false,
                        'roles' => ['@'],
                        'denyCallback' => function ($rule, $action) {
                            return $action->controller->redirect('/login');
                        }
                    ],
                ],
            ],
        ];
    }

    /**
     * View page with all Positions
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $positions = Position::find();

        $pagination = new Pagination(
            [
                'defaultPageSize' => self::DEFAULT_POSITIONS_PAGINATION,
                'totalCount' => $positions->count(),
            ]
        );

        $positions->offset($pagination->offset);
        $positions->limit($pagination->limit);

        return $this->render(
            'index',
            [
                'positions' => $positions->all(),
                'pagination' => $pagination,
            ]
        );
    }


    /**
     * View page for create new Position
     */
    public function actionCreate()
    {
        $position = new PositionForm();

        if ($position->load(Yii::$app->request->post()) && $position->createRecord()) {
            Yii::$app->session->setFlash('success', 'Должность успешно добавлена в список');

            return $this->redirect(['../positions']);
        }

        return $this->render('create', [
            'position' => $position,
        ]);
    }

    /**
     * Action delete Position
     *
     * @throws NotFoundHttpException
     */
    public function actionDelete($id): Response
    {
        $position = Position::findOne($id);

        if (empty($position)) {
            throw new NotFoundHttpException(self::NOT_FOUND_POSITION_EXCEPTION, 404);
        }

        $position->delete();

        return $this->goBack();
    }

    /**
     * View page of Position
     *
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $position = Position::findOne($id);

        if (empty($position)) {
            throw new NotFoundHttpException(self::NOT_FOUND_POSITION_EXCEPTION, 404);
        }

        return $this->render('view', [
            'position' => $position,
        ]);
    }

    /**
     * View page for update Position
     *
     * @throws NotFoundHttpException
     */
    public function actionEdit($id)
    {
        $positionModel = Position::findOne($id);
        $positionForm = new PositionForm($positionModel);

        if (empty($positionModel)) {
            throw new NotFoundHttpException(self::NOT_FOUND_POSITION_EXCEPTION, 404);
        }

        if ($positionForm->load(Yii::$app->request->post()) && $positionForm->updateRecord($positionModel)) {
            Yii::$app->session->setFlash('success', 'Должность успешно обновлена');

            return $this->redirect(['../positions']);
        }

        return $this->render('create', [
            'position' => $positionForm,
        ]);
    }

}
