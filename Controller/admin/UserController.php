<?php
/**
 * Summary of namespace Controller
 */
namespace Controller;

use Model\Entity\User;
use Form\UserHandleRequest;
use Model\Repository\UserRepository;

/**
 * Summary of UserController
 */
class UserController extends BaseController
{
    private UserRepository $userRepository;
    private UserHandleRequest $form;
    private User $user;

    public function __construct()
    {
        $this->userRepository = new UserRepository;
        $this->form = new UserHandleRequest;
        $this->user = new User;
    }
    public function list()
    {
        $users = $this->userRepository->findAll($this->user);

        $this->render("user/index.html.php", [
            "h1" => "Users list",
            "users" => $users
        ]);
    }
    public function new()
    {
        $user = $this->user;
        $this->form->handleInsertForm($user);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $this->userRepository->insertUser($user);
            return redirection(addLink("home"));
        }

        $errors = $this->form->getEerrorsForm();

        return $this->render("user/register.html.php", [
            "h4" => "Add a new user",
            "user" => $user,
            "errors" => $errors
        ]);
    }
    /**
     * Summary of edit
     * @param mixed $id
     * @return void
     */
    public function edit($id)
    {
        if (!empty($id) && is_numeric($id) && $this->getUser()) {

            /**
             * @var User
             */
            $user = $this->getUser();

            $this->form->handleEditForm($user);

            if ($this->form->isSubmitted() && $this->form->isValid()) {
                $this->userRepository->updateUser($user);
                return redirection(addLink("home"));
            }

            $errors = $this->form->getEerrorsForm();
            return $this->render("user/form.html.php", [
                "h1" => "Updating the user n° $id",
                "user" => $user,
                "errors" => $errors
            ]);
        }
        return redirection("/errors/404.php");
    }
    public function delete($id)
    {
        if (!empty($id) && $id && $this->getUser()) {
            if (is_numeric($id)) {

                $user = $this->user;
            } else {
                $this->setMessage("danger", "ERROR 404 : the page does not exist");
            }
        } else {
            $this->setMessage("danger", "ERROR 404 : the page does not exist");
        }

        $this->render("user/form.html.php", [
            "h1" => "Deleting the user n°$id ?",
            "user" => $user,
            "mode" => "deleting"
        ]);
    }

    public function show($id)
    {
        if ($id) {
            if (is_numeric($id)) {
                $user = $this->user;
            } else {
                $this->setMessage("danger", "Error 404 : the page does not exist");
            }
        } else {
            $this->setMessage("danger", "Error 403 : you do not have acces to this URL");
            redirection(addLink("user", "list"));
        }

        $this->render("user/show.html.php", [
            "user" => $user,
            "h1" => "User page"
        ]);
    }

    public function login()
    {

        if ($this->isUserConnected()) {
            /**
             * @var User
             */
            $user = $this->getUser();

            $this->setMessage("error", $user->getName() . " , you are already connected");
            return redirection(addLink("home"));
        }

        $this->form->handleLogin();

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            /**
             * @var User
             */
            $user = $this->getUser();
            $this->setMessage("succes", "Hello " . $user->getName() . ", you are connected");
            redirection(addLink("home"));
            return redirection(addLink("home"));
        }

        $errors = $this->form->getEerrorsForm();

        return $this->render("security/login.html.php", [
            "h1" => "Enter your login credentials",
            "errors" => $errors

        ]);
    }

    public function logout()
    {
        $this->disconnection();
        $this->setMessage("success", "You have disconnected");
        redirection(addLink("home"));
    }
}