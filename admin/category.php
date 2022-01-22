<?php include "header.php"; 
$limit =7;
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        </thead>


                        
                    <?php 
if(isset($_GET['page'])){
 
    $page=$_GET['page'];
  }else{
    $page=1;
  }

  $off= ($page-1)* $limit;

                    include "conn.php";
                    $sql = "SELECT * FROM category  LIMIt {$off},{$limit} ";
                    
                    $result= mysqli_query($con,$sql) or die("error!!!!!");

                     if(mysqli_num_rows($result)>0){

                    ?>





                    
                    <tbody>
                    <?php 
                    $sl = $off + 1;
                    while($row=mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td class='id'><?php echo $sl ; ?> </td>
                            <td><?php echo $row['category_name']; ?></td>
                            <td><?php echo $row['post']; ?></td>
                            <td class='edit'><a href='update-category.php?id=<?php echo $row['category_id']; ?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?id=<?php echo $row['category_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>

                        <?php $sl++;
                        }
                     ?>
                       
                    </tbody>
                </table>

                
                <?php }
                  
                  $sql2="SELECT*FROM category";
                  $rr=mysqli_query($con,$sql2) or die("Error 22222222222");
                  if(mysqli_num_rows($rr)){
                    $total=mysqli_num_rows($rr);
                    
                    $total_page=ceil($total/$limit );
                    echo " <ul class='pagination admin-pagination'>";
                   if($page>1){
                    echo '<li><a href="category.php?page='.($page - 1).'">Prev</a></li>';

                   }
                   

                    for($i=1;$i<=$total_page;$i++){

                      if ($i== $page) {
                       $active ="active";
                      } else {
                        $active ="";
                      }
                      


                      echo '<li class="'.$active.'"><a href = "category.php?page='.$i.'"> '.$i.' </a></li>';



                    }
                    if($total_page>$page){
                      echo '<li><a href="category.php?page='.($page + 1).'">Next</a></li>';
  
                     }
                    echo "</ul>";

                  }

                  ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
