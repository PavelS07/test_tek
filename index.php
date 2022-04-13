<?php
/*
1 задание

SELECT name, SUM(price) as 'Суммарная стоимость лотов', SUM(amount) as 'Суммарное количество позиций' FROM procedures
INNER JOIN lots ON lots.procedure_id=procedures.id
INNER JOIN positions ON positions.lot_id=lots.id
GROUP BY name
ORDER BY name;
*/
/*
 * 2 задание
 * Жуки с приоритетом сначала занимают выгодные ячейки (самые дальние от соседей)
 * Поэтому при выполнении x=10 y=3, результат будет 1, 2, а не 2,2, так как второй жук занял позицию 2,2
 * */
$x = 8;
$y = 3;
$line = [$x]; // массив с ячейками
$direction = []; // направления

if($x == $y) { // нет пустых ячеек
    $direction['left'] = $direction['right']  = 0;
} else if($x < $y) { // ячеек меньше чем жуков
    exit;
} else if($x - $y <= 3) { // ячейки будут пустые только рядом с соседями
    $direction['left'] = $direction['right']  = 0;
} else { // половинным делением находим пустые ячейки рядом с пустыми ячейками
    $k = array_pop($line);
    $k--;
    $direction['left'] = abs(floor($k/2));
    $direction['right'] = abs(ceil($k/2));

    array_push($line, $direction['left'], $direction['right']);
    for($i = 1; $i < $y; $i++) {

//        echo '<pre>'.print_r($line, true).'</pre>';

        if($i+1 == $y && $line[0] == 1) { // последняя итерация и первый элемент равен 1, значит осталась пустая ячейка на границе
            $direction['left'] = abs(ceil(array_shift($line)/2));
            $direction['right'] = abs(ceil(array_pop($line)/2));
            break;
        } else {
            $direction['left'] = abs(floor(array_shift($line)/2));
            $direction['right'] = abs(ceil(array_pop($line)/2));
        }

        array_push($line, $direction['left'], $direction['right']);
    }
}

echo $direction['left'].'<br>'.$direction['right'];
