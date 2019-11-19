<?php

namespace myblog;

class Authentication
{
    public function handle()
    {
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
            return true;
        }

        header("Location: login");

        return false;
    }
}
