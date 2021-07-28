<?php
/**
 * Delet an item.
 * 
 * get that item and decode the json file to an array
 * remove that item by unsetting it from the array
 * encode the array into json notion.
 * 
 */?>
<?php

$todoName = $_POST['todo_name'];

$todos = json_decode(file_get_contents('./todos.json'), true);
unset($todos[$todoName]);

file_put_contents('./todos.json', json_encode($todos, JSON_PRETTY_PRINT));
header('Location: index.php');
