<?php
namespace Services;

use Repositories\OrderRepository;

class OrderService {

    private $repository;

    function __construct()
    {
        $this->repository = new OrderRepository();
    }

    public function getAll($offset = NULL, $limit = NULL) {
        return $this->repository->getAll($offset, $limit);
    }

    public function insert($orders, $userid) {       
        return $this->repository->insert($orders, $userid);        
    }

    public function update($item, $id) {       
        return $this->repository->update($item, $id);        
    }

    public function delete($item) {       
        return $this->repository->delete($item);        
    }
}

?>