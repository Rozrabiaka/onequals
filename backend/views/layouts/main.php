<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => 'OnEquals',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    $menuItems = [];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = ['label' => 'Тип зайнятості', 'url' => ['/employmenttype/employmenttype']];
        $menuItems[] = ['label' => 'Вакансії', 'url' => ['/vacancies/vacancies']];
        $menuItems[] = ['label' => 'Роки компанії', 'url' => ['/agecompany/agecompany']];
        $menuItems[] = ['label' => 'Популярність компанії', 'url' => ['/companypopularity/companypopularity']];
        $menuItems[] = ['label' => 'Кількість працівників компанії', 'url' => ['/countcompanyworkers/countcompanyworkers']];
        $menuItems[] = ['label' => 'Роботодавці', 'url' => ['/employerusers/employerusers']];
        $menuItems[] = ['label' => 'Спеціалізації', 'url' => ['/specializations/specializations']];
        $menuItems[] = ['label' => 'Шукачі', 'url' => ['/searchworkuser/searchworkuser']];
        $menuItems[] = ['label' => 'Користувачі (RBAC)', 'url' => ['/user/user']];
        $menuItems[] = ['label' => 'Слайдер (Головна)', 'url' => ['/slider/slider']];
        $menuItems[] = ['label' => 'Створити блог', 'url' => ['/page/page']];
        $menuItems[] = ['label' => 'Блог шукача', 'url' => ['/blogsummary/blogsummary']];
        $menuItems[] = ['label' => 'Блог роботодавця', 'url' => ['/blogemployer/blogemployer']];
        $menuItems[] = ['label' => 'Блог законодавства', 'url' => ['/bloglegislation/bloglegislation']];
        $menuItems[] = ['label' => 'Історії', 'url' => ['/history/history']];
        $menuItems[] = ['label' => 'Блог карєра / резюме', 'url' => ['/blogcareer/blogcareer']];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; OnEquals <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
