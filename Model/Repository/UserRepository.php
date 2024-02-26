<?php

namespace Model\Repository;

use Model\Entity\User;
use Service\Session;

class UserRepository extends BaseRepository
{
    public function findByEmail($email)
    {
        $request = $this->dbConnection->prepare("SELECT * FROM user WHERE email = :email");
        $request->bindParam(":email", $email);

        if ($request->execute()) {
            if ($request->rowCount() == 1) {
                $request->setFetchMode(\PDO::FETCH_CLASS, "Model\Entity\User");
                return $request->fetch();
            } else {
                return false;
            }
        } else {
            return null;
        }
    }
    public function checkUserExist($name, $email)
    {
        $request = $this->dbConnection->prepare("SELECT COUNT(*) FROM user WHERE email = :email OR name = :name");
        $request->bindParam(":name", $name);
        $request->bindParam(":email", $email);

        $request->execute();
        $count = $request->fetchColumn();
        return $count > 1 ? true : false;
    }


    public function insertUser(User $user)
    {
        $sql = "INSERT INTO user (name, email, password, role, created_at) VALUES (:name, :email, :password, :role, NOW())";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":name", $user->getName());
        $request->bindValue(":email", $user->getEmail());
        $request->bindValue(":password", $user->getPassword());
        $request->bindValue(":role", $user->getRole());

        $request = $request->execute();
        if ($request) {
            if ($request == 1) {
                Session::addMessage("success", "The new user was successfully registered");
                return true;
            }
            Session::addMessage("danger", "Error : the user could not be registered");
            return false;
        }
        Session::addMessage("danger", "SQL Error");
        return null;
    }


    public function updateUser(User $user)
    {
        $sql = "UPDATE user
                SET name = :name, email = :email, password = :password, role = :role
                WHERE id = :id";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":id", $user->getId());
        $request->bindValue(":name", $user->getName());
        $request->bindValue(":email", $user->getEmail());
        $request->bindValue(":password", $user->getPassword());
        $request->bindValue(":role", $user->getRole());
        $request = $request->execute();
        if ($request) {
            if ($request == 1) {
                Session::addMessage("success", "An update of the user has successfully been made");
                return true;
            }
            Session::addMessage("danger", "Error : the user couldn't be updated");
            return false;
        }
        Session::addMessage("danger", "SQL Error");
        return null;
    }
    public function loginUser($email)
    {
        $request = $this->dbConnection->prepare("SELECT * FROM user WHERE email = :email");
        $request->bindParam(":email", $email);

        if ($request->execute()) {
            if ($request->rowCount() == 1) {
                $request->setFetchMode(\PDO::FETCH_CLASS, "Model\Entity\User");
                return $request->fetch();
            } else {
                return false;
            }
        } else {
            return null;
        }
    }
}