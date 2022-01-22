<?php include 'header.php';
  $limit =4;
?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php 
                        include "conn.php";

                        if(isset($_GET['page'])){
 
                            $page=$_GET['page'];
                          }else{
                            $page=1;
                          }
      
                          $off= ($page-1)* $limit;


                          $sql = "SELECT * FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id ORDER BY post.post_id DESC LIMIt {$off},{$limit}";
                          $result= mysqli_query($con,$sql) or die ("qury faild111");
                     if(mysqli_num_rows($result)>0){

                        while($row=mysqli_fetch_assoc($result)) {
 
                        
                        ?>


                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?id=<?php echo $row['post_id'];?>"><img
                                        src="admin/upload/<?php   echo $row['post_img'];?>" alt="" /></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a
                                            href='single.php?id=<?php echo $row['post_id'];?>'><?php   echo $row['title'];?></a>
                                    </h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a
                                                href='category.php?cid=<?php   echo $row['category_id'];?>'><?php   echo $row['category_name'];?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?cid=<?php   echo $row['user_id'];?>'>
                                                <?php   echo $row['first_name']." ".$row['last_name'];?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>

                                            <?php   echo $row['post_date'];?>
                                        </span>
                                    </div>
                                    <p class="description">
                                        <?php   echo substr($row['description'],0,130)."...";?>
                                    </p>
                                    <a class='read-more pull-right'
                                        href='single.php?id=<?php echo $row['post_id'];?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php 
                        }
                    }else{
                        echo "<h2> NO Record Found</h2>";
                    }
                  
                  $sql2="SELECT*FROM post";
                  $rr=mysqli_query($con,$sql2) or die("Error 22222222222");
                  if(mysqli_num_rows($rr)){
                    $total=mysqli_num_rows($rr);
                    
                    $total_page=ceil($total/$limit );
                    echo " <ul class='pagination admin-pagination'>";
                   if($page>1){
                    echo '<li><a href="index.php?page='.($page - 1).'">Prev</a></li>';

                   }
                   

                    for($i=1;$i<=$total_page;$i++){

                      if ($i== $page) {
                       $active ="active";
                      } else {
                        $active ="";
                      }
                      


                      echo '<li class="'.$active.'"><a href = "index.php?page='.$i.'"> '.$i.' </a></li>';



                    }
                    if($total_page>$page){
                      echo '<li><a href="index.php?page='.($page + 1).'">Next</a></li>';
  
                     }
                    echo "</ul>";

                  }

                  ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>