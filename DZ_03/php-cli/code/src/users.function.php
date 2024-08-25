<?php

function findUsers($userData, $nameToSearch = '', $dateToSearch = '')
{
    $foundUsers = [];
    $nameToSearch = mb_strtolower($nameToSearch);

    foreach ($userData as $userDataItem) {
        $name = trim($userDataItem[0]);
        $birthdate = trim($userDataItem[1]);

        if (!empty($nameToSearch) && empty($dateToSearch)) {
            if (strpos(mb_strtolower($name), $nameToSearch) !== false) {
                $foundUsers[array_search($userDataItem, $userData)] = [$name, $birthdate];
            }
        } elseif (empty($nameToSearch) && !empty($dateToSearch)) {
            if (strpos($birthdate, $dateToSearch) !== false) {
                $foundUsers[array_search($userDataItem, $userData)] = [$name, $birthdate];
            }
        } elseif (!empty($nameToSearch) && !empty($dateToSearch)) {
            if (strpos(mb_strtolower($name), $nameToSearch) !== false && strpos($birthdate, $dateToSearch) !== false) {
                $foundUsers[array_search($userDataItem, $userData)] = [$name, $birthdate];
            }
        }
    }
    return $foundUsers;
}

function getQueryUsersDelete()
{
    $nameToDelete = readline('Введите имя пользователя для удаления (или нажмите Enter, чтобы пропустить): ');
    $dateToDelete = readline('Введите дату рождения для удаления (в формате dd-mm-yyyy, или нажмите Enter, чтобы пропустить): ');

    return [$nameToDelete, $dateToDelete];
}

function deleteUsers(array $config)
{
    $content = '';

    $address = $config['storage']['address'];
    $userData = readUserDataFromFile($address);
    list($nameToDelete, $dateToDelete) = getQueryUsersDelete();

    if (empty($nameToDelete) && empty($dateToDelete)) {
        return handleError("Не указаны критерии для удаления.");
    }

    $foundUsersToDelete = findUsers($userData, $nameToDelete, $dateToDelete);
    if (empty($foundUsersToDelete)) {
        return handleError("Ни один пользователь не найден.");
    }
    echo "Найденные пользователи для удаления:" . PHP_EOL;
    foreach ($foundUsersToDelete as $foundUser) {
        echo "- $foundUser[0]" . PHP_EOL;
    }
    $confirmation = readline("Вы уверены, что хотите удалить найденных пользователей? (y/n): ");
    if ($confirmation === 'y') {
        foreach ($foundUsersToDelete as $userDataItem) {
            unset($userData[array_search($userDataItem, $foundUsersToDelete)]);
        }
        writeUserDataToFile($address, $userData);
        $content .= "Пользователи удалены." . PHP_EOL;
    } else {
        return handleError("Удаление пользователей отменено.");
    }
    return $content;
}