<?php

class LoginController {
    public function index() {
        Session::start();
        Session::stop();

        $view = new View();
        $view->render('login', [
            'homeMessage' => 'Da vidim jel radi.'
        ]);
    }
    public function signin() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(!empty($_POST['remember'])) {
            setcookie("username", $username, time() + 3600);
            setcookie("password", $password, time() + 3600);
        }

        if(isset($_POST['signInButton'])) {

            if(empty($username) || empty($password)) {
                echo 'Please enter your username and password!';
            }
            else {
                $pass = User::getPassword($username);
                $userExists = User::getUser($username);
                $pwdcheck = password_verify($password, $pass);
                if(($userExists === $username)  && $pwdcheck === true) {
                    Session::start();
                    Session::set('username', $username);
                    $session = Session::get('username');
                    echo $session;
                    /*if(!empty($_POST['remember'])) {
                        setcookie("username", $username, time() + 3600);
                        setcookie("password", $password, time() + 3600);
                    }
                    else {
                        if(isset($_COOKIE['username'])) {
                            setcookie("username","");
                        }
                        if(isset($_COOKIE['password'])) {
                            setcookie("password","");
                        }
                    }*/
                    header('Location: /profile');

                }
                else {
                    echo 'User does not exist';
                }
            }
        }
    }

    public function signout() {
        if(isset($_POST['signOutButton'])) {
            Session::start();
            Session::stop();
            header("Location:..");
        }
    }
}