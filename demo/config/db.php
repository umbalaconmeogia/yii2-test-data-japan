<?php

return [
    'class' => 'yii\db\Connection',
	'dsn' => 'sqlite:@app/data/test_data_demo.sqlite',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
