<?php include "header.php"; 


if($_SESSION['role']==0){
    header("Location: http://localhost/news-template/admin/post.php");
    }
include "conn.php";
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  

                   
                    
<!-- Form Start -->
<?php

if(isset($_POST['submit'])){

    $uid=  $_POST['user_id'];
    $fname=$_POST['f_name'];
    $lname=$_POST['l_name'];
    $uname=$_POST['username'];
     $role=$_POST['role'];
    echo " $fname $lname $uname  $role";
    
    // $sql = "SELECT username FROM user WHERE username = '{$uname}'";

    // $result = mysqli_query($con,$sql) or die ("Error !!!");
    // if(mysqli_num_rows($result)>0){
    //     echo "<p style ='color:red;text-align:center;margin 10px 0;'>Username Already Used<p>";
    
    // }else{
     
        $sql1 = "UPDATE `user` SET `first_name`='{$fname}',`last_name`='{$lname}',`username`='{$uname}',`role`='{$role}' WHERE user_id ='{$uid}'";

       if(mysqli_query($con,$sql1)){
          // echo "hello";

header("Location: http://localhost/news-template/admin/users.php");


       }

   // } 
}





?>
 <?php  
                    $get = $_GET['id'];
                    
                    $sql = "SELECT * FROM user WHERE user_id = '{$get}'";
                    $result= mysqli_query($con,$sql) or die ("qury faild");
                    if(mysqli_num_rows($result)>0){

                        while($row= mysqli_fetch_assoc($result)){
                    ?>




                  <form  action="<?php $_SERVER['PHP_SELF'] ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $row['user_id'] ?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['username'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $row['role']; ?>">
                    <?php
                          if( $row['role'] == 1){
                                  echo "<option value='0' >normal User</option>;
                              <option value='1' selected >Admin</option>";
                              }else { echo "<option value='0' selected>normal User</option>;
                              <option value='1' >Admin</option>" ;
                              }
                              
                              
                              ?>



                              
                          </select>
                          
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                      <?php } ?>
                  </form>
                  <?php } ?>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
