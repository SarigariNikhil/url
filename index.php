<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHORTNER</title>
</head>
<style>

.navbar {
 display: flex;
 align-items: center;
 justify-content: space-between;
 background-color: Black;
 color: #ffff;
}
.logo {
    padding-left: 3%;
}

body{
    background-color:WhiteSmoke;
}
body{
	margin:0;
	font-family: sans-serif;
}

*{
	box-sizing: border-box;
}

.table{
    width: 100%;
	border-collapse: collapse;
}

.table td,.table thead{
  padding:12px 15px;
  border:1px solid #ddd;
  text-align: center;
  font-size:16px;
}
thead{
    background-color: #f5f5f5;
}

.table tbody tr:nth-child(even){
	background-color: #f5f5f5;
}



@media(max-width: 500px){
	.table thead{
		display: none;
	}

	.table, .table tbody, .table tr, .table td{
		display: block;
		width: 100%;
	}
	.table tr{
		margin-bottom:15px;
	}
	.table td{
		text-align: right;
		padding-left: 50%;
		text-align: right;
		position: relative;
	}
	.table td::before{
		content: attr(data-label);
		position: absolute;
		left:0;
		width: 50%;
		padding-left:15px;
		font-size:15px;
		font-weight: bold;
		text-align: left;
	}
}

section{
  background-color: White;
  margin-left: auto;
  margin-right: auto;
  display: table; 
  padding: 2.5% 7.5%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
}
.list{
  margin-left: auto;
  margin-right: auto;
  display: table; 
  padding: 2.5% 7.5%;
}

table {
  overflow-x: scroll;
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 50%;
  margin-left: auto; 
  margin-right: auto;
}

td, th {
  border: 1px solid #dddddd;
  text-align: center;
  padding: 8px;
  overflow:hidden;
}

tr:nth-child(even) {
  background-color: #dddddd;
}


</style>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    
    function myFunction() {
        var copyText = document.getElementById("myInput");
        copyText.select();
        copyText.setSelectionRange(0, 99999); 
        navigator.clipboard.writeText(copyText.value);
        alert("Copied the text: " + copyText.value);
    }
</script>
<body>
   <nav class="navbar">
     <div class="logo"><h2>URL SHORTENER</h2></div>
   </nav>
<div style="margin-top:10%"></div>
<main>
<section><div style="margin:auto,width: 40%">
<h2>Enter the URL to be shortened</h2>
<form action="shortner.php" method="post">
<input type="url" name="long_url" placeholder="Enter the link here" required>
<input type="submit" name="submit"value="Shorten URL">
</form>
<?php
include "conn.php";
session_start();
if(isset($_SESSION['present'])){
    echo "</p>".$_SESSION['present']."</p>";
}
if(isset($_SESSION['err'])){
    echo "</p>".$_SESSION['err']."</p>";
}

if(isset($_SESSION['test'])){
    echo "</p>".$_SESSION['test']."</p>";
}
if(isset($_SESSION['short_url'])&&isset($_SESSION['long_url'])){
    echo "<input type='text' value='http://url-shtner.herokuapp.com/i.php?".$_SESSION['short_url']."' id='myInput'><button onclick='myFunction()'>Copy</button>";
}
if (session_status() === PHP_SESSION_ACTIVE){
    session_destroy();
}?>



</section>

</div>
<div class="list" style="margin-top:4%">
<form action="index.php" method="post">
<h3>list of all urls that were Shortened Click on below Button</h3>
<input style="margin:1%;"type="submit" name="submit1" value="Get List">
</form>
</div>
</main>
<?php

include "conn.php";

if(isset($_POST['submit1'])){
    
    $sql = "SELECT long_url, short_code, counter FROM urls_list";
      $res = mysqli_query($conn,  $sql);
      if (mysqli_num_rows($res) > 0) {
       echo "
        <div style='margin-top:2%;'>
            <table class='table' style='background-color:White;'>
                <thead>
                    <th>Shorted url</th>
                    <th>Actual url</th>
                    <th>Link Usages</th>
                </thead>";
       while ($list = mysqli_fetch_assoc($res)){
           echo "
            <tr>
                <td data-label='short_code'><a href = 'http://url-shtner.herokuapp.com/i.php?".$list['short_code']."'>http://url-shtner.herokuapp.com/i.php?".$list['short_code']."</a></td>
                <td data-label='long_url'><a href='".$list['long_url']."'>".substr($list['long_url'],0,120)."</a></td>
                <td data-label='Link Usages'>".$list['counter']."</td>
            </tr>";
       }
       echo "</table></div>";
    }
}
?>
</head>
</html>