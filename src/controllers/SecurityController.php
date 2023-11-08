<?php

use exceptions\UserNotFoundException;

require_once 'AppController.php';
require_once __DIR__ .'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../exceptions/UserNotFoundException.php';
require_once __DIR__.'/../repository/SessionRepository.php';

class SecurityController extends AppController {

    private $userRepository;
    private $sessionRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->sessionRepository = new SessionRepository();
    }

    public function login()
    {
        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = hash('sha256', $_POST['password']);

        try {
            $user = $this->userRepository->getUser($email);
        } catch (UserNotFoundException $exception) {
            return $this->render('login', ['messages' => ['User not found!']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email not exist!']]);
        }

        if ($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        setcookie('id', $user->getId(), time() + 3600, '/');
        setcookie('login', $user->getEmail(), time() + 3600, '/');


        $this->sessionRepository->addSession($user->getId(), $user->getEmail());

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/reports");
    }

    public function logout()
    {
        $id = $_COOKIE['id'];
        $login = $_COOKIE['login'];

        $this->sessionRepository->removeSession($id, $login);

        if (isset($_COOKIE['id'])) {
            unset($_COOKIE['id']);
            setcookie('id', null, -1, '/');
        }

        if (isset($_COOKIE['login'])) {
            unset($_COOKIE['login']);
            setcookie('login', null, -1, '/');
        }

        return $this->render('login', ['messages' => ['Wylogowano']]);
    }

    public function register()
    {
        if (!$this->isPost()) {
            return $this->render('register');
        }

        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirmedPassword'];

        if ($password !== $confirmedPassword) {
            return $this->render('register', ['messages' => ['Hasła nie są takie same!']]);
        }

        $user = new User($email, hash('sha256', $password), $name, $surname);
        $user->setPhone($phone);

        $this->userRepository->addUser($user);

        return $this->render('login', ['messages' => ['Zarejestrowano']]);
    }
}