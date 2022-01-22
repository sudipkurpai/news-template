<?php

include "conn.php";

$pid=$_GET['id'];
$cid=$_GET['catid'];



$sql1 = "SELECT * FROM post WHERE post_id = {$pid}";
  $result = mysqli_query($con, $sql1) or die("Query Failed : Select");
  $row = mysqli_fetch_assoc($result);

  unlink("upload/".$row['post_img']);



$sql= "DELETE FROM post WHERE post_id = {$pid};";
$sql.="UPDATE category SET post= post-1 WHERE category_id = {$cid}";

$res= mysqli_multi_query($con,$sql);
if($res){

  
    header("Location: {$host}/admin/post.php");
}else{

    echo "<div class= 'alart alart-danger'> Query Faild!! </div>";
}


?>