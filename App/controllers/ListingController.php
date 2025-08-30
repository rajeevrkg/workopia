<?php
namespace App\controllers;
use Framework\Database;

class ListingController{
    protected $db;

    public function __construct()
    {
        $config = require_once base_path('config/db.php');
        $this->db = new Database($config); 
    }

    /**
     * Show latest listing
     * @return void
     */
    public function index(){
        $listings = $this->db->query('SELECT * FROM listing Limit 6;')->fetchAll();
        loadView('listing/index',[
        'listings' => $listings
        ]);
    }

    /**
     * Creating job listing
     * @return void
     */
    public function create(){
        loadView('listing/create');
    }
    
    /**
     * Show Single Listing
     * @return void
     */
    public function show(){
        $id = $_GET['id'] ?? '';
        $param = [
                'id'=>$id
                ];
        $list = $this->db->query('SELECT * FROM listing WHERE Id = :id;', $param)->fetch();

        loadView('listing/show', ['list'=>$list]);
    }
}

?>