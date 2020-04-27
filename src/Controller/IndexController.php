<?php

namespace Controller;

class IndexController extends \Controller
{
    public function indexAction()
    {
        header('Location: signUp');
    }
}