<?php
define('DB_SERVER', '127.0.0.1');
define('DB_USERNAME', 'HomeNexus');
define('DB_PASSWORD', 'HOAdb2025');
define('DB_NAME', 'homenexus');
//attemp to connect
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
//check if connection is unsuccessful
if($link === false) {
    die("ERROR: Could not connect," . mysqli_connect_error());
}
//set time zone
date_default_timezone_set('Asia/Manila');
?>