<?php

namespace components\web;

use components\Model;
use helpers\Config;
use components\Application;

/**
 * Class Controller
 * @package components\web
 */
class Controller
{
    /**
     * @return Config
     */
    public function getConfig()
    {
        return Application::get('config');
    }

    /**
     * @param string $view
     * @param array $variables
     * @param null|string $layout
     * @return string
     */
    public function render($view, array $variables = [], $layout = null)
    {
        /** @var Template $template */
        $template = Application::get('template');
        if ($layout) {
            $template->layout = $layout;
        }

        $view = $this->getCalledController() . '/' . $view;
        return $template->render($view, $variables);
    }

    /**
     * @return string
     */
    private function getCalledController()
    {
        $class = end(explode('\\', get_called_class()));
        $class = substr($class, 0, -10);
        return ltrim(strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '-$0', $class)), '-');
    }


    private $modelsMap = [
        'comments' => 'models\Comment'
    ];

    /**
     * @var null|Model
     */
    private $model = null;

    /**
     * @return Model
     * @throws \Exception
     */
    protected function getModel()
    {
        if (null === $this->model) {
            $controller = $this->getCalledController();
            if (array_key_exists($controller, $this->modelsMap)) {
                $this->model = new $this->modelsMap[$controller];
            } else {
                throw new \Exception("Model for controller '{$controller}' is undefined");
            }
        }

        return $this->model;
    }
}
