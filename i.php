<?php

include "conn.php";

$name= $_SERVER["QUERY_STRING"];
echo $name;
$sql = "SELECT long_url,counter FROM urls_list WHERE short_code LIKE '".$name."'";
$res = mysqli_query($conn,  $sql);
if (mysqli_num_rows($res) == 1){
    $arr = mysqli_fetch_assoc($res);
    $count = $arr['counter']+1;
    echo $count;
    $sql="UPDATE urls_list SET counter = ".$count." WHERE short_code = '".$name."'";
    $res = mysqli_query($conn,  $sql);
    echo $count;
    header('Location: '.$arr['long_url'].'');
}
?>