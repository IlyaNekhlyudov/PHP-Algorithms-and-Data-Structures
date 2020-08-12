<?php

$examples = [];
array_push($examples, "Это тестовый вариант проверки (задачи со скобками). И вот еще скобки: {[][()]}");
array_push($examples, "((a + b)/ c) - 2");
array_push($examples, "([ошибка)");
array_push($examples, "\"(\")");

foreach ($examples as $value) {
    if (sorting($value)) {
        echo $value . ' - true' . '<br>';
    } else {
        echo $value . ' - false' . '<br>';
    }
}

function sorting(string $string) {
    $spl = new SplStack();

    for ($i = 0; $i < strlen($string); $i++) {

        switch($string[$i]) {
            case '[':
                $spl->push(']');
            break;
            case '(':
                $spl->push(')');
            break;
            case '{':
                $spl->push('}');
            break;
        }

        // проверка на кавычки, так как с ними по задумке не прокатит, нужно делать отдельно
        if ($string[$i] == '"') {
            if ($spl->count() > 0) {
                if ($spl->top() == '"') {
                    $spl->pop();
                    continue;
                }
            } else {
                $spl->push('"');
            }
        }

        if ($string[$i] == ']' || $string[$i] == ')' || $string[$i] == '}' || $string[$i] == '"') {
            if ($spl->pop() == $string[$i]) {
                continue;
            } else {
                return false;
            }
        }
    }
    return true;
}