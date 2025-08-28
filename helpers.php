<?php
/**
 * Get the pase path
 * @param string $path
 * @return string
 */

function base_path($path){
    return __DIR__ . DIRECTORY_SEPARATOR . $path ;
}

function base_url($path){
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
    $domain = $_SERVER['HTTP_HOST'];
    return $protocol . $domain .  '\\' . $path ;

}

?>