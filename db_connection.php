<?php
/*
Tutorials for creating and connect to mysql database
https://www.cloudways.com/blog/connect-mysql-with-php/
https://www.w3schools.com/php/php_mysql_connect.asp
*/
function OpenCon($host, $user, $password, $database_name)
{
    $dbhost = $host;
    $dbuser = $user;
    $dbpass = $password;
    $db = $database_name;
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->error);

    return $conn;
}

function CloseCon($conn)
{
    $conn->close();
}
