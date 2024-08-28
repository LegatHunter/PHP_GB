<?php
function validateDate(string $date): bool
{
    $dateBlocks = explode("-", $date);

    if (count($dateBlocks) < 3) {
        return false;
    }

    if (isset($dateBlocks[0]) && $dateBlocks[0] > 31) {
        return false;
    }

    if (isset($dateBlocks[1]) && $dateBlocks[0] > 12) {
        return false;
    }

    if (isset($dateBlocks[2]) && $dateBlocks[2] > date('Y')) {
        return false;
    }

    return true;
}

function validateName(string $name): bool
{
    if (strlen($name) < 2) {
        return false;
    }
    if (preg_match('~[0-9]+~', $name)) {
        return false;
    }
    return true;
}