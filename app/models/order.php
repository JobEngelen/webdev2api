<?php
namespace Models;

class Order {

    public int $id;
    public string $orderTime;
    public User $user;
    public bool $delivered;

}

?>