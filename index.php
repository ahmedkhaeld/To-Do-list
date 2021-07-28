<?php
/**
 * Home page that gives the user the app functioality.
 * 
 * Form to input the to-do list items, then send those items to another page newtodo 
 * Form to check and uncheck lists according to whether it is completed or not
 * Form to delete items by unsetting that item from the array.
 * 
 * 
 */?>
<?php

$todos = json_decode(file_get_contents('./todos.json'), true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
<div>
    <!--form to input the to-do -->
  <form action="newtodo.php" method="post">
    <input type="text" name="todo_name" placeholder="Enter your todo">
    <button>New Todo</button>
  </form>
  <br>
    <?php foreach ($todos as $todoName => $todo): ?>
      <div style="margin-bottom: 20px;">
      <!-- checkbox form to check the to-do item whether ii is completed or not-->
        <form style="display: inline" action="change_status.php" method="post">
          <input type="hidden" name="todo_name" value="<?php echo $todoName ?>">
          <input type="checkbox" name="status" value="1" <?php echo($todo['completed'] ? 'checked' : '') ?>>
        </form>
          <?php echo $todoName ?>
             <!-- delete form to remove an item by execute the functionality in the delet.php page (action="delete.php")-->
        <form style="display: inline" action="delete.php" method="post">
          <input type="hidden" name="todo_name" value="<?php echo $todoName ?>">
          <button>Delete</button>
        </form>
      </div>
    <?php endforeach; ?>
</div>

<script>

  const checkboxes = document.querySelectorAll('input[type=checkbox]');
  checkboxes.forEach(ch => {
    ch.onclick = function () {
      this.parentNode.submit()
    };
  })
</script>
</body>
</html>