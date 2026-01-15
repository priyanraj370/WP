<?php

function generatePrimes($maxNumber) {
    echo "Prime numbers up to $maxNumber: ";
    for ($number = 2; $number <= $maxNumber; $number++) {
        $isPrime = true;
        for ($i = 2; $i <= sqrt($number); $i++) {
            if ($number % $i == 0) {
                $isPrime = false;
                break;
            }
        }
        if ($isPrime) {
            echo $number . " ";
        }
    }
    echo "<br>";
}


function fibonacciSeries($numTerms) {
    $first = 0;
    $second = 1;

    echo "Fibonacci Series ($numTerms terms): ";
    for ($i = 0; $i < $numTerms; $i++) {
        echo $first . " ";
        $next = $first + $second;
        $first = $second;
        $second = $next;
    }
    echo "<br>";
}


generatePrimes(50);      
fibonacciSeries(10);     
?>
