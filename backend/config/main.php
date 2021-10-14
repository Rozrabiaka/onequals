<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'user' => [
            'class' => 'backend\modules\user\Module',
        ],
        'specializations' => [
            'class' => 'backend\modules\specializations\Module',
        ],
        'searchworkuser' => [
            'class' => 'backend\modules\searchworkuser\Module',
        ],
        'employerusers' => [
            'class' => 'backend\modules\employerusers\Module',
        ],
        'countcompanyworkers' => [
            'class' => 'backend\modules\countcompanyworkers\Module',
        ],
        'companypopularity' => [
            'class' => 'backend\modules\companypopularity\Module',
        ],
        'agecompany' => [
            'class' => 'backend\modules\agecompany\Module',
        ],
        'vacancies' => [
            'class' => 'backend\modules\vacancies\Module',
        ],
        'employmenttype' => [
            'class' => 'backend\modules\employmenttype\Module',
        ],
        'slider' => [
            'class' => 'backend\modules\slider\Module',
        ],
        'page' => [
            'class' => 'backend\modules\page\Module',
        ],
        'blogsummary' => [
            'class' => 'backend\modules\blogsummary\Module',
        ],
        'blogemployer' => [
            'class' => 'backend\modules\blogemployer\Module',
        ],
        'bloglegislation' => [
            'class' => 'backend\modules\bloglegislation\Module',
        ],
    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            // uncomment if you want to cache RBAC items hierarchy
            // 'cache' => 'cache',
        ],
        'request' => [
            'baseUrl' => '/admin',
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
];
