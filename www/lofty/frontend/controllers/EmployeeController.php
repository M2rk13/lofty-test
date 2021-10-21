<?php

namespace frontend\controllers;

use app\models\Employee;
use app\models\Position;
use frontend\models\EmployeeForm;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class EmployeeController extends Controller
{
    /**
     * Exception message not found Employee
     */
    public const NOT_FOUND_EMPLOYEE_EXCEPTION = 'Сотрудник не найден, проверьте правильность введенных данных';

    /**
     * Default quantity of Employees to view per page
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
        $employees = Employee::find();

        $pagination = new Pagination(
            [
                'defaultPageSize' => self::DEFAULT_POSITIONS_PAGINATION,
                'totalCount' => $employees->count(),
            ]
        );

        $employees->offset($pagination->offset);
        $employees->limit($pagination->limit);

        return $this->render(
            'index',
            [
                'employees' => $employees->all(),
                'pagination' => $pagination,
            ]
        );
    }


    /**
     * View page for create new Position
     */
    public function actionCreate()
    {
        $employee = new EmployeeForm();

        if ($employee->load(Yii::$app->request->post()) && $employee->createRecord()) {
            Yii::$app->session->setFlash('success', 'Сотрудник успешно добавлен');

            return $this->redirect(['../employees']);
        }

        $positions = Position::getPositions();

        return $this->render('create', [
            'employee' => $employee,
            'positions' => $positions,
        ]);
    }

    /**
     * Action delete Position
     *
     * @throws NotFoundHttpException
     */
    public function actionDelete($id): Response
    {
        $employee = Employee::findOne($id);

        if (empty($employee)) {
            throw new NotFoundHttpException(self::NOT_FOUND_EMPLOYEE_EXCEPTION, 404);
        }

        $employee->delete();

        return $this->goBack();
    }

    /**
     * View page of Position
     *
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $employee = Employee::findOne($id);

        if (empty($employee)) {
            throw new NotFoundHttpException(self::NOT_FOUND_EMPLOYEE_EXCEPTION, 404);
        }

        return $this->render('view', [
            'employee' => $employee,
        ]);
    }

    /**
     * View page for update Position
     *
     * @throws NotFoundHttpException
     */
    public function actionEdit($id)
    {
        $employeeModel = Employee::findOne($id);
        $employeeForm = new EmployeeForm($employeeModel);

        if (empty($employeeForm)) {
            throw new NotFoundHttpException(self::NOT_FOUND_EMPLOYEE_EXCEPTION, 404);
        }

        if ($employeeForm->load(Yii::$app->request->post()) && $employeeForm->updateRecord($employeeModel)) {
            Yii::$app->session->setFlash('success', 'Данные о сотруднике успешно обновлены');

            return $this->redirect(['../employees']);
        }

        $positions = Position::getPositions();

        return $this->render('create', [
            'employee' => $employeeForm,
            'positions' => $positions,
        ]);
    }

}
