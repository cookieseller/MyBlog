<?php

namespace Pubapi\Model;

class StorePost
{
    public function storePost($title, $content, $user)
    {
        $config = parse_ini_file(__DIR__ . "\..\..\config\database.ini");
        $con = new \mysqli($config['server'], $config['user'], $config['password'], $config['database']);

        if ($con->connect_error) {
            echo "Connection failed: " . $con->connect_error;
            die(1);
        }

        if (($statement = $con->prepare("INSERT INTO posts (title, content, user) VALUES (?, ?, ?)")) == false) {
            echo "Error preparing statement: " . $con->error;
            $con->close();
            die(1);
        }
        $statement->bind_param("sss", $title, $content, $user);

        $statement->execute();
        $statement->close();
        $con->close();
    }
}
