<?php include 'header.php';?>
<div class="container">

       <h1 class="title">Gallery</h1>
       <div class="row gallery">
              
              <?php
                require_once('db.php');
                $q = "SELECT * FROM rooms ORDER BY rooms.id ASC";
                $run = mysqli_query($con, $q);
                $count = 0;
                if(mysqli_num_rows($run) > 0){
                    while($row = mysqli_fetch_array($run)){
              ?>
              
              <div class="col-sm-4 wowload fadeInUp"><a href="images/photos/<?php echo $row['image1']; ?>" title="<?php echo $row['title']; ?>" class="gallery-image" data-gallery><img src="images/photos/<?php echo $row['image1']; ?>" class="img-responsive"></a></div>
              <div class="col-sm-4 wowload fadeInUp"><a href="images/photos/<?php echo $row['image2']; ?>" title="<?php echo $row['title']; ?>" class="gallery-image" data-gallery><img src="images/photos/<?php echo $row['image2']; ?>" class="img-responsive"></a></div>
              <div class="col-sm-4 wowload fadeInUp"><a href="images/photos/<?php echo $row['image3']; ?>" title="<?php echo $row['title']; ?>" class="gallery-image" data-gallery><img src="images/photos/<?php echo $row['image3']; ?>" class="img-responsive"></a></div>
              <div class="col-sm-4 wowload fadeInUp"><a href="images/photos/<?php echo $row['image4']; ?>" title="<?php echo $row['title']; ?>" class="gallery-image" data-gallery><img src="images/photos/<?php echo $row['image4']; ?>" class="img-responsive"></a></div>
              <?php
                    }
                }
              ?>
              <div class="col-sm-4 wowload fadeInUp"><a href="images/photos/1.jpg" title="Foods" class="gallery-image" data-gallery><img src="images/photos/1.jpg" class="img-responsive"></a></div>
              <div class="col-sm-4 wowload fadeInUp"><a href="images/photos/2.jpg" title="Coffee" class="gallery-image" data-gallery><img src="images/photos/2.jpg" class="img-responsive"></a></div>
              <div class="col-sm-4 wowload fadeInUp"><a href="images/photos/3.jpg" title="Travel" class="gallery-image" data-gallery><img src="images/photos/3.jpg" class="img-responsive"></a></div>
              <div class="col-sm-4 wowload fadeInUp"><a href="images/photos/4.jpg" title="Adventure" class="gallery-image" data-gallery><img src="images/photos/4.jpg" class="img-responsive"></a></div>
              <div class="col-sm-4 wowload fadeInUp"><a href="images/photos/5.jpg" title="Fruits" class="gallery-image" data-gallery><img src="images/photos/5.jpg" class="img-responsive"></a></div>
              <div class="col-sm-4 wowload fadeInUp"><a href="images/photos/6.jpg" title="Summer" class="gallery-image" data-gallery><img src="images/photos/6.jpg" class="img-responsive"></a></div>
       </div>
</div>
<?php include 'footer.php';?>