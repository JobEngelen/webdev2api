<?php
namespace Models;

class OrderProduct {

    public int $id;
    public string $orderTime;
    public User $user;
    //public Product $product;
    public $products = array();
    public bool $delivered;

}

?>