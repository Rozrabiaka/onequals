<?php

namespace backend\modules\employerusers\controllers;

use backend\models\EmployerSearch;
use common\models\AgeCompany;
use common\models\CompanyPopularity;
use common\models\CountCompanyWorkers;
use common\models\EmployerUsers;
use common\models\Locality;
use common\models\Specializations;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmployerusersController implements the CRUD actions for EmployerUsers model.
 */
class EmployerusersController extends Controller
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
	 * Lists all EmployerUsers models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$model = new EmployerSearch();
		$dataProvider = $model->search(\Yii::$app->request->queryParams);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $model,
		]);
	}

	/**
	 * Displays a single EmployerUsers model.
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
//     * Creates a new EmployerUsers model.
//     * If creation is successful, the browser will be redirected to the 'view' page.
//     * @return mixed
//     */
//    public function actionCreate()
//    {
//        $model = new EmployerUsers();
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
	 * Updates an existing EmployerUsers model.
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
			$model->country = $this->request->post('EmployerUsers')['hiddenCountry'];

			if ($model->save())
				return $this->redirect(['view', 'id' => $model->id]);
		}

		$locality = new Locality();

		$specializations = Specializations::find()->asArray()->all();
		$ageCompany = AgeCompany::find()->asArray()->all();
		$countCompanyWorkers = CountCompanyWorkers::find()->asArray()->all();
		$companyPopularity = CompanyPopularity::find()->asArray()->all();
		$countryName = $locality->getLocalityNameById($model->country);

		$specializationDropDownArray = ArrayHelper::map($specializations, 'id', 'name');
		$ageCompanyDropDownArray = ArrayHelper::map($ageCompany, 'id', 'age_name');
		$countCompanyWorkersDropDownArray = ArrayHelper::map($countCompanyWorkers, 'id', 'count_company_workers');
		$companyPopularityDropDownArray = ArrayHelper::map($companyPopularity, 'id', 'company_popularity');

		\Yii::$app->getView()->registerJsFile(\Yii::$app->request->baseUrl . '/js/autocomplete/autocomplete-ui.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
		\Yii::$app->getView()->registerJsFile(\Yii::$app->request->baseUrl . '/js/autocomplete/autocomplete-0.3.0.min.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
		\Yii::$app->getView()->registerJsFile(\Yii::$app->request->baseUrl . '/js/autocomplete/searchLocation.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);

		return $this->render('update', [
			'model' => $model,
			'specializationDropDownArray' => $specializationDropDownArray,
			'ageCompanyDropDownArray' => $ageCompanyDropDownArray,
			'countCompanyWorkersDropDownArray' => $countCompanyWorkersDropDownArray,
			'companyPopularityDropDownArray' => $companyPopularityDropDownArray,
			'countryName' => $countryName
		]);
	}

	/**
	 * Deletes an existing EmployerUsers model.
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
	 * Finds the EmployerUsers model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param int $id ID
	 * @return EmployerUsers the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = EmployerUsers::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}
}
