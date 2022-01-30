<?php include "header.php"; 


if($_SESSION['role']==0){
    header("Location: {$host}/admin/post.php");
    }


$id= $_GET['id'];



?>


<?php 
if(isset($_POST['sumbit'])){

$c=$_POST['cat_name'];
 $sql= "UPDATE `category` SET `category_name`='{$c}' WHERE category_id = '{$id}'";
 

if(mysqli_query($con,$sql)){

header("Location: {$host}/admin/category.php");
}else{
    //echo " hello";
}


}


?>



  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">

<?php
$sql = " SELECT category_name FROM category where category_id = '{$id}' ";

$cnam= mysqli_query($con,$sql);

while($row=mysqli_fetch_assoc($cnam)) { 


?>



                  <form action="" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php $_GET['id']; ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name']; ?>"  placeholder="" required>
                          
                      </div>
                      <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                  </form>



                  <?php  }
                  

?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
