<!-- 1. Реализовать основные 4 арифметические операции в виде функции с тремя
параметрами – два параметра это числа, третий – операция. Обязательно
использовать оператор return. -->

<?php
function calculator(int $num1, int $num2, $operation)
{
    if ($operation == "+") {
        return $num1 + $num2;
    } else if ($operation == "-") {
        return $num1 - $num2;
    } else if ($operation == "*") {
        return $num1 * $num2;
    } else if ($operation == "/") {
        return $num2 == 0?"Ошибка": $num1/$num2;
    }
}

echo calculator(10, 2, '*')
    ?>

<!-- 2. Реализовать функцию с тремя параметрами: function mathOperation($arg1, $arg2,
$operation), где $arg1, $arg2 – значения аргументов, $operation – строка с
названием операции. В зависимости от переданного значения операции выполнить
одну из арифметических операций (использовать функции из пункта 3) и вернуть
полученное значение (использовать switch). -->

<?php
function mathOperation($arg1, $arg2, $operation)
{
    switch ($operation) {
        case '+':
            return $arg1 + $arg2;
        case '-':
            return $arg1 - $arg2;
        case '*':
            return $arg1 * $arg2;
        case '/':
            if ($arg2 != 0) {
                return $arg1 / $arg2;
            } else {
                return 'Деление на ноль!';
            }
        default:
            return 'Неправильный формат операции';
    }
}

echo mathOperation(10, 2, '+');
?>

<!-- 3. Объявить массив, в котором в качестве ключей будут использоваться названия
областей, а в качестве значений – массивы с названиями городов из
соответствующей области. Вывести в цикле значения массива, чтобы результат был
таким: Московская область: Москва, Зеленоград, Клин Ленинградская область:
Санкт-Петербург, Всеволожск, Павловск, Кронштадт Рязанская область … (названия
городов можно найти на maps.yandex.ru) -->

<?php
$regions = [
    'Московская область' => ['Москва', 'Зеленоград', 'Клин'],
    'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Павловск', 'Кронштадт'],
    'Рязанская область' => ['Рязань', 'Касимов', 'Скопин', 'Шацк']
];

foreach ($regions as $region => $cities) {
    echo "-$region:\n";
    foreach ($cities as $city) {
        echo "---$city\n";
    }
}
?>

<!-- 4. Объявить массив, индексами которого являются буквы русского языка, а
значениями – соответствующие латинские буквосочетания (‘а’=> ’a’, ‘б’ => ‘b’, ‘в’ =>
‘v’, ‘г’ => ‘g’, …, ‘э’ => ‘e’, ‘ю’ => ‘yu’, ‘я’ => ‘ya’). Написать функцию транслитерации
строк. -->

<?php
$translitMap = [
    'а' => 'a',
    'б' => 'b',
    'в' => 'v',
    'г' => 'g',
    'д' => 'd',
    'е' => 'e',
    'ё' => 'yo',
    'ж' => 'zh',
    'з' => 'z',
    'и' => 'i',
    'й' => 'y',
    'к' => 'k',
    'л' => 'l',
    'м' => 'm',
    'н' => 'n',
    'о' => 'o',
    'п' => 'p',
    'р' => 'r',
    'с' => 's',
    'т' => 't',
    'у' => 'u',
    'ф' => 'f',
    'х' => 'kh',
    'ц' => 'ts',
    'ч' => 'ch',
    'ш' => 'sh',
    'щ' => 'shch',
    'ъ' => '',
    'ы' => 'y',
    'ь' => '',
    'э' => 'e',
    'ю' => 'yu',
    'я' => 'ya'
];

function transliterate($string, $map)
{
    $result = '';
    $string = mb_strtolower($string);
    $length = mb_strlen($string);

    for ($i = 0; $i < $length; $i++) {
        $char = mb_substr($string, $i, 1);
        $result .= isset($map[$char]) ? $map[$char] : $char;
    }
    return $result;
}

echo transliterate('Привет, мир!', $translitMap);
?>

<!-- 5. *С помощью рекурсии организовать функцию возведения числа в степень.
Формат: function power($val, $pow), где $val – заданное число, $pow – степень. -->

<?php
function power($val, $pow)
{
    if ($pow == 0) {
        return 1;
    }
    if ($pow == 1) {
        return $val;
    }
    return $val * power($val, $pow - 1);
}

echo power(2, 3);
?>

<!-- 6. *Написать функцию, которая вычисляет текущее время и возвращает его в
формате с правильными склонениями, например:
22 часа 15 минут
21 час 43 минуты -->

<?php
function getCurrentTime()
{
    $hours = date('H');
    $minutes = date('i');
    function getHourWord($hours)
    {
        if ($hours >= 5 && $hours <= 20) {
            return 'часов';
        }
        $lastDigit = $hours % 10;
        if ($lastDigit == 1) {
            return 'час';
        } elseif ($lastDigit >= 2 && $lastDigit <= 4) {
            return 'часа';
        } else {
            return 'часов';
        }
    }
    function getMinuteWord($minutes)
    {
        if ($minutes >= 5 && $minutes <= 20) {
            return 'минут';
        }
        $lastDigit = $minutes % 10;
        if ($lastDigit == 1) {
            return 'минута';
        } elseif ($lastDigit >= 2 && $lastDigit <= 4) {
            return 'минуты';
        } else {
            return 'минут';
        }
    }
    return $hours . ' ' . getHourWord($hours) . ' ' . $minutes . ' ' . getMinuteWord($minutes);
}
echo getCurrentTime();
?>