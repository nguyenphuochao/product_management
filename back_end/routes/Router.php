<?php

class Router
{
    protected $match;
    protected $controller;
    protected $method;

    public function __construct(AltoRouter $router)
    {
        $this->match = $router->match();
        $match = $router->match();

        if ($this->match) {
            list($controller, $method) = explode('@', $this->match['target']);
            $this->controller = $controller;
            $this->method = $method;

            if (is_callable(array(new $this->controller, $this->method))) {
                call_user_func_array(
                    array(new $this->controller, $this->method),
                    array($this->match['params']),
                );
            } else {
                echo 'the method' . "$method" . 'was not found on controller' . "$controller";
            }
            
        } else {
            echo 'the page you are looking could not be found';
        }
    }
}
