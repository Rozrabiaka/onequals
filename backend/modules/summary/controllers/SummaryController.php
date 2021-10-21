<?php

namespace backend\modules\summary\controllers;

use common\models\EmploymentType;
use common\models\Locality;
use common\models\Specializations;
use common\models\Summary;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SummaryController implements the CRUD actions for Summary model.
 */
class SummaryController extends Controller
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
			]
		);
	}

	/**
	 * Lists all Summary models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$dataProvider = new ActiveDataProvider([
			'query' => Summary::find(),
			/*
			'pagination' => [
				'pageSize' => 50
			],
			'sort' => [
				'defaultOrder' => [
					'id' => SORT_DESC,
				]
			],
			*/
		]);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Summary model.
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
//     * Creates a new Summary model.
//     * If creation is successful, the browser will be redirected to the 'view' page.
//     * @return mixed
//     */
//    public function actionCreate()
//    {
//        $model = new Summary();
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
	 * Updates an existing Summary model.
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
			$model->country = $this->request->post('Summary')['hiddenCountry'];

			if ($model->save()) {
				return $this->redirect(['view', 'id' => $model->id]);
			}
		}

		$specializations = Specializations::find()->asArray()->all();
		$employerType = EmploymentType::find()->asArray()->all();
		$locality = new Locality();
		$countryName = $locality->getLocalityNameById($model->country);

		$specializationDropDownArray = ArrayHelper::map($specializations, 'id', 'name');
		$employmentTypeDropDownArray = ArrayHelper::map($employerType, 'id', 'name');


		\Yii::$app->getView()->registerJsFile(\Yii::$app->request->baseUrl . '/js/autocomplete/autocomplete-ui.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
		\Yii::$app->getView()->registerJsFile(\Yii::$app->request->baseUrl . '/js/autocomplete/autocomplete-0.3.0.min.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
		\Yii::$app->getView()->registerJsFile(\Yii::$app->request->baseUrl . '/js/autocomplete/searchLocation.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);

		return $this->render('update', [
			'model' => $model,
			'specializationDropDownArray' => $specializationDropDownArray,
			'employmentTypeDropDownArray' => $employmentTypeDropDownArray,
			'countryName' => $countryName
		]);
	}

	/**
	 * Deletes an existing Summary model.
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
	 * Finds the Summary model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param int $id ID
	 * @return Summary the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Summary::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}
}
