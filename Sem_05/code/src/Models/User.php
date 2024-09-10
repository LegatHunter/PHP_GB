<?php

namespace Geekbrains\Application1\Models;

class User
{
    private ?string $userName;
    private ?int $userBirthday;

    private static string $storageAddress = '/storage/birthdays.txt';

    public function __construct(string $name = null, int $birthday = null)
    {
        $this->userName = $name;
        $this->userBirthday = $birthday;
    }

    public function setName(string $userName): void
    {
        $this->userName = $userName;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function getUserBirthday(): ?int
    {
        return $this->userBirthday;
    }

    public function setBirthdayFromString(string $birthdayString): void
    {
        $this->userBirthday = strtotime($birthdayString);
    }

    public static function getAllUsersFromStorage(): array|false
    {
        $address = $_SERVER['DOCUMENT_ROOT'] . User::$storageAddress;
        if (file_exists($address) && is_readable($address)) {
            $file = fopen($address, "r");
            $users = [];
            while (($userString = fgets($file)) !== false) {
                $userArray = explode(",", trim($userString));
                if (count($userArray) < 2) {
                    error_log("Пропуск недопустимой строки: $userString");
                    continue;
                }
                $userName = $userArray[0];
                $userBirthdayString = $userArray[1] ?? null;
                $user = new User($userName);
                if ($userBirthdayString !== null) {
                    $user->setBirthdayFromString($userBirthdayString);
                }
                $users[] = $user;
            }
            fclose($file);
            return $users;
        } else {
            error_log("Файл не существует или не доступен для чтения: $address");
            return false;
        }
    }
}