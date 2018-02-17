<?php

return [
    'db' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'sqlite:@app/data/test_data_demo.sqlite',
        // Schema cache options (for production environment)
        //'enableSchemaCache' => true,
        //'schemaCacheDuration' => 60,
        //'schemaCache' => 'cache',
    ],
    'dbTestDataJapan' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'sqlite:@app/data/test_data_japan.sqlite',
        // Schema cache options
        'enableSchemaCache' => true,
        'schemaCacheDuration' => 60,
        'schemaCache' => 'cache',
    ],
    'log' => [
        'targets' => [
            [
                'class' => 'yii\log\FileTarget',
                'levels' => ['error', 'warning', 'info', 'trace'],
                'logVars' => [],
                'except' => ['yii\db\*'],
            ],
//             [
//                 'class' => 'yii\log\FileTarget',
//                 'levels' => ['error', 'warning', 'info', 'trace'],
//                 'logVars' => [],
//                 'categories' => ['yii\db\*'],
//                 'logFile' => '@app/runtime/logs/sql.log',
//             ],
        ],
    ],
    'cache' => [
        'class' => 'yii\caching\FileCache',
    ],
];
