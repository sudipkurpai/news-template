<?php include "header.php";
 include "conn.php";
?>







<?php


if(!isset($_POST['submit'])){

}else{

if(empty($_FILES['new-image']['name'])){
    $fname= $_POST['old-image'];

}else{
    $errors = array();
    $fname=$_FILES['new-image'] ["name"];
    
    $f_size=$_FILES['new-image'] ["size"];
    
    $f_tmp=$_FILES['new-image'] ["tmp_name"];
    
    $f_typ=$_FILES['new-image'] ["type"];
    
    $jj=explode('.',$fname);
    $f_ext=end($jj);
    
    $ext= array("jpeg","jpg","png");
    
    if(in_array($f_ext,$ext)===false){
    
        $errors[]= "This Extension file not allowed, Please choose a Jpg or Png file";
    }
    if($f_size>2098000){
        $errors[]= "File Size Must be 2mb or lower";
    }
    
    if(empty($errors)==true){
    move_uploaded_file($f_tmp,"images/".$fname);
    
    }else{
    
        echo $errors;
        die();
    }

    $sql1 = "SELECT * FROM settings  WHERE id = 1";
 $result = mysqli_query($con, $sql1) or die("Query Failed : Select");
 $row = mysqli_fetch_assoc($result);

 unlink("images/".$row['logo']);

$wbn= $_POST['postdesc'];
}

//UPDATE `settings` SET `id`='[value-1]',`websitename`='[value-2]',`logo`='[value-3]',`footerdesc`='[value-4]' WHERE 1

$sql2= "UPDATE settings SET websitename='{$_POST['wb_n']}',footerdesc='{$_POST['postdesc']}',logo='{$fname}' WHERE id = 1 ";
$res4=mysqli_query($con,$sql2);




if($res4){

    
    header("Location: {$host}/admin/setting.php");
}else{

    echo "<div class= 'alart alart-danger'> Query Faild!! </div>";
}
}

?> 










<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Website Setting</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">

    <?php  $sql = "SELECT * FROM settings ";
  $result= mysqli_query($con,$sql) or die ("qury faild111");
  if(mysqli_num_rows($result)>0){


 while($row=mysqli_fetch_assoc($result)){


?>






 <!-- Form for show edit-->

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="" placeholder="">
            </div>
            <div class="form-group">

            
                <label for="exampleInputTile">Website Name</label>
                <input type="text" name="wb_n"  class="form-control" id="exampleInputUsername" value="<?php echo $row['websitename'] ?>">
            </div>
            
           
            <div class="form-group">
                <label for="">Website Logo</label>
                <input type="file" name="new-image">
                <img  src="images/<?php echo $row['logo']; ?>" height="150px">
                <input type="hidden" name="old-image" value="<?php echo $row['logo']; ?>">
            </div>

            <div class="form-group">
                <label for="postdesc">Footer Description</label>
                <textarea name="postdesc" class="form-control"  rows="5" wrap="off" required><?php echo $row['footerdesc']; ?></textarea>
            </div>
           

            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <!-- Form End -->
<?php }
}?>











      </div>
    </div>
  </div>
</div>

</div>
</div>
<?php include "footer.php"; ?>