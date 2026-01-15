<?php

$rows = 5;

for ($i = $rows; $i > 0; $i--) {

    
    for ($j = $rows - $i; $j > 0; $j--) {
        echo "&nbsp;"; // space before stars
    }

    
    for ($k = 0; $k < $i; $k++) {
        echo "* ";
    }

    
    echo "<br>";
}
?>

