<?php

namespace Pubapi\Controllers;

class Authentication
{
    private $_username;

    private $_password;

    public function __construct($params)
    {
        $this->_username = $params['username'];
        $this->_password = $params['password'];
    }

    public function verify()
    {
        if ($this->_username == 'admin' && $this->_password == 'admin') {
            $_SESSION['loggedIn'] = true;

            header("Location: /");
            return true;
        }

        return false;
    }
}