<?php

namespace frontend\controllers;

use common\models\EmploymentType;
use common\models\LikeSummary;
use common\models\LikeVacancies;
use common\models\Vacancies;
use common\models\AgeCompany;
use common\models\CompanyPopularity;
use common\models\CountCompanyWorkers;
use common\models\EmployerUsers;
use common\models\Locality;
use common\models\SearchWorkUser;
use common\models\Slider;
use common\models\Specializations;
use common\models\Summary;
use common\models\UploadImage;
use common\models\User;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\SearchForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends Controller
{
	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['logout', 'signup', 'employer', 'employer-profile', 'choose', 'employer-vacation', 'delete-employer', 'hide-employer', 'vacancies-employer-edit', 'vacancies-employer-delete', 'edit-employer', 'search-work', 'worker-profile', 'hide-worker', 'delete-worker', 'worker-summary', 'worker-summary-delete', 'worker-summary-edit', 'edit-worker', 'add-like', 'remove-like'],
				'rules' => [
					[
						'actions' => ['signup'],
						'allow' => true,
						'roles' => ['?'],
					],
					[
						'actions' => ['logout', 'employer', 'employer-profile', 'choose', 'employer-vacation', 'delete-employer', 'hide-employer', 'vacancies-employer-edit', 'vacancies-employer-delete', 'edit-employer', 'search-work', 'worker-profile', 'hide-worker', 'delete-worker', 'worker-summary', 'worker-summary-delete', 'worker-summary-edit', 'edit-worker', 'add-like', 'remove-like'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'logout' => ['post'],
				],
			],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
			'auth' => [
				'class' => 'yii\authclient\AuthAction',
				'successCallback' => [$this, 'onAuthSuccess'],
			],
		];
	}

	/**
	 * Displays homepage.
	 *
	 * @return mixed
	 */
	public function actionIndex()
	{
		$slider = Slider::find()->asArray()->all();

		\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/slider/swiper.min.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
		\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/slider/slider.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
		\Yii::$app->getView()->registerCssFile(Yii::$app->request->baseUrl . '/css/swiper.css', ['position' => \yii\web\View::POS_END]);

		return $this->render('index', array(
			'slider' => $slider,
		));
	}

	/**
	 * Logs in a user.
	 *
	 * @return mixed
	 */
	public function actionLogin()
	{
		if (!Yii::$app->user->isGuest) {
			return $this->goHome();
		}

		$model = new LoginForm();
		if ($model->load(Yii::$app->request->post()) && $model->login()) {

			$userId = \Yii::$app->user->identity->id;
			$user = EmployerUsers::find()->select(['id'])->where(['user_id' => $userId])->one();
			if (empty($user)) {
				$user = SearchWorkUser::find()->select(['id'])->where(['user_id' => $userId])->one();
				if (empty($user)) {
					return $this->redirect(['site/choose']);
				}
			}

			return $this->goBack();
		}

		$model->password = '';

		return $this->render('login', [
			'model' => $model,
		]);
	}

	/**
	 * Logs out the current user.
	 *
	 * @return mixed
	 */
	public function actionLogout()
	{
		Yii::$app->user->logout();

		return $this->goHome();
	}

	/**
	 * Displays contact page.
	 *
	 * @return mixed
	 */
	public function actionContact()
	{
		$model = new ContactForm();
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
				Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
			} else {
				Yii::$app->session->setFlash('error', 'There was an error sending your message.');
			}

			return $this->refresh();
		}

		return $this->render('contact', [
			'model' => $model,
		]);
	}

	/**
	 * Displays about page.
	 *
	 * @return mixed
	 */
	public function actionAbout()
	{
		return $this->render('about');
	}

	/**
	 * Signs user up.
	 *
	 * @return mixed
	 */
	public function actionSignup()
	{
		$model = new SignupForm();
		if ($model->load(Yii::$app->request->post()) && $model->signup()) {
			return $this->render('siteResultPage', [
				'message' => ' Вам на пошту надійшов лист з підтвердженням.
                               Будь ласка, перейдіть на пошту для продовження реєстрації.',
				'title' => 'Успішна реєстрація'
			]);
		}

		return $this->render('signup', [
			'model' => $model,
		]);
	}

	public function actionPrivacyPolicy()
	{
		return $this->render('privacyPolicy');
	}

	public function actionTermsOfUse()
	{
		return $this->render('termsOfUse');
	}

	/**
	 * Requests password reset.
	 *
	 * @return mixed
	 */
	public function actionRequestPasswordReset()
	{
		$model = new PasswordResetRequestForm();
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			if ($model->sendEmail()) {
				return $this->render('siteResultPage', [
					'message' => 'Вам на пошту надійшов лист з підтвердженням.
                    Будь ласка, перейдіть на пошту для подальших інструкцій.',
					'title' => 'Успішна реєстрація'
				]);
			}

			return $this->render('siteResultPage', [
				'title' => 'Помилка',
				'error' => 'Сталась помилка, будь ласка, зверніться в технічну підтримку.'
			]);
		}

		return $this->render('requestPasswordResetToken', [
			'model' => $model,
		]);
	}

	/**
	 * Resets password.
	 *
	 * @param string $token
	 * @return mixed
	 * @throws BadRequestHttpException
	 */
	public function actionResetPassword($token)
	{
		try {
			$model = new ResetPasswordForm($token);
		} catch (InvalidArgumentException $e) {
			throw new BadRequestHttpException($e->getMessage());
		}

		if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
			return $this->render('siteResultPage', [
				'message' => 'Ваш пароль було успішно відновлено. Приємного користування платформою :) ',
				'title' => 'Успішне відновлення паролю'
			]);
		}

		return $this->render('resetPassword', [
			'model' => $model,
		]);
	}

	/**
	 * Verify email address
	 *
	 * @param string $token
	 * @return string
	 * @throws BadRequestHttpException
	 */
	public function actionVerifyEmail($token)
	{
		try {
			$model = new VerifyEmailForm($token);
		} catch (InvalidArgumentException $e) {
			throw new BadRequestHttpException($e->getMessage());
		}

		if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
			return $this->render('siteResultPage', [
				'message' => 'Ви успішно підтвердили пошту. Успіхів у пошуку класних вакансій :)',
				'title' => 'Успішне підтвердження почти.'
			]);
		}

		return $this->render('siteResultPage', [
			'title' => 'Помилка',
			'error' => 'Сталась помилка під час підтвердження пошти. Будь ласка спробуйте знову. У вирішенні проблеми напишіть нам на пошту, все буде добре :)'
		]);
	}

	/**
	 * Resend verification email
	 *
	 * @return mixed
	 */
	public function actionResendVerificationEmail()
	{
		$model = new ResendVerificationEmailForm();
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			if ($model->sendEmail()) {
				return $this->render('siteResultPage', [
					'message' => 'Провірьте будь ласка пошту для подальших інструкцій :)',
					'title' => 'Успішне підтвердження почти.'
				]);
			}
		}

		return $this->render('resendVerificationEmail', [
			'model' => $model
		]);
	}

	public function onAuthSuccess($client)
	{
		$attributes = $client->getUserAttributes();

		/* @var $auth Auth */
		$auth = Auth::find()->where([
			'source' => $client->getId(),
			'source_id' => $attributes['id'],
		])->one();

		if (Yii::$app->user->isGuest) {
			if ($auth) { // авторизация
				$user = $auth->user;
				Yii::$app->user->login($user);
			} else { // регистрация
				if (isset($attributes['email']) && User::find()->where(['email' => $attributes['email']])->exists()) {
					Yii::$app->getSession()->setFlash('error', [
						Yii::t('app', "Пользователь с такой электронной почтой как в {client} уже существует, но с ним не связан. Для начала войдите на сайт использую электронную почту, для того, что бы связать её.", ['client' => $client->getTitle()]),
					]);
				} else {
					$password = Yii::$app->security->generateRandomString(6);
					$user = new User([
						'username' => $attributes['login'],
						'email' => $attributes['email'],
						'password' => $password,
					]);
					$user->generateAuthKey();
					$user->generatePasswordResetToken();
					$transaction = $user->getDb()->beginTransaction();
					if ($user->save()) {
						$auth = new Auth([
							'user_id' => $user->id,
							'source' => $client->getId(),
							'source_id' => (string)$attributes['id'],
						]);
						if ($auth->save()) {
							$transaction->commit();
							Yii::$app->user->login($user);
						} else {
							print_r($auth->getErrors());
						}
					} else {
						print_r($user->getErrors());
					}
				}
			}
		} else { // Пользователь уже зарегистрирован
			if (!$auth) { // добавляем внешний сервис аутентификации
				$auth = new Auth([
					'user_id' => Yii::$app->user->id,
					'source' => $client->getId(),
					'source_id' => $attributes['id'],
				]);
				$auth->save();
			}
		}
	}

	public function actionChoose()
	{
		if ($this->isUserEmployer() !== false and $this->isUserSearcher() == false)
			return $this->redirect(['site/employer-profile']);
		elseif ($this->isUserEmployer() == false and $this->isUserSearcher() !== false) {
			return $this->redirect(['site/worker-profile']);
		}

		return $this->render('choose');
	}

	public function actionEmployer()
	{
		$model = new EmployerUsers();

		if ($this->isUserEmployer() == false and !empty(Yii::$app->user->identity->id_spem)) return $this->redirect(['site/error']);
		elseif (!empty(Yii::$app->user->identity->id_spem)) return $this->redirect(['site/employer-profile']);
		else {
			if (!empty(Yii::$app->request->post())) {
				$model->load(Yii::$app->request->post());
				$model->country = (int)Yii::$app->request->post()['EmployerUsers']['hiddenCountry'];
				$model->user_id = \Yii::$app->user->identity->id;
				$model->img = '/images/avatar.png';
				$model->hide_employer = $model::SHOW_EMPLOYER;

				if ($model->save()) {
					$userModel = User::findOne(\Yii::$app->user->identity->id);
					$userModel->which_user = $model::EMPLOYER_WHICH_USER;
					$userModel->id_spem = $model->getPrimaryKey();
					$userModel->save();

					return $this->redirect(['site/employer-profile']);
				}
			}
		}

		$searchModel = new SearchForm();
		$ageCompany = new AgeCompany();
		$countCompany = new CountCompanyWorkers();
		$companyPopularity = new CompanyPopularity();
		$specializations = Specializations::find()->asArray()->all();

		$specializationDropDownArray = ArrayHelper::map($specializations, 'id', 'name');
		$listAge = $ageCompany->getRadioList();
		$listCountCompany = $countCompany->getRadioList();
		$listCompanyPopularity = $companyPopularity->getRadioList();

		\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/autocomplete-ui.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
		\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/autocomplete-0.3.0.min.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
		\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/searchLocation.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);

		return $this->render('employer', [
			'searchModel' => $searchModel,
			'model' => $model,
			'listAge' => $listAge,
			'listCountCompany' => $listCountCompany,
			'listCompanyPopularity' => $listCompanyPopularity,
			'specializationDropDownArray' => $specializationDropDownArray
		]);
	}

	public function actionEmployerProfile()
	{
		if ($this->isUserEmployer() == false) return $this->redirect(['site/error']);
		else {
			$model = new EmployerUsers();
			$likeModel = new LikeSummary();

			$employerUserModel = $model::find()
				->select(['employer_users.id', 'l1.title', 'l1.type', 'employer_users.webpage', 'employer_users.facebook', 'employer_users.instagram', 'employer_users.twitter', 'employer_users.LinkedIn', 'employer_users.company_name', 'employer_users.img', 'employer_users.company_description', 'employer_users.hide_employer'])
				->where(['user_id' => Yii::$app->user->identity->id])
				->leftJoin(['l1' => 'locality'], 'employer_users.country = l1.id')
				->asArray()
				->one();

			$vacancies = Vacancies::find()
				->select(['vacancies.id', 'vacancies.description', 'vacancies.wage', 'l1.title', 'l1.type', 'emp_type.name as emp_name', 'spec.name as spec_name'])
				->where(['employer_id' => $employerUserModel['id']])
				->leftJoin(['l1' => 'locality'], 'vacancies.country = l1.id')
				->leftJoin(['spec' => 'specializations'], 'vacancies.specialization = spec.id')
				->leftJoin(['emp_type' => 'employment_type'], 'vacancies.employer_type = emp_type.id')
				->asArray()
				->all();

			$likeModelArray = $likeModel->getLikeSummaryArrayByLoginUserId();

			$summary = Summary::find()
				->select(['user.email', 'emp_user.user_id', 'summary.id', 'l1.title', 'l1.type', 'summary.description', 'summary.wage', 'emp_type.name as emp_name', 'spec.name as spec_name', 'emp_user.firstname', 'emp_user.lastname', 'emp_user.patronymic'])
				->where(['summary.id' => $likeModelArray])
				->leftJoin(['l1' => 'locality'], 'summary.country = l1.id')
				->leftJoin(['spec' => 'specializations'], 'summary.specialization = spec.id')
				->leftJoin(['emp_type' => 'employment_type'], 'summary.employer_type = emp_type.id')
				->leftJoin(['emp_user' => 'search_work_user'], 'summary.worker_id = emp_user.id')
				->leftJoin(['user' => 'user'], 'emp_user.user_id = user.id')
				->asArray()
				->all();

			\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/employerProfile/employerProfile.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);

			return $this->render('employerProfile', [
				'model' => $employerUserModel,
				'vacancies' => $vacancies,
				'likeModel' => $likeModelArray,
				'summary' => $summary
			]);
		}
	}

	public function actionHideEmployer()
	{
		if ($this->isUserEmployer() == false) return $this->redirect(['site/error']);
		else {
			$model = new EmployerUsers();

			$employerUserModel = $model::find()->where(['user_id' => Yii::$app->user->identity->id])->one();

			if ($employerUserModel->hide_employer == $model::SHOW_EMPLOYER) $employerUserModel->hide_employer = $model::HIDE_EMPLOYER;
			else $employerUserModel->hide_employer = $model::SHOW_EMPLOYER;

			$employerUserModel->country = (string)$employerUserModel->country;

			$employerUserModel->save();

			return $this->redirect(['site/employer-profile']);
		}
	}

	public function actionDeleteEmployer()
	{
		if ($this->isUserEmployer() == false) return $this->redirect(['site/error']);
		else {

			$model = new EmployerUsers();
			$employerUserModel = $model::find()->where(['user_id' => Yii::$app->user->identity->id])->one();

			//delete employer vacancies
			\Yii::$app
				->db
				->createCommand()
				->delete('vacancies', ['employer_id' => $employerUserModel->id])
				->execute();

			\Yii::$app
				->db
				->createCommand()
				->delete('employer_users', ['id' => $employerUserModel->id])
				->execute();

			\Yii::$app
				->db
				->createCommand()
				->delete('user', ['id' => Yii::$app->user->identity->id])
				->execute();

			return $this->redirect(['site/employer-profile']);
		}
	}

	public function actionEmployerVacation()
	{
		$model = new Vacancies();

		if ($this->isUserEmployer() == false) return $this->redirect(['site/error']);
		else {
			if (!empty(Yii::$app->request->post())) {
				$model->load(Yii::$app->request->post());
				$model->country = Yii::$app->request->post()['Vacancies']['hiddenCountry'];
				$model->employer_id = Yii::$app->user->identity->id_spem;

				if ($model->save()) {
					return $this->redirect(['site/employer-profile']);
				}
			}
		}

		$specializations = Specializations::find()->asArray()->all();
		$employerType = EmploymentType::find()->asArray()->all();
		$specializationDropDownArray = ArrayHelper::map($specializations, 'id', 'name');
		$employmentTypeDropDownArray = ArrayHelper::map($employerType, 'id', 'name');

		\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/autocomplete-ui.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
		\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/autocomplete-0.3.0.min.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
		\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/searchLocation.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);

		return $this->render('employerVacation', [
			'model' => $model,
			'specializationDropDownArray' => $specializationDropDownArray,
			'employmentTypeDropDownArray' => $employmentTypeDropDownArray
		]);
	}

	public function actionVacanciesEmployerEdit($id)
	{
		$model = Vacancies::find()->where(['id' => $id])->one();

		if (!empty($model) and $model->employer_id == Yii::$app->user->identity->id_spem) {
			if (!empty(Yii::$app->request->post())) {
				$model->load(Yii::$app->request->post());
				$model->country = Yii::$app->request->post()['Vacancies']['hiddenCountry'];

				if ($model->save()) {
					return $this->redirect(['site/employer-profile']);
				}
			}

			$specializations = Specializations::find()->asArray()->all();
			$employerType = EmploymentType::find()->asArray()->all();

			$specializationDropDownArray = ArrayHelper::map($specializations, 'id', 'name');
			$employmentTypeDropDownArray = ArrayHelper::map($employerType, 'id', 'name');

			$locality = new Locality();
			$countryName = $locality->getLocalityNameById($model->country);

			\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/autocomplete-ui.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
			\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/autocomplete-0.3.0.min.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
			\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/searchLocation.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);

			return $this->render('editEmployerVacation', [
				'model' => $model,
				'specializationDropDownArray' => $specializationDropDownArray,
				'employmentTypeDropDownArray' => $employmentTypeDropDownArray,
				'countryName' => $countryName
			]);
		}

		return $this->redirect(['site/employer-profile']);

	}

	public function actionVacanciesEmployerDelete($id)
	{
		$model = Vacancies::find()->where(['id' => $id])->one();
		if (!empty($model) and $model->employer_id == Yii::$app->user->identity->id_spem) {
			\Yii::$app
				->db
				->createCommand()
				->delete('vacancies', ['id' => $id])
				->execute();
		}

		return $this->redirect(['site/employer-profile']);
	}

	public function actionEditEmployer()
	{
		$model = EmployerUsers::find()->where(['user_id' => Yii::$app->user->identity->id])->one();

		if (!empty($model)) {
			if (!empty(Yii::$app->request->post())) {
				$uploadImage = new UploadImage();
				$model->image = UploadedFile::getInstances($model, 'image');
				$imgPath = $uploadImage->uploadImage($model->image);

				$model->load(Yii::$app->request->post());
				$model->country = Yii::$app->request->post('EmployerUsers')['hiddenCountry'];
				if ($imgPath) $model->img = $imgPath;

				if ($model->save()) {
					return $this->redirect(['site/employer-profile']);
				}
			}

			$specializations = Specializations::find()->asArray()->all();
			$specializationDropDownArray = ArrayHelper::map($specializations, 'id', 'name');
			$ageCompany = new AgeCompany();
			$countCompany = new CountCompanyWorkers();
			$companyPopularity = new CompanyPopularity();

			$listAge = $ageCompany->getRadioList();
			$listCountCompany = $countCompany->getRadioList();
			$listCompanyPopularity = $companyPopularity->getRadioList();

			$locality = new Locality();
			$countryName = $locality->getLocalityNameById($model->country);

			\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/autocomplete-ui.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
			\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/autocomplete-0.3.0.min.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
			\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/searchLocation.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);

			return $this->render('editEmployer', [
				'model' => $model,
				'specializationDropDownArray' => $specializationDropDownArray,
				'countryName' => $countryName,
				'listAge' => $listAge,
				'listCountCompany' => $listCountCompany,
				'listCompanyPopularity' => $listCompanyPopularity,
			]);
		}

		return $this->redirect(['site/employer-profile']);

	}

	public function actionSearchWork()
	{
		$model = new SearchWorkUser();

		if ($this->isUserSearcher() == false and !empty(Yii::$app->user->identity->id_search)) return $this->redirect(['site/error']);
		elseif (!empty(Yii::$app->user->identity->id_search)) return $this->redirect(['site/worker-profile']);
		else {
			if (!empty(Yii::$app->request->post())) {

				$searchName = trim(Yii::$app->request->post()['SearchWorkUser']['searchName']);
				$searchName = explode(' ', $searchName);


				$model->load(Yii::$app->request->post());
				if (count($searchName) == 1) {
					$model->firstname = empty($searchName[0]) ? '' : $searchName[0];
					$model->lastname = '';
					$model->patronymic = '';
				} else {
					$model->firstname = empty($searchName[1]) ? '' : $searchName[1];
					$model->lastname = empty($searchName[0]) ? '' : $searchName[0];
					$model->patronymic = empty($searchName[2]) ? '' : $searchName[2];
				}

				$model->country = Yii::$app->request->post()['SearchWorkUser']['hiddenCountry'];
				$model->user_id = \Yii::$app->user->identity->id;
				$model->img = '/images/avatar.png';
				$model->hide_worker = $model::SHOW_WORK_USER;

				if ($model->save()) {
					$userModel = User::findOne(\Yii::$app->user->identity->id);
					$userModel->which_user = $model::SEARCH_WORK_USER;
					$userModel->id_search = $model->getPrimaryKey();
					$userModel->save();

					return $this->redirect(['site/worker-profile']);
				}
			}
		}

		$specializations = Specializations::find()->asArray()->all();
		$specializationDropDownArray = ArrayHelper::map($specializations, 'id', 'name');

		\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/autocomplete-ui.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
		\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/autocomplete-0.3.0.min.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
		\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/searchLocation.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);

		return $this->render('searchWork', [
			'model' => $model,
			'specializationDropDownArray' => $specializationDropDownArray,
		]);
	}

	public function actionWorkerProfile()
	{
		if ($this->isUserSearcher() == false) return $this->redirect(['site/error']);
		else {

			$model = new SearchWorkUser();
			$likeModel = new LikeVacancies();

			$searchWorkUserModel = $model::find()
				->select(['*'])
				->where(['user_id' => Yii::$app->user->identity->id])
				->leftJoin(['l1' => 'locality'], 'search_work_user.country = l1.id')
				->asArray()
				->one();

			$summary = Summary::find()
				->select(['summary.id', 'l1.title', 'l1.type', 'summary.description', 'summary.wage', 'emp_type.name as emp_name', 'spec.name as spec_name'])
				->where(['worker_id' => Yii::$app->user->identity->id_search])
				->leftJoin(['l1' => 'locality'], 'summary.country = l1.id')
				->leftJoin(['spec' => 'specializations'], 'summary.specialization = spec.id')
				->leftJoin(['emp_type' => 'employment_type'], 'summary.employer_type = emp_type.id')
				->asArray()
				->all();

			$likeModelArray = $likeModel->getLikeVacanciesArrayByLoginUserId();

			$vacancies = Vacancies::find()
				->select(['user.email', 'emp_user.user_id', 'vacancies.id', 'l1.title', 'l1.type', 'vacancies.description', 'vacancies.wage', 'emp_type.name as emp_name', 'spec.name as spec_name', 'emp_user.company_name as company_name'])
				->where(['vacancies.id' => $likeModelArray])
				->leftJoin(['l1' => 'locality'], 'vacancies.country = l1.id')
				->leftJoin(['spec' => 'specializations'], 'vacancies.specialization = spec.id')
				->leftJoin(['emp_type' => 'employment_type'], 'vacancies.employer_type = emp_type.id')
				->leftJoin(['emp_user' => 'employer_users'], 'vacancies.employer_id = emp_user.id')
				->leftJoin(['user' => 'user'], 'emp_user.user_id = user.id')
				->asArray()
				->all();

			\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/workerProfile/workerProfile.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);

			return $this->render('workerProfile', [
				'model' => $searchWorkUserModel,
				'summary' => $summary,
				'likeModel' => $likeModelArray,
				'vacancies' => $vacancies
			]);
		}
	}

	public function actionHideWorker()
	{
		if ($this->isUserSearcher() == false) return $this->redirect(['site/error']);
		else {
			$model = new SearchWorkUser();
			$workerUserModel = $model::find()->where(['user_id' => Yii::$app->user->identity->id])->one();

			if ($workerUserModel->hide_worker == $model::SHOW_WORK_USER) $workerUserModel->hide_worker = $model::HIDE_WORK_USER;
			else $workerUserModel->hide_worker = $model::SHOW_WORK_USER;

			$workerUserModel->country = (string)$workerUserModel->country;
			$workerUserModel->save();

			return $this->redirect(['site/worker-profile']);
		}
	}

	public function actionDeleteWorker()
	{
		if ($this->isUserSearcher() !== false) {
			$searchWorkUserModel = SearchWorkUser::find()->where(['user_id' => Yii::$app->user->identity->id])->one();

			//delete employer vacancies
			\Yii::$app
				->db
				->createCommand()
				->delete('summary', ['employer_id' => $searchWorkUserModel->id])
				->execute();

			\Yii::$app
				->db
				->createCommand()
				->delete('search_work_user', ['id' => $searchWorkUserModel->id])
				->execute();

			\Yii::$app
				->db
				->createCommand()
				->delete('user', ['id' => Yii::$app->user->identity->id])
				->execute();

			return $this->redirect(['site/worker-profile']);
		}

		return $this->redirect(['site/error']);
	}

	public function actionWorkerSummary()
	{
		if ($this->isUserSearcher() !== false) {
			$model = new Summary();

			if (!empty(Yii::$app->request->post())) {
				$model->load(Yii::$app->request->post());
				$model->country = Yii::$app->request->post('Summary')['hiddenCountry'];
				$model->worker_id = Yii::$app->user->identity->id_search;
				if ($model->save()) {
					return $this->redirect(['site/worker-profile']);
				}
			}

			$specializations = Specializations::find()->asArray()->all();
			$employerType = EmploymentType::find()->asArray()->all();
			$specializationDropDownArray = ArrayHelper::map($specializations, 'id', 'name');
			$employmentTypeDropDownArray = ArrayHelper::map($employerType, 'id', 'name');

			\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/autocomplete-ui.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
			\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/autocomplete-0.3.0.min.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
			\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/searchLocation.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);

			return $this->render('workerSummary', [
				'model' => $model,
				'specializationDropDownArray' => $specializationDropDownArray,
				'employmentTypeDropDownArray' => $employmentTypeDropDownArray
			]);
		}

		return $this->redirect(['site/error']);
	}

	public function actionWorkerSummaryDelete($id)
	{
		$model = Summary::find()->where(['id' => $id])->one();
		if (!empty($model) and $model->worker_id == Yii::$app->user->identity->id_search) {
			\Yii::$app
				->db
				->createCommand()
				->delete('summary', ['id' => $id])
				->execute();

			return $this->redirect(['site/worker-profile']);
		}

		return $this->redirect(['site/error']);
	}

	public function actionWorkerSummaryEdit($id)
	{
		$model = Summary::find()->where(['id' => $id])->one();

		if (!empty($model) and $model->worker_id == Yii::$app->user->identity->id_search) {
			if (!empty(Yii::$app->request->post())) {
				$model->load(Yii::$app->request->post());
				$model->country = Yii::$app->request->post()['Summary']['hiddenCountry'];

				if ($model->save()) {
					return $this->redirect(['site/worker-profile']);
				}
			}

			$specializations = Specializations::find()->asArray()->all();
			$employerType = EmploymentType::find()->asArray()->all();

			$specializationDropDownArray = ArrayHelper::map($specializations, 'id', 'name');
			$employmentTypeDropDownArray = ArrayHelper::map($employerType, 'id', 'name');

			$locality = new Locality();
			$countryName = $locality->getLocalityNameById($model->country);

			\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/autocomplete-ui.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
			\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/autocomplete-0.3.0.min.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
			\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/searchLocation.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);

			return $this->render('workerSummaryEdit', [
				'model' => $model,
				'specializationDropDownArray' => $specializationDropDownArray,
				'employmentTypeDropDownArray' => $employmentTypeDropDownArray,
				'countryName' => $countryName
			]);
		}

		return $this->redirect(['site/worker-profile']);
	}

	public function actionEditWorker()
	{
		$model = SearchWorkUser::find()->where(['user_id' => Yii::$app->user->identity->id])->one();

		if (!empty($model)) {
			if (!empty(Yii::$app->request->post())) {
				$searchName = trim(Yii::$app->request->post()['SearchWorkUser']['searchName']);
				$searchName = explode(' ', $searchName);

				$model->load(Yii::$app->request->post());

				$uploadImage = new UploadImage();
				$model->image = UploadedFile::getInstances($model, 'image');
				$imgPath = $uploadImage->uploadImage($model->image);

				if ($imgPath) $model->img = $imgPath;

				if (count($searchName) == 1) {
					$model->firstname = empty($searchName[0]) ? '' : $searchName[0];
					$model->lastname = '';
					$model->patronymic = '';
				} else {
					$model->firstname = empty($searchName[1]) ? '' : $searchName[1];
					$model->lastname = empty($searchName[0]) ? '' : $searchName[0];
					$model->patronymic = empty($searchName[2]) ? '' : $searchName[2];
				}

				$model->country = Yii::$app->request->post('SearchWorkUser')['hiddenCountry'];

				if ($model->save()) {
					return $this->redirect(['site/worker-profile']);
				}
			}

			$specializations = Specializations::find()->asArray()->all();
			$specializationDropDownArray = ArrayHelper::map($specializations, 'id', 'name');

			$locality = new Locality();
			$countryName = $locality->getLocalityNameById($model->country);
			$userName = $model->lastname . ' ' . $model->firstname . ' ' . $model->patronymic;

			\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/autocomplete-ui.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
			\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/autocomplete-0.3.0.min.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
			\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/searchLocation.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);

			return $this->render('workerEdit', [
				'model' => $model,
				'specializationDropDownArray' => $specializationDropDownArray,
				'countryName' => $countryName,
				'userName' => $userName
			]);
		}

		return $this->redirect(['site/worker-profile']);
	}

	public function actionSearch()
	{
		$searchModel = new SearchForm();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$maxPrice = $searchModel->getMaxPrice();

		$specializations = Specializations::find()->asArray()->all();
		$employerType = EmploymentType::find()->asArray()->all();

		$likeModelArray = array();
		if (!empty(Yii::$app->user->identity->id)) {
			if ($this->isUserEmployer() !== false) {
				$likeModel = new LikeSummary();
				$likeModelArray = $likeModel->getLikeSummaryArrayByLoginUserId();
			} elseif ($this->isUserSearcher() !== false) {
				$likeModel = new LikeVacancies();
				$likeModelArray = $likeModel->getLikeVacanciesArrayByLoginUserId();
			}
		}

		$specializationDropDownArray = ArrayHelper::map($specializations, 'id', 'name');
		$employmentTypeDropDownArray = ArrayHelper::map($employerType, 'id', 'name');

		$listArray = array();
		if (!empty(Yii::$app->request->queryParams['cartlist'])) {
			$cartList = Yii::$app->request->queryParams['cartlist'];
			$list = explode(',', $cartList);
			foreach ($list as $value) {
				array_push($listArray, $value);
			}
		}

		$typeArray = array();
		if (!empty(Yii::$app->request->queryParams['typelist'])) {
			$typeList = Yii::$app->request->queryParams['typelist'];
			$list = explode(',', $typeList);
			foreach ($list as $value) {
				array_push($typeArray, $value);
			}
		}

		\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/search/jquery-ui.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
		\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/search/search.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
		\Yii::$app->getView()->registerCssFile(Yii::$app->request->baseUrl . '/css/jquery-ui.css', ['position' => \yii\web\View::POS_END]);

		return $this->render('search', [
			'dataProvider' => $dataProvider,
			'specializations' => $specializationDropDownArray,
			'employerType' => $employmentTypeDropDownArray,
			'listArray' => $listArray,
			'typeArray' => $typeArray,
			'likeModel' => $likeModelArray,
			'maxPrice' => $maxPrice
		]);
	}

	public function actionProfile($id)
	{
		if (!empty(Yii::$app->user->identity->id) and Yii::$app->user->identity->id == $id) return $this->redirect('/site/choose');

		$userModel = User::find()->select(['user.id', 'user.id_spem', 'user.id_search', 'user.which_user'])->where(['id' => $id])->one();

		if (!empty($userModel) and $userModel->which_user == EmployerUsers::EMPLOYER_WHICH_USER) {
			$model = new EmployerUsers();
			$employerUserModel = $model::find()
				->select(['user.email', 'employer_users.id', 'l1.title', 'l1.type', 'employer_users.webpage', 'employer_users.facebook', 'employer_users.instagram', 'employer_users.twitter', 'employer_users.LinkedIn', 'employer_users.company_name', 'employer_users.img', 'employer_users.company_description', 'employer_users.hide_employer'])
				->where(['user_id' => $userModel->id])
				->leftJoin(['l1' => 'locality'], 'employer_users.country = l1.id')
				->leftJoin('user', 'employer_users.user_id = user.id')
				->asArray()
				->one();

			$vacancies = Vacancies::find()
				->select(['vacancies.id', 'vacancies.description', 'vacancies.wage', 'l1.title', 'l1.type', 'emp_type.name as emp_name', 'spec.name as spec_name'])
				->where(['employer_id' => $employerUserModel['id']])
				->leftJoin(['l1' => 'locality'], 'vacancies.country = l1.id')
				->leftJoin(['spec' => 'specializations'], 'vacancies.specialization = spec.id')
				->leftJoin(['emp_type' => 'employment_type'], 'vacancies.employer_type = emp_type.id')
				->asArray()
				->all();

			$likeModel = new LikeVacancies();
			$likeModelArray = $likeModel->getLikeVacanciesArrayByLoginUserId();

			\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/profile/profile.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);

			return $this->render('profile', [
				'model' => $employerUserModel,
				'info' => $vacancies,
				'likeModel' => $likeModelArray
			]);

		} elseif ($userModel->which_user == SearchWorkUser::SEARCH_WORK_USER) {
			$model = new SearchWorkUser();
			$searchWorkUserModel = $model::find()
				->select(['user.email', 'search_work_user.id', 'l1.title', 'l1.type', 'search_work_user.webpage', 'search_work_user.facebook', 'search_work_user.instagram', 'search_work_user.twitter', 'search_work_user.LinkedIn', 'search_work_user.firstname', 'search_work_user.lastname', 'search_work_user.patronymic', 'search_work_user.img', 'search_work_user.description', 'search_work_user.hide_worker'])
				->where(['user_id' => $userModel->id])
				->leftJoin(['l1' => 'locality'], 'search_work_user.country = l1.id')
				->leftJoin('user', 'search_work_user.user_id = user.id')
				->asArray()
				->one();

			$summary = Summary::find()
				->select(['summary.id', 'l1.title', 'l1.type', 'summary.description', 'summary.wage', 'emp_type.name as emp_name', 'spec.name as spec_name'])
				->where(['worker_id' => $userModel->id_search])
				->leftJoin(['l1' => 'locality'], 'summary.country = l1.id')
				->leftJoin(['spec' => 'specializations'], 'summary.specialization = spec.id')
				->leftJoin(['emp_type' => 'employment_type'], 'summary.employer_type = emp_type.id')
				->asArray()
				->all();

			$likeModelArray = array();
			$likeModel = new LikeSummary();
			$likeModelArray = $likeModel->getLikeSummaryArrayByLoginUserId();

			\Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/profile/profile.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);

			return $this->render('profile', [
				'model' => $searchWorkUserModel,
				'info' => $summary,
				'likeModel' => $likeModelArray
			]);

		}

		return $this->render('error');
	}

	public function actionAddLike($id)
	{
		//если обратились через ссылку браузера - не пускаем, только по нажатию кнопки!
		if (!is_null(Yii::$app->request->referrer)) {
			if ($this->isUserEmployer() !== false) {
				$model = new LikeSummary();
				$issetLike = $model->find()->where(['summary_id' => $id])->andWhere(['user_id' => Yii::$app->user->identity->id])->one();
				if (empty($issetLike)) {
					$model->summary_id = $id;
					$model->user_id = Yii::$app->user->identity->id;
					if ($model->save()) return $this->redirect(Yii::$app->request->referrer);
				}
			} elseif ($this->isUserSearcher() !== false) {
				$model = new LikeVacancies();
				$issetLike = $model->find()->where(['vacancies_id' => $id])->andWhere(['user_id' => Yii::$app->user->identity->id])->one();
				if (empty($issetLike)) {
					$model->vacancies_id = $id;
					$model->user_id = Yii::$app->user->identity->id;
					if ($model->save()) return $this->redirect(Yii::$app->request->referrer);
				}
			}
		}
		return $this->render('error');
	}

	public function actionRemoveLike($id)
	{
		//если обратились через ссылку браузера - не пускаем, только по нажатию кнопки!
		if (!is_null(Yii::$app->request->referrer)) {
			if ($this->isUserEmployer() !== false) {
				$delete = LikeSummary::find()
					->where(['user_id' => Yii::$app->user->identity->id])
					->andwhere(['summary_id' => $id])
					->one();
				if (!empty($delete)) {
					$delete->delete();
					return $this->redirect(Yii::$app->request->referrer);
				}

			} elseif ($this->isUserSearcher() !== false) {
				$delete = LikeVacancies::find()
					->where(['user_id' => Yii::$app->user->identity->id])
					->andwhere(['vacancies_id' => $id])
					->one();
				if (!empty($delete)) {
					$delete->delete();
					return $this->redirect(Yii::$app->request->referrer);
				}
			}
		}

		return $this->render('error');
	}

	public function isUserEmployer()
	{
		$whichUser = Yii::$app->user->identity->which_user;
		$model = new EmployerUsers();

		if ($whichUser !== $model::EMPLOYER_WHICH_USER) return false;

		return true;
	}

	public function isUserSearcher()
	{
		$whichUser = Yii::$app->user->identity->which_user;
		$model = new SearchWorkUser();

		if ($whichUser !== $model::SEARCH_WORK_USER) return false;

		return true;
	}
}
