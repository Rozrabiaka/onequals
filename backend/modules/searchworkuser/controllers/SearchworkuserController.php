<?php

namespace backend\modules\searchworkuser\controllers;

use backend\models\SearchWorkUserFilter;
use common\models\Locality;
use common\models\SearchWorkUser;
use common\models\Specializations;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SearchworkuserController implements the CRUD actions for SearchWorkUser model.
 */
class SearchworkuserController extends Controller
{
	/**
	 * @inheritDoc
	 */
	public function behaviors()
	{
		return array_merge(
			parent::behaviors(),
			[
				'verbs' => [
					'class' => VerbFilter::className(),
					'actions' => [
						'delete' => ['POST'],
					],
				],
				'access' => [
					'class' => AccessControl::className(),
					'rules' => [
						[
							'actions' => ['index', 'view', 'create', 'update', 'delete'],
							'allow' => true,
							'roles' => ['administrator', 'moderator'],
						]
					]
				]
			]
		);
	}

	/**
	 * Lists all SearchWorkUser models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new SearchWorkUserFilter();
		$dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel
		]);
	}

	/**
	 * Displays a single SearchWorkUser model.
	 * @param int $id ID
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionView($id)
	{
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

//    /**
//     * Creates a new SearchWorkUser model.
//     * If creation is successful, the browser will be redirected to the 'view' page.
//     * @return mixed
//     */
//    public function actionCreate()
//    {
//        $model = new SearchWorkUser();
//
//        if ($this->request->isPost) {
//            if ($model->load($this->request->post()) && $model->save()) {
//                return $this->redirect(['view', 'id' => $model->id]);
//            }
//        } else {
//            $model->loadDefaultValues();
//        }
//
//        return $this->render('create', [
//            'model' => $model,
//        ]);
//    }

	/**
	 * Updates an existing SearchWorkUser model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param int $id ID
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($this->request->isPost) {
			$model->load($this->request->post());
			$model->country = $this->request->post('SearchWorkUser')['hiddenCountry'];
			if($model->save())
				return $this->redirect(['view', 'id' => $model->id]);
		}

		$locality = new Locality();
		$specializations = Specializations::find()->asArray()->all();
		$specializationDropDownArray = ArrayHelper::map($specializations, 'id', 'name');
		$countryName = $locality->getLocalityNameById($model->country);

		\Yii::$app->getView()->registerJsFile(\Yii::$app->request->baseUrl . '/js/autocomplete/autocomplete-ui.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
		\Yii::$app->getView()->registerJsFile(\Yii::$app->request->baseUrl . '/js/autocomplete/autocomplete-0.3.0.min.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
		\Yii::$app->getView()->registerJsFile(\Yii::$app->request->baseUrl . '/js/autocomplete/searchLocation.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);

		return $this->render('update', [
			'model' => $model,
			'specializationDropDownArray' => $specializationDropDownArray,
			'countryName' => $countryName
		]);
	}

	/**
	 * Deletes an existing SearchWorkUser model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param int $id ID
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the SearchWorkUser model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param int $id ID
	 * @return SearchWorkUser the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = SearchWorkUser::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}
}
