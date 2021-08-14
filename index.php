
<?php require_once 'app/init.php'; 
$itemQuery=$db->prepare(
    "SELECT id, name, done 
    FROM items
    WHERE user=:user");
$itemQuery->execute(['user'=>$_SESSION['user_id']]);

$items=$itemQuery->rowCount() ? $itemQuery : [] ;

?>


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
        <?php if(!empty($items)): ?>
        <ul class="items">
            <?php foreach($items as $item): ?>
                <li>
                    <span class="item<?php echo $item['done'] ? ' done' : '' ?>" > <?php echo $item['name']; ?> </span>
                    <?php if(!$item['done']): ?>
                    <a href="mark.php?as=done&item=<?php echo $item['id']?>" class="done-button">Mark as done</a>
                    <?php endif; ?>
                    <?php if($item['done']): ?>
                        <a href="mark.php?as=notdone&item=<?php echo $item['id']?>" class="not-done-button">Mark as Not done</a>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
            <p> You Haven't added any items yet.</p>
        <?php endif; ?>

        <form action="add.php" method="post" class="item-add">
            <input type="text" name="name" placeholder="Type a new item here." class="input" autocomplete="off" required>
            <input type="submit" value="Add" class="submit" >
        </form>
    </div>
    
</body>
</html>