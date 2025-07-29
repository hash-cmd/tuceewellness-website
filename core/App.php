<?php
namespace Core;

class App
{
    protected $controller = 'HomeController'; // Default controller
    protected $method = 'index';              // Default method
    protected $params = [];                   // URL parameters

    public function __construct()
    {
        $url = $this->parseUrl();

        // ✅ Load the Controller
        if (!empty($url[0])) {
            $controllerName = ucfirst($url[0]) . 'Controller';
            $controllerClass = "App\\Controllers\\$controllerName";

            if (class_exists($controllerClass)) {
                $this->controller = $controllerClass;
                array_shift($url);
            } else {
                // Controller not found → load ErrorController
                $this->controller = 'App\\Controllers\\ErrorController';
            }
        } else {
            $this->controller = 'App\\Controllers\\HomeController';
        }


        // Instantiate the controller
        $this->controller = new $this->controller;

        // ✅ Load the Method
        if (!empty($url[0]) && method_exists($this->controller, $url[0])) {
            $this->method = $url[0];
            array_shift($url);
        }

        // ✅ Get the Parameters
        $this->params = $url ?? [];

        // ✅ Call the Controller Method with Parameters
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * ✅ Break down the URL into controller/method/params
     */
    protected function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}
