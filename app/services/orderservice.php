<?php
namespace Services;

use Repositories\OrderRepository;

class OrderService {

    private $repository;

    function __construct()
    {
        $this->repository = new OrderRepository();
    }

    public function getAll() {
        return $this->repository->getAll();
    }

    public function insert($orders, $userid) {       
        return $this->repository->insert($orders, $userid);        
    }

    public function update($id, $status) {       
        return $this->repository->update($id, $status);        
    }

    public function delete($item) {       
        return $this->repository->delete($item);        
    }
}

?>