<?php

$data = [
    ['id' => 1, 'name' => 'Sandhya', 'age' => 30],
    ['id' => 2, 'name' => 'Sahana',  'age' => 35],
    ['id' => 3, 'name' => 'Shaturya', 'age' => 50],
    ['id' => 4, 'name' => 'Sathesh',   'age' => 45],
    ['id' => 5, 'name' => 'Surasandhiya',  'age' => 50]
];

function searchByCriteria($data, $criteria) {
    $results = [];
    foreach ($data as $entry) {
        $match = true;
        foreach ($criteria as $key => $value) {
            if (!isset($entry[$key]) || $entry[$key] != $value) {
                $match = false;
                break;
            }
        }
        if ($match) {
            $results[] = $entry;
        }
    }
    return $results;
}

$criteria = ['age' => 50];

$searchResults = searchByCriteria($data, $criteria);

echo "Search Results:<br>";
print_r($searchResults);
?>
