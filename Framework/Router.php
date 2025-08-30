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
    public function registerRoute($method, $uri, $action){
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
    public function route($uri,$method){
        foreach($this->routes as $route){
            if($route['uri'] === $uri && $route['method'] === $method){
                //extract controller and controller method
                $controller = 'App\\Controllers\\' . $route['controller'];
                $function = $route['function'];
                $controllerInstace = new $controller;
                $controllerInstace->$function();
                return;
            }
        }
        ErrorController::notFound("Page not found.");
    }
}

?>