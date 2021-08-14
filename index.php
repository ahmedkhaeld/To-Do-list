<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo</title>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Shadows+Into_Light+Two" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">

</head>
<body>
    <div class="list">
        <h1 class="header">To Do</h1>
        <ul class="items">
            <li>
                <span class="item"> Pick up shopping</span>
                <a href="#" class="done-button">Mark as done</a>
            </li>
            <li>
                <span class="item done">learn php</span>
            </li>
        </ul>

        <form action="add.php" method="post" class="item-add">
            <input type="text" name="name" placeholder="Type a new item here." class="input" autocomplete="off" required>
            <input type="submit" value="Add" class="submit">
        </form>
    </div>
    
</body>
</html>