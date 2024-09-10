<?php
namespace Geekbrains\Application1\Models;
class Phone
{
    private string $phone;
    public function __construct()
    {
        $this->phone = '+9 999 99 99';
    }
    public function getPhone() {
        return $this->phone;
    }
}