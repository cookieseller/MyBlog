<?php
$config = parse_ini_file(__DIR__ . "\..\..\config\database.ini");
$con = new mysqli($config['server'], $config['user'], $config['password']);

if ($con->connect_error) {
    echo "Connection failed: " . $con->connect_error;
    die(1);
}

$sql = "CREATE DATABASE IF NOT EXISTS blog";
if ($con->query($sql) !== true) {
    echo "Error creating database: " . $con->error;
    $con->close();
    die(1);
}

mysqli_select_db($con, "blog");

// 60 for bcrypt or blowfish
$sql = "CREATE TABLE IF NOT EXISTS posts ("
    . "id INT AUTO_INCREMENT,"
    . "title VARCHAR(255) NOT NULL,"
    . "content TEXT NOT NULL,"
    . "user VARCHAR(60) NOT NULL,"
    . "post_date DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,"
    . "PRIMARY KEY (id)"
    . ")";

if ($con->query($sql) !== true) {
    echo "Error creating table: " . $con->error;
    $con->close();
    die(1);
}

$sql = "INSERT INTO posts (title, content, user, post_date) VALUES ('Titel', 'Das ist ein bisschen Content', 'Some user', '2019-01-01');";
// $sql = "INSERT INTO users (firstname, lastname, user_password, email) VALUES ('George', 'Kindall', '" . crypt('LmgCY3St4') . "', 'gkindall0@biglobe.ne.jp');";

if ($con->multi_query($sql) !== true) {
    echo "Error: " . $sql . "<br>" . $con->error;
    $con->close();
    die(1);
}

$con->close();
