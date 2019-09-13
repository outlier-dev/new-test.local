<?php

require_once "utility/Check.php";
require_once "utility/OpenBreweryDB.php";
use utility\Check;
use utility\OpenBreweryDB;
use utility\OpenBreweryDBException;
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
// 5. There's a brewery database with public API https://www.openbrewerydb.org/#documentation
// Please implement a client class OpenBreweryDB for this API with the
// following methods:
//      * retrieve particular brewery by id
//          brewery should be returned as an stdClass instance
//
//      * search by brewery name
//          should return iterator or iterable object that will handle
//          underlying pagination
//
//      In case of HTTP or network error both methods should throw exception
//      of type OpenBreweryDBException with code = HTTP code or -1 in case of
//      network issue, -2 in case of invalid JSON response.
//
//      In case if you will use 3rd party package then explain why.


$api = new OpenBreweryDB();
$brewery = $api->getBrewery(3333);
//print_r($brewery);
Check::check($brewery instanceof stdClass, 'Invalid brewery type');
Check::check($brewery->id == 3333, 'Wrong brewery retrieved');
try {
    $api->getBrewery('123123131231231');
//    $brewery = $api->getBrewery(3333);
    Check::check(false, "Missing brewery didn't yield error");
} catch (OpenBreweryDBException $e) {
    //var_dump($e->getCode());
    Check::check($e->getCode() == 404, 'Invalid code');
}

$page = (int) $_GET['page'];
if(empty($page)) $page = 1;

$cnt = 0;
//foreach ($api->filter('dog') as $b) {
echo "<ul>";
foreach ($api->filterPaging('dog',$page) as $b) {
    echo "<li><span>{$b->id}</span> {$b->name}</li>";
    Check::check(
        ($b instanceof stdClass) &&
        isset($b->id, $b->name),
        'Invalid brewery returned from filter'
    );
    Check::check(mb_stripos($b->name, 'dog') !== false, 'Invalid brewery in filter results');
    ++$cnt;
}
echo "</ul>";
echo "<p>{$cnt}</p>";
Check::checkTrue($cnt > 40, 'Filter is not paginated properly');
?>
</body>
</html>