<?php
function removeDuplicates($array) {
    $result = array_values(array_unique($array));
    return $result;
}

$sortedlist = [1, 1, 2, 2, 3, 3, 4, 5, 5];

echo "Original List: ";
print_r($sortedlist);

$uniquelist = removeDuplicates($sortedlist);

echo "<br>Unique List: ";
print_r($uniquelist);
?>
