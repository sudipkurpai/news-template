

<?php 
include "conn.php";



$sql0 = "SELECT * FROM settings";

$r=mysqli_query($con,$sql0);
$head=mysqli_fetch_assoc($r);

$abc= basename($_SERVER['PHP_SELF']);


switch($abc){
case "category.php":
    if(isset($_GET['cid'])){

        $sql1="SELECT * FROM category WHERE category_id = {$_GET['cid']}";
        $r= mysqli_query($con,$sql1);
        $row= mysqli_fetch_assoc($r);
        $tt= $row['category_name']." News";



    }else{
        $tt= "NO Category Found";
    }

break;

case "single.php":
    if(isset($_GET['id'])){

        $sql1="SELECT * FROM post WHERE post_id = {$_GET['id']}";
        $r= mysqli_query($con,$sql1);
        $row= mysqli_fetch_assoc($r);
        $tt= $row['title'];



    }else{
        $tt= "NO Post Found";
    }

    break;
case "author.php":
if(isset($_GET['cid'])){

    $sql1="SELECT * FROM user WHERE user_id = {$_GET['cid']}";
    $r= mysqli_query($con,$sql1);
    $row= mysqli_fetch_assoc($r);
    $tt= "News By ". $row['first_name']." ".$row['last_name'];



}else{
    $tt= "NO Author Found at This Moment";
}break;
case "search.php":
    if(isset($_GET['search'])){

       
        $tt= "You Search : ".$_GET['search'];



    }else{
        $tt= "NO Search Found at This Moment";
    }break;
default :
        $tt= "Welcome To ".$head['websitename']; ;
      
       
}


    







?>


<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $tt ?></title>
    <link rel = "icon" href = "<?php echo $img ?>" type = "image/x-icon">
  
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">

            

            <?php
        if($head['logo']==""){
            echo $head['websitename'];
        }else{
            echo "<a href='index.php' id='logo'><img src='admin/images/".$head["logo"] . " 'width='15' height='50'> </a>";
        }

        ?>
                
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
<?php 
include "conn.php";
if(isset($_GET['cid'])){$cid= $_GET['cid'];
}

$sql= "SELECT * FROM category WHERE post >0";
$result= mysqli_query($con,$sql) or die ("qury faild1 : Menu");
$active = "";
if(mysqli_num_rows($result)>0){
   
    




?>

                <ul class='menu'>
                <li><a  href='<?php echo $host ?>'>  HOME </a></li>

      <?php while($row=mysqli_fetch_assoc($result)) { 

if(isset($_GET['cid'])){
if($row["category_id"]==$cid){
    $active = "active";
}else{
    $active = "";
}
}

     echo " <li><a class='{$active}' href='category.php?cid={$row['category_id']}'>  {$row['category_name']} </a></li>";
                   
} ?>
               </ul> 
 <?php } ?>

            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
