<?php

namespace Pubapi\Controllers;

class CreatePost
{
    private $_title;

    private $_content;

    private $_user;

    public function __construct($params)
    {
        $this->_title = $params['title'];
        $this->_content = $params['content'];
        $this->_user = $_SESSION['user'];
    }

    public function publishPost()
    {
        header("Location: /");

        return false;
    }
}