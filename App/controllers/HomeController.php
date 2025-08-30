<?php

namespace App\controllers;
use Framework\Database;
 class HomeController{

    protected $db;

    public function __construct()
    {
     $config = require_once base_path('config/db.php');
     $this->db = new Database($config);  
    }
    
    /**
     *Show home page.
     * @return void
     */
    public function index(){
        $listings = $this->db->query('SELECT * FROM listing Limit 6;')->fetchAll();
        loadView('home',[
        'listings' => $listings
        ]);
    }
 }