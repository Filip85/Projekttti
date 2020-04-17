<?php

class RegistrationController {
    public function index() {
        Session::start();
        Session::stop();

        $view = new View();
        $view->render('registration', [
            'homeMessage' => 'Da vidim jel radi.'
        ]);
    }

    public function signup() {

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password_1 = $_POST['password'];
        $password_2 = $_POST['repeatPassword'];

        if (isset($_POST['signUpButton'])) {

            if (empty($username) || empty($email) || empty($password_1) || empty($password_1)) {
                echo 'Please enter your username, email and password!';
            } else {
                if (($password_1 !== $password_2) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo 'Passwords dont match or email is invalid';
                } else {

                    $db = Db::getInstance()->prepare("SELECT uidUser, pwdUser FROM users WHERE uidUser=?");
                    $db->execute([$username]);

                    if ($db->rowCount() > 0) {
                        echo 'Please enter another username!';
                    } else {
                        $hashedPwd = password_hash($password_1, PASSWORD_DEFAULT);
                        User::insert($username, $email, $hashedPwd);

                        $userExists = User::getUser($username, $password_1);
                        header('Location: /profile');
                        //echo $userExists;
                        if ($userExists === $username) {
                            Session::start();
                            Session::set('username', $username);
                            $session = Session::get('username');
                            echo $session;
                            header('Location: /profile');
                        }
                    }
                }
            }
        }
    }
}