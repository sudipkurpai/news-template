<?php 
include "conn.php";


if(empty($_FILES['new-image']['name'])){
    $new= $_POST['old-image'];

}else{

    $sql1 = "SELECT * FROM post WHERE post_id = {$_POST["post_id"]}";
 $result = mysqli_query($con, $sql1) or die("Query Failed : Select");
 $row = mysqli_fetch_assoc($result);

 unlink("upload/".$row['post_img']);
   
    $errors = array();
    $fname=$_FILES['new-image'] ["name"];
    
    $f_size=$_FILES['new-image'] ["size"];
    
    $f_tmp=$_FILES['new-image'] ["tmp_name"];
    
    $f_typ=$_FILES['new-image'] ["type"];
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

    
    


$trim= trim($_POST["postdesc"]);

 $sql= "UPDATE post SET title='{$_POST["post_title"]}',description='{$trim}',category={$_POST["category"]},post_img='{$new}' WHERE post_id='{$_POST["post_id"]}';";
 if($_POST['old'] != $_POST['post_id']){
$sql.="UPDATE category SET post = post-1 WHERE category_id = {$_POST['old']};";
$sql.="UPDATE category SET post = post+1 WHERE category_id = {$_POST["category"]};";
 }
 
 
$res=mysqli_multi_query($con,$sql);



if($res){

    
    header("Location: {$host}/admin/post.php");
}else{

    echo "<div class= 'alart alart-danger'> Query Faild!! </div>";
}


?>