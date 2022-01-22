<?php 
session_start();
include "conn.php";


if(isset($_FILES['fileToUpload'])){
$errors = array();
$fname=$_FILES['fileToUpload'] ["name"];

$f_size=$_FILES['fileToUpload'] ["size"];

$f_tmp=$_FILES['fileToUpload'] ["tmp_name"];

$f_typ=$_FILES['fileToUpload'] ["type"];
$jj=explode('.',$fname);
$f_ext=strtolower(end($jj));
$ext= array("jpeg","jpg","png");

if(in_array($f_ext,$ext)===false){

    $errors[]= "This Extension file not allowed, Please choose a Jpg or Png file";
}
if($f_size>2098000){
    $errors[]= "File Size Must be 2mb or lower";
}

if(empty($errors)==true){
    $img= time()."-".$fname;
    $new=$img;
move_uploaded_file($f_tmp,"upload/".$new);

}else{

    print_r($errors);
    die();
}

}



$title=mysqli_real_escape_string($con,$_POST['post_title']);

$desc=trim(mysqli_real_escape_string($con,$_POST['postdesc']));
$category=mysqli_real_escape_string($con,$_POST['category']);
$desc=mysqli_real_escape_string($con,$_POST['postdesc']);
$date= date("d M, Y");
$auther= $_SESSION['user_id'];


$sql= "INSERT INTO post(`title`, `description`, `category`, `post_date`, `author`, `post_img`)  VALUES ('{$title}','{$desc}','{$category}','{$date}','{$auther}','{$new}'); ";
$sql.="UPDATE category set post = post+1 WHERE category_id={$category}";

if(mysqli_multi_query($con,$sql)){
  
    header("Location: {$host}/admin/post.php");
}else{

    echo "<div class= 'alart alart-danger'> Query Faild!! </div>";
}



?>