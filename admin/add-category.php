<?php include "header.php"; 
include "conn.php";

if($_SESSION['role']==0){
    header("Location: {$host}/admin/post.php");
    }
?>

<?php 
if(isset($_POST['save'])){

$c=$_POST['cat'];
 $sql= "INSERT into category (`category_name`) VALUE ('{$c}')  ";

//$res = mysqli_query($con,$sql) ;

if(mysqli_query($con,$sql)){
    //echo "hello";

header("Location: {$host}/admin/category.php");
}else{
    echo " hello";
}


}


?>


  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
