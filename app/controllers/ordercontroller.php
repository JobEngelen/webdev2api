<?php

namespace Controllers;

use Exception;
use Services\OrderService;

class OrderController extends Controller
{
    private $service;

    // initialize services
    function __construct()
    {
        $this->service = new OrderService();
    }

    public function getAll()
    {
        // Checks for a valid jwt, returns 401 if none is found
        $token = $this->checkForJwt();
        if (!$token)
            return;

        $offset = NULL;
        $limit = NULL;

        if (isset($_GET["offset"]) && is_numeric($_GET["offset"])) {
            $offset = $_GET["offset"];
        }
        if (isset($_GET["limit"]) && is_numeric($_GET["limit"])) {
            $limit = $_GET["limit"];
        }

        $orders = $this->service->getAll($offset, $limit);

        $this->respond($orders);
    }

    public function create()
    {
        try {
            $order = $this->createObjectFromPostedJson("Models\\order");
            $this->service->insert($order);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond($order);
    }

    public function update($id)
    {
        try {
            $order = $this->createObjectFromPostedJson("Models\\order");
            $this->service->update($order, $id);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond($order);
    }

    public function delete($id)
    {
        try {
            $this->service->delete($id);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond(true);
    }
}
