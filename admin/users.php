<?php include "header.php";
if($_SESSION['role']==0){
header("Location: http://localhost/news-template/admin/post.php");
}
include "conn.php";
$limit =7;


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
    
</body>
</html>


  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">

                    <?php
                    
                   // $limit =4;
                    if(isset($_GET['page'])){

                      $page=$_GET['page'];
                    }else{
                      $page=1;
                    }

                    
                    $off= ($page-1)* $limit;
                    $sql = "SELECT * FROM user ORDER BY user_id DESC LIMIt {$off},{$limit}";
                    $result= mysqli_query($con,$sql) or die ("qury faild");
                    if(mysqli_num_rows($result)>0){

                    



?>



                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                      <?php   $sl = $off + 1;
                      while($row=mysqli_fetch_assoc($result)) { ?>

                          <tr>
                              <td class='id'><?php echo $sl; ?></td>
                              <td><?php echo $row['first_name']." ".$row['last_name']; ?> </td>
                              <td><?php echo $row['username'];  ?> </td>
                              <td><?php if( $row['role'] == 1){
                                  echo "Admin";
                              }else echo "Normal" ;?></td>


                              <td class='edit'><a href='update-user.php?id=<?php echo $row["user_id"]?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-user.php?id=<?php echo $row["user_id"]?>'class ='del'><i class='fa fa-trash-o'></i></a></td>
                           
                          </tr>


                          <?php 
                        $sl++;
                        } ?>
                      </tbody>
                  </table>
                  <?php }
                  
                  $sql2="SELECT*FROM user";
                  $rr=mysqli_query($con,$sql2) or die("Error 22222222222");
                  if(mysqli_num_rows($rr)){
                    $total=mysqli_num_rows($rr);
                    
                    $total_page=ceil($total/$limit );
                    echo " <ul class='pagination admin-pagination'>";
                   if($page>1){
                    echo '<li><a href="users.php?page='.($page - 1).'">Prev</a></li>';

                   }
                   

                    for($i=1;$i<=$total_page;$i++){

                      if ($i== $page) {
                       $active ="active";
                      } else {
                        $active ="";
                      }
                      


                      echo '<li class="'.$active.'"><a href = "users.php?page='.$i.'"> '.$i.' </a></li>';



                    }
                    if($total_page>$page){
                      echo '<li><a href="users.php?page='.($page + 1).'">Next</a></li>';
  
                     }
                    echo "</ul>";

                  }

                  ?>
                 
                      <!-- <li class="active"><a>1</a></li>
                      <li><a>2</a></li>
                      <li><a>3</a></li> -->
                  

<script>

    $('.del').on('click',function(e){

        e.preventDefault();
        var self =$(this);
        const href = $(this).attr('href')
        
        //console.log(self.data('title'));

        const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {

// if(result.value){
//     document.location.href=href;

// }
    

  if (result.isConfirmed) {
    
    
    swalWithBootstrapButtons.fire(
       

      'Deleted!',
      'Your file has been deleted.',
      'success'
      
    )

    //if(result.value){
    document.location.href=href;

//}
   
    
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your imaginary file is safe :)',
      'error'
    )
  }
})

    })

    </script>









   




                  
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
