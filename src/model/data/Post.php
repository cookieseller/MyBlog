<?php

namespace myblog;

class Post {

    /**
     * @var string
     */
    private $_title;

    /**
     * @var string
     */
    private $_content;

    /**
     * @var string
     */
    private $_user;

    /**
     * @var string
     */
    private $_date;

    public function __construct(string $title, string $content, string $user)
    {
        $this->_title = $title;
        $this->_content = $content;
        $this->_user = $user;
        $this->_date = date('Y/m/d');
    }
}
