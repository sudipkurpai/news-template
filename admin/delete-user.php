<?php 

if($_SESSION['role']==0){
    header("Location: {$host}/admin/post.php");
    }

include "conn.php" ;
?>

<?php  
                    $get = $_GET['id'];
                    
                    $sql = "DELETE FROM user WHERE user_id = {$get}";
                   if(mysqli_query($con,$sql) ){
                    //echo "delet";
                   // echo "<script>alart('Delete Succesfully');</script>";
                    
                   header("Location: http://localhost/news-template/admin/users.php");

                   }else{
                    echo "<p style ='color:red; margin:10px 0'>Cant Delete</p>";

                   }
                   mysqli_close($con);
                    ?>