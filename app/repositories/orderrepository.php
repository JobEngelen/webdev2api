<?php

namespace Repositories;

use PDO;
use PDOException;
use Repositories\Repository;
use Models\OrderProduct;
use Models\User;
use Models\Product;

class OrderRepository extends Repository
{
    function getAll()
    {
        try {
            $query = "SELECT o.*, u.id AS uid, u.username 
                    FROM `order` AS o 
                    INNER JOIN user AS u ON u.id = o.userid
                    ORDER BY DELIVERED ASC, ordertime ASC";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();

            $orders = array();
            while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
                $orders[] = $this->rowToOrder($row);
            }

            $query = "SELECT op.*, p.*
                    FROM `order_product` AS op
                    INNER JOIN product AS p ON op.product_id = p.id;";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();


            while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
                foreach ($orders as $key => $order) {
                    $orders[$key] = $this->rowToOrderProduct($row, $order);
                }
            }

            return $orders;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function rowToOrder($row)
    {
        $order = new OrderProduct();
        $order->id = $row['id'];
        $order->orderTime = $row["ordertime"];
        $order->user = new User();
        $order->user->id = $row['uid'];
        $order->user->username = $row['username'];
        $order->products = array();
        $order->delivered = $row['delivered'];
        return $order;
    }

    function rowToOrderProduct($row, $order)
    {
        if ($row['order_id'] == $order->id) {
            $product = new Product();
            $product->id = $row['product_id'];
            $product->name = $row['name'];
            $product->price = $row['price'];
            $product->image = $row['image'];
            $product->quantity = $row['quantity'];

            $order->products[count($order->products)] = $product;
        }
        return $order;
    }

    function insert($orders, $userid)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO `order` (userid) VALUES (:id)");
            $stmt->bindParam(':id', $userid, PDO::PARAM_INT);
            $stmt->execute();

            $orderId = $this->connection->lastInsertId();

            $stmt = $this->connection->prepare("INSERT INTO order_product (order_id, product_id, quantity) VALUES (:orderId, :productId, :quantity)");
            foreach ($orders as $order) {

                $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
                $stmt->bindParam(':productId', $order->id, PDO::PARAM_INT);
                $stmt->bindParam(':quantity', $order->quantity, PDO::PARAM_INT);
                $stmt->execute();
            }

            return "Bestelling id(" . $orderId . ") geplaatst!";
        } catch (PDOException $e) {
            echo $e;
        }
    }


    function update($id, $status)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE `order` SET delivered = :status WHERE id = :id");
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function delete($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM `order` WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt = $this->connection->prepare("DELETE FROM `order_product` WHERE order_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return;
        } catch (PDOException $e) {
            echo $e;
        }
        return true;
    }
}
