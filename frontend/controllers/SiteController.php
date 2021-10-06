<?php

namespace frontend\controllers;

use backend\models\EmploymentType;
use backend\models\Vacancies;
use common\models\AgeCompany;
use common\models\CompanyPopularity;
use common\models\CountCompanyWorkers;
use common\models\EmployerUsers;
use common\models\Locality;
use common\models\SearchWorkUser;
use common\models\Slider;
use common\models\Specializations;
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
                'only' => ['logout', 'signup', 'employer', 'employer-profile', 'choose', 'employer-vacation', 'delete-employer', 'hide-employer', 'vacancies-employer-edit', 'vacancies-employer-delete', 'edit-employer'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'employer', 'employer-profile', 'choose', 'employer-vacation', 'delete-employer', 'hide-employer', 'vacancies-employer-edit', 'vacancies-employer-delete', 'edit-employer'],
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
        $searchModel = new SearchForm();
        $specializations = Specializations::find()->asArray()->all();
        $slider = Slider::find()->asArray()->all();
        $specializationDropDownArray = ArrayHelper::map($specializations, 'id', 'name');

        \Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/autocomplete-ui.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
        \Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/autocomplete-0.3.0.min.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
        \Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/searchLocation.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
        \Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/slider/swiper.min.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
        \Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/slider/slider.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
        \Yii::$app->getView()->registerCssFile(Yii::$app->request->baseUrl . '/css/swiper.css', ['position' => \yii\web\View::POS_END]);

        return $this->render('index', array(
            'searchModel' => $searchModel,
            'specializationDropDownArray' => $specializationDropDownArray,
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
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
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
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
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
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @return yii\web\Response
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
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
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
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
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

        //TODO IMPORTANT проверка также на пользователя который ИЩЕТ РАБОТУ
        if ($this->isUserEmployer() == false)
            return $this->render('choose');
        else {
            return $this->redirect(['site/employer-profile']);
        }
    }

    public function actionEmployer()
    {
        $model = new EmployerUsers();

        if ($this->isUserEmployer() == false and !empty(Yii::$app->user->identity->id_spem)) return $this->redirect(['site/error']);
        elseif (!empty(Yii::$app->user->identity->id_spem)) return $this->redirect(['site/employer-profile']);
        else {
            if (!empty(Yii::$app->request->post())) {
                $model->load(Yii::$app->request->post());
                $model->country = Yii::$app->request->post()['EmployerUsers']['hiddenCountry'];
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
            $employerUserModel = $model::find()
                ->select(['employer_users.id', 'l1.title', 'l1.type', 'employer_users.company_name', 'employer_users.img', 'employer_users.company_description', 'employer_users.hide_employer'])
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

            \Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/employerProfile/employerProfile.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);

            return $this->render('employerProfile', [
                'model' => $employerUserModel,
                'vacancies' => $vacancies
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
        $whichUser = Yii::$app->user->identity->which_user;
        $model = new EmployerUsers();

        if ($whichUser !== $model::EMPLOYER_WHICH_USER) return $this->redirect(['site/error']);
        else {

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
                $model->load(Yii::$app->request->post());
                $model->country = Yii::$app->request->post('EmployerUsers')['hiddenCountry'];
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

    public function isUserEmployer()
    {
        $whichUser = Yii::$app->user->identity->which_user;
        $model = new EmployerUsers();

        if ($whichUser !== $model::EMPLOYER_WHICH_USER) return false;

        return true;
    }
}
