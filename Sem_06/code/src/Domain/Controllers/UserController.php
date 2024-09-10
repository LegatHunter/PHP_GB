<?php

namespace Geekbrains\Application1\Domain\Controllers;

use Geekbrains\Application1\Application\Render;
use Geekbrains\Application1\Domain\Models\User;

class UserController
{

    public function actionIndex(): string
    {
        $users = User::getAllUsersFromStorage();
        $render = new Render();

        if (!$users) {
            return $render->renderPage(
                'user-empty.tpl',
                [
                    'title' => 'Список пользователей в хранилище',
                    'message' => "Список пуст или не найден"
                ]
            );
        } else {
            return $render->renderPage(
                'user-index.tpl',
                [
                    'title' => 'Список пользователей в хранилище',
                    'users' => $users
                ]
            );
        }
    }

    public function actionSave(): string
    {
        if (User::validateRequestData()) {
            $user = new User();
            $user->setParamsFromRequestData();
            $user->saveToStorage();

            $render = new Render();

            return $render->renderPage(
                'user-created.tpl',
                [
                    'title' => 'Пользователь создан',
                    'message' => "Создан пользователь " . $user->getUserName() . " " . $user->getUserLastName()
                ]
            );
        } else {
            throw new \Exception("Переданные данные некорректны");
        }
    }

    public function actionUpdate(): string
    {
        if (isset($_GET['id']) && User::exists($_GET['id'])) {
            $user = new User();
            $user->setUserId($_GET['id']);
            $arrayData = [];
            if (isset($_GET['name'])) {
                $arrayData['user_name'] = $_GET['name'];
            }
            if (isset($_GET['lastname'])) {
                $arrayData['user_lastname'] = $_GET['lastname'];
            }
            if (!empty($arrayData)) {
                $user->updateUser($arrayData);
            } else {
                throw new \Exception("Нет данных для обновления");
            }
        } else {
            throw new \Exception("Пользователь не существует");
        }
        $render = new Render();
        return $render->renderPage(
            'user-updated.tpl',
            [
                'title' => 'Пользователь обновлен',
                'message' => "Обновлен пользователь с ID " . $user->getUserId()
            ]
        );
    }

    public function actionDelete(): string
    {
        if (isset($_GET['id']) && User::exists($_GET['id'])) {
            User::deleteFromStorage($_GET['id']);
            $render = new Render();
            return $render->renderPage(
                'user-removed.tpl',
                ['title' => 'Пользователь удалён']
            );
        } else {
            throw new \Exception("Пользователь не существует");
        }
    }


}