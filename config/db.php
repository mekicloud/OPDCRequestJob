<?php

return [
    'class' => 'yii\db\Connection',
    //'dsn' => 'mysql:host=localhost;dbname=yii2basicline_db',
    'dsn' => 'sqlsrv:Server=172.16.1.50;Database=OPDC_EOF',
    'username' => 'sa',
    'password' => 'P@ssw0rd',
     'charset' => 'utf8',

    // 'dsn' => 'sqlsrv:Server=164.115.27.238:1433;Database=OPDC_DEV',
    // 'username' => 'sa',
    // 'password' => 'qwER1234!@#$',
    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
