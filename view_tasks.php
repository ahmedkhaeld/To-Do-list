<?php include "db.php" ?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>View Tasks</title>
<link rel="stylesheet"
href="style.css">
</head>
<body>
<h2>Current To-Do List</h2>
<?php
function make_list($parent, $tasks) {
    echo '<ol>'; // Start an ordered list.
    // Loop through each subarray:
    foreach($parent as $task_id =>$todo) {
        // Start with a checkbox!
        echo <<<EOT
        <li><input type="checkbox" name="tasks[$task_id]" value="done"> $todo
        EOT;
        // Check for subtasks:
        if(isset($tasks[$task_id])) {
            make_list($tasks[$task_id],$tasks);
        }
        echo '</li>'; //complete the list itme
    } // End of FOREACH loop.
    echo '</ol>'; // Close the ordered list.
} // End of make_list() function.


// Check if the form has been submitted:
    
    if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['tasks'])
            && is_array($_POST['tasks'])  && !empty($_POST['tasks'])) {
            // Define the query:
        $sql = 'UPDATE tasks SET date_completed=NOW() WHERE task_id IN (';
        // Add each task ID:
        foreach ($_POST['tasks'] as $task_id => $v) {
         $sql .= $task_id . ', ';
            
        }
            // Complete the query and execute:
            $sql = substr($sql, 0, -2) . ')';
            $result = mysqli_query($conn, $sql);
            // Report on the results:
            
            if (mysqli_affected_rows($conn) == count($_POST['tasks'])) {
            
               echo '<p>The task(s) have been marked as completed!</p>';
    
            } else {

               echo '<p>Not all tasks could be marked as completed!</p>';
            }
    } // End of submission IF.

$sql='SELECT task_id, parent_id, task FROM tasks WHERE date_completed="0000-00-00
00:00:00" ORDER BY parent_id, date_added ASC';
$result = mysqli_query($conn, $sql);

// Inilialize the storage array:
$tasks=[];
//Loop through the results:
while (list($task_id, $parent_id, $task) = mysqli_fetch_array($result, MYSQLI_NUM)) {
    // Add to the array:
  $tasks[$parent_id][$task_id] = $task;
}

// Make a form:
    echo <<<EOT
    <p>Check the box next to a task and click "Update" to mark a task as completed (it,
    and any subtasks, will no longer appear in this list).</p>
    <form action="view_tasks.php" method="post">
    EOT;
// Send the first array element
// to the make_list() function:
make_list($tasks[0],$tasks);

// Complete the form:
    echo <<<EOT
    <input name="submit" type="submit" value="Update" />
    </form>
    EOT;
?>
</body>
</html>

