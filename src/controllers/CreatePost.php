<?php

namespace Pubapi\Controllers;

use Pubapi\Model\StorePost;

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
        $post = new StorePost();
        $post->storePost($this->_title, $this->_content, $this->_user);

        header("Location: /");
    }
}