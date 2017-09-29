<?php include 'header.php';?>

<?php
    require_once('db.php');
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $q = "SELECT * FROM rooms WHERE rooms.id = $id";
        $run = mysqli_query($con, $q);
        $row = mysqli_fetch_array($run);
    }
?>
<div class="container">
<h1 class="title"><?php echo $row['title']; ?></h1>
 <!-- RoomDetails -->
            <div id="RoomDetails" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                <div class="item active"><img src="images/photos/<?php echo $row['image1']; ?>" class="img-responsive" alt="slide"></div>
                <div class="item  height-full"><img src="images/photos/<?php echo $row['image2']; ?>"  class="img-responsive" alt="slide"></div>
                <div class="item  height-full"><img src="images/photos/<?php echo $row['image3']; ?>"  class="img-responsive" alt="slide"></div>
                <div class="item  height-full"><img src="images/photos/<?php echo $row['image4']; ?>"  class="img-responsive" alt="slide"></div>
                </div>
                <!-- Controls -->
                <a class="left carousel-control" href="#RoomDetails" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                <a class="right carousel-control" href="#RoomDetails" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
            </div>
  <!-- RoomCarousel-->


<div class="room-features spacer">
  <div class="row">
    <div class="col-sm-12 col-md-5"> 
    <p><?php echo $row['description']; ?></p>
    </div>
    <div class="col-sm-6 col-md-3 amenitites"> 
    <h3>Common Facilities</h3>    
    <ul>
      <li>Television with more than 400 channels.</li>
      <li>Attached bathroom with bath-tub.</li>
      <li>Wide balcony towards beautiful garden.</li>
      <li>House keeping 3 times per day.</li>
      <li>24 hours water supply.</li>
    </ul>
    

    </div>  
    <div class="col-sm-3 col-md-2">
      <div class="size-price">Size<span><?php echo $row['size']; ?> sq</span></div>
    </div>
    <div class="col-sm-3 col-md-2">
      <div class="size-price">Price<span><?php echo $row['price']; ?> /-</span></div>
    </div>
  </div>
</div>
                     


</div>
<?php include 'footer.php';?>