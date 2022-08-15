<?php

declare(strict_types=1);

use yii\caching\FileCache;
use yii\helpers\ArrayHelper;

$params = include __DIR__ . '/params.php';

$config = [
    'aliases' => [
        '@bower' => __DIR__ . '/../vendor/bower-asset'
    ],
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'authManager' => [
            'class' => yii\rbac\DbManager::class,
        ],
        'cache' => [
            'class' => FileCache::class
        ],
        'db' => [
            'charset' => 'utf8',
            'class' => yii\db\Connection::class,
            'tablePrefix' => '',
            'enableSchemaCache' => !YII_DEBUG,
        ],
        'errorHandler' => [
            'discardExistingOutput' => !YII_DEBUG
        ],
        'formatter' => [
            'dateFormat' => 'php:d.m.Y',
        ],
    ],
    'id' => 'warehouse',
    'language' => 'ru',
    'timeZone' => 'Europe/Moscow',
];

$config['components']['db'] = ArrayHelper::merge($config['components']['db'], [
    'dsn' => sprintf(
        'mysql:dbname=%s;host=%s;port=%d;',
        $params['MySQL']['database'],
        $params['MySQL']['host'],
        $params['MySQL']['port'],
    ),
    'password' => $params['MySQL']['password'],
    'username' =>  $params['MySQL']['username'],
]);

return $config;