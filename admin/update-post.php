<?php include "header.php";
 include "conn.php";
if($_SESSION['role']==0){
 $sql1 = "SELECT author FROM post WHERE post_id = {$_GET['id']}";
 $result1= mysqli_query($con,$sql1) or die ("qury faild2222");
 $row1=mysqli_fetch_assoc($result1);
if($row1['author'] != $_SESSION['user_id']){
    header("Location: {$host}/admin/post.php");
  
}
}

?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">

  <?php  $sql = "SELECT * FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id Where post_id ={$_GET['id']}";
  $result= mysqli_query($con,$sql) or die ("qury faild111");
  if(mysqli_num_rows($result)>0){





?>





        <!-- Form for show edit-->

        <form action="save_update_post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $_GET['id'] ?>" placeholder="">
            </div>
            <div class="form-group">

            <?php  while($row=mysqli_fetch_assoc($result)) { ?>
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $row['title']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5"> <?php echo $row['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                <!-- <option disabled> Select Category</option> -->
                <?php 
                             

                              $sql1 = "SELECT * FROM category";
                    
                    $result1= mysqli_query($con,$sql1) or die("error!!!!!");

                     if(mysqli_num_rows($result1)>0){

                        while($row1=mysqli_fetch_assoc($result1)){

                            if($row['category'] == $row1['category_id']){
                                $sel="Selected";
                            }else{
                                $sel="";
                            }

                            echo "<option {$sel} value='{$row1['category_id']}'>{$row1['category_name']}</option>";

                        }

                    } 
                              
                              
                              ?>
                </select>

                    

            </div>
            <div><input type="hidden" name="old" value="<?php echo $row['category'] ; ?>"></div>
            
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img  src="upload/<?php echo $row['post_img']; ?>" height="150px">
                <input type="hidden" name="old-image" value="<?php echo $row['post_img']; ?>">
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
<?php include "footer.php"; ?>
