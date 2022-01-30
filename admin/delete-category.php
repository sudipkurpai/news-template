<?php 
include "conn.php";
$del= $_GET['id'];


$sql= "DELETE FROM category WHERE category_id = '{$del}'";
$r=mysqli_query($con,$sql);

if($r){
    header("Location: {$host}/admin/category.php");

}else{
    echo "Noooooo!!!";
}

?>