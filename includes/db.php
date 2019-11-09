<?php

/////FOR LANDO/////

//$db['db_host'] = "database2.cms.internal";
//$db['db_user'] = "mariadb";
//$db['db_pass'] = "mariadb";
//$db['db_name'] = "database";


  /////FOR XAMPP/////

//$db['db_host'] = "localhost";
//$db['db_user'] = "root";
//$db['db_pass'] = "";
//$db['db_name'] = "database";

foreach ($db as $key => $value) {
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//if ($connection) {
//    echo "We are connected";
//}

