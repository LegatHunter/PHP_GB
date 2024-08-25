<?php
$arr1 = [1, 4, 6, 6, 8];
$arr2 = [2, 5, 7, 9];
$result = [];
$count1 = 0;
$count2 = 0;

while ($count1 < count($arr1) && $count2 < count($arr2)) {
  if($arr1[$count1] < $arr2[$count2]){
    $result[] = $arr1[$count1];
    $count1++;
  } else {
    $result[] = $arr2[$count2];
    $count2++;
  }
}

if ($count1 < count($arr1)){
  for (; $count1 < count($arr1); $count1++) {
    $result[] = $arr1[$count1];
  };
};

if ($count2 < count($arr2)){
  for (; $count2 < count($arr2); $count2++) {
    $result[] = $arr2[$count2];
  };
};
echo "<pre>";
print_r($result);
var_dump($result);