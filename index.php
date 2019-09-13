<?php
    require_once "data/CustomData.php";
    require_once "utility/Check.php";
    require_once "utility/ArrayHelper.php";

    use data\CustomData;
    use utility\Check;
    use utility\ArrayHelper;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TESTING</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<?php include "layouts/nav.php";?>
<?php
$flat = CustomData::$flatArray;
$result = CustomData::$resultArray;

$tree = ArrayHelper::makeTree($flat);
Check::check($result == $tree, 'Tree construction yielded invalid result');
$flatted = ArrayHelper::flattenTree($tree);
Check::check($flat == $flatted, 'Tree flattening yielded invalid result');

Check::check(ArrayHelper::getValueIterative('db.connection.dsn', CustomData::$config) == CustomData::$config['db']['connection']['dsn'], 'Iterative path retrieval failed');
Check::check(ArrayHelper::getValueRecursive('db.connection.dsn', CustomData::$config) == CustomData::$config['db']['connection']['dsn'], 'Recursive path retrieval failed');
Check::check(ArrayHelper::getValueByKey('db.connection.dsn', CustomData::$config) == CustomData::$config['db']['connection']['dsn'], 'Recursive path retrieval failed');
// missing values yield defaults
Check::check(ArrayHelper::getValueIterative('doesnt.exist', CustomData::$config, 0xDEADC0DE) === 0xDEADC0DE, 'Iterative path retrieval failed to handle missing value');
Check::check(ArrayHelper::getValueRecursive('doesnt.exist', CustomData::$config, 0xC0DED00D) === 0xC0DED00D, 'Recursive path retrieval failed to handle missing value');
Check::check(ArrayHelper::getValueByKey('doesnt.exist', CustomData::$config, 0xC0DED00D) === 0xC0DED00D, 'ValueByKey path retrieval failed to handle missing value');
//// make sure nulls are handled correctly
Check::check(ArrayHelper::getValueRecursive('cache.invalidation', CustomData::$config, null) === null, 'Recursive path retrieval fails to handle nulls');
//Check::check(getValueIterative('cache.invalidation', $config, new stdClass) === null, 'Iterative path retrieval fails to handle nulls');
?>


</body>
</html>