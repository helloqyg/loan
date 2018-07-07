<?php 
$conn = new MongoClient("mongodb://test:dgj99349@45.32.251.171:27017/test");
$db = $conn->test;
$collection = $db->widuu;
$test = $db->test;
// var_dump($articles);
// $article = $articles->findOne(array('_id' => new MongoId('5506a084be64e2e628ebb9f5')));
// $count = $articles->count(array('_id' => new MongoId('5506a084be64e2e628ebb9f5')));
//  $obj = array( "title" => "Calvin and Hobbes", "author" => "Bill Watterson" );
//  $collection->insert($obj); //将$obj 添加到$collection 集合中 
//  $obj = array( "title" => "XKCD", "online" => true );
//  $collection->insert($obj);
$cursor = $collection->find();
 foreach ($cursor as $obj) {  //遍历所有集合中的文档
 echo $obj["title"] . "n";
 } 

 $cursor = $test->find();
 foreach ($cursor as $obj) {  //遍历所有集合中的文档
 	var_dump($obj);
 } 
//$m->close(); //断开MongoDB连接
