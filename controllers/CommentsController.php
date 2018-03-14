<?php

namespace controllers;

use components\web\Controller;

/**
 * Class CommentsController
 * @package controllers
 */
class CommentsController extends Controller
{
    public function actionCreate()
    {
        $this->getModel()->load($_POST);
        $this->getModel()->save();

        var_dump($this->getModel());
    }

}
