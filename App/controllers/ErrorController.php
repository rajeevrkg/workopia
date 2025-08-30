<?php

namespace App\controllers;

class ErrorController{

    /**
     *Page not found.
     * @return void
     */
    public static function notFound($message = 'Resource not found.'){
        http_response_code(404);
        loadView('error' , [
            'responsecode' =>404,
            'message'=> $message
        ]);
    }

    /**
     *Show home page.
     * @return void
     */
    public static function forbidden($message = 'Resource not found.'){
        http_response_code(403);
        loadView('error' , [
            'responsecode' =>403,
            'message'=> $message
        ]);
    }

}