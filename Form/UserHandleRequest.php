<?php

namespace Form;

use Service\Session as Session;
use Model\Entity\User;
use Model\Repository\UserRepository;

class UserHandleRequest extends BaseHandleRequest
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository;
    }

    public function handleInsertForm(User $user)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            extract($_POST);
            $errors = [];

            // Checking the validity of the form
            if (empty($name)) {
                $errors[] = "Nickname cannot be empty";
            }
            if (strlen($name) < 4) {
                $errors[] = "The nickname must have at least 4 characters";
            }
            if (strlen($name) > 20) {
                $errors[] = "The nickname cannot have more than 20 characters";
            }

            if (!strpos($name, " ") === false) {
                $errors[] = "Spaces are not allowed for the nickname";
            }

            // Does the surname already exist in the database?

            $userExists = $this->userRepository->checkUserExist($name, $email);

            //$userExists = $this->userRepository->findByAttributes($user, ["name" => $surname]);

            if ($userExists) {
                $errors[] = "The nickname or email already exists, please choose a new one";
            }

            if (!empty($name)) {
                if (strlen($name) < 2) {
                    $errors[] = "The name must have at least 2 characters";
                }
                if (strlen($name) > 30) {
                    $errors[] = "The name cannot have more than 30 characters";
                }
            }
            if (empty($password)) {
                $errors[] = "Password cannot be empty";
            }


            if (empty($errors)) {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $user->setName($name);
                $user->setPassword($password);
                $user->setEmail($email);
                if (isset($role))
                    $user->setRole($role);
                return $this;
            }
            $this->setEerrorsForm($errors);
            return $this;
        }
    }

    public function handleEditForm($user)
    {
    }
    public function handleLogin()
    {
        if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST["login"])) {

            extract($_POST);
            $errors = [];
            if (empty($email) || empty($password)) {
                $errors[] = "Please insert your contact details";
            } else {
                /**
                 * @var User
                 */
                $user = $this->userRepository->loginUser($email);
                if (empty($user)) {
                    $errors[] = "There is no user with this email";
                } else {
                    if (!password_verify($password, $user->getPassword())) {
                        $errors[] = "Password does not match";
                    }
                }
            }
            if (empty($errors)) {
                Session::authentication($user);
                return $this;
            }

            $this->setEerrorsForm($errors);
            return $this;
        }
    }
}