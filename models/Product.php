<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__). $ds . '..') . $ds;

require_once("{$base_dir}includes{$ds}Database.php"); // Including database

// class start
class Product
{
    private $table = 'products';

    public $id;
    public $seller_id;
    public $name;
    public $image;
    public $price_per_kg;
    public $description;
    public $interaction_count;

    // contructor
    public function __construct()
    {
    }
 
    // validating if params exists or not
    public function validate_params($value)
    {
        return (!empty($value));
    }

    // storing product details
    public function add_product()
    {
        global $database;

        $this->seller_id = trim(htmlspecialchars(strip_tags($this->seller_id)));
        $this->name = trim(htmlspecialchars(strip_tags($this->name)));
        $this->image = trim(htmlspecialchars(strip_tags($this->image)));
        $this->price_per_kg = trim(htmlspecialchars(strip_tags($this->price_per_kg)));
        $this->description = trim(htmlspecialchars(strip_tags($this->description)));
        
        $sql = "INSERT INTO $this->table (seller_id, name, image, price_per_kg, description) VALUES (
            '" .$database->escape_value($this->seller_id). "',
            '" .$database->escape_value($this->name). "',
            '" .$database->escape_value($this->image). "',
            '" .$database->escape_value($this->price_per_kg). "',
            '" .$database->escape_value($this->description). "'
            )";
            
        $result = $database->query($sql);
        
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    // method to return the list of products per seller
    public function get_products_per_seller()
    {
        global $database;
        
        $this->seller_id = trim(htmlspecialchars(strip_tags($this->seller_id)));

        $sql = "SELECT * FROM $this->table WHERE seller_id = '" .$database->escape_value($this->seller_id). "'";

        $result = $database->query($sql);

        return $database->fetch_array($result);
    }
} // class ends

// object
$product = new Product();
