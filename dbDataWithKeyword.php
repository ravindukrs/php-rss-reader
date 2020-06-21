<?php
//get the q parameter from URL
$keyword=$_GET["keyword"];


require 'vendor/autoload.php';
$con = new MongoDB\Client("mongodb://localhost:27017");
$db = $con -> rssApp;
$collection = $db->rssFeed;

$cursor = $collection->find( [
    'itemDescription' => new \MongoDB\BSON\Regex($keyword, 'i')
]
);
foreach ($cursor as $restaurant) {
    echo $restaurant["itemTitle"] . "<br>";
    echo $restaurant["itemLink"] . "<br>";
    echo $restaurant["itemDescription"] . "<br><br><br>";
    //var_dump($restaurant);
 };


?>