<?php

namespace Geekbrains\Application1\Controllers;

use Geekbrains\Application1\Render;
use Geekbrains\Application1\Models\User;

class UserController {

    public function actionAddUser() {
        return "Добавить персону";
    }

    public function actionIndex() {
        $users = User::getAllUsersFromStorage();
        $render = new Render();
        if(!$users){
            return $render->renderPage(
                'user-empty.twig',
                [
                    'title' => 'Список пользователей',
                    'message' => "Списка нет"
                ]);
        }
        else{
            return $render->renderPage(
                'user-index.twig',
                [
                    'title' => 'Список пользователей',
                    'users' => $users
                ]);
        }
    }

    public function actionSave() {
        $address = "./storage/birthdays.txt";
        $name = $_GET['name'];
        $date = $_GET['birthday'];
        $data = $name . ", " . $date . PHP_EOL;
        $fileHandler = fopen($address, 'a');
        if(fwrite($fileHandler, $data)){
            return "Пользователь добавлен";
        }
        else {
            return "Ошибка!";
        }
    }
}