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

        $orders = $this->service->getAll();

        $this->respond($orders);
    }

    public function create()
    {
        try {
            $postedOrder = $this->createObjectFromPostedJson("Models\\Order");
            $orders = $postedOrder->orderstring;
            
            $response = $this->service->insert($orders, htmlspecialchars($postedOrder->userid));
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond($response);
    }

    public function update($id, $status)
    {
        try {
            $this->service->update($id, $status);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
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
