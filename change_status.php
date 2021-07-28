<?php
/**
 * 
 * 
 */?>
<?php


$todos = json_decode(file_get_contents('./todos.json'), true);
$todoName = $_POST['todo_name'];
//this change the status according if checked this means it's ture so change it to fals or if is not checked this means it's false now set it to true
$todos[$todoName]['completed'] = ! $todos[$todoName]['completed'];
//this change the status according if checked or not checked if isset then it's true if not it is false 
// $todos[$todoName]['completed'] = isset($_POST['status']);
file_put_contents('./todos.json', json_encode($todos, JSON_PRETTY_PRINT));
header('Location: index.php');