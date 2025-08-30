<?php
/**
 * Get the base path
 * @param string $path
 * @return string
 */

function base_path($path){
    return __DIR__ . DIRECTORY_SEPARATOR . $path ;
}

/**
 * Get the base url
 * @param string $path
 * @return string
 */
function base_url($path){
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
    $domain = $_SERVER['HTTP_HOST'];
    return $protocol . $domain .  '\\' . $path ;

}

/**
 * Loads a view
 * @param string $name
 * @return void
 */
function loadView($name,$data =[]){
    $viewPath =  base_path("App/views/$name.view.php");
    if(file_exists($viewPath)){
        extract($data);
        require_once $viewPath;
    }else{
        echo "The view $name not found.";
    }
}

/**
 * Loads partials
 * @param string $name
 * @return void
 */
function loadPartials($name){
    $partialsPath = base_path("App/views/partials/$name.php");
        if(file_exists($partialsPath)){
        require_once $partialsPath;
    }else{
        echo "The partial $name not found.";
    }
}

/**
 * Loads partials
 * @param mixed $value
 * @return void
 */
function inspect($value){
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}

/**
 * Loads partials
 * @param mixed $value
 * @return void
 */
function inspectValueAndDie($value){
    echo '<pre>';
    die(var_dump($value));
    echo '</pre>';
    
}

/**
 * Formats Salary
 * @param string $salary
 * @return string Formatted Salary
 */
function formatSalary($salary){
    return '$' . number_format(floatval($salary));
}
/**
 * Class autoloder
 * @param string $className
 * @return class object
 */
// spl_autoload_register(function($className){
//     $path = base_path('Framework/' . $className . '.php');
//     if(file_exists($path)){
//         require $path;
//     }

// });

?>