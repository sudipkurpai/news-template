<?php 

//$con= mysqli_connect("sudipmaiti.tk","mrdevelo_sudip","Sudip@maiti123","mrdevelo_news-site") or die("sql Error!!");
$con= mysqli_connect("localhost","root","","news-site") or die("sql Error!!");

//$host= "https://sudipmaiti.tk" ;

$host= "https://localhost/news-template" ;

$sql= "SELECT * FROM `settings` ";
$res= mysqli_query($con,$sql);
$r=mysqli_fetch_assoc($res);
//echo $r['title_logo'];
$img= "images/".$r['title_logo'];
//test
?>