<?php
require_once "entities/Books.php";

use entities\Books;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<?php include "layouts/nav.php";?>
<?php
$books = Books::actionIndexTags();
?>

<ul>
    <?php foreach ($books as $key=>$book) {?>
        <li><strong><?= $key;?>: </strong><?= $book[0]['count'];?></li>
    <?php } ?>
</ul>

</body>
</html>
