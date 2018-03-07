<?php
$strings = file('The Belkin Tales - Alexandr Pushkin_en.fb2');
foreach ($strings as $word){
$words[] = explode(' ',$word);}
$words2 = array_slice($words,72);
$arraywords = array();
foreach ($words2 as $subarr){
    $arraywords = array_merge($arraywords,$subarr);
}
$new_array = array_filter($arraywords, function($element) {
    return !empty($element);
});
foreach ($new_array as $word){
  $new_array2[] = trim ( $word,",.?!=" );
}
foreach ($new_array2 as $tr){
$a[]= preg_replace("/[^a-zа-я\s]/si", "",$tr);
}
$conection = mysqli_connect('localhost', 'root', '') OR DIE("No connect ");
mysqli_select_db($conection, 'test');
mysqli_query($conection, "drop table  `words`;");
mysqli_query($conection, "create table `words` (`id` int(6) not null primary key auto_increment, `word` varchar(100) not null default '');");
mysqli_query($conection, "alter table  words add index `word_index` (word);");
foreach ($a as $item) {
    $result = mysqli_query($conection, "INSERT INTO `words` (`word` ) VALUES ('$item')");
}
