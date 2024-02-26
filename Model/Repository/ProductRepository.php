<?php

namespace Model\Repository;

use Model\Entity\Product;
use Service\Session;

class ProductRepository extends BaseRepository
{
    public function findByReference($reference)
    {
        $request = $this->dbConnection->prepare("SELECT * FROM product WHERE reference = :reference");
        $request->bindParam(":reference", $reference);

        if ($request->execute()) {
            if ($request->rowCount() == 1) {
                $request->setFetchMode(\PDO::FETCH_CLASS, "Model\Entity\Product");
                return $request->fetch();
            } else {
                return false;
            }
        } else {
            return null;
        }
    }
    public function checkProductExist($reference)
    {
        $request = $this->dbConnection->prepare("SELECT COUNT(*) FROM product WHERE reference = :reference");
        $request->bindParam(":reference", $reference);

        $request->execute();
        $count = $request->fetchColumn();
        return $count > 1 ? true : false;
    }

    public function insertProduct(Product $product)
    {
        $sql = "INSERT INTO product (title, description, reference, price, stock, photo, category_id, created_at) VALUES (:title, :description, :reference,:price, :stock, :photo, :categoryId, NOW())";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":title", $product->getTitle());
        $request->bindValue(":description", $product->getDescription());
        $request->bindValue(":reference", $product->getReference());
        $request->bindValue(":price", $product->getPrice());
        $request->bindValue(":stock", $product->getStock());
        $request->bindValue(":photo", $product->getPhoto());
        $request->bindValue(":categoryId", $product->getCategoryId());

        $request = $request->execute();
        if ($request) {
            if ($request == 1) {
                Session::addMessage("success", "The new product has been successfully registered");
                return true;
            }
            Session::addMessage("danger", "Error : the product has not been registered");
            return false;
        }
        Session::addMessage("danger", "SQL Error");
        return null;
    }


    public function updateProduct(Product $product)
    {
        $sql = "UPDATE product
                SET description = :description, price = :price, title = :title, reference = :reference, stock = :stock, photo = :photo, category_id = :categoryId
                WHERE id = :id";
        $request = $this->dbConnection->prepare($sql);

        $request->bindValue(":id", $product->getId());
        $request->bindValue(":title", $product->getTitle());
        $request->bindValue(":description", $product->getDescription());
        $request->bindValue(":reference", $product->getReference());
        $request->bindValue(":price", $product->getPrice());
        $request->bindValue(":stock", $product->getStock());
        $request->bindValue(":photo", $product->getPhoto());
        $request->bindValue(":categoryId", $product->getCategoryId());

        $request = $request->execute();
        if ($request) {
            if ($request == 1) {
                Session::addMessage("success", "The product update has been successfully completed");
                return true;
            }
            Session::addMessage("danger", "Error : The product has not been updated");
            return false;
        }
        Session::addMessage("danger", "SQL Error");
        return null;
    }
    public function updateQuantityInProduct($productId, $stock)
    {
        $sql = "UPDATE product
                SET stock = stock - :stock
                WHERE id = :id";
        $request = $this->dbConnection->prepare($sql);

        $request->bindValue(":id", $productId);
        $request->bindValue(":stock", $stock);

        $request = $request->execute();
        if ($request) {
            if ($request == 1) {
                return true;
            }
            Session::addMessage("danger", "Error : The product has not been updated");
            return false;
        }
        Session::addMessage("danger", "SQL Error");
        return null;
    }

    public function findProductAndCategoryById($id)
    {

        $request = $this->dbConnection->prepare("SELECT p.*, c.id as c_id, c.type as c_type, c.is_deleted as c_is_deleted, c.created_at as c_created_at, c.updated_at as c_updated_at FROM product p join category c On p.category_id = c.id WHERE p.id = :id");

        $request->bindParam(":id", $id);

        if ($request->execute()) {
            if ($request->rowCount() == 1) {

                $request->setFetchMode(\PDO::FETCH_CLASS, "Model\Entity\Product");
                return $request->fetch();

            } else {
                return false;
            }
        } else {
            return null;
        }
    }
    public function findProductAndCategory()
    {

        $request = $this->dbConnection->prepare("SELECT p.*, c.id as c_id, c.type as c_type, c.is_deleted as c_is_deleted, c.created_at as c_created_at, c.updated_at as c_updated_at FROM product p join category c On p.category_id = c.id");


        if ($request->execute()) {
            if ($request->rowCount() == 1) {

                $request->setFetchMode(\PDO::FETCH_CLASS, "Model\Entity\Product");
                return $request->fetch();

            } else {
                return false;
            }
        } else {
            return null;
        }
    }
}