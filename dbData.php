<?php
//get the q parameter from URL
$q=$_GET["q"];


require 'vendor/autoload.php';
$con = new MongoDB\Client("mongodb://localhost:27017");
$db = $con -> rssApp;
$collection = $db->rssFeed;

$cursor = $collection->find();
foreach ($cursor as $restaurant) {
    echo $restaurant["itemTitle"] . "<br>";
    echo $restaurant["itemLink"] . "<br>";
    echo $restaurant["itemDescription"] . "<br><br><br>";
    //var_dump($restaurant);
 };


echo ("Called Me!!!");

?>