<?php

class Images {
    /*public static function insertPicture($username, $imgName) {
        $db = Db::getInstance()->prepare('INSERT INTO images (uidUser, imageName) VALUES (?, ?)');
        $db->execute([$username, $imgName]);
    }*/

    public static function insertPicture($id, $imgName) {
        $db = Db::getInstance()->prepare('INSERT INTO images (idUser, imageName) VALUES (?, ?)');
        $db->execute([$id, $imgName]);
    }

    /*public static function getPicturesInformation() {
        $db = Db::getInstance()->prepare("SELECT uidUser, imageName FROM images");
        $db->execute();

        return $row = $db->fetchAll();
    }*/
    public static function getPicturesInformation() {
        $db = Db::getInstance()->prepare("SELECT idUser, imageName FROM images");
        $db->execute();

        return $row = $db->fetchAll();
    }

    public static function deletePicture($imagename) {
        $db = Db::getInstance()->prepare("DELETE FROM images WHERE imageName=?");
        $db->execute([$imagename]);
    }

    public static function countAllImages() {
        $db = Db::getInstance()->prepare("SELECT COUNT(imageName) FROM images");
        $db->execute();

        return $row = $db->fetch();
    }

    public static function deleteUserImages($username) {
        $db = Db::getInstance()->prepare("DELETE FROM images WHERE uidUser=?");
        $db->execute([$username]);
    }
}