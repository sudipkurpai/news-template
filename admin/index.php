<?php
include "conn.php";
session_start();
$sqlz = "SELECT * FROM settings";
$r=mysqli_query($con,$sqlz);
$head=mysqli_fetch_assoc($r);

if(isset($_SESSION['username'])){
    header ("Location: {$host}/admin/post.php");
}


$r=mysqli_query($con,$sqlz);
$head=mysqli_fetch_assoc($r);

?>
<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN | Login</title>
        <link rel = "icon" href = "<?php echo $img ?>" type = "image/x-icon">
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                  
                  
                    <!-- <a href='post.php'> -->
                        <img class='logo' src ="<?php echo 'images/'.$head['logo'] ; ?> " width='35' height='50' > 
                        <!-- width='35' height='50' -->
                        <h3 class="heading">Admin</h3>
                        <!-- Form Start -->
                        <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method ="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="login" />
                        </form>
                        <!-- /Form  End -->

                        <?php
                        if(isset($_POST['login'])){
                            include "conn.php";

                            $uname= $_POST['username'];
                            $pass= md5($_POST['password']);
                         $sql="SELECT user_id,username,role ,first_name,last_name FROM user WHERE username= '{$uname}' AND password = '{$pass}' ";

                      
                             $result = mysqli_query($con,$sql) or die("Faild !!!!");
                             if(mysqli_num_rows($result)>0){
                                 while($row = mysqli_fetch_assoc($result)){
                                     session_start();
                                     $_SESSION['username']=$row['username'];
                                     $_SESSION['name']=$row['first_name']." ".$row['last_name'];
                                     $_SESSION['user_id']=$row['user_id'];
                                     $_SESSION['role']=$row['role'];
                                     header("Location: {$host}/admin/post.php");
                                 }

                             }else{
                                 echo " <div class='alart alart-denger'> USername and Password Not Match </div>";
                            
                                }
                        }

                        ?>

                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
