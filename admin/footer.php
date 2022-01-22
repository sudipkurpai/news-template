<!-- Footer -->

<?php
include "conn.php";

$sql = "SELECT * FROM settings";

$r=mysqli_query($con,$sql);
$head=mysqli_fetch_assoc($r);

?>



<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <span><?php echo $head['footerdesc'] ?> </span>
            </div>
        </div>
    </div>
</div>
<!-- /Footer -->
</body>
</html>
