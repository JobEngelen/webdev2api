<?php

namespace Repositories;

use PDO;
use PDOException;
use Repositories\Repository;

class OrderRepository extends Repository
{
    function getAll($offset = NULL, $limit = NULL)
    {
        try {
            $query = "SELECT * FROM order";
            if (isset($limit) && isset($offset)) {
                $query .= " LIMIT :limit OFFSET :offset ";
            }
            $stmt = $this->connection->prepare($query);
            if (isset($limit) && isset($offset)) {
                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            }
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Order');
            $articles = $stmt->fetchAll();

            return $articles;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function insert($order)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO order (userid) VALUES (?)");

            $stmt->execute([$order->user->name]);

            $order->id = $this->connection->lastInsertId();

            return $order;
        } catch (PDOException $e) {
            echo $e;
        }
    }


    function update($id)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE order SET delivered = 1 WHERE id = ?");

            $stmt->execute([$id]);

        } catch (PDOException $e) {
            echo $e;
        }
    }

    function delete($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM order WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return;
        } catch (PDOException $e) {
            echo $e;
        }
        return true;
    }
}
