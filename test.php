<?php
include('database.php');
$obj = new query();
//$condition_arr = array("name"=>"sunita","email"=>"sunita@gmail.com","mobile"=>"8564885437");
$condition_arr = array("name"=>"kada","email"=>"kadar@gmail.com ","mobile"=>"3355554456");
//$result =$obj->getData('users','*',$condition_arr,'userid','asc',7);

//$result1 =$obj->getData('employee');

//$result = $obj->InsertData('users',$condition_arr);

// echo "<pre>";
// print_r($result);
// echo "<pre>";

//print_r($result1);user table prints by result1 object

//$result = $obj->deleteData('users',$condition_arr);
$result = $obj->updateData('users',$condition_arr,'userid',6);

?>