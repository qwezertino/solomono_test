<?php

namespace app\controllers;

use thecodeholic\phpmvc\Controller;

class SiteController extends Controller
{
    public function home()
    {
        return $this->render('home');
    }
}
