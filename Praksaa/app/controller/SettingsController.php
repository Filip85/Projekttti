<?php

class SettingsController {
    public function index() {
        Session::start();
        $session = Session::get('username');

        $id = User::getUserId($session); //novo

        $user = new User();
        //$userStatus = $user->getStatus($session);

        $userStatus = User::getStatus($id);

        if(isset($_SESSION['username'])) {
            $view = new View();
            $view->render('settings', [
                'homeMessage' => $_SESSION['username'],
                'status' => $userStatus['userStatus']
            ]);
        }
        else {
            echo 'Please, sign in!';
        }

        /*$view = new View();
        $view->render('settings', [
            'homeMessage' => $_SESSION['username'],
            'status' => $userStatus['userStatus']
        ]);*/


    }

    public function changePassword() {
        if(isset($_POST['changePassword'])) {
            Session::start();
            $password = $_POST['password'];
            $hashedPwd = password_hash($_POST['password'], PASSWORD_DEFAULT);

            User::updateUser($_SESSION['username'], $hashedPwd);

            header('Location: /settings');
        }
    }

    public function changeStatus() {
        if(isset($_POST['changeStatus'])) {
            Session::start();
            $session = Session::get('username');

            $id = User::getUserId($session);

            $status = User::getStatus($id);

            echo $status;

            if($status['userStatus'] === 'public') {
                User::changeStatus('private', $session);
                echo $status;
            }
            else {
                User::changeStatus('public', $session);
            }

            header('Location: /settings');
        }
    }

    public function deleteUserAccount() {
        if(isset($_POST['removeAccount'])) {
            Session::start();
            $session = Session::get('username');

            $userid = User::getUserId($session);
            User::deleteUser($userid);
            //Images::deleteUserImages($session);

            header('Location: ../');
        }
    }
}