<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <?php
                include "conn.php";

                $limit = 4;
                $src = mysqli_real_escape_string($con, $_GET['search']) ;
                //jhh

                if(isset($_GET['page'])){

                  $page=$_GET['page'];
                }else{
                  $page=1;
                }

                $off= ($page-1)* $limit;



                ?>


                <!-- post-container -->
                <div class="post-container">
                    <h2 class="page-heading"><?php echo strtoupper("SEARCH : ". $src); ?> </h2>



                    <?php


                  if($src==null){
                    echo "<h2>Please input value For Search.</h2>";

                }else{

                    


                    $sql = "SELECT * FROM post LEFT JOIN category ON  post.category = category.category_id LEFT JOIN user ON post.author = user.user_id WHERE title LIKE '%{$src}%' OR description like '%{$src}%' LIMIt {$off},{$limit} ";

                    // 
                    $r = mysqli_query($con, $sql) or die("error");
                    if (mysqli_num_rows($r) > 0) {



                    ?>

                        <?php while ($row = mysqli_fetch_assoc($r)) {
                            
                          
                            
                            ?>
                            <div class="post-content">
                                <div class="row">

                                    <div class="col-md-4">

                                        <a class="post-img" href="single.php?id=<?php echo $row['post_id']; ?>"><img src="admin/upload/<?php echo $row['post_img']; ?>" alt="" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='single.php?id=<?php echo $row['post_id']; ?>'><?php echo $row['title']; ?></a>
                                            </h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href='category.php?cid=<?php echo $row['category_id']; ?>'><?php echo $row['category_name']; ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <a href='author.php?cid=<?php echo $row['user_id']; ?>'>
                                                        <?php echo $row['first_name'] . " " . $row['last_name']; ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>

                                                    <?php echo $row['post_date']; ?>
                                                </span>
                                            </div>
                                            <p class="description">
                                                <?php echo substr($row['description'], 0, 130) . "..."; ?>
                                            </p>
                                            <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']; ?>'>read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    <?php


                        }
                    } else {
                        echo "<h2> NO Record Found</h2>";
                    }

               
                }

                    ?>



                    <?php
                    if(!$src==null){
                        

                    $sql2 = "SELECT * FROM post  WHERE title like '%{$src}%' or description like '%{$src}%' ";
                    $rr = mysqli_query($con, $sql2) or die("Error 22222222222");
                    if (mysqli_num_rows($rr)) {
                        $total = mysqli_num_rows($rr);

                        $total_page = ceil($total / $limit);
                        echo " <ul class='pagination'>";
                        if ($page > 1) {
                            echo '<li><a href="search.php?page=' . ($page - 1) . '&search='.$_GET['search']. '">Prev</a></li>';
                        }


                        for ($i = 1; $i <= $total_page; $i++) {

                            if ($i == $page) {
                                $active = "active";
                            } else {
                                $active = "";
                            }



                            echo '<li class="' . $active . '"><a href = "search.php?page=' . $i .'&search='.$_GET['search'].'"> ' . $i . ' </a></li>';
                        }
                        if ($total_page > $page) {
                            echo '<li><a href="search.php?page=' . ($page + 1) . '&search='.$_GET['search']. ' ">Next</a></li>';
                        }
                        echo "</ul>";
                    }
                }

                    ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>