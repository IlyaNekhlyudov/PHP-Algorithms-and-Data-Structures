<?php

$a = 2;
$b = 6;

$max = $a * $b;

$current = 1;
$start = 0;

$arr = [];

spiralLeft([0, 0], [$b-1, 0], $current, ['max' => $max, 'a' => $a, 'b' => $b], $arr, $start);

function spiralLeft($rangeFrom, $rangeTo, $current, $value, $arr, $start) {
    if ($value['max'] <= 0) {
        echo 'Оба значения должны быть положительными.';
        return false;
    } else if ($value['b'] == 1) {
        for ($i = 0; $i < $value['a']; $i++) {
            $arr[0][$i] = $current++;
        }
        return outputSpiral($arr);
    }
    
    if (isSpiralReady($current, $value['max'])) return outputSpiral($arr);

    for ($i = $rangeFrom[0]; $i <= $rangeTo[0]; $i++) {
        if (isSpiralReady($current, $value['max'])) return outputSpiral($arr);
        $arr[$i][$rangeFrom[1]] = $current++;
    }
    if ($value['a'] == 2) {
        spiralRight([$rangeTo[0], $rangeTo[1] + 1], [$start, $rangeTo[0]], $current, ['max' => $value['max'], 'a' => $a, 'b' => $b], $arr, $start);
    } else {
        spiralBottom([$rangeTo[0], $rangeTo[1] + 1], [$rangeTo[0], $rangeTo[0]], $current, ['max' => $value['max'], 'a' => $a, 'b' => $b], $arr, $start);
    }
}

function spiralBottom($rangeFrom, $rangeTo, $current, $value, $arr, $start) {
    if (isSpiralReady($current, $value['max'])) return outputSpiral($arr);

    for ($i = $rangeFrom[1]; $i <= $rangeTo[0]; $i++) {
        if (isSpiralReady($current, $value['max'])) return outputSpiral($arr);
        $arr[$rangeFrom[0]][$i] = $current++;
    }
    
    spiralRight([$rangeTo[0]-1, $rangeTo[0]], [$start, $rangeTo[0]], $current, ['max' => $value['max'], 'a' => $a, 'b' => $b], $arr, $start);
    $start++;
}

function spiralRight($rangeFrom, $rangeTo, $current, $value, $arr, $start) {
    if (isSpiralReady($current, $value['max'])) return outputSpiral($arr);
    
    for ($i = $rangeFrom[0]; $i >= $rangeTo[0]; $i--) {
        if (isSpiralReady($current, $value['max'])) return outputSpiral($arr);
        $arr[$i][$rangeFrom[1]] = $current++;
    }

    spiralTop([$rangeTo[0], $rangeTo[1]-1],[$rangeTo[0], $rangeTo[1]-2], $current, ['max' => $value['max'], 'a' => $a, 'b' => $b], $arr, $start);
}

function spiralTop($rangeFrom, $rangeTo, $current, $value, $arr, $start) {
    if (isSpiralReady($current, $value['max'])) return outputSpiral($arr);

    for ($i = $rangeFrom[1]; $i >= $rangeTo[1]; $i--) {
        if (isSpiralReady($current, $value['max'])) return outputSpiral($arr);
        $arr[$rangeFrom[0]][$i] = $current++;
    }
    spiralLeft([$rangeTo[0]+1, $rangeTo[1]],[$rangeTo[0]+2, $rangeTo[1]], $current, ['max' => $value['max'], 'a' => $a, 'b' => $b], $arr, $start);
}

function isSpiralReady($current, $max) {
    if ($current > $max) {
        return true;
    } else {
        return false;
    }
}

function outputSpiral($arr) {
    for ($i = 0; $i < count($arr); $i++) {
        echo '<br>';
        for ($j = 0; $j < count($arr[$i]); $j++) {
            if ($arr[$i][$j] < 10) {
                echo '0' . $arr[$i][$j];
            } else {
                echo $arr[$i][$j];
            }
            echo ' ';
        }
    }
}