<?php

class StorePost
{
    public function storePost()
    {
        $con = new mysqli($config['server'], $config['user'], $config['password']);

        if ($con->connect_error) {
            echo "Connection failed: " . $con->connect_error;
            die(1);
        }
    }
}
