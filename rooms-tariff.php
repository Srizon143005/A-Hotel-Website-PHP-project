<?php include 'header.php';?>

<div class="container">

<h2>Rooms &amp; Tariff</h2>


<!-- form -->

<div class="row">
  <?php
    require_once('db.php');
    $q = "SELECT * FROM rooms ORDER BY rooms.id ASC";
    $run = mysqli_query($con, $q);
    $count = 0;
    if(mysqli_num_rows($run) > 0){
        while($row = mysqli_fetch_array($run)){
  ?>
  <div class="col-sm-6 wowload fadeInUp">
      <div class="rooms">
          <img src="images/photos/<?php echo $row['image1']; ?>" class="img-responsive">
          <div class="info">
              <h3><?php echo $row['title']; ?></h3>
              <p style="color: darkgreen;"> Size: <?php echo $row['size']; ?> sq. feet<br> Per Night: <?php echo $row['price']; ?> Taka Only</p>
              <a href="room-details.php?id=<?php echo $row['id']; ?>" class="btn btn-default">Check Details</a>
          </div>
      </div>
  </div>
  <?php
        }
    }
  ?>
  
  
</div>


</div>
<?php include 'footer.php';?>