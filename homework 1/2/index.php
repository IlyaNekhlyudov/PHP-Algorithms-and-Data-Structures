<?php

calculate(600851475143, 2);

function calculate($a, $b) {
    if ($a % $b == 0) {
        echo $a / $b;
        return true;
    } else {
        calculate($a, $b + 1);
    }
}

// не знаю, правильное ли решение на рекурсии, но это единственное, что пришло в голову