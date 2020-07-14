<?php

if ($_GET['path']) {
    $directory = new DirectoryIterator($_GET['path']);
} else {
    $directory = new DirectoryIterator('/');
}

$array = [];
// сортировка по типу файла
foreach ($directory as $value) {
    if ($value->isDir()) {
        array_unshift($array, $value->getFilename());
    } else {
        array_push($array, $value->getFilename());
    }
}


?>

<? foreach ($array as $value) : ?>
    <? if ($directory->getPath() == '/') : ?>
        <a href="/homework%201/3/?path=<?=$directory->getPath() . $value?>"><?=$value?></a>
    <? else : ?>
        <a href="/homework%201/3/?path=<?=$directory->getPath() . '/' . $value?>"><?=$value?></a>
    <? endif; ?>
    <br>
<? endforeach; ?>