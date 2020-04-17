<?php

class IndexController {
    public function index() {
        $user = new Images();

        $view = new View();
        $view->render('index');


    }

    public function count() {
        $img = Images::countAllImages();

        echo 'Number of images: '.$img['COUNT(imageName)'];
    }

}