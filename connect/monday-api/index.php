<?php

require 'vendor/autoload.php';

$token  = 'eyJhbGciOiJIUzI1NiJ9.eyJ0aWQiOjIzNzY5NDQyMCwidWlkIjozODkxNzU1MSwiaWFkIjoiMjAyMy0wMi0xNlQwNjo1NDowOS4wODFaIiwicGVyIjoibWU6d3JpdGUiLCJhY3RpZCI6MTUwMTIxNTUsInJnbiI6InVzZTEifQ.BAOQ1KXPUW3rdfwiBdZLmdBnMfTie1YUCUoHGOEkwPc';
$MondayBoard = new TBlack\MondayAPI\MondayBoard();
$MondayBoard->setToken(new TBlack\MondayAPI\Token($token));
$all_boards = $MondayBoard->getBoards();

$board_id = 3916343602;
$board = $MondayBoard->on($board_id)->getBoards();

print_r(array_values($board));

$boardColumns = $MondayBoard->on($board_id)->getColumns();
echo "<br><hr><br>";
print_r(array_values($boardColumns));

echo "<br><hr><br>";
$query = '
items_by_multiple_column_values (board_id: 4034243674, column_id: "status5", column_values: ["Working on it", "In progress"]) {
        id
        name
    }';

# For Query
$items = $MondayBoard->customQuery($query);
//$items = $MondayBoard->customMutation($query);
print_r($items);
