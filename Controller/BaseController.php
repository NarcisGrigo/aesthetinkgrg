<?php

namespace Controller;


use Service\Session as Session;

abstract class BaseController
{
    public function render($file, array $settings = [])
    {
        extract($settings);
        include "public/header.html.php";
        include "views/$file"; // Use the correct path to the views directory
        include "public/footer.html.php";
    }

    public function getUser()
    {
        $user = Session::getUserConnected();

        // You must check if the user id of the url is indeed the same id as the connected user

        if (!$user) {
            redirection("/error/403.php");
        }
        return $user;
    }

    public function isUserConnected()
    {
        return Session::isConnected();
    }

    public function getAdmin()
    {
        $user = Session::isAdmin();

        if (!$user) {
            redirection("/errors/403.php");
        }
        return $user;
    }

    /**
     * Summary of setMessage
     *
     * @param  mixed $type
     * @param  mixed $message
     * @return void
     */
    public function setMessage($type, $message)
    {
        Session::addMessage($type, $message);
    }

    public function disconnection()
    {
        Session::disconnected();
    }
    public function remove($value)
    {
        Session::delete($value);
    }

    public function redirectToRoute(array $linkInfo)
    {
        $controller = $linkInfo[0];
        $method = $linkInfo[1] ?? null;
        $id = $linkInfo[2] ?? null;
        redirection(addLink($controller, $method, $id));
    }
}
