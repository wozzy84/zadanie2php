<?php
$trimmed_array = $next_draw = [0, 0, 0, 0, 0, 0];
$sum = $avarage = 0;

function get_random($min, $max, $quantity)
{
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}

$lotto_results = file_get_contents('http://app.lotto.pl/wyniki/?type=dl');
if (strlen($lotto_results) > 0) {
    $results_to_array = explode(PHP_EOL, $lotto_results);
    $trimmed_array = array_slice($results_to_array, 1, -1);
    $sum = array_sum($trimmed_array);
    $avarage = round($sum / count($trimmed_array), 2);
    $next_draw =  get_random(1, 49, 6);
} else {
    echo 'nie można wyświetlić wyników lotto';
}

?>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/main.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>

<body>
    <h1 class="title">Wyniki losowania lotto:</h1>
    <table class="table">
        <tr class="table__row">

            <?php
            foreach ($trimmed_array as $el) {
                echo '<td class="table__cell">' . $el . '</td>';
            }
            ?>

        </tr>
    </table>
    <p class="text">Suma liczb to: <?php echo $sum; ?> </p>
    <p class="text">Srednia z liczb to: <?php echo $avarage; ?> </p>
    <h3 class="text">Liczby na kolejne losowanie: </h3>
    <table class="table">
        <tr class="table__row">

            <?php
            foreach ($next_draw  as $el) {
                echo '<td class="table__cell">' . $el . '</td>';
            }
            ?>

        </tr>
    </table>

</body>

</html>