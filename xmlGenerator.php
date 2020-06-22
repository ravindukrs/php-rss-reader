<?php
    $keyword=$_GET["keyword"];
    header("Content-Type: application/rss+xml; charset=ISO-8859-1");
    $rssfeed = '<?xml version="1.0" encoding="ISO-8859-1"?>';
    $rssfeed .= '<rss version="2.0">';
    $rssfeed .= '<channel>';
    $rssfeed .= '<title>My RSS feed</title>';
    $rssfeed .= '<link>http://www.mywebsite.com</link>';
    $rssfeed .= '<description>This is an example RSS feed</description>';
    $rssfeed .= '<language>en-us</language>';
    $rssfeed .= '<copyright>Copyright (C) 2009 mywebsite.com</copyright>';

    require 'vendor/autoload.php';
$con = new MongoDB\Client("mongodb://localhost:27017");
$db = $con -> rssApp;
$collection = $db->rssFeed;

$cursor = $collection->find( [
    'itemDescription' => new \MongoDB\BSON\Regex($keyword, 'i')
]
);
foreach ($cursor as $item) {
    $rssfeed .= '<item>';
    $rssfeed .= '<title>' . $item["itemTitle"] . '</title>';
    $rssfeed .= '<link>' . $item["itemLink"] . '</link>';
    $rssfeed .= '<description>' . $item["itemDescription"] . '</description>';
    $rssfeed .= '</item>';
 };

$rssfeed .= '</channel>';
$rssfeed .= '</rss>';

echo $rssfeed;
?>