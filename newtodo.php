<?php
/**
 * Get the content of both todos json and the content from the form.
 * 
 * befor we use the json file, we should decode the content to an array instead of object
 * then when an item is added, it also will added to the array 
 * lastly convert back the array into a json notion by encode method.
 * 
 * @header is function that redirect the user to index page
 * 
 */?>
<?php

$todos = json_decode(file_get_contents('./todos.json'), true);

if (isset($_POST['todo_name'])){
    $todoName = $_POST['todo_name'];
    $todos[$todoName] = ['completed' => false];
}

file_put_contents('./todos.json', json_encode($todos, JSON_PRETTY_PRINT));

header('Location: index.php');