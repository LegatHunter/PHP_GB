<?php
// $x = 1;
// function foo() {
//   $x = 2;
//   echo $x;
// }

// echo foo();
// echo $x;

$str = '()()())(';
function scobky(string $str): bool
{
  $count = 0;
  if (strlen($str) % 2 === 0) {
    for ($i = 0; $i < strlen($str); $i++) {
      $str[$i] === '(' ? $count++ : $count--;
    }
  }
  return $count ===0;
};

echo scobky($str)? 'Строка норм' : 'Ошибка';