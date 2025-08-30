<?php
namespace Framework;
use App\controllers\ErrorController;
class Router{
    protected $routes = [];
    /**
     * Add a  route
     * @param string $method
     * @param string $uri
     * @param string $routes
     * @param void
     */
    public function registerRoute($method,$uri, $action){
        list($controller, $function) = explode('@', $action);
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'function' => $function
        ];
    }

    /**
     * Add a Get route
     * @param string $uri
     * @param string $controller
     * @param void
     */

    public function get($uri, $controller){
        $this->registerRoute('GET', $uri,$controller);
    }

    /**
     * Add a Post route
     * @param string $uri
     * @param string $controller
     * @param void
     */

    public function post($uri, $controller){
        $this->registerRoute('POST', $uri,$controller);
    }

    /**
     * Add a Put route
     * @param string $uri
     * @param string $controller
     * @param void
     */

    public function put($uri, $controller){
        $this->registerRoute('PUT', $uri,$controller);
    }

    /**
     * Add a delete route
     * @param string $uri
     * @param string $controller
     * @param void
     */

    public function delete($uri, $controller){
       $this->registerRoute('DELETE', $uri,$controller); 
    }
    /**
     * Add a delete route
     * @param string $httpcode
     * @param void
     */
    public function notfounderror($httpcode = 404){
        http_response_code($httpcode);
        loadView("error/{$httpcode}");
        exit;
    }

    /**
     * @param string $uri
     * @param string $method
     * @return void
     */
    public function route($uri){
        $method = $_SERVER['REQUEST_METHOD'];
        foreach($this->routes as $route){
            //extract controller and controller method
            $pattern = preg_replace('#\{[a-zA-Z0-9]+}#', '([a-zA-Z0-9]+)',$route['uri']);
            if(preg_match('#^'. $pattern . '$#', $uri, $matches)){
                array_shift($matches);
                $controller = 'App\\Controllers\\' . $route['controller'];
                $function = $route['function'];
                $params = $matches;
                $controllerInstace = new $controller;
                call_user_func([$controllerInstace,$function], $params);
                return;
            }
        }
        ErrorController::notFound("Page not found.");
    }
}

?>