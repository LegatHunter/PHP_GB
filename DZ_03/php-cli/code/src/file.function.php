<?php

// function readAllFunction(string $address) : string {
function readAllFunction(array $config): string
{
    $address = $config['storage']['address'];

    if (file_exists($address) && is_readable($address)) {
        $file = fopen($address, "rb");

        $contents = '';

        while (!feof($file)) {
            $contents .= fread($file, 100);
        }

        fclose($file);
        return $contents;
    } else {
        return handleError("Файл не существует");
    }
}

// function addFunction(string $address) : string {
function addFunction(array $config): string
{
    $address = $config['storage']['address'];

    $name = readline("Введите имя: ");
    if (!validateName($name)) {
        return handleError("Такого имени не существует");
    }
    $date = readline("Введите дату рождения в формате ДД-ММ-ГГГГ: ");
    if (!validateDate($date)) {
        return handleError("Не правильно указана дата");
    }
    $data = $name . ", " . $date . "\r\n";

    $fileHandler = fopen($address, 'a');

    if (fwrite($fileHandler, $data)) {
        return "Запись $data добавлена в файл $address";
    } else {
        return handleError("Произошла ошибка записи. Данные не сохранены");
    }

    fclose($fileHandler);
}

// function clearFunction(string $address) : string {
function clearFunction(array $config): string
{
    $address = $config['storage']['address'];

    if (file_exists($address) && is_readable($address)) {
        $file = fopen($address, "w");

        fwrite($file, '');

        fclose($file);
        return "Файл очищен";
    } else {
        return handleError("Файл не существует");
    }
}

function helpFunction()
{
    return handleHelp();
}

function readConfig(string $configAddress): array|false
{
    return parse_ini_file($configAddress, true);
}

function readProfilesDirectory(array $config): string
{
    $profilesDirectoryAddress = $config['profiles']['address'];

    if (!is_dir($profilesDirectoryAddress)) {
        mkdir($profilesDirectoryAddress);
    }

    $files = scandir($profilesDirectoryAddress);

    $result = "";

    if (count($files) > 2) {
        foreach ($files as $file) {
            if (in_array($file, ['.', '..']))
                continue;

            $result .= $file . "\r\n";
        }
    } else {
        $result .= "Директория пуста \r\n";
    }

    return $result;
}

function readProfile(array $config): string
{
    $profilesDirectoryAddress = $config['profiles']['address'];

    if (!isset($_SERVER['argv'][2])) {
        return handleError("Не указан файл профиля");
    }

    $profileFileName = $profilesDirectoryAddress . $_SERVER['argv'][2] . ".json";

    if (!file_exists($profileFileName)) {
        return handleError("Файл $profileFileName не существует");
    }

    $contentJson = file_get_contents($profileFileName);
    $contentArray = json_decode($contentJson, true);

    $info = "Имя: " . $contentArray['name'] . "\r\n";
    $info .= "Фамилия: " . $contentArray['lastname'] . "\r\n";

    return $info;
};

function searchProfile(array $config): string
{
    $address = $config['storage']['address'];
    $birthdayProfiles = [];

    if (file_exists($address)) {
        $handle = fopen($address, 'r');

        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $profile = explode(', ', $line);
                $birthday = DateTime::createFromFormat('d-m-Y', trim($profile[1]));

                if ($birthday !== false) {
                    $currentDate = new DateTime();

                    if ($birthday->format('m-d') === $currentDate->format('m-d')) {
                        $birthdayProfiles[] = $profile[0];
                    }
                }
            }

            fclose($handle);
        }
    }

    return implode("\n", $birthdayProfiles);
}

function deleteProfile(array $config): string
{
    $address = $config['storage']['address'];
    $nameToDelete = readline("Введите имя для удаления: ");

    if (file_exists($address)) {
        $lines = file($address, FILE_IGNORE_NEW_LINES);
        $found = false;

        foreach ($lines as $key => $line) {
            $profile = explode(', ', $line);

            if ($profile[0] === $nameToDelete) {
                unset($lines[$key]);
                $found = true;
                break;
            }
        }

        if ($found) {
            file_put_contents($address, implode("\n", $lines));
            return "Профиль $nameToDelete удален.";
        } else {
            return "Профиль $nameToDelete не найден.";
        }
    } else {
        return "Файл не существует.";
    }
}

