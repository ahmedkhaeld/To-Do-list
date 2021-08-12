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
        // Display the item:
        echo "<li>$todo";
        // Check for subtasks:
        if(isset($tasks[$task_id])) {
            make_list($tasks[$task_id],$tasks);
        }
        echo '</li>'; //complete the list itme
    } // End of FOREACH loop.
    echo '</ol>'; // Close the ordered list.
} // End of make_list() function.

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

// Send the first array element
// to the make_list() function:
make_list($tasks[0],$tasks);
?>
</body>
</html>

