<?php include "db.php"; ?>
<?php 
/**
 * Task are are added to the database using this script. Task can even be filed under other 
 * task using th drop-down menu
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a Task</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?
// Check if the form has been submitted:
if (($_SERVER['REQUEST_METHOD'] == 'POST') && !empty($_POST['task'])) {
    // Sanctify the input...
    // The parent_id must be an integer:
    if (isset($_POST['parent_id']) &&
            filter_var($_POST['parent_id'], FILTER_VALIDATE_INT, array('min_range' => 1)) ) {
            $parent_id = $_POST['parent_id'];
    } else {
        $parent_id = 0;
        }
    // Escape the task:To prevent Cross-Site Scripting (XSS) attacks
    $task = mysqli_real_escape_string($conn, strip_tags($_POST['task']));
    // Add the task to the database.
    $sql = "INSERT INTO tasks (parent_id, task) VALUES ($parent_id, '$task')";
    $result = mysqli_query($conn, $sql);
    // Report on the results:
    if (mysqli_affected_rows($conn) == 1) {
    echo '<p>The task has been added!</p>';
    } else {
        echo '<p>The task could not be added!</p>';
    }
} // End of submission IF.

// Display the form:
    echo '<form action="add_task.php" method="post">
    <fieldset>
    <legend>Add a Task</legend>
    <p>Task: <input name="task" type="text" size="60" maxlength="100" required></p>
    <p>Parent Task: <select name="parent_id"><option value="0">None</option>';

    // Retrieve all the uncompleted tasks:once a task has been
   // completed, its date_completed column would have a nonzero value
    $sql = 'SELECT task_id, parent_id, task FROM tasks WHERE date_completed="0000-00-0000:00:00" ORDER BY date_added ASC';
    $result = mysqli_query($conn, $sql);
    // Also store the tasks in an array for use later:
        $tasks = [];
    // Fetch the records:
    while (list($task_id, $parent_id, $task) = mysqli_fetch_array($result, MYSQLI_NUM)) {
        // Add to the select menu:
        echo "<option value=\"$task_id\">$task</option><br/>";
        // Add to the array:
        $tasks[] = ['task_id' => $task_id, 'parent_id' => $parent_id, 'task' =>$task];
    }
    // Complete the form:
        echo '</select></p>
        <input name="submit" type="submit" value="Add This Task">
        </fieldset>
        </form>';
    // Sort the tasks by parent_id:

function parent_sort($x, $y) {

return ($x['parent_id'] > $y['parent_id']);

}
// Display all the tasks:

echo '<h2>Current To-Do List</h2><ul>';

foreach ($tasks as $task) {

echo "<li>{$task['task']}</li><br/>";

}

echo '</ul>';

usort($tasks, 'parent_sort');

?>
</body>
</html>