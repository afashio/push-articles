<?php

namespace afashio\articles\backend\controllers;

use Yii;
use afashio\articles\models\ArticleCategory;
use afashio\articles\search\ArticleCategorySearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use voskobovich\tree\manager\actions\MoveNodeAction;
use voskobovich\tree\manager\actions\DeleteNodeAction;
use voskobovich\tree\manager\actions\UpdateNodeAction;
use voskobovich\tree\manager\actions\CreateNodeAction;

/**
 * ServiceCategoryController implements the CRUD actions for ServiceCategory model.
 */
class ArticleCategoryController extends Controller
{

    /**
     * {@inheritDoc}
     */
    public function actions()
    {
        $modelClass = ArticleCategory::class;

        return [
            'moveNode' => [
                'class' => MoveNodeAction::class,
                'modelClass' => $modelClass,
            ],
            'deleteNode' => [
                'class' => DeleteNodeAction::class,
                'modelClass' => $modelClass,
            ],
            'updateNode' => [
                'class' => UpdateNodeAction::class,
                'modelClass' => $modelClass,
            ],
            'createNode' => [
                'class' => CreateNodeAction::class,
                'modelClass' => $modelClass,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ServiceCategory models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(
            'index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]
        );
    }

    /**
     * Displays a single ServiceCategory model.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render(
            'view', [
                'model' => $this->findModel($id),
            ]
        );
    }

    /**
     * Creates a new ServiceCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ArticleCategory();
        $root = ArticleCategory::find()->roots()->one();
        $model->prependTo($root);
        if ($model->saveModelWithImage()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render(
            'create', [
                'model' => $model,
            ]
        );
    }

    /**
     * Updates an existing ServiceCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->saveModelWithImage()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render(
            'update', [
                'model' => $model,
            ]
        );
    }

    /**
     * Deletes an existing ServiceCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ServiceCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return ArticleCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): ArticleCategory
    {
        if (($model = ArticleCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
