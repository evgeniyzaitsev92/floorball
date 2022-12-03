<?php
$logFile = "log.txt";
date_default_timezone_set('Europe/Moscow');

// Простое сообщение
function logMes($mes){
    global $logFile;
    file_put_contents($logFile, "* [".date('Y-m-d, H:i:s')."] >>> MES >>> ".$mes.PHP_EOL, FILE_APPEND | LOCK_EX);
}

// Определить тип переменной
function logType($var){
    global $logFile;
    $name = "";
    foreach($GLOBALS as $varName => $value) {
        if ($value === $var) {
            $name = $varName;
        }
    }
    file_put_contents($logFile, "* [".date('Y-m-d, H:i:s')."] >>> TYPE >>> Variable \"\$".$name."\" is of \"".gettype($var)."\" type.".PHP_EOL, FILE_APPEND | LOCK_EX);
}

// Вывести массив
function logArr($array){
    global $logFile;
    file_put_contents($logFile, "* [".date('Y-m-d, H:i:s')."] >>> ARRAY >>> ".json_encode($array).PHP_EOL, FILE_APPEND | LOCK_EX);
}