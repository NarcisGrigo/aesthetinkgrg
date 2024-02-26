<?php

namespace Model\Repository;

use Model\Entity\Order;
use Service\Session;

class OrderRepository extends BaseRepository
{
    public function insertOrder()
    {
        $order = new Order;
        $order->setUserId($_SESSION["user"]->getId());

        try {

            $this->dbConnection->beginTransaction();
            $sql = "INSERT INTO `order` (state, user_id, created_at) VALUES (:state, :userId, NOW())";

            $request = $this->dbConnection->prepare($sql);

            $request->bindValue(":state", $order->getState());
            $request->bindValue(":userId", $order->getUserId());

            $request = $request->execute();
            $idOrder = $this->dbConnection->lastInsertId();

            // Validate the transaction if everything went well
            $this->dbConnection->commit();

            if ($request) {
                if ($request == 1) {
                    return $idOrder;
                }
                Session::addMessage("danger", "Error : the order has not been registered");
                return false;
            }
        } catch (\PDOException $e) {

            // In case of error, roll back the transaction
            $this->dbConnection->rollBack();
            echo "Error : " . $e->getMessage();
        }
    }


    public function updateOrder(Order $order)
    {
        $sql = "UPDATE order
                SET state = :state, user_id = :userId
                WHERE id = :id";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":id", $order->getId());
        $request->bindValue(":state", $order->getState());
        $request->bindValue(":userId", $order->getUserId());
        $request = $request->execute();
        if ($request) {
            if ($request == 1) {
                Session::addMessage("success", "The order update was successfully completed");
                return true;
            }
            Session::addMessage("danger", "Error : Order was not updated");
            return false;
        }
        Session::addMessage("danger", "SQL Error");
        return null;
    }

}